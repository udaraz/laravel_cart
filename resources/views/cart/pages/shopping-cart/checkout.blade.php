@extends('cart.master')

@section('title', 'Purchase')

@section('main-content')
    <div class="container mt-5 mb-5">
        <div class="row">
            @php
                $total = 0;
                $count = 0;
            @endphp

            <div class="col-md-4 order-md-2 mb-4">
                <h4 class="d-flex justify-content-between align-items-center mb-3">
                    <span class="text-muted">Your cart</span>
                    <span class="badge badge-secondary badge-pill">{{session('cart')->count}}</span>
                </h4>
                <ul class="list-group mb-3">

                    @if(session('cart'))
                        @foreach(session('cart')->items as $id => $details)
                            @php
                                $total += $details['price'] * $details['quantity']
                            @endphp

                            <li class="list-group-item d-flex justify-content-between lh-condensed">
                                <div class="col-sm-3 hidden-xs">
                                    <img src="{{ $details['image'] }}" width="50" height="50"
                                         class="img-responsive"/>
                                </div>
                                <div>
                                    <h6 class="my-0">{{ $details['title'] }}</h6>
                                    <small class="text-muted">Quantity :{{ $details['quantity'] }}</small>
                                </div>
                                <span class="text-muted">${{  $details['price'] * $details['quantity'] }}</span>
                            </li>
                        @endforeach
                    @endif

                    <li class="list-group-item d-flex justify-content-between">
                        <span>Total (USD)</span>
                        <strong>${{session('cart')->total}}</strong>
                    </li>
                </ul>
            </div>
            <div class="col-md-8 order-md-1">
                <h4 class="mb-3">Billing Information</h4>
                <form method="POST" action="{{route('order.proceed')}}">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label for="first_name">First name</label>
                                <input type="text" class="form-control" name="f_name" id="first_name" placeholder=""
                                       value="" required>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label for="last_lame">Last name</label>
                                <input type="text" class="form-control" name="l_name" id="last_name" placeholder=""
                                       value="" required>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="email">Email <span class="text-muted">(Optional)</span></label>
                        <input type="email" class="form-control" name="email" id="email" placeholder="you@example.com">
                    </div>

                    <div class="mb-3">
                        <label for="address">Address</label>
                        <input type="text" class="form-control" name="address" id="address" placeholder="1234 Main St"
                               required>
                    </div>

                    <div class="row">
                        <div class="col-md-5 mb-3">
                            <label for="country">Country</label>
                            <select class="custom-select d-block w-100" name="country" id="country" required>
                                <option value="">Choose...</option>
                                <option>Srilanka</option>
                            </select>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="state">Province</label>
                            <select class="custom-select d-block w-100" name="province" id="province" required>
                                <option value="">Choose...</option>
                                <option>Central</option>
                                <option>Western</option>
                            </select>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="zip">Zip</label>
                            <input type="text" class="form-control" name="zip" id="zip" placeholder="" required>
                        </div>
                    </div>
                    <hr class="mb-4">

                    <h4 class="mb-3">Payment</h4>

                    <div class="d-block my-3">
                        <div class="custom-control custom-radio">
                            <input id="credit" name="payment_method" value="credit" type="radio" class="custom-control-input"
                                   checked=""
                                   required="">
                            <label class="custom-control-label" for="credit">Credit card</label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input id="debit" name="payment_method" value="debit" type="radio" class="custom-control-input"
                                   required="">
                            <label class="custom-control-label" for="debit">Debit card</label>
                        </div>
                    </div>
                    <div>
                        <div id="credit-card" class="tab-pane fade show active pt-3">
                            <div class="form-group">
                                <label for="username"><h6>Card Owner</h6></label>
                                <input type="text" name="card_name" placeholder="Card Owner Name" required
                                       class="form-control" value="Lorem Ipsam">
                            </div>
                            <div class="form-group">
                                <label for="cardNumber"><h6>Card number</h6></label>
                                <div class="input-group">
                                    <input type="text" name="card_number"
                                           placeholder="Valid card number" class="form-control "
                                           value="1234 5678 9012 3456" required>

                                    <div class="input-group-append"><span class="input-group-text text-muted"> <i
                                                class="fa fa-cc-visa mx-1"></i> <i
                                                class="fa fa-cc-mastercard mx-1"></i> <i
                                                class="fa fa-cc-amex mx-1"></i> </span></div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-8">
                                    <div class="form-group">
                                        <label>
                                            <span class="hidden-xs">
                                                <h6>Expiration Date</h6>
                                            </span>
                                        </label>
                                        <div class="input-group">
                                            <input type="number" placeholder="MM" name="card_month" class="form-control"
                                                   value="05" required>
                                            <input type="number" placeholder="YY" name="card_year" class="form-control"
                                                   value="23" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group mb-4">
                                        <label data-toggle="tooltip" title="Three digit CV code on the back of your card">
                                            <h6>CVV <i class="fa fa-question-circle d-inline"></i></h6>
                                        </label>
                                        <input type="text" name="cvv" class="form-control" value="555" required>
                                    </div>
                                </div>
                            </div>
                            @if ($errors->any())
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                            @if(session()->has('message'))
                                <div class="alert alert-success  alert-dismissible fade show">
                                    {{ session()->get('message') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                            <div class="card-footer">
                                <button type="submit" class="subscribe btn btn-primary btn-block shadow-sm"> Confirm
                                    Payment
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('custom-scripts')
    <script src="{{asset('assets/js/cart/cart.js')}}"></script>
@endpush
