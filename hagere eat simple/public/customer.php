<?php
$error=array();
$error2=array();
function function_alert($msg) {

    echo "<script type='text/javascript'>alert('$msg');</script>";
}
if(isset($_POST['sign_up'])){
     
     if(strlen($_POST['password'])<8)
        {
         array_push($error2,"Password must at least be 8 characters");

        }

        if(preg_match("/[A-Z]/", $_POST['password'])==0||preg_match("/[a-z]/", $_POST['password'])==0||preg_match("/[0-9]/", $_POST['password'])==0)
        {
         array_push($error2,"Password must at least contain one capital letter one small and one number");

        }
        if($_POST['password']!=$_POST['cpassword'])
        {
         array_push($error2,"Password and Confirm Password doesn't match");

        }
    $fName=filter_input(INPUT_POST,'fname',FILTER_SANITIZE_ADD_SLASHES);
    $lName=filter_input(INPUT_POST,'lname',FILTER_SANITIZE_ADD_SLASHES);
    $uName=filter_input(INPUT_POST,'username',FILTER_SANITIZE_ADD_SLASHES);
    $tel=filter_input(INPUT_POST,'tel',FILTER_SANITIZE_NUMBER_FLOAT);
    $email=filter_input(INPUT_POST,'email',FILTER_VALIDATE_EMAIL);
    $passw = password_hash($_POST["password"], PASSWORD_DEFAULT);
    if(!(isset($fName) && isset($lName) && isset($uName) && isset($email) && isset($tel) && isset($passw))){
      array_push($error2,"Fill all Fields");
    }
    $query1="SELECT COUNT(*) FROM customer WHERE username='$uName'";
    $result1=$conn->query($query1)->fetchColumn();
    if($row1>0)
    {
      array_push($error2,"This Username is already registered with us");
    }
    if(count($error2)==0)
     { $query = "INSERT INTO customer(USERNAME, FNAME, LNAME, EMAIL, PHONE, PASS,FLAG,ACTIVE) VALUES" . "('$uName', '$fName', '$lName', '$email', '$tel', '$passw',2,1)";
        $conn->query($query);
        $_SESSION['state']=2;
        $_SESSION['name']=$fname." ".$lname;
        $_SESSION['uname']=$uName;
        $_SESSION['email']=$email;
        $_SESSION['phone']=$tel;
        header("Location: /");
          exit;}
}

if(isset($_POST['sign_in']))
{
    $name = $_POST['username'];
    $pass = $_POST['password'];
    $query = "SELECT PASS FROM customer WHERE USERNAME='{$name}' AND ACTIVE=1";

    $r = $conn->query($query);
    $result = $r->fetch(PDO::FETCH_BOTH);
    
    if(password_verify($pass, $result['PASS'])){
        $query = "SELECT * FROM customer WHERE USERNAME='{$name}'";
        $result = $conn->query($query);
        $row = $result->fetch();
        session_start();
        $_SESSION['state']=$row['flag'];
        if($row['flag']==3)
        {
            $_SESSION['name']=$row['fname']." ".$row['lname'];
            $_SESSION['uname']=$row['username'];
            $_SESSION['email']=$row['email'];
            $_SESSION['phone']=$row['phone'];
         header("Location: /");
            exit;
        }
        if($row['flag']==1)
        {
        $_SESSION['name']=$row['username'];
        $user=$row['username'];
        $sql3 =mysqli_query($con, "SELECT * FROM  customer INNER JOIN resturant ON customer.username = resturant.username WHERE resturant.username='$user' && flag=1 && active=1");
        $x=mysqli_fetch_assoc($sql3);
         $_SESSION['rname'] = $x['Rname'];
        header("Location: /");
            exit;
        }
        if($row['flag']==2)
        {
            $_SESSION['name']=$row['fname']." ".$row['lname'];
            $_SESSION['uname']=$row['username'];
            $_SESSION['email']=$row['email'];
            $_SESSION['phone']=$row['phone'];

         header("Location: /");
            exit;
        }
        if($row['flag']==4)
        {
            $_SESSION['name']=$row['fname']." ".$row['lname'];
            $_SESSION['uname']=$row['username'];
            $_SESSION['email']=$row['email'];
            $_SESSION['phone']=$row['phone'];

         header("Location: /");
            exit;
        }
        

    }
    else{
         array_push($error,"Incorrect UserName or Password");
         unset($_POST);
    }
}

if(isset($_POST['log_out']))
{
    session_start();
     unset($_SESSION['state']);
     unset($_SESSION['name']);
     unset($_SESSION['uname']);
     unset($_SESSION['email']);
     unset($_SESSION['phone']);
     unset($_GET['log_out']);
      session_destroy();
     header("Location:/");
          exit;


}
?>