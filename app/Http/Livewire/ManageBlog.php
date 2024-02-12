<?php

namespace App\Http\Livewire;

use App\Models\Blog as ModelsBlogs;
use Livewire\Component;
use Livewire\WithFileUploads;

class ManageBlog extends Component
{
    use WithFileUploads;

    public $blog_title;

    public $blog_tags;

    public $blog_long_description;

    public $blog_image;

    public $blog_id;

    public $blog;

    public $title_page = 'Create';

    protected $rules = [
        'blog_title' => ['required'],
        'blog_tags' => ['required'],
        'blog_long_description' => ['required'],
        'blog_image' => ['image', 'mimes:jpg,png,jpeg,gif,svg', 'file', 'max:1000'],
    ];

    public function store_or_update_blog()
    {
        $this->validate();
        if ($this->blog_id) {
            $blog = ModelsBlogs::find($this->blog_id);
            $blog->update([
                'blog_title' => $this->blog_title,
                'blog_tags' => $this->blog_tags,
                'blog_long_description' => $this->blog_long_description,
                'blog_image' => $this->blog_image->store('blog_image'),
            ]);
        } else {
            ModelsBlogs::create([
                'user_id' => auth()->user()->id,
                'blog_title' => $this->blog_title,
                'blog_tags' => $this->blog_tags,
                'blog_long_description' => $this->blog_long_description,
                'blog_image' => $this->blog_image->store('blog_image'),
            ]);
        }

        return to_route('manage-blog');
    }

    public function edit_blog($id)
    {
        $this->blog_id = $id;
        $blog = ModelsBlogs::find($this->blog_id);
        $this->blog_title = $blog->blog_title;
        $this->title_page = 'Edit '.$blog->blog_title;
        $this->blog_tags = $blog->blog_tags;
        $this->blog_long_description = $blog->blog_long_description;
        $this->blog_image = $blog->blog_image;
    }

    public function switch_to_create()
    {
        $this->blog_id = '';
        $this->blog_title = '';
        $this->blog_tags = '';
        $this->blog_long_description = '';
        $this->blog_image = '';
        $this->title_page = 'Create';
    }

    public function delete_blog($id)
    {
        ModelsBlogs::where('blog_id', $id)->delete();

        return to_route('manage-blog');
    }

    public function render()
    {
        return view('livewire.manage-blog', [
            'blogs' => ModelsBlogs::all(),
        ]);
    }
}
