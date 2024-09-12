document.addEventListener('DOMContentLoaded', function() {
    var mainImg = document.getElementById("mainImg");
    var smallImgs = document.getElementsByClassName("small-img");

    for (var i = 0; i < smallImgs.length; i++) {
        smallImgs[i].addEventListener("click", function() {
            mainImg.src = this.src; 
        });
    }
});
