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
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item"><a href="index.php?walidatorzy_lista">Wiarygodni</a></li>
                <li class="breadcrumb-item active">Zgłoszeni do wiarygodnych</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <div class="col-lg-12">
        <div class="card">
            {if isset($komunikat)}
                <div class="card-body">
                    <h5 class="card-title"></h5>
                    <div class="alert alert-{if isset($alert_type)}{$alert_type}{else}success{/if}" role="alert" id="komunikat">
                        {$komunikat}
                        {if isset($return)}
                            <br/>
                            Za chwilę zostanie załadowana poprzednia strona
                            <input type="hidden" id="return" >
                        {/if}
                    </div>
                </div>
            {/if}
        </div>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Zgłoszeni do wiarygodnych</h5>

                <!-- Horizontal Form -->
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nazwa</th>
                        <th scope="col">NIP</th>
                        <th scope="col">Ocena wiarygodności</th>
                        <th scope="col">BeOne</th>
                        <th scope="col">Był już na liście wiarygodnych</th>
                    </tr>
                    </thead>
                    <tbody>
                    {assign var=counter value=1}
                    {foreach from=$wiarygodni_lista item=wiarygodny}

                        <tr>
                            <th scope="row">{$counter++}</th>
                            <td>{$wiarygodny['nazwa']}</td>
                            <td>{$wiarygodny['nip']}</td>
                            <td>{$wiarygodny['ocena_wiarygodnosci']}</td>
                            <td>
                                {if isset($wiarygodny['Beone2']->firstInvoice)}
                                    {$wiarygodny['Beone2']->firstInvoice}
                                {/if}

                            </td>
                            <td>
                                {if $wiarygodny['Beone'] == '1' || $wiarygodny['Beone'] == 1}
                                    <span class="badge bg-success">TAK</span>
                                {else}
                                    <span class="badge bg-info">NIE</span>
                                {/if}
                            </td>
                        </tr>

                    {/foreach}


                    </tbody>
                </table>
                <!-- End Horizontal Form -->

            </div>
        </div>
    </div>


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