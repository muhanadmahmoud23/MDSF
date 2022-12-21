@extends('layout.pivotindex')
@section('title', 'loading unloading order')

@section('content')

<div class="main">
    <div class="main-content container-fluid">
        <div class="overlay">
            <span class="loader"></span>
        </div>
        <div class="header-top">
            <p class="SideBarTitle info">@yield('title')</p>
        </div>
        <div class="card">
            <form id="Product" class="card-body">
                <div class="row">
                    <div class="col-md-3 col-12 mb-2">
                        <label for="BranchAjax">Region</label>
                        <div class="w-100">
                            @include('Include.branchesSelect')
                        </div>
                    </div>
                    <div class="col-md-3 col-12 mb-2">
                        <label for="multiple">Sales Terr</label>
                        <div class="SalesTerrAjax ">
                            <select class="selectpicker" multiple data-live-search="true" name="multiple"
                                data-actions-box="true" id="selectpickersalesTerr">
                                <option value="" name="multiple_select"></option>
                            </select>
                        </div>

                    </div>
                    <div class="col-md-3 col-12 mb-2">
                        <label for="multiple">Sales Men</label>
                        <div>
                            @include('Include.SalesMenSelect')
                        </div>
                    </div>
                    <div class="col-md-3 col-12 mb-2">
                        <label for="multiple">Company</label>
                        <div class="">
                            @include('Include.companiesSelectFineTobComp')
                        </div>
                    </div>
                    <div class="form-group col-md-3 col-12 mb-2">
                        <label>Begin Date</label>
                        <div class="form-group">
                            @include('Include.BeginDate')
                        </div>
                    </div>
                    <div class="form-group col-md-3 col-12 mb-2">
                        <label>End Date</label>
                        <div class="form-group">
                            @include('Include.EndDate')
                        </div>
                    </div>

                    <div>
                        <button class="btn btn-success btn-lg" id="submit">Search</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="row overflow-auto">
            <div class="k-pivotgrid-wrapper">
                <div id="configurator" class="hidden-on-narrow"></div>
                <div id="pivotgrid" class="hidden-on-narrow"></div>
            </div>

        </div>
    </div>
</div>


<script>

    $(document).on('change', '#BranchAjax', function () {
        var branch = $('#BranchAjax').val();
        var areaList = $('#selectpickersalesTerr');
        areaList.empty();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: 'get',
            url: '{{ route("salesTerrWhereRegion") }}',
            dataType: 'json',
            data: {
                branch: branch,
            },
            success: function (response) {
                $.each(response, function (i, area) {
                    $('#selectpickersalesTerr').append($(`<option  value='${area.sales_ter_id}'>${area.name}</option>`)).selectpicker('refresh');
                });
            },
            error: function () {
                areaList.empty();
            }
        });
    });
</script>
<script>
    $(document).on('change', '#selectpickersalesTerr', function () {

        var salesTerr = $('#selectpickersalesTerr').val();
        $('#SalesMenAjax').empty();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'get',
            url: '{{ route("salesMenWhereSalesTerr") }}',
            dataType: 'json',
            data: {
                salesTerr: salesTerr,
            },
            success: function (response) {
                $.each(response, function (i, area) {
                    $('#SalesMenAjax').append($(`<option  value='${area.sales_id}'>${area.salesrep_name}</option>`)).selectpicker('refresh');
                });
            }
        });

    });
</script>

</div>
<script type="text/javascript">
    $('#Product').on('submit', function (e) {

        e.preventDefault();

        let endDate = $('#endDate').val();
        let Begindate = $('#Begindate').val();
        let SalesMen = $('#SalesMenAjax').val();

        $.ajax({
            url: '{{ URL::to("GetOrderWhereSalesMenAndData") }}',
            type: 'get',
            data: {
                Begindate: Begindate,
                endDate: endDate,
                SalesMen: SalesMen,
            },
            beforeSend: function () {

                $(".overlay").fadeIn();
                $(".loader").fadeIn();

            },
            success: function (data) {
                $('body').css('cursor', 'auto');
                $("body").removeClass("loading");
                $(".overlay").fadeOut();
                $(".loader").fadeOut();

                if (data['SaleTerrResult'] == "Missing Paramter") {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Missing Paramter!',
                    })
                } else if (data['SaleTerrResult'] == "Not Found") {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Not Found!',
                    })
                } else if (data['status'] == 'success') {

                    Swal.fire({
                        icon: 'success',
                        title: 'عملية ناجحة',
                    })
                     $(document).ready(function() {
                            var crudServiceBaseUrl = "http://localhost:8000",
                                dataSource = new kendo.data.DataSource({
                                    data: data['result'],
                                    batch: true,
                                    pageSize: 100000000,
                                    autoSync: true,
                                    aggregate: [{
                                        field: "TotalSales",
                                        aggregate: "sum"
                                    }],
                                    schema: {
                                        model: {
                                            id: "SALESREP_ID",
                                            fields: {
                                                salescall_id: {
                                                    editable: false,
                                                    nullable: true
                                                },
                                            }
                                        }
                                    }
                                });

                            $("#grid").kendoGrid({
                                dataSource: dataSource,
                                columnMenu: {
                                    filterable: false
                                },
                                height: 260,
                                editable: "incell",
                                pageable: {
                                    refresh: true,
                                    pageSizes: true,
                                },
                                sortable: true,
                                navigatable: true,
                                resizable: true,
                                reorderable: true,
                                filterable: true,
                                dataBound: onDataBound,
                                columns: [{
                                        field: "salesrep_id",
                                        title: "Sales Rep",
                                        width: 50
                                    },
                                    {
                                        field: "tab_name",
                                        title: "Tab Name",
                                        width: 50
                                    },
                                    {
                                        field: "run_code",
                                        title: "Run Code",
                                        width: 160
                                    },
                                    {
                                        field: "comm_date",
                                        title: "Comm Date",
                                        width: 80
                                    },
                                    {
                                        field: "hh_upd_status",
                                        title: "HH UPD STATUS",
                                        width: 20
                                    },
                                    {
                                        field: "hh_upd_date",
                                        title: "HH UPD DATE",
                                        width: 100
                                    },
                                    {
                                        field: "user_id",
                                        title: "User ID",
                                        width: 20
                                    },
                                    {
                                        field: "user_name",
                                        title: "User Name",
                                        width: 100
                                    },

                                ],
                            });
                        });
                    // $(document).ready(function () {
                    //     var pivotgrid = $("#pivotgrid").kendoPivotGrid({
                    //         filterable: true,
                    //         sortable: true,
                    //         columnWidth: 120,
                    //         height: 570,
                    //         dataSource: {
                    //             data: data['SaleTerrResult'],
                    //             schema: {
                    //                 model: {
                    //                     fields: {
                    //                         salesrep_name: {
                    //                             caption: "salesrep_name"
                    //                         },
                    //                         pos_name: {
                    //                             type: "string"
                    //                         },
                    //                         pos_code: {
                    //                             type: "number"
                    //                         },

                    //                     }
                    //                 },
                    //                 cube: {
                    //                     dimensions: {

                    //                     },

                    //                     company_name: {
                    //                         caption: "company_name"
                    //                     },
                    //                     pos_code: {
                    //                         caption: "pos_code"
                    //                     },
                    //                     measures: {

                    //                     }
                    //                 }
                    //             },
                    //             columns: [{
                    //                 name: "company_name",
                    //                 expand: true
                    //             }, {
                    //                 name: "prod_seq",
                    //                 expand: true
                    //             }, {
                    //                 name: "prod_id",
                    //                 expand: true
                    //             }, {
                    //                 name: "product_id",
                    //                 expand: true
                    //             }],
                    //             rows: [{
                    //                 name: "salesrep_name",
                    //                 expand: true
                    //             }, {
                    //                 name: "pos_name",
                    //                 expand: true
                    //             },
                    //             {
                    //                 name: "pos_code",
                    //                 expand: true
                    //             }, {
                    //                 name: "visit_start_time",
                    //                 expand: true
                    //             },
                    //             {
                    //                 name: "visit_end_time",
                    //                 expand: true
                    //             },
                    //             ]
                    //         }
                    //     }).data("kendoPivotGrid");


                    // });

                }
            },

        });
    });
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.7.14/js/bootstrap-datetimepicker.min.js">
</script>
<script type="text/javascript">
    $(function () {
        $('#datetimepicker1').datetimepicker({
            format: 'YYYY-MM-DD',
            defaultDate: new Date(),
            maxDate: new Date(),
            useCurrent: false,
        });
    });
</script>
<script type="text/javascript">
    $(function () {
        $('#datetimepicker2').datetimepicker({
            format: 'YYYY-MM-DD',
            defaultDate: new Date(),
            maxDate: new Date(),
            useCurrent: false,
        });
    });
</script>
<script type="text/javascript" src="http://jqueryjs.googlecode.com/files/jquery-1.3.1.min.js"></script>
@endsection