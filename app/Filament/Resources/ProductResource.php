<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Models\Category;
use App\Models\Product;
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
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductResource extends BaseResource
{
    protected static ?string $model = Product::class;

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
                Select::make('categories_id')
                    ->label('Category')
                    ->options(function () {
                        return Category::with([
                            'parent',
                            'parent.parent',
                            'parent.parent.parent',
                            'parent.parent.parent.parent'
                        ])
                        ->leaf()
                        ->get()
                        ->mapWithKeys(fn ($cat) => [$cat->id => $cat->fullName()])
                        ->sortKeys()
                        ->toArray();
                    })
                    ->searchable()
                    ->required(),
                FileUpload::make('logo')
                    ->label('Logo')
                    ->image()
                    ->imagePreviewHeight('100')
                    ->directory('product-logos')
                    ->maxSize(1024)
                    ->required()
                    ->visibility('public')
                    ->previewable(fn ($state): ?string => is_string($state) ? Storage::disk('public')->url($state) : null),
                RichEditor::make('content_id')
                    ->label('Detail (ID)')
                    ->required()
                    ->toolbarButtons([
                        'bold',
                        'italic',
                        'underline',
                        'strike',
                        'bulletList',
                        'orderedList',
                        'link',
                        'h2',
                        'h3',
                        'blockquote',
                        'codeBlock',
                    ])
                    ->columnSpan(1),
                RichEditor::make('content_en')
                    ->label('Detail (EN)')
                    ->required()
                    ->toolbarButtons([
                        'bold',
                        'italic',
                        'underline',
                        'strike',
                        'bulletList',
                        'orderedList',
                        'link',
                        'h2',
                        'h3',
                        'blockquote',
                        'codeBlock',
                    ])
                    ->columnSpan(1),
                Toggle::make('isfeatured')
                    ->label('Featured')
                    ->inline(false)
                    ->default(false)
                    ->formatStateUsing(fn ($state) => $state === 'Y' || $state === true || is_null($state))
                    ->dehydrateStateUsing(fn ($state) => $state ? 'Y' : 'N'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable(),
                TextColumn::make('categories_id')
                    ->label('Category')
                    ->getStateUsing(fn ($record) => optional($record->category)->fullName() ?? '-'),
                TextColumn::make('content_id')
                    ->label('Detail')
                    ->formatStateUsing(fn ($state) => Str::limit(strip_tags($state), 100))
                    ->wrap()
                    ->html(),
                ImageColumn::make('logo')
                    ->label('Logo')
                    ->disk('public')
                    ->visibility('public')
                    ->url(fn ($record) => Storage::disk('public')->url($record->logo))
                    ->circular(),
                BadgeColumn::make('isfeatured')
                    ->label('Featured')
                    ->formatStateUsing(fn (string $state): string => $state === 'Y' ? 'Yes' : 'No')
                    ->color(fn (string $state): string => $state === 'Y' ? 'success' : 'danger'),
                BadgeColumn::make('isactive')
                    ->label('Status')
                    ->formatStateUsing(fn (string $state): string => $state === 'Y' ? 'Active' : 'Nonactive')
                    ->color(fn (string $state): string => $state === 'Y' ? 'success' : 'danger'),
            ])
            ->defaultSort('name')
            ->filters([
                SelectFilter::make('isactive')
                    ->label('Status')
                    ->options([
                        'Y' => 'Active',
                        'N' => 'Nonactive',
                    ]),
                SelectFilter::make('isfeatured')
                    ->label('Featured')
                    ->options([
                        'Y' => 'Yes',
                        'N' => 'No',
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
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
