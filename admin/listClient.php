
<?php 

include 'layouts/header.php';


        
        $sql = "SELECT client_details.* ,

        manufacturers.manufacturer, car_models.model_name, fuel_types.fuel
        FROM client_details LEFT JOIN manufacturers
        ON client_details.manufacturer_id = manufacturers.id
        LEFT JOIN car_models
        ON client_details.model_id = car_models.id
        LEFT JOIN fuel_types
        ON client_details.fuel_id = fuel_types.id
        WHERE client_details.deleted_at is NULL";  
        $result = mysqli_query($conn, $sql);  
          if (mysqli_num_rows($result)==0) {             
            $errmsg = "No Clients Available!";
          }



if(isset($_POST['edit']))
{   
    if($_SERVER["REQUEST_METHOD"] == "POST"){
            if (!empty($_POST['name'])&&!empty($_POST['contact'])&&!empty($_POST['vehicle'])&&!empty($_POST['address'])&&!empty($_POST['manufacturer'])&&!empty($_POST['car_model'])&&!empty($_POST['fuel'])&&!empty($_POST['year'])) {            
                
                // $sql1 = "SELECT * FROM client_details WHERE vehicle_no='$_POST[vehicle]' ";
                // if (mysqli_query($conn, $sql1)) {
                // $result1 = mysqli_query($conn, $sql1); 
    
                if (mysqli_num_rows($result1)==0) {              
                        
                        $manufacturer_id  = implode(", ", $_POST['manufacturer']);
                        $model_id  = implode(", ", $_POST['car_model']);
                        $fuel_id  = implode(", ", $_POST['fuel']);
    
    
                        $sql1 = "UPDATE client_details SET  name='$_POST[name]', contact='$_POST[contact]', email='$_POST[email]', pincode='$_POST[e_pincode]', address='$_POST[address]', vehicle_no='$_POST[vehicle]', manufacturer_id='$manufacturer_id', model_id='$model_id', fuel_id=$fuel_id, manufacture_year='$_POST[year]' WHERE id = '$_POST[id]'";
    
                    
                        if (mysqli_query($conn, $sql1)) {
                            $_SESSION["succmsg"]  = "Client updated successfully";  
                            $_SESSION["timeout"]  = time()+1;
                            echo "<script type='text/javascript'>window.location.href = 'listClient.php';</script>";  
                            
                        } else {
                            $errmsg = "Error: " . $sql1 . "<br>" . mysqli_error($conn);
                        } 
                // } else{
                //     $errmsg = "Vehicle No. already exists!";
                // }        
                                    
            } else {
                $errmsg = "Please fill all fields!";
            }  
           
      
    }  
  }
}         
        

?>
<style>
    .success{
        padding: 0.25rem 1.3rem;

    }
    .danger{
        padding: 0.25rem 0.75rem;
    }
</style>

        <?php  if(!empty($errmsg))  {?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?= $errmsg ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php }
        ?>
           

         <?php if(isset($_SESSION["loggedin"])&&isset($_SESSION["succmsg"])){?>
           <div class="alert alert-success alert-dismissible fade show" role="alert">
           <?= $_SESSION["succmsg"]  
           ?>
           <?php if(isset($_SESSION["timeout"])&&($_SESSION["timeout"]<=time())){
            
            unset($_SESSION["succmsg"]);
          } ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                 </div>                
      <?php   }?>
         
    <!-- Content Wrapper. Contains page content -->
    <section class="content">
        <div class="container">
           
            <div class="row mt-2">
                <div class="col-sm-6 mt-4">
                    <h2 class="m-0">Clients</h2>
                </div><!-- /.col -->
                <div class="col-sm-6  mt-4">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin') }}">Home</a></li>
                        <li class="breadcrumb-item active">Client List</li>
                    </ol>
                </div><!-- /.col -->
            </div>
          
            <div class="row ">
                
                <div class="col-12 ">
                    <table id="example1" class="table table-striped table-bordered table-responsive" style="width:100%">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Client Id</th> 
                                <th>Name</th>
                                <th>Contact</th>
                                <th>Email</th>                                
                                <th>Address</th> 
                                <th>Pincode</th>
                                <th>Vehicle No.</th>  
                                <th>Manufacturer</th>   
                                <th>Car Model</th>   
                                <th>Fuel Type</th> 
                                <th>Year of Manufacture</th>                     
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php 
                                $i=1;
                                while($row = mysqli_fetch_array($result)) {
                                    $email = $row["email"]==NULL ? 'Not Available' : $row["email"];
                                    $vehicle = base64_encode($row["vehicle_no"]);
                            ?>
                            <tr>
                                <td><?= $i ?></td>
                                <td><?=  $row['client_id'] ?></td>
                                <td><?=  $row['name'] ?></td>
                                <td><?=  $row['contact'] ?></td>
                                <td><?=  $row['email'] ?></td>
                                <td><?=  $row['address'] ?></td>
                                <td><?=  $row['pincode'] ?></td>
                                <td><?=  $row['vehicle_no'] ?></td>
                                <td><?=  $row['manufacturer'] ?></td>
                                <td><?=  $row['model_name'] ?></td>
                                <td><?=  $row['fuel'] ?></td>
                                <td><?=  $row['manufacture_year'] ?></td>
                                <td>
                                    <button type="button" class="btn btn-primary edit " style ="padding: 0.20rem 1.65rem;" data-id="<?= $row["id"] ?>" data-man-id="<?= $row["manufacturer_id"] ?>" data-mod-id="<?= $row["model_id"] ?>" data-fue-id="<?= $row["fuel_id"] ?>" data-toggle="modal" data-target="#Edit">Edit</button>
                                    <a href="addWork.php?v=<?= $vehicle ?>"  style ="padding: 0.27rem 0.55rem;" type="button" class="btn btn-secondary mt-1"  >Add Work</a> 
                                    <?php if($row["status"] == 'Active'){ ?>
                                        <button type="button" class="btn btn-danger danger status mt-1" id="<?= $row["id"] ?>" data-id="<?= $row["id"] ?>" data-man-id="<?=$row["manufacturer_id"] ?>"  data-mod-id="<?= $row["model_id"] ?>" data-fue-id="<?= $row["fuel_id"] ?>"  >Deactive</button>
                                    <?php } else {?>
                                        <button type="button"  class="btn btn-success success status mt-1" id="<?= $row["id"] ?>" data-id="<?= $row["id"] ?>" data-man-id="<?=$row["manufacturer_id"] ?>"  data-mod-id="<?= $row["model_id"] ?>" data-fue-id="<?= $row["fuel_id"] ?>"  >Active</button>
                                    <?php } ?>
                                    <button type="button" style ="padding: 0.25rem 1.25rem;" class="btn btn-success delete mt-1" data-id="<?= $row["id"] ?>" >Delete</button>
                                </td>
                            </tr>                            
                            <?php $i++;
                             } ?>
                        <tbody>
                    </table>
                </div>
            </div>
        </div>

    </section>
    <!-- /.content-wrapper -->


    <!-- Edit MODAL -->
<div class="modal fade" id="Edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content" style="width: 770px;">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Client Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="" method="post" >
                            
                            <div class="card-body">
                            <h5 class="fw-bolder"> Personal Information</h5>
                            <hr class="mb-3"> 
                                <div class="row"> 
                            <input type="hidden" id="e_id" name="id">
                    
                                <div class="form-group col-sm-3">
                                    <label for="exampleInputTitle1">Name <span style="color:red;">*</span></label>
                                    <input type="text" class="form-control"  id="e_name" name="name"
                                        placeholder="Enter Client Name" required>
                                </div>
                                <div class="form-group col-sm-3">
                                    <label >Contact <span style="color:red;">*</span></label>
                                    <input type="tel" class="form-control"  minlength="10" maxlength="10"  pattern="[0-9]{10}" id="e_contact" name="contact"
                                        placeholder="Enter Client Contact" required>                                    
                                </div>
                                <div class="form-group col-sm-3">
                                    <label >Email</label>
                                    <input type="email" class="form-control"  id="e_email" name="email"
                                        placeholder="Enter Client Email" >                                    
                                </div>
                                <div class="form-group col-sm-3">
                                    <label >Pincode <span style="color:red;">*</span></label>
                                    <input type="tel" minlength="6" maxlength="6"  pattern="[0-9]{6}" class="form-control" required  id="e_pincode" name="e_pincode"
                                        placeholder="Enter Client Pincode" >                                    
                                </div>
                                </div>
                                <div class="form-group">
                                    <label >Address <span style="color:red;">*</span></label>
                                    <textarea class="form-control"  id="e_address" name="address"
                                        placeholder="Enter Client Address">
                                    </textarea>
                                </div> 

                                <h5 class="fw-bolder mt-4"> Vehicle Information</h5>
                                <hr class="mb-3"> 
                                <div class="row">
                                <div class="form-group col-sm-6 ">
                                    <label >Vehicle No. <span style="color:red;">*</span></label>
                                    <input type="text" class="form-control"  id="e_vehicle" name="vehicle"
                                        placeholder="Enter Client Vehicle No." required>                                    
                                </div>
                                <div class="form-group col-sm-6">                                        
                                    <label>Manufacturer <span style="color:red;">*</span></label>
                                   
                                    <select  class="form-control manufacturer" id="e_manufacturer" name="manufacturer[]" required>
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

                                <div class="form-group col-sm-4" id="car_select" required >  
                                <label>Car Model <span style="color:red;">*</span></label>     
                               
                                    </div> 
                                <div class="form-group fuel_type col-sm-4" id="fuel_select" required>                                        
                                <label>Fuel Type <span style="color:red;">*</span></label>    
                                <?php $sql13 = "SELECT * FROM fuel_types WHERE status='Active' AND deleted_at is NULL";
	                                if ($result13=mysqli_query($conn, $sql13)) {?>                               
                                        
                                    <select  class="form-control fuel_type" id="e_fuel" name="fuel[]">  
                                    <option value="" selected>Select Fuel Type</option>                                  
                                    <?php while($row = mysqli_fetch_array($result13)){?>
                                    
                                    <option value="<?= $row['id']?>"><?=$row['fuel']?></option>
                                    
                                    <?php }} ?>
                                    </select>                                    
                                    </div>
                                    <div class="form-group col-sm-4" id="model_year"  >                                        
                                         <label >Year Of Manufacture <span style="color:red;">*</span></label>
                                    <input type="number" class="form-control"  id="e_year"  name="year"
                                        min="1990" max="<?= date("Y");  ?>" placeholder="Select Manufacture Year" required>                            
                                </div>   
                                    </div>  
                                </div>
                            </div>       
                            
                                <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" name="edit" class="btn btn-primary">Update</button>
      </div>
        </form>
      </div>
     
    </div>
  </div>
</div>
<script>
    var editor = CKEDITOR.replace('address');
    editor.resize('10%', '100');
</script>

 
    <script>
    $(document).ready(function() {

        $(document).on("ready change", ".manufacturer", function() { 
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
	
        $(document).on("click", ".edit", function() { 
            var id = $(this). data("id"); 
            var manufacturer_id = $(this). data("man-id");
            var model_id = $(this). data("mod-id");
            var fuel_id = $(this). data("fue-id");


            var name = $(this).parent().prev().prev().prev().prev().prev().prev().prev().prev().prev().prev().html();
            var contact = $(this).parent().prev().prev().prev().prev().prev().prev().prev().prev().prev().html();
            var email = $(this).parent().prev().prev().prev().prev().prev().prev().prev().prev().html();
            var address = $(this).parent().prev().prev().prev().prev().prev().prev().prev().html();
            var pincode = $(this).parent().prev().prev().prev().prev().prev().prev().html();
            var vehicle = $(this).parent().prev().prev().prev().prev().prev().html();
            var year = $(this).parent().prev().html();
           
            $('#e_id').val(id);
            $('#e_name').val(name);
            $('#e_contact').val(contact);
            $('#e_email').val(email);
            $('#e_address').html(address);
            $('#e_pincode').val(pincode);
            $('#e_vehicle').val(vehicle);
            $('#e_year').val(year);

            CKEDITOR.instances['e_address'].setData(address);
      
            $('#e_manufacturer').val(manufacturer_id).prop('selected', true);
            $('#e_model').val(model_id).prop('selected', true);
            $('#e_fuel').val(fuel_id).prop('selected', true);        
            
    
          
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
                $('#model').val(model_id).prop('selected', true);
               
			}
		});
           
        });
    
	$(document).on("click", ".status", function() { 
        var id = $(this). data("id");      
		$.ajax({
			url: "status_ajax.php",
			type: "POST",
			data:{
				id: $(this).attr("data-id"),
                status: $(this).html(),
                table: "client_details"
            },
            datatype: JSON,
			success: function(response){
                var status= JSON.parse(response);    
                console.log(status.response);
            
                if(status.response=="Deactive"){
                    $('#'+id).removeClass("btn-danger")  
                    $('#'+id).addClass("btn-success"); 
                    $('#'+id).removeClass("danger")  
                    $('#'+id).addClass("success");                                                        
                    $('#'+id).html('Active')
                } else {   
                    $('#'+id).removeClass("btn-success");                 
                    $('#'+id).addClass("btn-danger");                
                    $('#'+id).removeClass("success");                 
                    $('#'+id).addClass("danger");  
                    $('#'+id).html('Deactive')
                }
			}
		})
	});


    $(document).on( "click", ".delete",  function() {  
        var id = $(this). data("id"); 
        var element = $(this).parent().parent();  
        
		$.ajax({
			url: "delete_ajax.php",
			type: "POST",
			data:{
				id: $(this).attr("data-id"),
                table: "client_details"
            },
            datatype: JSON,
			success: function(response){  
                var status= JSON.parse(response);    
				if(status.response=="DONE"){
                   element.remove();     
                }
			}
		})
	});
});

// $('#example').DataTable({
//          "responsive": true,

//     });
    </script>




    <?php 

include 'layouts/footer.php';

?>
<script>
    $('#example1').dataTable();
</script>