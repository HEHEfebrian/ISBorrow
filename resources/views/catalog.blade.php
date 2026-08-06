@extends('layouts.app')

@section('title', 'ISBorrow | Catalog')

@section('content')

    <section class="catalog-hero">

        <div class="container">

            <div class="text-center">

                <span class="isb-badge">
                    ISBorrow Catalog
                </span>

                <h1 class="display-5 fw-bold mt-3">
                    Browse Hardware & Software
                </h1>

                <p class="catalog-subtitle">
                    Find hardware and software available for borrowing by
                    Information System for Business students.
                </p>

            </div>

            <div class="catalog-filter mt-5">

                <div class="row g-3">

                    <div class="col-lg-4">
                        <input class="form-control catalog-input" placeholder="Search item...">
                    </div>

                    <div class="col-lg-3">
                        <select class="form-select catalog-input">
                            <option>All Category</option>
                            <option>Hardware</option>
                            <option>Software</option>
                        </select>
                    </div>

                    <div class="col-lg-3">
                        <select class="form-select catalog-input">
                            <option>Available</option>
                            <option>Borrowed</option>
                        </select>
                    </div>

                    <div class="col-lg-2">
                        <button class="isb-btn w-100">
                            Search
                        </button>
                    </div>

                </div>

            </div>

        </div>

    </section>

    <section class="py-5">

        <div class="container">

            <div class="row g-4">

                @for ($i = 0; $i < 9; $i++)
                    <div class="col-lg-4 col-md-6">

                        <div class="catalog-card">

                            <img src="https://images.unsplash.com/photo-1496171367470-9ed9a91ea931?q=80&w=1200&auto=format&fit=crop"
                                class="catalog-image">

                            <div class="p-4">

                                <div class="d-flex justify-content-between mb-3">

                                    <span class="badge bg-success">

                                        Available

                                    </span>

                                    <span class="catalog-category">

                                        Hardware

                                    </span>

                                </div>

                                <h4>

                                    Dell Latitude 5420

                                </h4>

                                <p>

                                    Intel Core i5

                                    16GB RAM

                                    512GB SSD

                                </p>

                                <div class="catalog-info">

                                    <div>

                                        <i class="bi bi-box-seam"></i>

                                        5 Units

                                    </div>

                                    <div>

                                        <i class="bi bi-geo-alt"></i>

                                        ISB Lab

                                    </div>

                                </div>

                                <a href="#" class="isb-btn w-100 mt-4">

                                    Borrow Now

                                </a>

                            </div>

                        </div>

                    </div>
                @endfor

            </div>

            <nav class="mt-5">

                <ul class="pagination justify-content-center">

                    <li class="page-item">

                        <a class="page-link" href="#">
                            Previous
                        </a>

                    </li>

                    <li class="page-item active">

                        <a class="page-link" href="#">
                            1
                        </a>

                    </li>

                    <li class="page-item">

                        <a class="page-link" href="#">
                            2
                        </a>

                    </li>

                    <li class="page-item">

                        <a class="page-link" href="#">
                            3
                        </a>

                    </li>

                    <li class="page-item">

                        <a class="page-link" href="#">
                            Next
                        </a>

                    </li>

                </ul>

            </nav>

        </div>

    </section>

@endsection
