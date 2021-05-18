<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
$setting = $this->Crud_model->selectSettings();
date_default_timezone_set($setting["time_zone"]);
$this->load->view('template/_parts/front_master_header_page_view'); ?>

    <!-- Start Banner 
    ============================================= -->
    <div class="banner-area top-shape text-dark inc-video auto-height text-center bg-gradient small-text">
        <div class="box-table">
            <div class="box-cell">
                <div class="container">
                    <div class="double-items">
                        <div class="row">
                            <div class="col-lg-8 offset-lg-2">
                                <div class="content" data-animation="animated fadeInUpBig">
                                    <h1>Inventory<span>Count</span></h1>
                                    <p>
                                       Inventory Count, is a inventory count management application that allow you to count yours products with your mobile phone without any other device. A perfect POS and ERP Companion.
                                    </p>
                                </div>
                            </div>
                            <div class="col-lg-8 offset-lg-2">
                                <div class="banner">
                                    <img src="<?=site_url('assets/img/app-dashbord.png')?>" alt="Thumb">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="shape-bg">
                    <img src="<?=site_url('assets/img/1.svg')?>" alt="Shape">
                </div>
            </div>
        </div>
    </div><br><br>
    <!-- End Banner -->

    <!-- Start About 
    ============================================= -->
    <div id="about" class="about-area mar-top-less default-padding-top">
        <div class="container">
            <div class="row">
                <div class="about-items text-center">
                    <div class="col-lg-8 offset-lg-2">
                        <div class="about-content text-center">
                            <h4>About Us</h4>
                            <h2>What is Softing? </h2>
                            <p>
                                Ignorant saw her her drawings marriage laughter. Case oh an that or away sigh do here upon. Acuteness you exquisite ourselves now end forfeited. Enquire ye without it garrets up himself. Interest our nor received followed was. Cultivated an up solicitude mr unpleasant. 
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="top-features">
                            <div class="row">
                                <div class="col-lg-4 col-md-6 single-item">
                                    <div class="item">
                                        <img src="<?=site_url('assets/dist/img/user2-160x160.jpg')?>">
                                        <h4>Manager</h4>
                                        <p>
                                            The manager is responsible for the creation of the counters and validators, he creates the inventories, the counter and validator assignes.
                                            He has all rights on the system, he can export the inventory report, add products and configure the system. 
                                        </p>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 single-item">
                                    <div class="item">
                                        <img src="<?=site_url('assets/dist/img/user2-160x160.jpg')?>">
                                        <h4>Counters</h4>
                                        <p>
                                            The counters are the people in charge of counting the products in the different departments according to the blocks to which they have been assigned by the manager. 
                                        </p>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 single-item">
                                    <div class="item">
                                        <img src="<?=site_url('assets/dist/img/user2-160x160.jpg')?>">
                                        <h4>Validator</h4>
                                        <p>
                                            It can happen that the meter is wrong in the count, which in order to remove the doubt has allowed the validators to make a quick recount in order to validate or correct the data entered by the meters.  
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End About -->

    <!-- Start Overview 
    ============================================= -->
    <div id="overview" class="overview-area default-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <div class="site-heading text-center">
                        <h2>Quick Software Overview</h2>
                        <p>
                            Learning day desirous informed expenses material returned six the. She enabled invited exposed him another. Reasonably conviction solicitude me mr at discretion reasonable. Age out full gate bed day lose. 
                        </p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-10 offset-lg-1 text-center overview-items">
                    <!-- Tab Nav -->
                    <ul id="tabs" class="nav nav-tabs">
                        <li class="nav-item">
                            <a href="#" data-target="#tab1" data-toggle="tab" class="active nav-link">
                                <i class="flaticon-test"></i>
                                Manager
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" data-target="#tab2" data-toggle="tab" class="nav-link">
                                <i class="flaticon-heart"></i>
                                Counter
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" data-target="#tab3" data-toggle="tab" class="nav-link">
                                <i class="flaticon-dental-checkup"></i>
                                Validator
                            </a>
                        </li>
                    </ul>
                    <!-- End Tab Nav -->

                    <!-- Start Tab Content -->
                    <div id="tabsContent" class="tab-content">
                        <div id="tab1" class="tab-pane fade active show">
                            <img src="<?=site_url('assets/img/app-dashbord.png')?>" alt="Thumb">
                        </div>
                        <div id="tab2" class="tab-pane fade">
                            <img src="assets/img/app/screnshoot-2.jpg" alt="Thumb">
                        </div>
                        <div id="tab3" class="tab-pane fade">
                            <img src="assets/img/app/screnshoot-3.jpg" alt="Thumb">
                        </div>
                    </div>
                    <!-- End Tab Content -->
                </div>
            </div>
        </div>
    </div>
    <!-- End Overview -->

    <!-- Start Pricing Area
    ============================================= -->
    <div id="pricing" class="pricing-area default-padding bg-gray bottom-less">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <div class="site-heading text-center">
                        <h2>Our Packages</h2>
                        <p>
                            Learning day desirous informed expenses material returned six the. She enabled invited exposed him another. Reasonably conviction solicitude me mr at discretion reasonable. Age out full gate bed day lose. 
                        </p>
                    </div>
                </div>
            </div>
            <div class="pricing pricing-simple text-center">
                <div class="row">
                    <div class="col-lg-4 col-md-6">
                        <div class="pricing-item">
                            <ul>
                                <li class="pricing-header">
                                    <h4>A Life</h4>
                                    <h2><sup>$</sup>37 <sub>/ Lifetime</sub></h2>
                                </li>
                                <li><img src="<?=site_url('assets/img/valid.JPG')?>"> life update</li>
                                <li><img src="<?=site_url('assets/img/valid.JPG')?>"> only one installation</li>
                                <li><i class="fas fa-check"></i> Commercial use</li>
                                <li><i class="fas fa-times"></i> Support</li>
                                <li><i class="fas fa-check"></i> Documetation</li>
                                <li class="footer">
                                    <a class="btn circle btn-theme border btn-sm" href="#">Buy This Plan</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="pricing-item active">
                            <ul>
                                <li class="pricing-header">
                                    <h4>Regular</h4>
                                    <h2><sup>$</sup>320 <sub>/ Lifetime</sub></h2>
                                </li>
                                <li><img src="<?=site_url('assets/img/valid.JPG')?>"> Life update</li>
                                <li><img src="<?=site_url('assets/img/valid.JPG')?>"></i> Multiple installations</li>
                                <li><img src="<?=site_url('assets/img/valid.JPG')?>"> Documetation</li>
                                <li class="footer">
                                    <a class="btn circle btn-theme effect btn-sm" href="#">Buy This Plan</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="pricing-item">
                            <ul>
                                <li class="pricing-header">
                                    <h4>Extended</h4>
                                    <h2><sup>$</sup>345 <sub>/ Lifetime</sub></h2>
                                </li>
                                <li><img src="<?=site_url('assets/img/valid.JPG')?>"> Life update</li>
                                <li><img src="<?=site_url('assets/img/valid.JPG')?>"> File compressed</li>
                                <li><i class="fas fa-check"></i> Commercial use</li>
                                <li><img src="<?=site_url('assets/img/valid.JPG')?>"> Support</li>
                                <li><img src="<?=site_url('assets/img/valid.JPG')?>"> Documetation</li>
                                <li class="footer">
                                    <a class="btn circle btn-theme border btn-sm" href="#">Buy This Plan</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Pricing Area -->

    <!-- Start Team  
    ============================================= -->
  
    <!-- End Team -->

    <!-- Start Blog  
    ============================================= -->
    <!-- End Blog -->

    <!-- Start Testimonials 
    ============================================= -->
    <div class="testimonials-area default-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <div class="site-heading single text-center">
                        <h2>Customer Review</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <div class="testimonial-items text-center">
                        <div class="carousel slide" data-ride="carousel" data-interval="500000" id="testimonial-carousel">
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <span class="quote"></span>
                                    <p>
                                        Understood instrument or do connection no appearance do invitation. Dried quick round it or order. Add past see west felt did any. Say out noise you taste merry plate you share. My resolve arrived is we chamber be removal. 
                                    </p>
                                    <h4>Junl Sarukh</h4>
                                    <span>CEO of Softing</span>
                                </div>
                                <div class="carousel-item">
                                    <span class="quote"></span>
                                    <p>
                                        Understood instrument or do connection no appearance do invitation. Dried quick round it or order. Add past see west felt did any. Say out noise you taste merry plate you share. My resolve arrived is we chamber be removal. 
                                    </p>
                                    <h4>Anil Spia</h4>
                                    <span>Director of Softing</span>
                                </div>
                                <div class="carousel-item">
                                    <span class="quote"></span>
                                    <p>
                                        Understood instrument or do connection no appearance do invitation. Dried quick round it or order. Add past see west felt did any. Say out noise you taste merry plate you share. My resolve arrived is we chamber be removal. 
                                    </p>
                                    <h4>Paul Munni</h4>
                                    <span>Developer of Softing</span>
                                </div>
                            </div>
                            <!-- End Carousel Content -->

                            <!-- Carousel Indicators -->
                            <ol class="carousel-indicators">
                                <li data-target="#testimonial-carousel" data-slide-to="0" class="active">
                                    <img src="assets/img/team/4.jpg" alt="Thumb">
                                </li>
                                <li data-target="#testimonial-carousel" data-slide-to="1">
                                    <img src="assets/img/team/2.jpg" alt="Thumb">
                                </li>
                                <li data-target="#testimonial-carousel" data-slide-to="2">
                                    <img src="assets/img/team/9.jpg" alt="Thumb">
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Testimonials -->

    <!-- Start Contact Area  
    ============================================= -->

    <!-- Start Faq  
    ============================================= -->
    <div class="faq-area bg-gray default-padding-top">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <div class="site-heading text-center">
                        <h2>Answer & Question</h2>
                        <p>
                            Learning day desirous informed expenses material returned six the. She enabled invited exposed him another. Reasonably conviction solicitude me mr at discretion reasonable. Age out full gate bed day lose. 
                        </p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 thumb">
                    <img src="assets/img/banner/contact.png" alt="Thumb">
                </div>
                <div class="col-lg-6 faq-items default-padding-bottom">
                    <!-- Start Accordion -->
                    <div class="faq-content">
                        <div class="accordion" id="accordionExample">
                            <div class="card">
                                <div class="card-header" id="headingOne">
                                    <h4 class="mb-0" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                          Do I need a business plan?
                                    </h4>
                                </div>

                                <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <p>
                                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Qui consectetur at, sunt maxime, quod alias ullam officiis, ex necessitatibus similique odio aut!
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header" id="headingTwo">
                                    <h4 class="mb-0 collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                          How long should a business plan be?
                                    </h4>
                                </div>
                                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <p>
                                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Qui consectetur at, sunt maxime, quod alias ullam officiis, ex necessitatibus similique odio aut!
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header" id="headingThree">
                                    <h4 class="mb-0 collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                      What goes into a business plan?
                                  </h4>
                                </div>
                                <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <p>
                                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Qui consectetur at, sunt maxime, quod alias ullam officiis, ex necessitatibus similique odio aut!
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header" id="headingFour">
                                    <h4 class="mb-0 collapsed" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                      Where do I start?
                                  </h4>
                                </div>
                                <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <p>
                                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Qui consectetur at, sunt maxime, quod alias ullam officiis, ex necessitatibus similique odio aut!
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Accordion -->
                </div>
            </div>
        </div>
    </div>
    <!-- End Faq  -->
<?php $this->load->view('template/_parts/front_master_footer_page_view');?>