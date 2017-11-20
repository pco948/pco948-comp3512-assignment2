var x = document.getElementById("submitButton");
    x.style.display = 'none';

function myFunctionSearch() {
    var x = document.getElementById("submitButton");
    x.style.display = 'inline';
}

var input = document.getElementById("fixed-header-drawer-exp");
input.addEventListener("blur", function(){
     var x = document.getElementById("submitButton");
     x.style.display = 'none';
});