
<script type="text/javascript" src="vendor/jquery/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
<script type="text/javascript" src="vendor/bootstrap/js/popper.js"></script>
<script type="text/javascript" src="vendor/bootstrap/js/bootstrap.min.js"></script>
<?php if(isset($_GET['page'])&&$_GET['page']=='registracija'):?>
    <script src="js/registracija.js"></script>
<?php endif;?>
<script type="text/javascript" src="vendor/select2/select2.min.js"></script>
<script type="text/javascript">
    $(".selection-1").select2({
        minimumResultsForSearch: 20,
        dropdownParent: $('#dropDownSelect1')
    });
    <?php if(isset($_GET['page'])&&$_GET['page']!='index'):?>
    $(".selection-2").select2({
        minimumResultsForSearch: 20,
        dropdownParent: $('#dropDownSelect2')
    });
    <?php endif;?>
</script>
<?php if(isset($_GET['page'])&&(($_GET['page']=='index'||$_GET['page']=='products'))):?>
    <script type="text/javascript" src="js/lajkovanje.js"></script>
<?php endif;?>
<?php if(isset($_GET['page'])&&($_GET['page']=='contact')):?>
    <script type="text/javascript" src="js/kontakt.js"></script>
<?php endif;?>
<?php if((isset($_GET['page'])&&($_GET['page']=='index'||$_GET['page']=='product-detail'||$_GET['page']=='products'))||(!isset($_GET['page']))):?>
    <!--===============================================================================================-->
    <script type="text/javascript" src="vendor/slick/slick.min.js"></script>
    <script type="text/javascript" src="js/slick-custom.js"></script>
    <script type="text/javascript" src="vendor/sweetalert/sweetalert.min.js"></script>
    <script type="text/javascript">
        $('.block2-btn-addcart').each(function(){
            var nameProduct = $(this).parent().parent().parent().find('.block2-name').html();
            $(this).on('click', function(){
                swal(nameProduct, "Korpa trenutno nije u funkciji", "error");
            });
        });

        $('.block2-btn-addwishlist').each(function(){
            var nameProduct = $(this).parent().parent().parent().find('.block2-name').html();
            $(this).on('click', function(){
                swal(nameProduct, "je oznacen da vam se svidja !", "success");
            });
        });
        <?php if(isset($_GET['page'])&&$_GET['page']=='product-detail'):?>
        $('.btn-addcart-product-detail').each(function(){
            var nameProduct = $('.product-detail-name').html();
            $(this).on('click', function(){
                swal(nameProduct, "is added to wishlist !", "success");
            });
        });
        <?php endif;?>
    </script>
<?php endif;?>
<?php if(isset($_GET['page'])&&$_GET['page']=='products'):?>
    <script type="text/javascript" src="vendor/daterangepicker/moment.min.js"></script>
    <script type="text/javascript" src="vendor/daterangepicker/daterangepicker.js"></script>
    <!--===============================================================================================-->
    <script type="text/javascript" src="vendor/noui/nouislider.min.js"></script>
    <script type="text/javascript">
        /*[ No ui ]
        ===========================================================*/
        var filterBar = document.getElementById('filter-bar');

        noUiSlider.create(filterBar, {
            start: [ 50, 200 ],
            connect: true,
            range: {
                'min': 50,
                'max': 200
            }
        });

        var skipValues = [
            document.getElementById('value-lower'),
            document.getElementById('value-upper')
        ];

        filterBar.noUiSlider.on('update', function( values, handle ) {
            skipValues[handle].innerHTML = Math.round(values[handle]) ;
        });
    </script>
    <!--===============================================================================================-->
    <script src="js/moj-js.js"></script>
<?php endif;?>
<?php if(isset($_GET['page'])&&$_GET['page']=='contact'):?>
    <!--===============================================================================================-->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAKFWBqlKAGCeS1rMVoaNlwyayu0e0YRes"></script>
    <script src="js/map-custom.js"></script>
<?php endif;?>
<?php if(isset($_GET['admin'])&&$_GET['admin']=='products'):?>
    <!--===============================================================================================-->
    <script src="js/brisanjeProizvoda.js"></script>
<?php endif;?>
<?php if(isset($_GET['admin'])&&$_GET['admin']=='ostalo'):?>
    <!--===============================================================================================-->
    <script src="js/manipulacijaOstalo.js"></script>
<?php endif;?>
<?php if((isset($_GET['page'])&&$_GET['page']=='index')||(!isset($_GET['page']))):?>
    <!--===============================================================================================-->
    <script type="text/javascript" src="vendor/countdowntime/countdowntime.js"></script>
    <!--===============================================================================================-->
    <script type="text/javascript" src="vendor/lightbox2/js/lightbox.min.js"></script>
<?php endif;?>
<?php if((isset($_GET['admin'])&&$_GET['admin']=='user')):?>
    <script src="js/brisanjeKorisnika.js"></script>
<?php endif;?>
<script src="js/main.js"></script>
</body>
</html>