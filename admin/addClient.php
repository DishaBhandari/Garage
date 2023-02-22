<?php 



include 'layouts/header.php';


if(isset($_POST['submit']))
{   
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if (!empty($_POST['name'])&&!empty($_POST['contact'])&&!empty($_POST['pincode'])&&!empty($_POST['vehicle'])&&!empty($_POST['address'])&&!empty($_POST['manufacturer'])&&!empty($_POST['car_model'])&&!empty($_POST['fuel'])&&!empty($_POST['year'])) {      
            
            $sql1 = "SELECT * FROM client_details WHERE vehicle_no='$_POST[vehicle]' ";
            $result1 = mysqli_query($conn, $sql1); 

            if (mysqli_num_rows($result1)==0) {
            
                    $sql = "SELECT * FROM client_details WHERE id=(SELECT max(id) FROM client_details)";
                    $result = mysqli_query($conn, $sql); 
                    $row = mysqli_fetch_assoc($result);

                            $dummy_id = $row['id']+1;
                            if(strlen($dummy_id)==1){
                                $gen_id = '0000'.$dummy_id;
                            } elseif(strlen($dummy_id)==2){
                                $gen_id = '000'.$dummy_id;
                            }elseif(strlen($dummy_id)==3){
                                $gen_id = '00'.$dummy_id;
                            }elseif(strlen($dummy_id)==4){
                                $gen_id = '0'.$dummy_id;
                            }elseif(strlen($dummy_id)==5){
                                $gen_id = $dummy_id;
                            };
                
                    $client_id = date('Y').'/'.$_POST["vehicle"].'/'.$gen_id;
                   
                    $manufacturer_id  = implode(", ", $_POST['manufacturer']);
                    $model_id  = implode(", ", $_POST['car_model']);
                    $fuel_id  = implode(", ", $_POST['fuel']);


                    $sql1 = "INSERT INTO client_details ( client_id, name, contact, email, pincode, address, vehicle_no, manufacturer_id, model_id, fuel_id, manufacture_year)
                    VALUES ('$client_id', '$_POST[name]', '$_POST[contact]', '$_POST[email]', '$_POST[pincode]', '$_POST[address]', '$_POST[vehicle]', '$manufacturer_id', '$model_id', '$fuel_id', '$_POST[year]')";

                
                    if (mysqli_query($conn, $sql1)) {
                        $_SESSION["succmsg"]  = "Client added successfully";  
                        $_SESSION["timeout"]  = time()+1;
                        echo "<script type='text/javascript'>window.location.href = 'listClient.php';</script>";  
                        
                    } else {
                        $errmsg = "Error: " . $sql1 . "<br>" . mysqli_error($conn);
                    } 
            } else{
                $errmsg = "Vehicle No. already exists!";
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
                    <h2 class="m-0">Client</h2>
                </div><!-- /.col -->
                <div class="col-sm-6 mt-4">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Add Client</li>
                    </ol>
                </div><!-- /.col -->
            </div>
         
            
            <?php  if(!empty($errmsg))
              {
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">'.
                  $errmsg
                  . '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
              }
            ?> 
                <!-- left column -->
               
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Add Client</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="" method="post" >
                            
                            <div class="card-body">
                            <h5 class="fw-bolder"> Personal Information</h5>
                            <hr class="mb-3"> 
                                <div class="row"> 
                                    
                                <div class="form-group col-sm-3">
                                    <label for="exampleInputTitle1">Name <span style="color:red;">*</span></label>
                                    <input type="text" class="form-control"  name="name"
                                        placeholder="Enter Client Name" required>
                                </div>
                                <div class="form-group col-sm-3">
                                    <label >Contact <span style="color:red;">*</span></label>
                                    <input type="tel" class="form-control"  minlength="10" maxlength="10"  pattern="[0-9]{10}" name="contact"
                                        placeholder="Enter Client Contact" required>                                    
                                </div>
                                <div class="form-group col-sm-3">
                                    <label >Email</label>
                                    <input type="email" class="form-control"   name="email"
                                        placeholder="Enter Client Email" >                                    
                                </div>
                                <div class="form-group col-sm-3">
                                    <label >Pincode  <span style="color:red;">*</span></label>
                                    <input type="tel" minlength="6" maxlength="6"  pattern="[0-9]{6}" class="form-control" required  name="pincode"
                                        placeholder="Enter Client Pincode" >                                    
                                </div>
                                </div>
                                <div class="form-group">
                                    <label >Address <span style="color:red;">*</span></label>
                                    <textarea class="form-control"  name="address"
                                        placeholder="Enter Client Address"></textarea>
                                </div> 

                                <h5 class="fw-bolder mt-4"> Vehicle Information</h5>
                                <hr class="mb-3"> 
                                <div class="row">
                                <div class="form-group col-sm-6 ">
                                    <label >Vehicle No. <span style="color:red;">*</span></label>
                                    <input type="text" class="form-control"  name="vehicle"
                                        placeholder="Enter Client Vehicle No." required>                                    
                                </div>
                                <div class="form-group col-sm-6">                                        
                                    <label>Manufacturer <span style="color:red;">*</span></label>
                                   
                                    <select  class="form-control manufacturer" name="manufacturer[]" required>
                                    <?php
                                    $sql11 = "SELECT * FROM manufacturers WHERE status = 'Active' AND deleted_at is NULL";  
                                    $result11 = mysqli_query($conn, $sql11);
                                    echo'<option value="" selected>Select Manufacturer</option>';
                                     while($data1= mysqli_fetch_assoc($result11)) {
                                    echo '<option value="'.$data1['id'].'">'.$data1['manufacturer'].'</option>';
                                     }
                                    ?>
                                    </select>   
                                    </div>                                 
                               

                                
            </div>
                                
                                
                                <div class="row">

                                <div class="form-group col-sm-4" id="car_select" >  
                                <label>Car Model <span style="color:red;">*</span></label>     
                                <select  class="form-control fuel_type" name="car_model[]" required>                                  
                                                            
                                        
                                    <option value="" selected>Select Car Model</option>
                                   
                                    
                                     
                                </select> 
                                    </div> 
                                    
                                 

                                <div class="form-group fuel_type col-sm-4" id="fuel_select">                                        
                                <label>Fuel Type <span style="color:red;">*</span></label>    
                                <?php $sql13 = "SELECT * FROM fuel_types WHERE status='Active' AND deleted_at is NULL";
	                                if ($result13=mysqli_query($conn, $sql13)) {?>                               
                                        
                                    <select  class="form-control fuel_type" name="fuel[]" required>
                                    <option value="" selected>Select Fuel type</option>
                                    <?php while($row = mysqli_fetch_array($result13)){?>
                                    
                                    <option value="<?= $row['id']?>"><?=$row['fuel']?></option>
                                    
                                    <?php }} ?>
                                    </select>                                    
                                    </div>
                                    <div class="form-group col-sm-4" id="model_year"  >                                        
                                         <label >Year Of Manufacture <span style="color:red;">*</span></label>
                                    <input type="number" class="form-control"   id="e_text" name="year"
                                        min="1990" max="<?= date("Y");  ?>" placeholder="Select Manufacture Year" required >                            
                                </div>   
                                    </div>              
                                                     
                               
                                
                                </div>
                               

                                
                                
                            </div>                            

                            <div class="mb-4 card-footer">
                            <input type="submit" class="btn btn-primary" name="submit" value="Add Client">
                            </div>
                            <script>
                                var editor = CKEDITOR.replace('address');
                                editor.resize('100%', '100');
                            </script>

                        </form>
                    </div>
                    <!-- /.card -->
                
            
        </div>
        </div>
    </section>



<script>
    $(document).ready(function() {
        
	// $.ajax({
	// 	url: "View_ajax.php",
	// 	type: "POST",
	// 	cache: false,
	// 	success: function(dataResult){
	// 		$('#table').html(dataResult); 
	// 	}
    
	$(document).on("change", ".manufacturer", function() { 
        var manufacturer_id = $(".manufacturer option:selected").val();     
          
		$.ajax({
			url: "car_ajax.php",
			type: "POST",
			data:{
				id: manufacturer_id,
                table: "car_models"
            },
            // datatype: JSON,
			success: function(response){
               
                $('#car_select').replaceWith(response);
              
            
               
			}
		});
	});

    // $(document).on("change", ".car_model", function() {   
       
	// 	$.ajax({
	// 		url: "car_ajax.php",
	// 		type: "POST",
	// 		data:{
	// 			table: "fuel_types"
    //         },
    //         // datatype: JSON,
	// 		success: function(response){
    //             console.log(response);
    //             $('#fuel_select').replaceWith(response);
              
            
               
	// 		}
	// 	});
	// });

    
});

</script>

<?php include 'layouts/footer.php';?>    