<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $cartItems = Cart::where('user_id', Auth::guard('web')->user()->id)->with('course')->get();
        return view('frontend.pages.cart.cart-index', compact('cartItems'));
    }

    public function addToCart(int $courseId)
    {
        // Check if the user is authenticated and other conditions before adding to cart
        if (!Auth::guard('web')->check()) {
            return response()->json([
                'success' => false,
                'message' => 'You need to be logged in to add a course to the cart.',
            ], 401);
        }
        if (Cart::where('user_id', Auth::guard('web')->user()->id)->where('course_id', $courseId)->exists()) {
            return response()->json([
                'message' => 'This course is already in your cart.',
            ]);
        }
        if (!Course::where('id', $courseId)->exists()) {
            return response()->json([
                'success' => false,
                'message' => 'Course not found.',
            ], 404);
        }
        if (Course::where('id', $courseId)->where('status', 'inactive')->exists()) {
            return response()->json([
                'success' => false,
                'message' => 'This course is currently inactive.',
            ], 403);
        }
        if (Course::where('id', $courseId)->where('price', 0)->exists()) {
            return response()->json([
                'success' => false,
                'message' => 'This course is free and cannot be added to the cart.',
            ], 400);
        }

        $course = Course::findOrFail($courseId);
        $cart = new Cart();
        $cart->user_id = Auth::guard('web')->user()->id;
        $cart->course_id = $course->id;
        $cart->save();

        return response()->json([
            'success' => true,
            'message' => 'Course added to cart successfully!',
        ]);
    }

    public function removeFromCart(int $courseId)
    {
        // Check if the user is authenticated and other conditions before removing from cart
        if (!Auth::guard('web')->check()) {
            return response()->json([
                'success' => false,
                'message' => 'You need to be logged in to remove a course from the cart.',
            ], 401);
        }

        $cart = Cart::where('user_id', Auth::guard('web')->user()->id)->where('course_id', $courseId)->first();
        if (!$cart) {
            return response()->json([
                'success' => false,
                'message' => 'This course is not in your cart.',
            ], 404);
        }

        // Check if the user has permission to remove this item
        $cart->delete();
        return response()->json([
            'success' => true,
            'message' => 'Course removed from cart successfully!',
        ]);
    }
}
