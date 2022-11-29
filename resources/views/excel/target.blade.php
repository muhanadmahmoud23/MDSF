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
            </div>
            <div class="card-body">
                <form action="{{ route('import') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="file" name="file" class="form-control">
                    <br>
                    <button class="btn btn-success">
                        Import Target Excel
                    </button>
			
                </form>
            </div>
        </div>

	</div>
@endsection

