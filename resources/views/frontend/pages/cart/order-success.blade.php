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
                            <h1>Order Completed</h1>
                            <ul>
                                <li><a href="{{ url('/') }}">Home</a></li>
                                <li>Order Completed</li>
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


    <!--=============================
            PAYMENT START
        ==============================-->
    <section class="payment pt_95 xs_pt_75 pb_120 xs_pb_100">
        <div class="container my-5">
            <h2 class="text-center text-success mb-4">🎉 Thanks for your order! Cheers! 🎉</h2>

            {{-- transaction details --}}
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card shadow-sm border-success">
                        <div class="card-header bg-success text-white">
                            <h4 class="mb-0">Transaction Details</h5>
                        </div>
                        <div class="card-body">
                            <p class="card-text">
                                <strong>Transaction ID:</strong>
                                <span class="text-success">{{ $transactionId }}</span>
                            </p>
                            <p class="card-text">
                                <strong>Paid Amount:</strong>
                                <span class="text-success">{{ $paidAmount }} {{ $currency }}</span>
                            </p>
                            <p class="card-text">
                                <strong>Payment Method:</strong>
                                <span class="text-success">PayPal</span>
                            </p>
                            <p class="card-text">
                                <strong>Status:</strong>
                                <span class="badge bg-success">Completed</span>
                            </p>
                            <hr>
                            <p class="card-text text-center text-muted">
                                Thank you for your purchase! Your order has been successfully completed.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            {{-- end transaction details --}}
        </div>

    </section>
    <!--=============================
            PAYMENT END
        ==============================-->
@endsection

