<?php
session_start();
include("../config/connection.php");
 if($_SESSION['state']!=3)
    {
      header("Location:../index.php");
    }
$error = array();

if(isset($_POST['create']))
{
    unset($_POST['create']);
    $username=filter_input(INPUT_POST,'username',FILTER_SANITIZE_ADD_SLASHES);
    $fname=filter_input(INPUT_POST,'fname',FILTER_SANITIZE_ADD_SLASHES);
    $lname=filter_input(INPUT_POST,'lname',FILTER_SANITIZE_ADD_SLASHES);

    $sql=$con->prepare("SELECT * FROM customer WHERE username=?");
    $sql->bind_param('s',$username);
    $sql->execute();
    $sql_run=$sql->get_result();
    if(mysqli_num_rows($sql_run))
    {
        array_push($error,"This username is already registered with us.") ;

    }
    $email=filter_input(INPUT_POST,'email',FILTER_VALIDATE_EMAIL);
        if(strlen($_POST['password'])<8)
        {
         array_push($error,"Password must at least be 8 characters");

        }

        if(preg_match("/[A-Z]/", $_POST['password'])==0||preg_match("/[a-z]/", $_POST['password'])==0||preg_match("/[0-9]/", $_POST['password'])==0)
        {
         array_push($error,"Password must at least contain one capital letter one small and one number");

        }
        if($_POST['password']!=$_POST['cpassword'])
        {
         array_push($error,"Password and Confirm Password doesn't match");
        }

        $password=password_hash($_POST['password'], PASSWORD_DEFAULT);
        $phone=filter_input(INPUT_POST,'phone',FILTER_SANITIZE_NUMBER_FLOAT);
        if(count($error)==0)
       {
         // File Handling  

        //Add to Database
        $sql=$con->prepare("INSERT INTO customer (username,fname,lname ,email,pass,phone,flag,active)
        VALUES(?,?,?,?,?,?,4, 1)");
        $sql->bind_param('ssssss',$username,$fname,$lname,$email,$password,$phone);
        $sql->execute();
        unset($error);
        header("Location:active_delivery.php");
       }
}

?>

<html lang="en" dir="ltr">

<head>
<!--    style starts-->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />
<link rel="stylesheet" href="../resources/css/admin_create.css" />

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
 <span class="nav_item"><a href="active_custumers.php">Delivery</a></span>
 <span id="profile"><a href="edit_admin.php">Profile</a></span>

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
<h1 id="hv">Create Account</h1>

<form id="v_form" class="vendor_form" action = "" method = "post" enctype = "multipart/form-data">
    <h3>
      <?php  if(isset($error)) :?>
       <?php  if (count($error) > 0) : ?>
        <div class="error">
    	<?php foreach ($error as $err) : ?>
    	  <p><?php echo $err;
           unset($err);?></p>
    	<?php endforeach ?>
          </div>
            <?php  endif ?>
            <?php endif ?>
    </h3>
        <label for = "fname">First Name:</label>
        <input type = "text" id = "fname" value = "" placeholder = "Enter First Name" name = "fname" required/><br><br>
        <label for = "fname">Last Name:</label>
        <input type = "text" id = "lname" value = "" placeholder = "Enter Last Name" name = "lname" required/><br><br>
        <label for = "username">Username:</label>
        <input type = "text" id = "username" value = "" placeholder = "Enter Username" name = "username" required/><br><br>
        <label for = "name">Email:</label>
        <input type = "email" id = "email" value = "" placeholder = "Enter Email" name = "email" required/><br><br>
        <label for = "password">Password:</label>
        <input type = "password" id = "password" placeholder = "Enter Password" name = "password" minlength="8" required/>
        <label for = "cpassword">Confirm Password:</label><br><br>
        <input type = "password" id = "cpassword" placeholder = "Confirm Password" name = "cpassword" minlength="8" required/>
        <i class="bi bi-eye-slash" id="togglePassword" > Password Visibility</i><br><br>
        <label for = "phone">Phone:</label>
        <input type = "tel" pattern = "[0-9]{10}" id = "phone" value = "" placeholder = "e.g. 011-123456789" name = "phone" required><br><br>
    <button class="form_btn" type = "submit" id = "register" name = "create" onclick="return confirm('Are you sure you want to create?');">Create account</button><br><br>

</form><br><br><br>


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

                /* geolocation is available */
            } else {
                alert("Location not available")
                /* geolocation IS NOT available */
            }
        }
    const togglePassword = document.querySelector("#togglePassword");
        const password = document.querySelector("#password");
        const cpassword = document.querySelector("#cpassword");


        togglePassword.addEventListener("click", function () {
            // toggle the type attribute
            const type = password.getAttribute("type") === "password" ? "text" : "password";
            password.setAttribute("type", type);
            const ctype = cpassword.getAttribute("type") === "password" ? "text" : "password";
            cpassword.setAttribute("type", type);
            // toggle the icon
            this.classList.toggle("bi-eye");
        });
</script>

</body>
</html>
