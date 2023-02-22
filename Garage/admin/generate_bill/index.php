<!-- CSS only -->

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

<?php
error_reporting(0);

$id=base64_decode($_GET['q']);
        require_once('html2pdf/html2pdf.class.php');
        include('../../database/db_connection.php');

        $sql = mysqli_query($conn,"SELECT work_details.*, client_details.name 
        FROM work_details LEFT JOIN client_details
        on work_details.client_id = client_details.client_id
        WHERE work_details.id='$id'");
        if(mysqli_num_rows($sql)>0)
        {
          while($row=mysqli_fetch_assoc($sql)){
            $order_id = $row['order_id'];
           $html = '
           <div class="header" style="background-color:black; color:white;">
            <ul style=" list-style-type: none;  display:flex; align-items:center; padding:15px 0px;">
                <li style="margin-left:2rem;"><h2>Gyan Car Worksop</h2></li>
                <li style="margin-left:60rem;"> Order ID : ' . $row['order_id'] . '</li>
            </ul>
            </div>
           <div style="margin:15px 0;">
           <p style="margin:3px 20px; font-size:16px;"> Hi <span style="font-weight:bold; ">' . $row['name'] . '</span>,</p>
            <p style="margin:3px 20px; font-size:15px;"> Your Gyan Car Workshop service has been done succesfully.</p>
            <p style="margin:3px 20px; font-size:15px;"> Thank you for contacting us! Here is your service details.</p>
           </div>
            
            <div style="margin:0 70px; display:flex; justify-content:center;">
            <h2 style="margin:15px 200px; display:flex; justify-content:center; "> Service Details</h2>
           <table>';
           
           $html .= '<tr><td style="height:25px; font-size:14px;" >Order Id  &nbsp;&nbsp;<span style="font-weight:bold; font-size:15px;"> ' . $row['order_id'] . '</span></td> </tr>';
            $html .= '<tr><td style="height:25px; font-size:14px;" >Client Id  &nbsp;&nbsp;<span style="font-weight:bold; font-size:15px;">' . $row['client_id']  . '</span></td> </tr>';
            $html .= '<tr><td style="height:25px; font-size:14px;">Vehicle No.  &nbsp;&nbsp;<span style="font-weight:bold; font-size:15px;">' . $row['vehicle_no'] . '</span></td> </tr>';
            $html .= '<tr><td style="height:25px; font-size:14px;">Name  &nbsp;&nbsp;<span style="font-weight:bold; font-size:15px;">' . $row['name'] . '</span></td> </tr>';
            $html .= '<tr><td style="height:25px; font-size:14px;">Service  &nbsp;&nbsp;<span style="font-weight:bold; font-size:15px;">' ;
            
            $service = explode(', ',$row["services"])  ;
              $sql1 = "SELECT * FROM services";
              $result1 = mysqli_query($conn, $sql1); 
              while($row1 = mysqli_fetch_array($result1)) {  
                
                if(in_array($row1["id"],$service)){
                    $html.= $row1["service_name"].', ';                                       
                } 
              }
            
            
            $html.= '</span></td> </tr>';
            $html .= '<tr><td style="height:25px;font-size:14px;">Other Information &nbsp;&nbsp; <span style="font-weight:bold; display:inline-flex; font-size:15px;">' . strip_tags($row['other_info'] ). '</span></td> </tr>';
            $html .= '<tr><td style="height:25px; font-size:14px;">Service Date  &nbsp;&nbsp;<span style="font-weight:bold; font-size:15px;">' . $row['service_date'] . '</span></td> </tr>';
            $html .= '<tr><td style="height:25px; font-size:14px;"><h4 style="margin-top:15px; >Total Amount   &#8377;' . $row['billing_charge'] . '</h4></td> </tr>';

           }
            
           $html .=  '
           </table>
           </diV>';
        } else{
            $html = 'Data Not Found!';
        }
        echo $html;
        ob_clean();
        $html2pdf = new HTML2PDF('P', 'A4', 'fr');
        $html2pdf->WriteHTML($html);
        $file = $order_id.'.pdf';
        $html2pdf->Output($file, 'D'); 

?>


</style>