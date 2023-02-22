<?php 

include 'layouts/header.php';


        
        $sql = "SELECT car_models.id, car_models.manufacturer_id, car_models.model_name, car_models.status, manufacturers.manufacturer FROM car_models INNER JOIN manufacturers ON car_models.manufacturer_id = manufacturers.id  WHERE car_models.status='Active' AND car_models.deleted_at is NULL";  
        $result = mysqli_query($conn, $sql);  
          if (mysqli_num_rows($result)==0) {             
            $errmsg = "No Services Available!";
          }

if(isset($_POST['add']))
{   
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if (!empty($_POST['name'])) {    

            $manufacturer_id = implode(" ",$_POST['manufacturer']);
            $sql1 = "SELECT * FROM car_models WHERE manufacturer_id='$manufacturer_id' AND model_name='$_POST[name]'";
            $result1 = mysqli_query($conn, $sql1); 

            if (mysqli_num_rows($result1)==0) {
                      
            $sql2 = "INSERT INTO car_models (manufacturer_id, model_name)
            VALUES ('$manufacturer_id','$_POST[name]')";
            if (mysqli_query($conn, $sql2)) {
              $_SESSION["succmsg"]  = "Car Model added successfully";
              $_SESSION["timeout"]  = time()+1;

                echo "<script type='text/javascript'>window.location.href = 'model.php';</script>";  
                     
                
            } else {
                $errmsg = "Error: " . $sql . "<br>" . mysqli_error($conn);
            } 
        } else {
            $errmsg = "Car Model already exists!";
        }
                                
        } else {
            $errmsg = "Please fill all fields!";
        }  
       
  }
}


if(isset($_POST['edit']))
{   
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if (!empty($_POST['name'])) {    

          $manufacturer_id = implode(" ",$_POST['e_manufacturer']);

            $sql1 = "SELECT * FROM car_models WHERE model_name='$_POST[name]' AND  manufacturer_id = $manufacturer_id ";
            if (mysqli_query($conn, $sql1)) {
            $result1 = mysqli_query($conn, $sql1); 

            if (mysqli_num_rows($result1)==0) {

            $sql2 = "UPDATE  car_models SET manufacturer_id='$manufacturer_id', model_name='$_POST[name]' WHERE id=$_POST[id] ";
            if (mysqli_query($conn, $sql2)) {  
              $_SESSION["succmsg"]  = "Car Model added successfully"; 
              $_SESSION["timeout"]  = time()+3; 
                echo "<script type='text/javascript'>window.location.href = 'model.php';</script>";  
                           
                
            } else {
                $errmsg = "Error: " . $sql . "<br>" . mysqli_error($conn);
            } 
        } else {
            $errmsg = "Car  Model already exists!";
        }
                                
        } else {
            $errmsg = "Please fill all fields!";
        }  
    }  
  }
} 
?>

<?php  if(!empty($errmsg))   {?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?= $errmsg ?>
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <?php }    ?>
           

         <?php if(isset($_SESSION["loggedin"])&&(isset($_SESSION["succmsg"]))){?>
           <div class="alert alert-success alert-dismissible fade show" role="alert">
           <?= $_SESSION["succmsg"]  ?>

           <?php if(isset($_SESSION["timeout"])&&($_SESSION["timeout"]<=time())){
            
            unset($_SESSION["succmsg"]);
          } ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                 </div>
                 <?php
                 
   
                 
         }?>
         
      



    <!-- Content Wrapper. Contains page content -->

     
    <section class="content">
        <div class="container">
           
            <div class="row mt-2">
                <div class="col-sm-6 mt-4">
                    <h2 class="m-0">Car Model</h2>
                </div><!-- /.col -->
                <div class="col-sm-6  mt-4">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin') }}">Home</a></li>
                        <li class="breadcrumb-item active">Car Model List</li>
                    </ol>
                </div><!-- /.col -->
            </div>
            <button type="button" class="btn btn-success status ml-2 mb-3" data-toggle="modal" data-target="#Add">Add Car Model</button>
            <div class="row">
                <div class="col-12  table-responsive">
                    <table id="example1" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Manufacturer</th> 
                                <th>Model Name</th>   
                                 <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            $i=1;
                            while($row = mysqli_fetch_array($result)) {
                               
                        echo '<tr> 
                                <td>'.$i.'</td>
                                <td>'. $row["manufacturer"] .'</td>
                                <td>'. $row["model_name"] .'</td><td>  ';                      
                               
                                echo'<button type="button" class="btn btn-primary edit mb-2 ml-2" data-id="'. $row["id"] .'" data-man-id="'. $row["manufacturer_id"] .'"  data-toggle="modal" data-target="#Edit">Edit</button>'; 
                                if($row["status"] == 'Active'){
                                echo'<button type="button" class="btn btn-danger status mb-2 ml-2" data-id="'. $row["id"] .'" id="s'. $row["id"] .'">Deactive</button>';
                                   
                                       
                            }else {
                                echo'<button type="button" class="btn btn-success status mb-2 ml-2" data-id="'. $row["id"] .'" id="s'. $row["id"] .'">Active</button>';
                              } 
                              echo'<button type="button" class="btn btn-success delete mb-2 ml-2" data-id="'. $row["id"] .'" >Delete</button>';   
                               '</td>
                            </tr>';
                            $i++;
                            }
                        ?>    
                        <tbody>
                    </table>
                </div>
            </div>
        </div>

    </section>

    <!-- /.content-wrapper -->

    <!-- ADD MODAL -->
    <div class="modal fade" id="Add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Car Model</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="" method="post"> 

        <div class="form-group">                                        
            <label>Manufacturer</label>
            
            <select  class="form-control manufacturer" name="manufacturer[ ]">
            <?php
            $sql = "SELECT * FROM manufacturers WHERE status = 'Active' AND deleted_at is NULL";  
            $result = mysqli_query($conn, $sql);
              while($row= mysqli_fetch_assoc($result)) {
            echo '<option value="'.$row['id'].'">'.$row['manufacturer'].'</option>';
              }
            ?>
            </select>                                    
        </div>

            
        <div class="form-group">
            <label for="exampleInputTitle1">Model Name</label>
            <input type="text" class="form-control"  name="name"
                placeholder="Enter Model Name" required>
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" name="add" class="btn btn-primary">Add</button>
        </div>
        </form>
      </div>
     
    </div>
  </div>
</div>
    
    <!-- Edit MODAL -->
    <div class="modal fade" id="Edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Car Model</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="" method="post"> 

        <input type="hidden"  value="" name="id" id="e_id">
         
        <div class="form-group">
          <label>Manufacturer</label>
              
              <select  class="form-control manufacturer" id="e_select" name="e_manufacturer[ ]">
              <?php
              $sql = "SELECT * FROM manufacturers WHERE status = 'Active' AND deleted_at is NULL";  
              $result = mysqli_query($conn, $sql);
                while($row= mysqli_fetch_assoc($result)) {
              echo '<option value="'.$row['id'].'">'.$row['manufacturer'].'</option>';
                }
              ?>
              </select>                                    
        </div>
          <div class="form-group">
                  <label for="exampleInputTitle1">Model Name</label>
                  <input type="text" class="form-control" value="" id="e_text" name="name"
                      placeholder="Enter Model Name" required>
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
    $(document).ready(function() {
	
        $(document).on("click", ".edit", function() { 
            var id = $(this). data("id"); 
            var manufacturer_id = $(this). data("man-id");
            var model = $(this).parent().prev().html();
            // var manufacturer = $(this).parent().prev().prev().html();
           
            $('#e_id').val(id);
            $('#e_text').val(model);

            $('#e_select').val(manufacturer_id).prop('selected', true);
           

           
        });
      

	$(document).on("click", ".status", function() { 
        var id = $(this). data("id");      
		$.ajax({
			url: "status_ajax.php",
			type: "POST",
			data:{
				id: $(this).attr("data-id"),
                status: $(this).html(),
                table: "car_models"
            },
            datatype: JSON,
			success: function(response){
                var status= JSON.parse(response);    
                console.log(status.response);
            
                if(status.response=="Deactive"){
                    $('#s'+id).addClass("btn-success");
                    $('#s'+id).removeClass("btn-danger")                    
                    $('#s'+id).html('Active')
                } else {
                    $('#s'+id).addClass("btn-danger");
                    $('#s'+id).removeClass("btn-sucess");
                    $('#s'+id).html('Deactive')
                }
			}
		});
	});


    $(document).on( "click", ".delete",  function() {  
        var id = $(this). data("id"); 
        var element = $(this).parent().parent();  
        
		$.ajax({
			url: "delete_ajax.php",
			type: "POST",
			data:{
				id: $(this).attr("data-id"),
                table: "car_models"
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
    </script>

    <?php 

include 'layouts/footer.php';

?>
