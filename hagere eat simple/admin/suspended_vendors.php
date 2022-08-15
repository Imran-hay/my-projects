<?php
session_start();
include("../config/connection.php");
 if($_SESSION['state']!=3)
    {
      header("Location:../index.php");
    }
$errors = [];
// extract($_REQUEST);
function deleteDirectory($dir) {
    if (!file_exists($dir)) {
        return true;
    }

    if (!is_dir($dir)) {
        return unlink($dir);
    }

    foreach (scandir($dir) as $item) {
        if ($item == '.' || $item == '..') {
            continue;
        }

        if (!deleteDirectory($dir . DIRECTORY_SEPARATOR . $item)) {
            return false;
        }

    }

    return rmdir($dir);
}
if(isset($_POST['create']))
{
        $username=$_POST['username'];

    $sql = mysqli_query($con,"select * from customer where username='$username'");
    if(mysqli_num_rows($sql))
    {
        $errors[] = "This Email Id or Logo image is already registered with us.";

    }else if($sql){

      if (!file_exists($_FILES['logo']['name'])) {
        $logo = $_FILES['logo']['name'];
        $email=$_POST['email'];
        $password=$_POST['password'];
        $phone=$_POST['phone'];
        $rname=$_POST['rname'];
        $location=$_POST['location'];
        $about=$_POST['about'];
        $username=$_POST['username'];
        $sql = mysqli_query($con,"insert into customer
         (username ,email,pass,phone,flag)
        values('$username','$email','$password','$phone',1)");
        $sql1=mysqli_query($con,"insert into resturant (rname,location,about,logo,username) 
        values('$rname','$location','$about','$logo','$username')
        ");

            mkdir("vendor_list/$username");
            mkdir("vendor_list/$username/menu");
            mkdir("vendor_list/$username/images");
            move_uploaded_file($_FILES['logo']['tmp_name'],"vendor_list/$username/images/".$_FILES['logo']['name']);
        header( "refresh:.01; url = admin_create.php" );

      }
      // else {
      //   $store = $_FILES['logo']['name'];
      //   $errors[] = "Logo image already there.";
      //   header("Location: admin_create.php");
      // }

    }
}
//Updating table php
if (isset($_POST['update'])){
    $id =        $_POST['edit_id'];
    $name =      $_POST['edit_r_name'];
    $v_email =   $_POST['edit_email'];
    $v_phone =   $_POST['edit_phone'];
    $v_address = $_POST['edit_address'];
    $v_logo =    $_FILES['logo']['name'];
    $qrry="Select * from resturant where username='$id'";
    $qry_run3 = mysqli_query($con, $qrry);
    $row = mysqli_fetch_assoc($qry_run3);
    $initial=$row['logo'];
    $qry = "UPDATE `resturant`
            SET `Rname` = '$name',`location` = '$v_address',`logo` = '$v_logo'
            WHERE username = '$id'";
    $qry2="UPDATE `customer` set `email`='$v_email',`phone` = '$v_phone' WHERE username='$id'";
    $qry_run = mysqli_query($con, $qry);
    $qry_run2 = mysqli_query($con, $qry2);
    if ($qry_run||$qry_run2){
        unlink("vendor_list/$id/images/$initial");
        move_uploaded_file($_FILES['logo']['tmp_name'],"vendor_list/$id/images/$v_logo");
       $success[] = "Your data is  UPDATED.";
       header("Location:admin_create.php");
    }else{
        $errors[] = "Your data is NOT UPDATED.";
        header("Location:admin_create.php");
    }


}
if (isset($_POST['activate'])){
    $id = $_POST['activate_id'];

    $qrry = "UPDATE customer SET active=1 WHERE username = '$id'";

    $run = mysqli_query($con,$qrry);
        header("Location:suspended_vendors.php");
 unset($_POST['activate']);
}
if (isset($_POST['vlist'])){
    unset($_POST['vlist']);
    $query = "select Rname,customer.username,email,phone,location,active from customer inner join resturant on customer.username=resturant.username";
    $query_run = mysqli_query($con,$query);
    $report='"Vendor Name","Username","Email","Phone","Address","Status"'."\n";
    while ($q = mysqli_fetch_assoc($query_run)) {
    foreach($q AS $key => $value){
        $pos = strpos($value, '"');
        if ($pos !== false) {
            $value = str_replace('"', '\"', $value);
        }
        if($key=="active")
        {
            if($value==1)
            {
                $report.='"Active"';
            }
            else
            {
                $report.='"Suspended"';
            }
        }
        else
        {$report .= '"'.$value.'",';}
    }
    $report .= "\n";
}
    echo $report; 
    date_default_timezone_set('Africa/Addis_Ababa');
    $curr_date=date('d-m-y');;
    $fileName="Vendor List Report(".$curr_date.").csv";
    header("Content-type: text/x-csv");
     header("Content-Disposition: attachment; filename=".$fileName);
    exit;
    header("Location:index.php");

    }
if (isset($_POST['clist'])){
    unset($_POST['clist']);
    $query = "SELECT username,fname,lname,email,phone,active FROM customer WHERE flag=2;";
    $query_run = mysqli_query($con,$query);
    $report='"Username","First Name","Last Name","Email","Phone","Status"'."\n";
    while ($q = mysqli_fetch_assoc($query_run)) {
    foreach($q AS $key => $value){
        $pos = strpos($value, '"');
        if ($pos !== false) {
            $value = str_replace('"', '\"', $value);
        }
        if($key=="active")
        {
            if($value==1)
            {
                $report.='"Active"';
            }
            else
            {
                $report.='"Suspended"';
            }
        }
        else
        {$report .= '"'.$value.'",';}
    }
    $report .= "\n";
}
    echo $report; 
    date_default_timezone_set('Africa/Addis_Ababa');
    $curr_date=date('d-m-y');;
    $fileName="Customer List Report(".$curr_date.").csv";
    header("Content-type: text/x-csv");
     header("Content-Disposition: attachment; filename=".$fileName);
    exit;
    header("Location:index.php");

    }
        if (isset($_POST['dlist'])){
    $query = "SELECT username,fname,lname,email,phone,active FROM customer WHERE flag=4;";
    $query_run = mysqli_query($con,$query);
    $report='"Username","First Name","Last Name","Email","Phone","Status"'."\n";
    while ($q = mysqli_fetch_assoc($query_run)) {
    foreach($q AS $key => $value){
        $pos = strpos($value, '"');
        if ($pos !== false) {
            $value = str_replace('"', '\"', $value);
        }
        if($key=="active")
        {
            if($value==1)
            {
                $report.='"Active"';
            }
            else
            {
                $report.='"Suspended"';
            }
        }
        else
        {$report .= '"'.$value.'",';}
    }
    $report .= "\n";
}
    echo $report; 
    date_default_timezone_set('Africa/Addis_Ababa');
    $curr_date=date('d-m-y');;
    $fileName="Customer List Report(".$curr_date.").csv";
    header("Content-type: text/x-csv");
     header("Content-Disposition: attachment; filename=".$fileName);
    exit;
    header("Location:index.php");

    }
?>

<html lang="en" dir="ltr">

<head>
<!--    style starts-->
<link rel="stylesheet" href="../resources/css/suspended_vendor.css" />
    
<!--    title-->
    <link rel="shortcut icon" href="../resources/images/logo.png" type="image/x-icon">
        <title>Hagere Hub</title>
</head>
<!--body-->
<body style = "background: #efefef" id="body">
<div class="mode">
    <svg id="dark" onclick="moonIcon()" style="display: none;" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
        <path
                fill-rule="evenodd"
                d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z"
                clip-rule="evenodd"
        />
    </svg>

    <svg id="light" onclick="sunIcon()" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" style="color:#fff;">
        <path
                stroke-linecap="round"
                stroke-linejoin="round"
                d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"
        />
    </svg>
</div>
</div>
<div class="navbar">
 <!--Logout button form to destroy session-->
<span class="nav_item"><a href="index.php">Vendors</a></span>
 <span class="nav_item"><a href="active_custumers.php">Clients</a></span>
 <span class="nav_item"><a href="active_delivery.php">Delivery</a></span>
 <span id="profile"><a href="edit_admin.php">Profile</a></span>
  <span class="drop"><button class="report">Download Reports</button>
 <div class="dropdown-content">
<form method="post" action="" enctype="multipart/form-data">
  <button type="submit" name="vlist">Vendor List</button>
  </form>
  <form method="post" action="" enctype="multipart/form-data">
  <button type="submit" name="clist">Customer List</button>
  </form>
  <form method="post" action="" enctype="multipart/form-data">
  <button type="submit" name="dlist">Delivery List</button>
  </form>
  </div>
</span> 

<form action="../index.php" method="post">
    <button id="logout_btn" type="submit" name="log_out" onclick="return confirm('Are you sure you want to logout?');">Logout</button>
<!--    <a href = "logout.php"
 style = "float: right;margin-right: 5px;background-color: #cdcdcd;
  color: darkred;padding: 10px; border-radius: 5px;text-decoration: none;"
  >Logout</a>-->
</form>
    <select disabled id="select">
    <option  name = "admin" value = "admin"><?= "Name"?></option>
</select>
</div>
<h2 style="float: right;" id="h2">Total Registered Vendor:
<?php
$query1 = "SELECT `rname` FROM `resturant` ORDER BY username";
$query1_run = mysqli_query($con, $query1);
$row1 = mysqli_num_rows($query1_run);
echo "<span class='echo'> $row1 </span>";

?>
</h2><br>
<div class="group">
    <svg class="icon" aria-hidden="true" viewBox="0 0 24 24">
        <g>
            <path d="M21.53 20.47l-3.66-3.66C19.195 15.24 20 13.214 20 11c0-4.97-4.03-9-9-9s-9 4.03-9 9 4.03 9 9 9c2.215 0 4.24-.804 5.808-2.13l3.66 3.66c.147.146.34.22.53.22s.385-.073.53-.22c.295-.293.295-.767.002-1.06zM3.5 11c0-4.135 3.365-7.5 7.5-7.5s7.5 3.365 7.5 7.5-3.365 7.5-7.5 7.5-7.5-3.365-7.5-7.5z"></path>
        </g>
    </svg>
    <input placeholder="Search" id="search" type="search" class="input" onkeyup="alterMenu()" value="">
</div>
<h1 id="h1">Suspended Vendors Information</h1>
<?php
$query1 = "SELECT `username` FROM `customer` where `flag`=1 and `active`=0";
$query1_run = mysqli_query($con, $query1);
$row1 = mysqli_num_rows($query1_run);
echo "<span class='echo'> $row1 </span>";
?>
<?php

$query = "select customer.username,email,phone,Rname,location,about,logo,active from customer inner join resturant on customer.username=resturant.username and active=0";
$query_run = mysqli_query($con,$query);

?>
<!--Vendor information retrieving table-->
<div id="table">
<table id="vendor_list">
     <thead>
    <tr>
        <th> LOGO</th>
        <th> USERNAME</th>
        <th> NAME</th>
        <th> EMAIL</th>
        <th> PHONE</th>
        <th> ADDRESS</th>
        <td >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    </td>

    </tr>
    </thead>
    <tbody>
</table>
<div class="table">
<table>
    <?php
    if (mysqli_num_rows($query_run) > 0){
        while ($row = mysqli_fetch_assoc($query_run)){

            ?>

    <tr>
        <td> <?php echo '<img src="vendor_list/'.$row['username'].'/images/'.$row['logo'].'" alt="logo" width="100px" height="100px">'?></td>
        <td><?php  echo $row['username']; ?></td>
        <td><?php echo $row['Rname'];  ?></td>
        <td><?php echo $row['email'];  ?></td>
        <td><?php echo $row['phone'];  ?></td>
        <td><?php echo $row['location'];  ?></td>
        <!-- <td><?php // echo $row['vendor_logo']; ?></td> -->

        <td>
            <form action = "suspended_vendors.php" method = "post">
                <input type = "hidden" name = "activate_id" value = "<?php echo $row['username'];  ?>">
            <button class="activate_button" type = "submit" name = "activate" id="activate" onclick="return confirm('Are you sure you want to activate?');">Activate</button>
            </form>
        </td>
    </tr>
            <?php
        }
    }else{
      echo '<td colspan="7">No Records.</td>';
    }


    ?>
    </tbody>
</table>
</div>
</div>

<!--/////////////////////////////-->
<!--Account creating html-->
<!--/////////////////////////////////////////-->


<script>
    function sunIcon() {
        document.getElementById("body").style.backgroundColor = "rgba(0, 0, 21, 0.73)";
        document.getElementById("body").style.color = "#efefef";
        document.getElementById("light").style.display = "none";
        document.getElementById("dark").style.display = "inline";
        document.getElementById("h1").style.color = "#fff";
        document.getElementById("h2").style.color = "#fff";
        document.getElementById("hv").style.color = "#fff";
    }

    function moonIcon() {
        document.getElementById("body").style.backgroundColor = "#efefef";
        document.getElementById("body").style.color = "#000000";
        document.getElementById("dark").style.display = "none";
        document.getElementById("light").style.display = "inline";
        document.getElementById("h1").style.color = "#000";
        document.getElementById("h2").style.color = "#000";
        document.getElementById("hv").style.color = "#000";
    }
         
    function alterMenu(){
        const xhttp = new XMLHttpRequest();

      xhttp.onload = function() {
         if (this.readyState == 4 && this.status == 200)
               document.getElementById("table").innerHTML = this.responseText;
           else
        document.getElementById("table").innerHTML = "No results"
        }
        // xhttp.open("GET", "filter.php")
        if(document.getElementById("search").value !=="")
        var url = "search/search2.php?searchQuery="+document.getElementById("search").value;  
        else
        var url = "search/search2.php";  
         
         console.log(url);
        xhttp.open("GET", url, true);
        xhttp.send();  
    }

</script>

</body>
</html>
