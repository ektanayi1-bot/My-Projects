@extends('layouts.app')

@section('title', 'My Shop')

@section('content')
<!-- Categories Section Begin -->
<section class="categories">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6 p-0">
                <div class="categories__item categories__large__item set-bg"
                     data-setbg="{{ asset('img/categories/category-1.jpg') }}">
                    <div class="categories__text">
                        <h1>Headphones</h1>
                        <p>Wireless and noise-cancelling headphones with deep bass and crystal-clear sound for music lovers.</p>
                        <a href="{{ route('shop') }}">Shop now</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6 p-0">
                        <div class="categories__item set-bg" data-setbg="{{ asset('img/categories/category-2.jpg') }}">
                            <div class="categories__text">
                                <h4>Headphones</h4>
                                <p>358 items</p>
                                <a href="{{ route('shop') }}">Shop now</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 p-0">
                        <div class="categories__item set-bg" data-setbg="{{ asset('img/categories/category-3.jpg') }}">
                            <div class="categories__text">
                                <h4>Cameras</h4>
                                <p>273 items</p>
                                <a href="{{ route('shop') }}">Shop now</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 p-0">
                        <div class="categories__item set-bg" data-setbg="{{ asset('img/categories/category-4.jpg') }}">
                            <div class="categories__text">
                                <h4>Televisions</h4>
                                <p>159 items</p>
                                <a href="{{ route('shop') }}">Shop now</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 p-0">
                        <div class="categories__item set-bg" data-setbg="{{ asset('img/categories/category-5.jpg') }}">
                            <div class="categories__text">
                                <h4>Smart Watches</h4>
                                <p>792 items</p>
                                <a href="{{ route('shop') }}">Shop now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Categories Section End -->

<!-- Featured Products -->
<section class="container py-5">
    <h3 class="mb-3">Featured Products</h3>
    <div class="row">
        @foreach($featured as $product)
            @include('shop._card', ['product' => $product])
        @endforeach
    </div>
</section>

<!-- Discount Section Begin -->
<section class="discount">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 p-0">
                <div class="discount__pic">
                    <img src="{{ asset('img/discount.jpg') }}" alt="">
                </div>
            </div>
            <div class="col-lg-6 p-0">
                <div class="discount__text">
                    <div class="discount__text__title">
                        <span>Discount</span>
                        <h2>Summer 2026</h2>
                        <h5><span>Sale</span> 30%</h5>
                    </div>
                    <div class="discount__countdown" id="countdown-time">
                        <div class="countdown__item"><span>22</span><p>Days</p></div>
                        <div class="countdown__item"><span>18</span><p>Hour</p></div>
                        <div class="countdown__item"><span>46</span><p>Min</p></div>
                        <div class="countdown__item"><span>05</span><p>Sec</p></div>
                    </div>
                    <a href="{{ route('shop') }}">Shop now</a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Discount Section End -->

<!-- Services Section Begin -->
<section class="services spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="services__item">
                    <i class="fa fa-car"></i>
                    <h6>Free Shipping</h6>
                    <p>For all oder over $99</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="services__item">
                    <i class="fa fa-money"></i>
                    <h6>Money Back Guarantee</h6>
                    <p>If good have Problems</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="services__item">
                    <i class="fa fa-support"></i>
                    <h6>Online Support 24/7</h6>
                    <p>Dedicated support</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="services__item">
                    <i class="fa fa-headphones"></i>
                    <h6>Payment Secure</h6>
                    <p>100% secure payment</p>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Services Section End -->
@endsection