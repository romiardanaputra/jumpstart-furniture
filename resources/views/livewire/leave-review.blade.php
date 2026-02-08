<div class="bg-card border border-border rounded-xl p-8 shadow-sm mt-10">
    <h3 class="text-2xl font-semibold mb-6">Leave a Review</h3>

    @if (session()->has('message'))
        <div class="bg-green-500/10 border border-green-500/20 text-green-500 p-4 rounded-lg mb-6">
            {{ session('message') }}
        </div>
    @endif

    <form wire:submit.prevent="submitReview" class="space-y-6">
        <div>
            <label class="block text-sm font-medium mb-3">Rating</label>
            <div class="flex items-center space-x-2">
                @for ($i = 1; $i <= 5; $i++)
                    <button type="button" wire:click="$set('rating', {{ $i }})" 
                        class="focus:outline-none transition-transform hover:scale-110">
                        <svg class="h-8 w-8 {{ $rating >= $i ? 'text-yellow-400 fill-yellow-400' : 'text-muted stroke-muted' }}" 
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                        </svg>
                    </button>
                @endfor
            </div>
            @error('rating') <span class="text-destructive text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="comment" class="block text-sm font-medium mb-3">Your Comment</label>
            <textarea id="comment" wire:model.defer="comment" rows="4" 
                class="w-full bg-muted/20 border border-border rounded-lg p-4 focus:ring-2 focus:ring-primary focus:border-transparent outline-none transition-all"
                placeholder="Share your experience with this piece of furniture..."></textarea>
            @error('comment') <span class="text-destructive text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium mb-3">Add Photos (Max 5MB each)</label>
            <div class="flex flex-wrap gap-4 mb-4">
                @if ($images)
                    @foreach ($images as $image)
                        <div class="relative w-24 h-24 rounded-lg overflow-hidden border border-border">
                            <img src="{{ $image->temporaryUrl() }}" class="w-full h-full object-cover">
                        </div>
                    @endforeach
                @endif
                
                <label class="w-24 h-24 flex flex-col items-center justify-center border-2 border-dashed border-border rounded-lg cursor-pointer hover:border-primary/50 transition-colors">
                    <svg class="h-8 w-8 text-muted-foreground" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    <span class="text-[10px] text-muted-foreground mt-1">Upload</span>
                    <input type="file" wire:model="images" multiple class="hidden" accept="image/*">
                </label>
            </div>
            @error('images.*') <span class="text-destructive text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="flex justify-end">
            <x-ui.button type="submit" size="lg">
                Submit Review
            </x-ui.button>
        </div>
    </form>
</div>
