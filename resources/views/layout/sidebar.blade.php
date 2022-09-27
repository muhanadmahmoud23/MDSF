    <!--Sidebar-->
    <div class="sidebar transition overlay-scrollbars animate__animated  animate__slideInLeft">
        <div class="sidebar-content">
            <div id="sidebar">

                <!-- Logo -->
                <div class="logo">
                    <h2 class="mb-0"><img src="{{ asset('assets/images/logo.jfif') }}" class="rounded boardered"> Al
                        Mansour</h2>
                </div>

                <ul class="side-menu">
                    <li>
                        <a href="{{ route('home') }}" class="active">
                            <i class='bx bxs-dashboard icon'></i> Dashboard
                        </a>
                    </li>

                    <!-- Divider-->
                    <li class="divider" data-text="Sales">Sales</li>

                    <li>
                        <a href="#">
                            <i class='bx bx-columns icon'></i>
                            Total Daily Sales Report
                            <i class='bx bx-chevron-right icon-right'></i>
                        </a>
                        <ul class="side-dropdown">
                            <li><a href="{{ route('printInvoiceIndex') }}">Print Invoice</a></li>
                            <li><a href="{{ route('SalesRepVisitsIndex') }}">Sales Rep Visits</a></li>
                            <li><a href="{{ route('DSRIndex') }}">Daily Sales Report (DSR)</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#">
                            <i class='bx bx-columns icon'></i>
                            Exceel Upload
                            <i class='bx bx-chevron-right icon-right'></i>
                        </a>
                        <ul class="side-dropdown">
                            <li><a href="{{ route('Excel') }}">Excel</a></li>
                        </ul>
                    </li>
                </ul>

            </div>

        </div>
    </div>
    </div><!-- End Sidebar-->


    <div class="sidebar-overlay"></div>
