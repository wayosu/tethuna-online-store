<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Catalog extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'category_id',
        'description',
        'image',
        'price',
        'stock',
        'fabric',
    ];

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['category'] ?? false, function($query, $category) {
            $category = Category::where('slug', request('category'))->first();
            if ($category) {
                $query->where('category_id', $category->id);
            }
        });

        $query->when($filters['search'] ?? false, function($query, $search) {
            return $query->where('name', 'like', '%' . $search . '%')
                        ->orWhere('price', 'like', '%' . $search . '%');
        });

        $query->when($filters['category_product'] ?? false, function($query, $category_product) {
            return $query->whereHas('category', function($query) use ($category_product) {
                $query->where('slug', $category_product);
            });
        });

        return $query; // Always return the modified query
    }


    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function catalogImages()
    {
        return $this->hasMany(CatalogImage::class);
    }
}
