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
                            <select class="selectpicker" multiple data-live-search="true" name="multiple" data-actions-box="true" id="selectpickersalesTerr">
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

                    <div class="col-md-3 col-12 mb-2">
                        <label for="salesrep_id" class="form-label">SalesRep Id</labeL>
                        <input class="form-control" min="0" type="number" name="salesRepId" id="salesRepId" placeholder="Enter sales Code..">
                    </div>

                    <div class="col-md-3 col-12 mb-2">
                        <label for="salesrep_id" class="form-label">Loading Number</labeL>
                        <input class="form-control" min="0" type="number" name="loadingNumber" id="loadingNumber" placeholder="Enter Loading Number..">
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
        <div id="grid" class="">
    </div>
</div>



<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/js/bootstrap-select.min.js"></script>
<script>
    $(document).on('change', '#BranchAjax', function() {
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
            success: function(response) {
                $.each(response, function(i, area) {
                    $('#selectpickersalesTerr').append($(`<option  value='${area.sales_ter_id}'>${area.name}</option>`)).selectpicker('refresh');
                });
            },
            error: function() {
                areaList.empty();
            }
        });
    });
</script>
<script>
    $(document).on('change', '#selectpickersalesTerr', function() {

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
            success: function(response) {
                $.each(response, function(i, area) {
                    $('#SalesMenAjax').append($(`<option  value='${area.sales_id}'>${area.salesrep_name}</option>`)).selectpicker('refresh');
                });
            }
        });

    });
</script>

        <div class="k-pivotgrid-wrapper">
            {{-- <div id="configurator" class="hidden-on-narrow"></div> --}}
            <div id="pivotgrid" class="hidden-on-narrow"></div>
        </div>
        <div class="responsive-message"></div>
    </div>
</div>
<script src="{{ asset('assets/kendou/examples/content/shared/js/products.js') }}"></script>

<script type="text/javascript">
        $('#Product').on('submit', function(e) {

            e.preventDefault();
            
            let endDate = $('#endDate').val();
            let Begindate = $('#Begindate').val();
            let SalesMen = $('#SalesMenAjax').val();
            let salesRepId = $('#salesRepId').val();
            let loadingNumber = $('#loadingNumber').val();
            let CompanyAjax =  $('#CompanyAjax').val();

            $.ajax({
                url: '{{ URL::to('GetOrderWhereSalesMenAndData') }}',
                type: 'get',
                data: {
                    Begindate: Begindate,
                    endDate: endDate,
                    SalesMen: SalesMen,
                    salesRepId: salesRepId,
                    loadingNumber:loadingNumber,
                    CompanyAjax:CompanyAjax,
                },
                beforeSend: function() {
                    // $("body").addClass("loading");
                    // $('body').css('cursor', 'wait');
                },
                success: function(data) {
                  
                    $('body').css('cursor', 'auto');
                    $("body").removeClass("loading");

                    if (data['status'] == "error") {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: data.message,
                        })
                    } else if(data['allDetails'] == false) {
                        $(document).ready(function() {
                            var crudServiceBaseUrl = "http://10.1.100.125/8125",
                                dataSource = new kendo.data.DataSource({
                                    data: data['result'],
                                    batch: true,
                                    pageSize: 100000000,
                                    autoSync: true,
                                    aggregate: [{
                                        field: "TotalSales",
                                        aggregate: "sum"
                                    }],
                                    // group: {
                                    //     field: "sub__cat_id",
                                    // },
                                    // sort: {
                                    //     field: "main__cat_id",
                                    //     dir: "desc"
                                    // },
                                    schema: {
                                        model: {
                                            id: "id",
                                            fields: {
                                                salescall_id: {
                                                    editable: false,
                                                    nullable: true
                                                },
                                                salescall_details_id: {
                                                    editable: false,
                                                    nullable: true
                                                },
                                                total_invoice: {
                                                    editable: false,
                                                    nullable: true
                                                },
                                                incentive_amount: {
                                                    editable: false,
                                                    nullable: true
                                                },
                                                net_amout: {
                                                    editable: false,
                                                    nullable: true
                                                },
                                                category_id: {
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
                                height: 600,
                                editable: "incell",
                                // pageable: true,
                                pageable: {
                                    refresh: true,
                                    pageSizes: true,
                                },
                                sortable: true,
                                navigatable: true,
                                resizable: true,
                                reorderable: true,
                                // groupable: true,
                                filterable: true,
                                dataBound: onDataBound,
                                toolbar: ["excel", "search"],
                                columns: [
                                    // {
                                    //     selectable: true,
                                    //     width: 75,
                                    //     attributes: {
                                    //         "class": "checkbox-align",
                                    //     },
                                    //     headerAttributes: {
                                    //         "class": "checkbox-align",
                                    //     }
                                    // },
                                    {
                                        field: "branch_code",
                                        title: "Branch code",
                                        width: 100
                                    },
                                    {
                                        field: "sales_ter_id",
                                        title: "Sales ter id",
                                        width: 100
                                    },
                                    {
                                        field: "loading_number",
                                        title: "Loading number",
                                        width: 100
                                    },
                                    {
                                        field: "category_id",
                                        title: "Category ID",
                                        width: 100
                                    },
                                    {
                                        field: "salesrep_id",
                                        title: "Sales Rep ID",
                                        width: 100
                                    },
                                    {
                                        field: "salesman",
                                        title: "Sales Man",
                                        width: 150
                                    },
                                    {
                                        field: "start_date",
                                        title: "Start date",
                                        width: 200
                                    },
                                    {
                                        field: "end_date",
                                        title: "End Date",
                                        width: 200
                                    },
                                    {
                                        field: "result",
                                        title: "Result",
                                        width: 450
                                    },
                                    {
                                        field: "total_amount",
                                        title: "Total Amount",
                                        width: 100
                                    },
                                    {
                                        field: "div",
                                        title: "DIV",
                                        width: 100
                                    },
                                ],
                            });
                        });

                        function onDataBound(e) {
                            var grid = this;
                            grid.table.find("tr").each(function() {
                                var dataItem = grid.dataItem(this);
                                var themeColor = dataItem.Discontinued ? 'success' : 'error';
                                var text = dataItem.Discontinued ? 'available' :
                                    'not available';

                                $(this).find(".badgeTemplate").kendoBadge({
                                    themeColor: themeColor,
                                    text: text,
                                });

                                $(this).find(".rating").kendoRating({
                                    min: 1,
                                    max: 5,
                                    label: false,
                                    selection: "continuous"
                                });

                                $(this).find(".sparkline-chart").kendoSparkline({
                                    legend: {
                                        visible: false
                                    },
                                    data: [dataItem.TargetSales],
                                    type: "bar",
                                    chartArea: {
                                        margin: 0,
                                        width: 180,
                                        background: "transparent"
                                    },
                                    seriesDefaults: {
                                        labels: {
                                            visible: true,
                                            format: '{0}%',
                                            background: 'none'
                                        }
                                    },
                                    categoryAxis: {
                                        majorGridLines: {
                                            visible: false
                                        },
                                        majorTicks: {
                                            visible: false
                                        }
                                    },
                                    valueAxis: {
                                        type: "numeric",
                                        min: 0,
                                        max: 130,
                                        visible: false,
                                        labels: {
                                            visible: false
                                        },
                                        minorTicks: {
                                            visible: false
                                        },
                                        majorGridLines: {
                                            visible: false
                                        }
                                    },
                                    tooltip: {
                                        visible: false
                                    }
                                });

                                kendo.bind($(this), dataItem);
                            });
                        }

                        function returnFalse() {
                            return false;
                        }

                        function clientCategoryEditor(container, options) {
                            $('<input required name="Category">')
                                .appendTo(container)
                                .kendoDropDownList({
                                    autoBind: false,
                                    dataTextField: "CategoryName",
                                    dataValueField: "CategoryID",
                                    dataSource: {
                                        data: categories
                                    }
                                });
                        }

                        function clientCountryEditor(container, options) {
                            $('<input required name="Country">')
                                .appendTo(container)
                                .kendoDropDownList({
                                    dataTextField: "CountryNameLong",
                                    dataValueField: "CountryNameShort",
                                    template: "<div class='dropdown-country-wrap'><img src='../content/web/country-flags/#:CountryNameShort#.png' alt='#: CountryNameLong#' title='#: CountryNameLong#' width='30' /><span>#:CountryNameLong #</span></div>",
                                    dataSource: {
                                        transport: {
                                            read: {
                                                url: "http://localhost:8080",
                                                dataType: "json"
                                            }
                                        }
                                    },
                                    autoWidth: true
                                });
                        };
                    }else if(data['allDetails'] == true) {
                        $(document).ready(function() {
                            var crudServiceBaseUrl = "http://10.1.100.125/8125",
                                dataSource = new kendo.data.DataSource({
                                    data: data['result'],
                                    batch: true,
                                    pageSize: 100000000,
                                    autoSync: true,
                                    aggregate: [{
                                        field: "TotalSales",
                                        aggregate: "sum"
                                    }],
                                    // group: {
                                    //     field: "sub__cat_id",
                                    // },
                                    // sort: {
                                    //     field: "main__cat_id",
                                    //     dir: "desc"
                                    // },
                                    schema: {
                                        model: {
                                            id: "id",
                                            fields: {
                                                salescall_id: {
                                                    editable: false,
                                                    nullable: true
                                                },
                                                salescall_details_id: {
                                                    editable: false,
                                                    nullable: true
                                                },
                                                total_invoice: {
                                                    editable: false,
                                                    nullable: true
                                                },
                                                incentive_amount: {
                                                    editable: false,
                                                    nullable: true
                                                },
                                                net_amout: {
                                                    editable: false,
                                                    nullable: true
                                                },
                                                category_id: {
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
                                height: 600,
                                editable: "incell",
                                // pageable: true,
                                pageable: {
                                    refresh: true,
                                    pageSizes: true,
                                },
                                sortable: true,
                                navigatable: true,
                                resizable: true,
                                reorderable: true,
                                // groupable: true,
                                filterable: true,
                                dataBound: onDataBound,
                                toolbar: ["excel", "search"],
                                columns: [
                                    // {
                                    //     selectable: true,
                                    //     width: 75,
                                    //     attributes: {
                                    //         "class": "checkbox-align",
                                    //     },
                                    //     headerAttributes: {
                                    //         "class": "checkbox-align",
                                    //     }
                                    // },
                                    {
                                        field: "loading_number",
                                        title: "Loading number",
                                        width: 100
                                    },
                                    {
                                        field: "salesrep_id",
                                        title: "Sales Rep ID",
                                        width: 100
                                    },

                                    {
                                        field: "result",
                                        title: "Result",
                                        width: 450
                                    },
                                    {
                                        field: "return_date",
                                        title: "Return Date",
                                        width: 100
                                    },
                                    {
                                        field: "cat_id",
                                        title: "Category ID",
                                        width: 100
                                    },
                                    {
                                        field: "user_name",
                                        title: "User name",
                                        width: 100
                                    },
                                    {
                                        field: "comp_name",
                                        title: "Company name",
                                        width: 100
                                    },
                                    {
                                        field: "status",
                                        title: "Status",
                                        width: 100
                                    },
                                ],
                            });
                        });

                        function onDataBound(e) {
                            var grid = this;
                            grid.table.find("tr").each(function() {
                                var dataItem = grid.dataItem(this);
                                var themeColor = dataItem.Discontinued ? 'success' : 'error';
                                var text = dataItem.Discontinued ? 'available' :
                                    'not available';

                                $(this).find(".badgeTemplate").kendoBadge({
                                    themeColor: themeColor,
                                    text: text,
                                });

                                $(this).find(".rating").kendoRating({
                                    min: 1,
                                    max: 5,
                                    label: false,
                                    selection: "continuous"
                                });

                                $(this).find(".sparkline-chart").kendoSparkline({
                                    legend: {
                                        visible: false
                                    },
                                    data: [dataItem.TargetSales],
                                    type: "bar",
                                    chartArea: {
                                        margin: 0,
                                        width: 180,
                                        background: "transparent"
                                    },
                                    seriesDefaults: {
                                        labels: {
                                            visible: true,
                                            format: '{0}%',
                                            background: 'none'
                                        }
                                    },
                                    categoryAxis: {
                                        majorGridLines: {
                                            visible: false
                                        },
                                        majorTicks: {
                                            visible: false
                                        }
                                    },
                                    valueAxis: {
                                        type: "numeric",
                                        min: 0,
                                        max: 130,
                                        visible: false,
                                        labels: {
                                            visible: false
                                        },
                                        minorTicks: {
                                            visible: false
                                        },
                                        majorGridLines: {
                                            visible: false
                                        }
                                    },
                                    tooltip: {
                                        visible: false
                                    }
                                });

                                kendo.bind($(this), dataItem);
                            });
                        }

                        function returnFalse() {
                            return false;
                        }

                        function clientCategoryEditor(container, options) {
                            $('<input required name="Category">')
                                .appendTo(container)
                                .kendoDropDownList({
                                    autoBind: false,
                                    dataTextField: "CategoryName",
                                    dataValueField: "CategoryID",
                                    dataSource: {
                                        data: categories
                                    }
                                });
                        }

                        function clientCountryEditor(container, options) {
                            $('<input required name="Country">')
                                .appendTo(container)
                                .kendoDropDownList({
                                    dataTextField: "CountryNameLong",
                                    dataValueField: "CountryNameShort",
                                    template: "<div class='dropdown-country-wrap'><img src='../content/web/country-flags/#:CountryNameShort#.png' alt='#: CountryNameLong#' title='#: CountryNameLong#' width='30' /><span>#:CountryNameLong #</span></div>",
                                    dataSource: {
                                        transport: {
                                            read: {
                                                url: "http://localhost:8080",
                                                dataType: "json"
                                            }
                                        }
                                    },
                                    autoWidth: true
                                });
                        };
                    }
                },

            });
        });
    </script>
</script>


<script type="text/javascript">
    $(function() {
        $('#datetimepicker1').datetimepicker({
            format: 'YYYY-MM-DD',
            defaultDate: new Date(),
            maxDate: new Date(),
            useCurrent: false,
        });
    });
</script>
<script type="text/javascript">
    $(function() {
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

