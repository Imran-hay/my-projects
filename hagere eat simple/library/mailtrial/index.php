<?php
session_start();
require_once('../../config/connection.php');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require './PHPMailer-master/PHPMailer-master/src/Exception.php';
require './PHPMailer-master/PHPMailer-master/src/PHPMailer.php';
require './PHPMailer-master/PHPMailer-master/src/SMTP.php';



require_once "vendor/autoload.php";



if(isset($_POST['but']))
{

$uname=$_POST['email'];
$sql=mysqli_query($con,"SELECT * FROM customer WHERE username='$uname' AND active=1");
if(mysqli_num_rows($sql)==0)
{
  header("Location: auth.php");
}
else
{
$row=mysqli_fetch_assoc($sql);
$email=$row['email'];
//PHPMailer Object
$mail = new PHPMailer(); //Argument true in constructor enables exceptions
$mail->isSMTP();
$mail->SMTPOptions = array(
    'ssl' => array(
    'verify_peer' => false,
    'verify_peer_name' => false,
    'allow_self_signed' => true
    )
    );
$mail->Host = 'smtp.gmail.com';
$mail->SMTPAuth = true;
$mail->Username = 'hes.g321@gmail.com';
$mail->Password = 'hagereatsimple123';
//$mail->SMTPDebug = 'SMTP::DEBUG_SERVER';
$mail->SMTPSecure = 'tls';
$mail->Port = 587;
$mail->setFrom('hes.g321@gmail.com', 'Hagere Eat Simple');
$mail->addReplyTo('hes.g321@gmail.com', 'Hagere Eat Simple');
$mail->addAddress($email);
//$mail->addCC('cc1@example.com', 'Elena');
//$mail->addBCC('bcc1@example.com', 'Alex');
//$mail->AddBCC('bcc2@example.com', 'Anna');
//$mail->AddBCC('bcc3@example.com', 'Mark');
$mail->Subject = 'confirmation';
$mail->isHTML(true);
$x = rand(1000,1000000);
$_SESSION['code'] = $x;
$_SESSION['user']=$uname;
$mailContent = "<h1>This is your confirmation password</h1>
    <h3>$x</h3>";
$mail->Body = $mailContent;
if($mail->send()){
  
    //echo 'Message has been sent';
    header('location:auth.php');
    //header('location:auth.php');
}else{
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
}
}


}

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    
        <title>Login</title>
      
        <link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="index.css" rel="stylesheet">

    </head>


    <body class="text-center">
        <main class="form-signin">
          <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <img class="mb-4" src="v.webp" alt="" width="150" height="150">
            <h1 class="h3 mb-3 fw-normal">Verify</h1>
        
            <div class="form-floating">
               
              <input type="text" style="width: 300px; padding:10px; border-radius:10px;" placeholder="Enter the Username of your Account" id="floatingInput" name="email" >
             
            </div>
           <br><br>
            <button class="w-100 btn btn-lg btn-primary" type="submit" name="but">Verify</button>
            <p class="mt-5 mb-3 text-muted">&copy; HES</p>
          </form>
        </main>
        <div class="b-example-divider"></div>
        


        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        
        
            
          </body>

       
        
      

    
</html>





































