<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">
        <li class="nav-item">
            <a class="nav-link " href="index.php">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li><!-- End Dashboard Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
                <i class="ri ri-account-box-line"></i><span>Walidatorzy</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="components-nav" class="nav-content collapse {if $show_walidatorzy_nav}show{/if}" data-bs-parent="#sidebar-nav">
                <li>
                    <a href="index.php?walidatorzy_statystyki" {if $show_walidatorzy_statystyki}class="active"{/if}>
                        <i class="bi bi-circle"></i><span>Statystyki</span>
                    </a>
                </li>
                <li>
                    <a href="index.php?walidatorzy_lista" {if $show_walidatorzy_lista}class="active"{/if}>
                        <i class="bi bi-circle"></i><span>Aktywuj / Dezaktywuj</span>
                    </a>
                </li>
                <li>
                    <a href="index.php?dodaj_walidatora" {if $show_walidatorzy_add}class="active"{/if}>
                        <i class="bi bi-circle"></i><span>Dodaj</span>
                    </a>
                </li>

            </ul>
        </li>
        <!-- End Walidatorzy Nav -->

        <!-- Weryfikacje Formalne-->
        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#veryficationFormal-nav" data-bs-toggle="collapse" href="#">
                <i class="ri ri-account-box-line"></i><span>Weryfikacje Formalne</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="veryficationFormal-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="index.php?formalne_lista">
                        <i class="bi bi-circle"></i><span>Statystyki</span>
                    </a>
                </li>
                <li>
                    <a href="index.php?formalne_zarzadzaj">
                        <i class="bi bi-circle"></i><span>Zarządzaj</span>
                    </a>
                </li>

            </ul>
        </li>
        <!-- End Weryfikacje Formalne-->

        <!-- Weryfikacje Transakcyjne-->
        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#veryficationTransaction-nav" data-bs-toggle="collapse" href="#">
                <i class="ri ri-account-box-line"></i><span>Weryfikacje Transakcyjne</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="veryficationTransaction-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="index.php?transakcjne_lista">
                        <i class="bi bi-circle"></i><span>Statystyki</span>
                    </a>
                </li>
                <li>
                    <a href="index.php?transakcjne_zarzadzaj">
                        <i class="bi bi-circle"></i><span>Zarządzaj</span>
                    </a>
                </li>


            </ul>
        </li>
        <!-- End Weryfikacje Transakcyjne-->

        <!-- Wiarygodni -->
        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#reliably-nav" data-bs-toggle="collapse" href="#">
                <i class="ri ri-account-box-line"></i><span>Wiarygodni</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="reliably-nav" class="nav-content collapse {if $show_wiarygodni_nav}show{/if}" data-bs-parent="#sidebar-nav">
                <li>
                    <a href="index.php?wiarygodni_statystyki" {if $show_wiarygodni_statystyki}class="active"{/if}>
                        <i class="bi bi-circle"></i><span>Statystyki</span>
                    </a>
                </li>
                <li>
                    <a href="index.php?wiarygodni_lista" {if $show_wiarygodni_lista}class="active"{/if}">
                        <i class="bi bi-circle"></i><span>Zgłoszeni</span>
                    </a>
                </li>
                <li>
                    <a href="index.php?wiarygodni_dodaj" {if $show_wiarygodni_dodaj}class="active"{/if}>
                        <i class="bi bi-circle"></i><span>Dodawanie</span>
                    </a>
                </li>
                <li>
                    <a href="index.php?wiarygodni_usun" {if $show_wiarygodni_usun}class="active"{/if}>
                        <i class="bi bi-circle"></i><span>Usuwanie</span>
                    </a>
                </li>

            </ul>
        </li>
        <!-- End Wiarygodni -->

        <!-- WPR -->
       {* <li class="nav-item disabled" >
            <a class="nav-link collapsed" data-bs-target="#wpr-nav" data-bs-toggle="collapse" href="#">
                <i class="ri ri-account-box-line"></i><span>WPR</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="wpr-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="components-alerts.html">
                        <i class="bi bi-circle"></i><span>Statystyki</span>
                    </a>
                </li>
                <li>
                    <a href="components-accordion.html">
                        <i class="bi bi-circle"></i><span>Dodaj / Usuń</span>
                    </a>
                </li>
                </li>

            </ul>
        </li>*}
        <!-- End WPR -->

        <!-- Użytkownicy -->
        {*<li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#users-nav" data-bs-toggle="collapse" href="#">
                <i class="ri ri-account-box-line"></i><span>Użytkownicy</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="users-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="components-alerts.html">
                        <i class="bi bi-circle"></i><span>Statystyki</span>
                    </a>
                </li>
                <li>
                    <a href="components-alerts.html">
                        <i class="bi bi-circle"></i><span>Powiadomienia</span>
                    </a>
                </li>
            </ul>
        </li>*}
        <!-- End użytkownicy -->

        <!-- Raporty -->
        {*<li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#reports-nav" data-bs-toggle="collapse" href="#">
                <i class="ri ri-account-box-line"></i><span>Raporty</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="reports-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="components-alerts.html">
                        <i class="bi bi-circle"></i><span>?</span>
                    </a>
                </li>

            </ul>
        </li>*}
        <!-- End Raporty -->

        <!-- End Components Nav -->



        <li class="nav-heading">Strony</li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="index.php?profile">
                <i class="bi bi-person"></i>
                <span>Mój profil</span>
            </a>
        </li><!-- End Profile Page Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" href="index.php?faq">
                <i class="bi bi-question-circle"></i>
                <span>F.A.Q</span>
            </a>
        </li><!-- End F.A.Q Page Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" href="index.php?logout">
                <i class="bi bi-box-arrow-in-right"></i>
                <span>Wyloguj</span>
            </a>
        </li><!-- End Login Page Nav -->



    </ul>

</aside>