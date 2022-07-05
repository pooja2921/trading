@extends('inventory.layout')
@section('title', 'Permission')
@section('content')
    <!-- push external head elements to head -->
    @push('head')
        <link rel="stylesheet" href="{{ asset('plugins/DataTables/datatables.min.css') }}">
        <link rel="stylesheet" href="{{ asset('plugins/select2/dist/css/select2.min.css') }}">
    @endpush


    <div class="container-fluid">
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="ik ik-unlock bg-blue"></i>
                        <div class="d-inline">
                            <h5>{{ __('Permissions')}}</h5>
                            <span>{{ __('Define permissions of user')}}</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <nav class="breadcrumb-container" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="../index.html"><i class="ik ik-home"></i></a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="#">{{ __('Permissions')}}</a>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <div class="row clearfix">
            <!-- start message area-->
            @include('include.message')
            <!-- end message area-->
            <!-- only those have manage_permission permission will get access -->
            @can('manage_permission')
            <div class="col-md-12">
                <div class="mb-2 clearfix">
                    <a class="btn pt-0 pl-0 d-md-none d-lg-none" data-toggle="collapse" href="#displayOptions" role="button" aria-expanded="true" aria-controls="displayOptions">
                        {{ __('Display Options')}}
                        <i class="ik ik-chevron-down align-middle"></i>
                    </a>
                    <div class="collapse d-md-block display-options" id="displayOptions">
                        <div class="d-block d-md-inline-block">
                            
                            <div class="search-sm d-inline-block float-md-left mr-1 mb-1 align-top">
                                <form action="{{url('permission')}}" method="get">
                                    <input type="text" class="form-control" id="search" placeholder="Search.." name="name" value="{{ Request::input('name') }} ">
                                    <button type="submit" class="btn btn-icon"><i class="ik ik-search"></i></button>
                                    
                                    <button type="button" id="adv_wrap_toggler" class="adv-btn ik ik-chevron-down dropdown-toggle" data-toggle="dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></button>
                                    <div class="adv-search-wrap dropdown-menu dropdown-menu-right" aria-labelledby="adv_wrap_toggler">
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="Category Title">
                                        </div>
                                        
                                        <button class="btn btn-theme">{{ __('Search')}}</button>
                                    </div>
                                </form> 
                            </div>
                        </div>
                        
                        <div class="float-md-right">

                    
                            <button class="btn btn-outline-primary btn-rounded-20" href="#permissionAdd" data-toggle="modal" data-target="#permissionAdd">
                                Add Permission
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            @endcan
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card p-3">
                    <div class="card-body">
                        <table id="permission_table" class="table">
                            <thead>
                                <tr>
                                    <th>{{ __('Permission')}}</th>
                                    <th>{{ __('Assigned Role')}}</th>
                                    <th>{{ __('Action')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($permissions as $permission)
                                  <tr>
                                    <td>{{ isset($permission->name) ? $permission->name :'' }}</td>
                                    <td>
                                        @foreach($permission->roles as $role)
                                        <span class="badge badge-dark m-1">{{ isset($role->name) ? $role->name :'' }}</span>
                                        @endforeach
                                    </td>
                                    
                            
                                    
                                    <td>
                                     
                                    <a href="javascript:;" class="deletebyid" data-id="{{ isset($permission->id) ? $permission->id:'' }}"  data-url="{{url('permission/delete/'.$permission['id'])}}"><i class="ik ik-trash-2 f-16 text-red"></i></a></td>
                                  </tr>
                                @endforeach
                             
                            </tbody>
                        </table>
                        <div class="card-footer d-flex align-items-center">
                            <div class="col-md-6">
                                Showing {{($permissions->currentpage()-1)*$permissions->perpage()+1}} to {{$permissions->currentpage()*$permissions->perpage()}}
                                    of  {{$permissions->total()}} entries
                            </div>
                                
                                <div class="col-md-6">
                                {{ $permissions->links('include.pagination') }}
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade edit-layout-modal pr-0 " id="permissionAdd" tabindex="-1" role="dialog" aria-labelledby="permissionAddLabel" aria-hidden="true">
        <div class="modal-dialog w-300" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="categoryAddLabel">{{ __('Add Permission')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <form class="forms-sample" method="POST" action="{{url('permission/create')}}">
                    @csrf
                  <div class="modal-body">
                    <span id="publicurl" data-value="{{url('/')}}"></span>
                      <div class="form-group">
                            <label class="d-block">Permission</label>
                            <input type="text" class="form-control" id="permission" name="name" placeholder="Permission Name" required>
                      </div>
                      <div class="form-group">
                          <label for="exampleInputEmail3">{{ __('Assigned to Role')}} </label>
                                {!! Form::select('roles[]', $roles, null,[ 'class'=>'form-control select2', 'multiple' => 'multiple']) !!}
                      </div>
                      
                      <div class="form-group">
                          <button type="submit" class="btn btn-primary btn-rounded">{{ __('Save')}}</button>
                      </div>
                  </div>
                </form>
            </div>
        </div>
    </div>
    <!-- push external js -->
    @push('script')
    <script src="{{ asset('plugins/select2/dist/js/select2.min.js') }}"></script>
    <!-- <script src="{{ asset('plugins/DataTables/datatables.min.js') }}"></script>  -->
    <script src="{{ asset('plugins/DataTables/Cell-edit/dataTables.cellEdit.js') }}"></script>
    <!--server side permission table script-->
    <!-- <script src="{{ asset('js/permission.js') }}"></script> -->
    
   <script src="{{ url('js/global.js')}}"></script>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>
    <script src = "http://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
    
<script type="text/javascript">

    var route = "{{ url('permissionsearch') }}";
 $('#search').typeahead({
            source: function (query, process) {
                return $.get(route, {
                    query: query
                }, function (data) {
                    return process(data);
                });
            }
        });
var table = $('#permission_table').DataTable({

        paging: false,
        ordering: true,
        info: false,
        searching:false,
    });

</script>
    @endpush
@endsection
