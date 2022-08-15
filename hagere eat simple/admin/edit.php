<?php

session_start();
include("../config/connection.php");
 if($_SESSION['state']!=3)
    {
      header("Location:../index.php");
    }
?>

<html>
<head>
<!--    style-->
<link rel="stylesheet" href="../resources/css/edit.css" />
    

<!--    title-->

    <link rel="shortcut icon" href="../resources/images/logo.png" type="image/x-icon">
        <title>Hagere Hub</title>
</head>
<body style="background: #efefef">
<h2>Edit vendor information</h2>
<!--php starts here-->
<?php

if (isset($_POST['edit'])){
    $id = filter_input(INPUT_POST,'edit_id',FILTER_SANITIZE_ADD_SLASHES);
    $qry = "SELECT customer.username,email,phone,Rname,location,about,logo,pass from customer join resturant on customer.username=resturant.username where customer.username='$id'";
    $qry_run = mysqli_query($con,$qry);

    foreach ($qry_run as $row){
        ?>
<!--            form starts-->
 <form action="index.php" method="post" enctype = "multipart/form-data">
        <input type="hidden" name="edit_id" value="<?php echo $row['username'] ?>">
        <label for="name">Name:</label>
        <input type="text" id="name" value="<?php echo $row['Rname'] ?>" placeholder="Enter Restaurant Name" name="edit_r_name" required/>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <label for="name">Email Id:</label>
        <input type="email" id="email" value="<?php echo $row['email'] ?>" placeholder="Enter Email" name="edit_email" required/><br><br>
        <label for="phone">Phone:</label>
        <input type="tel" pattern="[0-9]{10}" id="phone" value="<?php echo $row['phone'] ?>" placeholder="e.g. 0987654321" name="edit_phone" required>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <label for="add">Google Map Location:</label>
        <input type="text" id="add" placeholder="Enter Address" value="<?php echo $row['location'] ?>" name="edit_address" required>
         <button class="find_location" onclick="locate()"> Find my Location</button>
        <br><br>
        <input type="hidden" name="edit_logo" value="<?php echo $row['logo'] ?>">

        <h4 style="display: inline-block;">Upload logo</h4><input type="file"  name="logo"  ><br><br>
        <input type="checkbox" name="check" id="" required> Confirm Change
        <br><br>

                <a style="text-decoration: none;color: coral" href="index.php">CANCEL</a>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <button style="color: green; outline: none; border: none; background: none; cursor: pointer;" type="submit" name="update" onclick="return confirm('Are you sure you want to update?');" >UPDATE</button>
</form>
<!--        php ends-->
        <?php
    }
}
?>
<script>
    function locate() {
        alert("Warning: Accuracy of 'Find my Location' depends on Internet Speed So Please Confirm link after creation")
            function errorCallback(error) {
                alert(`ERROR(${error.code}): ${error.message}`);
            };
            if ('geolocation' in navigator) {
                navigator.geolocation.getCurrentPosition((position) => {
                    let x = position.coords.latitude;
                    let y = position.coords.longitude;
                    document.getElementById("add").value = "https://www.google.com/maps/search/?api=1&query=" + x + "," + y;
                    // alert(position.time)
                }, errorCallback, { enableHighAccuracy: true });
                return;
                /* geolocation is available */
            } else {
                alert("Location not available")
                /* geolocation IS NOT available */
            }
        }
</script>
</body>
</html>