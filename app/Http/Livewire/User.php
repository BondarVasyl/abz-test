<?php

namespace App\Http\Livewire;

use App\Facades\FileUploader;
use App\Models\Position;
use App\Models\User as UserModel;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\View;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\TemporaryUploadedFile;

class User extends Component implements HasForms
{
    use InteractsWithForms;

    private $module = 'users';

    public UserModel $model;

    public function mount(): void
    {
        $data = $this->getFormModel()->attributesToArray();
        unset($data['id']);

        $this->form->fill($data);
    }

    protected function getFormModel(): UserModel
    {
        return $this->model;
    }

    public static function getFormSchema(): array
    {
        return [
            Grid::make(3)->schema([
                Section::make('General info')
                    ->schema([
                        Select::make('position_id')
                            ->relationship(
                                'position',
                                'name',
                            )
                            ->required()
                            ->searchable()
                            ->preload()
                            ->label('Position'),

                        TextInput::make('name')
                            ->required()
                            ->maxLength(255)
                            ->label('Name'),

                        TextInput::make('email')
                            ->required()
                            ->email()
                            ->maxLength(255)
                            ->label('Email'),

                        TextInput::make('phone')
                            ->required()
                            ->maxLength(255)
                            ->label('Phone'),

                        TextInput::make('registration_timestamp')
                            ->disabled()
                            ->maxLength(255)
                            ->label('Registration timestamp'),
                    ])->columnSpan(['lg' => 2]),

                Group::make()
                    ->schema([
                        Section::make('Image')
                            ->schema([
                                FileUpload::make('photo')
                                    ->getUploadedFileNameForStorageUsing(function (TemporaryUploadedFile $file) {
                                        return FileUploader::preparePath('uploads/image/original')
                                            . $file->getClientOriginalName();
                                    })
                                    ->imagePreviewHeight('250')
                                    ->panelAspectRatio('2:1')
                                    ->panelLayout('integrated')
                                    ->enableDownload()
                                    ->enableOpen()
                                    ->label('Image')
                                    ->required(),
                            ]),

                        Section::make('Password')
                            ->schema([
                                TextInput::make('password')
                                    ->password()
                                    ->dehydrateStateUsing(fn($state) => Hash::make($state))
                                    ->dehydrated(fn($state) => filled($state))
                                    ->maxLength(255),
                            ]),
                    ])
                    ->columnSpan(['lg' => 1]),

                View::make('filament.buttons.submit')
            ]),
        ];
    }

    public function render(): string
    {
        return <<<blade
            <div>
                <form wire:submit.prevent="submit">
                    {{ \$this->form }}
                </form>
            </div>
        blade;
    }

    public function submit()
    {
        $data = $this->form->getState();
        $data['position'] = Position::find($data['position_id'])?->name;

        if (!isset($data['registration_timestamp'])) {
            $data['registration_timestamp'] = now()->timestamp;
        }

        $this->model->fill($data);
        $this->model->save();

        return redirect()->to(route('home'))->with('success', 'Successfully saved');
    }
}
