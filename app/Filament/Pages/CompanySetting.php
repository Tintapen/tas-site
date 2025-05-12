<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use Filament\Forms;
use Filament\Forms\Form;
use App\Models\CompanySetting as CompanySettingModel;
use Filament\Notifications\Notification;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Actions;
use Filament\Forms\Components\Actions\Action;

class CompanySetting extends Page
{
    protected static string $view = 'filament.pages.company-setting';
    protected static ?string $title = 'Company Settings';

    public ?array $formData = [];

    public function mount(): void
    {
        $this->formData = CompanySettingModel::firstOrCreate([])->toArray();
    }

    public function form(Form $form): Form
    {
        return $form
            ->model(CompanySettingModel::class)
            ->statePath('formData')
            ->schema([
                Grid::make(2)->schema([
                    TextInput::make('name')
                            ->label('Company Name')
                            ->required(),
                    TextInput::make('email')
                            ->label('Email')
                            ->required(),
                    TextInput::make('phone')
                            ->label('Phone')
                            ->required(),
                    TextInput::make('nowhatsapp')
                            ->label('Whatsapp')
                            ->required(),
                    Textarea::make('address')
                            ->label('Address')
                            ->rows(3)
                            ->required(),
                    TextInput::make('email_job')
                            ->label('Job Email')
                            ->required(),
                ]),
                Actions::make([
                    Action::make('save')
                        ->label('Save Settings')
                        ->action(fn () => $this->save())
                        ->color('primary'),
                ])
            ]);
    }

    public function save(): void
    {
        try {
            $data = $this->form->getState();
            $this->form->validate();

            CompanySettingModel::updateOrCreate([], $data);

            Notification::make()
                ->title('Saved')
                ->success()
                ->send();
        } catch (\Exception $e) {
            // Menangkap error dan mencatatnya
            logger()->error('Failed to save company settings: '.$e->getMessage());

            Notification::make()
                ->title('Failed to save company settings.')
                ->body($e->getMessage())
                ->danger()
                ->send();
        }
    }

    public static function shouldRegisterNavigation(): bool
    {
        return false;
    }
}
