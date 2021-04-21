<?php

namespace App\Models;

use App\Tenant\Traits\TenantTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    use HasFactory;
    use TenantTrait;

    protected $fillable = ['identify', 'description'];

    /**
     * Get Search
     */
    public function search($filter = null)
    {
        $results = $this->where('identify', 'LIKE', "%{$filter}%")
                    ->orWhere('description', 'LIKE', "%{$filter}%")
                    ->latest()
                    ->paginate();
        return $results;

    }
}
