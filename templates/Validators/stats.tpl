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
        <h1>Walidatorzy-Statystyki</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item">Walidatorzy</li>
                <li class="breadcrumb-item active">Statystyki</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">
            <!-- Left side columns -->
            <div class="col-lg-12">
                <div class="row">
                    <!-- End Sales Card -->

                    <!-- Revenue Card -->
                    <!-- End Revenue Card -->

                    <!-- Customers Card -->
                    <!-- End Customers Card -->
                    <!-- Lista walidacji -->
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Weryfikacja formalna</h5>
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
                                    {assign var=counter value=1}
                                    {foreach from=$StatisticsFormal item=row}
                                        <tr {if $row['w_akceptacji'] >0} class="table-warning" {/if}>
                                            <th scope="row">{$counter++}</th>
                                            <td>{$row['walidator']}</td>
                                            <td>{$row['w_akceptacji']}</td>
                                            <td>{$row['akceptacja']}</td>
                                            <td>{$row['odrzucona']}</td>
                                        </tr>
                                    {/foreach}


                                    </tbody>
                                </table>
                                <!-- End Bordered Table -->


                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Weryfikacja Transakcyjna</h5>

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
                                    {assign var=counter value=1}
                                    {foreach from=$StatisticsTransaction item=row}
                                        <tr {if $row['w_akceptacji'] >0} class="table-warning" {/if}>
                                            <th scope="row">{$counter++}</th>
                                            <td>{$row['walidator']}</td>
                                            <td>{$row['w_akceptacji']}</td>
                                            <td>{$row['akceptacja']}</td>
                                            <td>{$row['odrzucona']}</td>
                                        </tr>
                                    {/foreach}
                                    </tbody>
                                </table>
                                <!-- End Bordered Table -->


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