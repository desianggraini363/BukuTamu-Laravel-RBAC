<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use Filament\Forms\Form;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class Profile extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-user';

    protected static ?string $navigationLabel = 'Profile';

    protected static ?int $navigationSort = 3;

    protected static string $view = 'filament.pages.profile';

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill([
            'name' => Auth::user()->name,
            'nickname' => Auth::user()->nickname,
            'phone' => Auth::user()->phone,
        ]);
    }

    public function form(Form $form): Form
    {
        return $form
            ->statePath('data')
            ->schema([
                Grid::make(2)
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

                            ]),

                        Section::make('Ubah Password')
                            ->schema([

                                TextInput::make('current_password')
                                    ->label('Password Lama')
                                    ->password()
                                    ->helperText('Password lama harus diverifikasi')
                                    ->dehydrated(false),

                                TextInput::make('password')
                                    ->label('Password Baru')
                                    ->password()
                                    ->minLength(8)
                                    ->helperText('Password baru minimal 8 karakter')
                                    ->dehydrated(false),

                                TextInput::make('password_confirmation')
                                    ->label('Konfirmasi Password Baru')
                                    ->password()
                                    ->helperText('Password baru harus dikonfirmasi')
                                    ->dehydrated(false),

                            ]),

                    ]),
            ]);
    }

    public function save(): void
    {
        $user = Auth::user();

        $user->nickname = $this->data['nickname'];
        $user->phone = $this->data['phone'];

        if (! empty($this->data['password'])) {

            if (
                ! Hash::check(
                    $this->data['current_password'] ?? '',
                    $user->password
                )
            ) {
                $this->addError(
                    'data.current_password',
                    'Password lama tidak sesuai.'
                );

                return;
            }

            if (
                ($this->data['password'] ?? '')
                !==
                ($this->data['password_confirmation'] ?? '')
            ) {
                $this->addError(
                    'data.password_confirmation',
                    'Konfirmasi password tidak cocok.'
                );

                return;
            }

            $user->password = Hash::make(
                $this->data['password']
            );
        }

        $user->save();

        Notification::make()
            ->title('Profil berhasil diperbarui')
            ->success()
            ->send();
    }
}