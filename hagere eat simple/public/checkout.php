<?php
  if (!isset($_SESSION)) 
    {session_start();}
    require_once('../config/connection.php');
    $rname=$_SESSION['menu'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" href="../resources/images/logo.png" type="image/x-icon">
   <title>Hagere Hub</title>

  <!--
    - custom css link
  -->
  <link rel="stylesheet" href="../resources/css/checkout.css">
  <!--
    - google font link
  -->
  <link
    href="https://fonts.googleapis.com/css?family=Source+Sans+3:200,300,regular,500,600,700,800,900,200italic,300italic,italic,500italic,600italic,700italic,800italic,900italic"
    rel="stylesheet" />

</head>

<body>


  <!--
    - main container
  -->
  <?php
    $uname=$_SESSION['uname'];
    $sql="SELECT * FROM customer WHERE username ='$uname'";
    $sql_run=mysqli_query($con,$sql);
    $row=mysqli_fetch_assoc($sql_run);

  ?>

  <main class="container" id="container">

    <h1 class="heading" id="heading">
      <ion-icon name="cart-outline"></ion-icon> Check Out
    </h1>

    <div class="item-flex">

      <!--
       - checkout section
      -->
      <section class="checkout">

        <h2 class="section-heading">Payment Details</h2>

        <div class="payment-form">

          <div class="payment-method">

            <button class="method selected">
              <span>Wallet Amount: <?php echo $row['wallet']?> ETB</span>
            </button>


          </div>
            <div class="cardholder-name">
              <label for="cardholder-name" class="label-default">Enter Google Maps Location</label>
              <input type="text" name="cardholder-name" id="cardholder-name" class="input-default" required>
              <button class="locate" onclick="find()">Find My Location</button>
            </div>

            <div class="card-number">
              <label for="card-number" class="label-default">Choose from Saved Location</label>
              <select class="saved" id="saved_loc" onchange="find2()">
              <option value="">Choose Location</option>
                <?php
                $loc="SELECT * FROM locations WHERE username='$uname'";
                $loc_run=mysqli_query($con,$loc);
                while($loc_row=mysqli_fetch_assoc($loc_run)):
                ?>
                <option value="<?php echo $loc_row['link'];?>" ><?php echo $loc_row['name'];?></option>
                <?php endwhile;?>
              </select>
            </div>
        </div>
        <button class="btn btn-primary" onclick="buy()" name="purchase">
          <b>Pay</b>  <span id="payAmount"></span>
        </button>
        <button class="btn" style="margin-left: 10%;">
          <b><a href="./restaurants.php">Go Back</a></b> 
        </button>

      </section>


      <!--
        - cart section
      -->
      <section class="cart" >

        <div class="cart-item-box" >

          <h2 class="section-heading">Order Summery</h2>
          <div id="cart_items">

          </div>

          

        <div class="wrapper">

          <div class="amount">

            <div class="subtotal">
              <span>Subtotal</span> <span id="subtotal"></span>
            </div>

            <div class="shipping">
              <span>Delivery</span><span id="shipping">25 ETB</span>
            </div>

            <div class="total">
              <span>Total</span> <span id="total"></span>
            </div>

          </div>

        </div>

      </section>

    </div>
  </main>






  <!--
    - custom js link
  -->
<script>
  let productsInCart = JSON.parse(localStorage.getItem('<?php echo $rname?>'));
            if(!productsInCart){
                productsInCart = [];
            }
            const parentElement = document.querySelector('#cart_items');
            const cartSumPrice = document.querySelector('#subtotal');
            const cartSumTotal = document.querySelector('#total');
            const payAmount = document.querySelector('#payAmount');
            const products = document.querySelectorAll('.menu');


            const countTheSumPrice = function () { // 4
                let sum = 0;
                productsInCart.forEach(item => {
                    sum += item.price;
                });
                return sum;
            }

            const updateShoppingCartHTML = function () {  // 3
                localStorage.setItem('<?php echo $rname?>', JSON.stringify(productsInCart));
                if (productsInCart.length > 0) {
                    let result = productsInCart.map(product => {
                        return `
                            <div class="product-card" id="product-card">
                            <div class="card">
                             <div class="img-box">
                            <img src="${product.image}" alt="cart picture" width="80px" height="80px" class="product-img">
                             </div>
                            <div class="detail">
                            <h4 class="product-name">${product.name}</h4>
                            <div class="wrapper">
                             <div class="product-qty">
                                  <button id="decrement" class="button-minus" data-id=${product.id}>
                             -
                             </button>
                              <span id="quantity">${product.count}</span>
                                <button id="increment" class="button-plus" data-id=${product.id}>
                               +
                                 </button>
                               </div>
                                <div class="price">
                                 <span id="price">${product.price}</span>
                                </div>
                          </div>
                          </div>
                               </div>
                                </div>
                            `
                    });
                    parentElement.innerHTML = result.join('');
                    document.querySelector('.checkout').classList.remove('hidden');
                    cartSumPrice.innerHTML = countTheSumPrice()+" ETB";
                    cartSumTotal.innerHTML = (countTheSumPrice()+25)+" ETB";
                    payAmount.innerHTML = (countTheSumPrice()+25)+" ETB";



                }
                else {
                    document.querySelector('.checkout').classList.add('hidden');
                    parentElement.innerHTML = '<h4 class="empty">Your shopping cart is empty</h4>';
                    cartSumPrice.innerHTML = '';
                }
            }

            function updateProductsInCart(product) { // 2
                for (let i = 0; i < productsInCart.length; i++) {
                    if (productsInCart[i].id == product.id) {
                        productsInCart[i].count += 1;
                        productsInCart[i].price = productsInCart[i].basePrice * productsInCart[i].count;
                        return;
                    }
                }
                productsInCart.push(product);
            }

            products.forEach(item => {   // 1
                item.addEventListener('click', (e) => {
                    if (e.target.classList.contains('addToCart')) {
                        const productID = e.target.dataset.productId;
                const x=".name"+productID;
                const y=".price"+productID;
                const z=".img"+productID;
                        const productName = item.querySelector(x).innerHTML;
                        const productPrice = item.querySelector(y).innerHTML;
                        const productImage = item.querySelector(z).src;
                        let product = {
                            name: productName,
                            image: productImage,
                            id: productID,
                            count: 1,
                            price: +productPrice,
                            basePrice: +productPrice,
                        }


                        updateProductsInCart(product);
                        updateShoppingCartHTML();
                    }
                });
            });

            parentElement.addEventListener('click', (e) => { // Last
                const isPlusButton = e.target.classList.contains('button-plus');
                const isMinusButton = e.target.classList.contains('button-minus');
                console.log("check");
                if (isPlusButton || isMinusButton) {
              console.log("check2");

                    for (let i = 0; i < productsInCart.length; i++) {
                        if (productsInCart[i].id == e.target.dataset.id) {
                            if (isPlusButton) {
                                productsInCart[i].count += 1
                            }
                            else if (isMinusButton) {
                                productsInCart[i].count -= 1
                            }
                            productsInCart[i].price = productsInCart[i].basePrice * productsInCart[i].count;

                        }
                        if (productsInCart[i].count <= 0) {
                            productsInCart.splice(i, 1);
                        }
                    }
                    updateShoppingCartHTML();
                }
            });

            updateShoppingCartHTML();


            function find(){
        alert("Warning: Accuracy of 'Find my Location' depends on Internet Speed So Please Confirm link after creation")
            function errorCallback(error) {
                alert(`ERROR(${error.code}): ${error.message}`);
            };
            if ('geolocation' in navigator) {
                navigator.geolocation.getCurrentPosition((position) => {
                    let x = position.coords.latitude;
                    let y = position.coords.longitude;
                    document.getElementById("cardholder-name").value = "https://www.google.com/maps/search/?api=1&query=" + x + "," + y;
                    // alert(position.time)
                }, errorCallback, { enableHighAccuracy: true });

                /* geolocation is available */
            } else {
                alert("Location not available")
                /* geolocation IS NOT available */
            }};
            function find2()
            {
              let loc=document.getElementById('saved_loc').value;
              document.getElementById("cardholder-name").value=loc;
            };

             function buy(){
                var con=confirm("Are you sure you want to Purchase");
                if(con)
                {var loc = document.getElementById('cardholder-name').value;
                let value="";
                let amount="";
                let total=countTheSumPrice()+25;
                localStorage.setItem('<?php echo $rname?>', JSON.stringify(productsInCart));
                if (productsInCart.length > 0) {
                    let x = productsInCart.map(product => {
                      value=value+product.id+",";
                      amount=amount+product.count+",";
                    });}
                   
                 const xhttp = new XMLHttpRequest();
                  xhttp.onload = function() {
                    if (this.readyState == 4 && this.status == 200)
                        document.getElementById("heading").innerHTML = this.responseText;
                    else
                    document.getElementById("heading").innerHTML = "No results";
                }
                if(loc=="")
                {
                  alert("Please enter your Location.");
                  return;
                }
                else
                {if((<?php echo $row['wallet']?>)<total)
                {
                  alert("Insufficient Balance please recharge or edit your order to continue.");
                  return;
                }
                else{
                 var url = "check.php?value="+value+"&amount="+amount+"&loc="+encodeURIComponent(loc)+"&total="+total;
                console.log(url)
               xhttp.open("GET", url, true);
               xhttp.send();}}}
            };
            </script>
  <!--
    - ionicon link
  -->
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
<!-- <li class="buyItem">
                                <img src="${product.image}">
                                <div>
                                    <h5>${product.name}</h5>
                                    <h6>$${product.price}</h6>
                                    <div>
                                        <button class="button-minus" data-id=${product.id}>-</button>
                                        <span class="countOfProduct">${product.count}</span>
                                        <button class="button-plus" data-id=${product.id}>+</button>
                                    </div>
                                </div>
                            </li> -->
</body>

</html>