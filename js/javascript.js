function myFunction() {
    var x = document.getElementById("myDIV");
     if (x.style.display !== 'none') {
        x.style.display = 'none';
    }
    else {
        x.style.display = 'block';
    }
}