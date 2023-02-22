<?php 

include 'layouts/header.php';


        
        $sql = "SELECT * FROM services WHERE deleted_at is NULL";  
        $result = mysqli_query($conn, $sql);  
          if (mysqli_num_rows($result)==0) {             
            $errmsg = "No Services Available!";
          }

if(isset($_POST['add']))
{   echo $_FILES['s_img'];
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if (!empty($_POST['s_name'])&&!empty($_POST['s_desc'])) {       
          if(!empty($_FILES['s_img']["name"])){
            $filename = time().'-'.$_FILES["s_img"]["name"];
            $tempname = $_FILES["s_img"]["tmp_name"];    
            $folder = "../image/".$filename;
            move_uploaded_file($tempname, $folder);
        } else {
            $filename = NULL;
        }
            $sql1 = "INSERT INTO services (service_name, service_desc, service_image)
            VALUES ('$_POST[s_name]', '$_POST[s_desc]','$filename')";
            if (mysqli_query($conn, $sql1)) {
                $_SESSION["succmsg"]  = "Service added successfully"; 
                $_SESSION["timeout"]  = time()+1; 
                echo "<script type='text/javascript'>window.location.href = 'listService.php';</script>";
                
            } else {
                $errmsg = "Error: " . $sql1 . "<br>" . mysqli_error($conn);
            } 
                                 
        } else {
            $errmsg = "Please fill all fields!";
        }  
       
  }
}

if(isset($_POST['edit']))
{   
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if (!empty($_POST['e_name'])&&!empty($_POST['desc'])) {  
            if (!empty($_FILES['e_img']["name"])){ 
            $filename = time().'-'.$_FILES["e_img"]["name"];
            $tempname = $_FILES["e_img"]["tmp_name"];    
            $folder = "../image/".$filename;
            move_uploaded_file($tempname, $folder);
            unlink("../image/".$_POST['old_img']);
            } elseif(!empty($_POST['old_img'])){ 
                $filename = $_POST['old_img'];
            } else{
                $filename = NULL;
            }
            
                    $sql2 = "UPDATE services SET service_name='$_POST[e_name]', service_desc='$_POST[desc]', service_image='$filename' WHERE id='$_POST[id]'";
                    
                    if (mysqli_query($conn, $sql2)) {
                        $_SESSION["succmsg"]  = "Service updated successfully"; 
                        $_SESSION["timeout"]  = time()+1; 
                        echo "<script type='text/javascript'>window.location.href = 'listService.php';</script>";
                        
                    } else {
                        $errmsg = "Error: " . $sql2 . "<br>" . mysqli_error($conn);
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
                    <h2 class="m-0">Service</h2>
                </div><!-- /.col -->
                <div class="col-sm-6  mt-4">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin') }}">Home</a></li>
                        <li class="breadcrumb-item active">Service List</li>
                    </ol>
                </div><!-- /.col -->
            </div>
            <button type="button" class="btn btn-success status ml-2 mb-3" data-toggle="modal" data-target="#Add">Add Service</button>
            <div class="row">
                <div class="col-12  table-responsive">
                    <table id="example1" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Service Title</th>
                                <th>Service Description</th>
                                <th>Service Image</th> 
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            $i=1;
                            while($row = mysqli_fetch_array($result)) {
                        echo '<tr> 
                                <td>'.$i.'</td>
                                <td>'. $row["service_name"] .'</td>
                                <td>'. $row["service_desc"] .'</td>
                                <td>';
                                if($row["service_image"] == NULL){
                                    echo'No Image Available!';
                                } else{
                                echo' <img src="../image/'.$row["service_image"].'" height="50" alt="service Image">';
                                }
                               echo' </td> <td>';
                                echo'<button type="button" class="btn btn-primary edit mb-2 ml-2" data-id="'. $row["id"] .'" data-toggle="modal" data-target="#Edit">Edit</button>'; 
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


    <!-- ADD MODAL -->
    <div class="modal fade" id="Add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Service</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="" method="post" enctype="multipart/form-data"> 

       
            
        <div class="form-group">
                    <label for="exampleInputTitle1">Service Name</label>
                    <input type="text" class="form-control" id="exampleInputTitle1" name="s_name"
                        placeholder="Enter Service Title" required>
                </div>
                <div class="form-group">
                    <label for="exampleInputDescription1">Service Description</label>
                    <textarea class="form-control" id="exampleInputDescription1" name="s_desc"
                        placeholder="Enter Service Description" ></textarea>
                </div>
                <div class="form-group">
                    <label for="exampleInputFile">Service Image</label>
                    <div class="input-group">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="s_img" accept="image/*" > 
                            <label class="custom-file-label" for="exampleInputFile">Choose Service Image</label>
                        </div>
                    </div>
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
        <h5 class="modal-title" id="exampleModalLabel">Edit Service</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="" method="post" enctype="multipart/form-data"> 

        <input type="hidden"  value="" name="id" id="e_id">
            
        <div class="form-group">
                    <label for="exampleInputTitle1">Service Name</label>
                    <input type="text" class="form-control" id="e_name" name="e_name"
                        placeholder="Enter Service Title" required>
                </div>
                <div class="form-group">
                    <label for="exampleInputDescription1">Service Description</label>
                    <textarea class="form-control" id="e_desc" name="desc"
                        placeholder="Enter Service Description" ></textarea>
                </div>
                <div class="form-group">
                    <label for="exampleInputFile">Service Image</label>
                    <input type="hidden" id="old_img" name="old_img" value="">
                    <br>
                    <img src="" height="100" id="o_img" alt="service Image">
                    <div class="input-group mt-1">
                        <div class="custom-file">                            
                            <input type="file" class="custom-file-input" id="e_img" name="e_img" accept="image/*" > 
                            <label class="custom-file-label" >Choose Service Image</label>
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
    var editor = CKEDITOR.replace('s_desc');
    editor.resize('100%', '200');
</script>
<script>
    var editor1 = CKEDITOR.replace( 'desc');
    editor.resize('100%', '200');
</script>
 
    <script>
    $(document).ready(function() {
	
        $(document).on("click", ".edit", function() { 
            var id = $(this). data("id"); 
            var title = $(this).parent().prev().prev().prev().html();
            var desc = $(this).parent().prev().prev().html();
            var src = $(this).parent().prev().children('img').attr('src');

            if($(this).parent().prev().children()=='img'){
            var img = $(this).parent().prev().children('img').attr('src').substring(9);
            $('#o_img').attr("src",src );
            $('#old_img').val(img);
            } else{
                $('#o_img').css("display","none" );
               
            }

            $('#e_id').val(id);
            $('#e_name').val(title);
            
            // $('#e_desc').html(desc);

            CKEDITOR.instances['e_desc'].setData(desc);

           
        });

	$(document).on("click", ".status", function() { 
        var id = $(this). data("id");      
		$.ajax({
			url: "status_ajax.php",
			type: "POST",
			data:{
				id: $(this).attr("data-id"),
                status: $(this).html(),
                table: "services"
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
                table: "services"
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
