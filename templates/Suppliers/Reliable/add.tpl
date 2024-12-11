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
<script>
    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
    const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
</script>
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
                <li class="breadcrumb-item active">Dodawanie/li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Operacje</h5>
                <form action="index.php?wiarygodni_lista" method="post">
                    <input type="hidden" name="csv" value="add">
                    <button type="submit" class="btn btn-primary" disabled>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-down" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M3.5 10a.5.5 0 0 1-.5-.5v-8a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 .5.5v8a.5.5 0 0 1-.5.5h-2a.5.5 0 0 0 0 1h2A1.5 1.5 0 0 0 14 9.5v-8A1.5 1.5 0 0 0 12.5 0h-9A1.5 1.5 0 0 0 2 1.5v8A1.5 1.5 0 0 0 3.5 11h2a.5.5 0 0 0 0-1z"></path>
                            <path fill-rule="evenodd" d="M7.646 15.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 14.293V5.5a.5.5 0 0 0-1 0v8.793l-2.146-2.147a.5.5 0 0 0-.708.708z"></path>
                        </svg>
                        Export WORD
                    </button>
                    <button type="submit" class="btn btn-success">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-down" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M3.5 10a.5.5 0 0 1-.5-.5v-8a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 .5.5v8a.5.5 0 0 1-.5.5h-2a.5.5 0 0 0 0 1h2A1.5 1.5 0 0 0 14 9.5v-8A1.5 1.5 0 0 0 12.5 0h-9A1.5 1.5 0 0 0 2 1.5v8A1.5 1.5 0 0 0 3.5 11h2a.5.5 0 0 0 0-1z"></path>
                            <path fill-rule="evenodd" d="M7.646 15.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 14.293V5.5a.5.5 0 0 0-1 0v8.793l-2.146-2.147a.5.5 0 0 0-.708.708z"></path>
                        </svg>
                        Dodaj do wiarygodnych
                    </button>
                </form>
            </div>

        </div>
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Wklej numery NIP do dodania do wiarygodnych</h5>
                    <form action="index.php?wiarygodni_dodaj" method="post">
                        <div class="row mb-3">

                            <div class="col-sm-10">
                                <textarea class="form-control" id="inputEmail3" rows="3" name="nip_lista"></textarea>
                            </div>
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-primary" name="zatwierdzeni_wiarygodni">Dodaj</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

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
                    <h5 class="card-title">Do zgłoszenia na zarząd</h5>

                    <!-- Horizontal Form -->
                    <form action="index.php?wiarygodni_lista" method="post">
                        <table class="table table-sm">
                            <thead>
                            <tr class="small">
                                <th scope="col">#</th>
                                <th scope="col">Nazwa</th>
                                <th scope="col">NIP</th>
                                <th scope="col">Ocena wiarygodności</th>

                            </tr>
                            </thead>
                            <tbody>
                            {assign var=counter value=1}
                            {foreach from=$wiarygodni_lista item=wiarygodny}

                                <tr {if isset($wiarygodny['checkBeoneCooperation']) &&  $wiarygodny['checkBeoneCooperation'] == false} class="table-danger" {/if}>
                                    <th scope="row">{$counter++}</th>
                                    <td><small>{$wiarygodny['nazwa']}<a href="index.php?weryfikacja_formalna?guid=xxx" target="_blank"> <i class="bi bi-arrow-up-right-circle"></i></a> </small></td>
                                    <td>{$wiarygodny['nip']}</td>
                                    <td><small>{$wiarygodny['ocena_wiarygodnosci']}</small></td>


                            {/foreach}


                            </tbody>
                        </table>
                        <!-- End Horizontal Form -->
                    </form>
                </div>
            </div>
           {* <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Zgłoszone na zarząd</h5>

                    <!-- Horizontal Form -->
                    <form action="index.php?wiarygodni_lista" method="post">
                        <table class="table table-sm">
                            <thead>
                            <tr class="small">
                                <th scope="col">#</th>
                                <th scope="col">Nazwa</th>
                                <th scope="col">NIP</th>
                                <th scope="col">Ocena wiarygodności</th>

                            </tr>
                            </thead>
                            <tbody>
                            {assign var=counter value=1}
                            {foreach from=$wiarygodni_lista item=wiarygodny}

                            <tr {if isset($wiarygodny['checkBeoneCooperation']) &&  $wiarygodny['checkBeoneCooperation'] == false} class="table-danger" {/if}>
                                <th scope="row">{$counter++}</th>
                                <td><small>{$wiarygodny['nazwa']}<a href="index.php?weryfikacja_formalna?guid=xxx" target="_blank"> <i class="bi bi-arrow-up-right-circle"></i></a> </small></td>
                                <td>{$wiarygodny['nip']}</td>
                                <td><small>{$wiarygodny['ocena_wiarygodnosci']}</small></td>


                                {/foreach}


                            </tbody>
                        </table>
                        <!-- End Horizontal Form -->
                    </form>
                </div>
            </div>*}
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