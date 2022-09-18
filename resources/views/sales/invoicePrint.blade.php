@extends('layout.pivotindex')
@section('title', 'Print Invoice')
@section('content')

    <body>
        <div></div>
        <div id="myDiv" style="display:none">
            <div class='col-md-12'>
                <div class='col-md-6'>
                    <div class="col-md-4">
                        <label>DSR DATE:</label>
                    </div>
                    <div class="col-md-8">
                        <input type="text" name="totalInvoicesCount" id=" " class="form-control" placeholder=""
                            style="color:black">
                    </div>
                    <div class="col-md-4">
                        <label>Sales Territory:</label>
                    </div>
                    <div class="col-md-8">
                        <input type="text" name="totalInvoicesCount" id="totalInvoicesCount" class="form-control"
                            placeholder="" style="color:black">
                    </div>
                    <div class="col-md-4">
                        <label>Salesrep Name:</label>
                    </div>
                    <div class="col-md-8">
                        <input type="text" name="totalInvoicesCount" id="totalInvoicesCount" class="form-control"
                            placeholder="" style="color:black">
                    </div>
                </div>
            </div>
        </div>
        <div id="example">
            <input type="button" onclick="PrintDiv();" value="Print" />
            <div class="col-md-12">
                <div class="col-md-3">
                    <div class="col-md-4">
                        <label for="multiple">Region</label>
                    </div>
                    <div class="col-md-8">
                        <select class="selectpicker" multiple data-live-search="true" name="multiple" id="BranchAjax"
                            data-actions-box="true">
                            @foreach ($branches as $branch)
                                <option value="{{ $branch->branch_code }}" name="multiple_select" id="BranchAjax">
                                    {{ $branch->branch_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="col-md-4">
                        <label for="multiple">Company</label>
                    </div>
                    <div class="col-md-8">
                        <select class="selectpicker" multiple data-live-search="true" name="multiple" id="CompanyAjax"
                            data-actions-box="true">
                            @foreach ($companies as $company)
                                <option value="{{ $company->company_id }}" name="multiple_select" id="CompanyAjax">
                                    {{ $company->company_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="col-md-4">
                        <label for="multiple">Sales Terr</label>
                    </div>
                    <div class="col-md-8">
                        <select class="selectpicker SalesTerrAjax" multiple data-live-search="true" name="multiple"
                            data-actions-box="true" id="SalesTerrAjax">
                            <option value="1" name="SalesTerrAjax multiple_select" id="SalesTerrAjax">1</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="col-md-4">
                        <label for="multiple">Sales Men</label>
                    </div>
                    <div class="col-md-8">
                        <select class="selectpicker SalesMenAjax" multiple data-live-search="true" name="multiple"
                            id="SalesMenAjax" data-actions-box="true">
                        </select>
                    </div>
                </div>
            </div>

            <form id="Product">
                <div class="col-md-12" style="margin:30px">
                    <div class="form-group col-md-3">
                        <div class="col-md-4">
                            <label>Begin Date</label>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <div class='input-group date' id='datetimepicker1'>
                                    <input type='text' class="form-control" name="Begindate" id="Begindate" />
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-md-3">
                        <div class="col-md-4">
                            <label>End Date</label>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <div class='input-group date' id='datetimepicker2'>
                                    <input type='text' class="form-control" name="endDate" id="endDate" />
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="col-md-4">
                            <label>By Account</label>
                        </div>
                        <div class="col-md-8">
                            <select class="selectpicker" multiple data-live-search="true" name="multiple" id="Account"
                                data-actions-box="true">
                                @foreach ($accounts as $account)
                                    <option value="{{ $account->acc_id }}" name="multiple_select" id="Account">
                                        {{ $account->acc_desc }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group col-md-3">
                        <button class="btn btn-success" id="submit" style="font-size:26px">Search</button>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group col-md-3">
                        <div class="col-md-4">
                            <label>OR Invoice ID</label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" name="invoice" class="form-control" placeholder="Enter Invoice Id"
                                id="invoice" style="color:black">
                        </div>
                        <span class="text-danger" id="name-error"></span>
                    </div>
                    <div class="form-group col-md-3">
                        <div class="col-md-4">
                            <label>OR SalesRep ID</label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" name="sales_rep" class="form-control" placeholder="Enter Sales Rep ID"
                                id="sales_rep" style="color:black">
                        </div>
                        <span class="text-danger" id="name-error"></span>
                    </div>
                    <div class="form-group col-md-3">
                        <div class="col-md-4">
                            <label>OR POS_CODE</label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" name="pos_code" class="form-control" placeholder="Enter POS ID"
                                id="pos_code" style="color:black">
                        </div>
                        <span class="text-danger" id="name-error"></span>
                    </div>
                    <div class="form-group col-md-3">
                        <div class="col-md-4">
                            <label>Invoice Count</label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" name="totalInvoicesCount" id="totalInvoicesCount" class="form-control"
                                placeholder="" style="color:black">
                        </div>
                        <span class="text-danger" id="name-error"></span>
                    </div>
                </div>
            </form>
        </div>

    </body>
    <script>
        $(document).on('change', '#CompanyAjax, #BranchAjax', function() {

            var Branch = $('#BranchAjax').val();
            var Company = $('#CompanyAjax').val();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'get',
                url: '{{ route('SalesTerr') }}',
                dataType: 'json',
                data: {
                    Branch: Branch,
                    Company: Company,
                },
                success: function(response) {
                    if (response.length > 0) {

                        $('#SalesTerrAjax').empty();
                        $('#SalesTerrAjax .dropdown-menu .inner .show li .dropdown-item').empty();
                        alert('hi');
                        select = document.getElementById('SalesTerrAjax');
                        var opt = document.createElement('option');
                        opt.innerHTML = '';
                        opt.value = '';
                        select.appendChild(opt);
                        for (i = 0; i < response.length; i++) {
                            var opt = document.createElement('option');
                            opt.innerHTML = response[i]['name'];
                            opt.value = response[i]['sales_ter_id'];
                            select.appendChild(opt);
                        }
                        //  $('#SalesTerrAjax').html("");
                        // $('.SalesMenAjax').html("");
                        //     $('.SalesTerrAjax').append(`
                    //             <select class="selectpicker SalesTerrAjax" multiple data-live-search="true" id="SalesTerrAjax" name="multiple"
                    //           data-actions-box="true" ></select>
                    //  `);

                        // for (let i = 0; i < response.length; i++) {
                        //     var sales_terr_id = response[i].sales_ter_id;
                        //     var name = response[i].name;
                        //     var option =
                        //         "<option name='multiselect' id='SalesTerrAjax' style='color:black' value='" +
                        //         sales_terr_id + "'>" +
                        //         name + "</option>";
                        //     $('.SalesTerrAjax').append(option);
                        //     // $(".SalesTerrAjax").append(option);

                        // }
                        // $('.selectpicker').selectpicker('refresh');
                        //  $(".SalesTerrAjax").append(`</select>`);
                    }
                }
            });

        });
    </script>
    <script>
        $(document).on('change', '#SalesTerrAjax', function() {

            var SalesTerrId = $('#SalesTerrAjax').val();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'get',
                url: '{{ route('SalesManTerr') }}',
                dataType: 'json',
                data: {
                    SalesTerrId: SalesTerrId,
                },
                success: function(response) {

                    if (response.length > 0) {
                        $('.SalesMenAjax').html("");
                        $('.SalesMenAjax').append(`
                                <select class="selectpicker SalesMenAjax" multiple data-live-search="true" name="SalesMenAjax"
                                    id="SalesMenAjax">
                    `);
                        for (let i = 0; i < response.length; i++) {
                            var sales_id = response[i].sales_id;
                            var name = response[i].salesrep_name;
                            var option = "<option style='color:black' value='" + sales_id + "'>" +
                                name + "</option>";
                            $(".SalesMenAjax").append(option);

                        }
                        $(".SalesMenAjax").append(`</select>`);
                    }
                }
            });

        });
    </script>
    <div id="grid" class=""></div>
    <div class="example" id="InvoicesTotal">
        <div class="col-md-12" style="padding:2.7em 0 0 20em">
            <div class="form-group col-md-3">
                <div class="col-md-5">
                    <label>Total Invoice</label>
                </div>
                <div class="col-md-7">
                    <input type="text" name="totalInvoice" id="totalInvoice" class="form-control" value=""
                        style="color:black">
                </div>
            </div>
            <div class="form-group col-md-3">
                <div class="col-md-5">
                    <label>Total Incentive</label>
                </div>
                <div class="col-md-7">
                    <input type="text" name="totalIncentiveAmount" id="totalIncentiveAmount" class="form-control"
                        value="" style="color:black">
                </div>
            </div>
            <div class="form-group col-md-3">
                <div class="col-md-5">
                    <label>Total Tax </label>
                </div>
                <div class="col-md-7">
                    <input type="text" name="totalTaxAmount" id="totalTaxAmount" class="form-control" value=""
                        style="color:black">
                </div>
            </div>
            <div class="form-group col-md-3">
                <div class="col-md-5">
                    <label>Total Net Amount</label>
                </div>
                <div class="col-md-7">
                    <input type="text" name="totalNetAmount" id="totalNetAmount" class="form-control" value=""
                        style="color:black">
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            var crudServiceBaseUrl = "http://localhost:8080",
                dataSource = new kendo.data.DataSource({
                    transport: {
                        read: {
                            url: crudServiceBaseUrl + "/SalesPrintInvoice",
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
                    pageSize: 100000000000000,
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
                pageable: true,
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
                        field: "salesrep_id",
                        title: "Sales Rep",
                        width: 100
                    },
                    {
                        field: "salescall_id",
                        title: "Sales Call",
                        width: 120
                    },
                    {
                        field: "salescall_details_id",
                        title: "Invoice",
                        width: 120
                    },
                    {
                        field: "pos_code",
                        title: "POS ",
                        width: 120
                    },
                    {
                        field: "pos_name",
                        title: "pos_name",
                        width: 120
                    },
                    {
                        field: "visit_start_time",
                        title: "Start Time",
                        width: 170
                    },
                    {
                        field: "total_invoice",
                        title: "Total Invoice",
                        width: 120
                    },
                    {
                        field: "incentive_amount",
                        title: "Incentive Amount",
                        width: 140
                    },
                    {
                        field: "tax_amount",
                        title: "Tax Amount",
                        width: 120
                    },
                    {
                        field: "net_amout",
                        title: "Net Amount",
                        width: 120
                    },
                    {
                        field: "category_id",
                        title: "Category",
                        width: 90
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
    <script type="text/javascript">
        $('#Product').on('submit', function(e) {
            e.preventDefault();

            let invoice_id = $('#invoice').val();
            let pos_code = $('#pos_code').val();
            let sales_rep = $('#sales_rep').val();
            let endDate = $('#endDate').val();
            let Begindate = $('#Begindate').val();
            let SalesMen = $('#SalesMenAjax').val();
            let Account = $('#Account').val();

            var $loading = $('#loader').hide();
            $(document)
                .ajaxStart(function() {
                    $loading.show();
                });

                jQuery.ajax({
                url: '{{ URL::to('SalesPrintInvoice') }}',
                type: 'get',
                async: true,
                loader: true,
                data: {
                    invoice_id: invoice_id,
                    pos_code: pos_code,
                    sales_rep: sales_rep,
                    Begindate: Begindate,
                    endDate: endDate,
                    SalesMen: SalesMen,
                    Account: Account,
                },
                success: function(data) {
                    document.getElementById('totalInvoicesCount').value = data['totalInvoicesCount']
                    if (data['totalTotalValue'] > 0) {
                        document.getElementById('totalInvoice').value = data['totalTotalValue']
                    }
                    if (data['totalTotalValue'] > 0) {
                        document.getElementById('totalIncentiveAmount').value = data[
                            'totalIncentiveAmount']
                    }
                    if (data['totalTotalValue'] > 0) {
                        document.getElementById('totalTaxAmount').value = data['totalTaxAmount']
                    }
                    if (data['totalTotalValue'] > 0) {
                        document.getElementById('totalNetAmount').value = data['totalNetAmount']
                    }
                    $(document).ready(function() {
                        var crudServiceBaseUrl = "http://localhost:8080",
                            dataSource = new kendo.data.DataSource({
                                data: data['PrintInvoiceResult'],
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
                            pageable: true,
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
                                    field: "salesrep_id",
                                    title: "Sales Rep",
                                    width: 100
                                },
                                {
                                    field: "salescall_id",
                                    title: "Sales Call",
                                    width: 120
                                },
                                {
                                    field: "salescall_details_id",
                                    title: "Invoice",
                                    width: 120
                                },
                                {
                                    field: "pos_code",
                                    title: "POS ID",
                                    width: 120
                                },
                                {
                                    field: "pos_name",
                                    title: "POS NAME",
                                    width: 120
                                },
                                {
                                    field: "visit_start_time",
                                    title: "Start Time",
                                    width: 170
                                },
                                {
                                    field: "total_invoice",
                                    title: "Total Invoice",
                                    width: 120
                                },
                                {
                                    field: "incentive_amount",
                                    title: "Incentive Amount",
                                    width: 140
                                },
                                {
                                    field: "tax_amount",
                                    title: "Tax Amount",
                                    width: 120
                                },
                                {
                                    field: "net_amount",
                                    title: "Net Amount",
                                    width: 120
                                },
                                {
                                    field: "category_id",
                                    title: "Category",
                                    width: 90
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
                    };
                },
            });
        });
    </script>
    <style type="text/css">
        #example {
            font-size: 18px;
            padding-left: 14em !important;
            font-weight: 600;
            margin: 1em 0 0px;
        }

        label {
            font-size: 15px;
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
            margin-left: 275px;
            width: 100%;
        }

        .k-widget {
            text-align: center;
            margin-left: 275px;
        }

        .k-input {
            width: 18em;
        }

        .topbar .menu ul li .dropdown-menu a {
            color: #ffffff;
        }

        .k-floatwrap {
            margin-left: 0px;
        }

        .k-footer-template {
            display: none;
        }
    </style>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.7.14/js/bootstrap-datetimepicker.min.js">
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
    <script type="text/javascript">
        function PrintDiv() {
            var divContents = document.getElementById("myDiv").innerHTML;
            var InvoicesTotal = document.getElementById("InvoicesTotal").innerHTML;
            var printWindow = window.open('', '', 'height=200,width=1200');
            printWindow.document.write('<html><head><title>Print Total Daily Sales</title>');
            printWindow.document.write('</head><body >');
            printWindow.document.write(divContents);
            .printWindow.document.write(InvoicesTotal);
            printWindow.document.write('</body></html>');
            printWindow.document.close();
            printWindow.print();
        }
    </script>
@endsection
