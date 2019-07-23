
document.getElementById("openButton").addEventListener("click", function(){ w3_open();});
document.getElementById("closeButton").addEventListener("click", function(){ w3_close();});

function w3_open() {
    document.getElementById("mySidebar").style.display = "block";
}
function w3_close() {
    document.getElementById("mySidebar").style.display = "none";
}
