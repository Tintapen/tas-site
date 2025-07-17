<?php

namespace App\Filament\Resources;

use App\Filament\Resources\JobResource\Pages;
use App\Filament\Resources\JobResource\RelationManagers;
use App\Models\Job;
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
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Actions\Action;
use App\Models\Department;
use App\Models\Reference;
use App\Models\ReferenceDetail;

class JobResource extends BaseResource
{
    protected static ?string $model = Job::class;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('title_id')
                    ->label('Title (ID)')
                    ->required()
                    ->disabled(fn (?Job $record) => self::isReadOnly($record)),
                TextInput::make('title_en')
                    ->label('Title (EN)')
                    ->required()
                    ->disabled(fn (?Job $record) => self::isReadOnly($record)),
                TextInput::make('location')
                    ->required()
                    ->disabled(fn (?Job $record) => self::isReadOnly($record)),
                Select::make('department_id')
                    ->label('Department')
                    ->options(function () {
                        return Department::where('isactive', 'Y')
                            ->pluck('name', 'id')
                            ->toArray();
                    })
                    ->searchable()
                    ->required()
                    ->disabled(fn (?Job $record) => self::isReadOnly($record)),
                RichEditor::make('description_id')
                    ->label('Description (ID)')
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
                    ->columnSpan(1)
                    ->disabled(fn (?Job $record) => self::isReadOnly($record)),
                RichEditor::make('description_en')
                    ->label('Description (EN)')
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
                    ->columnSpan(1)
                    ->disabled(fn (?Job $record) => self::isReadOnly($record)),
                Select::make('job_nature')
                    ->label('Job Nature')
                    ->options(function () {
                        $ref = Reference::where('name', 'Job Nature')
                            ->where('isactive', 'Y')
                            ->first();
                        if (!$ref) {
                            return [];
                        }

                        return ReferenceDetail::where('references_id', $ref->id)
                            ->where('isactive', 'Y')
                            ->orderBy('value', 'asc')
                            ->pluck('name', 'value')
                            ->toArray();
                    })
                    ->searchable()
                    ->required(),
                Select::make('job_type')
                    ->label('Job Type')
                    ->options(function () {
                        $ref = Reference::where('name', 'Job Type')
                            ->where('isactive', 'Y')
                            ->first();
                        if (!$ref) {
                            return [];
                        }

                        return ReferenceDetail::where('references_id', $ref->id)
                            ->where('isactive', 'Y')
                            ->orderBy('value', 'asc')
                            ->pluck('name', 'value')
                            ->toArray();
                    })
                    ->searchable()
                    ->required(),
                TextInput::make('vacancy')
                    ->label('Vacancy')
                    ->numeric()
                    ->minValue(1)
                    ->default(1)
                    ->required(),
                DatePicker::make('application_deadline')
                    ->label('Apply Deadline')
                    ->native(false)
                    ->closeOnDateSelection()
                    ->minDate(now())
                    ->displayFormat('d M Y')
                    ->disabled(fn (?Job $record) => self::isReadOnly($record))
                    ->required(),
                DatePicker::make('expired_at')
                    ->label('Expired Date')
                    ->native(false) // tampilkan kalender popup bawaan Filament
                    ->closeOnDateSelection() // otomatis tutup setelah pilih tanggal
                    ->minDate(now()) // opsional: biar nggak bisa pilih tanggal lampau
                    ->displayFormat('d M Y')
                    ->disabled(fn (?Job $record) => self::isReadOnly($record))
                    ->required(),
                Toggle::make('isactive')
                    ->label('Status')
                    ->inline(false)
                    ->default(true)
                    ->formatStateUsing(fn ($state) => $state === 'Y' || $state === true || is_null($state))
                    ->dehydrateStateUsing(fn ($state) => $state ? 'Y' : 'N')
                    ->disabled(fn (?Job $record) => self::isReadOnly($record)),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->label('Job ID')
                    ->formatStateUsing(fn ($state) => 'Job-' . $state),
                TextColumn::make('title_id')
                    ->label('Title (ID)')
                    ->searchable()
                    ->sortable()
                    ->wrap(),
                TextColumn::make('location')
                    ->searchable(),
                TextColumn::make('department.name')
                    ->label('Department')
                    ->searchable(),
                BadgeColumn::make('isactive')
                    ->label('Status')
                    ->formatStateUsing(fn (string $state): string => $state === 'Y' ? 'Active' : 'Nonactive')
                    ->color(fn (string $state): string => $state === 'Y' ? 'success' : 'danger'),
                TextColumn::make('expired_at')
                    ->label('Expired')
                    ->date('d M Y'),
                TextColumn::make('created_at')
                    ->label('Posted At')
                    ->date('d M Y')
                    ->sortable(),
                TextColumn::make('creator.name')
                    ->label('Posted By'),
            ])
            ->defaultSort('created_at')
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
                Action::make('duplicate')
                    ->label('Duplicate')
                    ->icon('heroicon-m-document-duplicate')
                    ->action(function ($record, $livewire) {
                        $new = $record->replicate();
                        $new->title_id = $record->title_id . ' (Copy)';
                        $new->title_en = $record->title_en . ' (Copy)';
                        $new->save();

                        $livewire->redirect(JobResource::getUrl('edit', ['record' => $new]));
                    })
                    ->requiresConfirmation()
                    ->color('gray')
                    ->visible(fn () => static::canCreate()),

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
            'index' => Pages\ListJobs::route('/'),
            'create' => Pages\CreateJob::route('/create'),
            'edit' => Pages\EditJob::route('/{record}/edit'),
        ];
    }

    protected static function isReadOnly(?Job $record): bool
    {
        return $record?->isexpired === 'Y';
    }
}
