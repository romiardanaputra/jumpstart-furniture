<?php

namespace App\View\Components;

use App\Models\Blog as ModelsBlogs;
use Illuminate\View\Component;

class Blog extends Component
{
    public $blogs;

    public function __construct($blogs = null)
    {
        $this->blogs = $blogs ?? ModelsBlogs::latest()->paginate(6);
    }

    public function render()
    {
        return view('components.blog');
    }
}
