<?php require_once "config.php";

session_start();



if($_SESSION['state']!=1)
    {
      header("Location:../index.php");
    }

$uri = $_SERVER['REQUEST_URI'];
$components = parse_url($uri);
parse_str($components['query'], $results);

$user = $_SESSION['name'];

//$value = $results['name'];

if(!isset($_GET['name']))
{
  //echo "please check the menu page first";
}
$value = $_GET['name'];

$res = "";

$sql6 = "SELECT * from resturant where username='$user'";
$result6 = mysqli_query($conn, $sql6);
if (mysqli_num_rows($result6) > 0) {
  // output data of each row
  while($row = mysqli_fetch_assoc($result6)) {
    $res = $row['Rname'];
    break;
    
  }
} 



$status = "";
$status2 = "";



/*


if(isset($_POST['search-btn']))
{
    $key = $_POST['search'];
    $sql = " SELECT * from menu JOIN r_menu ON menu.food = r_menu.food where r_menu.r_name='$rest' AND r_menu.food = '$key'";
    $result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
  // output data of each row
  while($row = mysqli_fetch_assoc($result)) {
      $status = "item found";

    $value = $row['food'];
    $_SESSION['key'] = $value;
  }
} else {
    $status = "item not found";
  
}
}*/




  

  

   
if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update']))//post

  
{
      
        $update = $_POST['u'];// post

        $new = $_POST['new'];

        $status = $update;
        $status2 = $new;


        

        

        
        
        
          $uri = $_SERVER['REQUEST_URI'];
          $components = parse_url($uri);
          parse_str($components['query'], $results);
          
          
          
         // $value = $results['name'];

         $value = $_POST['iname'];


          if($update == "price")
          {
           

            if (!preg_match("/^[1-9]+[0-9]*$/",$new)) {
              $status2 = "Only numbers allowed";
            }

            else{
              
            $sql2 = "UPDATE menu  SET price='$new' where rname='$res' AND food = '$value'";
            if (mysqli_query($conn, $sql2)) {
    
                $status2 = "successfully updated";
              } else {
    
                $status2 = "error";
    
                
              }

            }
        


          }

          else if($update == "ingredients")
          {
           

            if (!preg_match('/^[a-zA-Z\\s\\,]+$/',$new)) {
              $status2 = "Only alphanumeric charachters allowed";
            }

            else{
              
            $sql2 = "UPDATE menu  SET ingredients='$new' where rname='$res' AND food = '$value'";
            if (mysqli_query($conn, $sql2)) {
    
                $status2 = "successfully updated";
              } else {
    
                $status2 = "error";
    
                
              }

            }
        


          }

          else if($update == "photo")
          {
            if (!file_exists($_FILES['photo']['name']))
            {
              $target_dir = "./reports/images/";
              $photo = $_FILES['photo']['name'];
              $target_file = $target_dir.basename($_FILES["photo"]["name"]);
              $uploadOk = 1;
              $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
              
              // Check if image file is a actual image or fake image
              
                $check = getimagesize($_FILES["photo"]["tmp_name"]);
                if($check !== false) {
                  echo "File is an image - " . $check["mime"] . ".";
                  $uploadOk = 1;
                } else {
                  echo "File is not an image.";
                  $uploadOk = 0;
                }
              
              
              // Check if file already exists
              if (file_exists($target_file)) {
                echo "Sorry, file already exists.";
                $uploadOk = 0;
              }
              
              // Check file size
              if ($_FILES["photo"]["size"] > 50000000) {
                echo "Sorry, your file is too large.";
                $uploadOk = 0;
              }
              
              // Allow certain file formats
              if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
              && $imageFileType != "gif" ) {
                echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                $uploadOk = 0;
              }
              
              // Check if $uploadOk is set to 0 by an error
              if ($uploadOk == 0) {
                echo "Sorry, your file was not uploaded.";
              // if everything is ok, try to upload file
              } else {
                if (move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
                  echo "The file ". htmlspecialchars( basename( $_FILES["photo"]["name"])). " has been uploaded.";
                  
                } else {
                  echo "Sorry, there was an error uploading your file.";
                }
              }
              $new1 = $_SESSION['name'];
              $res = $_SESSION['rname'];
              $sql2= "UPDATE menu  SET photo ='$photo' where rname='$res' AND food = '$value'";
              if (mysqli_query($conn, $sql2)) {
                $status2 = "Updated successfully";
              } else {
                $status2 =  "Error: " . $sql2 . "<br>" . mysqli_error($conn);
              }
        


          }
           

          
        


          }

          else if($update == "food")
          {
           

            if (!preg_match("/^[a-zA-Z-' ]*$/",$new)) {
              $status2 = "Only letters and space allwed allowed";
            }

            else{
              
            $sql2 = "UPDATE menu  SET food='$new' where rname='$res' AND food = '$value'";
            if (mysqli_query($conn, $sql2)) {
    
                $status2 = "successfully updated";
              } else {
    
                $status2 = "error";
    
                
              }

            }
        


          }
          
          
           
          
    

        
     
        
    
   
}


if(isset($_POST['back']))
{
  header('location:home.php');
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
            <a class="nav-link active" aria-current="page" href="home.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="display.php">menu</a>
          </li>
       
          <li class="nav-item">
            <form method="POST"   action="<?php echo $_SERVER["PHP_SELF"];?>" name="order2">
          <button type="button" class="btn btn-secondary position-relative"  name="order" >
  Orders
  <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
    <?php echo $_SESSION['count']?>
    <span class="visually-hidden">unseen</span>
  </span>
</button>
</form>
  
          </li>

         
        </ul>
       

        <form class="d-flex" method="POST" action="../index.php" name="logout">
         
          <button class="btn btn-outline-danger ms-4" name="log_out">Logout</button>
        </form>
         
      
       
      </div>
    </div>
  </nav>
</header
    
<div class="container">
  <main>
    <div class="py-5 text-center">
      <img class="d-block mx-auto mb-4" src="ui.jpg" alt="" width="130" height="120">
      <h2>update menu item</h2>
     
    </div>

    <div class="row g-5">
     
      <div class="col-md-7 col-lg-8">
     
        <form   action="<?php echo $_SERVER["PHP_SELF"];?>?name='$value'" method="POST" name="uf" enctype="multipart/form-data"><!--post-->
          <div class="row g-3">

            
            <div class="col-12">
               
                <label for="iname" class="form-label">Item name</label>
                <div class="input-group has-validation">
                  
                  <input type="text" class="form-control" id="iname" name="iname" value="<?php echo $value?>" placeholder="<?php echo $value?>" required readonly>
               
                </div>
              </div>

              <div class="col-12">
              <label for="u" class="form-label">Update</label>
              <select class="form-select" id="u" name="u" required  onchange="photoch()">
                <option value="">Choose...</option>
                <option value="food">Food-Name</option>
                <option value="photo" id ="1">photo</option>
                <option value="price">Price</option>
                <option value="ingredients">Ingredients</option>
              </select>
             
            </div>

              <div class="col-12" id="col-12">
                <label for="new" class="form-label">New-value</label>

                <div class="input-group has-validation" id="pint">
                  
                  <input type="text" class="form-control" id="rint" name="new" placeholder="new value" required>
               
                </div>
              </div>
          
          
         

           

            
      

         

           

          <hr class="my-4">

        
          <span style="color:aqua"> <?php echo $status2 ?></span>

          <hr class="my-4">

         

          </div>


         

          <button class="w-100 btn btn-secondary btn-lg" type="submit" name="update" >update</button>
        </form>

        <hr class="my-4">

        <form method="POST" action="<?php echo $_SERVER["PHP_SELF"];?>">

<button class="w-100 btn btn-success btn-lg m-2" type="submit" name="back">Back to Home</button>


</form>
      </div>
    </div>
  </main>


</div>

<script>

           var form = document.querySelector("#u");
           var ph = document.querySelector("#rint");
           var p = document.querySelector("#pint");
           
           var s = "photo";
         
          
           function photoch(){ 
             if(form.value == s){
              var mi = document.createElement("input");
              mi.setAttribute("class", "file");  
              mi.setAttribute("type", "file");  
              mi.setAttribute("name", "photo");  
              mi.setAttribute("id", "photo");  
              ph.parentElement.removeChild(ph);
              p.appendChild(mi);
              }
                }

</script>




 
  </body>
</html>
