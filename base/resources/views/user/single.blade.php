@extends('layouts.app')

@section('styles')

 <!-- Custom styles for this page -->
 <link href="{{asset('vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">

@endsection


@section('body')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">User: {{ $user->name }}</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">User Data</h6>
        </div>
        <div class="card-body">




            <div class="form-group row">
                <div class="col-sm-3 mb-3 mb-sm-0">
                    <img class="img-profile rounded-circle"
                        src="{{($user->avatar !=null) ? asset($user->avatar) : asset('img/undraw_profile.svg') }}"
                        width="250"
                        alt="Profile Image">
                </div>

                <div class="col-sm-9 mb-3 mb-sm-0">

                    <label class="col-form-label text-md-right">Name: {{ $user->name }}</label> <br>
                    <label class="col-form-label text-md-right">Email: {{ $user->email }}</label>

                </div>

            </div>

        </div>
    </div>

</div>
<!-- /.container-fluid -->

@endsection


@section('scripts')

    <!-- Page level plugins -->
    <script src="{{asset('vendor/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

    <!-- Page level custom scripts -->
    <script src="{{asset('js/demo/datatables-demo.js')}}"></script>
@endsection
