<?php

session_start();
if($_SESSION['state']!=1)
    {
      header("Location:../index.php");
    }
$value="";

if($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['me']) )
{
    $uri = $_SERVER['REQUEST_URI'];
    $components = parse_url($uri);
    parse_str($components['query'], $results);

    if(isset($_SESSION['value']))
    {
        $value = $_SESSION['value'];

    }
    
    
    
    $value = $results['me'];

    $_SESSION['value'] = $value;

    




}




   

    





?>

<html>


    
<head>

<link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="display.css" rel="stylesheet">
</head>

<body style="background-color:black;" >

 <form method='GET' name="f1" id="f1" action="<?php echo $_SERVER['PHP_SELF'];?>"><label class='switch'>
       <input type='checkbox' name='me' id="me" value="off"  onchange="submit();this.form.submit()">
       <span class='slider'></span>
     </label></form>



</body>

<script>



function submit()
{
    const val = document.getElementById('me').value

    if(val == "off")
    {
        document.getElementById('me').value = "on";
        document.getElementById('me').style.content = "ENABLED";


    }

    if(val == "on")
    {
        document.getElementById('me').value = "off";
        document.getElementById('me').style.content = "DISABLED";


    }
   
   
}




</script>



</html>