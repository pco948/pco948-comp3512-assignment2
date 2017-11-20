// JavaScript File


// Get the modal
var modal = document.getElementById('myModal');

// Get the image and insert it inside the modal - use its "alt" text as a caption
var img = document.getElementById('myImg');
var modalImg = document.getElementById("img01");
var captionText = document.getElementById("caption");
img.onclick = function(){
    modal.style.display = "block";
    modalImg.src = this.src;
    captionText.innerHTML = this.alt;
}

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

//when clicking on the image, closes modal
var modal = document.getElementById('myModal');
modal.addEventListener('click',function(){
this.style.display="none";
})

// When the user clicks on <span> (x), close the modal
span.onclick = function() { 
    modal.style.display = "none";
}

  $(document).ready(function() {
        var myImg = $("myImg");
        var newImg = "src=book-images/large";
        myImg.attr('src', newImg);
    });
    
