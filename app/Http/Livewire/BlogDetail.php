<?php

namespace App\Http\Livewire;

use App\Models\Blog;
use Livewire\Component;

class BlogDetail extends Component
{
    public $blog;
    public $relatedProducts = [];

    public function mount($slug)
    {
        // Try to find by slug (new system) or ID (legacy fallback)
        $this->blog = \App\Models\Blog::with(['user', 'category'])
            ->where('blog_slug', $slug)
            ->orWhere('blog_id', $slug)
            ->firstOrFail();

        if ($this->blog->related_products) {
            $this->relatedProducts = \App\Models\Product::whereIn('product_id', $this->blog->related_products)
                ->where('product_availability', 'Available')
                ->limit(4)
                ->get();
        }
    }

    public function render()
    {
        return view('features.content.blog-detail');
    }
}
