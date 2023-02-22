<?php 

include 'layouts/header.php';


        
        $sql = "SELECT * FROM fuel_types WHERE deleted_at is NULL";  
        $result = mysqli_query($conn, $sql);  
          if (mysqli_num_rows($result)==0) {             
            $errmsg = "No Services Available!";
          }

          if(isset($_POST['add']))
{   
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if (!empty($_POST['name'])) {    

            $sql1 = "SELECT * FROM fuel_types WHERE fuel='$_POST[name]'";
            $result1 = mysqli_query($conn, $sql1); 

            if (mysqli_num_rows($result1)==0) {

            $sql2 = "INSERT INTO fuel_types ( fuel)
            VALUES ('$_POST[name]')";
            if (mysqli_query($conn, $sql2)) {
                $_SESSION["succmsg"]  = "Fuel Type added successfully";  
                $_SESSION["timeout"]  = time()+1;
                echo "<script type='text/javascript'>window.location.href = 'fuel.php';</script>";  
                           
                
            } else {
                $errmsg = "Error: " . $sql . "<br>" . mysqli_error($conn);
            } 
        } else {
            $errmsg = "Fuel Type already exists!";
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

            $sql1 = "SELECT * FROM fuel_types WHERE fuel='$_POST[name]'";
            $result1 = mysqli_query($conn, $sql1); 

            if (mysqli_num_rows($result1)==0) {

            $sql2 = "UPDATE  fuel_types SET fuel='$_POST[name]' WHERE id=$_POST[id]";
            if (mysqli_query($conn, $sql2)) {
                $_SESSION["succmsg"]  = "Fuel Type added successfully";  
                $_SESSION["timeout"]  = time()+3;
                echo "<script type='text/javascript'>window.location.href = 'fuel.php';</script>";  
                           
                
            } else {
                $errmsg = "Error: " . $sql . "<br>" . mysqli_error($conn);
            } 
        } else {
            $errmsg = "Fuel Type already exists!";
        }
                                
        } else {
            $errmsg = "Please fill all fields!";
        }  
    }  
  }
?>

<?php  if(!empty($errmsg)) 
              {?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?= $errmsg ?>
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <?php }
            ?>
           

         <?php if(isset($_SESSION["loggedin"])&&isset($_SESSION["succmsg"])){?>
           <div class="alert alert-success alert-dismissible fade show" role="alert">
           <?= $_SESSION["succmsg"]           ?>
           <?php if(isset($_SESSION["timeout"])&&($_SESSION["timeout"]<=time())){
            
            unset($_SESSION["succmsg"]);
          } ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                 </div>
   
                 <?php unset($_SESSION["succmsg"]);?>
               
      <?php   }?>

         
          



    <!-- Content Wrapper. Contains page content -->

     
    <section class="content">
        <div class="container">
           
            <div class="row mt-2">
                <div class="col-sm-6 mt-4">
                    <h2 class="m-0">Fuel Types</h2>
                </div><!-- /.col -->
                <div class="col-sm-6  mt-4">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin') }}">Home</a></li>
                        <li class="breadcrumb-item active">Fuel Type List</li>
                    </ol>
                </div><!-- /.col -->
            </div>
            <button type="button" class="btn btn-success status ml-2" data-toggle="modal" data-target="#Add">Add Fuel Type</button>
            <div class="row">
                <div class="col-12  table-responsive">
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Fuel Type</th>   
                                 <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            $i=1;
                            while($row = mysqli_fetch_array($result)) {
                               
                        echo '<tr> 
                                <td>'.$i.'</td>
                                <td>'. $row["fuel"] .'</td> <td>  ';                      
                               
                                echo'<button type="button" class="btn btn-primary edit  ml-2" data-id="'. $row["id"] .'" data-toggle="modal" data-target="#Edit">Edit</button>'; 
                                if($row["status"] == 'Active'){
                                echo'<button type="button" class="btn btn-danger status ml-2" data-id="'. $row["id"] .'" id="s'. $row["id"] .'">Deactive</button>';
                                   
                                       
                            }else {
                                echo'<button type="button" class="btn btn-success status ml-2" data-id="'. $row["id"] .'" id="s'. $row["id"] .'">Active</button>';
                              } 
                              echo'<button type="button" class="btn btn-success delete ml-2" data-id="'. $row["id"] .'" >Delete</button>';   
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

    <!-- Edit MODAL -->
    <div class="modal fade" id="Edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Fuel Type</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="" method="post"> 

        <input type="hidden"  value="" name="id" id="e_id">
            
        <div class="form-group">
                                    <label for="exampleInputTitle1">Fuel Type</label>
                                    <input type="text" class="form-control" value="" id="e_text" name="name"
                                        placeholder="Enter Fuel Type" required>
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

    <!-- ADD MODAL -->
    <div class="modal fade" id="Add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Fuel Type</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="" method="post"> 

       
            
        <div class="form-group">
                                    <label for="exampleInputTitle1">Fuel Type</label>
                                    <input type="text" class="form-control"  name="name"
                                        placeholder="Enter Fuel Type" required>
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

 
    <script>
    $(document).ready(function() {
	
        $(document).on("click", ".edit", function() { 
            var id = $(this). data("id"); 
            var fuel = $(this).parent().prev().html();
            $('#e_id').val(id);
            $('#e_text').val(fuel);

           
        });
      

	$(document).on("click", ".status", function() { 
        var id = $(this). data("id");      
		$.ajax({
			url: "status_ajax.php",
			type: "POST",
			data:{
				id: $(this).attr("data-id"),
                status: $(this).html(),
                table: "fuel_types"
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
                table: "fuel_types"
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
