@extends('layout.pivotindex')
@section('title', 'Print Invoice')
@section('content')


    <div id="example">

        <body>
            <div>
                <div class="container panel panel-default ">
                    {{-- <form id="date">
                    <label>Begin Date</label>
                    <input type="date" name="Begindate" id="beginDate" style="color:black">
                    <label>End Date</label>
                    <input type="date" name="endDate" id="endDate" style="color:black">
                </form> --}}
                    <div class="container">
                        <div class="col-md-3">
                            <form id="multiple">
                                <label for="multiple">Region</label>
                                <select class="selectpicker" multiple data-live-search="true" name="multiple" id="BranchAjax">
                                    @foreach ($branches as $branch)
                                        <option value="{{ $branch->branch_code }}" name="multiple_select" id="BranchAjax">{{ $branch->branch_name }}</option>
                                    @endforeach
                                </select>
                                <div class="form-group">
                                    <button class="btn btn-success" id="submit">Submit</button>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-3">
                            <form id="multiple">
                                <label for="multiple">Company</label>
                                <select class="selectpicker" multiple data-live-search="true" name="multiple" id="CompanyAjax">
                                    @foreach ($companies as $company)
                                        <option value="{{ $company->company_id }}" name="multiple_select"
                                            id="CompanyAjax">{{ $company->company_name }}</option>
                                    @endforeach
                                </select>
                                <div class="form-group">
                                    <button class="btn btn-success" id="submit">Submit</button>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-3">
                            <form id="multiple">
                                <label for="multiple">Company</label>
                                <select class="selectpicker" multiple data-live-search="true" name="multiple"
                                    id="multiple_select">
                                    @foreach ($companies as $company)
                                        <option value="{{ $company->company_id }}" name="multiple_select"
                                            id="multiple_select">{{ $company->company_name }}</option>
                                    @endforeach
                                </select>
                                <div class="form-group">
                                    <button class="btn btn-success" id="submit">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>


                <form id="date">
                    <div class="form-group">
                        <label>Begin Date</label>
                        <input type="date" name="Begindate" id="Begindate" style="color:black">
                    </div>
                    <div class="form-group">
                        <label>End Date</label>
                        <input type="date" name="endDate" id="endDate" style="color:black">
                    </div>
                    <div class="form-group">
                        <button class="btn btn-success" id="submit">Submit</button>
                    </div>
                </form>
                <form id="Product">
                    <div class="form-group">
                        <label class="col-md-3">ٍSearch By Product Id</label>
                        <input type="text" class="col-md-3" name="prod_id" class="form-control"
                            placeholder="Enter Product Id" id="prod_id" style="color:black">
                        <span class="text-danger" id="name-error"></span>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-success" id="submit">Submit</button>
                    </div>
                </form>

                <form id="UOM">
                    <div class="form-group">
                        <label class="col-md-3">ٍSearch By UOM Id</label>
                        <input type="text" class="col-md-3" name="UOM_id" class="form-control"
                            placeholder="Enter UOM Id" id="UOM_id" style="color:black">
                        <span class="text-danger" id="name-error"></span>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-success" id="submit">Submit</button>
                    </div>
                </form>
            </div>

            <div id="grid" class=""></div>

            <script>
                $(document).ready(function() {
                    var crudServiceBaseUrl = "http://localhost:8080",
                        dataSource = new kendo.data.DataSource({
                            transport: {
                                read: {
                                    url: crudServiceBaseUrl + "/pivotInvoice",
                                    dataType: "json"
                                },
                                update: {
                                    url: crudServiceBaseUrl + "/detailproducts/Update",
                                    dataType: "jsonp"
                                },
                                destroy: {
                                    url: crudServiceBaseUrl + "/detailproducts/Destroy",
                                    dataType: "jsonp"
                                },
                                parameterMap: function(options, operation) {
                                    if (operation !== "read" && options.models) {
                                        return {
                                            models: kendo.stringify(options.models)
                                        };
                                    }
                                }
                            },
                            batch: true,
                            pageSize: 25,
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
                                        id: {
                                            editable: false,
                                            nullable: true
                                        },
                                        prod_id: {
                                            editable: false,
                                            nullable: true
                                        },
                                        Uom_id: {
                                            editable: false,
                                            nullable: true
                                        },
                                        Quantity: {
                                            editable: false,
                                            nullable: true
                                        },
                                        Total_value: {
                                            editable: false,
                                            nullable: true
                                        },
                                        incentive_value: {
                                            editable: false,
                                            nullable: true
                                        },
                                        net_value: {
                                            editable: false,
                                            nullable: true
                                        },
                                        loading_number: {
                                            editable: false,
                                            nullable: true
                                        },
                                        salescall_details_id: {
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
                        height: 650,
                        editable: "incell",
                        pageable: true,
                        sortable: true,
                        navigatable: true,
                        resizable: true,
                        reorderable: true,
                        // groupable: true,
                        filterable: true,
                        dataBound: onDataBound,
                        toolbar: ["excel", "pdf", "search"],
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
                                field: "id",
                                title: "id",
                                width: 70
                            },
                            {
                                field: "prod_id",
                                title: "prod_id",
                                width: 120
                            },
                            {
                                field: "Uom_id",
                                title: "Uom_id",
                                width: 120
                            },
                            {
                                field: "Quantity",
                                title: "Quantity",
                                width: 120
                            },
                            {
                                field: "Total_value",
                                title: "Total_value",
                                width: 120
                            },
                            {
                                field: "incentive_value",
                                title: "incentive_value",
                                width: 120
                            },
                            {
                                field: "net_value",
                                title: "net_value",
                                width: 120
                            },
                            {
                                field: "loading_number",
                                title: "loading_number",
                                width: 120
                            },
                            {
                                field: "salescall_details_id",
                                title: "salescall_details_id",
                                width: 120
                            },
                        ],
                    });
                });

                function onDataBound(e) {
                    var grid = this;
                    grid.table.find("tr").each(function() {
                        var dataItem = grid.dataItem(this);
                        var themeColor = dataItem.Discontinued ? 'success' : 'error';
                        var text = dataItem.Discontinued ? 'available' : 'not available';

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
                }

                var categories = [{
                    "CategoryID": 1,
                    "CategoryName": "Beverages"
                }, {
                    "CategoryID": 2,
                    "CategoryName": "Condiments"
                }, {
                    "CategoryID": 3,
                    "CategoryName": "Confections"
                }, {
                    "CategoryID": 4,
                    "CategoryName": "Dairy Products"
                }, {
                    "CategoryID": 5,
                    "CategoryName": "Grains/Cereals"
                }, {
                    "CategoryID": 6,
                    "CategoryName": "Meat/Poultry"
                }, {
                    "CategoryID": 7,
                    "CategoryName": "Produce"
                }, {
                    "CategoryID": 8,
                    "CategoryName": "Seafood"
                }];
            </script>

            <style type="text/css">
                #example {
                    text-align: center !important;
                    font-size: 18px;
                    padding-right: 17px !important;
                    padding-left: 297px !important;
                    font-weight: 600;
                }

                .customer-photo {
                    display: inline-block;
                    width: 32px;
                    height: 32px;
                    border-radius: 50%;
                    background-size: 32px 35px;
                    background-position: center center;
                    vertical-align: middle;
                    line-height: 32px;
                    box-shadow: inset 0 0 1px #999, inset 0 0 10px rgba(0, 0, 0, .2);
                    margin-left: 5px;
                }

                .customer-name {
                    display: inline-block;
                    vertical-align: middle;
                    line-height: 32px;
                    padding-left: 3px;
                }

                .k-grid tr .checkbox-align {
                    text-align: center;
                    vertical-align: middle;
                }

                .product-photo {
                    display: inline-block;
                    width: 32px;
                    height: 32px;
                    border-radius: 50%;
                    background-size: 32px 35px;
                    background-position: center center;
                    vertical-align: middle;
                    line-height: 32px;
                    box-shadow: inset 0 0 1px #999, inset 0 0 10px rgba(0, 0, 0, .2);
                    margin-right: 5px;
                }

                .product-name {
                    display: inline-block;
                    vertical-align: middle;
                    line-height: 32px;
                    padding-left: 3px;
                }

                .k-rating-container .k-rating-item {
                    padding: 4px 0;
                }

                .k-rating-container .k-rating-item .k-icon {
                    font-size: 16px;
                }

                .dropdown-country-wrap {
                    display: flex;
                    flex-wrap: nowrap;
                    align-items: center;
                    white-space: nowrap;
                }

                .dropdown-country-wrap img {
                    margin-right: 10px;
                }

                #grid .k-grid-edit-row>td>.k-rating {
                    margin-left: 0;
                    width: 100%;
                }

                .k-widget {
                    text-align: center;

                }

                .k-input {
                    width: 18em;
                }

                .topbar .menu ul li .dropdown-menu a {
                    color: #ffffff;
                }
            </style>
    </div>
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'csrftoken': '{{ csrf_token() }}'
            }
        });
    </script>
    <script type="text/javascript">
        $('#Product').on('submit', function(e) {
            e.preventDefault();

            let prod_id = $('#prod_id').val();

            $.ajax({
                url: '{{ URL::to('pivotInvoice') }}',
                type: 'get',
                data: {
                    prod_id: prod_id,
                },
                success: function(data) {

                    $(document).ready(function() {
                        var crudServiceBaseUrl = "http://localhost:8080",
                            dataSource = new kendo.data.DataSource({
                                data: data,
                                batch: true,
                                pageSize: 25,
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
                                            id: {
                                                editable: false,
                                                nullable: true
                                            },
                                            prod_id: {
                                                editable: false,
                                                nullable: true
                                            },
                                            Uom_id: {
                                                editable: false,
                                                nullable: true
                                            },
                                            Quantity: {
                                                editable: false,
                                                nullable: true
                                            },
                                            Total_value: {
                                                editable: false,
                                                nullable: true
                                            },
                                            incentive_value: {
                                                editable: false,
                                                nullable: true
                                            },
                                            net_value: {
                                                editable: false,
                                                nullable: true
                                            },
                                            loading_number: {
                                                editable: false,
                                                nullable: true
                                            },
                                            salescall_details_id: {
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
                            height: 650,
                            editable: "incell",
                            pageable: true,
                            sortable: true,
                            navigatable: true,
                            resizable: true,
                            reorderable: true,
                            // groupable: true,
                            filterable: true,
                            dataBound: onDataBound,
                            toolbar: ["excel", "pdf", "search"],
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
                                    field: "id",
                                    title: "id",
                                    width: 70
                                },
                                {
                                    field: "prod_id",
                                    title: "prod_id",
                                    width: 120
                                },
                                {
                                    field: "Uom_id",
                                    title: "Uom_id",
                                    width: 120
                                },
                                {
                                    field: "Quantity",
                                    title: "Quantity",
                                    width: 120
                                },
                                {
                                    field: "Total_value",
                                    title: "Total_value",
                                    width: 120
                                },
                                {
                                    field: "incentive_value",
                                    title: "incentive_value",
                                    width: 120
                                },
                                {
                                    field: "net_value",
                                    title: "net_value",
                                    width: 120
                                },
                                {
                                    field: "loading_number",
                                    title: "loading_number",
                                    width: 120
                                },
                                {
                                    field: "salescall_details_id",
                                    title: "salescall_details_id",
                                    width: 120
                                },
                            ],
                        });
                    });

                    function onDataBound(e) {
                        var grid = this;
                        grid.table.find("tr").each(function() {
                            var dataItem = grid.dataItem(this);
                            var themeColor = dataItem.Discontinued ? 'success' : 'error';
                            var text = dataItem.Discontinued ? 'available' : 'not available';

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
                    }

                    var categories = [{
                        "CategoryID": 1,
                        "CategoryName": "Beverages"
                    }, {
                        "CategoryID": 2,
                        "CategoryName": "Condiments"
                    }, {
                        "CategoryID": 3,
                        "CategoryName": "Confections"
                    }, {
                        "CategoryID": 4,
                        "CategoryName": "Dairy Products"
                    }, {
                        "CategoryID": 5,
                        "CategoryName": "Grains/Cereals"
                    }, {
                        "CategoryID": 6,
                        "CategoryName": "Meat/Poultry"
                    }, {
                        "CategoryID": 7,
                        "CategoryName": "Produce"
                    }, {
                        "CategoryID": 8,
                        "CategoryName": "Seafood"
                    }];



                },
            });
        });
    </script>
    <script type="text/javascript">
        $('#multiple').on('submit', function(e) {
            e.preventDefault();

            let multiple = $('#multiple_select').val();

            $.ajax({
                url: '{{ URL::to('pivotInvoice') }}',
                type: 'get',
                data: {
                    multiple: multiple,
                },
                success: function(data) {

                    $(document).ready(function() {
                        var crudServiceBaseUrl = "http://localhost:8080",
                            dataSource = new kendo.data.DataSource({
                                data: data,
                                batch: true,
                                pageSize: 25,
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
                                            id: {
                                                editable: false,
                                                nullable: true
                                            },
                                            prod_id: {
                                                editable: false,
                                                nullable: true
                                            },
                                            Uom_id: {
                                                editable: false,
                                                nullable: true
                                            },
                                            Quantity: {
                                                editable: false,
                                                nullable: true
                                            },
                                            Total_value: {
                                                editable: false,
                                                nullable: true
                                            },
                                            incentive_value: {
                                                editable: false,
                                                nullable: true
                                            },
                                            net_value: {
                                                editable: false,
                                                nullable: true
                                            },
                                            loading_number: {
                                                editable: false,
                                                nullable: true
                                            },
                                            salescall_details_id: {
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
                            height: 650,
                            editable: "incell",
                            pageable: true,
                            sortable: true,
                            navigatable: true,
                            resizable: true,
                            reorderable: true,
                            // groupable: true,
                            filterable: true,
                            dataBound: onDataBound,
                            toolbar: ["excel", "pdf", "search"],
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
                                    field: "id",
                                    title: "id",
                                    width: 70
                                },
                                {
                                    field: "prod_id",
                                    title: "prod_id",
                                    width: 120
                                },
                                {
                                    field: "Uom_id",
                                    title: "Uom_id",
                                    width: 120
                                },
                                {
                                    field: "Quantity",
                                    title: "Quantity",
                                    width: 120
                                },
                                {
                                    field: "Total_value",
                                    title: "Total_value",
                                    width: 120
                                },
                                {
                                    field: "incentive_value",
                                    title: "incentive_value",
                                    width: 120
                                },
                                {
                                    field: "net_value",
                                    title: "net_value",
                                    width: 120
                                },
                                {
                                    field: "loading_number",
                                    title: "loading_number",
                                    width: 120
                                },
                                {
                                    field: "salescall_details_id",
                                    title: "salescall_details_id",
                                    width: 120
                                },
                            ],
                        });
                    });

                    function onDataBound(e) {
                        var grid = this;
                        grid.table.find("tr").each(function() {
                            var dataItem = grid.dataItem(this);
                            var themeColor = dataItem.Discontinued ? 'success' : 'error';
                            var text = dataItem.Discontinued ? 'available' : 'not available';

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
                    }

                    var categories = [{
                        "CategoryID": 1,
                        "CategoryName": "Beverages"
                    }, {
                        "CategoryID": 2,
                        "CategoryName": "Condiments"
                    }, {
                        "CategoryID": 3,
                        "CategoryName": "Confections"
                    }, {
                        "CategoryID": 4,
                        "CategoryName": "Dairy Products"
                    }, {
                        "CategoryID": 5,
                        "CategoryName": "Grains/Cereals"
                    }, {
                        "CategoryID": 6,
                        "CategoryName": "Meat/Poultry"
                    }, {
                        "CategoryID": 7,
                        "CategoryName": "Produce"
                    }, {
                        "CategoryID": 8,
                        "CategoryName": "Seafood"
                    }];



                },
            });
        });
    </script>
    <script type="text/javascript">
        $('#date').on('submit', function(e) {
            e.preventDefault();

            let Begindate = $('#Begindate').val();
            let endDate = $('#endDate').val();

            $.ajax({
                url: '{{ URL::to('pivotInvoice') }}',
                type: 'get',
                data: {
                    endDate: endDate,
                    Begindate: Begindate
                },
                success: function(data) {

                    $(document).ready(function() {
                        var crudServiceBaseUrl = "http://localhost:8080",
                            dataSource = new kendo.data.DataSource({
                                data: data,
                                batch: true,
                                pageSize: 25,
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
                                            id: {
                                                editable: false,
                                                nullable: true
                                            },
                                            prod_id: {
                                                editable: false,
                                                nullable: true
                                            },
                                            Uom_id: {
                                                editable: false,
                                                nullable: true
                                            },
                                            Quantity: {
                                                editable: false,
                                                nullable: true
                                            },
                                            Total_value: {
                                                editable: false,
                                                nullable: true
                                            },
                                            incentive_value: {
                                                editable: false,
                                                nullable: true
                                            },
                                            net_value: {
                                                editable: false,
                                                nullable: true
                                            },
                                            loading_number: {
                                                editable: false,
                                                nullable: true
                                            },
                                            salescall_details_id: {
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
                            height: 650,
                            editable: "incell",
                            pageable: true,
                            sortable: true,
                            navigatable: true,
                            resizable: true,
                            reorderable: true,
                            // groupable: true,
                            filterable: true,
                            dataBound: onDataBound,
                            toolbar: ["excel", "pdf", "search"],
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
                                    field: "id",
                                    title: "id",
                                    width: 70
                                },
                                {
                                    field: "prod_id",
                                    title: "prod_id",
                                    width: 120
                                },
                                {
                                    field: "Uom_id",
                                    title: "Uom_id",
                                    width: 120
                                },
                                {
                                    field: "Quantity",
                                    title: "Quantity",
                                    width: 120
                                },
                                {
                                    field: "Total_value",
                                    title: "Total_value",
                                    width: 120
                                },
                                {
                                    field: "incentive_value",
                                    title: "incentive_value",
                                    width: 120
                                },
                                {
                                    field: "net_value",
                                    title: "net_value",
                                    width: 120
                                },
                                {
                                    field: "loading_number",
                                    title: "loading_number",
                                    width: 120
                                },
                                {
                                    field: "salescall_details_id",
                                    title: "salescall_details_id",
                                    width: 120
                                },
                            ],
                        });
                    });

                    function onDataBound(e) {
                        var grid = this;
                        grid.table.find("tr").each(function() {
                            var dataItem = grid.dataItem(this);
                            var themeColor = dataItem.Discontinued ? 'success' : 'error';
                            var text = dataItem.Discontinued ? 'available' : 'not available';

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
                    }

                    var categories = [{
                        "CategoryID": 1,
                        "CategoryName": "Beverages"
                    }, {
                        "CategoryID": 2,
                        "CategoryName": "Condiments"
                    }, {
                        "CategoryID": 3,
                        "CategoryName": "Confections"
                    }, {
                        "CategoryID": 4,
                        "CategoryName": "Dairy Products"
                    }, {
                        "CategoryID": 5,
                        "CategoryName": "Grains/Cereals"
                    }, {
                        "CategoryID": 6,
                        "CategoryName": "Meat/Poultry"
                    }, {
                        "CategoryID": 7,
                        "CategoryName": "Produce"
                    }, {
                        "CategoryID": 8,
                        "CategoryName": "Seafood"
                    }];



                },
            });
        });
    </script>
    <script type="text/javascript">
        $('#UOM').on('submit', function(e) {
            e.preventDefault();

            let UOM_id = $('#UOM_id').val();

            $.ajax({
                url: '{{ URL::to('pivotInvoice') }}',
                type: 'get',
                data: {
                    UOM_id: UOM_id,
                },
                success: function(data) {

                    $(document).ready(function() {
                        var crudServiceBaseUrl = "http://localhost:8080",
                            dataSource = new kendo.data.DataSource({
                                data: data,
                                batch: true,
                                pageSize: 25,
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
                                            id: {
                                                editable: false,
                                                nullable: true
                                            },
                                            prod_id: {
                                                editable: false,
                                                nullable: true
                                            },
                                            Uom_id: {
                                                editable: false,
                                                nullable: true
                                            },
                                            Quantity: {
                                                editable: false,
                                                nullable: true
                                            },
                                            Total_value: {
                                                editable: false,
                                                nullable: true
                                            },
                                            incentive_value: {
                                                editable: false,
                                                nullable: true
                                            },
                                            net_value: {
                                                editable: false,
                                                nullable: true
                                            },
                                            loading_number: {
                                                editable: false,
                                                nullable: true
                                            },
                                            salescall_details_id: {
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
                            height: 650,
                            editable: "incell",
                            pageable: true,
                            sortable: true,
                            navigatable: true,
                            resizable: true,
                            reorderable: true,
                            // groupable: true,
                            filterable: true,
                            dataBound: onDataBound,
                            toolbar: ["excel", "pdf", "search"],
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
                                    field: "id",
                                    title: "id",
                                    width: 70
                                },
                                {
                                    field: "prod_id",
                                    title: "prod_id",
                                    width: 120
                                },
                                {
                                    field: "Uom_id",
                                    title: "Uom_id",
                                    width: 120
                                },
                                {
                                    field: "Quantity",
                                    title: "Quantity",
                                    width: 120
                                },
                                {
                                    field: "Total_value",
                                    title: "Total_value",
                                    width: 120
                                },
                                {
                                    field: "incentive_value",
                                    title: "incentive_value",
                                    width: 120
                                },
                                {
                                    field: "net_value",
                                    title: "net_value",
                                    width: 120
                                },
                                {
                                    field: "loading_number",
                                    title: "loading_number",
                                    width: 120
                                },
                                {
                                    field: "salescall_details_id",
                                    title: "salescall_details_id",
                                    width: 120
                                },
                            ],
                        });
                    });

                    function onDataBound(e) {
                        var grid = this;
                        grid.table.find("tr").each(function() {
                            var dataItem = grid.dataItem(this);
                            var themeColor = dataItem.Discontinued ? 'success' : 'error';
                            var text = dataItem.Discontinued ? 'available' : 'not available';

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
                    }

                    var categories = [{
                        "CategoryID": 1,
                        "CategoryName": "Beverages"
                    }, {
                        "CategoryID": 2,
                        "CategoryName": "Condiments"
                    }, {
                        "CategoryID": 3,
                        "CategoryName": "Confections"
                    }, {
                        "CategoryID": 4,
                        "CategoryName": "Dairy Products"
                    }, {
                        "CategoryID": 5,
                        "CategoryName": "Grains/Cereals"
                    }, {
                        "CategoryID": 6,
                        "CategoryName": "Meat/Poultry"
                    }, {
                        "CategoryID": 7,
                        "CategoryName": "Produce"
                    }, {
                        "CategoryID": 8,
                        "CategoryName": "Seafood"
                    }];



                },
            });
        });
    </script>
    <script>
        $(document).on('change', '#CompanyAjax, #BranchAjax', function() {
            
            var Branch  = $('#BranchAjax').val();
            var Company = $('#CompanyAjax').val();
            
            // console.log(id);
            // $("#dele").val(id);
            // var hid = document.getElementById("hid1").value;
            // $("#hid1").val(hid + id + ",");
            // var price = $(this).parent().parent().parent().find(".price");
            // var deliviry_time = $(this).parent().parent().parent().find(".deliviry_time");
            // var old_price = price.val();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'get',
                url: '{{ URL::to('pivotInvoice') }}',
                dataType: 'json',
                data: {
                    Branch: Branch,
                    Company:Company,
                },
                success: function(response) {

                    
                    // var cost = document.getElementById("totalcosthidden").value;
                    // if (old_price) {
                    //     res = parseInt(cost) + parseInt(response.price) - parseInt(old_price);
                    //     $(".total_cost").val(res);
                    //     $(".totalcosthidden").val(res);
                    // } else {
                    //     res = parseInt(cost) + parseInt(response.price);
                    //     $(".total_cost").val(res);
                    //     $(".totalcosthidden").val(res);
                    // }


                    // price.val(response.price);
                    // console.log(price.val());

                    // deliviry_time.val(response.deliviry_time);

                }
            });

        });
    </script>
@endsection
