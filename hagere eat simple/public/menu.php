<?php
  if (!isset($_SESSION)) 
    {session_start();}
    require_once('../config/connection.php');
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!--========== BOX ICONS ==========-->
        <link href='https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css' rel='stylesheet'>
    	<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css">
            <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <!--Stylesheet-->
        <!--========== CSS ==========-->
        <link rel="stylesheet" href="../resources/css/styles.css">
        <link rel="stylesheet" href="../resources/css/st.css">
        <link rel="stylesheet" href="../resources/css/menu.css">
        <link rel="stylesheet" href="../resources/css/cart.css">

        <link rel="shortcut icon" href="../resources/images/logo.png" type="image/x-icon">
        <title>Restaurants </title>
    </head>
    <body>

        <!--========== SCROLL TOP ==========-->
        <a href="#" class="scrolltop" id="scroll-top">
            <i class='bx bx-chevron-up scrolltop__icon'></i>
        </a>
          <div class="shopping-cart cart_button">
                        <div class="sum-prices">
                            <!--Shopping cart logo-->
                            <i
                                class="fas fa-shopping-cart shoppingCartButton"
                            ></i>
                            <!--The total prices of products in the shopping cart -->
                            <h6 id="sum-prices"></h6>
                        </div>
                    </div>

        <!--========== HEADER ==========-->
        <header class="l-header" id="header">
            <nav class="nav bd-container">
                <a href="../index.php" class="nav__logo"><i class='fas fa-bicycle'></i> hagere eat simple</a>
                                        <?php
                        if(!isset($_SESSION['state']))
                        { 
                            header("Location: /HES/");
                                exit;
                        }
                        else{
                        if($_SESSION['state']==2)
                        { echo <<<_End
                                                <div class="nav__menu" id="nav-menu">
                                                <ul class="nav__list">
                                                <li class="nav__item"><a href="../index.php" class="nav__link">Home</a></li>
                                                <li class="nav__item"><a href="restaurants.php" class="nav__link">Restaurants</a></li>
                                                <li class="nav__item"><a href="about_us.php" class="nav__link">About</a></li>
                                                <li class="nav__item"><a href="customer_profile.php" class="nav__link">Profile</a></li>
                                                <form action="../index.php" method="post">
                                                <button id="logout_btn" class="nav__item" type="submit" name="log_out" onclick="return confirm('Are you sure you want to logout?');">Logout</button>
                                                </form>
                                                <li><i class='bx bx-moon change-theme' id="theme-button"></i></li>
                                            </ul>
                                            </div>
                        _End;   
                        }
                        if($_SESSION['state']==3)
                            {
                            header("Location: /HES/admin/");
                                exit;
                            }
                        if($_SESSION['state']==1)
                            {
                            header("Location:/HES/vendor/vendor/home.php");
                                exit;
                            }
                        }
                    ?>
                   <div class="nav__toggle" id="nav-toggle">
                    <i class='bx bx-menu'></i>
                </div>
            </nav>
        </header>


         
             <!-- Content    -->
              
            <div class="heading">
             <?php
             $rname=$_SESSION['menu'];
             $sql="SELECT * FROM resturant WHERE Rname='$rname'";
             $sql_run=mysqli_query($con,$sql);
             $row=mysqli_fetch_assoc($sql_run);
             ?>  
            <h1><?php echo $row['Rname'];?></h1>
            <div class="about"><?php echo stripslashes($row['about']);?></div>
            <h3>&mdash; MENU &mdash; </h3> 
            <details class="sort">
                <summary><i class='fas fa-filter' style='font-size:24px;color:white'></i></summary>
                <div class="group_s">
                <svg class="icon_s" aria-hidden="true" viewBox="0 0 24 24"><g><path d="M21.53 20.47l-3.66-3.66C19.195 15.24 20 13.214 20 11c0-4.97-4.03-9-9-9s-9 4.03-9 9 4.03 9 9 9c2.215 0 4.24-.804 5.808-2.13l3.66 3.66c.147.146.34.22.53.22s.385-.073.53-.22c.295-.293.295-.767.002-1.06zM3.5 11c0-4.135 3.365-7.5 7.5-7.5s7.5 3.365 7.5 7.5-3.365 7.5-7.5 7.5-7.5-3.365-7.5-7.5z"></path></g></svg>
                <input class="input_search" placeholder="Search for Restaurants" type="search" onkeyup="alterMenu();" value="" id="search">
                &nbsp;&nbsp;&nbsp;
                <select class="input_search" id="filter1" onchange="alterMenu()">
                    <option value=""> Any Cuisine</option>
                    <option value="trad"> Traditional Foods</option>
                    <option value="ntrad">Non-Traditional Foods</option>
                </select>
                &nbsp;&nbsp;&nbsp;
                <select class="input_search" id="filter2" onchange="alterMenu()">
                    <option value=""> Any Type</option>
                    <option value="break"> Breakfast</option>
                    <option value="lun">Lunch</option>
                    <option value="din">Dinner</option>
                    <option value="drink">Drinks</option>
                </select>
                &nbsp;&nbsp;&nbsp;
                <select class="input_search" id="filter3" onchange="alterMenu()">
                <option value=""> Both</option>
                    <option value="fast"> Fasting Food</option>
                    <option value="nfast">Non-Fasting Food</option>
            </select>
                &nbsp;&nbsp;&nbsp;
            </div>
            </details>
           
              <div class="producstOnCart hide">
                <div class="overlay"></div>
                <div class="top">
                    <button id="closeButton">
                        <i class="fas fa-times-circle"></i>
                    </button>
                    <h3>Cart</h3>
                </div>
                <ul id="buyItems">
                </ul>
                <button class="btn checkout hidden"><a href="./checkout.php"> Check out</a></button>
            </div>
        </div>
            <div class="menu" id="menu-list">
       
    </div>      
   <!--========== FOOTER ==========-->
        <footer class="footer section bd-container">
            <div class="footer__container bd-grid">
                <div class="footer__content">
                    <a href="#" class="footer__logo" style="color:brown;">hagere eat simple</a>
                    <span class="footer__description">Restaurant</span>
                    <div>
                        <a href="#" class="footer__social"><i class='bx bxl-facebook'></i></a>
                        <a href="#" class="footer__social"><i class='bx bxl-instagram'></i></a>
                        <a href="#" class="footer__social"><i class='bx bxl-twitter'></i></a>
                    </div>
                </div>

                <div class="footer__content">
                    <h3 class="footer__title">Quick Links</h3>
                    <ul>
                        <li><a href="#" class="footer__link">Home</a></li>
                        <li><a href="#" class="footer__link">Restaurants</a></li>
                        <li><a href="#" class="footer__link">About Us</a></li>
                    </ul>
                </div>

                <div class="footer__content">
                    <h3 class="footer__title">Contact Us</h3>
                    <ul>
                       <li>+251-921-3453</li> 
                       <li>+251-934-8679</li> 
                       <li>eatsimple@gmail.com</li> 
                    </ul>
                </div>

                <div class="footer__content">
                    <h3 class="footer__title">Location</h3>
                    <ul>
                        <li>Megenagna, Zefmeshe Mall</li>
                        <li>3<sup>rd</sup> Floor, 304</li>
                        <li>Megenagna, Zelalem Bld</li>
                        <li>1<sup>st</sup> Floor, 111</li>
                    </ul>
                </div>
            </div>

            <p class="footer__copy">&#169; 2022 Hagere Eat Simple. All right reserved</p>
        </footer>

        <!--========== SCROLL REVEAL ==========-->
        <script src="https://unpkg.com/scrollreveal"></script>
        <script>
            let productsInCart = JSON.parse(localStorage.getItem('<?php echo $rname?>'));
            if(!productsInCart){
                productsInCart = [];
            }
            const parentElement = document.querySelector('#buyItems');
            const cartSumPrice = document.querySelector('#sum-prices');
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
                            <li class="buyItem">
                                <img src="${product.image}">
                                <div>
                                    <h5>${product.name}</h5>
                                    <h6>${product.price} ETB</h6>
                                    <div>
                                        <button class="button-minus" data-id=${product.id}>-</button>
                                        <span class="countOfProduct">${product.count}</span>
                                        <button class="button-plus" data-id=${product.id}>+</button>
                                    </div>
                                </div>
                            </li>`
                    });
                    parentElement.innerHTML = result.join('');
                    document.querySelector('.checkout').classList.remove('hidden');
                    cartSumPrice.innerHTML =  countTheSumPrice()+"ETB";

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
                console.log(productID);
                console.log(productName);
                console.log(productPrice);

                        updateProductsInCart(product);
                        updateShoppingCartHTML();
                    }
                });
            });

            parentElement.addEventListener('click', (e) => { // Last
                const isPlusButton = e.target.classList.contains('button-plus');
                const isMinusButton = e.target.classList.contains('button-minus');
                if (isPlusButton || isMinusButton) {
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
        </script>
        <!--========== MAIN JS ==========-->
        <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
        <script src="../resources/js/browse.js"></script>
        <script src="../resources/js/cart.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="../resources/js/menu.js"></script>

    </body>
</html>