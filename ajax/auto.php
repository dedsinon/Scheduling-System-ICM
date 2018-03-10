<html>
   <head>
      
      <style>
         div {
            width:240px;
            color:green;
         }
      </style>
      
      <script>
         function showResult(str) {
			
            if (str.length == 0) {
               document.getElementById("livesearch").innerHTML = "";
               document.getElementById("livesearch").style.border = "0px";
               return;
            }
            
            if (window.XMLHttpRequest) {
               xmlhttp = new XMLHttpRequest();
            }else {
               xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }
            
            xmlhttp.onreadystatechange = function() {
				
               if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                  document.getElementById("livesearch").innerHTML = xmlhttp.responseText;
                  document.getElementById("livesearch").style.border = "1px solid #A5ACB2";
               }
            }
            
            xmlhttp.open("GET","livesearch.php?q="+str,true);
            xmlhttp.send();
         }
      </script>
      
   </head>
   <body>
      
      <form>
         <h2>Enter Course Name</h2>
         <input type = "text" size = "30" onkeyup = "showResult(this.value)">
         <div id = "livesearch"></div>
         <a href = "http://www.tutorialspoint.com">More Details </a>
      </form>
      
   </body>
</html>