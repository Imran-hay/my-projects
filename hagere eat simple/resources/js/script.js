window.onload = function() {
trendDisplay();
//isregistered();
}
let menu = document.querySelector('#menu-bars');
let navbar = document.querySelector('.navbar');

menu.onclick = () =>{
  menu.classList.toggle('fa-times');
  navbar.classList.toggle('active');
}


let section = document.querySelectorAll('section');
let navLinks = document.querySelectorAll('header .navbar a');

window.onscroll = () =>{

  menu.classList.remove('fa-times');
  navbar.classList.remove('active');

  section.forEach(sec =>{

    let top = window.scrollY;
    let height = sec.offsetHeight;
    let offset = sec.offsetTop - 150;
    let id = sec.getAttribute('id');

    if(top >= offset && top < offset + height){
      navLinks.forEach(links =>{
        links.classList.remove('active');
        document.querySelector('header .navbar a[href*='+id+']').classList.add('active');
      });
    };

  });

}


document.querySelector('#search-icon').onclick = () =>{
  document.querySelector('#search-form').classList.toggle('active');
}

document.querySelector('#close').onclick = () =>{
  document.querySelector('#search-form').classList.remove('active');
}

var swiper = new Swiper(".home-slider", {
  spaceBetween: 30,
  centeredSlides: true,
  autoplay: {
    delay: 7500,
    disableOnInteraction: false,
  },
  pagination: {
    el: ".swiper-pagination",
    clickable: true,
  },
  loop:true,
});

var swiper = new Swiper(".review-slider", {
  spaceBetween: 20,
  centeredSlides: true,
  autoplay: {
    delay: 7500,
    disableOnInteraction: false,
  },
  loop:true,
  breakpoints: {
    0: {
        slidesPerView: 1,
    },
    640: {
      slidesPerView: 2,
    },
    768: {
      slidesPerView: 2,
    },
    1024: {
      slidesPerView: 3,
    },
  },
});

function loader(){
  document.querySelector('.loader-container').classList.add('fade-out');
}

function fadeOut(){
  setInterval(loader, 3000);
}

window.onload = fadeOut;

function func(){
  document.querySelector('#sidebar').classList.toggle('active');
}
var mybutton = document.getElementById("myBtn");
window.onscroll = function() {scrollFunction()};
function scrollFunction() {
  if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
    mybutton.style.display = "block";
  } else {
    mybutton.style.display = "none";
  }
}
function topFunction() {
  document.body.scrollTop = 0;
  document.documentElement.scrollTop = 0;
}
function trendDisplay()
{

  function Restaurant(name,src,alt)
  {
    this.name=name;
    this.src=src;
    this.alt=alt;
  }
  const trend=[];
  trend[0]=new Restaurant("Cascara Coffee and Cocktail","resources/images/cofee.jfif","Logo of Restaurant");
  trend[1]=new Restaurant("Yod Abissinya Cultural Food","resources/images/kitfobeaybe.jfif","Logo of Restaurant");
  trend[2]=new Restaurant("Damas Habesha Resturant","resources/images/tibs.jfif","Logo of Restaurant");
  trend[3]=new Restaurant("Pizza Hut","resources/images//pizza.jfif","Logo of Restaurant");
  trend[4]=new Restaurant("OM Indian Bistro","resources/images/dish-5.png","Logo of Restaurant");
  trend[5]=new Restaurant("In Joy Burger","resources/images/burgeriza.jfif","Logo of Restaurant");
  
  for(let i=0;i<trend.length;i++)
  {
  let x=trend[i].name;
  let y=trend[i].src;
  let z=trend[i].alt;
  let a=document.createElement("img");
  a.setAttribute("src",y);
  a.setAttribute("alt",z);

  let b=document.createElement("h3");
  let d=document.createTextNode(x);
  b.appendChild(d);

  let e=document.createElement("a");
  let f=document.createTextNode("Visit");
  e.appendChild(f);
  e.setAttribute("class","btn");
  e.setAttribute("onclick","check2()");
  e.setAttribute("href","resources/html/menu.html");
  let g=document.createElement("br");
  let h=document.createElement("br");


  let c=document.createElement("div");
  c.setAttribute("class","box");
  c.appendChild(a);
  c.appendChild(b);
  c.appendChild(g);
  c.appendChild(h);
  c.appendChild(e);

  document.getElementById("boxContain").appendChild(c);}
}
/*function isregistered()
 {
   let check=localStorage.getItem("currentuser");
     if(check==null)
    {  document.getElementById("sidebar_btn").style.display="none";
       document.getElementById("not-registered1").style.display="inline";
       document.getElementById("not-registered2").style.display="inline";
    }
     else
    {  
      document.getElementById("sidebar_btn").style.display="inline";
      document.getElementById("not-registered1").style.display="none";
      document.getElementById("not-registered2").style.display="none";
      check=String(check);
      let p = check[check.length-1];
      let prof = JSON.parse(localStorage.getItem("person"+p));
      let p1=document.createTextNode(prof[2]);
      let p2=document.createTextNode(prof[0]+prof[1]);
      let p3=document.createTextNode(prof[3]);
      let p4=document.createTextNode(prof[4]);
      let p5=document.createTextNode(prof[6]);
      document.getElementById("profile1").appendChild(p1);
      document.getElementById("profile2").appendChild(p2);
      document.getElementById("profile3").appendChild(p3);
      document.getElementById("profile4").appendChild(p4);
      document.getElementById("amount").appendChild(p5);

    }
 }*/

function logout()
{
//   let conf=confirm("Are You Sure You Want to Log Out?");
//   if(conf==true){
//   localStorage.removeItem("currentuser");
//   location.reload();
// }
}








