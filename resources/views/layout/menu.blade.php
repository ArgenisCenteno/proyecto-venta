<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark"> <!--begin::Sidebar Brand-->
    <div class="sidebar-brand"> <!--begin::Brand Link--> <a href="{{route('home')}}" class="brand-link">
            <!--begin::Brand Image-->  <!--end::Brand Image--> <!--begin::Brand Text--> <span
                class="brand-text fw-light">Multiservicios Reinoso</span> <!--end::Brand Text--> </a> <!--end::Brand Link--> </div>
    <!--end::Sidebar Brand--> <!--begin::Sidebar Wrapper-->  
    <div class="sidebar-wrapper">
        <nav class="mt-2"> <!--begin::Sidebar Menu-->
            <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu" data-accordion="false">
                <li class="nav-item "> <a href="#" class="nav-link ">
                <i class="fa-solid shopping-cart"></i>
                        <p>
                            Clasificadores / Monedas
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item"> <a href={{route('categorias.index')}} class="nav-link ">
                        <i
                        class="nav-icon bi bi-circle"></i>
                                <p>Categorías</p>
                            </a> </li>
                        <li class="nav-item"> <a href={{route('subcategorias.index')}} class="nav-link ">
                        <i
                        class="nav-icon bi bi-circle"></i>
                                <p>Subcategorías</p>
                            </a> </li>

                       
                    </ul>
                </li>
                <li class="nav-item"> <a href="#" class="nav-link">  
                        <p>
                        <i class="fa-solid fa-warehouse"></i>
                            Inventario
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item"> <a href="{{route('almacen')}}" class="nav-link"> <i
                                    class="nav-icon bi bi-circle"></i>
                                <p>Productos</p>
                            </a> </li>
                        {{-- <li class="nav-item"> <a href="./widgets/info-box.html" class="nav-link"> <i
                                    class="nav-icon bi bi-circle"></i>
                                <p>info Box</p>
                            </a> </li>
                        <li class="nav-item"> <a href="./widgets/cards.html" class="nav-link"> <i
                                    class="nav-icon bi bi-circle"></i>
                                <p>Cards</p>
                            </a> </li> --}}
                    </ul>
                </li>
                <li class="nav-item"> <a href="#" class="nav-link">  
                        <p>
                            Ventas
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item"> <a href={{route('ventas.vender')}} class="nav-link"> <i
                                    class="nav-icon bi bi-circle"></i>
                                <p>Generar Venta</p>
                            </a> </li>
                        <li class="nav-item"> <a href={{route('ventas.index')}} class="nav-link"> <i
                                    class="nav-icon bi bi-circle"></i>
                                <p>Ventas</p>
                            </a> </li>


                    </ul>
                </li>
                <li class="nav-item"> <a href="#" class="nav-link">  
                        <p>
                            Compras
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item"> <a href={{route('compras.comprar')}} class="nav-link"> <i
                                    class="nav-icon bi bi-circle"></i>
                                <p>Generar Compra</p>
                            </a> </li>
                        <li class="nav-item"> <a href={{route('compras.index')}} class="nav-link"> <i
                                    class="nav-icon bi bi-circle"></i>
                                <p>Compras</p>
                            </a> </li>
                    </ul>
                </li>
             {{--    <li class="nav-item"> <a href="#" class="nav-link"> <i class="nav-icon bi bi-pencil-square"></i>
                        <p>
                            Caja
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                   <ul class="nav nav-treeview">
                        <li class="nav-item"> <a href="{{route('cajas.index')}}" class="nav-link"> <i
                                    class="nav-icon bi bi-circle"></i>
                                <p>Cajas</p>
                            </a> </li>
                    </ul>
                </li> --}}
                <li class="nav-item"> <a href="#" class="nav-link"> 
                        <p>
                            Proveedores
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item"> <a href="{{route('proveedores.index')}}" class="nav-link"> <i
                                    class="nav-icon bi bi-circle"></i>
                                <p>Proveedores</p>
                            </a> </li>
                    </ul>
                </li>


              {{--  <li class="nav-item"> <a  href="{{route('pagos.index')}}" class="nav-link">  
                        <p>Pagos</p>
                    </a> </li> --}}
                <li class="nav-item"> <a href="{{route('usuarios.index')}}" class="nav-link">  
                        <p>Usuarios</p>
                    </a> </li>
             
              



            </ul> <!--end::Sidebar Menu-->
        </nav>
    </div> <!--end::Sidebar Wrapper-->
</aside> <!--end::Sidebar--> <!--begin::App Main-->