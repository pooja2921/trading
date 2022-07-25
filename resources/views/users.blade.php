@extends('inventory.layout') 
@section('title', 'Users')
@section('content')
    <!-- push external head elements to head -->
    @push('head')
        <link rel="stylesheet" href="{{ asset('plugins/DataTables/datatables.min.css') }}">
        <style>
        .error{
            color: red;
        }
    </style>
    @endpush

    
    <div class="container-fluid">
    	<div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="ik ik-users bg-blue"></i>
                        <div class="d-inline">
                            <h5>{{ __('Users')}}</h5>
                            <span>{{ __('List of users')}}</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <nav class="breadcrumb-container" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{route('dashboard')}}"><i class="ik ik-home"></i></a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="#">{{ __('Users')}}</a>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="mb-2 clearfix">
                    <a class="btn pt-0 pl-0 d-md-none d-lg-none" data-toggle="collapse" href="#displayOptions" role="button" aria-expanded="true" aria-controls="displayOptions">
                        {{ __('Display Options')}}
                        <i class="ik ik-chevron-down align-middle"></i>
                    </a>
                    <div class="collapse d-md-block display-options" id="displayOptions">
                        
                        <div class="d-block d-md-inline-block">
                            
                            <div class="search-sm d-inline-block float-md-left mr-1 mb-1 align-top">
                                <form action="{{url('users')}}" method="get" >
                                    <input type="text" class="form-control" id="search" placeholder="Search.." name="name" value="{{ Request::input('name') }} ">
                                    <button type="submit" class="btn btn-icon"><i class="ik ik-search"></i></button>
                                    
                                    <a href="{{url('users')}}" ><button type="button"  class="adv-btn closeicon" ><i class="fa fa-window-close" aria-hidden="true"></i></button></a>
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

                    
                            <button class="btn btn-outline-primary btn-rounded-20" href="#userAdd" data-toggle="modal" data-target="#userAdd">
                                Add User
                            </button>
                        </div>
                    </div>
                </div>
            <!-- start message area-->
            
            <!-- end message area-->
            <div class="col-md-12">
                <div class="card p-3">
                    <div class="card-header"><h3>{{ __('Users')}}</h3></div>
                    <div class="card-body">
                        <table id="user_table" class="table">
                                    <thead>
                                        <tr>
                                            <th>{{ __('Name')}}</th>
                                            <th>{{ __('User Code')}}</th>
                                            <th>{{ __('Email')}}</th>
                                            <th>{{ __('Role')}}</th>
                                            
                                            <th>{{ __('Action')}}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($users as $user)
                                          <tr>
                                            <td>{{ isset($user->name) ? $user->name :'' }}</td>
                                            <td>{{ isset($user->user_code) ? $user->user_code :'' }}</td>
                                            <td>{{ isset($user->email) ? $user->email :'' }}</td>
                                            <td>
                                            @foreach($user->roles as $role)
                                                {{ isset($role->name) ? $role->name :'' }}
                                            @endforeach
                                            </td>
                                    
                                            
                                            <td>
                                             <a href="javascript:;"  class="edituserid"  data-id="{{$user->id}}" data-url="{{url('user/' . $user->id) }}"><i class="ik ik-edit-2 f-16 mr-15 text-green"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            <a href="javascript:;" class="deletebyid" data-id="{{ isset($user->id) ? $user->id:'' }}"  data-url="{{url('user/delete/'.$user['id'])}}"><i class="ik ik-trash-2 f-16 text-red"></i></a></td>
                                          </tr>
                                        @endforeach
                                     
                                      </tbody>
                        </table>
                            <div class="card-footer d-flex align-items-center">
                                <div class="col-md-6">Showing {{($users->currentpage()-1)*$users->perpage()+1}} to {{$users->currentpage()*$users->perpage()}}
                                            of  {{$users->total()}} entries
                                        </div>
                                        
                                        <div class="col-md-6">
                            {{ $users->links('include.pagination') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <div class="modal fade edit-layout-modal pr-0 " id="userAdd" tabindex="-1" role="dialog" aria-labelledby="userAddLabel" aria-hidden="true">
        <div class="modal-dialog w-300" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="categoryAddLabel">{{ __('Add User')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <form class="forms-sample" method="POST" action="{{ route('create-user') }}" id="regForm">
                        @csrf
                    <div class="modal-body">
                   
                        
                            <div class="row">
                                

                                    <div class="form-group">
                                        <label for="name">{{ __('Username')}}<span class="text-red">*</span></label>
                                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="" placeholder="Enter user name" required>
                                        <div class="help-block with-errors"></div>

                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="mobile">{{ __('mobile')}}<span class="text-red">*</span></label>
                                        <input id="mobile" type="text" class="form-control @error('mobile') is-invalid @enderror" name="mobile" value="" placeholder="Enter user mobile" required>
                                        <div class="help-block with-errors"></div>

                                        @error('mobile')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="email">{{ __('Email')}}<span class="text-red">*</span></label>
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Enter email address" required>
                                        <div class="help-block with-errors" ></div>

                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                   
                                    <div class="form-group">
                                        <label for="password">{{ __('Password')}}<span class="text-red">*</span></label>
                                        <input id="password" type="password" class="form-control password @error('password') is-invalid @enderror" name="password" placeholder="Enter password" required>
                                        <div class="help-block with-errors"></div>

                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="password-confirm">{{ __('Confirm Password')}}<span class="text-red">*</span></label>
                                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Retype password" required>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                
                                    <!-- Assign role & view role permisions -->
                                    <div class="form-group">
                                        <label for="role">{{ __('Assign Role')}}<span class="text-red">*</span></label>
                                        {!! Form::select('role', $roles, null,[ 'class'=>'form-control select2', 'placeholder' => 'Select Role','id'=> 'role', 'required'=> 'required']) !!}
                                    </div>
                                    <div class="form-group" >
                                        <label for="role">{{ __('Permissions')}}</label>
                                        <div id="permission" class="form-group" style="border-left: 2px solid #d1d1d1;">
                                            <span class="text-red pl-3">Select role first</span>
                                        </div>
                                        <input type="hidden" id="token" name="token" value="{{ csrf_token() }}" data-url="{{url('/')}}">

                                    </div>
                            
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">{{ __('Submit')}}</button>
                                    </div>
                                </div>
                            </div>
                        
            
                    
                  </div>
                </form>
            </div>
        </div>
    </div>

    <!-- category edit modal -->
    <div class="modal fade edit-layout-modal pr-0 " id="categoryView" tabindex="-1" role="dialog" aria-labelledby="categoryViewLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog w-300" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="categoryViewLabel">{{ __('Edit User')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <form class="forms-sample" method="POST" action="{{ url('user/update') }}" >
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" class="userid" name="id" value="">
                            <div class="row">
                        

                                    <div class="form-group">
                                        <label for="name">{{ __('Username')}}<span class="text-red">*</span></label>
                                        <input id="name" type="text" class="form-control username" name="name" value="" required>
                                        <div class="help-block with-errors"></div>

                                        
                                    </div>
                                    <div class="form-group">
                                        <label for="email">{{ __('Email')}}<span class="text-red">*</span></label>
                                        <input id="email" type="email" class="form-control useremail" name="email" value="" required>
                                        <div class="help-block with-errors"></div>

                                        
                                    </div>

                                   
                                    <div class="form-group">
                                        <label for="password">{{ __('Password')}}</label>
                                        <input id="password" type="password" class="form-control password" name="password"  >
                                        <div class="help-block with-errors"></div>

                                        
                                    </div>
                                    <div class="form-group">
                                        <label for="password-confirm">{{ __('Confirm Password')}}</label>
                                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                
                                
                                
                                    <!-- Assign role & view role permisions -->
                                    <div class="form-group">
                                        <label for="role">{{ __('Assign Role')}}<span class="text-red">*</span></label>
                                        {!! Form::select('role', $roles, $user_role->id??'' ,[ 'class'=>'form-control select2', 'placeholder' => 'Select Role','id'=> 'role', 'required'=>'required']) !!}
                                    </div>
                                    <div class="form-group">
                                        <label for="role">{{ __('Permissions')}}</label>
                                        <div id="permissionappend" class="form-group permission">
                                            {{--@foreach($user->getAllPermissions() as $key => $permission) 
                                            <span class="badge badge-dark m-1">
                                                <!-- clean unescaped data is to avoid potential XSS risk -->
                                                {{ clean($permission->name, 'titles')}}
                                            </span>
                                            @endforeach--}}
                                        </div>
                                        <input type="hidden" id="token" name="token" value="{{ csrf_token() }}"  data-url="{{url('/')}}">
                                    </div>
                                
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary form-control-right">{{ __('Update')}}</button>
                                    </div>
                                </div>
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
    <!--server side users table script-->
    <!-- <script src="{{ asset('js/custom.js') }}"></script> -->
         <!--get role wise permissiom ajax script-->
         <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>
    <script src="{{ asset('js/get-role.js') }}"></script>
    <script src="{{ url('js/global.js')}}"></script>
    <script src = "http://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js"></script>
<script>
 $(document).ready(function() {

    $("#regForm").validate({
        rules: {
           name: {
                required: true
            },
            email: {
                required: true,
                email: true
            },
            password: {
                required: true,
                minlength: 8
            },
            password_confirmation:  {
                required: true,
                equalTo: ".password"
            }, 
        }
    });
    });
</script>
<script type="text/javascript">

    var route = "{{ url('usersearch') }}";
 $('#search').typeahead({
            source: function (query, process) {
                return $.get(route, {
                    query: query
                }, function (data) {
                    return process(data);
                });
            }
        });

var table = $('#user_table').DataTable({

        paging: false,
        ordering: true,
        info: false,
        searching:false,
    });
</script>
    @endpush
@endsection
