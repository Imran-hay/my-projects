$(document).ready(function(){
        let filter1 = document.getElementById('filter1').value
        let filter2 = document.getElementById('filter2').value
        let filter3 = document.getElementById('filter3').value
        let search=document.getElementById("search").value;
         var limit = 8;
         var start = 0;
         var action = 'inactive';
         function load_menu_data(limit , start ){
            $.ajax({
                url:'load_menu.php',
                method:'POST',
                data:{limit:limit, start:start},
                cache:false,
                success:function(data){
                    $('#menu-list').append(data);
                    if(data == ''){
                       action = 'active';
                    }else{
                        action = 'inactive';
                    }    
                }
            })} 
            if(action == 'inactive'){
                action = 'active';
                load_menu_data(limit , start);
            }
            $(window).scroll(function(){
                 let filter1 = document.getElementById('filter1').value
        let filter2 = document.getElementById('filter2').value
        let filter3 = document.getElementById('filter3').value
        let search=document.getElementById("search").value;
               if((filter1)==""&&(filter2=="")&&(filter3)==""&&(search=="")){
        if($(window).scrollTop() + $(window).height() > $("#menu-list").height()  && action == 'inactive' &&((filter1)==""&&(filter2=="")&&(filter3)==""&&(search==""))){
            
           
            action = "active";
            start = start + limit;
                 setTimeout(function() {
                //  $('.').remove();
                load_menu_data(limit, start);
                 },200);
            }
            }});
        
        })

    function alterMenu(){
        var filter1 = document.getElementById('filter1').value
        var filter2 = document.getElementById('filter2').value
        var filter3 = document.getElementById('filter3').value
        const xhttp = new XMLHttpRequest();
        xhttp.onload = function() {
            if (this.readyState == 4 && this.status == 200)
                document.getElementById("menu-list").innerHTML = this.responseText;
            else
            document.getElementById("menu-list").innerHTML = "No results"
        }
        // xhttp.open("GET", "filter.php")
        if(document.getElementById("search").value !=="")
            var url = "search_menu.php?filter1="+filter1+"&filter2="+filter2+"&filter3="+filter3+"&searchQuery="+document.getElementById("search").value;
        else    
            var url = "search_menu.php?filter1="+filter1+"&filter2="+filter2+"&filter3="+filter3
        console.log(url)
        xhttp.open("GET", url, true);
        xhttp.send();
    }

