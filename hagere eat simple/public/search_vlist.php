<?php
session_start();
include("../config/connection.php");

    if(isset($_GET['searchQuery']))
        $search=$_GET['searchQuery'];
    else
        $search="";

    $q="SELECT resturant.username,Rname,logo,active,location FROM resturant INNER JOIN customer where customer.username=resturant.username AND active=1 AND state=1 AND Rname LIKE '%$search%'";
    $q_run=mysqli_query($con,$q);

    if(mysqli_num_rows($q_run)>0)
    {
        while($row=mysqli_fetch_assoc($q_run))
        {
            $uname=$row['username'];
            $logo=$row['logo'];
            $rname=$row['Rname'];
            $loc=$row['location'];
            echo <<<_END
                <div class="rl_card">
                <img src="../admin/vendor_list/$uname/images/$logo" alt="logo" class="pb">
                <div class="info">
                   <h1> $rname</h1>
                </div>
                <div class=rl_buttons>
                    <form action="" method="post">
                    <input type="hidden" name="menu_name" value="$rname">
                   <button id="visit_r" name="view_menu">Visit</button>
                   </form>
                <button id="view_l" > <a target="_blank" href="$loc">View Location</a></button>
                  </div> 
                </div>
            _END;
        }
    }
    else
     echo '<span class="info">Restaurant not Found</span>'
    ?>