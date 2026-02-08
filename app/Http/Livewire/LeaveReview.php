<?php

namespace App\Http\Livewire;

use App\Contracts\Services\ReviewServiceInterface;
use Livewire\Component;
use Livewire\WithFileUploads;

class LeaveReview extends Component
{
    use WithFileUploads;

    public $product_id;
    public $rating = 5;
    public $comment;
    public $images = [];
    
    protected $rules = [
        'rating' => 'required|integer|min:1|max:5',
        'comment' => 'required|string|min:10',
        'images.*' => 'nullable|image|max:5120', // Max 5MB per image
    ];

    public function mount($productId)
    {
        $this->product_id = $productId;
    }

    public function submitReview(ReviewServiceInterface $reviewService)
    {
        $this->validate();

        $processedImages = [];
        if (!empty($this->images)) {
            $processedImages = $reviewService->processReviewImages($this->images);
        }

        $reviewService->storeReview([
            'user_id' => auth()->id(),
            'product_id' => $this->product_id,
            'rating' => $this->rating,
            'comment' => $this->comment,
            'images' => $processedImages,
        ]);

        $this->reset(['rating', 'comment', 'images']);
        session()->flash('message', 'Thank you for your review!');
        
        $this->emit('reviewAdded');
    }

    public function render()
    {
        return view('livewire.leave-review');
    }
}
