
<?php
	include '../database/db_connection.php';
    session_start();

    $id=base64_decode($_GET['q1']);
    $cid=base64_decode($_GET['q2']);

                    $sql1 = mysqli_query($conn,"SELECT * FROM work_details WHERE id = '$id'");
                    $row1 = mysqli_fetch_assoc($sql1);
                    $sql2 = mysqli_query($conn,"SELECT * FROM client_details WHERE id = '$cid'");
                    $row2 = mysqli_fetch_assoc($sql2);


                    // Recipient 
                    $to = 'dishabhandari0309@gmail.com'; 
                    // $to = $row2['email']; 
                    
                    // Sender 
                    $from = 'sender@example.com'; 
                    $fromName = 'CodexWorld'; 
                    
                    // Email subject 
                    $subject = 'Invoice'; 

                  
                    $file =  "../invoice/".$row1['invoice_document'];

                    $htmlContent = "<html>
                    <head>
                    <title>Invoice</title>
                    </head>
                    <body>
                    <div 
                    padding-bottom: 50px; padding-top: 15px;'>
                    <h1 style=' color : #E81C2E;; text-align: left;font-weight: 700; font-size:38px;'>Invoice</h1>
                    <table style=' '> 
                    <tr>
                    
                    <td style='  color : #202C45; text-align: left;font-weight: 700; font-size:16px;'> Hi ".$row2['name'].",</td>
                    </tr>
                    <tr>
                    <td style=' color : #202C45; text-align: left;font-weight: 700; font-size:16px;'>This is your invoice for ".$row1['vehicle_no']." </td>
                    </tr>
                    <tr>
                    <td style='padding-bottom:15px; color : #202C45; text-align: left;font-weight: 700; font-size:16px;'>Happy to help you! Please visit agian.
                    </tr>
                    <tr>
                    <td>
                    <a href='http://localhost/Garage/feedback.php'><button style=' color : #202C45; padding:10px;  color: white;  font-weight: 700;   border-radius: 6px;
                      background-color: #E81C2E;'>Give Feedback</button></a> 
                    </td>
                    </tr>
                    </div>
                    </table>
                    </html>
                    ";


                    // Header for sender info 
                    $headers = "From: Gyan Car Workshop<dishabhandari0309gmail.com>"; 
                    
                    // Boundary  
                    $semi_rand = md5(time());  
                    $mime_boundary = "==Multipart_Boundary_x{$semi_rand}x"; 

                    // Headers for attachment  
                    $headers .= "\nMIME-Version: 1.0\n" . "Content-Type: multipart/mixed;\n" . " boundary=\"{$mime_boundary}\""; 
                    
                    // Multipart boundary  
                    $message = "--{$mime_boundary}\n" . "Content-Type: text/html; charset=\"UTF-8\"\n" . 
                    "Content-Transfer-Encoding: 7bit\n\n" . $htmlContent . "\n\n";  

                    // Preparing attachment 
                    if(!empty($file) > 0){ 
                        if(is_file($file)){ 
                            $message .= "--{$mime_boundary}\n"; 
                            $fp =    @fopen($file,"rb"); 
                            $data =  @fread($fp,filesize($file)); 
                    
                            @fclose($fp); 
                            $data = chunk_split(base64_encode($data)); 
                            $message .= "Content-Type: application/octet-stream; name=\"".basename($file)."\"\n" .  
                            "Content-Description: ".basename($file)."\n" . 
                            "Content-Disposition: attachment;\n" . " filename=\"".basename($file)."\"; size=".filesize($file).";\n" .  
                            "Content-Transfer-Encoding: base64\n\n" . $data . "\n\n"; 
                        } 
                    } 
                    $message .= "--{$mime_boundary}--"; 
                    // $returnpath = "-f" . $from;                     
                    $mail = mail($to,$subject,$message,$headers);
                    if($mail){
                        $_SESSION["succmsg"]  = "Mail sent successfully";  
                        $_SESSION["timeout"]  = time()+1;
                        echo "<script type='text/javascript'>window.location.href = 'workHistory.php';</script>"; 
                        }
                       
                  
            

	mysqli_close($conn);
?>
