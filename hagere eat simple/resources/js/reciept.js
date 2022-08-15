
    function Rlist(){
        var date= document.getElementById('date').value
        const xhttp = new XMLHttpRequest();
        xhttp.onload = function() {
            if (this.readyState == 4 && this.status == 200)
                document.getElementById("re_content").innerHTML = this.responseText;
            else
            document.getElementById("re_content").innerHTML = "<div align='center'> No Result</div>"
        }
        // xhttp.open("GET", "filter.php")
        if(document.getElementById("search").value !==""&&date!==null)
            var url = "search_r.php?date="+date+"&searchQuery="+document.getElementById("search").value;
        else    
          if(document.getElementById("search").value !=="")
            var url = "search_r.php?searchQuery="+document.getElementById("search").value;
        else
          if(date !=="")
            var url = "search_r.php?date="+date;
        console.log(url)
        xhttp.open("GET", url, true);
        xhttp.send();
    }