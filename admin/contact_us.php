<?php 

include 'layouts/header.php';


        
        $sql = "SELECT * FROM contact_us WHERE deleted_at is NULL";  
        $result = mysqli_query($conn, $sql);  
          if (mysqli_num_rows($result)==0) {             
            $errmsg = "No Services Available!";
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
                    <h2 class="m-0">Contact Us</h2>
                </div><!-- /.col -->
                <div class="col-sm-6  mt-4">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin') }}">Home</a></li>
                        <li class="breadcrumb-item active">Contact Us List</li>
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
                                <th>Contact</th>
                                <th>Message</th> 
                                <th>Contacted On</th> 
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            $i=1;
                            while($row = mysqli_fetch_array($result)) {
                        echo '<tr> 
                                <td>'.$i.'</td>
                                <td>'. $row["name"] .'</td>
                                <td>'. $row["contact"] .'</td>
                                <td>'. $row["message"] .'</td>
                                <td>'. $row["created_at"] .'</td>
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
                table: "contact_us"
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
                table: "contact_us"
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
