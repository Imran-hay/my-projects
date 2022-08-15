<?php require_once "config.php";

session_start();

if($_SESSION['state']!=1)
    {
      header("Location:../index.php");
    }

if(isset($_SESSION['name']))
{
 
  $value = $_SESSION['name'];

}

else
{
  die("error");
}



$NName = "";
$confirm = "";

$NNamerr = "";
$confirmerr = "";

if(empty($_POST['NName']))
    {
        $NNamerr =  "this field is required";
    }
    else{
        $NName = validate($_POST['NName']);

    }

echo "<h1>'$NName'</h1>";
     if (!preg_match("/^[a-zA-Z-' ]*$/",$NName)) {
        $NNamerr = "Only letters and white space allowed";
      }

      if(empty($_POST['confirm']))
    {
        $confirmerr =  "this field is required";
    }
    else{
        $confirm = validate($_POST['NName']);

    }

     if ($NName != $confirm) {
        $NNamerr = "the two fields don't match";
      }

      echo "<h1>'$NName'</h1>";


      
      
        $sql = "UPDATE resturant SET Rname='$NName' WHERE Rname='$value'";
        $state = "";
       
        if (mysqli_query($conn, $sql)) {
          $state = "success";
         
        } else {
          echo "Error updating record: " . mysqli_error($conn);
        }
        

    







      function validate($data)
      {
          $data = trim($data);
          $data = stripslashes($data);
          $data = htmlspecialchars($data);
          return $data;
      
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
<link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">

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
    
<div class="container">
  <main>
    <div class="py-5 text-center">
      <img class="d-block mx-auto mb-4" src="res2.webp" alt="" width="130" height="120">
      <h2>update Form</h2>
     
    </div>

    <div class="row g-5">
     
      <div class="col-md-7 col-lg-8">
     
        <form class="needs-validation" novalidate action="<?php echo $_SERVER["PHP_SELF"];?>" method="POST">
          <div class="row g-3">

            
            <div class="col-12">
                <label for="Name" class="form-label">Name</label>
                <div class="input-group has-validation">
                  
                  <input type="text" class="form-control" id="Name" name="Name" placeholder="<?php echo $value ?>"readonly required>
               
                </div>
              </div>

              <div class="col-12">
                <label for="NName" class="form-label">New Name</label>
                <div class="input-group has-validation">
                  
                  <input type="text" class="form-control" id="NName" name="NName" placeholder="New Name" required>
                  <div class="error" style="color: red;">
                    <?php echo $NNamerr ?>
                  </div>
               
                </div>
              </div>

              <div class="col-12">
                <label for="confirm" class="form-label">Confirm</label>
                <div class="input-group has-validation">
                  
                  <input type="text" class="form-control" id="confirm" name="confirm" placeholder="confirm" required>
                  <div class="error" style="color: red;">
                    <?php echo $confirmerr ?>
               
                </div>

                <div class="set" style="color: green;">

                <?php echo $state ?>
                  
               
                </div>

            
          
         

       

          <hr class="my-4">

         

          </div>


         

          <button class="w-100 btn btn-primary btn-lg" type="submit">change</button>
         
        </form>
      </div>
    </div>
  </main>


</div>


    

     
  </body>
</html>
