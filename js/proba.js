$(document).ready(function () {
    $("#btnSubmit").click(function (e) {
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
        var paternImePrezime = /^[A-Z][a-z]{2,13}(\s[A-Z][a-z]{2,13}){0,2}$/;
        var paternEmail = /^[A-z]{3,13}((\.|\_){0,1}[0-9]{,4}){0,2}((\.|\_)?[A-z]{3,13}){0,2}((\.|\_)?[0-9]{,4}){0,2}\@(gmail|ymail|yahoo|rocketmail|outlock)\.(com|net|rs|fr|it)$/;
        var paternPasswd = /[\w\S]{5,}[\d]{1,10}/;
        var greske = {
            greskeLozinka:"",
            greskaPrezime:"",
            greskaIme:"",
            greskaEmail:""
        }
        if(!paternPasswd.test(passwd)){
            greske.greskeLozinka="Lozinka mora sadrzati slova i brojeve i mora biti duza od 5 karaktera"
        }
        else {
            if(!(passwd==confPass)) {
                greske.greskeLozinka= "Lozinke se ne poklapaju"
            }
        }
        if(!paternImePrezime.test(ime)){
            greske.greskaIme="Ime nije ispravno uneto"        }
        if(!paternImePrezime.test(prezime)){
            greske.greskaPrezime="Prezime nije ispravno uneto"
        }
        //if(!paternEmail.test(email)){
        //  greske.greskaEmail="Email ne odgovara pravilima"
        //}

        if(!greskeLozinka==""){
            $(".passwd-help").html(greskeLozinka)
        }
        else{
            $(".passwd-help").html("")
        }
        if(!greskaIme==""){
            $(".ime-help").html(greskaIme)
        }
        else{
            $(".ime-help").html("")
        }
        if(!greskaPrezime==""){
            $(".prezime-help").html(greskaPrezime)
        }
        else{
            $(".prezime-help").html("")
        }
        //console.log(greske)


        console.log(ime)
        console.log(prezime)
        console.log(email)
        console.log(passwd)
        console.log(confPass)
        console.log(pol)
    })
})