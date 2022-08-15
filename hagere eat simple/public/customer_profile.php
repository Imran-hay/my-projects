<?php
  if (!isset($_SESSION)) 
    {session_start();}
    require_once('../config/connection.php');
function function_alert($msg) {
    echo "<script type='text/javascript'>alert('$msg');</script>";
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
    unset($_POST['update']);
    header("Location:customer_profile.php");
  }
     if(isset($_POST['change_pw']))
  {
    $uname=$_SESSION['uname'];
     $npass=$_POST['edit_npass'];
    $opass=$_POST['edit_opass'];
    $cpass=$_POST['edit_cpass'];
    $update="SELECT pass FROM  customer WHERE username='$uname'";
    $update_run=mysqli_query($con,$update);
    $row=mysqli_fetch_assoc($update_run);
     if(password_verify($opass,$row['pass']))
    {
        if($npass==$cpass)
        {
            $pass=password_hash($npass,PASSWORD_DEFAULT);
            $pw="UPDATE customer SET pass='$pass' WHERE username='$uname'";
            $run_pw=mysqli_query($con,$pw);
            function_alert("Password Has been Changed");

        }
        else
        {
            echo '<script>alert("Passwords Don\'t Match")</script>';
        }
    }
    else
    {
         echo '<script>alert("Incorrect Password")</script>';
    }
    unset($_POST['change_pw']);
  //  header("Location:customer_profile.php");
  }
  if(isset($_POST['add_loc']))
  {
      $uname=$_POST['edit_id'];
      $name=$_POST['loc'];
      $link=$_POST['loc_link'];
      $sql=$con->prepare("INSERT INTO locations (name,link,username) VALUES (?,?,?);");
      $sql->bind_param('sss',$name,$link,$uname);
      $sql->execute();
      header("Location: ./customer_profile.php");
      exit;

  }
  if(isset($_POST['remove_loc']))
  {
      $id=$_POST['edit_id'];
      $sql="DELETE FROM locations WHERE id=$id";
      $sql_run=mysqli_query($con,$sql);
      header("Location: ./customer_profile.php");
      exit;

  }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!--========== BOX ICONS ==========-->
        <link href='https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css' rel='stylesheet'>
    	<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css">
        <!--========== CSS ==========-->
        <link rel="stylesheet" href="../resources/css/styles.css">
        <link rel="stylesheet" href="../resources/css/st.css">
        <link rel="stylesheet" href="../resources/css/profile.css">

        <link rel="shortcut icon" href="../resources/images/logo.png" type="image/x-icon">
    	<link rel="stylesheet" type="text/css" href="../css/styled.css">
        <style>
        .input{
            padding: 10px;
            border: none;
            outline: none;
        }
        #prof
        {
            margin-top: 6em;
        }
    </style>
        </style>
        <title>Hagere Hub</title>
    </head>
    <body>

        <!--========== SCROLL TOP ==========-->
        <a href="#" class="scrolltop" id="scroll-top">
            <i class='bx bx-chevron-up scrolltop__icon'></i>
        </a>

        <!--========== HEADER ==========-->
        <header class="l-header" id="header">
            <nav class="nav bd-container">
                <a href="index.php" class="nav__logo"><i class='fas fa-bicycle'></i> hagere eat simple</a>
                                        <?php
                        if(!isset($_SESSION['state']))
                        { header("Location:/HES/");
                                exit;
                        }
                        else{
                        if($_SESSION['state']==2)
                        { echo <<<_End
                                                <div class="nav__menu" id="nav-menu">
                                                <ul class="nav__list">
                                                <li class="nav__item"><a href="../index.php" class="nav__link">Home</a></li>
                                                <li class="nav__item"><a href="restaurants.php" class="nav__link">Restaurants</a></li>
                                                <li class="nav__item"><a href="about_us.php" class="nav__link">About</a></li>
                                                <li class="nav__item"><a href="customer_profile.php" class="nav__link active-link">Profile</a></li>
                                                <form action="../index.php" method="post">
                                                <button id="logout_btn" class="nav__item" type="submit" name="log_out" onclick="return confirm('Are you sure you want to logout?');">Logout</button>
                                                </form>
                                                <li><i class='bx bx-moon change-theme' id="theme-button"></i></li>
                                            </ul>
                                            </div>
                        _End;   
                        }
                        if($_SESSION['state']==3)
                            {
                            header("Location: /HES/admin/");
                                exit;
                            }
                        if($_SESSION['state']==1)
                            {
                            header("Location:/HES/vendor/vendor/home.php");
                                exit;
                            }
                        }
                    ?>
                   <div class="nav__toggle" id="nav-toggle">
                    <i class='bx bx-menu'></i>
                </div>
            </nav>
        </header>
             <!-- Content    -->
          <section id="prof">
<!--php starts here-->
<?php

    $id = $_SESSION['uname'];

    $qry = "SELECT fname,lname,username,email,phone,wallet from customer where username='$id'";
    $qry_run = mysqli_query($con,$qry);

    foreach ($qry_run as $row){
        ?>
<!--            form starts-->
<div class="profile_list">
 <form action="customer_profile.php" method="post" enctype = "multipart/form-data" class="profiles">
              <h2>Edit Profile</h2>

        <input type="hidden" name="edit_id" value="<?php echo $id ?>">
        <label for="fname">Username:</label>
        <input type="text" id="uname" value="<?php echo $row['username'] ?>" disabled/>
        <label for="wallet">Wallet:</label>
        <input type="text" id="wallet" value="<?php echo $row['wallet'] ?>" disabled/>
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
                <br>
        <div> <a style="text-decoration: none;color: coral" href="../index.php">CANCEL</a>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <button style="color: green; outline: none; border: 1px solid green; background: none; cursor: pointer;" type="submit" name="update" onclick="return confirm('Are you sure you want to update?');" >UPDATE</button>
        </div>
</form>

<!--        php ends-->
        <?php
    }
?>
<form action="" method="post" enctype="multipart/form-data" class="profiles">
        <h2>Change Password</h2>
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
<form action="" method="post" enctype="multipart/form-data" class="profiles">
        <h2>Add Location</h2>
        <input type="hidden" name="edit_id" value="<?php echo $_SESSION['uname']?>">
        <label for="loc">Enter Location Name:</label>
        <input type="text" id="loc"  placeholder="Enter Location Name" name="loc" required/>
         <label for="loc_link">Enter the Google Maps Link:</label>
        <input type="text" id="loc_link"  placeholder="Enter the Google Maps Link" name="loc_link" value="" required/>
        <button style="color: green;  border: none;  cursor: pointer; padding:10px;" name="locate" onclick="find()" >Find My Location</button>

        <button style="color: green;  margin-top:20px;cursor: pointer;" type="submit" name="add_loc" onclick="return confirm('Are you sure you want to add location?');" >Add</button>
</form>
<div class="profiles location_list">
    <h2>Saved Locations</h2>
        <div class="locations">
            <div>Location Name</div>
            <div>Location</div>
            <div>Delete</div>
</div>
<br>
<?php 
    $uname=$_SESSION['uname'];
    $sql="SELECT * FROM locations where username='$uname'";
    $sql_run=mysqli_query($con,$sql);
    while($row=mysqli_fetch_assoc($sql_run)):
?>
 <div class="locations">
            <div><?php echo $row['name']?></div>
            <div><a target="_blank" href="<?php echo $row['link']?>">Find </a></div>
            <form action="" method="POST">
                <input type="hidden" name="edit_id" value="<?php echo $row['id']?>">
                <button type="submit" name="remove_loc" onclick="alert('Are you sure you wish to remove this locations.')">Remove</button>
            </form>
        </div>
       <?php endwhile?>     


</div>
</div>
          </section>



   <!--========== FOOTER ==========-->
        <footer class="footer section bd-container">
            <div class="footer__container bd-grid">
                <div class="footer__content">
                    <a href="#" class="footer__logo">hagere eat simple</a>
                    <span class="footer__description">Restaurant</span>
                    <div>
                        <a href="#" class="footer__social"><i class='bx bxl-facebook'></i></a>
                        <a href="#" class="footer__social"><i class='bx bxl-instagram'></i></a>
                        <a href="#" class="footer__social"><i class='bx bxl-twitter'></i></a>
                    </div>
                </div>

                <div class="footer__content">
                    <h3 class="footer__title">Quick Links</h3>
                    <ul>
                        <li><a href="#" class="footer__link">Home</a></li>
                        <li><a href="#" class="footer__link">Restaurants</a></li>
                        <li><a href="#" class="footer__link">About Us</a></li>
                    </ul>
                </div>

                <div class="footer__content">
                    <h3 class="footer__title">Contact Us</h3>
                    <ul>
                       <li>+251-921-3453</li> 
                       <li>+251-934-8679</li> 
                       <li>eatsimple@gmail.com</li> 
                    </ul>
                </div>

                <div class="footer__content">
                    <h3 class="footer__title">Location</h3>
                    <ul>
                        <li>Megenagna, Zefmeshe Mall</li>
                        <li>3<sup>rd</sup> Floor, 304</li>
                        <li>Megenagna, Zelalem Bld</li>
                        <li>1<sup>st</sup> Floor, 111</li>
                    </ul>
                </div>
            </div>

            <p class="footer__copy">&#169;  2022 Hagere Eat Simple. All right reserved</p>
        </footer>

        <!--========== SCROLL REVEAL ==========-->
        <script src="https://unpkg.com/scrollreveal"></script>

        <!--========== MAIN JS ==========-->
        <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
        <script src="../resources/js/main.js"></script>
        <script src="../resources/js/SignIn.js"></script>

        <script>
        
    function find(){
        alert("Warning: Accuracy of 'Find my Location' depends on Internet Speed So Please Confirm link after creation")
            function errorCallback(error) {
                alert(`ERROR(${error.code}): ${error.message}`);
            };
            if ('geolocation' in navigator) {
                navigator.geolocation.getCurrentPosition((position) => {
                    let x = position.coords.latitude;
                    let y = position.coords.longitude;
                    document.getElementById("loc_link").value = "https://www.google.com/maps/search/?api=1&query=" + x + "," + y;
                    // alert(position.time)
                }, errorCallback, { enableHighAccuracy: true });

                /* geolocation is available */
            } else {
                alert("Location not available")
                /* geolocation IS NOT available */
            }};
    </script>
    </body>
</html>