<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model

{
    use HasFactory;
    function instructor()
    {
       return $this->hasOne(User::class, 'id', 'instructor_id');
    }

    public function feedbacks()
    {
        return $this->hasMany(CourseFeedbacks::class);
    }

}
