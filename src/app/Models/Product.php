<?php

namespace App\Models;

use App\Tenant\Traits\TenantTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    use TenantTrait;

    protected $fillable = ['title', 'flag', 'image', 'price', 'description'];

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    /**
     * Get Search
     */
    public function search($filter = null)
    {
        $results = $this->where('title', 'LIKE', "%{$filter}%")
                    ->orWhere('description', 'LIKE', "%{$filter}%")
                    ->latest()
                    ->paginate(10);
        return $results;

    }

    /**
     * Categories not liked with this product
     */
    public function categoriesAvailable($filter = null)
    {
        $categories = Category::whereNotIn('categories.id', function($query){
            $query->select('category_product.category_id');
            $query->from('category_product');
            $query->whereRaw("category_product.product_id={$this->id}");
        })
        ->where(function ($queryFilter) use ($filter){
            if ($filter)
                $queryFilter->where('categories.name', 'LIKE', "%{$filter}%");
        })
        ->paginate();

        return $categories;
    }
}
