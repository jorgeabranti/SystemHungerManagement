$(document).ready(function () {
    $('#sidebar-menu-btn').click(function () {
        $('#sidebar').toggleClass('visible');
        var image = document.getElementById("imagesidebarmenu").src;
        if (image.includes('right.png')) {
            document.getElementById("imagesidebarmenu").src ='img/prewiev-arrow-left.png';
        } else if (image.includes('left.png'))  {
            document.getElementById("imagesidebarmenu").src ='img/prewiev-arrow-right.png';
        }
    });
});