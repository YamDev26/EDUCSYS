<div class="sidenav-menu">

    <!-- Brand Logo -->
    <a href="{{ route('dashboard') }}" class="logo pt-2">
        <strong class="mt-2"  style="font-size: 19px;">
            CENTRE <span style="color: rgb(255, 244, 41); font-weight: bold;">THALITH</span>
        </strong>
    </a>

    <!-- Sidebar Hover Menu Toggle Button -->
    <button class="button-sm-hover">
        <i class="ri-circle-line align-middle"></i>
    </button>

    <!-- Full Sidebar Menu Close Button -->
    <button class="button-close-fullsidebar">
        <i class="ti ti-x align-middle"></i>
    </button>

    <div data-simplebar>

        <!--- Sidenav Menu -->
        <ul class="side-nav">
            <li class="side-nav-title" style="display: none">Menu</li>

            <li class="side-nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <a href="{{ route('dashboard') }}" class="side-nav-link">
                    <span class="menu-icon"><i class="ri-dashboard-horizontal-fill"></i></span>
                    <span class="menu-text"> Dashboard </span>
                </a>
            </li>

            {{-- <li class="side-nav-item">
                <a href="apps-chat.html" class="side-nav-link">
                    <span class="menu-icon"><i class="ti ti-message"></i></span>
                    <span class="menu-text"> Chat </span>
                </a>
            </li> --}}

            <li class="side-nav-item {{ request()->is('payement/*') ? 'active' : '' }}">
                <a href="{{ route('payement.index') }}" class="side-nav-link">
                    <span class="menu-icon"><i class="ti ti-icons"></i></span>
                    <span class="menu-text">Payement</span>
                </a>
            </li>

            <li class="side-nav-item {{ request()->is('student/*') ? 'active' : '' }}">
                <a href="{{ route('student.index') }}" class="side-nav-link">
                    <span class="menu-icon"><i class="ti ti-school"></i></span>
                    <span class="menu-text">Students</span>
                </a>
            </li>

            {{-- <li class="side-nav-item">
                <a href="apps-calendar.html" class="side-nav-link">
                    <span class="menu-icon"><i class="ti ti-calendar"></i></span>
                    <span class="menu-text"> Calendar </span>
                </a>
            </li> --}}

            <li class="side-nav-item {{ request()->is('parametre/*') ? 'active' : '' }}">
                <a href="{{ route('tarif.index') }}" class="side-nav-link">
                    <span class="menu-icon"><i class="ti ti-mailbox"></i></span>
                    <span class="menu-text">Parametres</span>
                </a>
            </li>

            {{-- <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarInvoice" aria-expanded="false" aria-controls="sidebarInvoice" class="side-nav-link">
                    <span class="menu-icon"><i class="ti ti-invoice"></i></span>
                    <span class="menu-text"> Invoice</span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarInvoice">
                    <ul class="sub-menu">
                        <li class="side-nav-item">
                            <a href="apps-invoices.html" class="side-nav-link">
                                <span class="menu-text">Invoices</span>
                            </a>
                        </li>
                        <li class="side-nav-item">
                            <a href="apps-invoice-details.html" class="side-nav-link">
                                <span class="menu-text">View Invoice</span>
                            </a>
                        </li>
                        <li class="side-nav-item">
                            <a href="apps-invoice-create.html" class="side-nav-link">
                                <span class="menu-text">Create Invoice</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li> --}}
        </ul>
    </div>
</div>