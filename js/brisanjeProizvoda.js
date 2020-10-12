$(document).on('click','.btnObrisi',function (e) {
    e.preventDefault()

    var idProizvoda = $(this).data('id');

    $.ajax({
        method :"post",
        url: "modules/brisanjeProizvoda.php",
        data:{
            poslato : "da",
            idProizvoda
        },
        success:function(data){
            alert("Uspesno obrisan proizvod");
            ispisiTabelu(data);
        },
        error: function (xhr, data, error) {
            alert("Neuspesno obrisan proizvod")
            //console.log(xhr)
        }
    })
})
function ispisiTabelu(data) {
    var ispis = ""
    $.each(data, function(index, podatak){
        ispis +="<tr id='hide' ><td>"+(index++)+"</td>" +
            "<td>"+podatak.naziv+"</td>" +
            "<td>"+podatak.cena+"</td>" +
            "<td>"+podatak.stanje+"</td>" +
            "<td>"+podatak.novo+"</td>" +
            "<td class='oblik'><img src='"+podatak.putanja+"' alt='"+podatak.opis+"' class=\"img-fluid\"/></td>" +
            "<td>" +
            "<a href='' class='btn btn-primary btn-xs'>Izmeni</a>" +
            "</td>" +
            "<td><a href='#' class='btn btn-danger btn-xs del btnObrisi'  data-id='"+podatak.proizvod_id+"' name='btnObrisi'>Obrisi</a></td></tr>"
    })
    $("#tabelaProizvodi").html(ispis);
}