  
<!DOCTYPE html>
<?php require_once "../../config.php";
   session_start();
   include_once ('../login.php');
  
   
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="nn.js"> 

    </script>
    <link href="../../../library/assets/dist/css/bootstrap.min.css" rel="stylesheet">
  
    <style>
        #rename{ 
        background-color: #770038;}
        #rename:focus{ 
         background-color:white;
        }
        .charts{
        border: rgba(105,105,105,0.7) solid 3px;
        background-color: while;
        width: 100%;
        display: flex;}
                .table1 {
                    background: white;
                    border: 0.1rem solid rgba(0, 0, 0, 0.2);
                    border-radius: 0.5rem;
                    box-shadow: var(--box-shadow);
                    width:100%;
                  }
                .table1 .content h3 {
                  color: var(--black);
                  font-size: 2.5rem;
                }
                .table1 .content .price {
                color: var(--green);
                margin-left: 1rem;
                font-size: 2.5rem;
              }
  h1{
    font-size: 30px;
    color: #fff;
    text-transform: uppercase;
    font-weight: 300;
    text-align: center;
    margin-bottom: 15px;
  }
  table{
    width:100%;
    table-layout: fixed;
  }
  .tbl-header{
    background-color: rgba(59, 58, 58, 1);
   }
  .tbl-content{
    height:300px;
    overflow-x:auto;
    margin-top: 0px;
    border: 2px solid rgba(255,255,255,0.7);
    background-color: rgba(59, 58, 58, .7)
  }
  th{
    padding: 20px 15px;
    text-align: left;
    font-weight: 500;
    font-size: 12px;
    color: #fff;
    text-transform: uppercase;
  }
  td{
    padding: 15px;
    text-align: left;
    vertical-align:middle;
    font-weight: 300;
    font-size: 12px;
    color: #fff;
    border-bottom: solid 2px rgba(255,255,255,0.5);
  }
  ::-webkit-scrollbar {
      width: 6px;
  } 
  ::-webkit-scrollbar-track {
      -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3); 
  } 
  ::-webkit-scrollbar-thumb {
      -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3); 
  }
   
  
   
  

       
    </style>
    <!-- chatr -->

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    
      
         <?php
           if(isset($_SESSION['rname']))
           {
           
           }
           $value = $_SESSION['rname'];

           $count = 0;
$sql2 = "SELECT * from orders where resturant='$value' AND state= -1";
$result2 = mysqli_query($conn, $sql2);
if (mysqli_num_rows($result2) > 0) {
  // output data of each row
  while($row = mysqli_fetch_assoc($result2)) {
    $count++;
    
  }
} 

        
        
         $sql= "SELECT * FROM orders where resturant= '$value' ;";
           $result = $connection->query($sql);
           
           if ($result){  
            $date1 = array();
            $amount2 = array();
            while($row = $result->fetch(PDO::FETCH_BOTH)){
             
              if(count($date1) == null){ 
               array_push($date1,(string)substr($row['date'],0,4)); 
               $amount = explode (",", $row['amount']);
               array_push($amount2 ,array_sum($amount)); 

               continue; 
               }
               $date = substr($row['date'],0,4); 
               $amount = explode (",", $row['amount']); 
        
               for($i = 0 ; $i < count($amount) ; $i++){
               
                 if(in_array($date, $date1)){
                    $n = array_search($date ,$date1 );
                    $amount2[$n] = $amount2[$n] + array_sum($amount);
                    break;
                  } else{
                     array_push($date1 , $date);
                     array_push($amount2 , array_sum($amount));
                     break;

                    }
                } 
              }
            
           echo<<< end_
                      <script type="text/javascript">
                       google.charts.load('current', {'packages':['corechart']});
                       google.charts.setOnLoadCallback(drawChart);
                       function drawChart() {
                       var data = google.visualization.arrayToDataTable([
                        ['Year', 'Sales']
                   end_;
                   for($j = 0; $j< count($date1); $j++)
                   { 
                       $date = (int)($date1[$j]);
                       $tamount = intval($amount2[$j]);
                  // ,['$date',$tamount] 
                 echo<<<end_
                         ,['$date',$tamount] 
                         end_;

          }
              echo<<<end_
                          ]);
                    var options = {
                      title: 'Company Performance after using Hagere',
                      curveType: 'function',
                      legend: { position: 'bottom' }
                    };
      
                      var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));
              
                      chart.draw(data, options);
                      }</script>
                    end_;
            }
?> -->
        
       
         
         
       
      
      // piechart
    </script>
    <?php
        
        $value = $_SESSION['rname'];
        
        $connection;
         $sql= "SELECT * FROM orders where resturant = '$value' and EXTRACT(month FROM date) = EXTRACT(month FROM CURDATE())  ";
           $result = $connection->query($sql);
           $foods2 = array();
           $amount2 = array();
           echo<<< end_
           <script type="text/javascript">
           google.charts.load("current", {packages:["corechart"]});
           google.charts.setOnLoadCallback(drawChart);
           function drawChart() {
             var data = google.visualization.arrayToDataTable([
               ['Foods', 'Average']
        end_;

         if($result){
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
                  
                   $amount2[$n] = intval($amount2[$n])+intval($amount[$i]);
                 } else{
                    array_push($foods2 , $foods[$i]);
                    array_push($amount2 , $amount[$i]);
                   }
               }
              
               
             }

           
                        
         
                 
             for($j = 0; $j< count($foods2); $j++)
             {   
               $sql1 = "SELECT *  FROM menu where rname= '$value' and id = '$foods2[$j]';";
               
               $result1 = $connection->query($sql1);
               if ($result1){
                 while($row1 = $result1->fetch(PDO::FETCH_BOTH)){
                       $tamount = intval($amount2[$j]);
                 echo<<<end_
                            ,['$row1[food]', $tamount]
                         end_;}

           }}
              echo<<<end_
                          ]);
                          var options = {
                            title: 'Monthly Food sales in %',
                            is3D: true,
                          };
      
                          var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
                          chart.draw(data, options);
                        }
                      </script>
                    end_;
            }
?> 






    <!-- <script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],
          ['Work',     11],
          ['Eat',      2],
          ['Commute',  2],
          ['Watch TV', 2],
          ['Sleep',    7]
        ]);

        var options = {
          title: 'My Daily Activities',
          is3D: true,
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
        chart.draw(data, options);
      }
    </script>
     foods graph -->
    <!-- <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Year', 'Sales', 'Expenses', 'Profit'],
          ['2014', 1000, 400, 200 ],
          ['2015', 1170, 460, 250 ],
          ['2016', 660, 1120, 300 ],
          ['2017', 1030, 540, 350 ]
        ]);

        var options = {
          chart: {
            title: 'Company Performance',
            subtitle: 'Sales, Expenses, and Profit: 2014-2017',
          }
        };

        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
    </script> --> --> -->
  </head>

    <!--  -->
    
            <link rel="shortcut icon" href="../../../resources/images/logo.png" type="image/x-icon">
        <title> HES Reports</title>

     
    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <!-- custom css file link  -->
   
      <link rel="stylesheet" href="../css/menu/style1.css?v=2">
  

</head>
<body class="bg-light">
    
<!-- header section starts      -->

<div>
<header>
  <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">HES</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav me-auto mb-2 mb-md-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="../../home.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="../../display.php">menu</a>
          </li>
       
          <li class="nav-item">
            <form method="POST"   action="<?php echo $_SERVER["PHP_SELF"];?>" name="order2">
          <button type="button" class="btn btn-secondary position-relative"  name="order" >
  Orders
  <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
    <?php echo $count?>
    <span class="visually-hidden">unseen</span>
  </span>
</button>
</form>
  
          </li>

         
        </ul>
       

        <form class="d-flex" method="POST" action="../../../index.php" name="logout">
         
          <button class="btn btn-outline-danger ms-4" name="log_out" onclick="confirm('Are you sure you want to logout')">Logout</button>
        </form>
         
      
       
      </div>
    </div>
  </nav>
</header>
<!--profile part-->


<!--profile end-->
<!-- dishes section starts  -->

<section class="dishes" id="dishes" style="background-color:rgba(105,105,105,0.7);  margin-top:30px;">

 
   <?php
       if(!isset($_SESSION['rname']))
       {
         echo "illegal access";
       }
      $value = $_SESSION['rname'];
      $connection;
       // $username = $_POST['username'];
       // $useremail = $_POST['email'];
       // $pass = $_POST["password"];
        $sql = "SELECT *  FROM orders where resturant= '$value' and date = CURDATE();";
       
        $result = $connection->query($sql);
        if ($result){
                $foods2 = array();
                $amunt2 = array();
                
               echo "<form method='get' action='excel.php'><h1>Daily sells</h1> ";

               echo <<< end_
               <div class="tbl-header">
                 <table cellpadding="0" cellspacing="0" border="0">
                   <thead>
                     <tr>
                       <th>FOOD</th>
                       <th>Amount</th>
                       <th>Price </th>
                       <th>Total</th>
                     </tr>
                   </thead>
                 </table></div>
                 <div class="tbl-content">
                 <table cellpadding="0" cellspacing="0" border="0">
                   <tbody>
                   <div class='table1'>
            end_;
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
                // $prof = $prof + ($total*0.15); 
                for($j = 0; $j< count($foods2); $j++)
                {   
                  $sql1 = "SELECT *  FROM menu where rname= '$value' and id = '$foods2[$j]';";
                  
                  $result1 = $connection->query($sql1);
                  if ($result1){
                    while($row1 = $result1->fetch(PDO::FETCH_BOTH)){
                          $total = $row1['price'] * $amount2[$j];
                          $sum = $sum + $amount2[$j];
                          $prof = $prof + $total;
          $add = <<<END_
                   
                    <tr>
                    <td>
                    <h3 class="food-title" id="f1" name="$row1[food]" >$row1[food]</h3><!--class-->
                    </td>
                    <td><div class="shop-item-details">                  
                      <h4><span class="food-price">$amount2[$j]</span></h4>     
                    
                     
                      </div> </td><td ><h4>$row1[price] birr</h4></td>
                      <td><h4>$total birr</h4></td></tr>
                      <!-- end div--> 
               

                    END_; 
                    echo $add;} } }
                      
                      $prof = 0.10*($prof);
                     
                    echo  "</div></tbody></table></div>"; 
                    echo "TOTAL AMOUNT SOLD today = ".$sum."<br>"; 
                    echo "DAILY PROFIT = ".$prof;  
                    echo ' 
                        

                        <button class="cssbuttons-io-button" name = "tdown" style="width:12%;>
                        <svg height="24" width="24" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M1 14.5a6.496 6.496 0 0 1 3.064-5.519 8.001 8.001 0 0 1 15.872 0 6.5 6.5 0 0 1-2.936 
                        12L7 21c-3.356-.274-6-3.078-6-6.5zm15.848 4.487a4.5 4.5 0 0 0 2.03-8.309l-.807-.503-.12-.942a6.001 
                        6.001 0 0 0-11.903 0l-.12.942-.805.503a4.5 4.5 0 0 0 2.029 8.309l.173.013h9.35l.173-.013zM13
                        12h3l-4 5-4-5h3V8h2v4z" fill="currentColor"></path></svg>
                        <span>Download it</span>
                      </button>';

                } 
                
                if(isset($_SESSION['sdate'])){
                  $date = $_SESSION['sdate'];
                  
                  $sql1= "SELECT * FROM orders where resturant= '$value'  and  date = '$date'";
                    $_SESSION['ddate'] =  $_SESSION['sdate'];
                    unset($_SESSION['sdate']);
                }
                else
                   {$sql1= "SELECT * FROM orders where resturant= '$value' order by date desc;  ";}
                   $result1 = $connection->query($sql1);
                   
                if ($result1){
                  $foods2 = array();
                  $amunt2 = array();
                  $date = array();
                  echo "<h1>Total</h1>";
                  echo "<input type='date' name='sdate'>";
                  echo "<button name='dsub' style='display:inline;'  >sub </button>  ";
                  echo <<< end_
                    
                      <div class="tbl-header">
                      <table cellpadding="0" cellspacing="0" border="0">
                        <thead>
                          <tr>
                            <th>Foodname</th>
                            <th>Amount</th>
                            <th>Price </th>
                            <th>Total</th>
                          </tr>
                        </thead>
                      </table></div>
                      
                      <div class="tbl-content">
                      <table cellpadding="0" cellspacing="0" border="0">
                        <tbody>
                        <div class='table1'>
                      end_;
                      while($row = $result1->fetch(PDO::FETCH_BOTH)){
                         
                        if(count($foods2) == null){ 
                         $foods2 = explode (",", $row['food']); 
                         $amount2 = explode (",", $row['amount']);

                         for($i = 0 ; $i < count($foods2) ; $i++){
                           $date[$i] = $row['date']; 
                         }
                         continue; 
                         }
                         $foods = explode (",", $row['food']); 
                         $amount = explode (",", $row['amount']); 
                         
                         
                         for($i = 0 ; $i < count($foods) ; $i++){
                         
                           if(in_array($foods[$i] , $foods2)  ){
                              $n = array_search($foods[$i] ,$foods2 );
                              $amount2[$n] = intval($amount2[$n])+intval($amount[$i]);
                            } else{
                               array_push($foods2 , $foods[$i]);
                               array_push($amount2 , $amount[$i]);
                               array_push($date , $row['date']);
                              }
                          }
                         
                          
                        }

                   $sum = 0 ;  
                   $prof = 0;
                   for($j = 0; $j< count($foods2); $j++){   
                     $sqls = "SELECT *  FROM menu  where rname= '$value' and id = '$foods2[$j]';";
                     
                     $results = $connection->query($sqls);
                     if ($results){
                       while($row1 = $results->fetch(PDO::FETCH_BOTH)){
                             $total = $row1['price'] * $amount2[$j];
                             $sum = $sum + $amount2[$j];
                             $prof = $prof + $total; 

               $add1 = <<<END_
               
                          <tr>
                          <td>
                         <h3 class="food-title" id="f1" name="" >$date[$j]</h3><!--class-->
                         </td>
                         <td>                 
                          <h4> <span class="food-title">$row1[food]</span> </h4>   
                           </td> <td>
                           <h4> <span class="food-title"> </span></h4> </td>
                           <td><h4>$total birr</h4></td>
                          </tr>
                       
     
                         END_; 
                         echo $add1; 
                          } } }
                      
                      $prof = 0.10*($prof);
                          
                         echo  "</div></tbody></table></div>"; 
                         echo "TOTAL AMOUNT SOLD = ".$sum ."<br>";
                         echo " PROFIT = ".$prof;
                         echo ' 
                        

                         <button class="cssbuttons-io-button" name ="TTdown" style="width:12%;">
                         <svg height="24" width="24" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                         <path d="M0 0h24v24H0z" fill="none"></path>
                         <path d="M1 14.5a6.496 6.496 0 0 1 3.064-5.519 8.001 8.001 0 0 1 15.872 0 6.5 6.5 0 0 1-2.936 
                         12L7 21c-3.356-.274-6-3.078-6-6.5zm15.848 4.487a4.5 4.5 0 0 0 2.03-8.309l-.807-.503-.12-.942a6.001 
                         6.001 0 0 0-11.903 0l-.12.942-.805.503a4.5 4.5 0 0 0 2.029 8.309l.173.013h9.35l.173-.013zM13
                         12h3l-4 5-4-5h3V8h2v4z" fill="currentColor"></path></svg>
                         <span>Download it</span>
                       </button> </form>';
                      

                     
                     } 
                     
          
                    
                    ?>
            
</section>
                 <section>     <div class='charts'>
                      <div id="curve_chart" style="width: 900px; height: 500px; border-right: rgba(105,105,105,0.7) solid 3px;"></div>
                      <div id="piechart_3d" style="width: 900px; height: 500px;"></div>
                    </div>
                      <!-- <div class="charts">
                      <div id="columnchart_material" style="width: 100%; height: 500px;"></div> -->
                    </div></section>
                    <footer class="page-footer font-small blue pt-6">
            <div class="d-flex justify-content-between py-4 my-4 border-top">
                <p>&copy; 2022 Hagere Eat Simple . All rights reserved.</p>
                <ul class="list-unstyled d-flex">
                  <li class="ms-3"><a class="link-dark" href="#"><svg class="bi" width="24" height="24"><use xlink:href="#twitter"/></svg></a></li>
                  <li class="ms-3"><a class="link-dark" href="#"><svg class="bi" width="24" height="24"><use xlink:href="#instagram"/></svg></a></li>
                  <li class="ms-3"><a class="link-dark" href="#"><svg class="bi" width="24" height="24"><use xlink:href="#facebook"/></svg></a></li>
                </ul>
              </div>


          </footer>

<!-- footer section ends -->
 
<!-- loader part  -->

<script src="../js/menu/cart1.js"></script> 
<script src="../js/menu/cart.js"></script>
<script src="../js/menu/script.js"></script>

<!-- custom js file link  -->
<script src="../js/menu/scriptmenu.js"></script>



</body>
</html>