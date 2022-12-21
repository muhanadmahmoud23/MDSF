@extends('layout.index')
@section('title', 'DashBoard')
@section('content')


    <div class="main">
        @if (\Session::has('success'))
            <script>
                $(function() {
                    SwalfireSuccessMessage();
                });

                function SwalfireSuccessMessage() {
                    swal.fire({
                        title: "Target By SalesRep",
                        text: "{!! \Session::get('success') !!}",
                        type: "success"
                    });
                }
            </script>
        @endif
        @if (\Session::has('error'))
            <script>
                $(function() {
                    SwalfireSuccessMessage();
                });

                function SwalfireSuccessMessage() {
                    swal.fire({
                        title: "Target By SalesRep",
                        text: "{!! \Session::get('error') !!}",
                        type: "error"
                    });
                }
            </script>
        @endif
        <div class="main-content container-fluid">
            <div class="header-top">
                <p class="SideBarTitle info">Insert Target By SalesRep Excel</p>

            </div>
            <div class="card bg-light mt-3">
                <div class="card-body">
                    <form action="{{ route('import') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="fileandname">
                            <input type="file" name="file" id="FileAttachment" class="file-target col-md-2 col-12">
                            <input type="text" id="fileuploadurl" readonly placeholder="Insert Excel Sheet here 😊"
                                class="col-md-3 col-12">
                        </div>
                        <br>
                        <button class="btn btn-success">
                            Import Target Excel
                        </button>
                    </form>
                </div>
            </div>
        </div>



    </div>
@endsection
