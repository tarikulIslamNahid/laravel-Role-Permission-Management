@extends('backend.layouts.app')
@section('title','Create New Admin')
@section('content')
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Admin Create</h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Admin Create</li>
      </ol>
    </div>
    <div class="row mb-3">
            <!-- Datatables -->
            <div class="col-lg-12 m-auto">
                @if (session('exiest'))

                <div class="alert alert-danger" role="alert">
                    {{ session('exiest') }}
                </div>
            @endif
            @if (session('success'))

            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h5 class="m-0 mt-2 font-weight-bold text-primary">Create New Admin</h5>
                </div>
@include('backend.massage')
                <div class="card mb-4">

                    <div class="card-body">
                      <form method='POST' action="{{route('admin.admins.store')}}">
                        @csrf
                        <div class="form-row">
                        <div class="form-group col-lg-6">
                          <label for="exampleInputEmail1">Admin Name</label>
                          <input type="text" name='name' class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter a Admin Name">

                        </div>

                        <div class="form-group col-lg-6">
                            <label for="exampleInputEmail1">Admin Email</label>
                            <input type="email" name='email' class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter a Email">

                          </div>

                        </div>


                        <div class="form-row">
                            <div class="form-group col-lg-6">
                              <label for="exampleInputEmail1">Password</label>
                              <input type="password" name='password' class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter your password">

                            </div>

                            <div class="form-group col-lg-6">
                                <label for="exampleInputEmail1">Confirm Password</label>
                                <input type="password" name='password_confirmation' class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Confirm Password">

                              </div>

                            </div>

                            <div class="form-row">
                                <div class="form-group col-lg-6">
                                  <label for="exampleInputEmail1">Role</label>
                                      <select id="my-select" class="form-control select2" name="roles[]" multiple>
                                        @foreach ($roles as $role)

                                        <option value="{{$role->id}}">{{$role->name}}</option>
                                        @endforeach
                                      </select>
                                </div>
                                <div class="form-group col-lg-6">
                                    <label for="username">Admin Username</label>
                                    <input type="text" name='username' class="form-control" id="username" aria-describedby="emailHelp" placeholder="Enter username">

                                  </div>
                                </div>

                        <button type="submit" class="btn btn-primary">Create Admin</button>
                      </form>
                    </div>
                  </div>

              </div>

    </div>
    <!--Row-->

  </div>
@endsection

@section('script')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

{{-- @include('backend.scripts') --}}
<script>
    $(document).ready(function() {
    $('.select2').select2();
});
</script>
@endsection
