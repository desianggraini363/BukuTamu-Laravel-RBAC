<?php

namespace App\Filament\Pages\Auth;

use Filament\Pages\Auth\Register as BaseRegister;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;

class CustomRegister extends BaseRegister
{
    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->label('Nama Lengkap')
                    ->placeholder('Moci Moci')
                    ->required()
                    ->maxLength(255),
                TextInput::make('nickname')
                    ->label('Nama Panggilan')
                    ->placeholder('moci')
                    ->required()
                    ->maxLength(255),
                $this->getEmailFormComponent()
                    ->placeholder('mocimoci@email.com')
                    ->validationMessages([
                        'unique' => 'Email ini sudah terdaftar di sistem Buku Tamu.',
                    ]),
                TextInput::make('phone')
                    ->label('Nomor Telepon')
                    ->placeholder('081234567890')
                    ->tel()
                    ->required(),
                $this->getPasswordFormComponent()
                    ->rules(['min:8']), // Sesuai ketentuan: minimal 8 karakter
                $this->getPasswordConfirmationFormComponent(),
            ]);
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // Ketentuan: Role otomatis diset menjadi user biasa saat registrasi
        $data['role'] = 'user';
        return $data;
    }
}