<?php

namespace App\Filament\Pages\Auth;

use Filament\Pages\Auth\EditProfile;
use Filament\Forms\Form;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Illuminate\Support\Facades\Hash;

class CustomEditProfile extends EditProfile
{
    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make([
                    'default' => 1,
                    'md' => 2,
                ])
                    ->schema([

                        Section::make('Informasi Akun')
                            ->schema([
                                TextInput::make('name')
                                    ->label('Nama Lengkap')
                                    ->disabled(),

                                TextInput::make('nickname')
                                    ->label('Nama Panggilan')
                                    ->required(),

                                TextInput::make('phone')
                                    ->label('Nomor Telepon')
                                    ->required(),
                            ])
                            ->columnSpan(1),

                        Section::make('Ubah Password')
                            ->schema([
                                TextInput::make('current_password')
                                    ->label('Password Lama')
                                    ->password()
                                    ->dehydrated(false)
                                    ->helperText('Masukkan password lama')
                                    ->rule(function () {
                                        return function ($attribute, $value, $fail) {
                                            if (
                                                filled(request('password')) &&
                                                ! Hash::check($value, auth()->user()->password)
                                            ) {
                                                $fail('Password lama tidak sesuai.');
                                            }
                                        };
                                    }),

                                TextInput::make('password')
                                    ->label('Password Baru')
                                    ->password()
                                    ->confirmed()
                                    ->minLength(8)
                                    ->helperText('Minimal 8 karakter'),

                                TextInput::make('password_confirmation')
                                    ->label('Konfirmasi Password Baru')
                                    ->password(),
                            ])
                            ->columnSpan(1),

                    ]),
            ]);
    }
}