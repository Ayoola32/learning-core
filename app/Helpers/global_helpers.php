<?php


use App\Models\Cart;


// Convert minutes to hours and minutes
if (!function_exists('minutesToHoursAndMinutes')) {
    function minutesToHoursAndMinutes(int $minutes) {
    $hours = floor($minutes / 60);
    $remainingMinutes = $minutes % 60;
    return sprintf('%d Hrs  %02d Min', $hours, $remainingMinutes);
    }
}

// Calculate cart total

if(!function_exists('cartTotal')){
    function cartTotal(){
        $total = 0;
        $cart = Cart::where('user_id', auth()->id())->get();

        foreach ($cart as $item) {
            if($item->course->discount > 0){
                // $discountedPrice = $item->course->price - ($item->course->price * ($item->course->discount / 100));
                $discountedPrice = $item->course->price - $item->course->discount;
                $total += $discountedPrice;
            }else {
                $total += $item->course->price;
            }
        }

        return $total;
    }
}

// Total cart items
if(!function_exists('cartItemsCount')){
    function cartItemsCount(){
        $cart = Cart::where('user_id', auth()->id())->get();
        return $cart->count();
    }
}