@extends('layouts.app')

@section('title', 'Product Details')

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Product Details</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="{{ route('products.index') }}">Products</a></div>
                    <div class="breadcrumb-item active">Details</div>
                </div>
            </div>

            <div class="section-body">
                <h2 class="section-title">Product Information</h2>

                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                                    <ol class="carousel-indicators">
                                        @foreach ($product->images as $key => $image)
                                            <li data-target="#carouselExampleIndicators" data-slide-to="{{ $key }}" class="{{ $key == 0 ? 'active' : '' }}"></li>
                                        @endforeach
                                    </ol>
                                    <div class="carousel-inner">
                                        @foreach ($product->images as $key => $image)
                                            <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                                <img class="d-block w-100" src="{{ $image }}" alt="Slide {{ $key + 1 }}">
                                            </div>
                                        @endforeach
                                    </div>
                                    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <h4>{{ $product->title }}</h4>
                                <p><strong>Category:</strong> {{ $product->category->name }}</p>
                                <p><strong>Description:</strong> {{ $product->description }}</p>
                                <p><strong>Weight:</strong> {{ $product->weight }}</p>
                                <p><strong>Discount:</strong> {{ $product->discount }}%</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>
    </div>
@endsection
