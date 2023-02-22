
<?php
	include 'database/db_connection.php';
	

       
        if($_SERVER["REQUEST_METHOD"] == "POST"){

            

                if (!empty($_POST['name'])&&!empty($_POST['contact'])&&!empty($_POST['message'])) {      
                        
                
        
                    $sql = "INSERT INTO contact_us ( name, contact, message)
                    VALUES ('$_POST[name]', '$_POST[contact]', '$_POST[message]')";
                    
                        if (mysqli_query($conn, $sql)) {

                        $to = "dishabhandari0309@gmail.com";                    

                        $subject = "Gyan Car Worksop";

                        $message = "
                        <html>
                        <head>
                        <title>Contact Us</title>
                        </head>
                        <body>
                        <div style='border: 2px solid #e81c2e; width:60%;
                        padding-bottom: 50px; padding-top: 15px;margin-right:auto; margin-left:auto;'>
                        <h1 style=' color : #E81C2E;; text-align: center;font-weight: 700; font-size:px;'>Contact us</h1>
                        <table style=' width:340px;margin-right:auto; margin-left:auto;'> 
                        <tr>
                        
                        <td style=' padding-bottom:10px; color : #202C45; text-align: center;font-weight: 700; font-size:18px;'> Name : ".$_POST['name']."</td>
                        </tr>
                        <tr>
                        <td style=' padding-bottom:10px; color : #202C45; text-align: center;font-weight: 700; font-size:18px;'>Contact : ".$_POST['contact']."</td>
                        </tr>
                        <tr>
                        <td style='padding-bottom:10px; color : #202C45; text-align: center;font-weight: 700; font-size:18px;'>Message : ".$_POST['message']."
                        </tr>
                        <tr>
                        </div>
                        </table>
                        </html>
                        ";

                        // Always set content-type when sending HTML email
                        $headers = "MIME-Version: 1.0" . "\r\n";
                        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

                        // More headers
                        $headers .= 'From: Gyan Car Workshop<dishabhandari0309@gmail.com>' . "\r\n";
                        // $headers .= 'Cc: myboss@example.com' . "\r\n";

                        $mail = mail($to,$subject,$message,$headers);
                        if($mail){
                            $succmsg  = "Message sent successfully!";  
                            echo json_encode(array("status"=>"success","msg"=>$succmsg));
                            }
                            else{
                            $errmsg="Message not sent!";
                            echo json_encode(array("status"=>"error","msg"=>$errmsg));
                            }
                         
                                
                } else {
                    $errmsg = "Error: " . $sql . "<br>" . mysqli_error($conn);
                    echo json_encode(array("status"=>"error","msg"=>$errmsg));
                } 
                    
                                            
        } else {
            $errmsg = "Please fill all fields!";
            echo json_encode(array("status"=>"error","msg"=>$errmsg));
        }  
        
    }     
            

	mysqli_close($conn);
?>
