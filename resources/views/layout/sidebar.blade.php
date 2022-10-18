    {{-- <!--Sidebar-->
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
                            <li><a href="{{ route('POSIndex') }}">POS</a></li>
                            <li><a href="{{ route('SalesRepIndex') }}">SalesRep</a></li>
                            <li><a href="{{ route('SaleTerrIndex') }}">SalesTerr</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#">
                            <i class='bx bx-columns icon'></i>
                            Andriod Support
                            <i class='bx bx-chevron-right icon-right'></i>
                        </a>
                        <ul class="side-dropdown">
                            <li><a href="{{ route('DevAndriodIndex') }}">Dev Andriod </a></li>
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
    </div><!-- End Sidebar--> --}}


    {{-- <div class="sidebar-overlay"></div> --}}
    <div class="nav11">
        <div class="logo-details">
            <img src="{{ asset('assets/images/mansour-logo-white.svg') }}" alt="" srcset="" />
            <span class="logo-name">MANSOUR GROUP</span>
            <i class="fas fa-chevron-right"></i>
        </div>
        <ul class="nav11-links">
            <li class="parent">
                <div class="icon-link">
                    <a href="#">
                        <i class="fas fa-home"></i>
                        <span class="link-name">MASTER DATA</span>
                    </a>
                    <i class="fas fa-chevron-down arrow"></i>
                </div>
                <ul class="sub-menu">

                </ul>
            </li>
            <li class="parent">
                <div class="icon-link">
                    <a href="#">
                        <i class="fas fa-money-bill"></i>
                        <span class="link-name">SALES</span>
                    </a>
                    <i class="fas fa-chevron-down arrow"></i>
                </div>
                <ul class="sub-menu">
                    <li><a href="{{ route('printInvoiceIndex') }}">Print Invoice</a></li>
                    <li><a href="{{ route('SalesRepVisitsIndex') }}">Sales Rep Visits</a></li>
                    <li><a href="{{ route('DSRIndex') }}">Daily Sales Report (DSR)</a></li>
                    <li><a href="{{ route('POSIndex') }}">POS</a></li>
                    <li><a href="{{ route('SalesRepIndex') }}">SalesRep</a></li>
                    <li><a href="{{ route('SaleTerrIndex') }}">SalesTerr</a></li>
                </ul>
            </li>
            <li class="parent">
                <div class="icon-link">
                    <a href="#">
                        <i class="fas fa-store-alt"></i>
                        <span class="link-name">POS</span>
                    </a>
                    <i class="fas fa-chevron-down arrow"></i>
                </div>
                <ul class="sub-menu">
                    <li>
                        <a href="#">Review New Pos</a>
                    </li>
                    <li>
                        <a href="#">Payer Pos</a>
                    </li>
                    <li>
                        <a href="#">Pos Route Assign</a>
                    </li>
                    <li>
                        <a href="#">Chang TerrTiory for POSs</a>
                    </li>
                    <li>
                        <a href="#">Pos Tax Photo</a>
                    </li>
                    <li>
                        <a href="#">Pos Survey</a>
                    </li>
                    <li>
                        <a href="#">Covered and Uncovered Pos</a>
                    </li>
                    <li>
                        <a href="#">New Pos Report</a>
                    </li>
                    <li>
                        <a href="#">Routes Search</a>
                    </li>
                </ul>
            </li>
            <li class="parent">
                <div class="icon-link">
                    <a href="#">
                        <i class="fas fa-wallet"></i>
                        <span class="link-name">INCENTIVES</span>
                    </a>
                    <i class="fas fa-chevron-down arrow"></i>
                </div>
                <ul class="sub-menu">
                    <li>
                        <a href="#">New Incentive Type</a>
                    </li>
                    <li>
                        <a href="#">Incentives Report</a>
                    </li>
                </ul>
            </li>
            <li class="parent">
                <div class="icon-link">
                    <a href="#">
                        <i class="far fa-dot-circle"></i>
                        <span class="link-name">TARGET</span>
                    </a>
                    <i class="fas fa-chevron-down arrow"></i>
                </div>
                <ul class="sub-menu">
                    <li>
                        <a href="#">Target Assigning</a>
                    </li>
                    <li>
                        <a href="#">Trade Program Transaction</a>
                    </li>
                    <li>
                        <a href="#">Fine Target</a>
                    </li>
                    <li>
                        <a href="#">Target Details</a>
                    </li>
                </ul>
            </li>
            <li class="parent">
                <div class="icon-link">
                    <a href="#">
                        <i class="fab fa-android"></i>
                        <span class="link-name">SUPPORT</span>
                    </a>
                    <i class="fas fa-chevron-down arrow"></i>
                </div>
                <ul class="sub-menu">
                    <li>
                        <a href="#">Send Data</a>
                    </li>
                    <li>
                        <a href="{{ route('DevAndriodIndex') }}">Dev Andriod </a>
                    </li>
                    <li>
                        <a href="#">Managers Android Support</a>
                    </li>
                </ul>
            </li>
            <li class="parent">
                <div class="icon-link">
                    <a href="#">
                        <i class="fas fa-warehouse"></i>
                        <span class="link-name">INVENTORY</span>
                    </a>
                    <i class="fas fa-chevron-down arrow"></i>
                </div>
                <ul class="sub-menu">
                    <li>
                        <a href="#">All Send To Sap</a>
                    </li>
                    <li>
                        <a href="#">Tobacco Send To Sap</a>
                    </li>
                    <li>
                        <a href="#">Lighter Send To Sap</a>
                    </li>
                    <li>
                        <a href="#">Fine Send To Sap</a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
