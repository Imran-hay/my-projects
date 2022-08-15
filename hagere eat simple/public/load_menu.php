<?php 
  if (!isset($_SESSION)) 
    {session_start();}
require_once('../config/connect.php');
 if(isset($_POST["limit"] , $_POST["start"])){
     $s = $_POST["start"];
     $l = $_POST["limit"];
     $rname=$_SESSION['menu'];
     $query = "SELECT * FROM menu WHERE(rname='$rname' AND active=1) LIMIT $s,$l ";
     $sql="SELECT * FROM resturant WHERE Rname='$rname'";
     $r = $conn->query($query);
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
        _End;}
}$conn = null;

    ?>
        
