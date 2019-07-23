document.getElementById("drop").addEventListener("click", function(){ w3_drop();});

function w3_drop() {
}
document.getElementById("historytab").addEventListener("click", function(){ openTab(event, "historytab_page"); });
document.getElementById("vitaltab").addEventListener("click", function(){ openTab(event, "vitaltab_page"); });
// document.getElementById("res").addEventListener("click", function(){ myFunction(); });
function openTab(evt, tabid) {
    // Declare all variables
    var i, tabcontent, tablinks;

    // Get all elements with class="tabcontent" and hide them
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }

    // Get all elements with class="tablinks" and remove the class "active"
    tablinks = document.getElementsByClassName("tablink");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace("w3-green", "w3-green");
    }

    // Show the current tab, and add an "active" class to the button that opened the tab
    document.getElementById(tabid).style.display = "block";
    evt.currentTarget.className += " w3-green";
}
