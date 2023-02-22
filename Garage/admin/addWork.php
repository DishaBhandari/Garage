<?php 

include 'layouts/header.php';

$vehicle_no = base64_decode($_GET['v']);
$date= str_replace(" ","T",date("Y-m-d H:i"));
$date= str_replace(" "," T",$date);

$sql1 = "SELECT * FROM client_details where vehicle_no='$vehicle_no'";  
$result1 = mysqli_query($conn, $sql1);
$data1 = mysqli_fetch_assoc($result1);

$sql2 = "SELECT * FROM services WHERE status = 'Active'";  
$result2 = mysqli_query($conn, $sql2);

if(isset($_POST['submit']))
{   
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        
       
        if (!empty($_POST['services'])&&!empty($_POST['o_info'])&&!empty($_POST['date'])&&!empty($_POST['acharge'])&&!empty($_POST['bcharge'])) {            
                 
                    $order_id = 'GC'.time();
                    $service = implode(", ", $_POST['services']);
            
                    $sql3 = "INSERT INTO work_details (order_id, client_id, vehicle_no, services, other_info, service_date, actual_charge, billing_charge)
                    VALUES ('$order_id', '$_POST[client_id]','$_POST[vehicle]','$service', '$_POST[o_info]', '$_POST[date]','$_POST[acharge]','$_POST[bcharge]')";
                    if (mysqli_query($conn, $sql3)) {
                        $_SESSION["succmsg"]  = "Work Details added successfully";
                        $_SESSION["timeout"]  = time()+1;
                        echo "<script type='text/javascript'>window.location.href = 'workHistory.php';</script>";  
                        
                    } else {
                        $errmsg = "Error: " . $sql3 . "<br>" . mysqli_error($conn);
                    } 
                             
        } else {
            $errmsg = "Please fill all fields!";
        }  
       
  }
}

?>

    

    <!-- Main content -->
    <section class="content">
        <div class="container">
           
            <div class="row mb-2">
                <div class="col-sm-6  mt-4">
                    <h2 class="m-0">Work Detail</h2>
                </div><!-- /.col -->
                <div class="col-sm-6 mt-4">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Add Work</li>
                    </ol>
                </div><!-- /.col -->
            </div>
         
            
                
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Add Work</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="" method="post" >
                            <div class="card-body">

                            <?php 
            if(!empty($errmsg))
              {
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">'.
                  $errmsg
                  . '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
              }
            ?>  

                                <input type="hidden" value="<?= $data1['client_id'] ?>" name="client_id">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="exampleInputTitle1">Client Name</label>
                                            <input type="text" class="form-control" id="exampleInputTitle1" name="s_name"
                                            value="<?= $data1['name'] ?>" readonly>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="exampleInputTitle1">Vehicle No.</label>
                                            <input type="text" class="form-control" id="exampleInputTitle1" name="vehicle"
                                                value="<?= $data1['vehicle_no'] ?>" readonly>
                                        </div>
                                    </div>
                                </div>    
                                <div class="form-group">
                                    <div class="form-group">                                        
                                    <label class="mb-3">Services <span style="color:red;">*</span></label>
                                   <div class="row">
                                    <?php
                                     while($data2= mysqli_fetch_assoc($result2)) {
                                        echo '     <div class="col-sm-3 mb-3">
                                    <input type="checkbox" class="mr-1" name="services[]" value="'.$data2['id'].'" >
                                    <label class="fw-bold">'.$data2['service_name'].'</label>
                                    </div>';
                                     }
                                    ?>
                                    </div>
                                    
                                </div>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputDescription1">Other Information</label>
                                    <textarea class="form-control" id="exampleInputDescription1" name="o_info"
                                        placeholder="Enter Other Information"></textarea>
                                </div>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                        <label >Service Date <span style="color:red;">*</span></label>
                                        <input type="datetime-local" class="form-control" max="<?= $date ?>" name="date" required placeholder="Enter Service Date">
                                        </div>
                                    </div>    
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                        <label >Actual Charge <span style="color:red;">*</span></label>
                                        <div class="input-group">
                                            <span class="input-group-text" style="font-size: 1.5rem; padding: 0 0.75rem;" ><strong>&#8377;</strong> </span>
                                            <input type="text" class="form-control"  maxlength="7" pattern="[0-9]{.3}" name="acharge" required placeholder="Enter Actual Charge" required>
                                                                            
                                        </div>                                                            
                                        </div>  
                                    </div>    
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                        <label >Billing Charge <span style="color:red;">*</span></label>
                                        <div class="input-group">
                                            <span class="input-group-text" style="font-size: 1.5rem; padding: 0 0.75rem;" ><strong>&#8377;</strong> </span>
                                            <input type="text" class="form-control"  maxlength="7" pattern="[0-9]{.3}" name="bcharge" required placeholder="Enter Billing Charge">
                                                                            
                                        </div>                                                            
                                        </div>  
                                    </div>
                                </div>

            </div>                          <!-- /.card-body -->

                            <div class="mb-4 card-footer">
                            <input type="submit" class="btn btn-primary" name="submit" value="Add Work">
                            </div>
                            <script>
                                var editor = CKEDITOR.replace('o_info');
                                editor.resize('100%', '50');
                            </script>

                        </form>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        
       
    </section>


<?php include 'layouts/footer.php';?>    