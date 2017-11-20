function myFunction() {
    var x = document.getElementById("myDIV");
     if (x.style.display == 'none') {
            x.style.display = 'block';
    }
    else {
         x.style.display = 'none';
    }
}



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

