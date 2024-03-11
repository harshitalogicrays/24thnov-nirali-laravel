<?php

namespace App\Http\Livewire\Frontend;

use Livewire\Component;
use App\Models\Products;

class Cproducts extends Component
{   
    public $category,$products,$priceInput;
    protected $queryString = ['priceInput' => ['except' => '', 'as' => 'price']];

    public function mount($category,$products){
        $this->categroy=$category;$this->products=$products;
    }
    public function render()
    {
        // return view('livewire.frontend.cproducts',['products'=>$this->products,'category'=>$this->category]);

        $this->products=Products::where('category_id',$this->category->id)
                        ->when($this->priceInput,function($q){
                            $q->when($this->priceInput=="below1000",function($q1){
                                $q1->where('selling_price',"<","1000")->where('selling_price','>=','100');
                            })->when($this->priceInput=="below2000",function($q1){
                                $q1->where('selling_price',"<","2000")->where('selling_price','>=','1000');
                            })->when($this->priceInput=="below3000",function($q1){
                                $q1->where('selling_price',"<","3000")->where('selling_price','>=','2000');
                            });
                            })->where('status','1')->get();

        return view('livewire.frontend.cproducts',['products'=>$this->products,'category'=>$this->category]);
    }
}
