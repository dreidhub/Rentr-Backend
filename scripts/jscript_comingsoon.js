/* Open when someone clicks on the span element */
function openNav() {
  document.getElementById("openContact").style.width = "40%";
  document.getElementById("openContact").style.border = "1px solid black";
}

/* Close when someone clicks on the "x" symbol inside the overlay */
function closeNav() {
  document.getElementById("openContact").style.width = "0%";
  document.getElementById("openContact").style.border = "none";
}
