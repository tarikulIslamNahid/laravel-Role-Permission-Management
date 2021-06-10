@extends('backend.layouts.app')
@section('title','Admins')
@section('content')
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Admins</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Admins</li>
        </ol>
    </div>
    <div class="row mb-3">
        <!-- Datatables -->
        <div class="col-lg-12">
            <div class="card mb-4">

                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h5 class="m-0 font-weight-bold text-primary">Admin List</h5>
                    @if (Auth::guard('admin')->user()->can('admin.create'))

                    <a href="{{route('admin.admins.create')}}" class="btn btn-primary ml-3">Create Admin</a>
@endif
                </div>

                <div class="table-responsive p-3">
                    <table class="table align-items-center table-flush" id="dataTable">
                        <thead class="thead-light">
                            <tr>
                                <th>SL</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Roles</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @php($i=1)
                            @foreach ($admins as $admin)
                            <tr>
                                <td>{{$i++}}</td>
                                <td>{{$admin->name}}</td>
                                <td>{{$admin->email}}</td>
                                <td  >

                                        @foreach ($admin->roles as $role)

                                            <span class="badge badge-primary"> {{$role->name}} </span>

                                    @endforeach

                                </td>
                                <td>
                                    @if (Auth::guard('admin')->user()->can('admin.edit'))

                                    <a class="btn btn-primary "href="{{route('admin.admins.edit',$admin->id)}}">Edit</a>
                                    @endif
                                    @if (Auth::guard('admin')->user()->can('admin.delete'))

                                    <a class="btn btn-danger" href="{{ route('admin.admins.destroy',$admin->id) }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('delete-form-{{$admin->id}}').submit();">
                                      Delete
                                    </a>
                                    @endif

                                    <form id="delete-form-{{$admin->id}}" action="{{ route('admin.admins.destroy',$admin->id) }}" method="POST" class="d-none">
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
