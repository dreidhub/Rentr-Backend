(function() {
  window.onload = init;
})();

function init(){
  startTime();
}

function show(show){
  scroll(0,0);
  //document.getElementById('frmRegistration').className= "hidden";
  //document.getElementById('proprent').className= "hidden";
  //document.getElementById('createlist').className= "hidden";
  //document.getElementById('faqdata').className= "hidden";
  //document.getElementById('reguser').className= "hidden";
  document.getElementById(show).className= "aloha";
}

function startTime() {
    var today = new Date();
    var h = today.getHours();
    var m = today.getMinutes();
    var s = today.getSeconds();
    m = checkTime(m);
    s = checkTime(s);
    document.getElementById('time').innerHTML =
    h + ":" + m + ":" + s;
    var t = setTimeout(startTime, 500);
}
function checkTime(i) {
    if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
    return i;
}

function hide() {
  document.getElementById("contactform").style.display = "none";
}

if (grecaptcha.getResponse() == ""){
    alert("You must check all fields before submitting!");
} else {
    //alert("Thank you");
}
