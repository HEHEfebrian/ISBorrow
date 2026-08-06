@extends('layouts.app')

@section('title', 'Login | ISBorrow')

@section('content')

<section class="login-section">

    <div class="container">

        <div class="row align-items-center justify-content-center">

            <div class="col-lg-10">

                <div class="login-card">

                    <div class="row g-0">

                        <!-- Left -->
                        <div class="col-lg-6 login-left">

                            <div>

                                <span class="isb-badge">
                                    Information System for Business
                                </span>

                                <h1 class="mt-4">
                                    Borrow Hardware &
                                    Software Easily
                                </h1>

                                <p class="mt-4">
                                    ISBorrow helps ISB students borrow
                                    hardware and software quickly,
                                    transparently, and efficiently.
                                </p>

                                <img
                                    src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f?q=80&w=1200&auto=format&fit=crop"
                                    class="img-fluid rounded-4 mt-4">

                            </div>

                        </div>

                        <!-- Right -->

                        <div class="col-lg-6">

                            <div class="login-form">

                                <h2>Welcome Back</h2>

                                <p>
                                    Login using your UC Student Account
                                </p>

                                <form method="POST" action="{{ route('login') }}">

                                    @csrf

                                    <div class="mb-4">

                                        <label>Email</label>

                                        <input
                                            type="email"
                                            name="email"
                                            class="form-control login-input"
                                            placeholder="student@ciputra.ac.id">

                                    </div>

                                    <div class="mb-4">

                                        <label>Password</label>

                                        <input
                                            type="password"
                                            name="password"
                                            class="form-control login-input">

                                    </div>

                                    <button
                                        class="isb-btn w-100">

                                        Login

                                    </button>

                                </form>

                                <small class="text-muted d-block mt-4 text-center">
                                    Only
                                    <strong>@ciputra.ac.id</strong>
                                    email addresses are allowed.
                                </small>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>

@endsection