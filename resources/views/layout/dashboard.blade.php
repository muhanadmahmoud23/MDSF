<div class="main">
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
    <div class="main-content container-fluid">
        <div class="header-top mb-3">
            <p class="SideBarTitle info">@yield('title')</p>
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 col-6 ">
                            <p class="card-text">welcome / <span class="text-info">shawky</span> </p>
                        </div>
                        <div class="col-md-6 col-6 text-right">
                            <p data-toggle="modal" data-target="#exampleModal" class="change-text text-info">تغير الرقم
                                السري
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card mb-3">
            <div class="card-body">
                <h5 class="card-title"><i class="fab fa-android"></i>
                    <span class="titledash">Android Support</span>
                </h5>
                <div class="row">
                    <div class="col-md-2 col-12 mb-3">
                        <div class="dash-icon">
                            <a href="#">
                                <i class="fa-solid fa-paper-plane"></i>
                            </a>
                            <p class="link-name">SEND DATA </p>
                        </div>
                    </div>
                    <div class="col-md-2 col-12 mb-3">
                        <div class="dash-icon">
                            <a href="{{ route('DevAndriodIndex') }}">
                                <i class="fab fa-android"></i>
                            </a>
                            <p class="link-name">ANDROID SUPPORT </p>
                        </div>
                    </div>
                    <div class="col-md-2 col-12 mb-3">
                        <div class="dash-icon">
                            <a href="">
                                <i class="fab fa-android"></i>
                            </a>
                            <p class="link-name">MANGER SUPPORT </p>
                        </div>
                    </div>

                </div>

            </div>
        </div>

        <div class="card mb-3">
            <div class="card-body">
                <h5 class="card-title"><i class="fas fa-money-bill"></i>
                    <span class="titledash">Sales</span>
                </h5>
                <div class="row">
                    <div class="col-md-2 col-12 mb-3">
                        <div class="dash-icon">
                            <a href="#">
                                <i class="fa-solid fa-file-invoice"></i>
                            </a>
                            <p class="link-name">PRINT INVOICE</p>
                        </div>
                    </div>
                    <div class="col-md-2 col-12 mb-3">
                        <div class="dash-icon">
                            <a href="">
                                <i class="fa-solid fa-money-bill"></i>
                            </a>
                            <p class="link-name">SALESREP VISITS </p>
                        </div>
                    </div>
                    <div class="col-md-2 col-12 mb-3">
                        <div class="dash-icon">
                            <a href="">
                                <i class="fab fa-android"></i>
                            </a>
                            <p class="link-name">DSR </p>
                        </div>
                    </div>
                    <div class="col-md-2 col-12 mb-3">
                        <div class="dash-icon">
                            <a href="">
                                <i class="fab fa-android"></i>
                            </a>
                            <p class="link-name">POS </p>
                        </div>
                    </div>

                </div>

            </div>
        </div>

    </div>
</div>
