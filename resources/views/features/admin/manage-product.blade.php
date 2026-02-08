<div class="max-w-screen-xl mx-auto py-12 px-4 sm:px-6 lg:px-8 space-y-12">
    {{-- Form Section --}}
    <x-ui.card title="{{ $title_form }}" description="Enter the details of the furniture piece to add or update it in the catalog.">
        <form wire:submit.prevent="storeOrUpdateProduct" class="space-y-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <x-ui.input label="Product Name" wire:model="product_name" name="product_name" placeholder="e.g. Minimalist Sofa" required />
                <x-ui.input label="Product Type" wire:model="product_type" name="product_type" placeholder="e.g. Seating" required />
                <x-ui.input label="SKU" wire:model="product_sku" name="product_sku" placeholder="ABC-123" required />
                
                <x-ui.input label="Vendor" wire:model="product_vendor" name="product_vendor" placeholder="Manufacturer Name" />
                <x-ui.input label="Availability" wire:model="product_availability" name="product_availability" placeholder="In Stock / Pre-order" />
                <x-ui.input label="Rating" type="number" step="0.1" max="5" wire:model="product_rating" name="product_rating" placeholder="5.0" />
                
                <x-ui.input label="Color" wire:model="product_color" name="product_color" placeholder="e.g. Oak, Matte Black" />
                <x-ui.input label="Price ($)" type="number" step="0.01" wire:model="product_price" name="product_price" placeholder="0.00" required />
                <x-ui.input label="Discount (%)" type="number" wire:model="product_discount" name="product_discount" placeholder="0" />
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <x-ui.input label="Tags" wire:model="product_tags" name="product_tags" placeholder="modern, wood, lounge" />
                <x-ui.input label="Material" wire:model="product_material" name="product_material" placeholder="Solid Oak, Fabric" />
            </div>

            <x-ui.input label="Short Description" wire:model="product_short_description" name="product_short_description" placeholder="A brief summary for listings..." />
            
            <x-ui.input label="Long Description" wire:model="product_long_description" name="product_long_description" placeholder="Detailed technical specs and features..." />

            <x-ui.input label="Shipping & Returns" wire:model="product_shipping_and_return" name="product_shipping_and_return" placeholder="Terms for shipping and returns..." />

            {{-- Image Upload --}}
            <div class="space-y-2">
                <label class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70">Product Image</label>
                <div class="relative flex min-h-[150px] cursor-pointer flex-col items-center justify-center rounded-md border border-dashed border-input bg-background px-6 py-10 text-center transition-colors hover:bg-accent/50 group">
                    <input id="product_image" type="file" class="absolute inset-0 z-10 opacity-0 cursor-pointer" name="product_image" wire:model="product_image" />
                    <div class="flex flex-col items-center justify-center space-y-2">
                        <svg class="h-8 w-8 text-muted-foreground group-hover:text-foreground" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        <p class="text-sm text-muted-foreground"><span class="font-semibold text-foreground">Click to upload</span> or drag and drop</p>
                        <p class="text-xs text-muted-foreground">PNG, JPG, WEBP up to 2MB</p>
                    </div>
                </div>
                @error('product_image') <p class="text-xs text-destructive">{{ $message }}</p> @enderror
            </div>

            <div class="flex items-center gap-4 pt-4">
                <x-ui.button type="submit">
                    {{ $title_form === 'Create Product' ? 'Create Product' : 'Update Product' }}
                </x-ui.button>
                @if ($title_form !== 'Create Product')
                    <x-ui.button wire:click="switchFormToCreate" type="button" variant="outline">Cancel</x-ui.button>
                @endif
            </div>
        </form>
    </x-ui.card>

    {{-- Product Table Section --}}
    @if($title_form == 'Create Product')
        <x-ui.card title="Inventory" description="List of all products currently in the database.">
            <div class="relative overflow-x-auto">
                <table class="w-full text-sm text-left">
                    <thead class="bg-muted/50 text-muted-foreground uppercase text-xs font-semibold border-b border-border">
                        <tr>
                            <th class="px-6 py-4">Product</th>
                            <th class="px-6 py-4">Vendor</th>
                            <th class="px-6 py-4">Price</th>
                            <th class="px-6 py-4">Availability</th>
                            <th class="px-6 py-4 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-border">
                        @forelse($products as $product)
                            <tr class="hover:bg-muted/30 transition-colors">
                                <td class="px-6 py-4">
                                    <div class="font-medium text-foreground">{{ $product->product_name }}</div>
                                    <div class="text-xs text-muted-foreground">{{ $product->product_type }}</div>
                                </td>
                                <td class="px-6 py-4 text-muted-foreground">{{ $product->product_vendor }}</td>
                                <td class="px-6 py-4 font-medium">${{ number_format($product->product_price, 2) }}</td>
                                <td class="px-6 py-4">
                                    <x-ui.badge variant="{{ str_contains(strtolower($product->product_availability), 'in stock') ? 'success' : 'outline' }}">
                                        {{ $product->product_availability }}
                                    </x-ui.badge>
                                </td>
                                <td class="px-6 py-4 text-right space-x-2">
                                    <button wire:click="editProduct({{ $product->product_id }})" class="p-2 rounded-md hover:bg-accent transition-colors">
                                        <svg class="h-4 w-4 text-muted-foreground hover:text-foreground" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                    </button>
                                    <button wire:click="deleteProduct({{ $product->product_id }})" class="p-2 rounded-md hover:bg-destructive/10 transition-colors group">
                                        <svg class="h-4 w-4 text-muted-foreground group-hover:text-destructive" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-12 text-center text-muted-foreground">No products found. Add your first furniture piece above.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </x-ui.card>
    @endif
</div>
