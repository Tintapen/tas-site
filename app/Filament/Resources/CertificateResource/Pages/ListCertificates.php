<?php

namespace App\Filament\Resources\CertificateResource\Pages;

use App\Filament\Resources\CertificateResource;
use App\Models\Certificate;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Placeholder;
use Filament\Notifications\Notification;
use App\Services\ExcelImportService;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class ListCertificates extends ListRecords
{
    protected static string $resource = CertificateResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
            Actions\Action::make('import')
                    ->label('Import')
                    ->icon('heroicon-o-arrow-up-tray')
                    ->color('warning')
                    ->modalHeading('Import Data')
                    ->modalSubheading('Upload an Excel file to import certificate data.')
                    ->modalButton('Upload')
                    ->form([
                        Placeholder::make('template_link')
                            ->view('filament.forms.components.download-template-button', [
                                'route' => 'template.certificate.download',
                                'label' => '📥 Download Certificate Template'
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
                                    'name' => 'required|unique:certificates,name'
                                ];

                                return $rules;
                            },
                            onValid: function ($data) {
                                Certificate::create([
                                    'name'          => $data['name'],
                                    'isactive'      => $data['active'],
                                    'logo'          => $data['logo'] ?? null
                                ]);
                            },
                            menuName: 'certificate',
                            onBeforeValidate: function ($data) {
                                if (!empty($data['link_logo'])) {
                                    // Mendownload gambar dari URL
                                    $imageContent = Http::get($data['link_logo']);

                                    // Periksa apakah gambar berhasil diunduh
                                    if ($imageContent->successful()) {
                                        // Simpan gambar ke storage Laravel (misalnya dalam folder 'public/images')
                                        $imageName = basename($data['link_logo']);
                                        $imagePath = 'images/' . $imageName;
                                        Storage::disk('public')->put($imagePath, $imageContent->body());

                                        // Tambahkan path gambar ke data untuk disimpan ke database
                                        $data['logo'] = $imagePath;
                                    }
                                }

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
