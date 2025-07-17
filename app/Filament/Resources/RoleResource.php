<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RoleResource\Pages;
use App\Models\Menu;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleResource extends BaseResource
{
    protected static ?string $model = Role::class;

    public static function ensurePermissionsExist(array $permissions): void
    {
        foreach ($permissions as $name) {
            Permission::firstOrCreate([
                'name' => $name,
                'guard_name' => 'web',
            ]);
        }
    }

    public static function form(Form $form): Form
    {
        $actions = ['view', 'create', 'update', 'delete'];
        $menus = Menu::with('parent')
            ->where('isactive', 'Y')
            ->where(function ($query) {
                $query->whereNotNull('parent_id')
                      ->orWhereDoesntHave('children');
            })
            ->orderBy('label')
            ->get();

        $allPermissions = [];
        $permissionCards = collect();

        foreach ($menus as $menu) {
            $label = $menu->label;
            $keySource = $menu->url ? Str::after($menu->url, '/admin/') : $label;
            $key = Str::slug($keySource);

            if (!$key) {
                continue;
            }

            $permissionOptions = [];
            foreach ($actions as $action) {
                $permission = "{$action}_{$key}";
                $permissionOptions[$permission] = ucfirst($action);
                $allPermissions[] = $permission;
            }

            $permissionCards->push(
                Card::make()->schema([
                    Placeholder::make($label),
                    CheckboxList::make("permissions_group_{$key}")
                        ->label('')
                        ->options($permissionOptions)
                        ->columns(3)
                        ->bulkToggleable()
                        ->dehydrated(false)
                        ->reactive()
                        ->afterStateHydrated(function (callable $set, callable $get) use ($permissionOptions, $key) {
                            $saved = $get('permissions_state') ?? [];
                            $selected = array_intersect(array_keys($permissionOptions), $saved);
                            $set("permissions_group_{$key}", $selected);
                        })
                        ->afterStateUpdated(function ($state, callable $set, callable $get) use ($actions) {
                            $allGroups = $get();

                            $newPermissions = collect();

                            foreach ($allGroups as $field => $val) {
                                if (Str::startsWith($field, 'permissions_group_') && is_array($val)) {
                                    $newPermissions = $newPermissions->merge($val);
                                }
                            }

                            $set('permissions_state', $newPermissions->unique()->values()->toArray());
                        })
                ])->columnSpan(1)
            );
        }

        self::ensurePermissionsExist($allPermissions);

        return $form->schema([
            Hidden::make('permissions_state')
                ->default([])
                ->dehydrated(true)
                ->afterStateHydrated(function ($state, callable $set, callable $get, ?Model $record) use ($menus, $actions) {
                    if ($record) {
                        $state = $record->permissions->pluck('name')->toArray();
                        $set('permissions_state', $state);

                        foreach ($menus as $menu) {
                            $keySource = $menu->url ? Str::after($menu->url, '/admin/') : $menu->label;
                            $key = Str::slug($keySource);

                            if (!$key) {
                                continue;
                            }

                            $groupPermissions = collect($actions)
                                ->map(fn ($action) => "{$action}_{$key}")
                                ->filter(fn ($perm) => in_array($perm, $state))
                                ->toArray();

                            $set("permissions_group_{$key}", $groupPermissions);
                        }
                    }
                }),

            Grid::make(1)->schema([
                TextInput::make('name')
                    ->label('Nama Role')
                    ->required(),

                Toggle::make('select_all')
                    ->label('Select All')
                    ->helperText('Centang semua permission untuk role ini.')
                    ->reactive()
                    ->dehydrated(false)
                    ->afterStateHydrated(function (callable $set, callable $get) use ($allPermissions) {
                        $selected = $get('permissions_state') ?? [];
                        $set('select_all', empty(array_diff($allPermissions, $selected)));
                    })
                    ->afterStateUpdated(function ($state, callable $set, callable $get) use ($menus, $actions) {
                        $allPermissions = [];

                        foreach ($menus as $menu) {
                            $keySource = $menu->url ? Str::after($menu->url, '/admin/') : $menu->label;
                            $key = Str::slug($keySource);
                            if (!$key) {
                                continue;
                            }

                            $groupPermissions = collect($actions)->map(fn ($action) => "{$action}_{$key}")->toArray();
                            $set("permissions_group_{$key}", $state ? $groupPermissions : []);

                            if ($state) {
                                $allPermissions = array_merge($allPermissions, $groupPermissions);
                            }
                        }

                        $set('permissions_state', $state ? array_unique($allPermissions) : []);
                    })
        ]),

            Grid::make(3)->schema($permissionCards->toArray()),
        ]);
    }

    public static function mutateFormDataBeforeSave(array $data): array
    {
        return self::mutateFormDataBeforeCreate($data);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->searchable(),
                TextColumn::make('permissions.name')
                    ->badge()
                    ->label('Permissions')
                    ->separator(', '),
            ])
            ->defaultSort('name')
            ->actions([
                Tables\Actions\EditAction::make()
                    ->visible(fn ($record) => static::canEdit($record)),

                Tables\Actions\DeleteAction::make()
                    ->visible(fn ($record) => static::canDelete($record)),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->visible(fn () => static::canBulkDelete()),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListRoles::route('/'),
            'create' => Pages\CreateRole::route('/create'),
            'edit' => Pages\EditRole::route('/{record}/edit'),
        ];
    }
}
