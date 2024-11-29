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
<script>
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

   function nowyWalidator(e,name)
    {

        let id = e.value;


        let input = document.createElement("input");

        input.setAttribute("type", "hidden");

        input.setAttribute("name", name);

        input.setAttribute("value", id);

//append to form element that you want .
       document.getElementById("atrybuty").appendChild(input);
        document.getElementById('form').submit();

    }
</script>
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
                <li class="breadcrumb-item"><a href="index.php">Walidatorzy</a></li>
                <li class="breadcrumb-item active">Usuwanie - aktywne walidacje</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">

                {if isset($komunikat)}
                    <h5 class="card-title"></h5>
                    <div class="alert alert-success" role="alert" id="komunikat">
                        {$komunikat}
                        {if isset($return)}
                            <br/>
                            Za chwilę zostanie załadowana poprzednia strona
                            <input type="hidden" id="return" >
                        {/if}

                    </div>
                {/if}



                <!-- Default Table -->
                <form action="index.php" method="POST" id="form">

                    {if isset($formalVerificationList)}
                        <h5 class="card-title">Aktywne weryfikacje formalne dla <Strong>{$deleteValidatorName}</Strong></h5>
                        {if isset($transactionVerificationList)}
                            <div class="alert alert-warning" role="alert">
                                Przed usunięciem Weryfikacji formalnej usuń weryfikacje transakcyjne powiązane z tym walidatorem
                            </div>
                        {/if}
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
                                <tr >
                                    <th scope="row">{$counter++}</th>
                                    <td>{$veryfication['nazwa']}</td>
                                    <td>{$veryfication['nip']}</td>
                                    <td>{$veryfication['zglaszajacy']}</td>
                                    <td>{$veryfication['ocena_wiarygodnosci']}</td>
                                    <td id="atrybuty">
                                        <button type="submit" class="btn btn-danger" name="delete_verification_formal" value="{$veryfication['id']}" {if isset($transactionVerificationList)}disabled{/if}>Usuń</button>
                                        <input type="hidden" name="validator_delete" value="{$deleteValidatorName}">
                                        <input type="hidden" name="change_verification_formal" value="{$veryfication['guid']}">

                                    </td>
                                    <td>
                                        <select class="form-control choices-single" onchange="nowyWalidator(this,'new_validator_verification_formal')" >
                                            {html_options  options=$listValidators selected=$mySelect}
                                        </select>
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
                                    <td id="atrybuty">
                                        <button type="submit" class="btn btn-danger" name="delete_verification_transaction" value="{$veryfication['guid']}">Usuń</button>
                                        <input type="hidden" name="validator_delete" value="{$deleteValidatorName}">
                                        <input type="hidden" name="change_verification_transaction" value="{$veryfication['guid']}">                                    </td>
                                    <td>

                                        <select class="form-control choices-single" onchange="nowyWalidator(this,'new_validator_verification_transaction')">
                                            {html_options  options=$listValidators selected=$mySelect}
                                        </select>
                                       {* <select class="form-control choices-single" *}{*onchange="this.form.submit()" *}{*name="new_validator_verification_transaction">
                                            <option value="TEST">Nowy walidatora</option>
                                            {foreach from=$listValidators item=validator}
                                                <option value="{$validator['id']}" >{$validator['nazwa']}</option>
                                            {/foreach}
                                        </select>
                                        <button type="submit">Zapisz</button>*}
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