function openModel1(){
   
   const model = document.getElementById('hero')
   const overlay = document.getElementById('overlay2')
     model.classList.add('active')
     overlay.classList.add('active1')
 
}
function closeModel1(){
   const model = document.getElementById('hero')
   const overlay = document.getElementById('overlay2')
     model.classList.remove('active')
     overlay.classList.remove('active1')
 
}
function closeouter1(){
 const model = document.querySelectorAll('.hero.active')
 model.forEach(model => {
     closeModel1();
 })
}

function validate11()
{
 var regName11 = /^[a-zA-Z0-9_\.]+(@)+(hes.com)/;
 var user1 = document.getElementById("username1").value;
 if(regName11.test(user1) == false)
 {
   //window.alert("incorrect format");
   state1 = false;
 }
 var count1 = 0;
 var l1 = localStorage.length;
 for(let i = 0; i< l1;i++)
 {
  if(user1 == localStorage.getItem(localStorage.key(i)))
  {
    var x1 = localStorage.getItem(localStorage.key(i));
    var k1 = localStorage.key(i);
    localStorage.setItem("currentuser",k1);
    state1 = true;
    //window.alert(x);
    break;
  }
   if(user1 != localStorage.getItem(localStorage.key(i)))
   {
     count1++;
     if(count1 >= l1-1)
     {
        window.alert("Incorrect Username or Password");
       state1 = false;
       break;
     } 
   } 
 }
}
function validate21()
{
  if(state == true)
  {
    let c = String(localStorage.getItem("currentuser"));
    let p = c[c.length-1];
    let personc = JSON.parse(localStorage.getItem("person"+p));
    let passwordc = personc[5];
    let password = document.getElementById("password1").value;

    if(password != passwordc)
    {
      state = false;
    }
  }
}
function validate31()
{
  if(state == true)
  {
    isregistered();
    window.alert("Welcome Back");
  }
  if(state == false)
  {
    localStorage.removeItem("currentuser");
   window.alert("Incorrect Username or Password");
  }
  
}
