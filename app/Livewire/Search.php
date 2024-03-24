<?php

namespace App\Livewire;

use App\Models\Products;
use Livewire\Component;

class Search extends Component
{
    public $b, $text, $options = "", $visible;

    public $refresh = 0;

    public function search()
    {

        // dd($this->text);
        $this->render();

    }

    public function render()
    {
        // query the database
        $options = $this->options = Products::when($this->text, function ($q) {
            $q->where('product_name', 'like', '%' . $this->text . '%');
            $q->orWhere('tags', 'like', '%' . $this->text . '%');
        })->get();

        $search = $this->text;
        $show = $this->visible;

        return view('livewire.search', compact('options', 'search', 'show'));
    }
}
