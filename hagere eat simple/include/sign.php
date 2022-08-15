<div class="hero find" id="hero" >
    <div class="form-box" id="form-box">
    <button class="close" onclick="login(),closeModel1()">&times;</button>
        <div class="button-box">
        
            <div id="btnn"></div>
           <button type="button" class="toggle-btn" onclick="login()">Log In</button>
          <button type="button" class="toggle-btn" onclick="register()">Register</button>
        </div>
        <form id="login" class="input-group" method="post" action="">
            <?php if(isset($info)){
                echo $info;
            } ?>
        <input type="text" class="input-field" name="username" placeholder="Enter Username" id="username"  required
                            pattern="^[a-zA-Z0-9_\.]+(@)+(hes.com)">
        <input type="password" class="input-field" name="password" id="" placeholder="Enter Password" required> 
        <input type="checkbox" class="check-box"><span id="remember">Remember Password</span>
                         <h3>
      <?php  if(isset($error)) :?>
       <?php  if (count($error) > 0) : ?>
        <div class="error">
    	<?php foreach ($error as $err) : ?>
    	  <p><?php echo $err;
           unset($err);?></p>
    	<?php endforeach ?>
          </div>
            <?php  endif ?>
            <?php endif ?>
    </h3>
        <input class="submit-btn" id="" type="submit" name="sign_in" value="Sign In">
         <br>
        <a href="../library/mailtrial/index.php">Forgot Password?</a>
        </form>
        <form id="register" class="input-group" method="post" action="">
         <?php  if(isset($error2)) :?>
       <?php  if (count($error2) > 0) : ?>
        <div class="error">
    	<?php foreach ($error2 as $err) : ?>
    	  <p><?php echo $err;
           unset($err);?></p>
    	<?php endforeach ?>
          </div>
            <?php  endif ?>
            <?php endif ?>
        <input type="text" name="fname" id="fname" class="input-field" placeholder="First name" required
                pattern="^[A-Za-z]+$" onchange="change1()"><span><img src="" id="v1" width="20px"></span>

        <input type="text" name="lname" id="lname" class="input-field" placeholder="Last name" required
                pattern="^[A-Za-z]+$" onchange="change2()"><span><img src="" id="v2" width="20px"></span>


        <input type="text" name="username" id="username" placeholder="Username (must end with '@hes.com')" class="input-field" required
                pattern="^[a-zA-Z0-9_\.]+(@)+(hes.com)" onchange="change3()"><span><img src="" id="v3"
                    width="20px"></span>


            <input type="email" name="email" id="email" placeholder="Email" class="input-field" required
                pattern="^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$"
                onchange="change4()"><span><img src="" id="v4" width="20px"></span>

            <input type="tel" name="tel" id="tel" placeholder="Phone Number" class="input-field" required pattern="^\d{10}$"
                onchange="change5()"><span><img src="" id="v5" width="20px"></span>


            <input type="password" name="password" id="password" placeholder="Password 'Atleast capital, one small, one number, eight charcater'" class="input-field" required
                onchange="change6()"><span><img src="" id="v6" width="20px"></span>

            <input type="password" name="password2" id="password2" placeholder="Confirm Password" class="input-field"
                required onchange="change7()"><span><img src="" id="v7" width="20px"></span>
            <div class="agr">
                <input type="checkbox" value="agree" id="agree" required> I've Read and I Agree Hagere Eat Simple's <a
                    href="resources/html/privacy_policy.html" target="_blank">Privacy Policies</a> and <a href="resources/html/terms&conditions.html" target="_blank">Terms anc
                    Conditions.</a>
            </div>
            <input id="" class="submit-btn" type="submit" name="sign_up" value="Sign Up">

         
           </form>
         
        </div>
</div>
<div class="a" id="overlay2" onclick="closeouter1()"></div> 
