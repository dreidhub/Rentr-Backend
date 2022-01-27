(function() {
  window.onload = init;
})();

function init(){
  startTime();
  noImg();
}

function noImg(){
  if(document.getElementById("preview").innerHTML == ""){
    document.getElementById("preview").innerHTML = "No images selected.";
  }
  if(document.getElementById('preview').getElementsByTagName('img').length == 0){
    document.getElementById("preview").innerHTML = "No images selected.";
  }
  //alert(document.getElementById('preview').getElementsByTagName('div').length);
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

// window alert if FILE APIS not supported
if (window.File && window.FileReader && window.FileList && window.Blob) {
  // Great success! All the File APIs are supported.
  //alert('Aloha.');
} else {
  alert('The File APIs are not fully supported in this browser.');
}

function previewFiles() {

  var preview = document.querySelector('#preview');
  var files   = document.querySelector('input[type=file]').files;



  // i = counter for img id
  function readAndPreview(file, incr) {

    var index = incr.toString();

    // Make sure `file.name` matches our extensions criteria
    if ( /\.(jpe?g|png|gif)$/i.test(file.name) ) {
      var reader = new FileReader();


      reader.addEventListener("load", function () {

        var prevdiv = document.getElementById("preview");
        prevdiv.className = "imgprevdiv";

        var imgdiv = document.createElement("div");
        imgdiv.id = "imgDiv".concat(index);
        imgdiv.className = "imgDivclass";
        prevdiv.appendChild( imgdiv );

        var imgCheckbox = document.createElement("input");
        imgCheckbox.type = "checkbox";
        imgCheckbox.id = "removeCheckbox".concat(index);
        imgCheckbox.className += "propImgCheckbox";
        imgdiv.appendChild( imgCheckbox );

        var image = new Image();
        // add unique name + count number
        image.id = "previewImg".concat(index);
        image.height = 100;
        image.className = "propImg";
        image.title = file.name;
        image.src = this.result;
        imgdiv.appendChild( image );



        var imgButton = document.createElement("button");
        imgButton.innerHTML = "x";
        imgButton.id = "removeBtn".concat(index);
        imgButton.className += "propImgBtn";
        imgButton.addEventListener('click',function(incr){
          clearImg(index);
        });

        imgdiv.appendChild( imgButton );

      }, false);

      reader.readAsDataURL(file);
    }

  }
  /*
  if (files) {
  //replace foreach with a foreach loop and include a counter
  [].forEach.call(files, readAndPreview);
}*/
// used to assign unique id to preview images
if(files){
  for(var i = 0; i < files.length; i++) {
    var incr = i;
    readAndPreview(files[incr], incr);

  }
}

}

function resetImgtd(){
  document.getElementById("preview").innerHTML = "";
}

function clearImg(i) {
  var imgTempName = "previewImg".concat(i);
  var btnTempName = "removeBtn".concat(i);
  var boxTempName = "removeCheckbox".concat(i);
  var divTempName = "imgDiv".concat(i);
  //alert(imgTempName);
  var tempimg = document.getElementById(imgTempName);
  var tempbtn = document.getElementById(btnTempName);
  var tempbox = document.getElementById(boxTempName);
  var tempdiv = document.getElementById(divTempName);

  tempdiv.parentNode.removeChild(tempdiv);
  tempimg.parentNode.removeChild(tempbox);
  tempimg.parentNode.removeChild(tempimg);
  tempbtn.parentNode.removeChild(tempbtn);
  //document.getElementById("preview").innerHTML = "";
  noImg();
}


// Pass the checkbox name to the function
function getCheckedBoxes() {
  var checkboxes = document.getElementsByClassName("propImgCheckbox");
  var checkboxesChecked = [];
  // loop over them all
  for (var i=0; i<checkboxes.length; i++) {
     // And stick the checked ones onto an array...
     if (checkboxes[i].checked) {
        checkboxesChecked.push(checkboxes[i].id);
        //alert(checkboxes[i].id);
     }
  }
  // Return the array if it is non-empty, or null
  return checkboxesChecked.length > 0 ? checkboxesChecked : null;
}

//working as of 6/28/17 4:42am
function clearchecked(){

  var checkedBoxes = getCheckedBoxes();
  //alert(checkedBoxes);
  //alert(checkedBoxes.length);
  for(i = 0; i < checkedBoxes.length; i++){
    //alert(checkedBoxes[i].parentElement);
    var cbox = document.getElementById(checkedBoxes[i]);
    cbox.parentNode.parentNode.removeChild(cbox.parentNode);
    //alert(document.getElementById(checkedBoxes[i]).parentNode);
    //checkedBoxes[i].parentNode.removeChild(checkedBoxes[i]);
  }
  noImg();
}

function clearall(){
  var file = document.getElementById("propImages");
  file.value = file.defaultValue;
  document.getElementById("preview").innerHTML = "";
  noImg();
}


function getPhotoList(){
  document.getElementById("preview").innerHTML = photos;
}
