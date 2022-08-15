<?php

session_start();
include("../config/connection.php");
 if($_SESSION['state']!=3)
    {
      header("Location:../index.php");
    }

if(isset($_POST['update']))
{
    $uname=$_SESSION['uname'];
    $fname=$_POST['edit_fname'];
    $lname=$_POST['edit_lname'];
    $email=$_POST['edit_email'];
    $phone=$_POST['edit_phone'];
    $update="UPDATE customer SET fname='$fname', lname='$lname', email='$email', phone='$phone' WHERE username='$uname'";
    $update_run=mysqli_query($con,$update);
    header("Location:index.php");
    unset($_POST['update']);
}
?>

<html>
<head>
<!--    style-->
    <link rel="stylesheet" href="../resources/css/edit_admin.css" />


<!--    title-->

    <link rel="shortcut icon" href="../resources/images/logo.png" type="image/x-icon">
        <title>Hagere Hub</title>
</head>
<body style="background: #efefef">
<h2>Edit Profile</h2>
<!--php starts here-->
<?php

    $id = $_SESSION['uname'];

    $qry = "SELECT fname,lname,username,email,phone from customer where username='$id'";
    $qry_run = mysqli_query($con,$qry);

    foreach ($qry_run as $row){
        ?>
<!--            form starts-->
 <form action="" method="post" enctype = "multipart/form-data">
        <input type="hidden" name="edit_id" value="<?php echo $id ?>">
        <label for="fname">First Name:</label>
        <input type="text" id="fname" value="<?php echo $row['fname'] ?>" placeholder="Enter First Name" name="edit_fname" required/>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <label for="name">Last Name:</label>
        <input type="text" id="lname" value="<?php echo $row['lname'] ?>" placeholder="Enter Last Name" name="edit_lname" required/>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <label for="name">Email :</label>
        <input type="email" id="email" value="<?php echo $row['email'] ?>" placeholder="Enter Email" name="edit_email" required/>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <label for="phone">Phone:</label>
        <input type="tel" pattern="[0-9]{10}" id="phone" value="<?php echo $row['phone'] ?>" placeholder="e.g. 0987654321" name="edit_phone" required>
        <br><br>
                <a style="text-decoration: none;color: coral" href="index.php">CANCEL</a>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <button style="color: green; outline: none; border: none; background: none; cursor: pointer;" type="submit" name="update" onclick="return confirm('Are you sure you want to update?');" >UPDATE</button>
</form>
<br><br><br>
<!--        php ends-->
        <?php
    }
?>
<h2>Change Password</h2>
<form action="" method="post" enctype="multipart/form-data">
        <input type="hidden" name="edit_id" value="<?php echo $_SESSION['uname']?>">
        <label for="opass">Enter Previous Password:</label>
        <input type="password" id="opass"  placeholder="Enter Previous Password" name="edit_opass" required/>
        <br><br>
         <label for="npass">Enter New Password:</label>
        <input type="password" id="npass"  placeholder="Enter New Password" name="edit_npass" required/>
        <br><br> <label for="cpass">Confirm New Password:</label>
        <input type="password" id="cpass"  placeholder="Confirm New Password" name="edit_cpass" required/>
        <br><br>
        <button style="color: green; outline: none; border: none; background: none; cursor: pointer;" type="submit" name="change_pw" onclick="return confirm('Are you sure you want to change password?');" >CHANGE</button>

</form>
</body>
</html>