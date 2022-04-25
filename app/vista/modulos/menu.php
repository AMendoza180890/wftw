<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <ul class="sidebar-menu" data-widget="tree">
            <li>
                <a title="Inicio" href="inicio">
                    <i class="fa fa-home"></i>
                    <span>Inicio</span>
                </a>
            </li>
            <li>
                <a title="Lista de beneficiarios activos" href="catbeneficiario">
                    <i class="fa fa-user-o"></i>
                    <span>Beneficiarios Activos</span>
                </a>
            </li>
            <li>
                <a title="Lista de beneficiarios dados de baja" href="catbeneficiarioBaja">
                    <i class="fa fa-times-circle"></i>
                    <span>Beneficiarios Bajas</span>
                </a>
            </li>
            <li>
                <a title="Lista de beneficiarios que ya han sido atendidos" href="catbeneficiarioAtendido">
                    <i class="fa fa-check-circle-o"></i>
                    <span>Beneficiarios Atendidos</span>
                </a>
            </li>
            <?php
            if ($_SESSION["rol"] == "Administrador") {
                echo '<li>
                            <a title="Administracion de los Usuarios" href="catusuarios">
                                <i class="fa fa-user"></i>
                                <span>Usuarios</span>
                            </a>
                        </li>';
                        }
            ?>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>