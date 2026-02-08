<div class="max-w-screen-xl mx-auto py-12 px-4 sm:px-6 lg:px-8 space-y-12">
    {{-- Form Section --}}
    <x-ui.card title="{{ $title_page === 'Create' ? 'Create New Post' : 'Edit Post' }}" description="Share your thoughts, furniture care tips, or latest collection news with your audience.">
        <form wire:submit.prevent="storeOrUpdateBlog" class="space-y-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <x-ui.input label="Blog Title" wire:model="blog_title" name="blog_title" placeholder="e.g. 5 Tips to Maintain Your Oak Table" required />
                <x-ui.input label="Tags" wire:model="blog_tags" name="blog_tags" placeholder="maintenance, decor, wood" />
            </div>

            <x-ui.input label="Blog Description" wire:model="blog_long_description" name="blog_long_description" placeholder="Write the main content of your post here..." required />

            {{-- Image Upload --}}
            <div class="space-y-2">
                <label class="text-sm font-medium leading-none">Cover Image</label>
                <div class="relative flex min-h-[150px] cursor-pointer flex-col items-center justify-center rounded-md border border-dashed border-input bg-background px-6 py-10 text-center transition-colors hover:bg-accent/50 group">
                    <input id="blog_image" type="file" class="absolute inset-0 z-10 opacity-0 cursor-pointer" name="blog_image" wire:model="blog_image" />
                    <div class="flex flex-col items-center justify-center space-y-2">
                        <svg class="h-8 w-8 text-muted-foreground group-hover:text-foreground" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        <p class="text-sm text-muted-foreground"><span class="font-semibold text-foreground">Click to upload</span> or drag and drop</p>
                        <p class="text-xs text-muted-foreground">PNG, JPG up to 2MB</p>
                    </div>
                </div>
                @error('blog_image') <p class="text-xs text-destructive">{{ $message }}</p> @enderror
            </div>

            <div class="flex items-center gap-4 pt-4">
                <x-ui.button type="submit">
                    {{ $title_page === 'Create' ? 'Publish Post' : 'Update Post' }}
                </x-ui.button>
                @if ($title_page !== 'Create')
                    <x-ui.button wire:click="switchToCreate" type="button" variant="outline">Cancel</x-ui.button>
                @endif
            </div>
        </form>
    </x-ui.card>

    {{-- Blog List Section --}}
    @if($title_page == 'Create')
        <x-ui.card title="Recent Posts" description="Manage your published blog content and draft history.">
            <div class="relative overflow-x-auto">
                <table class="w-full text-sm text-left">
                    <thead class="bg-muted/50 text-muted-foreground uppercase text-xs font-semibold border-b border-border">
                        <tr>
                            <th class="px-6 py-4">Title</th>
                            <th class="px-6 py-4">Description</th>
                            <th class="px-6 py-4">Author</th>
                            <th class="px-6 py-4 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-border">
                        @forelse($blogs as $blog)
                            <tr class="hover:bg-muted/30 transition-colors">
                                <td class="px-6 py-4">
                                    <div class="font-medium text-foreground">{{ $blog->blog_title }}</div>
                                    <div class="flex flex-wrap gap-1 mt-1">
                                        @foreach(explode(',', $blog->blog_tags) as $tag)
                                            <span class="text-[10px] bg-accent px-1.5 py-0.5 rounded text-accent-foreground">{{ trim($tag) }}</span>
                                        @endforeach
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-muted-foreground max-w-xs truncate">
                                    {{ $blog->blog_long_description }}
                                </td>
                                <td class="px-6 py-4 text-muted-foreground">
                                    {{ $blog->user->first_name }} {{ $blog->user->last_name }}
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
                                <td colspan="4" class="px-6 py-12 text-center text-muted-foreground">No blog posts found. Start writing your first story above.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </x-ui.card>
    @endif
</div>
