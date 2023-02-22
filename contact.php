<?php include 'layouts/header.php';?>
        
        
        <!-- Page Header Start -->
        <div class="page-header">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h2>Contact Us</h2>
                    </div>
                    <div class="col-12">
                        <a href="">Home</a>
                        <a href="">Contact</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Page Header End -->
        
        
        <!-- Contact Start -->
        <div class="contact">
            <div class="container">
                <div class="section-header text-center">
                    <p>Get In Touch</p>
                    <h2>Contact for any query</h2>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="contact-info">
                            <h2>Quick Contact Info</h2>
                            <div class="contact-info-item">
                                <div class="contact-info-icon">
                                    <i class="far fa-clock"></i>
                                </div>
                                <div class="contact-info-text">
                                    <h3>Opening Hour</h3>
                                    <!-- <p>Mon - Fri, 8:00 - 9:00</p> -->
                                    <p>24 * 7</p>
                                </div>
                            </div>
                            <div class="contact-info-item">
                                <div class="contact-info-icon">
                                    <i class="fa fa-phone-alt"></i>
                                </div>
                                <div class="contact-info-text">
                                    <h3>Call Us</h3>
                                    <p>+012 345 6789</p>
                                </div>
                            </div>
                            <!-- <div class="contact-info-item">
                                <div class="contact-info-icon">
                                    <i class="far fa-envelope"></i>
                                </div>
                                <div class="contact-info-text">
                                    <h3>Email Us</h3>
                                    <p>info@example.com</p>
                                </div>
                            </div> -->
                        </div>
                    </div>
                    <div class="col-md-7">
                        <div class="contact-form">
                            <!-- <div id="success"></div> -->
                            <label id="contact-msg" style="display:none; font-weight:700;"></label>
                            <form name="sentMessage" id="contactForm" novalidate="novalidate">
                                <div class="control-group">
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Your Name" required="required" data-validation-required-message="Please enter your name" />
                                    <p class="help-block text-danger"></p>
                                </div>
                                <div class="control-group">
                                    <input type="tel" class="form-control" id="contact" name="contact" placeholder="Your Contact" minlength="10" maxlength="10"  pattern="[0-9]{10}" required="required" data-validation-required-message="Please enter your contact" />
                                    <p class="help-block text-danger"></p>
                                </div>
                                <div class="control-group">
                                    <textarea class="form-control" id="message" name="message" placeholder="Message" required="required" data-validation-required-message="Please enter your message"></textarea>
                                    <p class="help-block text-danger"></p>
                                </div>
                                <div>
                                    <button class="btn btn-custom"  id="sendMessageButton" name="submit" type="submit">Send Message</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-12">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d876.4178142590134!2d77.15974093595467!3d28.519536885440576!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390d1d080c000001%3A0xdc68ebc7ff708935!2sFortis%20Flt.%20Lt.%20Rajan%20Dhall%20Hospital%2C%20Vasant%20Kunj!5e0!3m2!1sen!2sin!4v1642669427470!5m2!1sen!2sin" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                </div>
                </div>
            </div>
        </div>
        <!-- Contact End -->

        <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
    <script>
      $(function () {
        $('#contactForm').bind('submit', function () {
            $('#sendMessageButton').prop('disabled', 'disabled');
            $('#sendMessageButton').html('Sending');
          $.ajax({
            type: 'post',
            url: 'contact_ajax.php',
            data: $('#contactForm').serialize(),
            datatype: JSON,
            success: function (response) {
                var response= JSON.parse(response);  
;                $('#contact-msg').css('display', 'block');
                        if(response.status=='success')
                            {
                            $('#contact-msg').html(response.msg);   
                            $('#contact-msg').css('color', '#202C45');
                            $('#name').val('');
                            $('#contact').val('');
                            $('#message').val('');
                            $('#sendMessageButton').prop('disabled', false);
                            $('#sendMessageButton').html('Send Message');
                        
                            }  else {
                                $('#contact-msg').html(response.msg);   
                                $('#contact-msg').css('color', 'red');
                                $('#sendMessageButton').prop('disabled', false);
                                $('#sendMessageButton').html('Send Message');
                            }
            }
          });
          return false;
        });
      });
    </script>

<?php include 'layouts/footer.php';?>