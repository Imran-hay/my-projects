  <?php
  session_start();
  if(!isset($_SESSION['state']))
 { echo <<<_End
   <nav class="navbar">
        <a class="active" href="index.html">Home</a>
        <a href="resources/html/br2.html">Browse</a>
        <a href="resources/html/about us.html" target="_blank">About</a>
        <a id="not-registered1" onclick="openModel1()">Sign In</a>
        <a id="not-registered2" onclick="openModel()">Sign up</a>
    </nav>
     <div class="icons">
         <i class="fas fa-bars" id="menu-bars"></i>
        <i class="fas fa-search" id="search-icon"></i>
    </label>
    </div>
_End;
}
else{
 if($_SESSION['state']==2)
{ echo <<<_End
   <nav class="navbar">
        <a class="active" href="index.html">Home</a>
        <a href="resources/html/br2.html">Browse</a>
        <a href="resources/html/about us.html" target="_blank">About</a>
    </nav>
     <div class="icons">
         <i class="fas fa-bars" id="menu-bars"></i>
        <i class="fas fa-search" id="search-icon"></i>
        <label for="check">
        <i class="fas fa-user" id="sidebar_btn2" onclick="func()"></i>
    </label>
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
    