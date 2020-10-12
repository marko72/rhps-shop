$(".btnExample").on('click', function (e) {
    e.preventDefault();
    alert($(this).data('id'))
})
$("#btnUnesiPotkat").on('click', function () {
    const naziv = $("#potkatName").val();
    alert(naziv)
    $.ajax({
        url: "./modules/potkategorije.php",
        method: "post",
        data: {
            sent: true,
            insert: true,
            naziv
        },
        success: function (data) {
            alert("Uspešno uneta potkategorija")
            console.log(data)
        },
        error: function (xhr, status, err) {
            alert("Neuspeh pri unosu kategorije")
            console.log(xhr)
        }
    })
});
$("#btnDeletePotkat").on('click', function (e) {
    e.preventDefault();
    const id = $(this).data('id');
    alert(naziv)
    $.ajax({
        url: "./modules/potkategorije.php",
        method: "post",
        data: {
            sent: true,
            delete: true,
            idPotkat
        },
        success: function (data) {
            alert("Uspešno uneta potkategorija")
            console.log(data)
        },
        error: function (xhr, status, err) {
            alert("Neuspeh pri unosu kategorije")
            console.log(xhr)
        }
    })
});
$("#btnKatPotkat").on('click', function () {
    const katID = $("#ddlKategorijePotkat").val()
    console.log("KAtegorija je: "+katID)
    const potkatID = $("#ddlPotkat").val()
    console.log("KAtegorija je: "+potkatID)
    $.ajax({
        url: "./modules/potkategorije.php",
        method: "post",
        data: {
            sent: true,
            insertKatPotkat: true,
            katID,
            potkatID
        },
        success: function (data) {
            alert("Uspešno uneta potkategorija kategorije")
            console.log(data)
        },
        error: function (xhr, status, err) {
            alert("Neuspeh pri unosu potkategorije kategorije")
            console.log(xhr)
        }
    })
});
// $(".btnDeleteKatPotkat").on('click',function (e) {
//     e.preventDefault()
//     alert($(this).data('id'))
// })
$(document).on('click','.btnDeleteKatPotkat',function (e) {
    e.preventDefault()
    alert("Brisanje kategorije potkategorije");
    const idKatPotkat = $(this).data('id');
    console.log($(this))
    console.log("KAtegorija je: "+idKatPotkat)
    $.ajax({
        url: "./modules/potkategorije.php",
        method: "post",
        data: {
            sent: true,
            deleteKatPotkat: true,
            idKatPotkat
        },
        success: function (data) {
            alert("Uspešno izbrisana potkategorija kategorije")
            console.log(data)
        },
        error: function (xhr, status, err) {
            alert("Neuspeh pri brisanju potkategorije kategorije")
            console.log(xhr)
        }
    })
});
$("#ddlKategorije").on('change', function () {
    const katID = $(this).val();
    alert(katID);
    if(katID==0){
        alert("Izaberite kategoriju za pretragu")
    }else{
        alert("Salje se ajax")
        $.ajax({
            url: "./modules/potkategorije.php",
            method: "post",
            data: {
                sent: true,
                katID,
                getKategorije: true
            },
            success: function (data) {
                alert("Uspeh")
                console.log(data)
                ispisiTabelu(data)
            },
            error: function (xhr, status, err) {
                alert("Neuspeh")
                console.log(xhr)
                console.log(xhr.responseJSON);
            }
        })
    }
})
function ispisiTabelu(data) {
    let ispis = ""
    $.each(data,function (i, e) {
        ispis += '<tr>' +
            '                            <td>'+e.potkat_naziv+'</td>' +
            '                            <td>' +
            '                                <select name="ddlPol" id="ddlPol" class="w-full form-control">' +
            '                                    <option value="0">Izaberite Pol</option>' +
            '                                </select>' +
            '                            </td>' +
            '                            <td>' +
            '                                <select name="ddlKategorije" id="ddlKategorije" class="w-full form-control">' +
            '                                    <option value="'+e.kategorija_id+'">'+e.kat_naziv+'</option>' +
            '                                </select>' +
            '                            </td>' +
            '                            <td>' +
            '                                <a href="#" class="btn btn-danger btn-sm btnDeleteKatPotkat" data-id="'+e.potkat_id+'">Obriši</a>'+
            '                            </td>' +
            '                        </tr>'
    });
    console.log(ispis);
    $("#tBodyPotkategorije").html(ispis);
}
