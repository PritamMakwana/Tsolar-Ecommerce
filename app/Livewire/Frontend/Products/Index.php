<?php

namespace App\Livewire\Frontend\Products;

use App\Models\Tags;
use App\Models\Brand;
use Livewire\Component;
use App\Models\Category;
use App\Models\Products;
use Illuminate\Http\Request;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';


    public $products, $brands, $tags, $categoryInputs = [], $brandInputs = [], $tagInputs = [], $fillterPopularInputs, $fillterLatestInputs, $priceInput;

    // protected $listeners = ['refreshComponent'=>'$refresh'];
    // #[On(refreshComponet)]


    public $refresh = 0;


    protected $queryString = [
        'brandInputs' => ['except' => '', 'as' => 'brand'],
        'categoryInputs' => ['except' => '', 'as' => 'category'],
        'tagInputs' => ['except' => '', 'as' => 'tag'],
        'fillterLatestInputs' => ['except' => '', 'as' => 'latest'],
        'fillterPopularInputs' => ['except' => '', 'as' => 'popular'],
        'priceInput' => ['except' => '', 'as' => 'price']
    ];
    public function render()
    {

        // $this->products = Products::when($this->brandInputs, function ($q) {
        //     $q->whereIn('brand_id', $this->brandInputs);
        // })->get();

        $productShow = Products::query()->with('sizeQuantity');

        if (count($this->brandInputs) || count($this->categoryInputs) || count($this->tagInputs) || $this->fillterLatestInputs || $this->fillterPopularInputs || isset($this->priceInput)) {
            // dd("here");
            $productShow->when($this->brandInputs, function ($q) {
                $q->whereIn('brand_id', $this->brandInputs);
            })->when($this->categoryInputs, function ($q) {
                $q->whereIn('category_id', array_keys($this->categoryInputs));
            })->when($this->tagInputs, function ($q) {
                $q->whereJsonContains('tags', $this->tagInputs);
            })->when($this->fillterLatestInputs, function ($q) {
                $q->where('latest', 1);
            })->when($this->fillterPopularInputs, function ($q) {
                $q->where('visible', 'true');
            })->when($this->priceInput, function ($q) {

                $q->when($this->priceInput == 'high-to-low', function ($q2) {
                    $q2->orderBy('price', 'DESC');
                });

                $q->when($this->priceInput == 'low-to-Hight', function ($q2) {
                    $q2->orderBy('price', 'ASC');
                });

            });

        }

        $categories = Category::all();
        $this->brands = Brand::all();
        $this->tags = Tags::all();

        $productShow = $productShow->paginate(6);
        // dd($productShow);

        $brands = $this->brands;
        $tags = $this->tags;


        // return view('livewire.frontend.products.index', [
        //     'productShow' => $this->products,
        //     'categories' => $this->categories,
        //     'brands' => $this->brands,
        //     'tags' => $this->tags,

        // ]);
        return view('livewire.frontend.products.index', compact('productShow', 'categories', 'brands', 'tags'));
    }



    public function searchFillter()
    {
        $this->resetPage();
    }

    public function updatedCategoryInputs()
    {

        $this->categoryInputs = array_filter(
            $this->categoryInputs,
            function ($category) {
                // dd($category != false);
                return $category != false;
            }
        );

    }

    public function updatedBrandInputs()
    {

        $this->brandInputs = array_filter(
            $this->brandInputs,
            function ($brand) {
                // dd($brand != false);
                return $brand != false;
            }
        );

    }

    public function updatedTagInputs()
    {

        $this->tagInputs = array_filter(
            $this->tagInputs,
            function ($tag) {
                // dd($tag != false);
                return $tag != false;
            }
        );

    }

    public function updatedFillterPopularInputs()
    {
        // remove the popular=flase from the url if not checked
        if (!$this->fillterPopularInputs) {
            $this->fillterPopularInputs = null;
        }
    }

    public function updatedFillterLatestInputs()
    {
        // remove the latest=flase from the url if not checked
        if (!$this->fillterLatestInputs) {
            $this->fillterLatestInputs = null;
        }
    }

    public function updatedPriceInput()
    {
        $this->resetPage();
    }

    public function updated($property)
    {
        // dd($this->categoryInputs);
        // $this->resetPage();

        // if ($property == 'brandInputs' || $property == 'categories' || $property == 'brands' || $property == 'tags' || $property == 'categoryInputs' || $property == 'brandInputs' || $property == 'tagInputs' || $property == 'fillterPopularInputs' || $property == 'fillterLatestInputs' || $property == 'priceInput') {
        // dd($property);
        // $this->resetPage();
        // }

        // if ($property == 'priceInput') {
        //     $this->render();
        // }

    }
}
