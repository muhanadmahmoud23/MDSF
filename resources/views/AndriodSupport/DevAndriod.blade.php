@extends('layout.pivotindex')
@section('title', 'Dev Andriod Support')
@section('content')



    <div class="main divAndroidSuport">
        <div class="main-content container-fluid">
            <div class="header-top">
                <p class="SideBarTitle info">@yield('title')</p>

            </div>
            <div class="row mb-3">
                <div class="col-md-3 col-12">
                    <label for="Region" class="form-label">Region</labeL>
                    <select class="form-select form-select-lg" aria-label="Default select example" id="Region">
                        <option value="0" selected disable>Select Region</option>
                        @foreach ($regions as $region)
                            <option value="{{ $region->branch_code }}">{{ $region->branch_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3 col-12">
                    <label for="salesrep_id" class="form-label">SalesRep Id</labeL>
                    <input class="form-control" min="0" type="number" name="salesrep_id" id="salesrep_id"
                        placeholder="Enter sales Code..">
                </div>
                <div class="col-md-3 col-12">
                    <label for="posCode" class="form-label posCodeLable">POS Code
                        <span class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="" id="flexSwitchCheckChed">
                            <label for="flexSwitchCheckChed" class="flexSwitchCheckChed"> ALL</label>
                        </span>
                    </labeL>

                    <input class="form-control" type="text" name="posCode" id="posCode"
                        placeholder="Enter like = 111_1111">
                </div>
                <div class="col-md-3 col-12 mb-3">
                    <label for="credit_limit">قيمة الأئتمان </labeL>
                    <input type="text" class="form-control" name="credit_limit" id="credit_limit"
                        placeholder="Enter like = 50000">
                </div>
                <div class="col-md-3 col-12 mb-3">
                    <select class="form-select form-select-lg" aria-label="Default select example" id="tablename">
                        @foreach ($tablenames as $tablename)
                            <option value="{{ $tablename->sfa_tablename }}">{{ $tablename->sfa_tablename }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6 col-12 mb-3">
                    <input type="text" class="form-control" name="runCodeQuery" id="runCodeQuery"
                        placeholder="(Run Code) like= set param_val=0 where oaram_id=0"
                        value="set param_val = 0 where param_id = 0">
                </div>
                <div class="col-md-3 col-12">
                    <button class="btn btn-outline-success w-100" id="Query" name="Query"
                        onClick="sendParamter('Query')">Send
                    </button>
                </div>
            </div>
            <div class="row">
                <div class=" col-md-3 col-6 mb-3 ">
                    <button class="btn btn-success w-100" id="runCode" name="runCode"
                        onClick="sendParamter('فتح احداثيات')">فتح
                        احداثيات</button>
                </div>
                <div class=" col-md-3 col-6 mb-3 ">
                    <button class="btn btn-success w-100" id="runCode" name="runCode"
                        onClick="sendParamter('فتح احداثيات جميع العملاء')">
                        فتح احداثيات جميع العملاء
                    </button>
                </div>
                <div class=" col-md-3 col-6 mb-3">
                    <button class="btn btn-success w-100" id="runCode" name="runCode"
                        onClick="sendParamter('الزيارات الخارجية')">فتح الزيارات الخارجية</button>
                </div>
                <div class="col-md-3 col-6 mb-3">
                    <button class="btn btn-success w-100" id="runCode" name="runCode"
                        onClick="sendParamter('عودة')">عودة</button>
                </div>
                <div class="col-md-3 col-6 mb-3">
                    <button class="btn btn-success w-100" id="runCode" name="runCode"
                        onClick="sendParamter('تحديث محلات')">تحديث محلات</button>
                </div>
                <div class=" col-md-3 col-6 mb-3">
                    <button class="btn btn-success w-100" id="runCode" name="runCode"
                        onClick="sendParamter('الغاء فاتورة بدون حافز')"> الغاء فاتورة بدون حافز
                    </button>
                </div>
                <div class=" col-md-3 col-6 mb-3">
                    <button class="btn btn-success w-100" id="runCode" name="runCode"
                        onClick="sendParamter('الغاء فاتورة بحافز')"> الغاء فاتورة بحافز </button>
                </div>
                <div class=" col-md-3 col-6 mb-3">
                    <button class="btn btn-success w-100 " id="runCode" name="runCode"
                        onClick="sendParamter('FIXED_INCENTIVE_DETAILS')">ايقاف حافز ثابت</button>
                </div>
                <div class=" col-md-3 col-6 mb-3">
                    <button class="btn btn-success w-100 " id="runCode" name="runCode"
                        onClick="sendParamter('target')">ارسال
                        الاهداف</button>
                </div>
                <div class=" col-md-3 col-6 mb-3">
                    <button class="btn btn-success w-100" id="runCode" name="runCode"
                        onClick="sendParamter('INCENTIVE_GRAD_DEATILS')">SEND GRAD</button>
                </div>
                <div class=" col-md-3 col-6 mb-3">
                    <button class="btn btn-success w-100" id="runCode" name="runCode"
                        onClick="sendParamter('FIX')">(FIX)</button>
                </div>
                <div class=" col-md-3 col-6 mb-3">
                    <button class="btn btn-success w-100 " id="runCode" name="runCode"
                        onClick="sendParamter('INCENTIVE_MIX')">
                        ارسال حوافز فورية (MIX) </button>
                </div>
                <div class=" col-md-3 col-6 mb-3">
                    <button class="btn btn-success w-100" id="runCode" name="runCode"
                        onClick="sendParamter('فتح أضافة بيع')">فتح أضافة بيع
                    </button>
                </div>
                <div class=" col-md-3 col-6 mb-3">
                    <button class="btn btn-success w-100" id="runCode" name="runCode"
                        onClick="sendParamter('GPS & Near')">GPS & Near</button>
                </div>
                <div class=" col-md-3 col-6 mb-3">
                    <button class="btn btn-success w-100 " id="runCode" name="runCode"
                        onClick="sendParamter('فتح التحميل للغير مباشر')">فتح التحميل للغير مباشر</button>
                </div>
                <div class="col-md-3 col-6 mb-3">
                    <button class="btn btn-success w-100" id="runCode" name="runCode"
                        onClick="sendParamter('مشاكل الطباعة')">أرسال حل مشكلة الطباعة</button>
                </div>
                <div class="col-md-3 col-6 mb-3">
                    <button class="btn btn-success w-100" id="runCode" name="runCode"
                        onClick="sendParamter('تفعيل الحد الأئتمانى')">تفعيل الحد الأئتمانى</button>
                </div>
                <div class="col-md-3 col-6 mb-3">
                    <button class="btn btn-success w-100" id="runCode" name="runCode"
                        onClick="sendParamter('تفعيل الفترة الأئتمانية')">فتح تفعيل الفترة الأئتمانية</button>
                </div>
                <div class="col-md-3 col-6 mb-3">
                    <button class="btn btn-success w-100" id="runCode" name="runCode"
                        onClick="sendParamter('فتح عدد البيع')">فتح عدد البيع</button>
                </div>
                <div class="col-md-3 col-6 mb-3">
                    <button class="btn btn-success w-100" id="runCode" name="runCode"
                        onClick="sendParamter('زيادة عدد الزيارات')">زيادة عدد
                        الزيارات</button>
                </div>
                <div class="col-md-3 col-6 mb-3">
                    <button class="btn btn-success w-100" id="runCode" name="runCode"
                        onClick="sendParamter('زيادة قيمة الحد الأئتمانى')">زيادة قيمة الحد الأئتمانى</button>
                </div>

                <br>
                <div class=" col-md-3 mb-3">
                    <button class="btn btn-outline-success w-100" id="submit" value="search" name="runCode"
                        onClick="sendParamter('search')">Search</button>
                </div>
            </div>
            <div class="row overflow-auto">
                <div id="grid" class="col-12"></div>
            </div>

        </div>
    </div>

    </body>
    <script>
        function sendParamter(requestData) {

            var requestDatae = requestData;
            var salesRepId = document.getElementById('salesrep_id').value;
            var Region = document.getElementById('Region').value;
            var posCode = document.getElementById('posCode').value;
            var creditLimit = document.getElementById('credit_limit').value;
            var tablename = document.getElementById('tablename').value;
            var runCodeQuery = document.getElementById('runCodeQuery').value;
            var flexSwitchCheckChed = document.getElementById('flexSwitchCheckChed').checked;
            
            if (flexSwitchCheckChed === true) {
                flexSwitchCheckChed = 1;
            } else {
                flexSwitchCheckChed = 0;
            }

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'get',
                url: '{{ route("DevAndriodInvoice") }}',
                dataType: 'json',
                data: {
                    
                    requestData: requestData,
                    salesRepId: salesRepId,
                    posCode: posCode,
                    Region: Region,
                    creditLimit: creditLimit,
                    tablename:tablename,
                    runCodeQuery:runCodeQuery,
                    flexSwitchCheckChed:flexSwitchCheckChed,
                },
                beforeSend: function() {
                    $('body').css('cursor', 'wait');
                    $("body").addClass("loading");
                },
                success: function(data) {
                    $('body').css('cursor', 'auto');
                    $("body").removeClass("loading");

                    if (data['status'] == 'error') {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: data['message'],
                        })
                    } else if (data['status'] == 'success') {
                        Swal.fire({
                            icon: 'success',
                            title: 'عملية ناجحة',
                            text: data['message'],
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
