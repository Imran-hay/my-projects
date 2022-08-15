<?php require_once "config.php";
session_start();
if($_SESSION['state']!=1)
    {
      header("Location:../index.php");
    }

$user = $_SESSION['name'];

$uri = $_SERVER['REQUEST_URI'];
$components = parse_url($uri);
parse_str($components['query'], $results);

$rest = $_SESSION['name'];

$value = $results['name'];
//$value = $_GET['name'];
$res ="";

$status = "";
$status2 = "";

$sql2 = "SELECT * from resturant where username='$user'";
$result2 = mysqli_query($conn, $sql2);
if (mysqli_num_rows($result2) > 0) {
  // output data of each row
  while($row = mysqli_fetch_assoc($result2)) {
    $res = $row['Rname'];
    break;
    
  }
} 


if($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['de']))

  
{
  $uri = $_SERVER['REQUEST_URI'];
$components = parse_url($uri);
parse_str($components['query'], $results);



$value = $results['iname'];
  $sql3 = " UPDATE menu set active= 0  where rname='$res' AND food = '$value'";
  if (mysqli_query($conn, $sql3)) {
   $status2 = "deactivated";
 } else {
   $status2 = "not deactivated";
 }
}

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
   
     <link rel="shortcut icon" href="../resources/images/logo.png" type="image/x-icon">
        <title>Hagere Hub</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/checkout/">

    

    <!-- Bootstrap core CSS -->
<link href="../library/assets/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
  

    </style>

    
    <!-- Custom styles for this template -->
    <link href="../Register/register.css" rel="stylesheet">
  </head>
  <body class="bg-light">
  <header>
  <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">HES</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav me-auto mb-2 mb-md-0">
          <li class="nav-item">
            <a class="nav-link disabled" aria-current="page" href="#">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="#">account</a>
          </li>
       
          <li class="nav-item">
            <a class="nav-link active" href="#">menu</a>
          </li>

          <li class="nav-item">
            <a class="nav-link active" href="#">Gallary</a>
          </li>
        </ul>

        <form class="d-flex" method="GET" action="<?php echo $_SERVER["PHP_SELF"];?>" name="search">
          <input type="search" class="form-control" name="search" placeholder="Search for items here" aria-label="Search">
          <button class="btn btn-outline-primary ms-4" name="search-btn">search</button>
        </form>

        <form class="d-flex" method="POST" action="../index.php" name="logout">
         
          <button class="btn btn-outline-danger ms-4" name="log_out">Logout</button>
        </form>
       
      </div>
    </div>
  </nav>
</header>
    
<div class="container">
  <main>
    <div class="py-5 text-center">
      <img class="d-block mx-auto mb-4" src="di.jpg" alt="" width="130" height="120">
      <h2>Are you sure?</h2>
     
    </div>

    <div class="row g-5">
     
      <div class="col-md-7 col-lg-8">
     
        <form  action="<?php echo $_SERVER["PHP_SELF"];?>?name='$value'" method="GET" name="form2">
          <div class="row g-3">

            
            <div class="col-12">
               
                <label for="iname" class="form-label">Item name</label>
                <div>
                  
                  <input type="text" class="form-control" id="iname" name="iname" value="<?php echo $value?>" placeholder="<?php echo $value?>" required readonly>
               
                </div>
              </div>

          
         

           

            
      

         

           

          <hr class="my-4">

          <span style="color:aqua"><?php echo $status ?></span>
          <span style="color:aqua"><?php echo $status2 ?></span>
     


          <hr class="my-4">

     
         

          </div>

          <button class="w-100 btn btn-danger btn-lg"   name="de" >Deactivate</button>


         

         
        </form>

       
     
     
      </div>
    </div>
  </main>


</div>

<script>


 







</script>




 
  </body>
</html>
