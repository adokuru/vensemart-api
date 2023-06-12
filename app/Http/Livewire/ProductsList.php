<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Product;
use App\Models\Products;
use App\Models\Country;
use App\Models\Category;
use Livewire\WithPagination;
use App\Exports\ProductsExport;
use Auth;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class ProductsList extends Component
{
    use WithPagination;

    public array $category = [];

    public array $countries = [];

    public array $selected = [];

    public string $sortColumn = 'products.product_title';

    public string $sortDirection = 'asc';

    public array $searchColumns = [
        'title' => '',
        'price' => ['', ''],
        'description' => '',
        'category_id' => 0,

        // 'country_id' => 0,
    ];

    protected $queryString = [
        'sortColumn' => [
            'except' => 'products.product_title'
        ],
        'sortDirection' => [
            'except' => 'asc',
        ],
    ];

    protected $listeners = ['delete', 'deleteSelected'];

    public function mount(): void
    {
        $this->category = Category::pluck('category_name', 'id')->toArray();
        // $this->countries = Country::pluck('name', 'id')->toArray();
    }

    public function getSelectedCountProperty(): int
    {
        return count($this->selected);
    }

    public function deleteConfirm($method, $id = null): void
    {
        $this->dispatchBrowserEvent(
            'swal:confirm', [
            'type'  => 'warning',
            'title' => 'Are you sure?',
            'text'  => '',
            'id'    => $id,
            'method' => $method,
        ]);
    }

    public function delete($id): void
    {
        $product = Products::findOrFail($id);

        if ($product->orders()->exists()) {
            $this->addError('orderexist', 'This product cannot be deleted, it already has orders');
            return;
        }

        $product->delete();
    }

    public function deleteSelected(): void
    {
        $products = Products::with('orders')->whereIn('id', $this->selected)->get();

        foreach ($products as $product) {
            if ($product->orders()->exists()) {
                $this->addError("orderexist",
                 "Product <span class='font-bold'>{$product->product_title}</span> 
                 cannot be deleted, it already has orders");
                return;
            }
        }

        $products->each->delete();

        $this->reset('selected');
    }

    public function sortByColumn($column): void
    {
        if ($this->sortColumn == $column) {
            $this->sortDirection = $this->sortDirection == 'asc' ? 'desc' : 'asc';
        } else {
            $this->reset('sortDirection');
            $this->sortColumn = $column;
        }
    }

    public function export($format): BinaryFileResponse
    {
        abort_if(! in_array($format, ['csv', 'xlsx', 'pdf']), Response::HTTP_NOT_FOUND);

        return Excel::download(new ProductsExport($this->selected), 'products.' . $format);
    }

    public function render(): View
    {
        $products = Products::query()->where('shop_id',auth()->user()->user_id)
        //    ->where('user_id', auth()->user()->id)
            // ->select(['products.*', 'countries.id as countryId', 'countries.name as countryName',])
            // ->join('countries', 'countries.id', '=', 'products.country_id')
            ->with('category');

        foreach ($this->searchColumns as $column => $value) {
            if (!empty($value)) {
                $products->when($column == 'price', function ($products) use ($value) {
                    if (is_numeric($value[0])) {
                        $products->where('products.product_price', '>=', $value[0] * 100);
                    }
                    if (is_numeric($value[1])) {
                        $products->where('products.product_price', '<=', $value[1] * 100);
                    }
                })
                ->when($column == 'id', fn($products) => $products->whereRelation('category', 'id', $value))
                // ->when($column == 'country_id', fn($products) => $products->whereRelation('country', 'id', $value))
                ->when($column == 'title', fn($products) => $products->where('products.product_' . $column, 'LIKE', '%' . $value . '%'));
            }
        }

        $products->orderBy($this->sortColumn, $this->sortDirection);

        return view('livewire.products-list',  [
            'products' => $products->orderBy('id', 'DESC')->paginate(10)
        ]);
    }
}
