$(document).ready(function () {
    $(".lajk").click(function () {
        var id = $(this).data('id');
        $.ajax({
            url: "modules/lajkovanje.php",
            method :"post",
            data:{
                poslato : "da",
                id
            },
            success:function (data) {
                $('.block2-btn-addwishlist').each(function(){
                    var nameProduct = $(this).parent().parent().parent().find('.block2-name').html();
                    $(this).on('click', function(){
                        swal(nameProduct, "je oznacen da vam se svidja !", "success");
                    });
                });
            },
            error:function (xhr, status, error) {
                $('.block2-btn-addwishlist').each(function(){
                    var nameProduct = $(this).parent().parent().parent().find('.block2-name').html();
                    $(this).on('click', function(){
                        swal(nameProduct, "Vas odgovor nece biti sacuvan jer niste prijavljeni !", "error");
                    });
                });
            }
        })
    })
})