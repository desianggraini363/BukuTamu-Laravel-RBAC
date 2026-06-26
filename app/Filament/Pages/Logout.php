<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use Illuminate\Support\Facades\Auth;

class Logout extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-arrow-right-on-rectangle';

    protected static ?string $navigationLabel = 'Logout';

    protected static ?int $navigationSort = 4;

    protected static ?string $slug = 'logout';

    protected static string $view = 'filament.pages.logout';

    public function mount(): void
    {
        Auth::logout();

        session()->invalidate();
        session()->regenerateToken();

        redirect('/admin/login');
    }
}