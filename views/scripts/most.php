<!--===============================================================================================-->

<!--===============================================================================================-->
<script type="text/javascript" src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
<script type="text/javascript" src="vendor/bootstrap/js/popper.js"></script>
<script type="text/javascript" src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
<?php
if(isset($_GET['page'])):
    if($_GET['page']=="registracija"):?>
        <script src="js/registracija.js"></script>


    <?php endif; endif;?>
<script type="text/javascript" src="vendor/select2/select2.min.js"></script>
<script type="text/javascript">
    $(".selection-1").select2({
        minimumResultsForSearch: 20,
        dropdownParent: $('#dropDownSelect1')
    });

    $(".selection-2").select2({
        minimumResultsForSearch: 20,
        dropdownParent: $('#dropDownSelect2')
    });
</script>
<!--===============================================================================================-->
<script src="js/main.js"></script>
<script src="js/moj-js.js"></script>
<?php if(isset($_GET['page'])) {
    if ($_GET['page'] == 'admin'&&$_GET['admin'] == 'korisnici'):
        ?>
        <script src="js/brisanjeKorisnika.js"></script>
    <?php endif;
}
?>


</body>
</html>
