@extends('frontend.layouts.master')
@section('content')
       <!--===========================
        BREADCRUMB START
    ============================-->
    <section class="wsus__breadcrumb" style="background: url('{{ asset('frontend/assets/images/breadcrumb_bg.jpg') }}');">
        <div class="wsus__breadcrumb_overlay">
            <div class="container">
                <div class="row">
                    <div class="col-12 wow fadeInUp">
                        <div class="wsus__breadcrumb_text">
                            <h1>Shopping Cart</h1>
                            <ul>
                                <li><a href="{{ url('/')}}">Home</a></li>
                                <li>Shopping Cart</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--===========================
        BREADCRUMB END
    ============================-->


    <!--===========================
        CART VIEW START
    ============================-->
    <section class="wsus__cart_view mt_120 xs_mt_100 pb_120 xs_pb_100">
        <div class="container">
            <div class="row">
                <div class="col-12 wow fadeInUp">
                    <div class="cart_list">
                        <div class="table-responsive">
                            <table>
                                <thead>
                                    <tr>
                                        <th class="pro_img">Product</th>

                                        <th class="pro_name"></th>

                                        <th class="pro_tk">Price</th>

                                        <th class="pro_icon">Remove</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($cartItems as $item)
                                        <tr class="mb-4">
                                            <td class="pro_img">
                                                <img src="{{asset($item->course->thumbnail)}}" alt="product"
                                                    class="img-fluid w-100">
                                            </td>

                                            <td class="pro_name">
                                                <a href="{{route('course.details', $item->course->slug)}}">{{$item->course->title}}</a>
                                            </td>
                                            <td class="pro_tk">
                                                <h6>${{$item->course->price}}</h6>
                                            </td>

                                            <td class="pro_icon">
                                                <a href="#" class="remove_from_cart" data-course-id="{{ $item->course->id }}">
                                                    <i class="fal fa-times" aria-hidden="true"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4" class="text-center">No items in the cart</td>
                                            </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-between">
                <div class="col-xxl-7 col-md-5 col-lg-6 wow fadeInUp"
                    style="visibility: visible; animation-name: fadeInUp;">
                    <div class="continue_shopping">
                        <a href="#" class="common_btn">continue shopping</a>
                    </div>
                </div>
                <div class="col-xxl-4 col-md-7 col-lg-6 wow fadeInUp"
                    style="visibility: visible; animation-name: fadeInUp;">
                    <div class="total_price">
                        <h4>total<span>$999.00</span></h4>
                        <div class="subtotal_area">
                            <h5>Subtotal<span>$999.00</span></h5>
                            <h6>Shipping Address</h6>
                            <p>2801 Lafayette Blvd, Norfolk, Vermont
                                23509, united state</p>
                            <h5>Subtotal<span>$999.00</span></h5>
                            <a href="checkout.html" class="common_btn">proceed checkout</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--===========================
        CART VIEW END

@endsection

@push('course_script')
    @vite('resources/js/frontend/cart.js')
@endpush