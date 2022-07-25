@extends('inventory.layout') 
@section('title', 'Profile')
@section('content')
    

    <div class="container-fluid">
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="ik ik-file-text bg-blue"></i>
                        <div class="d-inline">
                            <h5>{{ __('Profile')}}</h5>
                            <!-- <span>{{ __('lorem ipsum dolor sit amet, consectetur adipisicing elit')}}</span> -->
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
                                <a href="#">{{ __('User')}}</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">{{ __('Profile')}}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-4 col-md-5">
                <div class="card">
                    <div class="card-body">
                        <div class="text-center"> 
                            <img src="../img/user.jpg" class="rounded-circle" width="150" />
                            <h4 class="card-title mt-10">{{ (isset($user->name) ? $user->name:'')}}</h4>
                            
                        </div>
                    </div>
                    <hr class="mb-0"> 
                    <div class="card-body"> 
                        <small class="text-muted d-block">{{ __('Email address')}} </small>
                        <h6>{{ (isset($user->email) ? $user->email:'')}}</h6> 
                        <small class="text-muted d-block pt-10">{{ __('Phone')}}</small>
                        <h6>{{ isset($user->phone) ? $user->phone:''}}</h6> 
                        
                        
                    </div>
                </div>
            </div>
            <div class="col-lg-8 col-md-7">
                <div class="card">
                    <ul class="nav nav-pills custom-pills" id="pills-tab" role="tablist">
                        
                        <li class="nav-item">
                            <a class="nav-link active" id="pills-profile-tab" data-toggle="pill" href="#last-month" role="tab" aria-controls="pills-profile" aria-selected="false">{{ __('Profile')}}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-setting-tab" data-toggle="pill" href="#previous-month" role="tab" aria-controls="pills-setting" aria-selected="false">{{ __('Setting')}}</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="pills-tabContent">
                        
                        <div class="tab-pane fade show active" id="last-month" role="tabpanel" aria-labelledby="pills-profile-tab">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-3 col-6"> <strong>{{ __('Full Name')}}</strong>
                                        <br>
                                        <p class="text-muted">{{ (isset($user->name) ? $user->name:'')}}</p>
                                    </div>
                                    <div class="col-md-3 col-6"> <strong>{{ __('Mobile')}}</strong>
                                        <br>
                                        <p class="text-muted">{{ isset($user->phone) ? $user->phone:''}}</p>
                                    </div>
                                    <div class="col-md-3 col-6"> <strong>{{ __('Email')}}</strong>
                                        <br>
                                        <p class="text-muted">{{ isset($user->email) ? $user->email:''}}</p>
                                    </div>
                                    
                                </div>
                                
                                
                            </div>
                        </div>
                        <div class="tab-pane fade" id="previous-month" role="tabpanel" aria-labelledby="pills-setting-tab">
                            <div class="card-body">
                                <form class="forms-sample" method="POST" action="{{ url('updateuser') }}" >
                                @csrf
                                <input type="hidden" name="id" value="{{ (isset($user->id) ? $user->id:'')}}">
                                    <div class="form-group">
                                        <label for="example-name">{{ __('Full Name')}}</label>
                                        <input type="text" placeholder="Name" class="form-control" name="name" id="example-name" value="{{ (isset($user->name) ? $user->name:'')}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="example-email">{{ __('Email')}}</label>
                                        <input type="email" placeholder="Email" class="form-control" name="email" id="example-email" value="{{ isset($user->email) ? $user->email:''}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="example-password">{{ __('Password')}}</label>
                                        <input type="password" class="form-control" name="password" id="example-password">
                                    </div>
                                    {{--<div class="form-group">
                                        <label for="example-phone">{{ __('Phone No')}}</label>
                                        <input type="text" placeholder="123 456 7890" id="example-phone" name="phone" class="form-control" value="{{ isset($user->phone) ? $user->phone:''}}">
                                    </div>--}}
                                    
                                    
                                    <button class="btn btn-success" type="submit">Update Profile</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
