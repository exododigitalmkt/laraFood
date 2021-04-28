<?php 

namespace App\Repositories;

use App\Repositories\Contracts\ProductRepositoryInterface;
use Illuminate\Support\Facades\DB;

class ProductRepository implements ProductRepositoryInterface
{
    protected $product;

    public function __construct()
    {
        $this->product = 'products';
    }

    public function getProductsByTenantId(int $idTenant, array $categories)
    {
        return DB::table($this->product)
                    ->join('category_product', 'category_product.product_id', '=', 'products.id')
                    ->join('categories', 'categories.id', '=', 'category_product.category_id')
                    ->where('products.tenant_id', $idTenant)
                    ->where('categories.tenant_id', $idTenant)
                    ->where(function ($query) use ($categories) {
                        if ($categories != [])
                            $query->whereIn('categories.url', $categories);
                    })
                    ->get();
    }

    public function getProductByFlag(string $flag)
    {
        return DB::table($this->product)
                    ->where('flag', $flag)
                    ->first();
    }
    
}