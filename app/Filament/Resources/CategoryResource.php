<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CategoryResource\Pages;
use App\Filament\Resources\CategoryResource\RelationManagers;
use App\Models\Category;
use App\Models\Principal;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Filters\SelectFilter;
use App\Models\ReferenceDetail;
use App\Models\Reference;
use Illuminate\Validation\Rule;
use Closure;
use Illuminate\Database\Eloquent\Model;

class CategoryResource extends BaseResource
{
    protected static ?string $model = Category::class;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->required()
                    ->rules([
                        function (Forms\Get $get) {
                            return function (string $attribute, $value, Closure $fail) use ($get) {
                                $name = $value;
                                $level = (int) $get('level');
                                $parentId = $get('parent_id');
                                $principal = $get('principals_id');
                                $recordId = $get('id'); // untuk edit form

                                $query = Category::query()
                                    ->where('name', $name);

                                if ($parentId) {
                                    $query->where('parent_id', $parentId);
                                } else {
                                    $query->whereNull('parent_id')
                                          ->where('principals_id', $principal);
                                }

                                if ($recordId) {
                                    $query->where('id', '!=', $recordId);
                                }

                                if ($query->exists()) {
                                    $fail("Category '$name' already exists in the same parent.");
                                }
                            };
                        },
                    ]),
                Toggle::make('isactive')
                    ->label('Status')
                    ->inline(false)
                    ->default(true)
                    ->formatStateUsing(fn ($state) => $state === 'Y' || $state === true || is_null($state))
                    ->dehydrateStateUsing(fn ($state) => $state ? 'Y' : 'N')
                    ->required(),
                Select::make('level')
                    ->label('Category Level')
                    ->options(function () {
                        $ref = Reference::where('name', 'Category Level')
                            ->where('isactive', 'Y')
                            ->first();
                        if (!$ref) {
                            return [];
                        }

                        return ReferenceDetail::where('references_id', $ref->id)
                            ->where('isactive', 'Y')
                            ->pluck('value', 'value')
                            ->toArray();
                    })
                    ->live()
                    ->afterStateUpdated(function (Forms\Set $set, Forms\Get $get, $state) {
                        // Reset principal if level > 1
                        if ((int) $state > 1) {
                            $set('parent_id', null);
                            $set('principals_id', null);
                        }
                    })
                    ->searchable()
                    ->required(),
                Select::make('parent_id')
                    ->label('Parent Category')
                    ->options(function (Forms\Get $get, ?Category $record) {
                        $level = $get('level');

                        // Jika level 1, tidak perlu parent, maka return kosong
                        if (!$level || $level == 1) {
                            return [];
                        }

                        // Query untuk level di bawah kategori yang dipilih
                        $query = Category::where('level', $level - 1)
                            ->where('isactive', 'Y');

                        // Jika sedang edit, dan ada parent_id, kecualikan kategori yang sudah dipilih
                        if ($record) {
                            $selectedParentId = $record->id;

                            // Mengecualikan kategori yang dipilih
                            if ($selectedParentId) {
                                $query->where('id', '!=', $selectedParentId);
                            }
                        }

                        return $query->pluck('name', 'id');
                    })
                    ->required(fn (Forms\Get $get) => (int)$get('level') > 1)
                    ->rules(function (Forms\Get $get) {
                        return [
                            function ($attribute, $value, $fail) use ($get) {
                                $level = (int) $get('level'); // Atur level dari form

                                if ($level > 1 && !$value) {
                                    $fail('Parent must be filled in for levels greater than 1.');
                                }

                                if ($level <= 1 && $value) {
                                    $fail('Level 1 cannot have a parent.');
                                }
                            }
                        ];
                    })
                    ->reactive()
                    ->visible(fn (Forms\Get $get) => (int)$get('level') > 1)
                    ->afterStateUpdated(fn ($state, Forms\Set $set) => $set('parent_id', $state)) // trigger refresh agar validasi ke-refresh
                    ->searchable()
                    ->preload(),
                Select::make('principals_id')
                    ->label('Principal')
                    ->options(function (Forms\Get $get) {
                        if ((int) $get('level') == 1) {
                            return Principal::where('isactive', 'Y')
                                ->pluck('name', 'id')
                                ->toArray();
                        }

                        return [];
                    })
                    ->searchable()
                    ->visible(fn (Forms\Get $get) => (int)$get('level') == 1)
                    ->required(function (Forms\Get $get) {
                        return (int) $get('level') == 1;
                    })
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable(),
                TextColumn::make('level'),
                TextColumn::make('principal.name')
                    ->label('Principal'),
                TextColumn::make('parent.name')
                    ->label('Parent'),
                BadgeColumn::make('isactive')
                    ->label('Status')
                    ->formatStateUsing(fn (string $state): string => $state === 'Y' ? 'Active' : 'Nonactive')
                    ->color(fn (string $state): string => $state === 'Y' ? 'success' : 'danger'),
            ])
            ->defaultSort('name')
            ->defaultSort('level')
            ->filters([
                SelectFilter::make('isactive')
                    ->label('Status')
                    ->options([
                        'Y' => 'Active',
                        'N' => 'Nonactive',
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCategories::route('/'),
            'create' => Pages\CreateCategory::route('/create'),
            'edit' => Pages\EditCategory::route('/{record}/edit'),
        ];
    }
}
