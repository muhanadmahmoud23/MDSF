@extends('layout.pivotindex')
@section('title', 'Sales Territory')
@section('content')

    <body>
        <div id="example">
            <div class="col-md-4">
                <div class="col-md-12">
                    <div class="col-md-4">
                        <label for="multiple">Region</label>
                    </div>
                    <div class="col-md-8">
                        @include('sales.Common.branchesSelect')
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="col-md-4">
                        <label for="multiple">Company</label>
                    </div>
                    <div class="col-md-8">
                        @include('sales.Common.companiesSelect')
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="col-md-4">
                        <label for="multiple">Sales Terr</label>
                    </div>
                    <div class="col-md-8">
                        @include('sales.Common.SalesTerrSelect')
                    </div>
                </div>
            </div>

            <form id="Product" class="col-md-8">
                <div>
                    <div class="form-group col-md-6">
                        <div class="col-md-4">
                            <label>Begin Date</label>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                                @include('sales.Common.BeginDate')
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <div class="col-md-4">
                            <label>End Date</label>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                                @include('sales.Common.EndDate')
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-md-3">
                        @include('sales.Common.ByDatePickUp')
                    </div>
                    <div class="form-group col-md-3">
                        @include('sales.Common.QuantityMeasure')
                    </div>
                    <div class="form-group col-md-3">
                        @include('sales.Common.SalesBy')
                    </div>

                    <div class="form-group col-md-3">
                        <button class="btn btn-success" id="submit" style="font-size:26px">Search</button>
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
                        Swal.fire('MUHANAAAD')
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
                    }
                }
            });

        });
    </script>
    <div id="grid" class="">
        <div class="k-pivotgrid-wrapper">
            {{-- <div id="configurator" class="hidden-on-narrow"></div> --}}
            <div id="pivotgrid" class="hidden-on-narrow"></div>
        </div>
        <div class="responsive-message"></div>
    </div>
    <script src="{{ asset('assets/kendou/examples/content/shared/js/products.js') }}"></script>
    <script>
        // $(document).ready(function() {
        //     var pivotgrid = $("#pivotgrid").kendoPivotGrid({
        //         filterable: true,
        //         sortable: true,
        //         columnWidth: 120,
        //         height: 570,
        //         dataSource: {
        //             data: products,
        //             schema: {
        //                 model: {
        //                     fields: {
        //                         ProductName: {
        //                             type: "string"
        //                         },
        //                         UnitPrice: {
        //                             type: "number"
        //                         },
        //                         UnitsInStock: {
        //                             type: "number"
        //                         },
        //                         Discontinued: {
        //                             type: "boolean"
        //                         },
        //                         CategoryName: {
        //                             field: "Category.CategoryName"
        //                         }
        //                     }
        //                 },
        //                 cube: {
        //                     dimensions: {
        //                         ProductName: {
        //                             caption: "All Products"
        //                         },
        //                         CategoryName: {
        //                             caption: "All Categories"
        //                         },
        //                         Discontinued: {
        //                             caption: "Discontinued"
        //                         }
        //                     },
        //                     measures: {
        //                         "Sum": {
        //                             field: "UnitPrice",
        //                             format: "{0:c}",
        //                             aggregate: "sum"
        //                         },
        //                         "Average": {
        //                             field: "UnitPrice",
        //                             format: "{0:c}",
        //                             aggregate: "average"
        //                         }
        //                     }
        //                 }
        //             },
        //             columns: [{
        //                 name: "CategoryName",
        //                 expand: true
        //             }, {
        //                 name: "ProductName"
        //             }],
        //             rows: [{
        //                 name: "Discontinued",
        //                 expand: true
        //             }],
        //             measures: ["Sum"]
        //         }
        //     }).data("kendoPivotGrid");

        //     $("#configurator").kendoPivotConfigurator({
        //         dataSource: pivotgrid.dataSource,
        //         filterable: true,
        //         sortable: true,
        //         height: 570
        //     });
        // });
    </script>
    </div>
    <script type="text/javascript">
        $('#Product').on('submit', function(e) {

            e.preventDefault();

            let endDate = $('#endDate').val();
            let Begindate = $('#Begindate').val();
            let SalesTerr = $('#SalesTerrAjax').val();
            let DateBy = $('input[name="DateBy"]:checked').val();
            let SalesBy = $('input[name="SalesBy"]:checked').val();
            let QuantityMeasure = $('input[name="QuantityMeasure"]:checked').val();

            $.ajax({
                url: '{{ URL::to('SaleTerrInvoice') }}',
                type: 'get',
                data: {
                    Begindate: Begindate,
                    endDate: endDate,
                    SalesTerr: SalesTerr,
                    DateBy: DateBy,
                    SalesBy: SalesBy,
                    QuantityMeasure: QuantityMeasure,

                },
                beforeSend: function() {
                    // $("body").addClass("loading");
                    // $('body').css('cursor', 'wait');
                },
                success: function(data) {
                    $('body').css('cursor', 'auto');
                    $("body").removeClass("loading");

                    if (data['SaleTerrResult'] == "Missing Paramter") {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Missing Paramter!',
                        })
                    } else {
                        // $("#grid").empty();
                        $(document).ready(function() {
                            $("#pivotgrid").empty();
                            var pivotgrid = $("#pivotgrid").kendoPivotGrid({
                                filterable: true,
                                sortable: true,
                                columnWidth: 120,
                                height: 570,
                                // expandMember: function(e) {
                                //     /* The result can be observed in the DevTools(F12) console of the browser. */
                                //     console.log("expand member");
                                // },
                                dataSource: {
                                    data: data['SaleTerrResult'],
                                    schema: {
                                        model: {
                                            // id: "salesrep_name",
                                            fields: {
                                                salesrep_name: {
                                                    caption: "salesrep_name"
                                                },
                                                pos_name: {
                                                    type: "string"
                                                },
                                                pos_code: {
                                                    type:"number"
                                                },
                                                
                                            }
                                        },
                                        cube: {
                                            dimensions: {
                                                // Discontinued: {
                                                //     caption: "Discontinued"
                                                // }
                                            },

                                            company_name: {
                                                caption: "company_name"
                                            },
                                            pos_code: {
                                                caption: "pos_code"
                                            },
                                            measures: {
                                                // "Sum": {
                                                //     field: "UnitPrice",
                                                //     format: "{0:c}",
                                                //     aggregate: "sum"
                                                // },
                                                // "Average": {
                                                //     field: "UnitPrice",
                                                //     format: "{0:c}",
                                                //     aggregate: "average"
                                                // }
                                            }
                                        }
                                    },
                                    columns: [{
                                        name: "company_name",
                                        expand: true
                                    }, {
                                        name: "prod_seq",
                                        expand: true
                                    }, {
                                        name: "prod_id",
                                        expand: true
                                    }, {
                                        name: "product",
                                        expand: true
                                    }],
                                    rows: [{
                                            name: "salesrep_name",
                                            expand: true
                                        }, {
                                            name: "pos_name",
                                            expand: true
                                        },
                                        {
                                            name: "pos_code",
                                            expand: true
                                        }, {
                                            name: "visit_start_time",
                                            expand: true
                                        },
                                        {
                                            name: "visit_end_time",
                                            expand: true
                                        },
                                    ]
                                    // measures: ["Sum"]
                                }
                            }).data("kendoPivotGrid");

                            // $("#configurator").kendoPivotConfigurator({
                            //     dataSource: pivotgrid.dataSource,
                            //     filterable: true,
                            //     sortable: true,
                            //     height: 570
                            // });
                        });

                    }
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

        .k-pivotgrid-wrapper>.k-pivot {
            margin-left: 275px;
        }

        /* .k-pivotgrid-wrapper {
                    margin-left: 266px;
                } */

        .k-floatwrap {
            margin-left: 0px;
        }

        tr {
            max-height: 10px
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
    <script type="text/javascript" src="http://jqueryjs.googlecode.com/files/jquery-1.3.1.min.js"></script>
@endsection
