<?php

namespace App\Filament\Resources;

use App\Filament\Resources\NewsResource\Pages;
use App\Filament\Resources\NewsResource\RelationManagers;
use App\Models\News;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Forms\Components\FileUpload;
use Illuminate\Support\Facades\Storage;

class NewsResource extends BaseResource
{
    protected static ?string $model = News::class;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('title_id')
                    ->label('Title (ID)')
                    ->required(),
                TextInput::make('title_en')
                    ->label('Title (EN)')
                    ->required(),
                RichEditor::make('content_id')
                    ->label('Content (ID)')
                    ->required()
                    ->fileAttachmentsDirectory('attachments')
                    ->fileAttachmentsVisibility('public')
                    ->columnSpan(1),
                RichEditor::make('content_en')
                    ->label('Content (EN)')
                    ->required()
                    ->fileAttachmentsDirectory('attachments')
                    ->fileAttachmentsVisibility('public')
                    ->columnSpan(1),
                DatePicker::make('posted_at')
                    ->label('Posted Date')
                    ->native(false) // tampilkan kalender popup bawaan Filament
                    ->closeOnDateSelection() // otomatis tutup setelah pilih tanggal
                    ->minDate(now()) // opsional: biar nggak bisa pilih tanggal lampau
                    ->displayFormat('d M Y'), // opsional: format tampilan
                Toggle::make('isactive')
                    ->label('Status')
                    ->inline(false)
                    ->default(true)
                    ->formatStateUsing(fn ($state) => $state === 'Y' || $state === true || is_null($state))
                    ->dehydrateStateUsing(fn ($state) => $state ? 'Y' : 'N'),
                FileUpload::make('thumbnail')
                    ->label('Thumbnail')
                    ->image()
                    ->imagePreviewHeight('100')
                    ->directory('news')
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
                TextColumn::make('title_id')
                    ->label('Title (ID)')
                    ->searchable()
                    ->sortable()
                    ->wrap(),
                TextColumn::make('posted_at')
                    ->label('Posted')
                    ->date('d M Y'),
                ImageColumn::make('thumbnail')
                    ->label('Thumbnail')
                    ->disk('public')
                    ->visibility('public')
                    ->url(fn ($record) => Storage::disk('public')->url($record->logo))
                    ->circular(),
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
            'index' => Pages\ListNews::route('/'),
            'create' => Pages\CreateNews::route('/create'),
            'edit' => Pages\EditNews::route('/{record}/edit'),
        ];
    }
}
