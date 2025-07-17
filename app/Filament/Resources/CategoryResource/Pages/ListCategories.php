<?php

namespace App\Filament\Resources\CategoryResource\Pages;

use App\Filament\Resources\CategoryResource;
use App\Models\Category;
use App\Models\Principal;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Placeholder;
use Filament\Notifications\Notification;
use App\Services\ExcelImportService;

class ListCategories extends ListRecords
{
    protected static string $resource = CategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
            Actions\Action::make('import')
                    ->label('Import')
                    ->icon('heroicon-o-arrow-up-tray')
                    ->color('warning')
                    ->modalHeading('Import Data')
                    ->modalSubheading('Upload an Excel file to import category data.')
                    ->modalButton('Upload')
                    ->form([
                        Placeholder::make('template_link')
                            ->view('filament.forms.components.download-template-button', [
                                'route' => 'template.category.download',
                                'label' => '📥 Download Category Template'
                            ]),

                        FileUpload::make('file')
                            ->label('Excel File')
                            ->required()
                            ->acceptedFileTypes([
                                'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                                'application/vnd.ms-excel',
                            ])
                            ->disk('local')
                            ->directory('temp-imports')
                    ])
                    ->action(function (array $data) {
                        $filePath = storage_path('app/' . $data['file']);

                        $service = new ExcelImportService();
                        [$hasErrors, $errorFilePath] = $service->process(
                            filePath: $filePath,
                            rules: function ($data) {
                                // Aturan dasar untuk setiap baris data
                                $rules = [
                                    'name' => 'required',
                                    'level' => 'required|in:1,2', // Pastikan level valid
                                ];

                                // Menambahkan aturan berdasarkan level
                                if ($data['level'] == 1) {
                                    $rules['principals_id'] = 'required';
                                    $rules['name'] .= '|unique:categories,name,NULL,id,principals_id,' . $data['principals_id']; // unique di seluruh kategori
                                } elseif ($data['level'] > 1) {
                                    $rules['parent_id'] = 'required';
                                    $rules['name'] .= '|unique:categories,name,NULL,id,parent_id,' . $data['parent_id'];
                                }

                                return $rules;
                            },
                            onValid: function ($data) {
                                Category::create([
                                    'name'          => $data['name'],
                                    'isactive'      => $data['active'],
                                    'level'         => $data['level'],
                                    'principals_id' => $data['principals_id'],
                                    'parent_id'     => $data['parent_id']
                                ]);
                            },
                            menuName: 'category',
                            onBeforeValidate: function ($data) {
                                // Mapping principal dari string ke id
                                $principal = Principal::where('name', $data['principal'])->first();
                                $data['principals_id'] = $principal?->id ?? null;

                                // Mapping parent dari string ke id
                                $parent = Category::where('name', $data['parent'])->first();
                                $data['parent_id'] = $parent?->id ?? null;

                                return $data;
                            }
                        );

                        if ($hasErrors) {
                            return response()->download($errorFilePath)->deleteFileAfterSend(true);
                        }

                        Notification::make()
                            ->title('Import successful')
                            ->success()
                            ->send();
                    })->visible(fn () => static::$resource::canCreate())
        ];
    }
}
