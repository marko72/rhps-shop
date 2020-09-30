$(document).ready(function () {
    $("#btnContact").click(function (e) {
        e.preventDefault()
        var greske = new Array()
        var name = $("#name").val()
        var email = $("#email").val()
        var message = $("#message").val()
        var paternName = /^[A-Z][a-z]{2,12}$/;
        //var paternEmail = /^[A-z]{3,13}((\.|\_){0,1}[0-9]{,4}){0,2}((\.|\_)?[A-z]{3,13}){,2}((\.|\_)?[0-9]{,4}){,2}\@(gmail|ymail|yahoo|rocketmail|outlock)\.(com|net|rs|fr|it)$/;
        if(!paternName.test(name)){
            greske.push("Ime nije dobrog formata")
        }
        //if(!paternEmail.test(email)){
          //  greske.push("Email nije dobrog formata")
        //}
        if(message==""){
            greske.push("Niste napisali tekst poruke")
        }
        if(greske.length==0){
            $.ajax({
                url:"modules/kontakt.php",
                method:"post",
                data:{
                    btnContact:"da",
                    email,
                    name,
                    message
                },
                success:function (data) {
                    $("#help").html(data)
                },
                error:function (xhr, status, error) {
                    console.log(xhr)
                    $("#help").html("Email nije poslat")
                }

            })

        }else {
            var ispis = ""
            $.each(greske, function (index, element) {
                ispis+=element+"</br>";
            })
            $("#help").html(ispis)
        }

    })
})