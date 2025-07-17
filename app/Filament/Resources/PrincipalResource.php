<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PrincipalResource\Pages;
use App\Filament\Resources\PrincipalResource\RelationManagers;
use App\Models\Principal;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Support\Facades\Storage;

class PrincipalResource extends BaseResource
{
    protected static ?string $model = Principal::class;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->label('Name')
                    ->required(),
                Toggle::make('isactive')
                    ->label('Status')
                    ->inline(false)
                    ->default(true)
                    ->formatStateUsing(fn ($state) => $state === 'Y' || $state === true || is_null($state))
                    ->dehydrateStateUsing(fn ($state) => $state ? 'Y' : 'N'),
                FileUpload::make('logo')
                    ->label('Logo')
                    ->image()
                    ->imagePreviewHeight('100')
                    ->directory('principal-logos')
                    ->maxSize(1024)
                    ->required()
                    ->visibility('public')
                    ->previewable(fn ($state): ?string => is_string($state) ? Storage::disk('public')->url($state) : null),
                Textarea::make('description')
                    ->label('Description')
                    ->rows(3),
                TextInput::make('order')
                    ->label('Order')
                    ->numeric()
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable(),
                TextColumn::make('order'),
                TextColumn::make('slug'),
                ImageColumn::make('logo')
                    ->label('Logo')
                    ->disk('public')
                    ->visibility('public')
                    ->url(fn ($record) => Storage::disk('public')->url($record->logo))
                    ->circular(),
                TextColumn::make('description')
                    ->searchable(),
                BadgeColumn::make('isactive')
                    ->label('Status')
                    ->formatStateUsing(fn (string $state): string => $state === 'Y' ? 'Active' : 'Nonactive')
                    ->color(fn (string $state): string => $state === 'Y' ? 'success' : 'danger'),

            ])
            ->defaultSort('order')
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
            'index' => Pages\ListPrincipals::route('/'),
            'create' => Pages\CreatePrincipal::route('/create'),
            'edit' => Pages\EditPrincipal::route('/{record}/edit'),
        ];
    }
}
