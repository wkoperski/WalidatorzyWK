<?php
/* Smarty version 5.4.1, created on 2024-11-28 22:21:37
  from 'file:index.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.4.1',
  'unifunc' => 'content_6748ecf168b458_39488709',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '94ad261647aa7bfeb6835379e098cb3d84cfcba3' => 
    array (
      0 => 'index.tpl',
      1 => 1732831843,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:header.tpl' => 1,
    'file:sidebar.tpl' => 1,
    'file:test.tpl' => 1,
    'file:footer.tpl' => 1,
  ),
))) {
function content_6748ecf168b458_39488709 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = '/var/www/html/templates';
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
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active">Pulpit - Walidatorzy</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">
            <!-- Left side columns -->
            <div class="col-lg-8">
                <div class="row">

                    <!-- Sales Card -->
                    <div class="col-xxl-4 col-md-6">
                        <div class="card info-card sales-card">

                            <div class="card-body">
                                <h5 class="card-title">BEZ FORMALNEJ - 30 dni</span></h5>

                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-cart"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>145</h6>


                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="col-xxl-4 col-md-6">
                        <div class="card info-card sales-card">

                            <div class="card-body">
                                <h5 class="card-title">BEZ TRANSAKCYJNEJ - 30 dni</span></h5>

                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-cart"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>145</h6>


                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                   <!-- End Sales Card -->

                    <!-- Revenue Card -->
                   <!-- End Revenue Card -->

                    <!-- Customers Card -->
                   <!-- End Customers Card -->
                    <?php if ((null !== ($_smarty_tpl->getValue('formalVerificationList') ?? null))) {?>
                        <?php $_smarty_tpl->renderSubTemplate("file:test.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
?>


                        <?php } else { ?>
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Lista wszystkich walidatorów </h5>

                                    <!-- Default Table -->
                                    <form action="index.php" method="POST">

                                        <table class="table">
                                            <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Nazwa</th>
                                                <th scope="col">Email</th>
                                                <th scope="col">Aktywny</th>
                                                <th scope="col">Aktywuj / Dezaktywuj</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php $_smarty_tpl->assign('counter', 1, false, NULL);?>
                                            <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('walidatorzy'), 'walidator');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('walidator')->value) {
$foreach0DoElse = false;
?>

                                                <tr>
                                                    <th scope="row"><?php echo $_smarty_tpl->getVariable('counter')->postIncDec('++');?>
</th>
                                                    <td><?php echo $_smarty_tpl->getValue('walidator')['nazwa'];?>
</td>
                                                    <td><?php echo $_smarty_tpl->getValue('walidator')['email'];?>
</td>
                                                    <td>
                                                        <?php if ($_smarty_tpl->getValue('walidator')['aktywny'] == 1) {?>
                                                            TAK
                                                        <?php } else { ?>
                                                            NIE
                                                        <?php }?>
                                                    </td>
                                                    <td>
                                                        <?php if ($_smarty_tpl->getValue('walidator')['aktywny'] == 1) {?>

                                                            <button type="submit" class="btn btn-danger" name="validator_delete" value="<?php echo $_smarty_tpl->getValue('walidator')['nazwa'];?>
">Dezaktywuj</button>


                                                        <?php }?>
                                                        <?php if ($_smarty_tpl->getValue('walidator')['aktywny'] == 0) {?>
                                                            <button type="submit" class="btn btn-success" name="validator_enabled" value="<?php echo $_smarty_tpl->getValue('walidator')['nazwa'];?>
">Aktywuj</button>
                                                        <?php }?>

                                                    </td>
                                                </tr>

                                            <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>


                                            </tbody>
                                        </table>
                                    </form>
                                    <!-- End Default Table Example -->
                                </div>
                            </div>
                        </div>

                        <!-- Lista walidacji -->
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Statystyki Walidatorów - Weryfikacja formalna</h5>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" onclick="filter()">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            Pokaź tylko w akceptacji
                                        </label>
                                    </div>
                                    <!-- Bordered Table -->
                                    <table class="table table-bordered">
                                        <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Nazwa</th>
                                            <th scope="col">W AKCEPTACJI</th>
                                            <th scope="col">ZAAKCEPTOWANYCH</th>
                                            <th scope="col">ODRZUCONYCH</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php $_smarty_tpl->assign('counter', 1, false, NULL);?>
                                        <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('StatisticsFormal'), 'row');
$foreach1DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('row')->value) {
$foreach1DoElse = false;
?>
                                            <tr <?php if ($_smarty_tpl->getValue('row')['w_akceptacji'] > 0) {?> class="table-warning" <?php }?>>
                                                <th scope="row"><?php echo $_smarty_tpl->getVariable('counter')->postIncDec('++');?>
</th>
                                                <td><?php echo $_smarty_tpl->getValue('row')['walidator'];?>
</td>
                                                <td><?php echo $_smarty_tpl->getValue('row')['w_akceptacji'];?>
</td>
                                                <td><?php echo $_smarty_tpl->getValue('row')['akceptacja'];?>
</td>
                                                <td><?php echo $_smarty_tpl->getValue('row')['odrzucona'];?>
</td>
                                            </tr>
                                        <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>


                                        </tbody>
                                    </table>
                                    <!-- End Bordered Table -->


                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Statystyki Walidatorów - Weryfikacja Transakcyjna</h5>

                                    <!-- Bordered Table -->
                                    <table class="table table-bordered">
                                        <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Nazwa</th>
                                            <th scope="col">W AKCEPTACJI</th>
                                            <th scope="col">ZAAKCEPTOWANYCH</th>
                                            <th scope="col">ODRZUCONYCH</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php $_smarty_tpl->assign('counter', 1, false, NULL);?>
                                        <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('StatisticsTransaction'), 'row');
$foreach2DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('row')->value) {
$foreach2DoElse = false;
?>
                                            <tr <?php if ($_smarty_tpl->getValue('row')['w_akceptacji'] > 0) {?> class="table-warning" <?php }?>>
                                                <th scope="row"><?php echo $_smarty_tpl->getVariable('counter')->postIncDec('++');?>
</th>
                                                <td><?php echo $_smarty_tpl->getValue('row')['walidator'];?>
</td>
                                                <td><?php echo $_smarty_tpl->getValue('row')['w_akceptacji'];?>
</td>
                                                <td><?php echo $_smarty_tpl->getValue('row')['akceptacja'];?>
</td>
                                                <td><?php echo $_smarty_tpl->getValue('row')['odrzucona'];?>
</td>
                                            </tr>
                                        <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
                                        </tbody>
                                    </table>
                                    <!-- End Bordered Table -->


                                </div>
                            </div>
                        </div>
                        <!-- END Lista Walidacji -->
                        <!-- Reports -->

                        <!-- End Reports -->

                    <?php }?>



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
