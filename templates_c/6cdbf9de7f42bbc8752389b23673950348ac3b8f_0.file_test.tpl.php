<?php
/* Smarty version 5.4.1, created on 2024-11-26 10:00:31
  from 'file:test.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.4.1',
  'unifunc' => 'content_67459c3fa84bd7_32472386',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '6cdbf9de7f42bbc8752389b23673950348ac3b8f' => 
    array (
      0 => 'test.tpl',
      1 => 1732615224,
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
function content_67459c3fa84bd7_32472386 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\Users\\wkoperski\\PhpstormProjects\\WalidatorzyWK\\templates';
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
                <li class="breadcrumb-item"><a href="index.php">Pulpit</a></li>
                <li class="breadcrumb-item "> Walidatorzy</li>
                <li class="breadcrumb-item active">Aktywne weryfikacje</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <!-- Left side columns -->
            <div class="col-lg-12">
                <div class="row">

                    <!-- Sales Card -->

<div class="col-lg-12">
    <div class="card">
        <div class="card-body">


            <!-- Default Table -->
            <form action="index.php/validators/delete" method="POST">

                <?php if ((null !== ($_smarty_tpl->getValue('formalVerificationList') ?? null))) {?>
                    <h5 class="card-title">Aktywne weryfikacje formalne dla tego walidatora</h5>
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
                            <tr>
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
">Usuń</button>
                                    <input type="hidden" name="validator_delete" value="<?php echo $_smarty_tpl->getValue('veryfication')['id'];?>
">
                                </td>
                                <td>

                                    <select class="form-control choices-single">
                                        <option value=>Nowy walidatora</option>
                                        <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('listValidators'), 'validator');
$foreach1DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('validator')->value) {
$foreach1DoElse = false;
?>
                                            <option value="<?php echo $_smarty_tpl->getValue('validator')['id'];?>
"><?php echo $_smarty_tpl->getValue('validator')['nazwa'];?>
</option>
                                        <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
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
$foreach2DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('veryfication')->value) {
$foreach2DoElse = false;
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
                                    <input type="hidden" name="validator_delete" value="<?php echo $_smarty_tpl->getValue('veryfication')['guid'];?>
">
                                </td>
                                <td>

                                    <select class="form-control choices-single">
                                        <option value=>Nowy walidatora</option>
                                        <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('listValidators'), 'validator');
$foreach3DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('validator')->value) {
$foreach3DoElse = false;
?>
                                            <option value="<?php echo $_smarty_tpl->getValue('validator')['id'];?>
"><?php echo $_smarty_tpl->getValue('validator')['nazwa'];?>
</option>
                                        <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
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




                </div>
            </div><!-- End Left side columns -->

            <!-- Right side columns -->
            <div class="col-lg-4">

                <!-- Recent Activity -->

                <!-- End Recent Activity -->



                <!-- Website Traffic -->

                <!-- End Website Traffic -->
                <!-- News & Updates Traffic  -->


                <!-- End News & Updates -->

            </div><!-- End Right side columns -->

        </div>
    </section>

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
