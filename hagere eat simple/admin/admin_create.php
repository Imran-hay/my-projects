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
    $sql=$con->prepare("SELECT * FROM customer WHERE username=?");
    $sql->bind_param('s',$username);
    $sql->execute();
    $sql_run=$sql->get_result();
    if(mysqli_num_rows($sql_run))
    {
        array_push($error,"This username is already registered with us.") ;

    }
  if (!file_exists($_FILES['logo']['name']))//revise
   {
        $ext=pathinfo($_FILES['logo']['name'],PATHINFO_EXTENSION);
        $supported="png jpeg jpg bmp";
        $pos = strpos($supported, $ext);
        if($pos==false)
        {
         array_push($error,"Wrong File Type, File Format can only be [png, jpeg, jpg, bmp]");
        }
        if($_FILES['logo']['size'] > 10485760)
         {array_push($error,"Logo Image is too big, please upload another file less than 10MB");}
        $logo = $_FILES['logo']['name'];
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
        $rname=filter_input(INPUT_POST,'rname',FILTER_SANITIZE_ADD_SLASHES);
        $sql2=$con->prepare("SELECT * FROM resturant WHERE rname=?;");
        $sql2->bind_param('s',$rname);
        $sql2->execute();
        $sql2_run=$sql2->get_result();
        if(mysqli_num_rows($sql2_run))
        {
        array_push($error,"This Restaurant Name is already registered with us");
        }
        $location=filter_input(INPUT_POST,'location',FILTER_SANITIZE_URL);
        $about=filter_input(INPUT_POST,'about',FILTER_SANITIZE_ADD_SLASHES);

        if(count($error)==0)
       {
         // File Handling  
        $new_file=stripslashes($username);
        mkdir("vendor_list/$new_file");
        mkdir("vendor_list/$new_file/menu");
        mkdir("vendor_list/$new_file/images");
        move_uploaded_file($_FILES['logo']['tmp_name'],"vendor_list/$new_file/images/$logo");
        $extension = pathinfo("vendor_list/$new_file/images/".$logo, PATHINFO_EXTENSION);
        $logo_name='logo.'.$extension;
        rename("vendor_list/$new_file/images/$logo","vendor_list/$new_file/images/$logo_name");

        //Add to Database
        $sql=$con->prepare("INSERT INTO customer (username ,email,pass,phone,flag,active)
        VALUES(?,?,?,?,1 , 1)");
        $sql->bind_param('ssss',$username,$email,$password,$phone);
        $sql->execute();

        $sql1=$con->prepare("INSERT INTO resturant (rname, location ,about,logo,username) 
        VALUES(?,?,?,?,?)");
        $sql1->bind_param('sssss',$rname,$location,$about,$logo_name,$username);
        $sql1->execute();
        unset($error);
    }
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
<h1 id="hv">Create Vendor's Account</h1>

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
        <label for = "name">Name:</label>
        <input type = "text" id = "name" value = "" placeholder = "Enter Restaurant Name" name = "rname" required/><br><br>
        <label for = "name">Username:</label>
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
        <label for = "add">Google Maps Location Link:</label>
        <input type = "text" id = "add" placeholder = "Enter the Google Maps Location Link" value = "" name = "location" required>
        <button class="find_location" onclick="locate()"> Find my Location</button>
        <br><br>&nbsp;
        <label for = "about">About:</label>
        <input type = "text" id = "about" placeholder = "Tell us a little about your restaurant" value = "" name = "about" ><br><br>&nbsp;
        <h4>Upload logo</h4><input class="file" type = "file"  name = "logo" required><br><br>

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
