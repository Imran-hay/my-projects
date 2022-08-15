<?php
   include_once ('../login.php');
   session_start();

if(isset($_GET['dsub'])){
    $new = $_GET['sdate'] ;
    unset($_SESSION['sdate']);
    if(!$new){
    str_replace("//","-" , $new);
    // echo $new;
    $_SESSION['sdate'] = $new;
    header('Location: info1.php')
    }
    header('Location: info1.php'); 
}


?>
 <!-- <?php
//  if(isset($_GET['tdown'])){
//  $filename = 'readme.txt';
//  $filedir =  "./vendor/";

//   if(!is_dir($filedir))
//      mkdir($filedir, 0777, true)  ;

//       if(!$dh = opendir($filedir))
//           die("die");
//      chdir("./vendor");
//      $f = fopen($filename, 'w+');
//  $text = "FOODNAME                  AMOUNT \n";
//  if ($f) {
//         $connection;
//         $sql = "SELECT food , SUM(amount) tamount FROM information where date = CURDATE() group by food order by amount desc ;   ";
//         $sql1 = "SELECT * FROM information order by date desc ;  ";
//         $result1 = $connection->query($sql1);
//         $result = $connection->query($sql);
//         if(isset($_GET['tdown'])){
//             fwrite($f , $text);
//         if ($result){
//                $sum = 0 ;  
               
//             while($row = $result->fetch(PDO::FETCH_BOTH)){
//                 $s=" ";
//                 $sum = $sum + intval($row["tamount"]);
//                 for($i = 0 ; $i<25-strlen($row['food']);$i++){$s = $s." ";}

//                 fwrite($f, $row['food'].$s.$row['tamount']."\n");
//             }
//           fwrite($f,"total = ".$sum);}}
//     fclose($f);
//      header('Location: info.php');
//      header('Location: download.php');
//     }
// } 
//  if(isset($_GET['TTdown'])){


//  $filename = 'readme1.txt'; 
//  $filedir =  "./vendor/";

//   if(!is_dir($filedir))
//      mkdir($filedir, 0777, true)  ;

//       if(!$dh = opendir($filedir))
//           die("die");
//      chdir("./vendor");
//      $f = fopen($filename, 'w+');
//  $text = "FOODNAME                  AMOUNT \n";

//  $f = fopen($filename, 'w+');
//  $text = "FOODNAME                AMOUNT               DATE \n";
//  if ($f) {
//         $connection;
//         $sql1= "SELECT * , SUM(amount) tamount FROM information  
//         INNER JOIN menu ON information.food = menu.food group by price ;  ";
//         $result1 = $connection->query($sql1);
//             fwrite($f , $text);

//         if ($result1){
//                $sum = 0 ;  
//             while($row = $result1->fetch(PDO::FETCH_BOTH)){
//                 $s=" ";
//                 $sum = $sum + intval($row["tamount"]);
//                 for($i = 0 ; $i<25-strlen($row['food']);$i++){$s = $s." ";}

//                 fwrite($f, $row['food'].$s.$row['tamount'].$s.$row['date']."\n");
//             }
//           fwrite($f,"total = ".$sum);}}
//     fclose($f);
//      header('Location: info.php');
//      header('Location: down2.php');
//      }
?> -->