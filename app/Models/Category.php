<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'name', 'slug'
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    /**
     * get slug value and replace space by '-'
     * @return string
     */
    public function setSlugAttribute($value) {
        $this->attributes['slug'] = str_replace(' ', '-', strtolower($value));
    }
}
