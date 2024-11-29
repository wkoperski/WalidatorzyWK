<?php
/* Smarty version 5.4.1, created on 2024-11-28 20:20:38
  from 'file:Validators/delete.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.4.1',
  'unifunc' => 'content_6748d096cad7d8_69283192',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '8012b07768497df65edfe6f44e6529b803829ee0' => 
    array (
      0 => 'Validators/delete.tpl',
      1 => 1732825265,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:header.tpl' => 1,
    'file:sidebar.tpl' => 1,
    'file:footer.tpl' => 1,
  ),
))) {
function content_6748d096cad7d8_69283192 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = '/var/www/html/templates/Validators';
?><!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Dashboard - Weryfikacja dostawców</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="assets/img/favicon.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="assets/css/style.css" rel="stylesheet">

    <!-- =======================================================
    * Template Name: NiceAdmin
    * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
    * Updated: Apr 20 2024 with Bootstrap v5.3.3
    * Author: BootstrapMade.com
    * License: https://bootstrapmade.com/license/
    ======================================================== -->
</head>
<?php echo '<script'; ?>
>
    window.onload = function(){
        setTimeout(loadAfterTime, 5000)
    };


    function loadAfterTime() {
    const komunikat = document.getElementById("komunikat");
    const powrot = document.getElementById("return");
    if(komunikat){
        komunikat.style.display = "none";
    }

    if(powrot){
            window.location.replace("index.php");
        }
    }
<?php echo '</script'; ?>
>
<body>

<!-- ======= Header ======= -->
<?php $_smarty_tpl->renderSubTemplate("file:header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
?>
<!-- End Header -->

<!-- ======= Sidebar ======= -->
<?php $_smarty_tpl->renderSubTemplate("file:sidebar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
?>
<!-- End Sidebar-->

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item"><a href="index.php">Walidatorzy</a></li>
                <li class="breadcrumb-item active">Usuwanie - aktywne walidacje</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">

                <?php if ((null !== ($_smarty_tpl->getValue('komunikat') ?? null))) {?>
                    <h5 class="card-title"></h5>
                    <div class="alert alert-success" role="alert" id="komunikat">
                        <?php echo $_smarty_tpl->getValue('komunikat');?>

                        <?php if ((null !== ($_smarty_tpl->getValue('return') ?? null))) {?>
                            <br/>
                            Za chwilę zostanie załadowana poprzednia strona
                            <input type="hidden" id="return" >
                        <?php }?>

                    </div>
                <?php }?>



                <!-- Default Table -->
                <form action="index.php" method="POST" id="form">

                    <?php if ((null !== ($_smarty_tpl->getValue('formalVerificationList') ?? null))) {?>
                        <h5 class="card-title">Aktywne weryfikacje formalne dla <Strong><?php echo $_smarty_tpl->getValue('deleteValidatorName');?>
</Strong></h5>
                        <?php if ((null !== ($_smarty_tpl->getValue('transactionVerificationList') ?? null))) {?>
                            <div class="alert alert-warning" role="alert">
                                Przed usunięciem Weryfikacji formalnej usuń weryfikacje transakcyjne powiązane z tym walidatorem
                            </div>
                        <?php }?>
                        <table class="table table-responsive-sm">
                            <thead>
                            <tr class="">
                                <th scope="col">#</th>
                                <th scope="col">Nazwa</th>
                                <th scope="col">Nip</th>
                                <th scope="col">Zgłaszający</th>
                                <th scope="col">Ocena</th>
                                <th scope="col">Usuń</th>
                                <th scope="col">Zmień</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $_smarty_tpl->assign('counter', 1, false, NULL);?>
                            <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('formalVerificationList'), 'veryfication');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('veryfication')->value) {
$foreach0DoElse = false;
?>
                                <tr >
                                    <th scope="row"><?php echo $_smarty_tpl->getVariable('counter')->postIncDec('++');?>
</th>
                                    <td><?php echo $_smarty_tpl->getValue('veryfication')['nazwa'];?>
</td>
                                    <td><?php echo $_smarty_tpl->getValue('veryfication')['nip'];?>
</td>
                                    <td><?php echo $_smarty_tpl->getValue('veryfication')['zglaszajacy'];?>
</td>
                                    <td><?php echo $_smarty_tpl->getValue('veryfication')['ocena_wiarygodnosci'];?>
</td>
                                    <td>
                                        <button type="submit" class="btn btn-danger" name="delete_verification_formal" value="<?php echo $_smarty_tpl->getValue('veryfication')['id'];?>
" <?php if ((null !== ($_smarty_tpl->getValue('transactionVerificationList') ?? null))) {?>disabled<?php }?>>Usuń</button>
                                        <input type="hidden" name="validator_delete" value="<?php echo $_smarty_tpl->getValue('deleteValidatorName');?>
">
                                    </td>
                                    <td>
                                        <select class="form-control choices-single" onchange="this.form.submit()" name="new_validator_verification_transaction">
                                            <?php echo $_smarty_tpl->getSmarty()->getFunctionHandler('html_options')->handle(array('options'=>$_smarty_tpl->getValue('listValidators'),'selected'=>$_smarty_tpl->getValue('mySelect')), $_smarty_tpl);?>

                                        </select>
                                    </td>
                                </tr>

                            <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>


                            </tbody>
                        </table>
                    <?php }?>

                    <?php if ((null !== ($_smarty_tpl->getValue('transactionVerificationList') ?? null))) {?>
                        <h5 class="card-title">Aktywne weryfikacje transakcyjne dla <strong><?php echo $_smarty_tpl->getValue('deleteValidatorName');?>
</strong></h5>
                        <table class="table table-responsive-sm">
                            <thead>
                            <tr class="">
                                <th scope="col">#</th>
                                <th scope="col">Nazwa</th>
                                <th scope="col">Nip</th>
                                <th scope="col">Zgłaszający</th>
                                <th scope="col">Ocena</th>
                                <th scope="col">Usuń</th>
                                <th scope="col">Zmień</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $_smarty_tpl->assign('counter', 1, false, NULL);?>
                            <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('transactionVerificationList'), 'veryfication');
$foreach1DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('veryfication')->value) {
$foreach1DoElse = false;
?>
                                <tr>
                                    <th scope="row"><?php echo $_smarty_tpl->getVariable('counter')->postIncDec('++');?>
</th>
                                    <td><?php echo $_smarty_tpl->getValue('veryfication')['nazwa'];?>
</td>
                                    <td><?php echo $_smarty_tpl->getValue('veryfication')['nip'];?>
</td>
                                    <td><?php echo $_smarty_tpl->getValue('veryfication')['zglaszajacy'];?>
</td>
                                    <td><?php echo $_smarty_tpl->getValue('veryfication')['wynik_weryfikacji'];?>
</td>
                                    <td>
                                        <button type="submit" class="btn btn-danger" name="delete_verification_formal" value="<?php echo $_smarty_tpl->getValue('veryfication')['guid'];?>
">Usuń</button>
                                        <input type="hidden" name="validator_delete" value="<?php echo $_smarty_tpl->getValue('deleteValidatorName');?>
">
                                        <input type="hidden" name="change_verification_formal" value="<?php echo $_smarty_tpl->getValue('veryfication')['guid'];?>
">
                                    </td>
                                    <td>

                                        <select class="form-control choices-single" onchange="this.form.submit()" name="new_validator_verification_transaction">
                                            <?php echo $_smarty_tpl->getSmarty()->getFunctionHandler('html_options')->handle(array('options'=>$_smarty_tpl->getValue('listValidators'),'selected'=>$_smarty_tpl->getValue('mySelect')), $_smarty_tpl);?>

                                        </select>
                                                                               
                                    </td>
                                </tr>

                            <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>


                            </tbody>
                        </table>
                    <?php }?>
                </form>
                <!-- End Default Table Example -->
            </div>
        </div>
    </div>


</main><!-- End #main -->

<!-- ======= Footer ======= -->
<?php $_smarty_tpl->renderSubTemplate("file:footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
?>
<!-- End Footer -->

<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<!-- Vendor JS Files -->
<?php echo '<script'; ?>
 src="assets/vendor/apexcharts/apexcharts.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="assets/vendor/chart.js/chart.umd.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="assets/vendor/echarts/echarts.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="assets/vendor/quill/quill.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="assets/vendor/simple-datatables/simple-datatables.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="assets/vendor/tinymce/tinymce.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="assets/vendor/php-email-form/validate.js"><?php echo '</script'; ?>
>

<!-- Template Main JS File -->
<?php echo '<script'; ?>
 src="assets/js/main.js"><?php echo '</script'; ?>
>

</body>

</html><?php }
}
