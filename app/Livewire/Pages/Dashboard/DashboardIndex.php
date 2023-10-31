<?php

namespace App\Livewire\Pages\Dashboard;

use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('livewire.layouts.app')]
class DashboardIndex extends Component
{
    public function render()
    {
        return view('livewire.pages.dashboard.dashboard-index');
    }
}
