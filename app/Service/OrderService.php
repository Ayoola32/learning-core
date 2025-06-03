<?php

namespace App\Service;

use App\Models\Cart;
use App\Models\Enrollment;
use App\Models\Order;
use App\Models\OrderItem;

class OrderService
{
    static function storeOrder(
        string $transactionId,
        int $buyerId,
        string $status,
        float $totalAmount,
        float $paidAmount,
        string $currency,
        string $paymentMethod,
    ) 
    {
        try {
            // Create a new order instance
            $order = new Order();
            $order->invoice_id = 'INV-LC-' . bin2hex(random_bytes(7));
            $order->transaction_id = $transactionId;
            $order->buyer_id = $buyerId;
            $order->status = $status;
            $order->total_amount = $totalAmount;
            $order->paid_amount = $paidAmount;
            $order->currency = $currency;
            $order->payment_method = $paymentMethod;

            // Save the order to the database
            $order->save();

            // save order items
            $cart = Cart::where('user_id', $buyerId);
            $orderItems = $cart->get();
            foreach ($orderItems as $item) {
                $orderItem = new OrderItem();
                $orderItem->order_id = $order->id;
                $orderItem->course_id = $item->course->id;
                $orderItem->price = $item->course->price;
                $orderItem->item_type = 'course';

                // Save each order item
                $orderItem->save();


                // Enroll the user in the course
                $enrollment = new Enrollment();
                $enrollment->user_id = $buyerId;
                $enrollment->course_id = $item->course->id;
                $enrollment->instructor_id = $item->course->instructor_id;
                $enrollment->have_access = true;
                $enrollment->save();


                // Clear the cart after order is placed
                $cart->delete();
            }
        } catch (\Throwable $th) {
            // throw $th;
        }
    }
}
