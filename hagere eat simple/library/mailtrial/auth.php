<?php

session_start();
if(!$_SESSION['code'])
{
    echo "illegal access";
}

$value = $_SESSION['code'];

$status = "";

if(isset($_POST['but']))
{

    if($_POST['number'] == $value)
{

    header("Location:changepw.php");

}


else if ($_POST['number'] == $value)
{

    $status = "wrong code";

}


}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    
        <title>Auth</title>
      
        <link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="index.css" rel="stylesheet">

    </head>


    <body class="text-center">
 <main class="form-signin">
          <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <img class="mb-4" src="v.webp" alt="" width="150" height="150">
            <h1 class="h3 mb-3 fw-normal">Authenticate User</h1>
            If a user exists under the given username an email was sent to the registered email that contains the code. Insert code:
            <br><br>
            <div class="form-floating">
               
              <input type="number" class="form-control" id="floatingInput" name="number" placeholder="code">
             
            </div>
        
            <br><br>
            <button class="w-100 btn btn-lg btn-primary" type="submit" name="but">verify</button>
            <div> <?php echo $status ?></div>
            <p class="mt-5 mb-3 text-muted">&copy; HES</p>
          </form>
        </main>
        <div class="b-example-divider"></div>
        


        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        
        
            
          </body>

       
        
      

    
</html>
