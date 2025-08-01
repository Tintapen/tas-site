<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GalleryResource\Pages;
use App\Filament\Resources\GalleryResource\RelationManagers;
use App\Models\Gallery;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Support\Facades\Storage;
use App\Models\ReferenceDetail;
use App\Models\Reference;

class GalleryResource extends BaseResource
{
    protected static ?string $model = Gallery::class;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('group')
                    ->label('Gallery Group')
                    ->options(function () {
                        $ref = Reference::where('name', 'Gallery Group')
                            ->where('isactive', 'Y')
                            ->first();
                        if (!$ref) {
                            return [];
                        }

                        return ReferenceDetail::where('references_id', $ref->id)
                            ->where('isactive', 'Y')
                            ->whereNot('name', 'All')
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
                FileUpload::make('logo')
                    ->label('Logo')
                    ->image()
                    ->imagePreviewHeight('100')
                    ->directory('gallery-logos')
                    ->maxSize(1024)
                    ->required()
                    ->visibility('public')
                    ->previewable(fn ($state): ?string => is_string($state) ? Storage::disk('public')->url($state) : null),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('group')->searchable(),
                ImageColumn::make('logo')
                    ->label('Logo')
                    ->disk('public')
                    ->visibility('public')
                    ->url(fn ($record) => Storage::disk('public')->url($record->logo))
                    ->circular(),
                BadgeColumn::make('isactive')
                    ->label('Status')
                    ->formatStateUsing(fn (string $state): string => $state === 'Y' ? 'Active' : 'Nonactive')
                    ->color(fn (string $state): string => $state === 'Y' ? 'success' : 'danger'),
            ])
            ->defaultSort('group')
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
            'index' => Pages\ListGalleries::route('/'),
            'create' => Pages\CreateGallery::route('/create'),
            'edit' => Pages\EditGallery::route('/{record}/edit'),
        ];
    }
}
