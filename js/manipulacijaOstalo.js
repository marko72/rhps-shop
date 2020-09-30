$(document).ready(function () {
    $("#btnKat").click(function () {
        var greske = [];
        var nazivKat = $("#kategorija").val()
        if(nazivKat==''){
            $("#kat-help").html("Niste uneli naziv kategorije")
            greske.push("Niste uneli naziv kategorije");
        }else{
            $("#kat-help").html("")
        }
        if(greske.length==0){
            $.ajax({
                url:"modules/unosOstalo.php",
                method:'post',
                data:{
                    poslato : "da",
                    nazivKat
                },
                success : function (data) {
                    alert("Uspesno uneta kategorija")
                },
                else: function (xhr, status, error) {
                    alert("Doslo je do greske"+xhr.status+"prilikom unosenja kategorije");
                }
            })
        }
    })
    $("#btnPodKat").click(function (e) {
        e.preventDefault();
        alert("Unos podkategorije")
        var greske = [];
        var kat = $("#ddlKat").val();
        var podkat = $("#podkat").val();
        if(kat==0){
            greske.push("Niste izabrali kategoriju")
            $("#podkatkat-help").html("Niste izabrali kategoriju")
        }else{
            $("#podkatkat-help").html("")
        }
        if(podkat==''){
            greske.push("Morate uneti naziv potkategorije")
            $("#podkat-help").html("Morate uneti naziv potkategorije")
        }else{
            $("#podkat-help").html("")
        }
        if(greske.length==0){
            $.ajax({
                url:"modules/unosOstalo.php",
                method:'post',
                data:{
                    poslato : "da",
                    kat,
                    podkat
                },
                success : function (data) {
                    alert("Uspesno uneta potkategorija")
                },
                else: function (xhr, status, error) {
                    alert("Doslo je do greske"+xhr.status+"prilikom unosenja potkategorije");
                }
            })
        }

    })
    $("#btnAkcija").click(function (e) {
        e.preventDefault();
        var greske = [];
        var nazivAkcije = $("#akcija").val()
        if(nazivAkcije==''){
            $("#akcija-help").html("Niste uneli naziv akcije")
            greske.push("Niste uneli naziv akcije");
        }else{
            $("#kat-help").html("")
        }
        var trajanje = $("#datumAkcija").val()
        if(trajanje==''){
            greske.push("Niste uneli vreme trajanja akcije")
            $("#datum-akcije-help").html("Niste uneli trajanje akcije")
        }else {
            $("#datum-akcije-help").html("")
        }
        console.log(trajanje)
        if(greske.length==0){
            $.ajax({
                url:"modules/unosOstalo.php",
                method:'post',
                data:{
                    poslato : "da",
                    nazivAkcije,
                    trajanje,
                    insertAkcija:"da"
                },
                success : function (data) {
                    alert("Uspesno uneta akcija")
                },
                else: function (xhr, status, error) {
                    alert("Doslo je do greske"+xhr.status+"prilikom unosenja akcije");
                }
            })
        }
    })
    $("#btnUpdateAkcija").click(function (e) {
        e.preventDefault();
        var greske = [];
        alert("pocetak update akcije")
        var nazivAkcije = $("#akcijaUpdate").val()
        var trajanje = ''
        trajanje = $("#datumAkcijaUpdate").val()
        if(trajanje==""){
            greske.push("Niste uneli trajanje akcije")
            $("#datum-akcije-help-update").html("Niste uneli trajanje akcije")
        }else {
            $("#datum-akcije-help-update").html("")
        }
        var idAkcije = $("#ddlAkcija").val()
        if(idAkcije==0){
            greske.push("Niste izabrali akciju za update")
            $("#ddlAkcija-help").html("Niste izabrali akciju za update")
        }else {
            $("#ddlAkcija-help").html("")
        }
        var obj = {}
        if(nazivAkcije==""){
            obj={
                poslato:"da",
                idAkcije,
                trajanje,
                updateAkcija:"da"
            }
        }else{
            obj={
                poslato:"da",
                idAkcije,
                trajanje,
                nazivAkcije,
                updateAkcija:"da"
            }
        }

        if(greske.length==0){
            $.ajax({
                url:"modules/unosOstalo.php",
                method:'post',
                data:obj,
                success : function (data) {
                    alert("Uspesno update-ovana akcija")
                },
                else: function (xhr, status, error) {
                    alert("Doslo je do greske"+xhr.status+"prilikom unosenja akcije");
                }
            })
        }else {
            console.log(greske)
        }
    })
    $("#btnDelAkcija").click(function (e) {
        e.preventDefault()
        var greske=[]
        var delAkcija = $("#ddlAkcijaDel").val()
        if(delAkcija==0){
            $("#ddlAkcijaDel-help").html("Niste izabrali akciju koju zelite da obrisete")
            greske.push("Niste izabrali akciju koju zelite da obrisete")
        }else {
            $("#ddlAkcijaDel-help").html("")
        }
        if(greske.length==0){
            $.ajax({
                url:"modules/unosOstalo.php",
                method:'post',
                data:{
                    poslato:"da",
                    delAkcija
                },
                success : function (data) {
                    alert("Uspesno obrisana akcija")
                },
                else: function (xhr, status, error) {
                    alert("Doslo je do greske"+xhr.status+"prilikom brisanja akcije");
                }
            })
        }
    })

})