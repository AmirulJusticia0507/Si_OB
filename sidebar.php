<?php
// sidebar.php

function isPageActive($pageName) {
    // Dapatkan userid dan user_role dari sesi atau dari database sesuai dengan implementasi Anda
    $currentUserid = $_SESSION["userid"]; // Sesuaikan dengan variabel sesi Anda
    $currentUserRole = $_SESSION["user_role"]; // Sesuaikan dengan variabel sesi Anda

    // Tentukan halaman mana yang dapat diakses oleh setiap peran
    $allowedPages = [];
    if ($currentUserRole === 'Superadmin') {
        $allowedPages = ['dashboard', 'allstaff', 'alltaskdescription', 'settingarea', 'settingdetailsarea', 'lantai_1', 'lantai_2'];
    } elseif ($currentUserRole === 'Staff') {
        $allowedPages = ['dashboard', 'lantai_1', 'lantai_2'];
    }

    if (isset($_GET['page']) && in_array($_GET['page'], $allowedPages)) {
        return 'active';
    }

    return '';
}
?>

<style>
    /* CSS untuk spinner */
.page-spinner {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(255, 255, 255, 0.8);
    display: none;
    justify-content: center;
    align-items: center;
    z-index: 9999;
}

.spinner {
    border: 4px solid rgba(0, 0, 0, 0.3);
    border-radius: 50%;
    border-top: 4px solid #007bff; /* Warna utama */
    width: 40px;
    height: 40px;
    animation: spin 2s linear infinite;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}
</style>
    <style>
        .myButton {
            box-shadow: 3px 4px 0px 0px #899599;
            background:linear-gradient(to bottom, #ededed 5%, #bab1ba 100%);
            background-color:#ededed;
            border-radius:15px;
            border:1px solid #d6bcd6;
            display:inline-block;
            cursor:pointer;
            color:#3a8a9e;
            font-family:Arial;
            font-size:17px;
            padding:7px 25px;
            text-decoration:none;
            text-shadow:0px 1px 0px #e1e2ed;
        }
        .myButton:hover {
            background:linear-gradient(to bottom, #bab1ba 5%, #ededed 100%);
            background-color:#bab1ba;
        }
        .myButton:active {
            position:relative;
            top:1px;
        }
    </style>
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Tambahkan konten sidebar AdminLTE di sini -->
        <a href="dashboard.php" class="brand-link">
            <span class="brand-text font-weight-light">Si OB BPRS <img src="img/logo_white.png" alt="" style="width:80px;"></span>
        </a>
        <div class="sidebar">
            <ul class="nav nav-pills nav-sidebar flex-column nowrap" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="dashboard.php?page=dashboard" class="nav-link <?php echo isPageActive('dashboard'); ?>">
                        <i class="fa fa-tachometer-alt nav-icon"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link <?php echo isPageActive(['allstaff', 'alltaskdescription', 'settingarea','settingdetailsarea']); ?>">
                        <i class="fa fa-cogs nav-icon"></i>
                        <p>Settings</p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="allstaff.php?page=allstaff" class="nav-link <?php echo isPageActive('allstaff'); ?>">
                                <i class="fa fa-users nav-icon"></i>
                                <p>Setting Staff</p>
                            </a>
                        </li>
                        <!-- <li class="nav-item">
                            <a href="alltask.php?page=alltask" class="nav-link <?php echo isPageActive('alltask'); ?>">
                                <i class="fa fa-tasks nav-icon"></i>
                                <p>setting Tasks</p>
                            </a>
                        </li> -->
                        <li class="nav-item">
                            <a href="settingarea.php?page=settingarea" class="nav-link <?php echo isPageActive('settingarea'); ?>">
                                <i class="fa fa-tasks nav-icon"></i>
                                <p>setting Area</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="settingdetailsarea.php?page=settingdetailsarea" class="nav-link <?php echo isPageActive('settingdetailsarea'); ?>">
                                <i class="fa fa-tasks nav-icon"></i>
                                <p>setting Details Area</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="alltaskdescription.php?page=alltaskdescription" class="nav-link <?php echo isPageActive('alltaskdescription'); ?>">
                                <i class="fa fa-list nav-icon"></i>
                                <p>Setting Tasks</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <!-- <li class="nav-item">
                    <a href="laporankinerja.php?page=laporankinerja" class="nav-link <?php echo isPageActive('laporankinerja'); ?>">
                        <i class="fa fa-file nav-icon"></i>
                        <p>Laporan Kinerja</p>
                    </a>
                </li> -->
                <li class="nav-item">
                    <a href="lantai_1.php?page=lantai_1" class="nav-link <?php echo isPageActive('lantai_1'); ?>">
                        <i class="fas fa-home nav-icon"></i>
                        <p>Lantai 1</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="lantai_2.php?page=lantai_2" class="nav-link <?php echo isPageActive('lantai_2'); ?>">
                        <i class="fas fa-home nav-icon"></i>
                        <p>Lantai 2</p>
                    </a>
                </li>
                <!-- <li class="nav-item">
                    <a href="Area_Parkir.php?page=Area_Parkir" class="nav-link <?php echo isPageActive('Area_Parkir'); ?>">
                        <i class="fas fa-parking nav-icon"></i>
                        <p>Area Parkir</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="ruangdireksi.php?page=ruangdireksi" class="nav-link <?php echo isPageActive('ruangdireksi'); ?>">
                        <i class="fa fa-users nav-icon"></i>
                        <p>Ruang Direksi</p>
                    </a>
                </li> -->
                <li class="nav-item">
                    <a href="#" class="nav-link logout-link">
                        <i class="fas fa-sign-out-alt nav-icon"></i>
                        <p>Logout</p>
                    </a>
                </li>
            </ul>
        </div>
    </aside>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- Skrip JavaScript untuk mengontrol pushmenu -->
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const body = document.querySelector("body");
        const pageSpinner = document.getElementById("page-spinner");

        // Function to toggle the sidebar
        const toggleSidebar = () => {
            body.classList.toggle("sidebar-collapse");
            body.classList.toggle("sidebar-open");
        };

        // Add event listener to the sidebar button
        const sidebarButton = document.querySelector(".nav-link[data-widget='pushmenu']");
        sidebarButton.addEventListener("click", function (e) {
            e.preventDefault();
            toggleSidebar();
        });

        // Add event listener to the caret-down icons for submenu
        const submenuToggles = document.querySelectorAll(".nav-item.has-treeview > .nav-link > .fas.fa-caret-down");
        submenuToggles.forEach((toggle) => {
            toggle.addEventListener("click", function (e) {
                e.preventDefault();
                const parent = toggle.parentElement.parentElement;
                parent.classList.toggle("menu-open");
            });
        });

        // Fungsi untuk menampilkan spinner
        function showSpinner() {
            pageSpinner.style.display = "flex";
        }

        // Fungsi untuk menyembunyikan spinner
        function hideSpinner() {
            pageSpinner.style.display = "none";
        }

        // Tambahkan event listener ke setiap tautan navigasi yang akan menampilkan spinner
        const navLinks = document.querySelectorAll(".nav-link");
        navLinks.forEach(function (link) {
            link.addEventListener("click", function () {
                showSpinner();
            });
        });

        // Sembunyikan spinner saat halaman baru dimuat
        window.addEventListener("load", function () {
            hideSpinner();
        });
    });
</script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
    // Fungsi untuk menampilkan SweetAlert konfirmasi logout
    function confirmLogout() {
        Swal.fire({
            title: 'Konfirmasi Logout',
            text: 'Anda yakin ingin logout?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya',
            cancelButtonText: 'Tidak',
        }).then((result) => {
            if (result.isConfirmed) {
                // Redirect ke halaman logout.php jika pengguna menekan "Ya"
                window.location.href = "logout.php";
            }
        });
    }

    // Tambahkan event listener ke tautan "Logout"
    const logoutLink = document.querySelector(".logout-link");
    logoutLink.addEventListener("click", function (e) {
        e.preventDefault();
        confirmLogout();
    });
});
</script>