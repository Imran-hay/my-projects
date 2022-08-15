<?php
  if (!isset($_SESSION)) 
    {session_start();}
    require_once '../config/connect.php';
    include('customer.php');

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
        <link rel="shortcut icon" href="../resources/images/logo.png" type="image/x-icon">
        <title>About Hagere Eat Simple</title>
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
                        { echo <<<_End
                                                <div class="nav__menu" id="nav-menu">
                                                <ul class="nav__list">
                                                <li class="nav__item"><a href="../index.php" class="nav__link ">Home</a></li>
                                                <li class="nav__item"><a href="restaurants.php" class="nav__link">Restaurants</a></li>
                                                <li class="nav__item"><a href="about_us.php" class="nav__link active-link">About</a></li>
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
                                                <li class="nav__item"><a href="restaurants.php" class="nav__link">Restaurants</a></li>
                                                <li class="nav__item"><a href="about_us.php" class="nav__link active-link">About</a></li>
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
             <!-- Content    -->
             <section class="home">
                <div class="home__container bd-container bd-grid" >
                    <div class="home__data"id="about">
                        <img src="../resources/images/logo.png" alt="">
                    </div>
    <div class="content">
        <h1 class="home__title">About US</h1>
					<p>'Hagere Eat Simple' is a recently formed online restaurant ordering and delivery system website,that is aimed at revolutionizing the food and refreshment industry of the country. Through its venture it tries to improve and modernize the food services of the city.
  <p><h2  class="home__subtitle">OUR MISSION</h2>
"Bringing good food into your everyday. That's our mission.

That means we don't just deliver--we bring it, always going the extra mile to make your experience memorable.

And it means this is delicious food you can enjoy everyday: from vibrant salads for healthy office lunches, to indulgent family-sized pizzas, to fresh fish for a romantic night in. Whatever you crave, we can help.".</p>
                </div>
            </section>
                     <!-- SignIn/SignUp -->
 <?php 
  include('../include/sign.php')
 ?>

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