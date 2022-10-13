@extends('layout.pivotindex')
@section('title', 'Dev Andriod Support')
@section('content')

    <body>
        <div id="example">
            <div class="col-md-12">
                <div class="col-md-3 ">
                    <label for="salesrep_id">SalesRep Id</labeL>
                    <input type="text" name="salesrep_id" id="salesrep_id" style="color:black">
                </div>
                <div class="col-md-3">
                    <label for="salesrep_id">POS Code</labeL>
                    <input type="text" name="posCode" id="posCode" style="color:black">
                </div>
            </div>
            <div class=" col-md-2 col-sm-3  p-3">
                <button class="btn btn-success col-md-12 col-sm-12" id="runCode" name="runCode"
                    onClick="sendParamter('فتح احداثيات')">فتح احداثيات</button>
            </div>
            <div class=" col-md-2 col-sm-3  p-3">
                <button class="btn btn-success col-md-12 col-sm-12" id="runCode" name="runCode"
                    onClick="sendParamter('set param_val = 0 where param_id = 16')">فتح الزيارات الخارجية بدون انهاء
                    خط السير </button>
            </div>
            <div class=" col-md-2 col-sm-3  p-3">
                <button class="btn btn-success col-md-12 col-sm-12" id="runCode" name="runCode"
                    onClick="sendParamter('set param_val = 999 where param_id = 10')">زيادة عدد الزيارات
                    الخارجية</button>
            </div>
            <div class=" col-md-2 col-sm-3 p-3">
                <button class="btn btn-success col-md-12 col-sm-12" id="runCode" name="runCode"
                    onClick="sendParamter('set param_val = 0 where param_id = 13')">الغاء باقى عملاء خط
                    السير</button>
            </div>
            <div class=" col-md-2 col-sm-3 p-3">
                <button class="btn btn-success col-md-12 col-sm-12" id="runCode" name="runCode"
                    onClick="sendParamter('تحديث محلات')">تحديث محلات</button>
            </div>
            <div class=" col-md-2 col-sm-3 p-3">
                <button class="btn btn-success col-md-12 col-sm-12" id="runCode" name="runCode"
                    onClick="sendParamter('set param_val = 0 where param_id = 22')">فتح الغاء فاتورة بدون حافز </button>
            </div>
            <div class=" col-md-2 col-sm-3 p-3">
                <button class="btn btn-success col-md-12 col-sm-12" id="runCode" name="runCode"
                    onClick="sendParamter('set param_val = 1 where param_id = 22')">اغلاق الغاء فاتورة بدون حافز </button>
            </div>
            <div class=" col-md-2 col-sm-3 p-3">
                <button class="btn btn-success col-md-12 col-sm-12" id="runCode" name="runCode"
                    onClick="sendParamter('set param_val = 0 where param_id = 18')">فتح الغاء فاتورة بحافز </button>
            </div>
            <div class=" col-md-2 col-sm-3 p-3">
                <button class="btn btn-success col-md-12 col-sm-12" id="runCode" name="runCode"
                    onClick="sendParamter('set param_val = 0 where param_id = 18')">اغلاق الغاء فاتورة بحافز </button>
            </div>
            <div class=" col-md-2 col-sm-3 p-3">
                <button class="btn btn-success col-md-12 col-sm-12" id="runCode" name="runCode"
                    onClick="sendParamter('set PAY_FORCE = 0')">ايقاف حافز ثابت</button>
            </div>
            <div class=" col-md-2 col-sm-3 p-3">
                <button class="btn btn-success col-md-12 col-sm-12" id="runCode" name="runCode"
                    onClick="sendParamter('target')">ارسال الاهداف</button>
            </div>
            <div class=" col-md-2 col-sm-3 p-3">
                <button class="btn btn-success col-md-12 col-sm-12" id="runCode" name="runCode"
                    onClick="sendParamter('INCENTIVE_GRAD_DEATILS')">ارسال INCENTIVE_GRAD_DEATILS</button>
            </div>
            <div class=" col-md-2 col-sm-3 p-3">
                <button class="btn btn-success col-md-12 col-sm-12" id="runCode" name="runCode"
                    onClick="sendParamter('FIXED_INCENTIVE_DETAILS')">ارسال حوافز ثابتة (FIX)</button>
            </div>
            <div class=" col-md-2 col-sm-3 p-3">
                <button class="btn btn-success col-md-12 col-sm-12" id="runCode" name="runCode"
                    onClick="sendParamter('INCENTIVE_MIX')"> ارسال حوافز فورية (MIX) </button>
            </div>
            <div class=" col-md-2 col-sm-3 p-3">
                <button class="btn btn-success col-md-12 col-sm-12" id="runCode" name="runCode"
                    onClick="sendParamter('set param_val = 1 where param_id = 25')">فتح أضافة بيع المندوب تجزئة</button>
            </div>
            <div class=" col-md-2 col-sm-3 p-3">
                <button class="btn btn-success col-md-12 col-sm-12" id="runCode" name="runCode"
                    onClick="sendParamter('set param_val = 0 where param_id = 15')">فتح Near (N)</button>
            </div>
            <div class=" col-md-2 col-sm-3 p-3">
                <button class="btn btn-success col-md-12 col-sm-12" id="runCode" name="runCode"
                    onClick="sendParamter('set param_val = 1 where param_id = 33')">فتح GPS</button>
            </div>
            <div class=" col-md-2 col-sm-3 p-3">
                <button class="btn btn-success col-md-12" id="runCode" name="runCode"
                    onClick="sendParamter('set param_val = 1 where param_id = 41')">فتح تعديل المخزون لمناديب العير
                    مباشر</button>
            </div>
            <br>
            <div class=" col-md-3 p-3">
                <button class="btn btn-success col-md-12" id="submit" value="search"
                    onClick="sendParamter('search')">Search</button>
            </div>
        </div>

    </body>

    <style>
        #example {
            font-size: 18px;
            font-weight: 600;
            margin: 1em 0 0px;
            padding-left: 25rem;
        }

        .k-widget {
            text-align: center;
            margin-left: 275px;
            font-size: 11px !important;
        }



        .k-floatwrap {
            display: none;
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

        .topbar .menu ul li .dropdown-menu a {
            color: #ffffff;
        }

        .k-floatwrap {
            margin-left: 0px;
        }

        .k-footer-template {
            display: none;
        }

        #runCode {
            font-size: 13px;
            font-weight: 900;
        }

        @media screen and (max-width: 1000px) and (min-width:0px) {
            #example {
                padding-left: 0rem;
            }

            .k-widget {

                margin-left: 275px;
            }
        }
    </style>
    <div id="grid" class=""></div>
    <script>
        function sendParamter(e) {
            var salesRepId = document.getElementById('salesrep_id').value;
            if (e == 'فتح احداثيات') {
                var posCode = "Missing POS";
                var posCode = document.getElementById('posCode').value;
                if (posCode) {
                    var tabName = 'POS';
                    var runCode = ` set LONGITUDE = 0, LATITUDE = 0 where POS_CODE = " ` + posCode + `"`;
                }
            } else if (e == 'تحديث محلات') {
                var runCode = 'تحديث محلات';
            } else if (e == 'set PAY_FORCE = 0') {
                var tabName = "FIXED_INCENTIVE_DETAILS"
                var runCode = e
            } else if (e == 'target') {
                var tabName = "TARGET"
                var runCode = null
            } else if (e == 'INCENTIVE_GRAD_DEATILS') {
                var tabName = e
                var runCode = null
            } else if (e == 'FIXED_INCENTIVE_DETAILS') {
                var tabName = e
                var runCode = null
            } else if (e == 'INCENTIVE_MIX') {
                var tabName = e
                var runCode = null
            } else {
                var tabName = 'PARAMETERS';
                var runCode = e;
            }

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'get',
                url: '{{ route('DevAndriodInvoice') }}',
                dataType: 'json',
                data: {
                    salesRepId: salesRepId,
                    runCode: runCode,
                    tabName: tabName,
                    posCode: posCode,
                },
                beforeSend: function() {
                    $("body").addClass("loading");
                    $('body').css('cursor', 'wait');
                },
                success: function(data) {
                    $('body').css('cursor', 'auto');
                    $("body").removeClass("loading");

                    if (data['result'] == "Missing Paramters") {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Missing Paramter!',
                        })
                    } else if (data['result'] == "Missing POS") {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'يرجى ادخال رقم العميل!',
                        });
                    } else {
                        $(document).ready(function() {
                            var crudServiceBaseUrl = "http://localhost:8080",
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
                                        field: "salesrep_id",
                                        title: "Sales Rep",
                                        width: 30
                                    },
                                    {
                                        field: "tab_name",
                                        title: "Tab Name",
                                        width: 50
                                    },
                                    {
                                        field: "run_code",
                                        title: "Run Code",
                                        width: 130
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
                                        field: "hh_upp_date",
                                        title: "HH UPP DATE",
                                        width: 100
                                    },
                                    {
                                        field: "user_iud",
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
        }
    </script>
@endsection
