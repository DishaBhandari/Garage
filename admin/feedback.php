<?php 

include 'layouts/header.php';


        
        $sql1 = "SELECT feedbacks.*, work_details.vehicle_no, client_details.name FROM feedbacks
        INNER JOIN work_details ON feedbacks.order_id = work_details.order_id
        INNER JOIN client_details ON work_details.vehicle_no = client_details.vehicle_no
         WHERE feedbacks.deleted_at is NULL";  
        $result1 = mysqli_query($conn, $sql1);  
          if (mysqli_num_rows($result1)==0) {    
                
            $errmsg = "No Feedback Available!";
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
                    <h2 class="m-0">Feedback</h2>
                </div><!-- /.col -->
                <div class="col-sm-6  mt-4">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin') }}">Home</a></li>
                        <li class="breadcrumb-item active">Feedback List</li>
                    </ol>
                </div><!-- /.col -->
            </div>

            <div class="row">
                <div class="col-12  table-responsive">
                    <table id="example1" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Vehicle No.</th>
                                <th>Order Id</th> 
                                <th>Satisfied with service?</th> 
                                <th>Have  you been attended?</th> 
                                <th>Service Delivered in time?</th> 
                                <th>Rating</th> 
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            $i=1;
                            while($row = mysqli_fetch_array($result1)) {
                        echo '<tr> 
                                <td>'.$i.'</td>
                                <td>'. $row["name"] .'</td>
                                <td>'. $row["vehicle_no"] .'</td>
                                <td>'. $row["order_id"] .'</td>
                                <td>'. $row["satisfied_with_service"] .'</td>
                                <td>'. $row["attended_will"] .'</td>
                                <td>'. $row["delivered_in_time"] .'</td>
                                <td>'. $row["rating"] .'</td>
                                <td>';
                                
                               if($row["status"] == 'Active'){
                                echo'<button type="button" class="btn btn-danger mb-2 ml-2 status " data-id="'. $row["id"] .'" id="'. $row["id"] .'">Deactive</button>';
                                   
                                       
                            }else {
                                echo'<button type="button" class="btn btn-success mb-2 ml-2 status" data-id="'. $row["id"] .'" id="'. $row["id"] .'">Active</button>';
                              }   
                              echo'<button type="button" class="btn btn-success delete mb-2 ml-2" data-id="'. $row["id"] .'" id="'. $row["id"] .'">Delete</button>';                           
                              echo '  </td>
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



 
    <script>
    $(document).ready(function() {
	
       
	$(document).on("click", ".status", function() { 
        var id = $(this). data("id");      
		$.ajax({
			url: "status_ajax.php",
			type: "POST",
			data:{
				id: $(this).attr("data-id"),
                status: $(this).html(),
                table: "feedbacks"
            },
            datatype: JSON,
			success: function(response){
                var status= JSON.parse(response);    
                console.log(status.response);
            
                if(status.response=="Deactive"){
                    $('#'+id).addClass("btn-success");
                    $('#'+id).removeClass("btn-danger")                    
                    $('#'+id).html('Active')
                } else {
                    $('#'+id).addClass("btn-danger");
                    $('#'+id).removeClass("btn-sucess");
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
                table: "feedbacks"
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
