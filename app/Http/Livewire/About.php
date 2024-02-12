<?php

namespace App\Http\Livewire;

use Livewire\Component;

class About extends Component
{
    public static function getUrl()
    {
        $current_url = url()->current();

        return $current_url;
    }

    public function render()
    {
        return view('livewire.about');
    }
}
