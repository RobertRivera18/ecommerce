<?php

namespace App\Livewire\Admin\Products;

use App\Models\Family;
use App\Models\Product;
use Livewire\Component;
use App\Models\Category;
use App\Models\Subcategory;
use Livewire\WithFileUploads;
use Livewire\Attributes\Computed;

class ProductCreate extends Component
{
    use WithFileUploads;

    public $families;
    public $image;
    public $family_id = '';
    public $category_id = '';
    public $product = [
               'sku' => '',
               'name' => '',
               'description' => '',
               'image_path' => '',
               'price' => '',
               'subcategory_id' => ''
    ];


    public function mount()
    {
        $this->families = Family::all();
    }

    public function updatedFamilyId($value)
    {

        $this->category_id = '';
        $this->product['subcategory_id'] = '';
    }


    public function updatedCategoryId($value)
    {
        $this->product['subcategory_id'] = '';
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
            'image' => 'required|image|max:1024',
            'product.sku' => 'required|unique:products,sku',
            'product.name' => 'required|max:255',
            'product.description' => 'nullable',
            'product.price' => 'required|numeric|min:0',
            'product.subcategory_id' => 'required|exists:subcategories,id'
        ],[],[
            'product.sku' => 'sku',
            'product.name' => 'Nombre',
            'product.description' => 'Descripción',
            'product.price' => 'Precio',
            'product.subcategory_id' => 'Subcategoria'
        ]);
        $this->product['image_path'] = $this->image->store('products');
        $product = Product::create($this->product);
        session()->flash('swal',[
            'icon'=>'success',
            'title'=>'¡Bien Hecho!',
            'text'=>'Producto creado correctamente'
        ]);
        return redirect()->route('admin.products.edit', $product);
    }

    public function render()
    {
        return view('livewire.admin.products.product-create');
    }
}
