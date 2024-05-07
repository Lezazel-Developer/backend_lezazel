@extends('layouts.app')

@section('title', 'Products')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Products</h1>
                <div class="section-header-button">
                    <a href="{{ route('products.create') }}" class="btn btn-primary">Add New</a>
                </div>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('home') }}">Dashboard</a></div>
                    <div class="breadcrumb-item">Products</div>
                </div>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        @include('layouts.alert')
                    </div>
                </div>
                <h2 class="section-title">Products</h2>
                <p class="section-lead">
                    You can manage all products, such as editing, deleting and more.
                </p>

                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>All Products</h4>
                            </div>
                            <div class="card-body text-center">
                                @if ($product->count() > 0)
                                    <div class="table-responsive">
                                        <table class="table-striped table">
                                            <tr>
                                                <th>Title</th>
                                                <th>Description</th>
                                                <th>Weight</th>
                                                <th>Images</th>
                                                <th>Action</th>
                                            </tr>
                                            @foreach ($product as $prod)
                                                <tr>
                                                    <td>{{ $prod->title }}</td>
                                                    <td>{{ $prod->description }}</td>
                                                    <td>{{ $prod->weight }}</td>
                                                    <td>
                                                        <div id="carouselExampleIndicators{{ $prod->id }}"
                                                            class="carousel slide" data-ride="carousel">
                                                            <ol class="carousel-indicators">
                                                                @foreach ($prod->images as $key => $image)
                                                                    <li data-target="#carouselExampleIndicators{{ $prod->id }}"
                                                                        data-slide-to="{{ $key }}"
                                                                        class="{{ $key == 0 ? 'active' : '' }}"></li>
                                                                @endforeach
                                                            </ol>
                                                            <div class="carousel-inner">
                                                                @foreach ($prod->images as $key => $image)
                                                                    <div
                                                                        class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                                                        <img class="d-block w-100"
                                                                            src="{{ $image }}"
                                                                            alt="Slide {{ $key + 1 }}"
                                                                            height="100"
                                                                            width="100">
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                            <a class="carousel-control-prev"
                                                                href="#carouselExampleIndicators{{ $prod->id }}"
                                                                role="button" data-slide="prev">
                                                                <span class="carousel-control-prev-icon"
                                                                    aria-hidden="true"></span>
                                                                <span class="sr-only">Previous</span>
                                                            </a>
                                                            <a class="carousel-control-next"
                                                                href="#carouselExampleIndicators{{ $prod->id }}"
                                                                role="button" data-slide="next">
                                                                <span class="carousel-control-next-icon"
                                                                    aria-hidden="true"></span>
                                                                <span class="sr-only">Next</span>
                                                            </a>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex justify-content-center">
                                                            <a href='{{ route('products.edit', $prod->id) }}'
                                                                class="btn btn-sm btn-info btn-icon">
                                                                <i class="fas fa-edit"></i> Edit
                                                            </a>
                                                            <a href="{{ route('products.show', $prod->id) }}"
                                                                class="btn btn-sm btn-primary btn-icon ml-2">
                                                                <i class="fas fa-eye"></i> Show
                                                            </a>
                                                            <form action="{{ route('products.destroy', $prod->id) }}"
                                                                method="POST" class="ml-2">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button
                                                                    class="btn btn-sm btn-danger btn-icon confirm-delete">
                                                                    <i class="fas fa-times"></i> Delete
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </table>
                                    </div>
                                    <div class="float-right">
                                        {{ $product->withQueryString()->links() }}
                                    </div>
                                @else
                                    <p>No products available.</p>
                                @endif
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <!-- JS Libraries -->
    <script src="{{ asset('library/selectric/public/jquery.selectric.min.js') }}"></script>

    <!-- Page Specific JS File -->
    <script src="{{ asset('js/page/features-posts.js') }}"></script>
@endpush
