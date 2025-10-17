<div class="app-header d-flex align-items-center">

    <!-- Container starts -->
    <div class="container">

    <!-- Row starts -->
    <div class="row gx-3">
        <div class="col-md-3 col-2">

        <!-- App brand starts -->
        <div class="app-brand">
            <a href="index.html" class="d-lg-block d-none">
            <img src="assets/images/logo.svg" class="logo" alt="Bootstrap Gallery" />
            </a>
            <a href="index.html" class="d-lg-none d-md-block">
            <img src="assets/images/logo-sm.svg" class="logo" alt="Bootstrap Gallery" />
            </a>
        </div>
        <!-- App brand ends -->

        </div>

        <div class="col-md-9 col-10">

        <!-- App header actions start -->
        <div class="header-actions col">

            <!-- Search container start -->
            <div class="search-container d-none d-lg-block">
            <input type="text" id="search" class="form-control" placeholder="Search" />
            <i class="icon-search"></i>
            </div>
            <!-- Search container end -->

            <div class="d-sm-flex d-none align-items-center gap-2">
            <div class="dropdown">
                <a class="dropdown-toggle header-action-icon" href="#!" role="button" data-bs-toggle="dropdown"
                aria-expanded="false">
                <i class="icon-warning fs-4 lh-1 text-white"></i>
                <span class="count">7</span>
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-md">
                <h5 class="fw-semibold px-3 py-2 text-primary">
                    Notifications
                </h5>
                <div class="dropdown-item">
                    <div class="d-flex py-2">
                    <div class="icons-box md bg-success rounded-circle me-3">
                        <i class="icon-shopping-bag text-white fs-4"></i>
                    </div>
                    <div class="m-0">
                        <h6 class="mb-1 fw-semibold">Rosalie Deleon</h6>
                        <p class="mb-1 text-secondary">
                        You have new order.
                        </p>
                        <p class="small m-0 text-secondary">
                        30 mins ago
                        </p>
                    </div>
                    </div>
                </div>
                <div class="dropdown-item">
                    <div class="d-flex py-2">
                    <div class="icons-box md bg-danger rounded-circle me-3">
                        <i class="icon-alert-triangle text-white fs-4"></i>
                    </div>
                    <div class="m-0">
                        <h6 class="mb-1 fw-semibold">Donovan Stuart</h6>
                        <p class="mb-2">Membership has been expired.</p>
                        <p class="small m-0 text-secondary">2 days ago</p>
                    </div>
                    </div>
                </div>
                <div class="dropdown-item">
                    <div class="d-flex py-2">
                    <div class="icons-box md bg-warning rounded-circle me-3">
                        <i class="icon-shopping-cart text-white fs-4"></i>
                    </div>
                    <div class="m-0">
                        <h6 class="mb-1 fw-semibold">Roscoe Richards</h6>
                        <p class="mb-2">Payment pending. Pay now.</p>
                        <p class="small m-0 text-secondary">3 days ago</p>
                    </div>
                    </div>
                </div>
                <div class="d-grid mx-3 my-1">
                    <a href="javascript:void(0)" class="btn btn-outline-primary">View all</a>
                </div>
                </div>
            </div>
            <div class="dropdown">
                <a class="dropdown-toggle header-action-icon" href="#!" role="button" data-bs-toggle="dropdown"
                aria-expanded="false">
                <i class="icon-drafts fs-4 lh-1 text-white"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-md">
                <h5 class="fw-semibold px-3 py-2 text-primary">
                    Messages
                </h5>
                <div class="dropdown-item">
                    <div class="d-flex py-2">
                    <img src="assets/images/user3.png" class="img-3x me-3 rounded-5" alt="Admin Theme" />
                    <div class="m-0">
                        <h6 class="mb-1 fw-semibold">Angelia Payne</h6>
                        <p class="mb-1 text-secondary">
                        Membership has been ended.
                        </p>
                        <p class="small m-0 text-secondary">
                        Today, 07:30pm
                        </p>
                    </div>
                    </div>
                </div>
                <div class="dropdown-item">
                    <div class="d-flex py-2">
                    <img src="assets/images/user1.png" class="img-3x me-3 rounded-5" alt="Admin Theme" />
                    <div class="m-0">
                        <h6 class="mb-1 fw-semibold">Clyde Fowler</h6>
                        <p class="mb-1 text-secondary">
                        Congratulate, James for new job.
                        </p>
                        <p class="small m-0 text-secondary">
                        Today, 08:00pm
                        </p>
                    </div>
                    </div>
                </div>
                <div class="dropdown-item">
                    <div class="d-flex py-2">
                    <img src="assets/images/user4.png" class="img-3x me-3 rounded-5" alt="Admin Theme" />
                    <div class="m-0">
                        <h6 class="mb-1 fw-semibold">Sophie Michiels</h6>
                        <p class="mb-2 text-secondary">
                        Lewis added new schedule release.
                        </p>
                        <p class="small m-0 text-secondary">
                        Today, 09:30pm
                        </p>
                    </div>
                    </div>
                </div>
                <div class="d-grid mx-3 my-1">
                    <a href="javascript:void(0)" class="btn btn-outline-primary">View all</a>
                </div>
                </div>
            </div>
            </div>
            <div class="dropdown ms-3">
            <a id="userSettings" class="dropdown-toggle d-flex py-2 align-items-center text-decoration-none"
                href="#!" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <img src="{{ asset('assets/images/user2.png') }}" class="rounded-3 img-3x" alt="Bootstrap Gallery" />
                <div class="ms-2 text-truncate d-lg-block d-none text-white">
                    <span class="d-flex opacity-50 small">Admin</span>
                    <span>Taylor Franklin</span>
                </div>
            </a>
            <div class="dropdown-menu dropdown-menu-end">
                <div class="header-action-links">
                <a class="dropdown-item" href="profile.html"><i
                    class="icon-user border border-primary text-primary"></i>Profile</a>
                <a class="dropdown-item" href="settings.html"><i
                    class="icon-settings border border-danger text-danger"></i>Settings</a>
                <a class="dropdown-item" href="widgets.html"><i
                    class="icon-box border border-info text-info"></i>Widgets</a>
                </div>
                <div class="mx-3 mt-2 d-grid">
                    <form action="{{ route('logout') }}" method="post">
                        @csrf
                        <button type="submit" class="btn btn-outline-danger w-100">Logout</button>
                    </form>
                </div>
            </div>
            </div>

            <!-- Toggle Menu starts -->
            <button class="btn btn-warning btn-sm ms-3 d-lg-none d-md-block" type="button"
            data-bs-toggle="offcanvas" data-bs-target="#MobileMenu">
            <i class="icon-menu"></i>
            </button>
            <!-- Toggle Menu ends -->

        </div>
        <!-- App header actions end -->

        </div>
    </div>
    <!-- Row ends -->

    </div>
    <!-- Container ends -->

</div>