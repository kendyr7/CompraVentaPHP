<!-- ========== App Menu ========== -->
<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <!-- Dark Logo-->
        <a href="index.html" class="logo logo-dark">
            <span class="logo-sm">
                <img src="../../assets/images/logo-sm.png" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="../../assets/images/logo-dark.png" alt="" height="17">
            </span>
        </a>
        <!-- Light Logo-->
        <a href="index.html" class="logo logo-light">
            <span class="logo-sm">
                <img src="../../assets/images/logo-sm.png" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="../../assets/images/logo-light.png" alt="" height="17">
            </span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover" id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <!-- MENU -->
    <div id="scrollbar">
        <div class="container-fluid">

            <div id="two-column-menu">
            </div>
            <ul class="navbar-nav" id="navbar-nav">
                <li class="menu-title"><span data-key="t-menu">Menu</span></li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="../home/">
                        <i class="ri-dashboard-2-line"></i> <span data-key="t-dashboards">Dashboard</span>
                    </a>
                </li>

                <li class="menu-title"><i class="ri-more-fill"></i> <span data-key="t-pages">ADMINISTRAR</span></li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarAuth" data-bs-toggle="collapse">
                        <i class="ri-account-circle-line"></i> <span data-key="t-authentication">Mantenimiento</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarAuth">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="../MntCategoria/" class="nav-link" role="button"> Mnt Categoria</a>
                            </li>

                            <li class="nav-item">
                                <a href="../MntProducto/" class="nav-link" role="button"> Mnt Productos</a>
                            </li>

                            <li class="nav-item">
                                <a href="../MntCliente/" class="nav-link" role="button"> Mnt Cliente</a>
                            </li>

                            <li class="nav-item">
                                <a href="../MntProveedor/" class="nav-link" role="button"> Mnt Proveedor</a>
                            </li>

                            <li class="nav-item">
                                <a href="../MntMoneda/" class="nav-link" role="button"> Mnt Moneda</a>
                            </li>

                            <li class="nav-item">
                                <a href="../MntUndMedida/" class="nav-link" role="button"> Mnt UndMedida</a>
                            </li>

                            <li class="nav-item">
                                <a href="../MntEmpresa/" class="nav-link" role="button"> Mnt Empresa</a>
                            </li>

                            <li class="nav-item">
                                <a href="../MntSucursal/" class="nav-link" role="button"> Mnt Sucursal</a>
                            </li>
                        </ul>

                    </div>
                </li>

                <li class="menu-title"><i class="ri-more-fill"></i> <span data-key="t-pages">COMPRA</span></li>
                <li class="menu-title"><i class="ri-more-fill"></i> <span data-key="t-pages">VENTA</span></li>
            </ul>
        </div>
        <!-- Sidebar -->
    </div>

    <div class="sidebar-background"></div>
</div>

<!-- Left Sidebar End -->
<!-- Vertical Overlay-->
<div class="vertical-overlay"></div>