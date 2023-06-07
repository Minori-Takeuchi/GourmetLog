<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CategoryTag extends Model
{
    use HasFactory;
    
    protected $table = 'category_tags';

    protected $guarded = [
        'id',
    ];
    
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}
