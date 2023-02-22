<?php
	include '../database/db_connection.php';
	  

	if($_POST['table']=="car_models"){
        $id=$_POST['id']; 
		$sql = "SELECT * FROM car_models WHERE manufacturer_id=$id AND status='Active' AND deleted_at is NULL";
	
        ?>
        
            <div class="form-group col-sm-4" id="car_select" >                                        
                <label>Car Model <span style="color:red;">*</span></label>
            
                <select  class="form-control car_model"  id = "model" name="car_model[]" required>
            <?php if ($result=mysqli_query($conn, $sql)) {?>    
                <option value="" selected>Select Car Model</option>
                <?php while($row = mysqli_fetch_array($result)){?>
                
                <option value="<?= $row['id']?>"><?=$row['model_name']?></option>
                <?php }  ?>   
            <?php } else{ ?>
                <option value="" selected>Select Car Model</option>
                
                <?php }  ?>
                </select>                                    
                </div>

    <?php }  
    elseif($_POST['table']==""){
        $sql = "SELECT * FROM fuel_types WHERE status='Active' AND deleted_at is NULL";
	
        if ($result=mysqli_query($conn, $sql)) {?>
        
            <div class="form-group fuel_type" id="fuel_select">                                        
                <label>Fuel Type <span style="color:red;">*</span></label>
            
                <select  class="form-control fuel_type" name="fuel[]">
                <?php while($row = mysqli_fetch_array($result)){?>
                
                <option value="<?= $row['id']?>"><?=$row['fuel']?></option>
                
                <?php }} ?>
                </select>                                    
                </div>
                <?php 
    }

	mysqli_close($conn);  ?>
