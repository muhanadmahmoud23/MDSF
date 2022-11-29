<<<<<<< Updated upstream
<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
</head>

<body>

    @if (\Session::has('success'))
        <div class="alert alert-success">
            <ul>
                <li>{!! \Session::get('success') !!}</li>
            </ul>
        </div>
    @endif

    <div class="container">
        <div class="card bg-light mt-3">
            <div class="card-header">
                AAAAAALLLLLLLLLLLLOOOOOOOOOOOOOOOO
=======
@extends('layout.index')
@section('title', 'DashBoard')
@section('content')


<div class="main">
@if (\Session::has('success'))
<script>
$(function(){
   SwalfireSuccessMessage();
});
		function SwalfireSuccessMessage(){
        swal.fire({
            title: "Target By SalesRep",
            text: "{!! \Session::get('success') !!}",
            type: "success"
        });
		}
</script>
@endif
        <div class="card bg-light mt-3">
            <div class="card-header">
                Insert Target By SalesRep Excel
>>>>>>> Stashed changes
            </div>
            <div class="card-body">
                <form action="{{ route('import') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="file" name="file" class="form-control">
                    <br>
                    <button class="btn btn-success">
<<<<<<< Updated upstream
                        Import User Data
                    </button>
                </form>
            </div>
        </div>
    </div>

</body>

</html>
=======
                        Import Target Excel
                    </button>
			
                </form>
            </div>
        </div>

	</div>
@endsection

>>>>>>> Stashed changes
