<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Blog as ModelsBlogs;

class Blog extends Component
{
    use WithPagination;

    protected $paginationTheme = 'tailwind';

    public static function getUrl()
    {
        return url()->current();
    }

    public function render()
    {
        return view('features.content.blog', [
            'blogs' => ModelsBlogs::latest()->paginate(9),
        ]);
    }
}
