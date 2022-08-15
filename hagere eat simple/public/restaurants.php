<?php
  if (!isset($_SESSION)) 
    {session_start();}
    require_once('../config/connection.php');
    require_once '../config/connect.php';
    $info='';
    include('customer.php');
  
  if(isset($_POST['view_menu']))
  {
      
           $_SESSION['menu']=$_POST['menu_name'];
      header("Location:./menu.php");
     
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
        <link rel="stylesheet" href="../resources/css/browse.css">
  
        
        <link rel="shortcut icon" href="../resources/images/logo.png" type="image/x-icon">
        <title>Restaurants </title>
        <style>
            #hero
            {
                margin-top: -35px;
            }

        </style>
    </head>
    <body>

        <!--========== SCROLL TOP ==========-->
        <a href="#" class="scrolltop" id="scroll-top">
            <i class='bx bx-chevron-up scrolltop__icon'></i>
        </a>

        <!--========== HEADER ==========-->
        <header class="l-header" id="header">
            <nav class="nav bd-container">
                <a href="../index.php" class="nav__logo"><i class='fas fa-bicycle'></i> hagere eat simple</a>
                                        <?php
                        if(!isset($_SESSION['state']))
                        { echo <<<_End
                                                <div class="nav__menu" id="nav-menu">
                                                <ul class="nav__list">
                                                <li class="nav__item"><a href="../index.php" class="nav__link ">Home</a></li>
                                                <li class="nav__item"><a href="restaurant.php" class="nav__link active-link">Restaurants</a></li>
                                                <li class="nav__item"><a href="about_us.php" class="nav__link ">About</a></li>
                                                <li class="nav__item signin_btn"><a class="nav__link" onclick="openModel1()">Sign In/Sign Up</a></li>
                                                <li><i class='bx bx-moon change-theme' id="theme-button"></i></li>
                                                </ul>
                                                </div>
                        _End;
                        }
                        else{
                        if($_SESSION['state']==2)
                        { echo <<<_End
                                                <div class="nav__menu" id="nav-menu">
                                                <ul class="nav__list">
                                                <li class="nav__item"><a href="../index.php" class="nav__link">Home</a></li>
                                                <li class="nav__item"><a href="restaurant.php" class="nav__link active-link">Restaurants</a></li>
                                                <li class="nav__item"><a href="about_us.php" class="nav__link">About</a></li>
                                                <li class="nav__item"><a href="customer_profile.php" class="nav__link">Profile</a></li>
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
                            header("Location:/HES/vendor/home.php");
                                exit;
                            }
                        if($_SESSION['state']==4)
                            {
                            header("Location:/HES/delivery/");
                                exit;
                            }
                        }
                    ?>
                   <div class="nav__toggle" id="nav-toggle">
                    <i class='bx bx-menu'></i>
                </div>
            </nav>
        </header>
       
                     <!-- SignIn/SignUp -->
 <?php 
  include('../include/sign.php')
 ?>

             <!-- Content    -->
              <section class="browse">
                 <form>
                <div class="group_s">
                <svg class="icon_s" aria-hidden="true" viewBox="0 0 24 24"><g><path d="M21.53 20.47l-3.66-3.66C19.195 15.24 20 13.214 20 11c0-4.97-4.03-9-9-9s-9 4.03-9 9 4.03 9 9 9c2.215 0 4.24-.804 5.808-2.13l3.66 3.66c.147.146.34.22.53.22s.385-.073.53-.22c.295-.293.295-.767.002-1.06zM3.5 11c0-4.135 3.365-7.5 7.5-7.5s7.5 3.365 7.5 7.5-3.365 7.5-7.5 7.5-7.5-3.365-7.5-7.5z"></path></g></svg>
                <input class="input_search" placeholder="Search for Restaurants" type="search" onkeyup="alterList();" value="" id="search">
                </div>
                </form>
                
              </section>
                   <h2 class="home__subtitle r_title">Restaurants in Addis Ababa</h2>
              <div class="r_list" id="r_list">
                   <?php
            $querry="SELECT resturant.username,Rname,logo,active,location FROM resturant INNER JOIN customer where customer.username=resturant.username AND active=1 AND state=1";
            $querry_run=mysqli_query($con,$querry);
            while($row=mysqli_fetch_assoc($querry_run)){
            ?>
            <div class="rl_card">
            <?php echo '<img src="../admin/vendor_list/'.$row['username'].'/images/'.$row['logo'].'" alt="logo" class="pb">'?>
              <div class="info">
                <h1><?php echo $row['Rname'];?></h1>
                   </div>
                   <div class="rl_buttons">
                    <form action="" method="post">
                  <input type="hidden" name="menu_name" value="<?php echo $row['Rname'];?>">
                  <button id="visit_r" name="view_menu">Visit</button>
                   </form>
                   <?php echo '<button id="view_l" > <a target="_blank" href="'.$row['location'] .'">View Location</a></button>'; ?>
                  </div>
                 </div>
            <?php
            }
            ?>
             <!-- <?php
           // for($i=0;$i<20;$i++){
            ?>
            <div class="rl_card">
             <img class="pb" src="logo.jpg">
              <div class="info">
                <h1>Food Planet</h1>
                   </div>

                   <div class="rl_buttons">
                  <button id="visit_r">Visit</button>
                  <button id="view_l">View Location</button>
                  </div>
                 </div>
            <?php
         //   }
            ?> -->
            
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

            <p class="footer__copy">&#169; 2022 Hagere Eat Simple. All right reserved</p>
        </footer>

        <!--========== SCROLL REVEAL ==========-->
        <script src="https://unpkg.com/scrollreveal"></script>

        <!--========== MAIN JS ==========-->
        <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
        <script src="../resources/js/browse.js"></script>
        <script src="../resources/js/SignIn.js"></script>

        <script>
         var x = document.getElementById("login")
         var y = document.getElementById("register")
         var z = document.getElementById("btnn")
         var m = document.getElementById("form-box")
        function register(){
            x.style.left = "-400px";
            y.style.left = "50px";
            z.style.left = "110px";
            m.style.height = "620px"; 
            m.style.overflowY="scroll";
          
        }
            function login(){
            x.style.left = "50px";
            y.style.left = "450px";
            z.style.left = "0";
            m.style.height = "480px";
            m.style.overflowY="hidden";

        }
    </script>
    </body>
</html>