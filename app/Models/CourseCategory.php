<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseCategory extends Model
{
    use HasFactory;
    public function subCategories()
    {
        return $this->hasMany(CourseSubCategory::class, 'category_id');
    }
}
