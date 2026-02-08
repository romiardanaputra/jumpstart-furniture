<div class="max-w-screen-xl mx-auto py-12 px-4 sm:px-6 lg:px-8 space-y-12">
    {{-- Form Section --}}
    <x-ui.card title="{{ $title_form }}" description="Enter the details of the furniture piece and manage its variations.">
        <form wire:submit.prevent="storeOrUpdateProduct" class="space-y-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <x-ui.input label="Product Name" wire:model.defer="product_name" name="product_name" placeholder="e.g. Minimalist Sofa" required />
                <x-ui.input label="Product Type" wire:model.defer="product_type" name="product_type" placeholder="e.g. Seating" required />
                
                <div class="space-y-2">
                    <label class="text-sm font-medium leading-none">Category</label>
                    <select wire:model="category_id" class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background placeholder:text-muted-foreground focus:outline-none focus:ring-2 focus:ring-ring focus:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50">
                        <option value="">Select Category</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->category_id }}">{{ $category->category_name }}</option>
                        @endforeach
                    </select>
                </div>

                <x-ui.input label="Vendor" wire:model.defer="product_vendor" name="product_vendor" placeholder="Manufacturer Name" />
                <x-ui.input label="Availability" wire:model.defer="product_availability" name="product_availability" placeholder="In Stock" />
                <x-ui.input label="Rating" type="number" step="0.1" max="5" wire:model.defer="product_rating" name="product_rating" placeholder="5.0" />
                
                <x-ui.input label="Base Price (Rp)" type="number" wire:model.defer="product_price" name="product_price" placeholder="0" required />
                <x-ui.input label="Discount (%)" type="number" wire:model.defer="product_discount" name="product_discount" placeholder="0" />
                <x-ui.input label="Tags" wire:model.defer="product_tags" name="product_tags" placeholder="modern, wood" />
            </div>

            <x-ui.input label="Short Description" wire:model.defer="product_short_description" name="product_short_description" />
            <x-ui.input label="Long Description" wire:model.defer="product_long_description" name="product_long_description" />
            <x-ui.input label="Shipping & Returns" wire:model.defer="product_shipping_and_return" name="product_shipping_and_return" />

            <hr class="border-border">

            {{-- Variations Section --}}
            <div class="space-y-6">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-semibold">Product Variations (SKUs)</h3>
                    <x-ui.button type="button" wire:click="addSku" variant="outline" size="sm">
                        + Add Variation
                    </x-ui.button>
                </div>

                @if(empty($skus))
                    <div class="text-center py-8 border-2 border-dashed border-border rounded-lg text-muted-foreground">
                        No variations added. Click "Add Variation" to specify colors, materials, etc.
                    </div>
                @else
                    <div class="space-y-4">
                        @foreach($skus as $index => $sku)
                            <div wire:key="sku-{{ $index }}" class="p-6 bg-muted/20 border border-border rounded-lg relative space-y-4">
                                <button type="button" wire:click="removeSku({{ $index }})" class="absolute top-4 right-4 text-muted-foreground hover:text-destructive">
                                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path d="M6 18L18 6M6 6l12 12"/></svg>
                                </button>

                                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                                    <x-ui.input label="SKU Code" wire:model.defer="skus.{{ $index }}.sku_code" placeholder="ABC-123" required />
                                    <x-ui.input label="Price (Rp)" type="number" wire:model.defer="skus.{{ $index }}.sku_price" required />
                                    <x-ui.input label="Stock" type="number" wire:model.defer="skus.{{ $index }}.sku_stock" required />
                                    <x-ui.input label="Alert Threshold" type="number" wire:model.defer="skus.{{ $index }}.low_stock_threshold" required />
                                </div>

                                @if($availableAttributes)
                                    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
                                        @foreach($availableAttributes as $attr)
                                            <div class="space-y-2">
                                                <label class="text-xs font-medium">{{ $attr->attribute_name }}</label>
                                                <select wire:model.defer="skus.{{ $index }}.attribute_values" multiple class="flex min-h-[80px] w-full rounded-md border border-input bg-background px-3 py-2 text-xs ring-offset-background focus:outline-none focus:ring-2 focus:ring-ring disabled:cursor-not-allowed disabled:opacity-50">
                                                    @foreach($attr->values as $val)
                                                        <option value="{{ $val->attribute_value_id }}">{{ $val->value_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            {{-- Image Upload --}}
            <div class="space-y-2">
                <label class="text-sm font-medium leading-none">Product Main Image</label>
                <div class="relative flex min-h-[150px] cursor-pointer flex-col items-center justify-center rounded-md border border-dashed border-input bg-background px-6 py-10 text-center transition-colors hover:bg-accent/50 group">
                    <input id="product_image" type="file" class="absolute inset-0 z-10 opacity-0 cursor-pointer" name="product_image" wire:model="product_image" />
                    <div class="flex flex-col items-center justify-center space-y-2">
                        <svg class="h-8 w-8 text-muted-foreground group-hover:text-foreground" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        <p class="text-sm text-muted-foreground"><span class="font-semibold text-foreground">Click to upload</span> product thumbnail</p>
                    </div>
                </div>
                @error('product_image') <p class="text-xs text-destructive">{{ $message }}</p> @enderror
            </div>

            <div class="flex items-center gap-4 pt-4 border-t border-border">
                <x-ui.button type="submit">
                    {{ $title_form === 'Create Product' ? 'Save Product & SKUs' : 'Update Product & SKUs' }}
                </x-ui.button>
                @if ($title_form !== 'Create Product')
                    <x-ui.button wire:click="switchFormToCreate" type="button" variant="outline">Back to Create</x-ui.button>
                @endif
            </div>
        </form>
    </x-ui.card>

    {{-- Product Table Section --}}
    @if($title_form == 'Create Product')
        <x-ui.card title="Inventory Overview" description="Manage all basic product data. Edit a product to manage detailed variations.">
            <div class="relative overflow-x-auto">
                <table class="w-full text-sm text-left">
                    <thead class="bg-muted/50 text-muted-foreground uppercase text-xs font-semibold border-b border-border">
                        <tr>
                            <th class="px-6 py-4">Product</th>
                            <th class="px-6 py-4">Category</th>
                            <th class="px-6 py-4">Base Price</th>
                            <th class="px-6 py-4">Variations</th>
                            <th class="px-6 py-4 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-border">
                        @forelse($products as $product)
                            <tr class="hover:bg-muted/30 transition-colors">
                                <td class="px-6 py-4">
                                    <div class="font-medium text-foreground">{{ $product->product_name }}</div>
                                    <div class="text-xs text-muted-foreground">{{ $product->product_vendor }}</div>
                                </td>
                                <td class="px-6 py-4">
                                    <x-ui.badge variant="outline">{{ $product->category->category_name ?? 'N/A' }}</x-ui.badge>
                                </td>
                                <td class="px-6 py-4 font-medium">Rp {{ number_format($product->product_price, 0, ',', '.') }}</td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-primary/10 text-primary">
                                        {{ $product->skus->count() }} Variasi
                                    </span>
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
                                <td colspan="5" class="px-6 py-12 text-center text-muted-foreground">No products found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </x-ui.card>
    @endif
</div>
