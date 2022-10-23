@extends('layout.pivotindex')
@section('title', 'Dev Andriod Support')
@section('content')



    <div class="main">
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
                    <label for="posCode" class="form-label">POS Code</labeL>
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
                        placeholder="(Run Code) like= set param_val=0 where oaram_id=0">
                </div>
                <div class="col-md-3 col-12">
                    <button class="btn btn-outline-success w-100" id="Query" name="Query"
                        onClick="sendParamter('Query')">Send
                    </button>
                </div>
            </div>
            <div class="row">
                <div class=" col-md-3 col-12 mb-3 ">
                    <button class="btn btn-success w-100" id="runCode" name="runCode"
                        onClick="sendParamter('فتح احداثيات')">فتح
                        احداثيات</button>
                </div>
                <div class=" col-md-3 col-12 mb-3 ">
                    <button class="btn btn-success w-100" id="runCode" name="runCode"
                        onClick="sendParamter('set param_val = 0 where param_id = 7')">
                        فتح احداثيات جميع العملاء
                    </button>
                </div>
                <div class=" col-md-3 col-12 mb-3">
                    <button class="btn btn-success w-100" id="runCode" name="runCode"
                        onClick="sendParamter('set param_val = 0 where param_id = 16')">فتح الزيارات الخارجية</button>
                </div>
                <div class="col-md-3 col-12 mb-3">
                    <button class="btn btn-success w-100" id="runCode" name="runCode"
                        onClick="sendParamter('set param_val = 999 where param_id = 10')">زيادة الزيارات
                        الخارجية</button>
                </div>
                <div class="col-md-3 col-12 mb-3">
                    <button class="btn btn-success w-100" id="runCode" name="runCode"
                        onClick="sendParamter('set param_val = 0 where param_id = 13')">عودة</button>
                </div>
                <div class="col-md-3 col-12 mb-3">
                    <button class="btn btn-success w-100" id="runCode" name="runCode"
                        onClick="sendParamter('تحديث محلات')">تحديث محلات</button>
                </div>
                <div class=" col-md-3 col-12 mb-3">
                    <button class="btn btn-success w-100" id="runCode" name="runCode"
                        onClick="sendParamter('set param_val = 0 where param_id = 22')"> الغاء فاتورة بدون حافز
                    </button>
                </div>
                <div class=" col-md-3 col-12 mb-3">
                    <button class="btn btn-success w-100" id="runCode" name="runCode"
                        onClick="sendParamter('set param_val = 0 where param_id = 18')"> الغاء فاتورة بحافز </button>
                </div>
                <div class=" col-md-3 col-12 mb-3">
                    <button class="btn btn-success w-100 " id="runCode" name="runCode"
                        onClick="sendParamter('set PAY_FORCE = 0')">ايقاف حافز ثابت</button>
                </div>
                <div class=" col-md-3 col-12 mb-3">
                    <button class="btn btn-success w-100 " id="runCode" name="runCode"
                        onClick="sendParamter('target')">ارسال
                        الاهداف</button>
                </div>
                <div class=" col-md-3 col-12 mb-3">
                    <button class="btn btn-success w-100" id="runCode" name="runCode"
                        onClick="sendParamter('INCENTIVE_GRAD_DEATILS')">INCENTIVE_GRAD_DEATILS</button>
                </div>
                <div class=" col-md-3 col-12 mb-3">
                    <button class="btn btn-success w-100" id="runCode" name="runCode"
                        onClick="sendParamter('FIXED_INCENTIVE_DETAILS')">(FIX)</button>
                </div>
                <div class=" col-md-3 col-12 mb-3">
                    <button class="btn btn-success w-100 " id="runCode" name="runCode"
                        onClick="sendParamter('INCENTIVE_MIX')">
                        ارسال حوافز فورية (MIX) </button>
                </div>
                <div class=" col-md-3 col-12 mb-3">
                    <button class="btn btn-success w-100" id="runCode" name="runCode"
                        onClick="sendParamter('set param_val = 1 where param_id = 25')">فتح أضافة بيع
                    </button>
                </div>
                <div class=" col-md-3 col-12 mb-3">
                    <button class="btn btn-success w-100" id="runCode" name="runCode"
                        onClick="sendParamter('set param_val = 0 where param_id = 15')"> Near (N)</button>
                </div>
                <div class=" col-md-3 col-12 mb-3">
                    <button class="btn btn-success w-100" id="runCode" name="runCode"
                        onClick="sendParamter('set param_val = 1 where param_id = 33')">open GPS</button>
                </div>
                <div class=" col-md-3 col-12 mb-3">
                    <button class="btn btn-success w-100 " id="runCode" name="runCode"
                        onClick="sendParamter('set param_val = 1 where param_id = 41')">فتح التحميل للغير مباشر</button>
                </div>
                <div class="col-md-3 col-12 mb-3">
                    <button class="btn btn-success w-100" id="runCode" name="runCode"
                        onClick="sendParamter('مشاكل الطباعة')">أرسال حل مشكلة الطباعة</button>
                </div>
                <div class="col-md-3 col-12 mb-3">
                    <button class="btn btn-success w-100" id="runCode" name="runCode"
                        onClick="sendParamter('تفعيل الحد الأئتمانى')">تفعيل الحد الأئتمانى</button>
                </div>
                <div class="col-md-3 col-12 mb-3">
                    <button class="btn btn-success w-100" id="runCode" name="runCode"
                        onClick="sendParamter('تفعيل الفترة الأئتمانية')">فتح تفعيل الفترة الأئتمانية</button>
                </div>
                <div class="col-md-3 col-12 mb-3">
                    <button class="btn btn-success w-100" id="runCode" name="runCode"
                        onClick="sendParamter('فتح عدد البيع')">فتح عدد البيع</button>
                </div>
                <div class="col-md-3 col-12 mb-3">
                    <button class="btn btn-success w-100" id="runCode" name="runCode"
                        onClick="sendParamter('set param_val = 999 where param_id = 64')">زيادة عدد الزيارات</button>
                </div>
                <div class="col-md-3 col-12 mb-3">
                    <button class="btn btn-success w-100" id="runCode" name="runCode"
                        onClick="sendParamter('زيادة قيمة الحد الأئتمانى')">زيادة قيمة الحد الأئتمانى</button>
                </div>

                <br>
                <div class=" col-md-3 mb-3">
                    <button class="btn btn-outline-success w-100" id="submit" value="search"
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
        function sendParamter(e) {
            var salesRepId = document.getElementById('salesrep_id').value;
            var creditLimit = document.getElementById('credit_limit').value;
            var Region = document.getElementById('Region').value;
            var tablename = document.getElementById('tablename').value;
            var runCodeQuery = document.getElementById('runCodeQuery').value;




            if (e == 'فتح احداثيات' || e == 'تفعيل الحد الأئتمانى' || e == 'تفعيل الفترة الأئتمانية' || e ==
                "زيادة قيمة الحد الأئتمانى") {
                var posCode = document.getElementById('posCode').value;
                if (posCode) {
                    var tabName = 'POS';
                    if (e == 'فتح احداثيات') {
                        var runCode = ` set LONGITUDE = 0, LATITUDE = 0 where POS_CODE = "` + posCode + `"`;
                    } else if (e == 'تفعيل الحد الأئتمانى') {
                        var runCode = `set ACTIVE_CREDIT_LIMIT = 0 where POS_CODE = "` + posCode + `"`;
                    } else if (e == 'تفعيل الفترة الأئتمانية') {
                        var runCode = `set Active_credit_period = 0 where POS_CODE = "` + posCode + `"`;
                    } else if (e == 'زيادة قيمة الحد الأئتمانى') {
                        var runCode = `set pos_creditlimit =` + creditLimit + ` where POS_CODE = "` + posCode + `"`;
                    }
                }
            } else if (e == 'تحديث محلات') {
                var runCode = 'تحديث محلات';
            } else if (e == 'مشاكل الطباعة') {
                var runCode = 'مشاكل الطباعة';
            } else if (e == 'set PAY_FORCE = 0') {
                var tabName = "FIXED_INCENTIVE_DETAILS"
                var runCode = e
            } else if (e == 'INCENTIVE_MIX' || e == 'FIXED_INCENTIVE_DETAILS' || e == 'INCENTIVE_GRAD_DEATILS' || e ==
                'target') {
                var tabName = e
                var runCode = null
            } else if (e == 'فتح عدد البيع') {
                var runCode = 'فتح عدد البيع';
            } else if (e == 'Query') {
                var runCode = 'Query';
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
                    Region: Region,
                    tablename: tablename,
                    runCodeQuery: runCodeQuery,
                },
                beforeSend: function() {
                    $('body').css('cursor', 'wait');
                    $("body").addClass("loading");
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
                    } else if (data['message'] == "region message success") {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: data['result'],
                        });
                    } else {
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
                                height: 260,
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
                                // toolbar: ["excel", "search"],
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
