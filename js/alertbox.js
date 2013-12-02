function tempAlert(msg,duration)
{
 var el = document.createElement("div");
 el.setAttribute("style","position:absolute;z-index:999;top:40%;left:40%;background-color:#eee;color:red;height:30px;width:400px;text-align:center;border:3px solid gray;padding-top:10px;");
 el.innerHTML = msg;
 setTimeout(function(){
  el.parentNode.removeChild(el);
 },duration);
 document.body.appendChild(el);
}
