<?php

namespace App\Http\Livewire;

use App\Models\Blog as ModelsBlogs;
use Livewire\Component;

class Blog extends Component
{
    public static function getUrl()
    {
        $current_url = url()->current();

        return $current_url;
    }

    public function render()
    {
        return view('livewire.blog', [
            'blogs' => ModelsBlogs::all(),
        ]);
    }
}
