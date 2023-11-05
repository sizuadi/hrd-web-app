<?php

namespace App\Livewire\Pages\Dashboard;

use Livewire\Attributes\Layout;
use Livewire\Component;
use App\Helpers\GlobalHelpers;

#[Layout('livewire.layouts.app')]
class DashboardIndex extends Component
{
    public function mount()
    {
        if (session("is_login") != 1) {
            session()->put('is_login', 1);
            $toastify = GlobalHelpers::toastifySuccess("Login berhasil");
            $this->dispatch(...$toastify);
        }
    }

    public function render()
    {
        return view('livewire.pages.dashboard.dashboard-index');
    }
}
