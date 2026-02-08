<?php

namespace App\Http\Livewire;

use App\Models\Blog;
use Livewire\Component;

class BlogDetail extends Component
{
    public $blog;

    public function mount($blog_id)
    {
        $this->blog = Blog::with('user')->findOrFail($blog_id);
    }

    public function render()
    {
        return view('features.content.blog-detail');
    }
}
