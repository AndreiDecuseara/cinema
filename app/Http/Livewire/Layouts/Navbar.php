<?php

namespace App\Http\Livewire\Layouts;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Navbar extends Component
{

    public function render()
    {
        return view('livewire.layouts.navbar');
    }
}
