<?php 
 if (!isset($_SESSION)) 
    {session_start();}
 require_once('../config/connect.php');
    if(isset($_GET['filter1']))
        $filter1=$_GET['filter1'];
    else
        $filter1 ='';
    if(isset($_GET['filter2']))
        $filter2=$_GET['filter2'];
    else
        $filter2 ='';

    if(isset($_GET['filter3']))
        $filter3=$_GET['filter3'];
    else
        $filter3 ='';

    if(isset($_GET['searchQuery']))
        $search=$_GET['searchQuery'];
    else
        $search =null;    
    $rname=$_SESSION['menu'];
    if($search)
        $query = "SELECT * FROM menu WHERE rname='$rname' AND active=1 AND food LIKE '%$search%'";
    else 
    $query = "SELECT * FROM menu WHERE rname='$rname' AND active=1 ";
    $r = $conn->query($query);
    $sql="SELECT * FROM resturant WHERE Rname='$rname'";
    $x= $conn->query($sql);
    $current=$x->fetch();
    $uname=$current['username'];
    while($row = $r->fetch())
    {
        $fname = htmlspecialchars($row['food']);
        $price = htmlspecialchars($row['price']);
        $image = $row['photo'];
        $ingredients=$row['ingredients'];
        $id=$row['id'];
        if(strpos($row['catagory'], $filter1) === false)
            continue;
        if(strpos($row['catagory'], $filter2) === false)
            continue;
        if(strpos($row['catagory'], $filter3) === false)
            continue;
        
        echo <<< _End
        <div class="food-items">
            <img class="food_pic c_img img$id" src="../admin/vendor_list/$uname/menu/$image">
            <div class="details">
                <div class="details-sub">
                    <h5 class="name$id">$fname</h5>
                    <h5 class="price$id">$price </h5>
                </div>
                <p>$ingredients</p>
                <button class="addToCart" data-product-id="$id" >Add To Cart</button>
            </div>
        </div>
        _End;
        
        }

    echo  "
    </body>
    </html>
    ";       
    $pdo = null;

    ?>
        
