$(document).ready(function () {
    var pad = $(".padajuci-meni")
    pad.hide();

    $(".kat").hover(function () {
        $(this).find("ul").stop(true,true).slideToggle();
    })


})

