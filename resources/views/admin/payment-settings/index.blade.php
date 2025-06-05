@extends('admin.layouts.master')
@section('content')
    <div class="page-body">
        <div class="container-xl">
            <div class="card">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Payment Gateway</h3>

                            <!-- Page title actions -->
                            <div class="card-actions">
                                <a href="{{ route('admin.course-language.index') }}" class="btn btn-primary btn-3">
                                    <i class="ti ti-arrow-back-up"></i>
                                    Back
                                </a>
                            </div>
                        </div>





                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <ul class="nav nav-tabs card-header-tabs nav-fill" data-bs-toggle="tabs" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <a href="#paypal-settings" class="nav-link active" data-bs-toggle="tab"
                                                aria-selected="false" role="tab" tabindex="-1"><b>Paypal Settings</b></a>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <a href="#tabs-profile-5" class="nav-link" data-bs-toggle="tab"
                                                aria-selected="true" role="tab"><b>Stripe Settings</b></a>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <a href="#tabs-activity-5" class="nav-link" data-bs-toggle="tab"
                                                aria-selected="false" role="tab" tabindex="-1"><b>RazorPay Settings</b></a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="card-body">
                                    <div class="tab-content">
                                        <div class="tab-pane active show" id="paypal-settings" role="tabpanel">
                                            <h3>Paypal Tab</h3>
                                            <div>
                                                <form action="{{ route('admin.paypal-settings.update')}}" method="POST" class="card">
                                                    @csrf
                                                    <div class="row card-body">
                                                        <div class="mb-3 col-md-5">
                                                            <label class="form-label required">Paypal Mode</label>
                                                            <div>
                                                                <select class="form-select" name="paypal_mode">
                                                                    <option value="">Select Mode</option>
                                                                    <option @selected(config('payment_gateway.paypal_mode') == 'sandbox') value="sandbox">Sandbox</option>
                                                                    <option @selected(config('payment_gateway.paypal_mode') == 'live') value="live">Live</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="mb-3 col-md-5">
                                                            <label class="form-label required">Curency</label>
                                                            <div>
                                                                <select class="form-select" name="paypal_currency">
                                                                    @foreach (config('gateway_currency.paypalCurrencies') as $key => $value)
                                                                        <option @selected(config('payment_gateway.paypal_currency') == $value['code']) value="{{ $value['code'] }}">
                                                                           {{ $value['code'] }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                                <x-input-error :messages="$errors->get('paypal_currency')" class="mt-2" />
                                                            </div>
                                                        </div>
                                                        <div class="mb-3 col-md-2">
                                                            <label class="form-label required">Rate (USD)</label>
                                                            <div>
                                                                <input type="text" class="form-control" name="paypal_rate" value="{{ config('payment_gateway.paypal_rate')}}" placeholder="Rate (USD)">
                                                                <x-input-error :messages="$errors->get('paypal_rate')" class="mt-2" />
                                                            </div>
                                                        </div>
                                                        <div class="mb-3 col-md-4">
                                                            <label class="form-label required">Client ID</label>
                                                            <div>
                                                                <input type="text" class="form-control" name="paypal_client_id" value="{{ config('payment_gateway.paypal_client_id')}}" placeholder="Enter your Client ID">
                                                                <x-input-error :messages="$errors->get('paypal_client_id')" class="mt-2" />
                                                            </div>
                                                        </div>
                                                        <div class="mb-3 col-md-4">
                                                            <label class="form-label required">Client Secret</label>
                                                            <div>
                                                                <input type="text" class="form-control" name="paypal_client_secret" value="{{ config('payment_gateway.paypal_client_secret')}}" placeholder="Enter your Client Secret">
                                                                <x-input-error :messages="$errors->get('paypal_client_secret')" class="mt-2" />
                                                            </div>
                                                        </div>
                                                        <div class="mb-3 col-md-4">
                                                            <label class="form-label required">App ID</label>
                                                            <div>
                                                                <input type="text" class="form-control" name="paypal_app_id" value="{{ config('payment_gateway.paypal_app_id')}}" placeholder="Enter your App ID">
                                                                <x-input-error :messages="$errors->get('paypal_app_id')" class="mt-2" />
                                                            </div>
                                                        </div>
                                                        <div class="text-start">
                                                            <button type="submit" class="btn btn-primary">Save</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="tabs-profile-5" role="tabpanel">
                                            <h3>Stripe Tab</h3>
                                            <div>
                                                <form action="{{ route('admin.stripe-settings.update')}}" method="POST" class="card">
                                                    @csrf
                                                    <div class="row card-body">
                                                        <div class="mb-3 col-md-5">
                                                            <label class="form-label required">Stripe Status</label>
                                                            <div>
                                                                <select class="form-select" name="stripe_status">
                                                                    <option value="">Select Mode</option>
                                                                    <option @selected(config('payment_gateway.stripe_status') == 'active') value="active">Active</option>
                                                                    <option @selected(config('payment_gateway.stripe_status') == 'inactive') value="inactive">Inactive</option>
                                                                </select>
                                                                <x-input-error :messages="$errors->get('stripe_status')" class="mt-2" />

                                                            </div>
                                                        </div>
                                                        <div class="mb-3 col-md-5">
                                                            <label class="form-label required">Curency</label>
                                                            <div>
                                                                <select class="form-select" name="stripe_currency">
                                                                    @foreach (config('gateway_currency.stripeCurrencies') as $key => $value)
                                                                        <option @selected(config('payment_gateway.stripe_currency') == $value) value="{{ $value }}">
                                                                           {{ $value }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                                <x-input-error :messages="$errors->get('stripe_currency')" class="mt-2" />
                                                            </div>
                                                        </div>
                                                        <div class="mb-3 col-md-2">
                                                            <label class="form-label required">Rate (USD)</label>
                                                            <div>
                                                                <input type="text" class="form-control" name="stripe_rate" value="{{ config('payment_gateway.stripe_rate')}}" placeholder="Rate (USD)">
                                                                <x-input-error :messages="$errors->get('stripe_rate')" class="mt-2" />
                                                            </div>
                                                        </div>
                                                        <div class="mb-3 col-md-6">
                                                            <label class="form-label required">Publishedable Key</label>
                                                            <div>
                                                                <input type="text" class="form-control" name="stripe_publishable_key" value="{{ config('payment_gateway.stripe_publishable_key')}}" placeholder="Enter your Publishable Key">
                                                                <x-input-error :messages="$errors->get('stripe_publishable_key')" class="mt-2" />
                                                            </div>
                                                        </div>
                                                        <div class="mb-3 col-md-6">
                                                            <label class="form-label required">Stripe Secret</label>
                                                            <div>
                                                                <input type="text" class="form-control" name="stripe_secret" value="{{ config('payment_gateway.stripe_secret')}}" placeholder="Enter your Stripe Secret">
                                                                <x-input-error :messages="$errors->get('stripe_secret')" class="mt-2" />
                                                            </div>
                                                        </div>
                                                        <div class="text-start">
                                                            <button type="submit" class="btn btn-primary">Save</button>
                                                        </div>
                                                    </div>
                                                </form>                                            
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="tabs-activity-5" role="tabpanel">
                                            <h3>RazorPay Tab</h3>
                                            <div>
                                                <form action="{{ route('admin.razorpay-settings-update')}}" method="POST" class="card">
                                                    @csrf
                                                    <div class="row card-body">
                                                        <div class="mb-3 col-md-5">
                                                            <label class="form-label required">RazorPay Status</label>
                                                            <div>
                                                                <select class="form-select" name="razorpay_status">
                                                                    <option value="">Select Mode</option>
                                                                    <option @selected(config('payment_gateway.razorpay_status') == 'active') value="active">Active</option>
                                                                    <option @selected(config('payment_gateway.razorpay_status') == 'inactive') value="inactive">Inactive</option>
                                                                </select>
                                                                <x-input-error :messages="$errors->get('razorpay_status')" class="mt-2" />

                                                            </div>
                                                        </div>
                                                        <div class="mb-3 col-md-5">
                                                            <label class="form-label required">Curency</label>
                                                            <div>
                                                                <select class="form-select" name="razorpay_currency">
                                                                    @foreach (config('gateway_currency.razorpayCurrencies') as $key => $value)
                                                                        <option @selected(config('payment_gateway.razorpay_currency') == $value) value="{{ $value }}">
                                                                           {{ $value }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                                <x-input-error :messages="$errors->get('razorpay_currency')" class="mt-2" />
                                                            </div>
                                                        </div>
                                                        <div class="mb-3 col-md-2">
                                                            <label class="form-label required">Rate (USD)</label>
                                                            <div>
                                                                <input type="text" class="form-control" name="razorpay_rate" value="{{ config('payment_gateway.razorpay_rate')}}" placeholder="Rate (USD)">
                                                                <x-input-error :messages="$errors->get('razorpay_rate')" class="mt-2" />
                                                            </div>
                                                        </div>
                                                        <div class="mb-3 col-md-6">
                                                            <label class="form-label required">RazorPay Key</label>
                                                            <div>
                                                                <input type="text" class="form-control" name="razorpay_key" value="{{ config('payment_gateway.razorpay_key')}}" placeholder="Enter your Razorpay Key">
                                                                <x-input-error :messages="$errors->get('razorpay_key')" class="mt-2" />
                                                            </div>
                                                        </div>
                                                        <div class="mb-3 col-md-6">
                                                            <label class="form-label required">RazorPay Secret</label>
                                                            <div>
                                                                <input type="text" class="form-control" name="razorpay_secret" value="{{ config('payment_gateway.razorpay_secret')}}" placeholder="Enter your RazorPay Secret">
                                                                <x-input-error :messages="$errors->get('razorpay_secret')" class="mt-2" />
                                                            </div>
                                                        </div>
                                                        <div class="text-start">
                                                            <button type="submit" class="btn btn-primary">Save</button>
                                                        </div>
                                                    </div>
                                                </form>                                               </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>



                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
