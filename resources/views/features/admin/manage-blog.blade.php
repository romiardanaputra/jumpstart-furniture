<div class="max-w-screen-xl mx-auto py-12 px-4 sm:px-6 lg:px-8 space-y-12">
    @push('head')
        <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
        <script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>
    @endpush

    {{-- Form Section --}}
    <x-ui.card title="{{ $title_page === 'Create' ? 'Create New Inspiration' : 'Edit Inspiration' }}" description="Share furniture care tips or design trends. Use 'Shop the Look' to link products.">
        <form wire:submit.prevent="storeOrUpdateBlog" class="space-y-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <x-ui.input label="Article Title" wire:model="blog_title" name="blog_title" placeholder="e.g. 7 Tips for a Minimalist Living Room" required />
                
                <div class="space-y-2">
                    <label class="text-sm font-medium leading-none">Category</label>
                    <select wire:model="blog_category_id" class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50">
                        <option value="">Select Category</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->category_id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <x-ui.input label="Tags (comma separated)" wire:model="blog_tags" name="blog_tags" placeholder="minimalist, wood, tips" />
                <x-ui.input label="Meta Description (SEO)" wire:model="meta_description" name="meta_description" placeholder="Short summary for Google (max 160 chars)" />
            </div>

            {{-- Quill Editor for Long Description --}}
            <div class="space-y-2" wire:ignore>
                <label class="text-sm font-medium leading-none">Content</label>
                <div 
                    x-data="{
                        content: @entangle('blog_long_description').defer,
                        quill: null
                    }"
                    x-init="
                        quill = new Quill($refs.editor, {
                            theme: 'snow',
                            modules: {
                                toolbar: [
                                    [{ 'header': [2, 3, false] }],
                                    ['bold', 'italic', 'underline', 'strike'],
                                    ['link', 'blockquote', 'code-block', 'image'],
                                    [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                                    ['clean']
                                ]
                            }
                        });
                        quill.root.innerHTML = content;
                        quill.on('text-change', function () {
                            content = quill.root.innerHTML;
                        });
                    "
                >
                    <div x-ref="editor" class="min-h-[300px] bg-white text-black rounded-b-md"></div>
                </div>
                @error('blog_long_description') <p class="text-xs text-destructive">{{ $message }}</p> @enderror
            </div>

            {{-- Shop the Look Selector --}}
            <div class="space-y-4">
                <label class="text-sm font-medium leading-none flex items-center gap-2">
                    <svg class="h-4 w-4 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" /></svg>
                    Shop the Look (Related Products)
                </label>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-3 max-h-60 overflow-y-auto p-4 border rounded-md bg-muted/20">
                    @foreach($availableProducts as $product)
                        <label class="flex items-center space-x-2 p-2 rounded-md hover:bg-accent/50 cursor-pointer border border-transparent hover:border-border transition-all">
                            <input type="checkbox" wire:model="related_products" value="{{ $product->product_id }}" class="rounded border-gray-300 text-primary focus:ring-primary shadow-sm">
                            <span class="text-xs truncate" title="{{ $product->product_name }}">{{ $product->product_name }}</span>
                        </label>
                    @endforeach
                </div>
                <p class="text-[10px] text-muted-foreground italic">Selected products will appear as a 'Recommended Products' section in the article.</p>
            </div>

            {{-- Image Upload --}}
            <div class="space-y-2">
                <label class="text-sm font-medium leading-none">Cover Image</label>
                <div class="relative flex min-h-[150px] cursor-pointer flex-col items-center justify-center rounded-md border border-dashed border-input bg-background px-6 py-10 text-center transition-colors hover:bg-accent/50 group">
                    <input id="blog_image" type="file" class="absolute inset-0 z-10 opacity-0 cursor-pointer" name="blog_image" wire:model="blog_image" />
                    <div class="flex flex-col items-center justify-center space-y-2">
                        @if ($blog_image && !is_string($blog_image))
                            <img src="{{ $blog_image->temporaryUrl() }}" class="h-20 w-32 object-cover rounded shadow-sm mb-2" />
                        @endif
                        <svg class="h-8 w-8 text-muted-foreground group-hover:text-foreground" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        <p class="text-sm text-muted-foreground"><span class="font-semibold text-foreground">Change image</span> or drag and drop</p>
                    </div>
                </div>
                @error('blog_image') <p class="text-xs text-destructive">{{ $message }}</p> @enderror
            </div>

            <div class="flex items-center gap-4 pt-4">
                <x-ui.button type="submit">
                    {{ $title_page === 'Create' ? 'Publish Inspiration' : 'Update Article' }}
                </x-ui.button>
                @if ($title_page !== 'Create')
                    <x-ui.button wire:click="switchToCreate" type="button" variant="outline">Cancel</x-ui.button>
                @endif
            </div>
        </form>
    </x-ui.card>

    {{-- Blog List Section --}}
    @if($title_page == 'Create')
        <x-ui.card title="Recent Articles" description="Manage your inspiration gallery and SEO content.">
            <div class="relative overflow-x-auto">
                <table class="w-full text-sm text-left">
                    <thead class="bg-muted/50 text-muted-foreground uppercase text-xs font-semibold border-b border-border">
                        <tr>
                            <th class="px-6 py-4">Article</th>
                            <th class="px-6 py-4 text-center">Commerce Tags</th>
                            <th class="px-6 py-4">URL Slug</th>
                            <th class="px-6 py-4 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-border">
                        @forelse($blogs as $blog)
                            <tr class="hover:bg-muted/30 transition-colors">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        @if($blog->blog_image)
                                            <img src="{{ asset('storage/' . $blog->blog_image) }}" class="h-10 w-10 object-cover rounded" />
                                        @endif
                                        <div>
                                            <div class="font-medium text-foreground">{{ $blog->blog_title }}</div>
                                            <span class="text-[10px] text-muted-foreground bg-muted px-1.5 py-0.5 rounded">{{ $blog->category->name ?? 'Uncategorized' }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-primary/10 text-primary hover:bg-primary/20 transition-colors">
                                        {{ count($blog->related_products ?? []) }} Products
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-xs font-mono text-muted-foreground">
                                    /blog/{{ $blog->blog_slug }}
                                </td>
                                <td class="px-6 py-4 text-right space-x-2">
                                    <button wire:click="editBlog({{ $blog->blog_id }})" class="p-2 rounded-md hover:bg-accent transition-colors">
                                        <svg class="h-4 w-4 text-muted-foreground hover:text-foreground" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                    </button>
                                    <button wire:click="deleteBlog({{ $blog->blog_id }})" class="p-2 rounded-md hover:bg-destructive/10 transition-colors group">
                                        <svg class="h-4 w-4 text-muted-foreground group-hover:text-destructive" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-12 text-center text-muted-foreground">Empty gallery. Start inspiring your customers!</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </x-ui.card>
    @endif
</div>
