@extends('layout.index')
@section('title', 'DashBoard')
@section('content')
    <div class="container panel ">
        @if (session()->has('message'))
            <div class="alert alert-success" style="color:black">
                {{ session()->get('message') }}
            </div>
        @endif
        <div class="container form-div">
            <form action="{{ route('postProdGroup') }}" method="POST" enctype="multipart/form-data" class="form">
                @csrf
                <div class="form-group">
                    <label class="col-md-3 label-excel">Prod Group</label>
                    <input type="file" class="col-md-3" name="ProdGroupExcel" class="form-control" style="color:black">
                    <span class="text-danger" id="name-error"></span>
                    <button class="btn btn-success" id="submit">Submit</button>
                </div>
            </form>
        </div>
        <div class="container form-div">
            <form action="{{ route('postSalesTerr') }}" method="POST" enctype="multipart/form-data" class="form">
                @csrf
                <div class="form-group">
                    <label class="col-md-3 label-excel">Sales Terr</label>
                    <input type="file" class="col-md-3" name="SalesTerrExcel" class="form-control" style="color:black">
                    <span class="text-danger" id="name-error"></span>
                    <button class="btn btn-success" id="submit">Submit</button>
                </div>
            </form>
        </div>
        <div class="container form-div">
            <form action="{{ route('postSalesMenTerr') }}" method="POST" enctype="multipart/form-data" class="form">
                @csrf
                <div class="form-group">
                    <label class="col-md-3 label-excel">Sales Men Terr</label>
                    <input type="file" class="col-md-3" name="SalesMenTerrExcel" class="form-control"
                        style="color:black">
                    <span class="text-danger" id="name-error"></span>
                    <button class="btn btn-success" id="submit">Submit</button>
                </div>
            </form>
        </div>
        <div class="container form-div">
            <form action="{{ route('postVan') }}" method="POST" enctype="multipart/form-data" class="form">
                @csrf
                <div class="form-group">
                    <label class="col-md-3 label-excel">Van</label>
                    <input type="file" class="col-md-3" name="VanExcel" class="form-control" style="color:black">
                    <span class="text-danger" id="name-error"></span>
                    <button class="btn btn-success" id="submit">Submit</button>
                </div>
            </form>
        </div>
        <div class="container form-div">
            <form action="{{ route('postSalesMen') }}" method="POST" enctype="multipart/form-data" class="form">
                @csrf
                <div class="form-group">
                    <label class="col-md-3 label-excel">SalesMen</label>
                    <input type="file" class="col-md-3" name="SalesMenExcel" class="form-control" style="color:black ">
                    <span class="text-danger" id="name-error"></span>
                    <button class="btn btn-success" id="submit">Submit</button>
                </div>
            </form>
        </div>
        <div class="container form-div">
            <form action="{{ route('postJourney') }}" method="POST" enctype="multipart/form-data" class="form">
                @csrf
                <div class="form-group">
                    <label class="col-md-3 label-excel">Journey</label>
                    <input type="file" class="col-md-3" name="JourneyExcel" class="form-control" style="color:black !important">
                    <span class="text-danger" id="name-error"></span>
                    <button class="btn btn-success" id="submit">Submit</button>
                </div>
            </form>
        </div>
        <div class="container form-div">
            <form action="{{ route('postSalesCall') }}" method="POST" enctype="multipart/form-data" class="form">
                @csrf
                <div class="form-group">
                    <label class="col-md-3 label-excel">Sales Call</label>
                    <input type="file" class="col-md-3" name="SalesCallExcel" class="form-control" style="color:black !important">
                    <span class="text-danger" id="name-error"></span>
                    <button class="btn btn-success" id="submit">Submit</button>
                </div>
            </form>
        </div>
        <div class="container form-div">
            <form action="{{ route('postSalesCallDetails') }}" method="POST" enctype="multipart/form-data" class="form">
                @csrf
                <div class="form-group">
                    <label class="col-md-3 label-excel">Sales Call Details</label>
                    <input type="file" class="col-md-3" name="SalesCallDetailsExcel" class="form-control" style="color:black !important">
                    <span class="text-danger" id="name-error"></span>
                    <button class="btn btn-success" id="submit">Submit</button>
                </div>
            </form>
        </div>
        <div class="container form-div">
            <form action="{{ route('postPOS') }}" method="POST" enctype="multipart/form-data" class="form">
                @csrf
                <div class="form-group">
                    <label class="col-md-3 label-excel">POS</label>
                    <input type="file" class="col-md-3" name="POSExcel" class="form-control" style="color:black !important">
                    <span class="text-danger" id="name-error"></span>
                    <button class="btn btn-success" id="submit">Submit</button>
                </div>
            </form>
        </div>
    </div>
    <style type="text/css">
        .panel-default {
            margin-left: 29rem;
            margin-top: 1rem;
        }

        .form-div {
            border: 1px solid grey;
            border-radius: 10px;
            margin-top: 1rem
        }

        .form {
            padding-top: 10px
        }

        .form-group {
            margin-bottom: 0px !important;
        }

        .label-excel{
            color: black !important;
            font-size:16px;
            font-weight:700;
        }
    </style>
@endsection
