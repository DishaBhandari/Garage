<?php 

include 'layouts/header.php';

$date= str_replace(" ","T",date("Y-m-d H:i"));
$date= str_replace(" "," T",$date);

        $sql = "SELECT work_details.id, work_details.order_id, work_details.client_id, work_details.vehicle_no, work_details.services, work_details.other_info, work_details.service_date, work_details.actual_charge, work_details.billing_charge, work_details.status, client_details.name 
        FROM work_details INNER JOIN client_details 
        ON work_details.vehicle_no = client_details.vehicle_no 
        WHERE work_details.deleted_at is NULL";  
        $result = mysqli_query($conn, $sql);  
          if (mysqli_num_rows($result)==0) {             
            $errmsg = "No Work Available!";
          }

           

          if(isset($_POST['edit']))
          {   
              if($_SERVER["REQUEST_METHOD"] == "POST"){
                
                 
                  if (!empty($_POST['e_services'])&&!empty($_POST['e_info'])&&!empty($_POST['e_date'])&&!empty($_POST['e_acharge'])&&!empty($_POST['e_bcharge'])) {            
                   
                  
                              $service = implode(", ", $_POST['e_services']);
                      
                              $sql3 = "UPDATE  work_details SET client_id='$_POST[e_client_id]', vehicle_no='$_POST[e_vehicle]', services='$service', other_info='$_POST[e_info]', service_date='$_POST[e_date]', actual_charge='$_POST[e_acharge]', billing_charge='$_POST[e_bcharge]' WHERE id='$_POST[e_id]'";
                              
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
          
          
          <style>
              .success{
                  padding: 0.25rem 1.3rem;
          
              }
              .danger{
                  padding: 0.25rem 0.75rem;
              }
          </style>


    <!-- Content Wrapper. Contains page content -->
    <section class="content">
        <div class="container">
           
            <div class="row mt-2">
                <div class="col-sm-6 mt-4">
                    <h2 class="m-0">Work History</h2>
                </div><!-- /.col -->
                <div class="col-sm-6  mt-4">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin') }}">Home</a></li>
                        <li class="breadcrumb-item active">Work List</li>
                    </ol>
                </div><!-- /.col -->
            </div>
          
            <div class="row">
            <a  href="listClient.php" type="button" class="btn btn-success status ml-2" >Add Work</a>
                <div class="col-12  table-responsive">
                    <table  class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Order Id</th>
                                <th>Client Id</th>
                                <th>Vehicle No.</th> 
                                <th>Name</th>
                                <th>Service</th>
                                <th>Other Information</th>
                                <th>Service Date</th>
                                <th>Actual Charge</th>  
                                <th>Billing Charge</th>                              
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            $i=1;
                            while($row = mysqli_fetch_array($result)) {  
                              $service = explode(', ',$row["services"]);
                              $id = base64_encode( $row["id"]);
                        ?>                         
                            <tr> 
                                <td><?= $i ?></td>
                                <td><?= $row["order_id"] ?></td>
                                <td><?= $row["client_id"] ?></td>
                                <td><?= $row["vehicle_no"] ?></td>
                                <td><?= $row["name"] ?></td>
                                <td>
                                  <?php
                                  //  echo $row["services"];
                                    $sql1 = "SELECT * FROM services";
                                    $result1 = mysqli_query($conn, $sql1); 
                                    while($row1 = mysqli_fetch_array($result1)) {
                                          
                                      
                                      if(in_array($row1["id"],$service)){
                                        echo $row1["service_name"].', ';                                       
                                      } 
                                    }
                                  ?>
                                </td>                               
                                <td><?= $row["other_info"] ?></td>
                                <td><?= $row["service_date"] ?></td>
                                <td>&#8377; <?= $row["actual_charge"] ?></td>
                                <td>&#8377; <?= $row["billing_charge"] ?></td>
                               
                             <td>  
                             <button type="button" class="btn btn-primary edit mb-1" style ="padding: 0.20rem 1.65rem;" data-id="<?=$row['id'] ?>" data-toggle="modal" data-target="#Edit">Edit</button>
                             <a href="generate_bill?q=<?= $id ?>"  style ="padding: 0.27rem 1rem;" type="button" class=" mb-1 btn btn-secondary "  >Invoice</a>
                             <?php if($row["status"] == 'Active'){ ?>
                                <button type="button" class="btn btn-danger status mb-1" data-id="<?= $row["id"] ?>" id="<?=  $row["id"] ?>">Deactive</button>
                                   
                                       
                            <?php   }else { ?>
                                <button type="button" class="btn btn-success status mb-1" data-id="<?= $row["id"] ?>" id="<?=  $row["id"] ?>">Active</button>
                             <?php  }  ?>

                            
                              <button type="button" class="btn btn-success delete " style ="padding: 0.25rem 1.25rem;" data-id="<?= $row['id'] ?>">Delete</button>                                                        
                              </td>
                            </tr>
                           <?php  $i++; }?>

                           <tbody>
                    </table>
                </div>
            </div>
        </div>

    </section>

 <!-- Edit MODAL -->
 <div class="modal fade" id="Edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content" style="width: 710px;">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Work Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="" method="post"> 

        <input type="hidden"   name="e_id" id="e_id">  
        <input type="hidden" id="e_client_id" name="e_client_id">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="exampleInputTitle1">Client Name</label>
                                            <input type="text" class="form-control"  id="e_name" name="e_name"
                                             readonly>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="exampleInputTitle1">Vehicle No.</label>
                                            <input type="text" class="form-control"   id="e_vehicle" name="e_vehicle"
                                                 readonly>
                                        </div>
                                    </div>
                                </div>    
                                <div class="form-group">
                                    <div class="form-group">                                        
                                    <label class="mb-3">Services <span style="color:red;">*</span></label>
                                   <div class="row">
                                    <?php
                                    $sql2 = "SELECT * FROM services WHERE status = 'Active'";  
                                    $result2 = mysqli_query($conn, $sql2);
                                    // $servicesid=mysqli_query($conn, "select services from work_details where ");
                                     while($data2= mysqli_fetch_assoc($result2)) {
                                        echo '     <div class="col-sm-3 mb-3">
                                    <input type="checkbox" class="mr-1" name="e_services[]" data-value="'.$data2['service_name'].'" value="'.$data2['id'].'" >
                                    <label class="fw-bold">'.$data2['service_name'].'</label>
                                    </div>';
                                     }
                                    ?>
                                    </div>
                                    
                                </div>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputDescription1">Other Information</label>
                                    <textarea class="form-control" id="e_info" name="e_info"
                                        placeholder="Enter Other Information"></textarea>
                                </div>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                        <label >Service Date <span style="color:red;">*</span></label>
                                        <input type="datetime-local" class="form-control" max="<?= $date ?>" id="e_date" name="e_date" required placeholder="Enter Service Date">
                                        </div>
                                    </div>    
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                        <label >Actual Charge< <span style="color:red;">*</span></label>
                                        <div class="input-group">
                                            <span class="input-group-text" style="font-size: 1.5rem; padding: 0 0.75rem;" ><strong>&#8377;</strong> </span>
                                            <input type="text" class="form-control"  maxlength="7" pattern="[0-9]{.3}" id="e_acharge" name="e_acharge" required placeholder="Enter Actual Charge" required>
                                                                            
                                        </div>                                                            
                                        </div>  
                                    </div>    
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                        <label >Billing Charge <span style="color:red;">*</span></label>
                                        <div class="input-group">
                                            <span class="input-group-text" style="font-size: 1.5rem; padding: 0 0.75rem;" ><strong>&#8377;</strong> </span>
                                            <input type="text" class="form-control"  maxlength="7" pattern="[0-9]{.3}" id="e_bcharge" name="e_bcharge" required placeholder="Enter Billing Charge">
                                                                            
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
    var editor = CKEDITOR.replace('e_info');
    editor.resize('100%', '100');
</script>
 
    <script>
    $(document).ready(function() {
	

        $(document).on("click", ".edit", function() { 
            var id = $(this). data("id"); 
            
            var c_id = $(this).parent().prev().prev().prev().prev().prev().prev().prev().prev().html(); 
            var vehicle = $(this).parent().prev().prev().prev().prev().prev().prev().prev().html();
            var name = $(this).parent().prev().prev().prev().prev().prev().prev().html();
            var service = $(this).parent().prev().prev().prev().prev().prev().html();
            var o_info = $(this).parent().prev().prev().prev().prev().html();
            var service_date = $(this).parent().prev().prev().prev().html().replace(' ','T');
            var a_charge = $(this).parent().prev().prev().html().substring(2);
            var b_charge = $(this).parent().prev().html().substring(2);

            
            $('#e_id').val(id);
            $('#e_client_id').val(c_id);            
            $('#e_vehicle').val(vehicle);
            $('#e_name').val(name);
            $('#e_service').val(service);
            // console.log(service);
            // $('#e_info').html(e_info);
            $('#e_date').val(service_date);
            $('#e_acharge').val(a_charge);
            $('#e_bcharge').val(b_charge);
            var service_arr = service.split(", ");
            console.log(service_arr.length);
            console.log(service_arr[0]);
            for(var i=0;i<service_arr.length;i++){
                $('input[type="checkbox"]').each(function(){
                    if($('input[type="checkbox"]').attr('data-value') == service_arr[i]){
                     console.log($(this).attr('name'));
                    $('input[name="services"]').prop( "checked", "checked" );
                }
                });
                // if($('input[type="checkbox"]').attr('data-value') == service_arr[i]){
                //     console.log(i);
                // }
                
            }
            // $("input[data-value='']")

            CKEDITOR.instances['e_info'].setData(o_info);
      
           
           

           
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
                    $('#'+id).addClass("btn-success");
                    $('#'+id).removeClass("btn-danger") 
                    $('#'+id).removeClass("danger")  
                    $('#'+id).addClass("success");                    
                    $('#'+id).html('Active')
                } else {
                    $('#'+id).addClass("btn-danger");
                    $('#'+id).removeClass("btn-sucess");
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
                table: "work_details"
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
