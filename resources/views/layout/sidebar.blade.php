    {{-- <div class="sidebar-overlay"></div> --}}
    <div class="nav11">
        <div class="logo-details">
            <img src="{{ asset('assets/images/mansour-logo-white.svg') }}" alt="" srcset="" />
            <span class="logo-name">MANSOUR GROUP</span>
            <i class="fas fa-chevron-left"></i>
        </div>
        <ul class="nav11-links">
            <li class="parent">
                <div class="icon-link">
                    <a href="{{ route('home') }}">
                        <i class="fas fa-home"></i>
                        <span class="link-name">DASHBOARD</span>
                    </a>
                </div>
                <ul class="sub-menu">

                </ul>
            </li>
            <li class="parent">
                <div class="icon-link">
                    <a>
                        <i class="fa-sharp fa-solid fa-truck-front"></i>
                        <span class="link-name">MASTER DATA</span>
                    </a>
                    <i class="fas fa-chevron-down arrow"></i>
                </div>
                <ul class="sub-menu">

                </ul>
            </li>
            <li class="parent">
                <div class="icon-link">
                    <a>
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
                    <a>
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
                    <a>
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

            <li class="parent logout">
                <div class="icon-link">
                    <a href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                  document.getElementById('logout-form').submit();">
                        <i class="fa fa-right-from-bracket"></i>
                        <span class="link-name">LOGOUT</span>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
                <ul class="sub-menu">

                </ul>
            </li>
        </ul>
    </div>
