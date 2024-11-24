<!DOCTYPE html>
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
{include file="header.tpl"}
<!-- End Header -->

<!-- ======= Sidebar ======= -->
{include file="sidebar.tpl"}
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
            <form action="index.php" method="POST">

                {if isset($formalVerificationList)}
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
                        {assign var=counter value=1}
                        {foreach from=$formalVerificationList item=veryfication}
                            <tr>
                                <th scope="row">{$counter++}</th>
                                <td>{$veryfication['nazwa']}</td>
                                <td>{$veryfication['nip']}</td>
                                <td>{$veryfication['zglaszajacy']}</td>
                                <td>{$veryfication['ocena_wiarygodnosci']}</td>
                                <td>
                                    <button type="submit" class="btn btn-danger" name="delete_verification_formal">Usuń</button>
                                    <input type="hidden" name="validator_delete" value="{$veryfication['id']}">
                                </td>
                                <td>

                                    <select class="form-control choices-single">
                                        <option value=>Nowy walidatora</option>
                                        {foreach from=$listValidators item=validator}
                                            <option value="{$validator['id']}">{$validator['nazwa']}</option>
                                        {/foreach}
                                    </select>
                                    {*<div class="dropdown">
                                        <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            Zmień
                                        </button>
                                        <ul class="dropdown-menu">
                                            {foreach from=$listValidators item=validator}
                                                <li><a class="dropdown-item" href="#">{$validator['nazwa']}</a></li>
                                            {/foreach}
                                        </ul>
                                    </div>*}

                                </td>
                            </tr>

                        {/foreach}


                        </tbody>
                    </table>
                {/if}

                {if isset($transactionVerificationList)}
                    <h5 class="card-title">Aktywne weryfikacje transakcyjne dla <strong>{$deleteValidatorName}</strong></h5>
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
                        {assign var=counter value=1}
                        {foreach from=$transactionVerificationList item=veryfication}
                            <tr>
                                <th scope="row">{$counter++}</th>
                                <td>{$veryfication['nazwa']}</td>
                                <td>{$veryfication['nip']}</td>
                                <td>{$veryfication['zglaszajacy']}</td>
                                <td>{$veryfication['wynik_weryfikacji']}</td>
                                <td>
                                    <button type="submit" class="btn btn-danger" name="delete_verification_formal">Usuń</button>
                                    <input type="hidden" name="validator_delete" value="{$veryfication['guid']}">
                                </td>
                                <td>

                                    <select class="form-control choices-single">
                                        <option value=>Nowy walidatora</option>
                                        {foreach from=$listValidators item=validator}
                                            <option value="{$validator['id']}">{$validator['nazwa']}</option>
                                        {/foreach}
                                    </select>
                                    {*<div class="dropdown">
                                        <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            Zmień
                                        </button>
                                        <ul class="dropdown-menu">
                                            {foreach from=$listValidators item=validator}
                                                <li><a class="dropdown-item" href="#">{$validator['nazwa']}</a></li>
                                            {/foreach}
                                        </ul>
                                    </div>*}

                                </td>
                            </tr>

                        {/foreach}


                        </tbody>
                    </table>
                {/if}
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
{include file="footer.tpl"}
<!-- End Footer -->

<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<!-- Vendor JS Files -->
<script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/vendor/chart.js/chart.umd.js"></script>
<script src="assets/vendor/echarts/echarts.min.js"></script>
<script src="assets/vendor/quill/quill.js"></script>
<script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
<script src="assets/vendor/tinymce/tinymce.min.js"></script>
<script src="assets/vendor/php-email-form/validate.js"></script>

<!-- Template Main JS File -->
<script src="assets/js/main.js"></script>

</body>

</html>