<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [
        'id',
    ];

    protected $dates = [
        'deleted_at'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function restaurants()
    {
        return $this->belongsToMany(Restaurant::class, 'category_tags')->using(CategoryTag::class);
    }
    
    public function user()
    {
        return $this->BelongsTo(User::class);
    }
}
