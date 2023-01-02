@extends('layout.pivotindex')
@section('title', 'POS POSTING')

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
            <form id="Post" class="card-body">
                <div class="row">
                    <div class="col-md-3 col-12 mb-2">
    <label for="BranchAjax">Region</label>
                        <div class="w-100">
                            @include('Include.branchesSelect')
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
        <button class="btn btn-success btn-lg" id="submit" id='Post'>Post</button>
    </div>
    </div>

    </div>

    </div>

    <div class="main-content container-fluid">
        <div class="overlay">
            <span class="loader"></span>
        </div>
        <div class="header-top">
            <p class="SideBarTitle info">New @yield('title')</p>
        </div>
        <div class="card">

            <div class="row">
                <div class="form-group col-md-3 col-12 mb-2">
                    <label>Month</label>
                    <div class="form-group">
                        <div class='input-group date' id='monthDate'>
                            <input type='text' class="form-control" name="monthDate" id="monthDate" />
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="form-group col-md-3 col-12 mb-2">
                    <label>Year</label>
                    <div class="form-group">
                        <div class='input-group date' id='yearDate'>
                            <input type='text' class="form-control" name="yearDate" id="yearDate" />
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                        </div>
                    </div>
                </div>
                <div>
                    <button class="btn btn-success btn-lg" id="submit" id='NewposPost'>Post</button>
                </div>
            </div>

        </div>

    </div>
    </div>



    <script type="text/javascript">
        $('#Post').on('submit', function (e) {

            e.preventDefault();

            let yearDate = $('#yearDate').val();
            let monthDate = $('#monthDate').val();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: '{{ URL::to("posPostingSendData") }}',
                type: 'post',
                data: {
                    "_token": "{{ csrf_token() }}",
                    yearDate: yearDate,
                    monthDate: monthDate,
                },

                success: function (data) {
                    if (data['Status'] == "error") {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: data.message,
                        })
                    } else if (data['Status'] == 'success') {
                        Swal.fire({
                            icon: 'success',
                            title: "New POS Posted Successfully",
                            text: data.message,
                        })
                    }
                },

            });
        });

        $('#NewposPost').on('submit', function (e) {

            e.preventDefault();

            let yearDate = $('#yearDate').val();
            let monthDate = $('#monthDate').val();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: '{{ URL::to("newPosPostingSendData") }}',
                type: 'post',
                data: {
                    "_token": "{{ csrf_token() }}",
                    yearDate: yearDate,
                    monthDate: monthDate
                },

                success: function (data) {
                    if (data['status'] == '200') {
                        Swal.fire({
                            icon: 'success',
                            title: "Posted Successfully",
                            text: data['message'],
                        })
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: "Failed",
                            text: 'Something went wrong',
                        })
                    }
                },

            });
        });
    </script>

    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.7.14/js/bootstrap-datetimepicker.min.js">
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
    <script type="text/javascript">
        $(function () {
            $('#monthDate').datetimepicker({
                format: 'MMMM',
                defaultDate: new Date(),
                maxDate: new Date(),
                useCurrent: false,
            });
        });

        $(function () {
            $('#yearDate').datetimepicker({
                format: 'YYYY',
                defaultDate: new Date(),
                maxDate: new Date(),
                useCurrent: false,
            });
        });
    </script>
    <script type="text/javascript" src="http://jqueryjs.googlecode.com/files/jquery-1.3.1.min.js"></script>
    @endsection