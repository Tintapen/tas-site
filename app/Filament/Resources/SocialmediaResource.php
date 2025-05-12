<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SocialmediaResource\Pages;
use App\Filament\Resources\SocialmediaResource\RelationManagers;
use App\Models\Socialmedia;
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

class SocialmediaResource extends BaseResource
{
    protected static ?string $model = Socialmedia::class;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('link')
                    ->label('Social Media')
                    ->options(function () {
                        $ref = Reference::where('name', 'Social Media')
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
                    ->searchable()
                    ->required(),
                Toggle::make('isactive')
                    ->label('Status')
                    ->inline(false)
                    ->default(true)
                    ->formatStateUsing(fn ($state) => $state === 'Y' || $state === true || is_null($state))
                    ->dehydrateStateUsing(fn ($state) => $state ? 'Y' : 'N'),
                TextInput::make('url')
                    ->label('URL')
                    ->required()
                    ->url(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('link')
                    ->getStateUsing(function ($record) {
                        return $record->referenceDetail->name ?? 'N/A';
                    })
                    ->searchable(),
                TextColumn::make('url')
                    ->wrap(),
                BadgeColumn::make('isactive')
                    ->label('Status')
                    ->formatStateUsing(fn (string $state): string => $state === 'Y' ? 'Active' : 'Nonactive')
                    ->color(fn (string $state): string => $state === 'Y' ? 'success' : 'danger'),
            ])
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
            'index' => Pages\ListSocialmedia::route('/'),
            'create' => Pages\CreateSocialmedia::route('/create'),
            'edit' => Pages\EditSocialmedia::route('/{record}/edit'),
        ];
    }
}
