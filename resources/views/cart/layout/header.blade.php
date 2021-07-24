<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name') }} - @yield('title')</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href={{asset('assets/css/cart/style.css')}}>
</head>
<body>
@php
    $lang = $lang =app()->getLocale();
@endphp
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="/"><img src={{asset('assets/img/logo/logo.png')}} alt=""></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#mainNav" aria-controls="mainNav"
            aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse " id="mainNav">
        <ul class="navbar-nav ml-auto">
            {{--cart--}}
            <li class="nav-item nav-cart ml-1">
                <div class="dropdown">
                    <button type="button" class="nav-btn btn btn-sm btn-info" data-toggle="dropdown">
                        <i class="fa fa-shopping-cart"
                           aria-hidden="true"></i> <x-translate text="Cart"/>
                        <span
                            class="badge badge-pill badge-danger">{{ (isset(session('cart')->items))?count((array) session('cart')->items):0 }}</span>
                    </button>
                    <div class="dropdown-menu">
                        <div class="row total-header-section">
                            <div class="col-lg-6 col-sm-6 col-6">
                                <i class="fa fa-shopping-cart" aria-hidden="true"></i> <span
                                    class="badge badge-pill badge-danger">{{ (isset(session('cart')->items))?count((array) session('cart')->items):0 }}</span>
                            </div>
                            @php $total = 0 @endphp
                            @if(isset(session('cart')->items))
                                @foreach((array) session('cart')->items as $id => $details)
                                    @php $total += $details['price'] * $details['quantity'] @endphp
                                @endforeach
                            @endif
                            <div class="col-lg-6 col-sm-6 col-6 total-section text-right">
                                <p><x-translate text="Total"/><span
                                        class="text-info">$ {{ $total }}</span></p>
                            </div>
                        </div>
                        @if(isset(session('cart')->items))
                            @foreach(session('cart')->items as $id => $details)

                                <div class="row cart-detail">
                                    <div class="col-lg-4 col-sm-4 col-4 cart-detail-img">
                                        <img src="{{ '/'.$details['image'] }}"/>
                                    </div>
                                    <div class="col-lg-8 col-sm-8 col-8 cart-detail-product">
                                        <p>{{ $details['title'] }}</p>
                                        <span class="price text-info"> ${{ $details['price'] }}</span> <span
                                            class="count"> Quantity:{{ $details['quantity'] }}</span>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                        <div class="row">
                            <div class="col-lg-12 col-sm-12 col-12 text-center checkout">
                                <a href="{{ route('cart.index') }}"
                                   class="btn btn-primary btn-block"><x-translate text="View All"/></a>
                            </div>
                        </div>
                    </div>
                </div>
            </li>
            @guest
                <li class="nav-item active">
                    <a class="nav-btn btn btn-sm btn-outline-dark"
                       href="{{route('login')}}"><x-translate text="Login"/></a>
                </li>
                <li class="nav-item ml-1 form-inline">
                    <a class="nav-btn btn btn-sm btn-success"
                       href="{{route('register')}}"><x-translate text="Join"/></a>
                </li>
            @endguest
            @auth('web')
                <ul class="navbar-nav">
                    <li class="nav-item btn-rotate dropdown">
                        <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <x-translate text="Account"/>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item" href="{{ route('order.view') }}"><x-translate text="Orders"/></a>

                            <form id="dropdown-item logout-form" action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button class="dropdown-item cursor-pointer"><x-translate text="Logout"/></button>
                            </form>
                        </div>
                    </li>
                </ul>
            @endauth

            @if(count(config('app.languages')))
                <li>
                    <div class="collapse navbar-collapse justify-content-end" id="navigation">
                        <ul class="navbar-nav">
                            <li class="nav-item btn-rotate dropdown">
                                <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink"
                                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    {{strtoupper(app()->getLocale())}}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                                    @foreach(config('app.languages') as $langLocale => $langName )
                                        <a class="dropdown-item"
                                           href="{{url()->current()}}?lang={{$langLocale}}">{{ strtoupper($langLocale) }}
                                            ({{ $langName }})</a>
                                    @endforeach
                                </div>
                            </li>
                        </ul>
                    </div>
                </li>
            @endif
        </ul>
    </div>
</nav>
