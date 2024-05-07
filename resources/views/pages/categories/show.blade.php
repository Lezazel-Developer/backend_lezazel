@extends('layouts.app')

@section('title', 'Category Details')

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Category Details</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="{{ route('categories.index') }}">Categories</a></div>
                    <div class="breadcrumb-item">Category Details</div>
                </div>
            </div>
            <div class="container mt-5">
                <div class="row">
                    <div class="col-12 col-md-10 offset-md-1 col-lg-10 offset-lg-1">
                        <div class="card card-primary">
                            <div class="row m-0">
                                <div class="col-12 col-md-12 col-lg-5 p-0">
                                    <div class="card-header text-center">
                                        <h4>Category Info</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="name">Category Name</label>
                                            <input id="name" type="text" class="form-control"
                                                value="{{ $category->name }}" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="slug">Slug</label>
                                            <input id="slug" type="text" class="form-control"
                                                value="{{ $category->slug }}" readonly>
                                        </div>
                                    </div>
                                    <div class="card-footer text-center">
                                        <a href="{{ route('categories.index') }}" class="btn btn-secondary">Back</a>
                                        <a href="{{ route('categories.edit', $category->id) }}"
                                            class="btn btn-primary">Edit</a>
                                        <form action="{{ route('categories.destroy', $category->id) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger"
                                                onclick="return confirm('Are you sure you want to delete this category?')">Delete</button>
                                        </form>
                                    </div>
                                </div>
                                <div class="col-12 col-md-12 col-lg-7 p-0">
                                    <div class="card-header text-center">
                                        <h4>Category Image</h4>
                                    </div>
                                    <div class="card-body">
                                        <img src="{{ $category->image }}" alt="Category Image" class="img-fluid">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
