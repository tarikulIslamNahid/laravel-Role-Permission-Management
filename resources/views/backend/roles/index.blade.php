@extends('backend.layouts.app')
@section('title','Roles')
@section('content')
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Roles</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Role</li>
        </ol>
    </div>
    <div class="row mb-3">
        <!-- Datatables -->
        <div class="col-lg-12">
            <div class="card mb-4">

                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h5 class="m-0 font-weight-bold text-primary">Roles List</h5>
                    <a href="{{route('admin.roles.create')}}" class="btn btn-primary ml-3">Create Role</a>

                </div>

                <div class="table-responsive p-3">
                    <table class="table align-items-center table-flush" id="dataTable">
                        <thead class="thead-light">
                            <tr>
                                <th>SL</th>
                                <th>Name</th>
                                <th>Permissions</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @php($i=1)
                            @foreach ($roles as $role)
                            <tr>
                                <td>{{$i++}}</td>
                                <td>{{$role->name}}</td>
                                <td width='600px'>

                                        @foreach ($role->permissions as $perm)


                                            <span class="badge badge-primary"> {{$perm->name}} </span>

                                    @endforeach

                                </td>
                                <td>
                                    <a class="btn btn-primary "href="{{route('admin.roles.edit',$role->id)}}">Edit</a>

                                    <a class="btn btn-danger" href="{{ route('admin.roles.destroy',$role->id) }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('delete-form-{{$role->id}}').submit();">
                                      Delete
                                    </a>

                                    <form id="delete-form-{{$role->id}}" action="{{ route('admin.roles.destroy',$role->id) }}" method="POST" class="d-none">
                                        @method('DELETE')
                                        @csrf
                                    </form>

                                </td>
                            </tr>
                            @endforeach



                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!--Row-->


</div>
@endsection
