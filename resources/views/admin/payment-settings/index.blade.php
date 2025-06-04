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
                                                aria-selected="true" role="tab"><b>Profile</b></a>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <a href="#tabs-activity-5" class="nav-link" data-bs-toggle="tab"
                                                aria-selected="false" role="tab" tabindex="-1"><b>Activity</b></a>
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
                                            <h4>Stripe Tab</h4>
                                            <div>
                                                Fringilla egestas nunc quis tellus diam rhoncus ultricies tristique enim at
                                                diam, sem nunc amet, pellentesque id egestas velit sed
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="tabs-activity-5" role="tabpanel">
                                            <h4>Others Tab</h4>
                                            <div>
                                                Donec ac vitae diam amet vel leo egestas consequat rhoncus in luctus amet,
                                                facilisi sit mauris accumsan nibh habitant senectus
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
    </div>
@endsection
