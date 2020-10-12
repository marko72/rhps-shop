$(document).ready(function () {
    var pad = $(".padajuci-meni")
    pad.hide();
    // $(".kat").hover(function () {
    //     alert("Nesto se desava")
    //     $(this).find("ul").stop(true,true).slideDown();
    // })


})


$(document).on('mouseenter','.kat',function () {
    //alert("Nesto se desava")
    $(this).find(".padajuci-meni").stop(true,true).slideDown();
})
$(document).on('mouseleave','.kat',function () {
    //alert("Nesto se desava")
    $(this).find(".padajuci-meni").stop(true,true).slideUp();
})