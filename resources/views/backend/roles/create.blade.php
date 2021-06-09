@extends('backend.layouts.app')
@section('title','Create New Roles')
@section('content')
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Role Create</h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Role Create</li>
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
                  <h5 class="m-0 mt-2 font-weight-bold text-primary">Create New Role</h5>
                </div>
@include('backend.massage')
                <div class="card mb-4">

                    <div class="card-body">
                      <form method='POST' action="{{route('admin.roles.store')}}">
                        @csrf
                        <div class="form-group">
                          <label for="exampleInputEmail1">Role Name</label>
                          <input type="text" name='name' class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter a Role Name">

                        </div>

                        <div class="form-group row">
                            <div class="col-12">

                                <label>Permissions</label>
                            </div>
                            <div class="col-12 my-3">
                                <div class="custom-control custom-switch mb-2">
                                    <input type="checkbox"  class="custom-control-input" value="1" id="allcheck">
                                    <label class="custom-control-label" for="allcheck">All Permissions</label>
                                  </div>
                            </div>

                            @php $i = 1; @endphp
                            @foreach ($permissions_group as $group)
                            <div class="col-3">

                                  <div class="custom-control custom-switch mb-2">
<input type="checkbox" onclick="getPermissionsByGroups('role-{{$i}}-managment-checkbox',this)" class="custom-control-input" value="{{$group->name}}" id="{{$i}}Managment">
<label class="custom-control-label" for="{{$i}}Managment">{{$group->name}}</label>
                                       </div>
                                    <ul class="custom-control role-{{$i}}-managment-checkbox">
                                        @php
                                            $permissions=App\User::getpermissionsByGroupName($group->name);
                                            $j=1;
                                        @endphp
                                        @foreach ($permissions as $permission)

    <li>
<div class="col-3">
<div class="custom-control custom-switch mb-2">
<input type="checkbox" name="permissions[]" class="custom-control-input" value="{{$permission->name}}" id="checkPermission{{$permission->id}}">
<label class="custom-control-label" for="checkPermission{{$permission->id}}">{{$permission->name}}</label>
</div>
</div>
</li>
                                        @php  $j++; @endphp
                                        @endforeach
                                    </ul>


                            </div>
                            @php  $i++; @endphp
                            @endforeach

                          </div>
                        <button type="submit" class="btn btn-primary">Create Role</button>
                      </form>
                    </div>
                  </div>

              </div>

    </div>
    <!--Row-->

  </div>
@endsection

@section('script')
<script>
    $('#allcheck').click(function(){
        if($(this).is(':checked')){
            $('input[type=checkbox]').prop('checked',true);
        }else{
            $('input[type=checkbox]').prop('checked',false);

        }
    });
    function getPermissionsByGroups(className,checkThis){
        const groupIdName = $('#'+checkThis.id);
        const classCheckBox=$('.'+className+' input');

        if(groupIdName.is(':checked')){
            classCheckBox.prop('checked',true);
        }else{
            classCheckBox.prop('checked',false);

        }
    }
</script>

@endsection
