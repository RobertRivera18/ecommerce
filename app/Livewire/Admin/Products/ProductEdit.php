<?php

namespace App\Livewire\Admin\Products;

use App\Models\Family;
use App\Models\Product;
use Livewire\Component;
use App\Models\Category;
use App\Models\Subcategory;
use Livewire\WithFileUploads;
use Livewire\Attributes\Computed;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\On;

class ProductEdit extends Component
{

    use withFileUploads;

    public $product;
    public $families;
    public $image;
    public $family_id = '';
    public $category_id = '';

    public $productEdit;

    public function mount($product)
    {
        $this->productEdit = $product->only('sku', 'name', 'description', 'image_path', 'price', 'stock', 'subcategory_id');
        $this->families = Family::all();
        $this->category_id = $product->subcategory->category->id;
        $this->family_id = $product->subcategory->category->family_id;
    }


    public function updatedFamilyId($value)
    {
        $this->category_id = '';
        $this->productEdit['subcategory_id'] = '';
    }

    public function updatedCategoryId($value)
    {
        $this->productEdit['subcategory_id'] = '';
    }

    #[Computed()]
    public function categories()
    {
        return Category::where('family_id', $this->family_id)->get();
    }

    #[computed()]
    public function subcategories()
    {
        return Subcategory::where('category_id', $this->category_id)->get();
    }

    public function store()
    {
        $this->validate([
            'image' => 'nullable|image|max:1024',
            'product.name' => 'required|max:255',
            'product.description' => 'nullable',
            'product.price' => 'required|numeric|min:0',
            'product.stock' => 'required',
            'product.subcategory_id' => 'required|exists:subcategories,id'
        ]);

        if ($this->image) {
            Storage::delete($this->productEdit['image_path']);
            $this->product['image_path'] = $this->image->store('products');
        }
        $this->product->update($this->productEdit);
        session()->flash('swal', [
            'icon' => 'success',
            'title' => '¡Producto Actualizado!',
            'text' => 'Producto actualizado correctamente'
        ]);
        return redirect()->route('admin.products.edit', $this->product);
    }

    #[On('variant-generate')]
    public function updateProduct()
    {
        $this->product = $this->product->fresh();
    }


    public function render()
    {
        return view('livewire.admin.products.product-edit');
    }
}
