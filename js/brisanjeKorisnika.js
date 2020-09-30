$(".del").click(function (e) {
    e.preventDefault()
    var ovaj = $(this);
    var id = $(this).data('id');
    //alert(id);
    $.ajax({
        url:"modules/brisanjeKorisnika.php",
        type:"post",
        data:{
            poslato:"da",
            id
        },
        success:function (data, xhr) {
            alert("Uspesno obrisan");
            ovaj.parent().parent().stop(true,true).slideToggle();
        },
        error:function (xhr, status, error) {
            alert("Korisnik nije obrisan");
        }
    })

})