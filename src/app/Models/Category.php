<?php

namespace App\Models;

use App\Tenant\Traits\TenantTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    use TenantTrait;

    protected $fillable = ['name', 'url', 'description'];

    /**
     * Get Search
     */
    public function search($filter = null)
    {
        $results = $this->where('name', 'LIKE', "%{$filter}%")
                    ->orWhere('description', 'LIKE', "%{$filter}%")
                    ->latest()
                    ->paginate(10);
        return $results;

    }

    public function products()
    {
       return $this->belongsToMany(Product::class);
    }
}
