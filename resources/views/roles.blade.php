@extends('inventory.layout')
@section('title', 'Roles')
@section('content')
    <!-- push external head elements to head -->
    @push('head')
        <link rel="stylesheet" href="{{ asset('plugins/DataTables/datatables.min.css') }}">
    @endpush


    <div class="container-fluid">
    	<div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="ik ik-award bg-blue"></i>
                        <div class="d-inline">
                            <h5>{{ __('Roles')}}</h5>
                            <span>{{ __('Define roles of user')}}</span>
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
                                <a href="#">{{ __('Roles')}}</a>
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
            <!-- only those have manage_role permission will get access -->
            @can('manage_role')
			<div class="col-md-12">
                <div class="mb-2 clearfix">
                    <a class="btn pt-0 pl-0 d-md-none d-lg-none" data-toggle="collapse" href="#displayOptions" role="button" aria-expanded="true" aria-controls="displayOptions">
                        {{ __('Display Options')}}
                        <i class="ik ik-chevron-down align-middle"></i>
                    </a>
                    <div class="collapse d-md-block display-options" id="displayOptions">
                        <div class="d-block d-md-inline-block">
                            
                            <div class="search-sm d-inline-block float-md-left mr-1 mb-1 align-top">
                                <form action="{{url('roles')}}" method="get">
                                    <input type="text" class="form-control" id="search" placeholder="Search.." name="name" value="{{ Request::input('name') }} ">
                                    <button type="submit" class="btn btn-icon"><i class="ik ik-search"></i></button>
                                    
                                    <a href="{{url('roles')}}" ><button type="button"  class="adv-btn closeicon" ><i class="fa fa-window-close" aria-hidden="true"></i></button></a>
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

                    
                            <button class="btn btn-outline-primary btn-rounded-20" href="#rolesAdd" data-toggle="modal" data-target="#rolesAdd">
                                Add Role
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
	                <div class="card-header"><h3>{{ __('Roles')}}</h3></div>
	                <div class="card-body">
                        <table id="roles_table" class="table">
                            <thead>
                                <tr>
                                    <th>{{ __('Role')}}</th>
                                    <th>{{ __('Permissions')}}</th>
                                    <th>{{ __('Action')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($roles as $role)
                                  <tr>
                                    <td>{{ isset($role->name) ? $role->name :'' }}</td>
                                    <td>
                                        @if ($role->name == 'Super Admin') 
                                            <span class="badge badge-success m-1">All permissions</span>
                                        @endif
                                    @foreach($role->permissions as $per)

                                        <span class="badge badge-dark m-1">{{ isset($per->name) ? $per->name :'' }}</span>
                                    @endforeach
                                    </td>
                                    <td>
                                     <a href="javascript:;"  class="editroleid"  data-id="{{$role->id}}" data-url="{{url('role/edit/' . $role->id)}}"><i class="ik ik-edit-2 f-16 mr-15 text-green"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <a href="javascript:;" class="deletebyid" data-id="{{ isset($role->id) ? $role->id:'' }}"  data-url="{{url('role/delete/'.$role['id'])}}"><i class="ik ik-trash-2 f-16 text-red"></i></a></td>
                                  </tr>
                                @endforeach
                             
                            </tbody>
                        </table>
                            <div class="card-footer d-flex align-items-center">
                                    <div class="col-md-6">
                                        Showing {{($roles->currentpage()-1)*$roles->perpage()+1}} to {{$roles->currentpage()*$roles->perpage()}}
                                            of  {{$roles->total()}} entries
                                    </div>
                                        
                                        <div class="col-md-6">
                                            {{ $roles->links('include.pagination') }}
                                        </div>
                            </div>
	                    
	                </div>
	            </div>
	        </div>
	    </div>
    </div>
    <div class="modal fade edit-layout-modal pr-0 " id="rolesAdd" tabindex="-1" role="dialog" aria-labelledby="rolesAddLabel" aria-hidden="true">
        <div class="modal-dialog w-300" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="categoryAddLabel">{{ __('Add Role')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <form class="forms-sample" method="POST" action="{{url('role/create')}}">
	                    	@csrf
	                        <div class="modal-body">
	                            
                                <div class="form-group">
                                    <label for="role">{{ __('Role')}}<span class="text-red">*</span></label>
                                    <input type="text" class="form-control is-valid" id="role" name="name" placeholder="Role Name" required>
                                
                            	</div>
	                            <div class="form-group">
	                                <label for="exampleInputEmail3">{{ __('Assign Permission')}} </label>
	                                
	                                	@foreach($permissions as $key => $permission)
	                                	
                                            <label class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="item_checkbox" name="permissions[]" value="{{$key}}">
                                                <span class="custom-control-label">
                                                	
                                                	{{ clean($permission,'titles')}}
                                                </span>
                                            </label>

	                                	
	                                	@endforeach
	                                </div>

	                                <div class="form-group">
	                                	<button type="submit" class="btn btn-primary btn-rounded">{{ __('Save')}}</button>
	                                </div>
	                            </div>
	                       
            	</form>
            </div>
        </div>
    </div>

    <!-- role edit modal -->
    <div class="modal fade edit-layout-modal pr-0 " id="roledit" tabindex="-1" role="dialog" aria-labelledby="roleditLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog w-300" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="categoryViewLabel">{{ __('Edit Role')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <form class="forms-sample" method="POST" action="{{url('role/update')}}">
                        @csrf
                        
                            <div class="modal-body roleper">
                                <div class="form-group ">
                                    <label for="role">{{ __('Role')}}<span class="text-red">*</span></label>
                                    <input type="text" class="form-control is-valid rolename" id="role" name="name" value="" placeholder="Insert Role">
                                    <input type="hidden" name="id" class="roleid" value="" required>
                                </div>
                           
                                <label for="exampleInputEmail3">{{ __('Assign Permission')}} </label>
                                <div id='permissiondiv' class="row appendpermission">
                                	
                                
                                </div>
                                <div class="form-group">
                                	<button type="submit" class="btn btn-primary btn-rounded">{{ __('Update')}}</button>
                                </div>
                            </div>
                       
                </form>
            </div>
        </div>
    </div>
    <!-- push external js -->
    @push('script')
    <!-- <script src="{{ asset('plugins/DataTables/datatables.min.js') }}"></script> -->
    <script src="{{ asset('plugins/select2/dist/js/select2.min.js') }}"></script>
    <!--server side roles table script-->
   <!--  <script src="{{ asset('js/custom.js') }}"></script> -->
   
   <script src="{{ url('js/global.js')}}"></script>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>
<script src = "http://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
<script type="text/javascript">

    var route = "{{ url('rolesearch') }}";
 $('#search').typeahead({
            source: function (query, process) {
                return $.get(route, {
                    query: query
                }, function (data) {
                    return process(data);
                });
            }
        });
var table = $('#roles_table').DataTable({

        paging: false,
        ordering: true,
        info: false,
        searching:false,
    });

</script>
	@endpush
@endsection
