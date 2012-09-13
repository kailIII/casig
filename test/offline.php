<!doctype html>  
 <html manifest="site.manifest">  
 <head>  
   <script>  
     function updateOnlineStatus(msg) {  
       var status = document.getElementById("status");  
       var condition = navigator.onLine ? "ONLINE" : "OFFLINE";  
       status.setAttribute("class", condition);  
       var state = document.getElementById("state");  
       state.innerHTML = condition;  
       var log = document.getElementById("log");  
       log.appendChild(document.createTextNode("Event: " + msg + "; status=" + condition + "\n"));  
     }  
     function loaded() {  
       updateOnlineStatus("load");  
       document.body.addEventListener("offline", function () {  
         updateOnlineStatus("offline")  
       }, false);  
       document.body.addEventListener("online", function () {  
         updateOnlineStatus("online")  
       }, false);  
     }  
   </script>  
   <style>...</style>  
 </head>  
 <body onload="loaded()">  
   <div id="status"><p id="state"></p></div>  
   <div id="log"></div>  
 </body>  
 </html>  