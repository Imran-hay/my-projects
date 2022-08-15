<?php require_once "config.php";

session_start();

if($_SESSION['state']!=1)
    {
      header("Location:../index.php");
    }
$value = $_SESSION['name'];

$res = "";

$status = "";

$sql = "SELECT * from resturant where username='$value'";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
  // output data of each row
  while($row = mysqli_fetch_assoc($result)) {
    $res = $row['Rname'];
    break;
    
  }
} 
$iname = "";
$price = "";
 
$ing = "";

$inamerr = "";
$pricerr = "";
$photoerr = "";
$ingerr = "";

if(empty($_POST['iname']))
{
    $inamerr =  "item name is required";
}
else{
    $iname = validate($_POST['iname']);
}

 if (!preg_match("/^[a-zA-Z-' ]*$/",$iname)) {
    $namerr = "Only letters and white space allowed";
  }

  if(empty($_POST['price']))
{
    $pricerr =  "price is required";
}

else if($_POST['price'] <= 0)
{
    $pricerr =  "price must be positive number";
}

if(empty($_POST['ingredient']))
{
    $ing =  "ingredients is required";
}
else{
    $ingerr = validate($_POST['iname']);

}

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
 
 
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

// $photo = $_FILES['photo']['name']; 
//       mkdir("vendor_list/$username");
//       mkdir("vendor_list/$username/menu");
//       mkdir("vendor_list/$username/images");
//       move_uploaded_file($_FILES['photo']['tmp_name'],"vendor_list/$username/images/".$_FILES['photo']['name']);
 

 
  function validate($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;

}

if(isset($_POST['btn']))
{
  $target_dir = "../admin/vendor_list/$value/menu/";
  $photo = $_FILES['photo']['name'];
  $target_file = $target_dir.basename($_FILES["photo"]["name"]);
  $uploadOk = 1;
  $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
  $price=$_POST['price'];
  $ing=$_POST['ingredient'];
  
  // Check if image file is a actual image or fake image
  
    $check = getimagesize($_FILES["photo"]["tmp_name"]);
    if($check !== false) {
      $status.= "File is an image - " . $check["mime"] . "." . "\n";
      $uploadOk = 1;
    } else {
        $status.= "File is not an image." ."\n";
      $uploadOk = 0;
    }
  
  
  // Check if file already exists
  if (file_exists($target_file)) {
    $status.= "Sorry, file already exists." . "\n";
    $uploadOk = 0;
  }
  
  // Check file size
  if ($_FILES["photo"]["size"] > 50000000) {
    $status.= "Sorry, your file is too large." . "\n";
    $uploadOk = 0;
  }
  
  // Allow certain file formats
  if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
  && $imageFileType != "gif" ) {
    $status.=  "Sorry, only JPG, JPEG, PNG & GIF files are allowed.". "\n" ;
    $uploadOk = 0;
  }
  
  // Check if $uploadOk is set to 0 by an error
  if ($uploadOk == 0) {
    $status.="Sorry, your file was not uploaded." . "\n";
  // if everything is ok, try to upload file
  } else {
    if (move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
      //echo "The file ". htmlspecialchars( basename( $_FILES["photo"]["name"])). " has been uploaded.";
      
    } else {
        $status.= "Sorry, there was an error uploading your file." . "\n" ;
    }
  }
  $c1 = $_POST['c1'];
  $c2 = $_POST['c2'];
  $c3 = $_POST['c3'];
  $value = $_SESSION['rname'];
  $sql2= "INSERT into menu(food,photo,price,ingredients,catagory,rname,active) values('$iname','$photo','$price','$ing','$c1 $c2 $c3','$value',1)";
  if (mysqli_query($conn, $sql2)) {
    $status.= "New record created successfully";
  } else {
    $status.=  "Error: " . $sql2 . "<br>" . mysqli_error($conn);
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
    
<div class="container">
  <main>
    <div class="py-5 text-center">
      <img class="d-block mx-auto mb-4" src="ai.jpg" alt="" width="130" height="120">
      <h2>add item to menu</h2>
     
    </div>

    <div class="row g-5">
     
      <div class="col-md-7 col-lg-8">
     
        <form class="needs-validation"  action="<?php echo $_SERVER["PHP_SELF"];?>" method="POST" enctype="multipart/form-data">
          <div class="row g-3">

            
            <div class="col-12">
                <label for="iname" class="form-label">Item name</label>
                <div class="input-group has-validation">
                  
                  <input type="text" class="form-control" id="iname" name="iname" placeholder="Item name" required>
               
                </div>
              </div>

              <div class="col-12"> 
                <label for="photo" class="form-label">IMAGE</label>
                <div class="input-group has-validation">
                   <input class="file" type = "file"  name = "photo"  id ="photo"required>
               
                </div>
              </div>
          
          
         

              <div class="col-12">
                <label for="price" class="form-label">price</label>
                <div class="input-group has-validation">
                  
                  <input type="number" class="form-control" id="price" name="price" placeholder="price"   min="1" required>
           
                </div>
              </div>

              <div class="col-12">
                <label for="ingredient" class="form-label">ingredients</label>
                <div class="input-group has-validation">
                  
                  <input type="text" class="form-control" id="ingredient" name="ingredient" placeholder="ingredient" required>
               
                </div>
              </div>

              <div class="col-md-4">
              <label for="c1" class="form-label">Catagory-1</label>
              <select class="form-select" id="c1" name="c1" onchange="change()">
                <option value="">Choose...</option>
                <option value="fast">Fasting</option>
                <option value="nfast">Non Fasting</option>
              </select>
             
            </div>

            <div class="col-md-4">
              <label for="c2" class="form-label" id="l2" >Catagory-2</label>
              <select class="form-select" id="c2" name="c2" >
                <option value="">Choose...</option>
                <option value="break">Breakfast</option>
                <option value="lun">Lunch</option>
                <option value="din">Dinner</option>
                <option value="drink">Drink</option>
              </select>
             
            </div>

            <div class="col-md-4">
              <label for="c3" class="form-label">Catagory-3</label>
              <select class="form-select" id="c3" name="c3" >
                <option value="">Choose...</option>
                <option value="trad">Traditional</option>
                <option value="trad">Non-traditional</option>
              </select>
             
            </div>

            
      

         

           

          <hr class="my-4">

          <div style="color:aqua"><?php echo $status ?></div>

          <hr class="my-4">

         

          </div>


         

           
          
          <button class="w-100 btn btn-primary btn-lg" type="submit" name="btn" onclick="return confirm('Are you sure you want to create?');" >Add</button>
          <hr class="my-4">
         
        </form>

        
<form method="POST" action="<?php echo $_SERVER["PHP_SELF"];?>">

<button class="w-100 btn btn-success btn-lg m-2" type="submit" name="back" onclick="Redirect()">Back to Home</button>


</form>
      </div>
    </div>
  </main>


</div>

<script>
/*
  function change()
  {
    const x = document.getElementById("c1").value;
    const y = document.getElementById("c3");
    const z = document.getElementById("l3");

    if(x == "Food")
    {
      y.hidden = false;
      z.hidden = false;
    }

    if(x == "Drink")
    {
      y.hidden = TRUE;
      z.hidden = TRUE;
    }

   
   
  }

*/

</script>


 
  </body>
</html>
