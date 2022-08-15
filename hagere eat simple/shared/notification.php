<?php
  if (!isset($_SESSION)) 
    {session_start();}

require_once '../config/connection.php';
$uname=$_SESSION['uname'];
$sql=mysqli_query($con, "SELECT * FROM notifications WHERE username='$uname'");
$num=mysqli_num_rows($sql);
$not="<h2>Notifications: <span>$num</span></h2>";
    while( $row=mysqli_fetch_assoc($sql)){
                $text=$row['info'];
                $id=$row['id'];
                $not.=<<< END
                      <div class="notifi-item">
                      <div class="text">
                     <h4>$text</h4>
                    <p><form method="post" action="">
                    <input type="hidden" value="$id" name="not_id">
                    <button name="seen" style="margin-right:20px;padding:5px;border-radius:5px;cursor:pointer;">Accept</button></p></form>
                    <hr>
                    </div> 
                    </div>
                END;
                }

                echo $not;
                
?>