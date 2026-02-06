<?php

namespace App\Http\Livewire;

use App\Contracts\Services\BlogServiceInterface;
use Illuminate\Http\UploadedFile;
use Livewire\Component;
use Livewire\WithFileUploads;

class ManageBlog extends Component
{
    use WithFileUploads;

    protected BlogServiceInterface $blogService;

    public ?int $blog_id = null;

    public string $blog_title = '';

    public string $blog_tags = '';

    public string $blog_long_description = '';

    /** @var UploadedFile|string|null */
    public $blog_image = null;

    public string $title_page = 'Create';

    protected array $rules = [
        'blog_title' => ['required', 'string', 'max:200'],
        'blog_tags' => ['required', 'string', 'max:100'],
        'blog_long_description' => ['required', 'string'],
        'blog_image' => ['nullable', 'image', 'mimes:jpg,png,jpeg,gif,svg', 'file', 'max:1024'],
    ];

    /**
     * Boot lifecycle hook for dependency injection
     */
    public function boot(BlogServiceInterface $blogService): void
    {
        $this->blogService = $blogService;
    }

    /**
     * Store or update blog
     */
    public function storeOrUpdateBlog(): mixed
    {
        $this->validate();

        $imageFile = $this->blog_image instanceof UploadedFile ? $this->blog_image : null;

        if ($this->blog_id) {
            // Update existing blog
            $this->blogService->updateBlog($this->blog_id, [
                'blog_title' => $this->sanitizeInput($this->blog_title),
                'blog_tags' => $this->sanitizeInput($this->blog_tags),
                'blog_long_description' => $this->blog_long_description,
            ], $imageFile);

            session()->flash('message', 'Blog updated successfully!');
        } else {
            // Create new blog
            $this->blogService->createBlog([
                'user_id' => auth()->user()->id,
                'blog_title' => $this->sanitizeInput($this->blog_title),
                'blog_tags' => $this->sanitizeInput($this->blog_tags),
                'blog_long_description' => $this->blog_long_description,
            ], $imageFile);

            session()->flash('message', 'Blog created successfully!');
        }

        return to_route('manage-blog');
    }

    /**
     * Edit blog - populate form with existing data
     */
    public function editBlog(int $id): void
    {
        $this->blog_id = $id;
        $blog = $this->blogService->getBlog($id);

        if ($blog) {
            $this->blog_title = $blog->blog_title;
            $this->blog_tags = $blog->blog_tags;
            $this->blog_long_description = $blog->blog_long_description;
            $this->title_page = 'Edit ' . $blog->blog_title;
        }
    }

    /**
     * Reset form to create mode
     */
    public function switchToCreate(): void
    {
        $this->reset([
            'blog_id',
            'blog_title',
            'blog_tags',
            'blog_long_description',
            'blog_image',
        ]);
        $this->title_page = 'Create';
    }

    /**
     * Delete a blog
     */
    public function deleteBlog(int $id): mixed
    {
        $this->blogService->deleteBlog($id);
        session()->flash('message', 'Blog deleted successfully!');

        return to_route('manage-blog');
    }

    /**
     * Sanitize input string
     */
    protected function sanitizeInput(string $value): string
    {
        return strip_tags(trim($value));
    }

    /**
     * Render the component
     */
    public function render()
    {
        return view('features.admin.manage-blog', [
            'blogs' => $this->blogService->getAllBlogs(),
        ]);
    }
}
