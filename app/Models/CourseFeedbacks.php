<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseFeedbacks extends Model
{
    use HasFactory;
    protected $fillable = ['course_id', 'admin_id', 'instructor_id', 'status', 'feedback'];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }
}
