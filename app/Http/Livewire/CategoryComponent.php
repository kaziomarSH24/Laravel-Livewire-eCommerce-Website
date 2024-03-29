<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;
use Cart;
class CategoryComponent extends Component
{
    public $sorting;
    public $productParPage;
    public $category_slug;

    public function mount($category_slug)
    {
        $this->sorting = 'default';
        $this->productParPage = 12;
        $this->category_slug = $category_slug;
    }

    public function store($product_id, $product_name, $product_price)
    {
        Cart::add($product_id,$product_name,1,$product_price)->associate('App\Models\Product');
        session()->flash('msg','Item added in Cart');
        session()->flash('msg-type','success');
        return redirect()->route('product.cart');
    }

    use WithPagination;
    public function render()
    {
        $category = Category::whereSlug($this->category_slug)->first();

        $category_id = $category->id;
        $category_name = $category->name;

        if($this->sorting == 'date'){
            $products = Product::where('category_id',$category_id)->orderBy('created_at','DESC')->paginate($this->productParPage);
        }elseif($this->sorting == 'price'){
            $products = Product::where('category_id',$category_id)->orderBy('regular_price','ASC')->paginate($this->productParPage);
        }elseif($this->sorting == 'price-desc'){
            $products = Product::where('category_id',$category_id)->orderBy('regular_price','DESC')->paginate($this->productParPage);
        }else{
            $products = Product::where('category_id',$category_id)->paginate($this->productParPage);
        }

        $categories = Category::all();
        
        return view('livewire.category-component',compact('products','categories','category_name'))->layout('layouts.base');
    }
    public function paginationView()
    {
        return 'pagination-links';
    }
}
