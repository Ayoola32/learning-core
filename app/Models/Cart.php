<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    //Course relationship
    /**
     * Get the course that belongs to the cart.
     */
    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    // User relationship
    /**
     * Get the user that owns the cart.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
