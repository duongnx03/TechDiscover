<?php
include "header.php";
include "navbar.php";
?>

<!-- Start All Title Box -->
<div class="all-title-box">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h2>Contact Us</h2>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active"> Contact Us </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- End All Title Box -->

<!-- Start Contact Us  -->
<div class="contact-box-main">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-sm-12">
                <div class="contact-info-left">
                    <h2>CONTACT INFO</h2>
                    <p>Thank you for choosing TechDiscovery as your preferred destination for all your technology needs. We value your business and are committed to providing exceptional customer service. If you have any questions, concerns, or need assistance, we are here to help. </p>
                    <ul>
                        <li>
                            <p><i class="fas fa-map-marker-alt"></i>Address:<a href="">391a Nam Ky Khoi Nghia Street,<br>Ward 14, District 3, Ho Chi Minh City,<br> VietNam </a></p>
                        </li>
                        <li>
                            <p><i class="fas fa-phone-square"></i>Phone: <a href="tel:+1-888705770">+84123.456.789</a></p>
                        </li>
                        <li>
                            <p><i class="fas fa-envelope"></i>Email: <a href="mailto:techdiscoverys@gmail.com">TechDiscoverys@gmail.com</a></p>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-8 col-sm-12">
                <div class="contact-form-right">
                    <h2>GET IN TOUCH</h2>
                    <p>Hi, We are happy to connect with you at our sales site! We are always ready to listen and assist you in all your shopping needs. If you have any questions, suggestions or need advice, don't hesitate to contact us. Our customer care team will be available to answer all your questions and ensure that you have the best online shopping experience.
                        <br><br>
                        Best regards,<br>
                        Customer support team.</p>
                    <form id="contactForm">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Your Name" required data-error="Please enter your name">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="text" placeholder="Your Email" id="email" class="form-control" name="name" required data-error="Please enter your email">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="subject" name="name" placeholder="Subject" required data-error="Please enter your Subject">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <textarea class="form-control" id="message" placeholder="Your Message" rows="4" data-error="Write your message" required></textarea>
                                    <div class="help-block with-errors"></div>
                                </div>
                                <div class="submit-button text-center">
                                    <button class="btn hvr-hover" id="submit" type="submit">Send Message</button>
                                    <div id="msgSubmit" class="h3 text-center hidden"></div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Cart -->

<?php
include "footer.php";
?>