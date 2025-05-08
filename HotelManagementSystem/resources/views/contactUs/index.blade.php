@extends('layouts.app')
<title>Contact Us | HotelSewa</title>
@section('content')
<!-- Hero Section -->
<section class="hero-section text-center">
    <div class="container">
        <h1 class="hero-title">Contact Us</h1>
        <p class="lead">We'd love to hear from you. Reach out for reservations, inquiries, or special requests.</p>
    </div>
</section>

<!-- Contact Form Section -->
<section class="container mb-5">
    <div class="row">
        <div class="col-lg-7 mb-4 mb-lg-0">
            <h2 class="section-title">Send Us a Message</h2>
            <div class="contact-form">
                <form>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="firstName" class="form-label">First Name*</label>
                                <input type="text" class="form-control" id="firstName" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="lastName" class="form-label">Last Name*</label>
                                <input type="text" class="form-control" id="lastName" required>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="email" class="form-label">Email Address*</label>
                        <input type="email" class="form-control" id="email" required>
                    </div>

                    <div class="form-group">
                        <label for="phone" class="form-label">Phone Number</label>
                        <input type="tel" class="form-control" id="phone">
                    </div>

                    <!-- <div class="form-group">
                        <label for="subject" class="form-label">Subject*</label>
                        <select class="form-select" id="subject" required>
                            <option value="" selected disabled>Select a subject</option>
                            <option value="reservation">Room Reservation</option>
                            <option value="event">Event Inquiry</option>
                            <option value="feedback">Feedback</option>
                            <option value="general">General Inquiry</option>
                            <option value="other">Other</option>
                        </select>
                    </div> -->

                    <div class="form-group">
                        <label for="message" class="form-label">Your Message*</label>
                        <textarea class="form-control" id="message" required></textarea>
                    </div>

                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary">Send Message</button>
                    </div>

                </form>
            </div>
        </div>

        <div class="col-lg-5">
            <div class="contact-image">
                <img src="https://images.unsplash.com/photo-1520250497591-112f2f40a3f4?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80" alt="Hotel Lobby" class="img-fluid">
            </div>
        </div>
    </div>
</section>

<!-- Contact Info Section -->
<section class="container mb-5">
    <h2 class="section-title text-center">Other Ways to Reach Us</h2>
    <div class="row">
        <div class="col-md-4">
            <div class="info-card">
                <i class="fas fa-map-marker-alt"></i>
                <h3>Our Location</h3>
                <p>RatnaChowk<br>City, Pokhara<br>Nepal</p>
            </div>
        </div>

        <div class="col-md-4">
            <div class="info-card">
                <i class="fas fa-phone-alt"></i>
                <h3>Phone</h3>
                <p>Reservations: +977 9826121609</p>
            </div>
        </div>

        <div class="col-md-4">
            <div class="info-card">
                <i class="fas fa-envelope"></i>
                <h3>Email</h3>
                <p>reservations@gmail.com<br>iush@gmail.com</p>
            </div>
        </div>
    </div>
</section>

@endSection