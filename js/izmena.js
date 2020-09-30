$(document).ready(function () {
    $("#btnIzmena").click(function (e) {
        alert("Izmena korisnika")
        e.preventDefault()
        var ime = $("#ime").val()
        var prezime = $("#prezime").val()
        var email = $("#email").val()
        var passwd = $("#password").val()
        var confPass = $("#confPass").val()
        var pol = document.getElementsByName('pol')
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
        var paternEmail = /^[A-z]{3,13}((\.|\_){0,1}[0-9]{,4}){0,2}((\.|\_)?[A-z]{3,13}){,2}((\.|\_)?[0-9]{,4}){,2}\@(gmail|ymail|yahoo|rocketmail|outlock)\.(com|net|rs|fr|it)$/;
        var paternPasswd = /[\w\S]{5,}[\d]{1,10}/;

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
        if(!paternEmail.test(email)){
            greskaEmail = "Email ne odgovara pravilima"
        }
        alert(pol)
        if(greske.length==0){
            $.ajax({
                url:"modules/registracija.php",
                type:"post",
                data:{
                    poslato:true,
                    ime,
                    prezime,
                    passwd,
                    email,
                    pol
                },
                success:function (data, xhr) {
                    $("#poruka").html(data);
                    console.log('data:')
                    console.log(data)
                    console.log('xhr:')
                    console.log(xhr)
                },
                error:function (status, xhr, error) {
                    $("#poruka").html(xhr);
                    console.log('status: ')
                    console.log(status)
                    console.log('error: ')
                    console.log(error)
                    console.log('xhr:')
                    console.log(xhr)
                }
            })
        }
        else {
            if (!greskeLozinka == "") {
                $(".passwd-help").html(greskeLozinka)
            }
            else {
                $(".passwd-help").html("")
            }
            if (!greskaIme == "") {
                $(".ime-help").html(greskaIme)
            }
            else {
                $(".ime-help").html("")
            }
            if (!greskaPrezime == "") {
                $(".prezime-help").html(greskaPrezime)
            }
            else {
                $(".prezime-help").html("")
            }
            if (!greskaEmail == "") {
                $(".email-help-help").html(greskaEmail)
            }
            else {
                $(".email-help").html("")
            }
        }
    })
})