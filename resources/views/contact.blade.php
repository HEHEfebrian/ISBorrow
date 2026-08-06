@extends('layouts.app')

@section('title', 'Contact | ISBorrow')

@section('content')

    <section class="contact-hero">

        <div class="container">

            <div class="text-center">

                <span class="isb-badge">
                    Contact Us
                </span>

                <h1 class="display-5 fw-bold mt-3">
                    Get In Touch
                </h1>

                <p class="contact-subtitle">
                    Have questions regarding hardware or software borrowing?
                    Contact the ISBorrow administrator.
                </p>

            </div>

        </div>

    </section>

    <section class="py-5">

        <div class="container">

            <div class="row g-5">

                <div class="col-lg-5">

                    <div class="contact-card">

                        <h3 class="mb-4">

                            Contact Information

                        </h3>

                        <div class="contact-item">

                            <div class="contact-icon">

                                <i class="bi bi-geo-alt-fill"></i>

                            </div>

                            <div>

                                <h6>Address</h6>

                                <p>
                                    ISB Laboratory<br>
                                    Universitas Ciputra Surabaya
                                </p>

                            </div>

                        </div>

                        <div class="contact-item">

                            <div class="contact-icon">

                                <i class="bi bi-envelope-fill"></i>

                            </div>

                            <div>

                                <h6>Email</h6>

                                <p>
                                    isborrow@ciputra.ac.id
                                </p>

                            </div>

                        </div>

                        <div class="contact-item">

                            <div class="contact-icon">

                                <i class="bi bi-telephone-fill"></i>

                            </div>

                            <div>

                                <h6>Phone</h6>

                                <p>
                                    (+62) 31 7451699
                                </p>

                            </div>

                        </div>

                        <div class="contact-item">

                            <div class="contact-icon">

                                <i class="bi bi-clock-fill"></i>

                            </div>

                            <div>

                                <h6>Office Hours</h6>

                                <p>

                                    Monday - Friday

                                    08:00 - 16:00

                                </p>

                            </div>

                        </div>

                    </div>

                </div>

                <div class="col-lg-7">

                    <div class="contact-card">

                        <h3 class="mb-4">

                            Send Message

                        </h3>

                        <form>

                            <div class="row">

                                <div class="col-md-6 mb-3">

                                    <input type="text" class="form-control contact-input" placeholder="Full Name">

                                </div>

                                <div class="col-md-6 mb-3">

                                    <input type="email" class="form-control contact-input" placeholder="Email">

                                </div>

                            </div>

                            <div class="mb-3">

                                <input type="text" class="form-control contact-input" placeholder="Subject">

                            </div>

                            <div class="mb-4">

                                <textarea class="form-control contact-input" rows="6" placeholder="Your Message"></textarea>

                            </div>

                            <button class="isb-btn">

                                <i class="bi bi-send-fill me-2"></i>

                                Send Message

                            </button>

                        </form>

                    </div>

                </div>

            </div>

        </div>

    </section>

    <section class="pb-5">

        <div class="container">

            <h2 class="text-center mb-5">

                Frequently Asked Questions

            </h2>

            <div class="accordion" id="faq">

                <div class="accordion-item">

                    <h2 class="accordion-header">

                        <button class="accordion-button" data-bs-toggle="collapse" data-bs-target="#faq1">

                            How long can I borrow equipment?

                        </button>

                    </h2>

                    <div id="faq1" class="accordion-collapse collapse show">

                        <div class="accordion-body">

                            Borrowing duration depends on the type of hardware or software and approval from the laboratory
                            administrator.

                        </div>

                    </div>

                </div>

                <div class="accordion-item">

                    <h2 class="accordion-header">

                        <button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#faq2">

                            Can I extend the borrowing period?

                        </button>

                    </h2>

                    <div id="faq2" class="accordion-collapse collapse">

                        <div class="accordion-body">

                            Yes. You may request an extension before the due date through ISBorrow.

                        </div>

                    </div>

                </div>

                <div class="accordion-item">

                    <h2 class="accordion-header">

                        <button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#faq3">

                            What happens if equipment is damaged?

                        </button>

                    </h2>

                    <div id="faq3" class="accordion-collapse collapse">

                        <div class="accordion-body">

                            Please report any damage immediately to the laboratory administrator.

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>

@endsection
