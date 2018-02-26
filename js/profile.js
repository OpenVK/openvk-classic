function otvet(a,b)

{
var str = a;
var idd = b;
var text=document.getElementById(b);
document.getElementById(b).value=a+", "+text.value;
}
  function openVerify() {
    if(document.getElementById('verify').style.display == "block"){
      document.getElementById('verify').style.display = "none";
    }else{
      document.getElementById('verify').style.display = "block";
    }
  }

  function openAdmin() {
    if(document.getElementById('admin').style.display == "block"){
      document.getElementById('admin').style.display = "none";
    }else{
      document.getElementById('admin').style.display = "block";
    }
  }

  function openMenuPin() {
    if(document.getElementById('pinpostmenu').style.display == "block"){
      document.getElementById('pinpostmenu').style.display = "none";
    }else{
      document.getElementById('pinpostmenu').style.display = "block";
    }
  }

  function menuPinPhoto() {
    document.getElementById('pinpostmenu').style.display = "none";
    document.getElementById('postphoto').style.display = "block";
  }

  function openTextarea() {
    document.getElementsByClassName('post-textarea-button')[0].style.display = "none";
    document.getElementsByClassName('post-textarea')[0].style.display = "block"; 
  }

  function openTextareaEdit(idpost) {
    alert(idpost);
    document.getElementsByClassName('post'+idpost)[0].style.display = "none";
    document.getElementsByClassName('postedit'+idpost)[0].style.display = "block"; 
  }

  function openStatusEdit() {
    if(document.getElementById('statusarea').style.display == "block"){
      document.getElementById('statusarea').style.display = "none";
    }else{
      document.getElementById('statusarea').style.display = "block";
    }
  }

function openImage(imgFile){
  var imgWindow = window.open("", "ImgWindow", "width=800,height=600,scrollbars=yes"); 
  imgWindow.document.write('<img src="' + imgFile + '">');
}
function hidePanel(el,count=null) {
var info = el.parentNode.children[1];
if (info.style.display=="none") {
	info.style.display="block";
	el.children[0].style.backgroundImage = "url('img/flex_arrow_open.gif')";
	el.style.background="#DAE1E7";
	el.style.color="#446493";
	if (count) el.innerHTML=el.innerHTML.replace(" ("+count+")","");
}
else {
	info.style.display="none";
	el.children[0].style.backgroundImage = "url('img/flex_arrow_shut.gif')";
	el.style.background="#eee";
	el.style.color="#888";
	if (count) el.innerHTML+=" ("+count+")";
}
}