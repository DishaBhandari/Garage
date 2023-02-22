<?php 

include 'layouts/header.php';


        
        $sql = "SELECT * FROM sliders WHERE deleted_at is NULL";  
        $result = mysqli_query($conn, $sql);  
          if (mysqli_num_rows($result)==0) {             
            $errmsg = "No Sliders Available!";
          }

if(isset($_POST['add']))
{   
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if (!empty($_POST['s_name'])&&!empty($_POST['s_desc'])&&!empty($_FILES['s_img'])) {       
            
            $filename = time().'-'.$_FILES["s_img"]["name"];
            $tempname = $_FILES["s_img"]["tmp_name"];    
            $folder = "../image/".$filename;
            if(move_uploaded_file($tempname, $folder)){
            
                    $sql1 = "INSERT INTO sliders (slider_title, slider_description, slider_image)
                    VALUES ('$_POST[s_name]', '$_POST[s_desc]','$filename')";
                    if (mysqli_query($conn, $sql1)) {
                        $_SESSION["succmsg"]  = "Slider added successfully"; 
                        $_SESSION["timeout"]  = time()+1; 
                        echo "<script type='text/javascript'>window.location.href = 'listSlider.php';</script>";
                        
                    } else {
                        $errmsg = "Error: " . $sql1 . "<br>" . mysqli_error($conn);
                    } 
                } else {
                    $errmsg = "Error while uploading Slider!";
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
            if (!empty($_FILES['e_img'])){ 
            $filename = time().'-'.$_FILES["e_img"]["name"];
            $tempname = $_FILES["e_img"]["tmp_name"];    
            $folder = "../image/".$filename;           
            move_uploaded_file($tempname, $folder);
            unlink("../image/".$_POST['old_img']);
            } else{
                $filename = $_POST['old_img'];
            }
            
                    $sql2 = "UPDATE sliders SET slider_title='$_POST[e_name]', slider_description='$_POST[desc]', slider_image='$filename' WHERE id='$_POST[id]'";
                    
                    if (mysqli_query($conn, $sql2)) {
                        $_SESSION["succmsg"]  = "Slider updated successfully"; 
                        $_SESSION["timeout"]  = time()+1; 
                        echo "<script type='text/javascript'>window.location.href = 'listSlider.php';</script>";
                        
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
                    <h2 class="m-0">Sliders</h2>
                </div><!-- /.col -->
                <div class="col-sm-6  mt-4">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin') }}">Home</a></li>
                        <li class="breadcrumb-item active">Slider List</li>
                    </ol>
                </div><!-- /.col -->
            </div>
            <button type="button" class="btn btn-success status ml-2 mb-3" data-toggle="modal" data-target="#Add">Add Slider</button>
            <div class="row">
                <div class="col-12  table-responsive">
                    <table id="example1" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Slider Title</th>
                                <th>Slider Description</th>
                                <th>Slider Image</th> 
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            $i=1;
                            while($row = mysqli_fetch_array($result)) {
                        echo '<tr> 
                                <td>'.$i.'</td>
                                <td>'. $row["slider_title"] .'</td>
                                <td>'. $row["slider_description"] .'</td>
                                <td><img src="../image/'.$row["slider_image"].'" height="50" alt="slider Image"></td><td>';
                                echo'<button type="button" class="btn btn-primary edit  mb-2 ml-2" data-id="'. $row["id"] .'" data-toggle="modal" data-target="#Edit">Edit</button>'; 
                                if($row["status"] == 'Active'){
                                echo'<button type="button" class="btn btn-danger ml-2 mb-2 status " data-id="'. $row["id"] .'" id="'. $row["id"] .'">Deactive</button>';
                                   
                                       
                            }else {
                                echo'<button type="button" class="btn btn-success mb-2mb-2 ml-2 status" data-id="'. $row["id"] .'" id="'. $row["id"] .'">Active</button>';
                              }   
                              echo'<button type="button" class="btn btn-success delete ml-2" data-id="'. $row["id"] .'" id="'. $row["id"] .'">Delete</button>';                           
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
        <h5 class="modal-title" id="exampleModalLabel">Add Slider</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="" method="post" enctype="multipart/form-data"> 

       
            
        <div class="form-group">
                    <label for="exampleInputTitle1">Slider Title</label>
                    <input type="text" class="form-control" id="exampleInputTitle1" name="s_name"
                        placeholder="Enter Slider Title" required>
                </div>
                <div class="form-group">
                    <label for="exampleInputDescription1">Slider Description</label>
                    <textarea class="form-control" id="exampleInputDescription1" name="s_desc"
                        placeholder="Enter Slider Description" ></textarea>
                </div>
                <div class="form-group">
                    <label for="exampleInputFile">Slider Image</label>
                    <div class="input-group">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="s_img" accept="image/*" required> 
                            <label class="custom-file-label" for="exampleInputFile">Choose Slider Image</label>
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
        <h5 class="modal-title" id="exampleModalLabel">Edit Slider</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="" method="post" enctype="multipart/form-data"> 

        <input type="hidden"  value="" name="id" id="e_id">
            
        <div class="form-group">
                    <label for="exampleInputTitle1">Slider Title</label>
                    <input type="text" class="form-control" id="e_name" name="e_name"
                        placeholder="Enter Slider Title" required>
                </div>
                <div class="form-group">
                    <label for="exampleInputDescription1">Slider Description</label>
                    <textarea class="form-control" id="e_desc" name="desc"
                        placeholder="Enter Slider Description" ></textarea>
                </div>
                <div class="form-group">
                    <label for="exampleInputFile">Slider Image</label>
                    <input type="hidden" id="old_img" name="old_img" value="">
                    <br>
                    <img src="" height="100" id="o_img" alt="slider Image">
                    <div class="input-group mt-1">
                        <div class="custom-file">                            
                            <input type="file" class="custom-file-input" id="e_img" name="e_img" accept="image/*" > 
                            <label class="custom-file-label" >Choose Slider Image</label>
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
            var img = $(this).parent().prev().children('img').attr('src').substring(9);

            $('#e_id').val(id);
            $('#e_name').val(title);
            $('#o_img').attr("src",src );
            $('#old_img').val(img);
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
                table: "sliders"
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
                table: "sliders"
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

