<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MenuResource\Pages;
use App\Filament\Resources\MenuResource\RelationManagers;
use App\Models\Menu;
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
use App\Models\Reference;
use App\Models\ReferenceDetail;

class MenuResource extends BaseResource
{
    protected static ?string $model = Menu::class;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('label')->required(),
                Toggle::make('isactive')
                    ->label('Status')
                    ->inline(false)
                    ->default(true)
                    ->formatStateUsing(fn ($state) => $state === 'Y' || $state === true || is_null($state))
                    ->dehydrateStateUsing(fn ($state) => $state ? 'Y' : 'N'),
                TextInput::make('url')
                    ->label('URL / Route')
                    ->nullable(),
                Select::make('icon')
                    ->label('Icon')
                    ->options(function () {
                        $ref = Reference::where('name', 'Icon Menu')
                            ->where('isactive', 'Y')
                            ->first();
                        if (!$ref) {
                            return [];
                        }

                        return ReferenceDetail::where('references_id', $ref->id)
                            ->where('isactive', 'Y')
                            ->pluck('name', 'value')
                            ->toArray();
                    })
                    ->searchable(),
                Select::make('parent_id')
                    ->label('Parent Menu')
                    ->relationship(
                        name: 'parent',
                        titleAttribute: 'label',
                        modifyQueryUsing: function ($query) {
                            $query->whereNull('parent_id');
                        }
                    )
                    ->searchable()
                    ->preload(),
                TextInput::make('sort')->numeric()->default(0),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('label')
                    ->searchable(),
                TextColumn::make('parent.label')
                    ->label('Parent'),
                TextColumn::make('url'),
                TextColumn::make('icon'),
                TextColumn::make('sort')
                    ->sortable(),
                BadgeColumn::make('isactive')
                    ->label('Status')
                    ->formatStateUsing(fn (string $state): string => $state === 'Y' ? 'Active' : 'Nonactive')
                    ->color(fn (string $state): string => $state === 'Y' ? 'success' : 'danger'),
            ])
            ->defaultSort('label')
            ->filters([
                SelectFilter::make('isactive')
                    ->label('Status')
                    ->options([
                        'Y' => 'Active',
                        'N' => 'Nonactive',
                    ]),
            ])
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

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMenus::route('/'),
            'create' => Pages\CreateMenu::route('/create'),
            'edit' => Pages\EditMenu::route('/{record}/edit'),
        ];
    }
}
