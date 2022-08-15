<?php 
 include_once ('../login.php');
 session_start();
 
if($_SESSION['state']!=1)
    {
      header("Location:../index.php");
    }
?>
<?php
$connection;
$output = '';
if(isset($_GET['dsub'])){
  $new = $_GET['sdate'] ;
  unset($_SESSION['sdate']);
  unset($_SESSION['ddate']);
  if($new != null){
  str_replace("//","-" , $new);
  // echo $new;
  $_SESSION['sdate'] = $new;}
  header('Location: info.php'); 
}

if(isset($_GET['tdown'])){
        $file = "daily report.xlsx" ;
        $value = $_SESSION['rname'];
        $sql = "SELECT *  FROM orders where resturant= '$value' and date = CURDATE();";
        $result = $connection->query($sql);
        $output .= '
                   <table border=1 cellpadding="0" cellspacing="0" border="0">
                     <tr>
                       <th>Food Name</th>
                       <th>Price</th>
                       <th>Amount </th>
                       <th>Total</th>
                     </tr>
        ';
        if ($result){  
          $foods2 = array();
          $amunt2 = array();
          while($row = $result->fetch(PDO::FETCH_BOTH)){
                
            if(count($foods2) == null){ 
             $foods2 = explode (",", $row['food']); 
             $amount2 = explode (",", $row['amount']); 
             continue; 
             }
             $foods = explode (",", $row['food']); 
             $amount = explode (",", $row['amount']); 
             
             
             for($i = 0 ; $i < count($foods) ; $i++){
             
               if(in_array($foods[$i] , $foods2)){
                  $n = array_search($foods[$i] ,$foods2 );
                 
                  $amount2[$n] = $amount2[$n]+$amount[$i];
                } else{
                   array_push($foods2 , $foods[$i]);
                   array_push($amount2 , $amount[$i]);
                  }
              }
             
              
            }
          

            $sum = 0;
            $prof = 0;
            for($j = 0; $j< count($foods2); $j++)
            {   
              $sql1 = "SELECT *  FROM menu where rname= '$value' and id = '$foods2[$j]';";
              
              $result1 = $connection->query($sql1);
              if ($result1){
                while($row1 = $result1->fetch(PDO::FETCH_BOTH)){
                      $total = $row1['price'] * $amount2[$j];
                      $sum = $sum + $amount2[$j];
                      $prof = $prof + $total;

                $output .='<tr>
                           <td>'.
                            $row1['food']. 
                           '</td>
                           <td>'.                   
                            $row1['price'].   
                           '</td>
                           <td>'.$amount2[$j].'</td>
                           <td>'.$total.'</td>
                           </tr>';
                        
            }} }
            $output .='</table>'; 
            echo $output;    
           }
    header('Content-Disposition: attachment; filename=' . $file );
    header('Content-Type: application/xls');}
    

 if(isset($_GET['TTdown'])){
  $value = $_SESSION['rname'];

  if($_SESSION['ddate']){
    $date = $_SESSION['ddate'];
    
    $sql1= "SELECT * FROM orders where resturant= '$value'  and  date = '$date'";
      $file = "$date.xlsx"  ;
      
  }
  else{
    $sql1= "SELECT * FROM orders where resturant= '$value' order by date desc;"; 
     $file = "totalreport.xlsx";}
  

  $result = $connection->query($sql1);
  $output .= '
             <table border=1 cellpadding="0" cellspacing="0" border="0">
               <tr>
                 <th>Food Name</th>
                 <th>Price</th>
                 <th>Amount</th>
                 <th>Total</th>
               </tr>
  ';
  if ($result){  
                    $foods2 = array();
                    $amunt2 = array();
                    while($row = $result->fetch(PDO::FETCH_BOTH)){
                      echo("new");
                      if(count($foods2) == null){ 
                       $foods2 = explode (",", $row['food']); 
                       $amount2 = explode (",", $row['amount']); 
                       continue; 
                       }
                       $foods = explode (",", $row['food']); 
                       $amount = explode (",", $row['amount']); 
                       
                       
                       for($i = 0 ; $i < count($foods) ; $i++){
                       
                         if(in_array($foods[$i] , $foods2)){
                            $n = array_search($foods[$i] ,$foods2 );
                           
                            $amount2[$n] = $amount2[$n]+$amount[$i];
                          } else{
                             array_push($foods2 , $foods[$i]);
                             array_push($amount2 , $amount[$i]);
                            }
                        }
                       
                        
                      }
                  
        
                    
            $sum = 0;
            $prof = 0;
            for($j = 0; $j< count($foods2); $j++)
            {   
              $sqls = "SELECT *  FROM menu  where rname= '$value' and id = '$foods2[$j]';";
              
              $result1 = $connection->query($sqls);
              if ($result1){
               
                while($row1 = $result1->fetch(PDO::FETCH_BOTH)){
                      $total = $row1['price'] * $amount2[$j];
                      $sum = $sum + $amount2[$j];
                      $prof = $prof + $total;

                $output .='<tr>
                           <td>'.
                            $row1['food']. 
                           '</td>
                           <td>'.                   
                            $row1['price'].   
                           '</td>
                           <td>'.$amount2[$j].'</td>
                           <td>'.$total.'</td>
                           </tr>';
                        
            }} }
            $output .='</table>'; 
            echo $output;    
           }
header('Content-Disposition: attachment; filename=' . $file );
header('Content-Type: application/xls');}

?>