<?php include 'layouts/header.php';


if(isset($_POST['submit']))
{   
    if($_SERVER["REQUEST_METHOD"] == "POST"){
      if (!empty($_POST['order_id'])&&!empty($_POST['f1'])&&!empty($_POST['f2'])&&!empty($_POST['f3'])&&!empty($_POST['rating'])) {
      
        $sql1 = "SELECT * FROM work_details WHERE order_id='$_POST[order_id]'";
        $result = mysqli_query($conn, $sql1);        
        if (mysqli_num_rows($result)!=0) { 

                $sql = "SELECT * FROM feedbacks WHERE order_id='$_POST[order_id]'";
                $result = mysqli_query($conn, $sql);        
                if (mysqli_num_rows($result)==0) {

                    
                    $sql = "INSERT INTO feedbacks (order_id, satisfied_with_service, attended_will, delivered_in_time, rating)
                    VALUES ('$_POST[order_id]', '$_POST[f1]', '$_POST[f2]', '$_POST[f3]','$_POST[rating]')";
                    if (mysqli_query($conn, $sql)) {
                        $_SESSION["succmsg"]  = "Thank you for your feedback!"; 
                        $_SESSION["timeout"]  = time()+1;    
                        // echo "<script type='text/javascript'>window.location.href = 'feedback.php';</script>"; 
                        } else {
                            $errmsg = "Error: " . $sql . "<br>" . mysqli_error($conn);
                        }
                } else {
                    $_SESSION["errmsg"]  = "Feedback is available for the order Id :".$_POST['order_id']."";
                    $_SESSION["timeout"]  = time()+1;
                }  
        } else {
            $_SESSION["errmsg"]  = "Invalid Order Id :".$_POST['order_id']."";
            $_SESSION["timeout"]  = time()+1;
        }        
          
      } else {
        $_SESSION["errmsg"]  = "Please fill all fields!";
        $_SESSION["timeout"]  = time()+1;
      }  
    }  
  }


?>


<div class="contact">
            <div class="container">
                <div class="section-header text-center">
                    <p>Your feedback is valuable</p>
                    <h2>Feedback</h2>
                </div>
                <div class="row">
                   
                    <div class="col-md-7 mx-auto">
                        <div class="contact-form">
                    <?php      
                        if(isset($_SESSION["succmsg"])){
                            echo'<label style=" font-weight:700; color:#E81C2E; font-size:18px;">'.$_SESSION["succmsg"].'</label>';
                            if(isset($_SESSION["timeout"])&&($_SESSION["timeout"]<=time())){
            
                                unset($_SESSION["succmsg"]);
                              } 
                         }  
                         if (isset($_SESSION["errmsg"])){  
                            echo'<label   style="font-weight:700; color:red; font-size:18px;">'.$_SESSION["errmsg"].'</label>';
                           
                            if(isset($_SESSION["timeout"])&&($_SESSION["timeout"]<=time())){
                                unset($_SESSION["errmsg"]);
                                
                            } 
                         }
                    ?>      
                            <form action="" method="post" novalidate="novalidate">
                                <div class="control-group">
                                    <label style="font-weight: 800; color:#202C45; font-size:16px;"> Order Id <span style="color:red;">*</span></label>
                                    <input type="text" class="form-control" name="order_id" placeholder="Enter Order Id" required="required" data-validation-required-message="Please enter order id" />
                                    <p class="help-block text-danger"></p>
                                </div>
                                <div class="control-group">
                                    <label style="font-weight: 800; color:#202C45; font-size:16px;">Are  you satisfied with our service ? <span style="color:red;">*</span></label>
                                    <div class="row">
                                        <div class="col-6">
                                        <input type="radio"   value="Yes" name="f1"/>
                                        <label>Yes</label>
                                    </div>
                                        <div class="col-6">
                                        <input type="radio"  value="No" name="f1"/>                                   
                                        <label>No</label>    
                                    </div>
                                    </div>
                                     <p class="help-block text-danger"></p>
                                </div>
                                <div class="control-group">
                                    <label style="font-weight: 800; color:#202C45; font-size:16px;">Have  you been attended will ? <span style="color:red;">*</span></label>
                                    <div class="row">
                                        <div class="col-6">
                                        <input type="radio"  value="Yes" name="f2"  />
                                        <label>Yes</label>
                                    </div>
                                        <div class="col-6">
                                        <input type="radio"  value="No" name="f2"/>                                   
                                        <label>No</label>    
                                    </div>
                                    </div>
                                     <p class="help-block text-danger"></p>
                                </div>
                                <div class="control-group">
                                    <label style="font-weight: 800; color:#202C45; font-size:16px;">Service Delivered in time ? <span style="color:red;">*</span></label>
                                    <div class="row">
                                        <div class="col-6">
                                        <input type="radio" name="f3" value="Yes"/>
                                        <label>Yes</label>
                                    </div>
                                        <div class="col-6">
                                        <input type="radio" name="f3" value="No"/>                                   
                                        <label>No</label>    
                                    </div>
                                    </div>
                                     <p class="help-block text-danger"></p>
                                </div>
                                <div class="control-group">
                                <div class="row">
                                    <div class="col-6">
                                    <label style="font-weight: 800; color:#202C45; font-size:16px;">Rating  0 to 100 % <span style="color:red;">*</span></label>
                                    <p class="help-block text-danger"></p> 
                                    </div>
                                        <div class="col-3">
                                        <input type="text" name="rating" min="0" max="100" class="form-control" minlength="1"  maxlength="3"required="required" data-validation-required-message="Please enter rating" />                                   
                                        
                                    </div>
                                    <div class="col-3">
                                        <span style="font-weight: 800; color:#202C45; font-size:16px; margin-left:-15px;">&nbsp;&nbsp;%</span>
                                    </div>
                                    
                                </div>
                               
                                
                                <div class=" mt-4">
                                    <button class="btn btn-custom btn-block"  name="submit" type="submit">Submit Feedback</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>

<?php include 'layouts/footer.php';?>