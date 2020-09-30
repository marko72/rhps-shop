// $(document).ready(function () {
//     $("#btnSubmit").click(function (e) {
//         dohvatiPodatke(0,e,1);
//     })
//     $("#btnIzmena").click(function (e) {
//         dohvatiPodatke(0,e,2);
//     })
//     $("#btnUnosAdmin").click(function (e) {
//         dohvatiPodatke(1,e,3);
//     })


// })
$("#btnSubmit").click(function (e) {
    alert("HEnlo")
    dohvatiPodatke(0,e,1);
})
$("#btnIzmena").click(function (e) {
    dohvatiPodatke(0,e,2);
})
$("#btnUnosAdmin").click(function (e) {
    dohvatiPodatke(1,e,3);
})
//slanje unos
function posaljiPodatke(obj){
    alert("Henlo2")
    $.ajax({
        url:"modules/registracija.php",
        type:"post",
        data:obj,
        success:function (data, xhr) {
            $("#poruka").html(data);
        },

        error:function (status, xhr, error) {
            $("#poruka").html(xhr.responseJSON);
        }
    })
}

//SLANJE IZMENA

function izmeniPodatke(obj){
    $.ajax({
        url:"modules/izmenaKorisnika.php",
        type:"post",
        data:obj,
        success:function (data, xhr) {
            $("#poruka").html("Izmena uspesno izvrsena!");
        },

        error:function (status, xhr, error) {
            $("#poruka").html("Nije izvrsena izmena!");
        }
    })
}

//FUNKCIJA PRIMA JEDAN PARAMETAR (dali) NA OSNOVU KOGA ZNA DA LI KORISNIKA UNOSI ILI MENJA SAM KORISNIK ILI GA MENJA ADMIN
//(UKOLIKO JE dali=1) JER ADMIN IMA MOGUCNOST DA KORISNIKA PRIJAVI KAO ADMINISTRATORA, ODMAH DA GA AKTIVIRA ITD
function dohvatiPodatke(dali, e, gdeSeSalje){
    e.preventDefault()
    var ime = $("#ime").val()
    var prezime = $("#prezime").val()
    var email = $("#email").val()
    var passwd = $("#password").val()
    var confPass = $("#confPass").val()
    var pol = document.getElementsByName('pol')
    var uloga = "";
    var aktivan = "";
    var korId = "";


    var izabranPol;
    for(var i=0;i<pol.length;i++){
        if(pol[i].checked) {
            pol=pol[i].value
            break;
        }
    }
    var greskaEmail = "";
    var greskeLozinka = "";
    var greskaIme = "";
    var greskaPrezime = "";
    var greske =[]
    var paternImePrezime = /^[A-Z][a-z]{2,13}(\s[A-Z][a-z]{2,13}){0,2}$/;
    var paternImePrezime = /^[A-Z][a-z]{2,13}(\s[A-Z][a-z]{2,13}){0,2}$/;
    var paternEmail = /^[A-z]{3,13}((\.|\_)[0-9]{0,4}){0,2}((\.|\_)?[A-z]{3,13}){,2}((\.|\_)?[0-9]{,4}){,2}\@(gmail|ymail|yahoo|rocketmail|outlock)\.(com|net|rs|fr|it)$/;
    var paternPasswd = /[\w\S]{5,}[\d]{1,10}/;
    var greskaUloga = "";
    var greskaAktivan = "";


    //ISPITUJEMO UKOLIKO JE PROSLEDJENO 1 TO ZNACI DA PODATKE SALJE ADMIN I TADA DOHVATAMO PODATKE I O SELEKTOVANOJ ULOZI
    //KAO I O TOME DA LI JE AKTIVAN

    if(dali==1){
        alert("Dali je 1")
        //PROVERA DA LI JE SELEKTOVANA ULOGA
        uloga = $("#ddlUloga").val()
        if(uloga == 0){
            alert("Uloga je 0")
            greskaUloga = "Morae izabrati ulogu"
            greske.push("Morate izabrati ulogu")
        }

        //AKTIVAN
        //ativan = $("#aktivan").checked()
        korId = $("#korisnikID").val()

    }

    if(!paternPasswd.test(passwd)){
        greske.push("Lozinka mora sadrzati slova i brojeve i mora biti duza od 5 karaktera")
        greskeLozinka = "Lozinka mora sadrzati slova i brojeve i mora biti duza od 5 karaktera"
    }
    else {
        if(!(passwd==confPass)) {
            greske.push("Lozinke se ne poklapaju")
            greskeLozinka = "Lozinke se ne poklapaju"
        }
    }
    if(!paternImePrezime.test(ime)){
        greske.push("Ime nije ispravno uneto")
        greskaIme = "Ime nije ispravno uneto"
    }
    if(!paternImePrezime.test(prezime)){
        greske.push("Prezime nije ispravno uneto")
        greskaPrezime = "Prezime nije ispravno uneto"
    }
    // if(!paternEmail.test(email)){
    //     console.log(email);
    //     alert("Email nije u skladu sa pravilima")
    //     greske.push("Email nije u skladu sa pravilima")
    //     greskaEmail = "Email ne odgovara pravilima"
    // }
    if(greske.length==0){
        alert("Nema gresaka")
        if(uloga==""){
            alert("Uloga je prazna")
            obj = {
                poslato:"da",
                ime,
                prezime,
                email,
                passwd,
                pol
            }
        }
        else{
            alert("Uloga nije prazna")
            obj={
                poslato:"da",
                ime,
                prezime,
                email,
                passwd,
                pol,
                uloga,
                aktivan,
                korId
            }
        }
        //ISPITUJEM DA LI SE PODACI MENJAJU ILI SE UPISUJU U BAZU NA OSNOVU PARAMETRA KOJI SAM PROSLEDIO FUNKCIJI
        //
        if(gdeSeSalje == 1){
            alert("Registracija")
            posaljiPodatke(obj)
        }
        else{
            alert("Izmena podataka")
            izmeniPodatke(obj)
        }

    }
    else {
        alert("Ima nekih gresaka")
        if(!greskaUloga == ""){
            alert("greska 1")
            $(".uloga-help").html(greskaUloga)
        }
        if (!greskeLozinka == "") {
            alert("greska 2")
            $(".passwd-help").html(greskeLozinka)
        }
        else {
            alert("greska 2.1")
            $(".passwd-help").html("")
        }
        if (!greskaIme == "") {
            alert("greska 3")
            $(".ime-help").html(greskaIme)
        }
        else {
            alert("greska 3.1")
            $(".ime-help").html("")
        }
        if (!greskaPrezime == "") {
            alert("greska 4")
            $(".prezime-help").html(greskaPrezime)
        }
        else {
            alert("greska 4.1")
            $(".prezime-help").html("")
        }
        if (!greskaEmail == "") {
            alert("greska 5")
            $(".email-help-help").html(greskaEmail)
        }
        else {
            alert("greska 5.1")
            $(".email-help").html("")
        }
        if (!greskaUloga == "") {
            alert("greska 6")
            $(".uloga-help").html(greskaUloga)
        }
        else {
            alert("greska 6.1")
            $(".uloga-help").html("")
        }
    }
}