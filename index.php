



<?php 

include 'layouts/header.php';


 
 $sql = "SELECT * FROM sliders WHERE status='active' AND deleted_at is NULL";  
 $result = mysqli_query($conn, $sql);  
 



        echo '
        <div class="row mx-0">
        <div class="col-lg-9" style="padding:0;">
        
        <div class="carousel" style="margin:0;  margin-right:0; ">          
                <div class="owl-carousel">';
                $i=1;
 while($row = mysqli_fetch_array($result)) {
    echo '<div class="carousel-item">
                        <div class="carousel-img">
                            <img src="image/'.$row["slider_image"].'" alt="Image">
                        </div>
                        <div class="carousel-text">
                           
                            <h1>'.$row["slider_title"].'</h1>
                            <h3>
                            '.$row["slider_description"].'
                            </h3>
                        /
                        </div>
                    </div>';
                   
                }
                echo '     </div>
        </div>
        </div>';
        ?> 
  <!-- <a class="btn btn-custom" href="">Explore More</a> -->
    <div class="location col-lg-3 contact-div" style="padding:0;">
    <div class="location-form " id="location-form-contact" style="border-radius:0px; padding:30px 30px; ">
                            <h3>Contact Us</h3>                          

                            <form action="" method="post" id="form-1">
                                <label id="contact-msg" style="display:none"></label>
                                <div class="control-group" style="margin-top:25px;">
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Name" required="required" />
                                </div>
                                <div class="control-group" style="margin-top:25px;">
                                    <input type="tel" id="contact"  class="form-control" minlength="10" maxlength="10"  pattern="[0-9]{10}" name="contact" placeholder="Contact No." required="required" />
                                </div>
                                <div class="control-group" style="margin-top:25px;">
                                    <textarea class="form-control" id="message" name="message" placeholder="Message" required="required"></textarea>
                                </div>
                                <div  style="margin:30px 0;">
                                    <button class="btn btn-custom" id="sendMessageButton" type="submit" >Send Message</button>
                                </div>
                            </form>
                        </div>
            </div>
    </div>
 

        <!-- About Start -->
        <div class="about">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 mt-3">
                        <div class="about-img">
                            <img src="image/service1.jpg" alt="Image" style="height:500px;">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="section-header text-left">
                            <p>About Us</p>
                            <h2>car service and repairing</h2>
                        </div>
                        <div class="about-content">
                            <p>Our Objective  is to  provide Customer  Satisfaction First. We have  a highly skilled dedicated team for car serving and repairing  available 24*7  to make car services hassle free.  We facilitate  ....
                            </p>
                            <ul>
                                <li><i class="far fa-check-circle"></i>32+ years of experience</li>
                                <li><i class="far fa-check-circle"></i>Felicitated by various awards </li>
                                <li><i class="far fa-check-circle"></i>Highly skilled dedicated team </li>
                                <li><i class="far fa-check-circle"></i>Service available 24*7 </li>
                            </ul>
                            <a class="btn btn-custom " href="about.php">Read More</a>
                        </div>
                    </div>
                </div>
                <div class="row align-items-center">
                    
                    <div class="col-lg-6">
                        <div class="section-header text-left">
                            <p>More About Us</p>
                            <h2>Achievements</h2>
                        </div>
                        <div class="about-content">
                            
                            <ul>
                            <li><i class="far fa-check-circle"></i>Topper in Automobile Engineering  1982 from Kanpur</li>
                                    <li><i class="far fa-check-circle"></i>Awarded by FAG Bearing Co. 2002</li>
                                    <li><i class="far fa-check-circle"></i>Awarded by Castrol Engine Oil Co. 2002</li>
                                    <li><i class="far fa-check-circle"></i>Awarded by Maruti Suzuki Genuine Parts 2005</li>
                                    <li><i class="far fa-check-circle"></i>Awarded by Castrol Engine Oil Co. 2008</li>
                                    <li><i class="far fa-check-circle"></i>Awarded by Castrol Best Mechanic 2015</li>
                                    <li><i class="far fa-check-circle"></i>Awarded by Mahindra First Choice 20</li>
                                    <li><i class="far fa-check-circle"></i>Awarded by Castrol 2018</li>
                                    <li><i class="far fa-check-circle"></i>Awarded by Minda Co. 2021 & Branded by Minda</li>
                            </ul>
                            
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="about-img">
                            <img src="image/about2.jpg"style="height:400px;" alt="Image">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- About End -->
        

        


        <!-- Service Start -->
        <div class="service">
            <div class="container">
                <div class="section-header text-center">
                    <p>What We Do?</p>
                    <h2>Our Services</h2>
                </div>
                <div class="row service-row">
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-8" >
               
                        <div class="service-item">
                            <!-- <i class="flaticon-car-wash"></i> -->
                            <h3>Annual Maintenance Contract</h3>
                            <p>Gyan Car (GC)   has vest  experience  in repairing & services...</p>
                            <a class="btn btn-custom" href="service.php?q=1">Read More</a>
                        </div>
            </div>
            
                       
                    

                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-8" >                    
                        <div class="service-item">
                            <!-- <i class="flaticon-car-wash-1"></i> -->
                            <h3>Car Services</h3>                         
                            <p>We provide various car services at reasonable price, free pick and drop available...</p>
                            <a class="btn btn-custom   " href="service.php?q=2">Read More</a>
                         </div>
                    </div>
                    
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-8" >          
                    <div class="service-item" >
                            <!-- <i class="flaticon-vacuum-cleaner"></i> -->
                            <h3>Denting and Painting</h3>
                            <p>Denting and painting process is tedious and labour heavy work. The Denting process  ...</p>
                            <a class="btn btn-custom " href="service.php?q=3">Read More</a>
                        </div>
        
                        
                    </div>

                    
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-8" >
                        <div class="service-item">
                            <!-- <i class="flaticon-seat"></i> -->
                            <h3>Insurance Claim</h3>
                            <p>GC deals  with  National Insurance Company, TATA AIG, ICICI Lombard Pvt. Limited..</p>                        
                            <a class="btn btn-custom " href="service.php?q=4">Read More</a>  
                        </div>
                    </div>
                    <!-- <div class="col-lg-3 col-md-6">
                        <div class="service-item">
                            <i class="flaticon-car-service"></i>
                            <h3>Free Pick up $ Drop</h3>
                            <p>Lorem ipsum dolor sit amet elit. Phase nec preti facils ornare velit non metus tortor</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="service-item">
                            <i class="flaticon-car-service-2"></i>
                            <h3>Car Washing</h3>
                            <p>Lorem ipsum dolor sit amet elit. Phase nec preti facils ornare velit non metus tortor</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="service-item">
                            <i class="flaticon-car-wash"></i>
                            <h3>Battery Ckecking and Charging</h3>
                            <p>Lorem ipsum dolor sit amet elit. Phase nec preti facils ornare velit non metus tortor</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="service-item">
                            <i class="flaticon-brush-1"></i>
                            <h3>Engine overhauling </h3>
                            <p>Lorem ipsum dolor sit amet elit. Phase nec preti facils ornare velit non metus tortor</p>
                        </div>
                    </div> -->
                </div>
            </div>
        </div>
        <!-- Service End -->
        
       
        
        <div class="price ">
            <div class="container">
            <div class="section-header text-center mb-4"> 
                            <p>Our Feature For You </p> 
                        </div> 
            <div class="row">
                    <div class="col-md-4">
                        <div class="price-item mb-0">
                           
                            <div class="price-body pt-4 px-3 text-left">
                                <ul>
                                    <li><i class="far fa-check-circle"></i>Free Pick-Up and Drop.</li>
                                    <li><i class="far fa-check-circle"></i>Genuine parts  replacement  of damaged part.</li>
                                    <li><i class="far fa-check-circle"></i>Committed to  deliver the services in time.</li>
                                    <li><i class="far fa-check-circle"></i>Towing From anywhere.</li>
                                    <li><i class="far fa-check-circle"></i>Your  voice message is recognised and work is done accordingly.</li>
                                    <li><i class="far fa-check-circle"></i>Seat Cover Repairing. </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="price-item featured-item mb-0">                                             
                            <div class="price-body pt-4 px-3 text-left">
                                <ul>
                                    <li><i class="far fa-check-circle"></i>We have a team of highly skilled and specialized mechanic.</li>
                                    <li><i class="far fa-check-circle"></i>Gyan Car  used to  participate in all Auto Expo Exhibition to enhance the  latest  technical now-how.</li>
                                    <li><i class="far fa-check-circle"></i>Exterior Cleaning.</li>
                                    <li><i class="far fa-check-circle"></i>Guaranty for 100% Customers Satisfaction.</li>
                                    <li><i class="far fa-check-circle"></i>GM organises Free Camp Check yearly.</li>
                                </ul>
                            </div>                           
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="price-item mb-0">                           
                            <div class="price-body pt-4 px-3 text-left">
                                <ul>
                                <li><i class="far fa-check-circle"></i>Constancy Over  Phone/Video Call.</li>
                                    <li><i class="far fa-check-circle"></i>We listen  customers problem and comply</li>
                                    <li><i class="far fa-check-circle"></i>Suggest for problem solution with economic proposal on demand.</li>
                                    <li><i class="far fa-check-circle"></i>Interior Wet Cleaning.</li>
                                    <li><i class="far fa-check-circle"></i>Suggest for problem solution with economic proposal on demand.</li>
                                </ul>
                            </div>                           
                        </div>
                    </div>
                </div>                
            </div>
        </div>
        
        
        
        <!-- Location Start -->
        <!-- <div class="location">
            <div class="container">
                <div class="row">
                    <div class="col-lg-7  mt-5">
                        <div class="section-header text-center">
                            <p class="text-center mt-3">Service Points</p>
                            <h2 class="text-center mt-3">Car Service & Care Points</h2>
                        </div>
                        <div class="row">
                            <div class="col-md-6 m-auto  mt-5 text-center" >
                                <div class="location-item ">
                                   
                                    <div class="location-text">
                                    
                                        <h2><i class="fa fa-map-marker-alt mr-2"></i>Car Service Point</h2>
                                        <p style="font-size:20px;">Near Fortis Hospital, Vasant Kunj, New Delhi 110070</p>
                                        <p><strong>Call:</strong>+012 345 6789</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-8 m-auto  mt-5 text-center" >
                                        <a href="v_card.php"><button class="btn btn-vcard">Get Visiting Card</button></a>
                                    </div>
                                </div>
                            </div>                      
                        </div>
                        <!-- <div class="d-flex justify-content-center">
                        <div class="location-item text-center">
                                    <i class="far fa-clock"></i>
                                    <div class="location-text">
                                        <h2>Opening Hour</h2>
                                        <p>24*7</p>
                                    </div>
                                </div>
                        </div> -->
                      
                    <!-- </div>
                    <div class="col-lg-5 mt-5">
                        <div class="location-form">
                            <h3>Contact Us</h3>
                            <form id="form-2">
                                
                            <label id="contact-msg2" style="display:none"></label>
                                <div class="control-group">
                                    <input type="text" id="name2" name="name" class="form-control" placeholder="Name" required="required" />
                                </div>
                                <div class="control-group">
                                    <input type="contact" id="contact2" name="contact" class="form-control" minlength="10" maxlength="10"  pattern="[0-9]{10}" placeholder="Contact" required="required" />
                                </div>
                                <div class="control-group">
                                    <textarea class="form-control" id="message2" name="message" placeholder="Message" required="required"></textarea>
                                </div>
                                <div>
                                    <button class="btn btn-custom" type="submit" name="submit" id="sendMessageButton2">Send Message</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>  -->
        <!-- Location End -->


      
        
        
        <!-- Testimonial Start -->
        <div class="testimonial">
            <div class="container">
                <div class="section-header text-center">
                    <p>Testimonial</p>
                    <h2>What our clients say</h2>
                </div>
                <div class="owl-carousel testimonials-carousel">
                    <div class="testimonial-item">
                        <img src="image/testimonial-1.jpg" alt="Image">
                        <div class="testimonial-text">
                            <h3>Client Name</h3>
                            <h4>Profession</h4>
                            <p>
                                Lorem ipsum dolor sit amet elit. Phasel preti mi facilis ornare velit non vulputa. Aliqu metus tortor auctor gravid
                            </p>
                        </div>
                    </div>
                    <div class="testimonial-item">
                        <img src="image/testimonial-1.jpg" alt="Image">
                        <div class="testimonial-text">
                            <h3>Client Name</h3>
                            <h4>Profession</h4>
                            <p>
                                Lorem ipsum dolor sit amet elit. Phasel preti mi facilis ornare velit non vulputa. Aliqu metus tortor auctor gravid
                            </p>
                        </div>
                    </div>
                    <div class="testimonial-item">
                        <img src="image/testimonial-1.jpg" alt="Image">
                        <div class="testimonial-text">
                            <h3>Client Name</h3>
                            <h4>Profession</h4>
                            <p>
                                Lorem ipsum dolor sit amet elit. Phasel preti mi facilis ornare velit non vulputa. Aliqu metus tortor auctor gravid
                            </p>
                        </div>
                    </div>
                    <div class="testimonial-item">
                        <img src="image/testimonial-1.jpg" alt="Image">
                        <div class="testimonial-text">
                            <h3>Client Name</h3>
                            <h4>Profession</h4>
                            <p>
                                Lorem ipsum dolor sit amet elit. Phasel preti mi facilis ornare velit non vulputa. Aliqu metus tortor auctor gravid
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Testimonial End -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.min.js" integrity="sha256-xNzN2a4ltkB44Mc/Jz3pT4iU1cmeR0FkXs4pru/JxaQ=" crossorigin="anonymous"></script>




<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
    <script>
      $(function () {
        $('#form-1').bind('submit', function () {
            $('#sendMessageButton').prop('disabled', "disabled");
            $('#sendMessageButton').html('Sending');
          $.ajax({
            type: 'post',
            url: 'contact_ajax.php',
            data: $('#form-1').serialize(),
            datatype: JSON,
            success: function (response) {
                var response= JSON.parse(response);  
                $('#contact-msg').css('display', 'block');
                $('#location-form-contact').css('padding-top', '10px');
                $('#location-form-contact').css('padding-bottom', '2px');
                        if(response.status=='success')
                            {
                            $('#contact-msg').html(response.msg);   
                            $('#contact-msg').css('color', 'white');
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

<script>
      $(function () {
        $('#form-2').bind('submit', function () {
            $('#sendMessageButton2').prop('disabled', "disabled");
            $('#sendMessageButton2').html('Sending');
          $.ajax({
            type: 'post',
            url: 'contact_ajax.php',
            data: $('#form-2').serialize(),
            datatype: JSON,
            success: function (response) {
                var response= JSON.parse(response);  
;                $('#contact-msg2').css('display', 'block');
                        if(response.status=='success')
                            {
                            $('#contact-msg2').html(response.msg);   
                            $('#contact-msg2').css('color', 'white');
                            $('#name2').val('');
                            $('#contact2').val('');
                            $('#message2').val('');
                            $('#sendMessageButton2').prop('disabled', false);
                            $('#sendMessageButton2').html('Send Message');
                        
                            }  else {
                                $('#contact-msg2').html(response.msg);   
                                $('#contact-msg2').css('color', 'red');
                                $('#sendMessageButton2').prop('disabled', false);
                                $('#sendMessageButton2').html('Send Message');
                            }
            }
          });
          return false;
        });
      });
    </script>


      <script>
        //  
        $(window).scroll(function(){
            if($(window).width() >991.98){
        if(($(window).scrollTop()>88) && ($(window).scrollTop()<484)){
            
        $(".contact-div").css({"margin-top":"73px"})
        // $(".owl-item").css({"left":"0"})
        }else{
        $(".contact-div").css({"margin-top":"0"})
        }
    }
        });
      </script>  

<?php include 'layouts/footer.php';?>    


    