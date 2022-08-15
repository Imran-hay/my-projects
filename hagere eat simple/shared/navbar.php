  <?php


  if(!isset($_SESSION['state']))
 { echo <<<_End
                        <div class="nav__menu" id="nav-menu">
                        <ul class="nav__list">
                        <li class="nav__item"><a href="../index.php" class="nav__link active-link">Home</a></li>
                        <li class="nav__item"><a href="" class="nav__link">Restaurants</a></li>
                        <li class="nav__item"><a href="public/about_us.php" class="nav__link">About</a></li>
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
                        <li class="nav__item"><a href="../index.php" class="nav__link active-link">Home</a></li>
                        <li class="nav__item"><a href="#about" class="nav__link">Restaurants</a></li>
                        <li class="nav__item"><a href="public/about_us.php" class="nav__link">About</a></li>
                        <li class="nav__item"><a href="public/customer_profile.php" class="nav__link">Profile</a></li>
                        <form action="public/customer.php" method="get">
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
    