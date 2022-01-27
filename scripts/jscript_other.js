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

var expanded = false;

function showDropdown(){
  var checkboxes = document.getElementById("checkboxes");
  if (!expanded) {
    checkboxes.style.display = "block";
    expanded = true;
  } else {
    checkboxes.style.display = "none";
    expanded = false;
  }
}

/* Open when someone clicks on the span element */
function openNav() {
  document.getElementById("TenantApp").style.width = "100%";
  document.getElementById("TenantApp").style.border = "1px solid black";
}

/* Close when someone clicks on the "x" symbol inside the overlay */
function closeNav() {
  document.getElementById("TenantApp").style.width = "0%";
  document.getElementById("TenantApp").style.border = "none";
}

function loginNotify() {
  //var message = new Notification("You must be logged in to apply for a property.");
  //message.onclick(alert("You must be logged in to apply for a property."));
  var span = document.getElementsByClassName("close")[0];

  var modal = document.getElementById("popupNotify");

  modal.style.display = "block";
  window.onclick = function(event){
    if(event.target == modal){
      modal.style.display = "none";
    }
  }
}

function showRentals(){
  var hidden = document.getElementsByClassName("hiddenprop2");
  for(var i=0; i < hidden.length; i++) {
    hidden[i].style.display = "table-row";
  }
}

function showRentals2(){
  var hidden = document.getElementsByClassName("hiddenprop3");
  for(var i=0; i < hidden.length; i++) {
    hidden[i].style.display = "table-row";
  }
}

function showRefs2(){
  var hidden = document.getElementsByClassName("hiddenRef2");
  for(var i=0; i < hidden.length; i++) {
    hidden[i].style.display = "table-row";
  }
}

function showRefs3(){
  var hidden = document.getElementsByClassName("hiddenRef3");
  for(var i=0; i < hidden.length; i++) {
    hidden[i].style.display = "table-row";
  }
}
