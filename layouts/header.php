<?php 

include 'database/db_connection.php';
?> 
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Gyan Car Workshop - Car Service</title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <meta content="Free Website Template" name="keywords">
        <meta content="Free Website Template" name="description">

        <!-- Favicon -->
        <link href="image/logo.jpeg" rel="icon">

        <!-- Google Font -->
        <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@400;500;600;700;800;900&display=swap" rel="stylesheet"> 
        
        <!-- CSS Libraries -->
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
        <link href="assets/lib/flaticon/font/flaticon.css" rel="stylesheet">
        <link href="assets/lib/animate/animate.min.css" rel="stylesheet">
        <link href="assets/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

        <!-- Template Stylesheet -->
        <link href="assets/css/style.css" rel="stylesheet">
    </head>

    <body >
        <!-- Top Bar Start -->
        <!-- <div class="top-bar">
            <div class="container">
                <div class="row align-items-center">
                     <div class="col-lg-4 col-md-12">
                        <div class="logo">
                            <a href="index.php">
                                <h1>Auto<span>Wash</span></h1>
                            </a>
                        </div>
                    </div> 
                    <div class="col-lg-8 col-md-7 d-none d-lg-block">
                        <div class="row">
                            <div class="col-4">
                                <div class="top-bar-item">
                                    <div class="top-bar-icon">
                                        <i class="far fa-clock"></i>
                                    </div>
                                    <div class="top-bar-text">
                                        <h3>Opening Hour</h3>
                                        <p>Mon - Fri, 8:00 - 9:00</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="top-bar-item">
                                    <div class="top-bar-icon">
                                        <i class="fa fa-phone-alt"></i>
                                    </div>
                                    <div class="top-bar-text">
                                        <h3>Call Us</h3>
                                        <p>+012 345 6789</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="top-bar-item">
                                    <div class="top-bar-icon">
                                        <i class="far fa-envelope"></i>
                                    </div>
                                    <div class="top-bar-text">
                                        <h3>Email Us</h3>
                                        <p>info@example.com</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->
        <!-- Top Bar End -->

        <!-- Nav Bar Start -->
        
        
        <div class="nav-bar" style="background-color:#f8f4fe">                        
            <div class="container-fluid">
                <nav class=" navbar  navbar-expand-lg bg-dark navbar-dark" >
                <div class="logo row " >
                    <div class="col-4"> 
                <img src="image/logo.jpeg" alt="Logo" style="height:55px; float:left; padding-right:10px;">
</div>
                <div class="col-8">    
                <h1 style="font-size: 1.9rem; line-height: 25px; ">Gyan Car</br><span style="line-height: 25px; font-size: 1.6rem; font-weight:500; color:#202C45;font-style: normal;">Workshop</span></div>
</div>     
                <div class=" ">
                    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                        <span>
                            <i class="fas fa-bars" style="color:#202C45; font-size:28px;"></i>
                        </span>
                    </button>
                </div>
                    <div class="collapse navbar-collapse   " id="navbarCollapse">
                        <div class="navbar-nav "  style="margin-right:30px; margin-left:auto;" >
                            <a href="index.php" class="nav-item nav-link active">Home</a>
                            <a href="about.php" class="nav-item nav-link">About Us</a>
                            <a href="service.php?q=s" class="nav-item nav-link">Our Services</a>                                                  
                            <a href="contact.php" class="nav-item nav-link">Contact Us</a>
                            <a href="#" class="nav-item nav-link">Our Customers</a>
                            <a class="btn" href=""><i class="fab fa-whatsapp"></i></a>
                            <a class="btn" href=""><i class="fab fa-facebook-f"></i></a>
                        </div>

                        <!-- <div style="margin-left:23rem";>
                            <a class="btn btn-custom" href="#">Get Appointment</a>
                        </div> -->
                    </div>
                  
                </nav>
            </div>
        </div>

        <!-- Nav Bar End -->
