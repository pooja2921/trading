@extends('inventory.layout') 
@section('title', 'Edit Supply Partner')
@section('content')
    <!-- push external head elements to head -->
    @push('head')
        <link rel="stylesheet" href="{{ asset('plugins/select2/dist/css/select2.min.css') }}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.css">
        <style type="text/css">
            .gsterror{
                color: red;
            }
            .emailerror{
                color: red;
            }
            .fixheader {
        position: fixed;
        top: 40px;
        width: calc(100% - 262px);
        z-index: 99;
        background: #fff;
        padding-top: 20px;
        padding-bottom: 0px;
    }
        </style>
    @endpush

    
    <div class="container-fluid">
        <div class="page-header">
            <div class="row align-items-end fixheader">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="ik ik-user-plus bg-blue"></i>
                        <div class="d-inline">
                            <h5>{{ __('Edit Supply Partner')}}</h5>
                            <span>{{ __('Edit Supply Partner')}}</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <nav class="breadcrumb-container" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{url('dashboard')}}"><i class="ik ik-home"></i></a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="#">{{ __('Edit Supply Partner')}}</a>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <form class="forms-sample" method="POST" action="{{ route('vendor.update',$vendor->id) }}" id="vedit" enctype= multipart/form-data>
            @csrf
            @method('PUT')
            <!-- start message area-->
            @include('include.message')
            <!-- end message area-->
            <div class="row">
            
                <div class="col-md-12">
                    <div class="card ">
                        <div class="card-header">
                            <strong><h3>{{ __('Basic Information')}}</h3></strong>
                        </div>
                        <div class="card-body">
                            @if (count($errors) > 0)
                               <div class = "alert alert-danger">
                                  <ul>
                                     @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                     @endforeach
                                  </ul>
                               </div>
                            @endif
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="">Product Group<span class="text-red">*</span></label>
                                            <select class="form-control select2 productgroup" id="progroup" name="product_group_id[]" multiple="multiple" data-url="{{url('childcat')}}">
                                                
                                               
                                                @foreach($categories as $vcat)

                                                    @if(in_array($vcat->id,$selected_tags))
                                                        <option value="{{$vcat->id}}" selected="true" > {{$vcat->name}}</option>
                                                    @else
                                                        <option value="{{$vcat->id}}">{{$vcat->name}}</option> 
                                                    @endif  
                                                   
                                                @endforeach

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 procategory">
                                    <div class="form-group ">
                                        <label class="d-block">Product Category</label>
                                        <select  class="form-control subcat select2" name="product_category_id[]" id="procat" data-url="{{url('/')}}" multiple="multiple">

                                        <option value="">Select Category</option> 
                                          
                                          @foreach($procategories as $cat)
                                          
                                            @if(in_array($cat->id,$parentcat))
                                                <option value="{{$cat->id}}" selected="true" > {{$cat->name}}</option>
                                            @endif 
                                          @endforeach
                                          
                            
                                        </select>
                                    </div>
                                    </div>
                                    <div class="col-sm-6 subcategory">
                                    <div class="form-group " >
                                        <label class="d-block">Sub Category</label>
                                        <select  class="form-control select2 childcat" id="subcat" name="sub_category_id[]" data-url="{{url('/')}}" multiple="multiple">

                                        <option value="">Select Category</option> 
                                          @foreach($subcategories as $scat)
                                          
                                            @if(in_array($scat->id,$subcat))
                                                <option value="{{$scat->id}}" selected="true" > {{$scat->name}}</option>
                                            @endif 
                                          @endforeach
                            
                                        </select>
                                    </div>
                                </div>
                                    
                                        <div class="col-sm-6">    
                                            <div class="form-group">
                                                <label for="bussiness_nature">Nature Of Business <span class="text-red">*</span></label>
                                                <select  class="form-control" id="bussiness_nature" name="bussiness_nature" required="">

                                            <option value="">Select Nature Of Business </option> 
                                              @if(isset($vendor->bussiness_nature) && $vendor->bussiness_nature== 'Manufacturer' || $vendor->bussiness_nature== 'Distributor' || $vendor->bussiness_nature== 'Wholesaler' || $vendor->bussiness_nature== 'Dealer' ||  $vendor->bussiness_nature== 'Trader' || $vendor->bussiness_nature== 'Retailer')
                                               <option value="Manufacturer" @if ($vendor->bussiness_nature == 'Manufacturer') {{ 'selected' }} @endif>Manufacturer</option> 
                                               <option value="Distributor" @if ($vendor->bussiness_nature == 'Distributor') {{ 'selected' }} @endif>Distributor</option>
                                               
                                               <option value="Wholesaler" @if ($vendor->bussiness_nature == 'Wholesaler') {{ 'selected' }} @endif>Wholesaler</option>
                                               
                                                <option value="Dealer" @if ($vendor->bussiness_nature == 'Dealer') {{ 'selected' }} @endif>Dealer</option>
                                                <option value="Trader" @if ($vendor->bussiness_nature == 'Trader') {{ 'selected' }} @endif>Trader</option>
                                                <option value="Retailer" @if ($vendor->bussiness_nature == 'Retailer') {{ 'selected' }} @endif>Retailer</option>

                                              @else

                                                <option value="Manufacturer">Manufacturer</option> 
                                                <option value="Distributor">Distributor</option>
                                                 <option value="Wholesaler">Wholesaler</option>
                                                <option value="Dealer">Dealer</option> 
                                                <option value="Trader">Trader</option>
                                                <option value="Retailer">Retailer</option>
                                            @endif
                                            </select>
                                            
                                            </div>
                                        </div>
                                        
                                        
                                </div>
                        </div>
                    </div>
                </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="card ">
                    <div class="card-header">
                        <strong><h3>{{ __('Primary Contact Person Details')}}</h3></strong>
                    </div>
                    <div class="card-body">
                                
                                    <div class="form-group">
                                       <label class="d-block">Salutation<span class="text-red">*</span></label>
                                        <select  class="form-control" name="salutation" required="">

                                        <option value="">Select Salutation</option> 
                                           @if(isset($vendor->salutation) && $vendor->salutation== 'Mr' || $vendor->salutation== 'Mrs' || $vendor->salutation== 'Miss'  )
                               
                                                <option value="Mr"  @if ($vendor->salutation == 'Mr') {{ 'selected' }} @endif>Mr</option>

                                                <option value="Mrs" @if ($vendor->salutation == 'Mrs') {{ 'selected' }} @endif>Mrs</option>

                                                <option value="Miss" @if ($vendor->salutation == 'Miss') {{ 'selected' }} @endif>Miss</option>
                                                        
                                            @else
                                          
                                                <option value="Mr">Mr</option> 
                                                <option value="Mrs">Mrs</option> 
                                                <option value="Miss">Miss</option> 
                                            @endif
                                        </select>
                                    </div>
                        
                                    
                
                                        <div class="form-group">
                                            <label for="first_name">First Name<span class="text-red">*</span></label>
                                            <input id="first_name" type="text" class="form-control" name="first_name" value="{{isset($vendor->first_name)  ? $vendor->first_name:'' }}" placeholder="Enter First Name" required="">
                                            <div class="help-block with-errors"></div>


                                        </div>
                
                                    <div class="form-group">
                                        <label for="middle_name">Middle  Name</label>
                                        <input id="middle_name" type="text" class="form-control" name="middle_name" value="{{isset($vendor->middle_name)  ? $vendor->middle_name:'' }}" placeholder="Enter Middle Name">
                                        


                                    </div>
                
        
                                    <div class="form-group">
                                        <label for="last_name">Last Name<span class="text-red">*</span></label>
                                        @if(isset($vendor->last_name) && $vendor->last_name!='')
                                        <input id="last_name" type="text" class="form-control" name="last_name" value="{{isset($vendor->last_name)  ? $vendor->last_name:'' }}" placeholder="Enter Last Name">
                                        @else
                                            <input id="last_name" type="text" class="form-control" name="last_name" value="NA" placeholder="Enter Last Name" required="">
                                            @endif
                                        <div class="lasterror" style="display:none;">If last name is not available please insert NA</div>


                                    </div>
                            
                            
                                <div class="form-group">
                                    <label for="designation">Designation</label>
                                    <input id="designation" type="text" class="form-control" name="designation" value="{{isset($vendor->designation)  ? $vendor->designation:'' }}" placeholder="Enter designation">
                                    <div class="help-block with-errors"></div>
                                </div>

                                
                                <div class="form-group">
                                    <label for="department">Department</label>
                                    <input id="department" type="text" class="form-control" name="department" value="{{isset($vendor->department)  ? $vendor->department:'' }}" placeholder="Enter Department">
                                
                                </div>
                            
                            
                                <div class="form-group">
                                    <label for="email">Email<span class="text-red">*</span></label>
                                    <input id="email" type="text" class="form-control email" name="email" value="{{isset($vendor->email)  ? $vendor->email:'' }}" placeholder="Enter Email" required="">
                                    <span class="emailerror"></span>
                                    <div class="help-block with-errors"></div>
                                </div>

                                <div class="form-group">
                                        <label for="password">{{ __('Password')}}<span class="text-red">*</span></label>
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Enter password" required>
                                        <div class="help-block with-errors"></div>

                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                </div>

                
                                        <div class="form-group">
                                            <label for="altemail">Alternate Email</label>
                                            <input id="altemail" type="text" class="form-control altemail" name="emailalt" value="{{isset($vendor->emailalt)  ? $vendor->emailalt:'' }}" placeholder="Enter Email">
                                            <span class="altemailerror" style="display: none;">Invalid email id</span>
                                            
                                        </div>
                    
                           
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <label for="mobile">Mobile No.<span class="text-red">*</span></label><br>
                                            <input type="hidden" name="coun_code" id="count_code">
                                             <input type="tel" id="number" class="form-control" name="mobile" value="{{isset($vendor->mobile)  ? $vendor->mobile:'' }}" required> 
                                            
                                            <span id="lblError" style="color: red"></span>
                                        </div>
                                        <div class="col-md-6">
                                        
                                                <label for="altmobile">Alternate Mobile No.</label><br>
                                                <input type="hidden" name="altcount_code" id="altcount_code">
                                                 <input type="tel" id="altmobile" class="form-control" name="mobilealt" value="{{isset($vendor->altmobile)  ? $vendor->altmobile:'' }}"> 
                                               
                                                <span id="altmblError" style="color: red"></span>
                                                
                                        </div>
                                    </div>
                                    
                                </div>

                            
                                    {{--<div class="form-group">
                                            <label for="altmobile">Alternate Mobile No.</label><br>
                                            <input type="hidden" name="altcount_code" id="altcount_code">
                                             <input type="tel" id="altmobile" class="form-control" name="mobilealt" value="{{isset($vendor->altmobile)  ? $vendor->altmobile:'' }}"> 
                                           
                                            <span id="altmblError" style="color: red"></span>
                                            
                                    </div>--}}
                    

                                
                                    <div class="form-group">
                                        <label for="landline">Landline No.</label>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <input type="hidden" name="countl_code" id="countl_code" value="91">
                                            <input id="city_code" type="text" class="form-control" name="city_code" style="width:200px;" value="{{isset($vendor->landline)  ? $vendor->landline:'' }}" placeholder="Enter STD Code" maxlength="5">
                                            </div>
                                            <div class="col-sm-6">
                                            <input id="landline" type="text" class="form-control" maxlength="8" name="landline" value="{{isset($vendor->landline)  ? $vendor->landline:'' }}" placeholder="Enter Landline">
                                            </div>
                                        </div>
                                        <span id="city_codeError" style="color: red"></span>
                                        
                                    </div>

                                    <div class="form-group">
                                        <label for="anniversary">Anniversary</label>
                                        
                                        <input id="anniversary" type="date" class="form-control" name="anniversary" value="{{isset($vendor->anniversary)  ? $vendor->anniversary:'' }}">
                                        

                                    </div>
                                
                                    <div class="form-group">
                                        <label for="birthday">Birthday</label>
                                        
                                        <input id="birthday" type="date" class="form-control" name="birthday" value="{{isset($vendor->birthday)  ? $vendor->birthday:'' }}">

                                    </div>
                            
                                
                                
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card ">
                    <div class="card-header">
                        <strong><h3>{{ __('Secondary Contact Person Details')}}</h3></strong>
                       
                    </div>
                    <div class="card-body">

                
                                    <div class="form-group">
                                       <label class="d-block">Salutation</label>
                                        <select  class="form-control" name="secondary_salutation">

                                        <option value="">Select Salutation</option> 

                                        @if(isset($vendor->secondary_salutation) && $vendor->secondary_salutation== 'Mr' || $vendor->secondary_salutation== 'Mrs' || $vendor->secondary_salutation== 'Miss'  )
                               
                                                <option value="Mr"  @if ($vendor->secondary_salutation == 'Mr') {{ 'selected' }} @endif>Mr</option>

                                                <option value="Mrs" @if ($vendor->secondary_salutation == 'Mrs') {{ 'selected' }} @endif>Mrs</option>

                                                <option value="Miss" @if ($vendor->secondary_salutation == 'Miss') {{ 'selected' }} @endif>Miss</option>
                                                        
                                            @else
                                          
                                                <option value="Mr">Mr</option> 
                                                <option value="Mrs">Mrs</option> 
                                                <option value="Miss">Miss</option> 
                                            @endif
                                        </select>
                                    </div>
                                
                                    
                           
                                        <div class="form-group">
                                            <label for="secondary_first_name">First Name</label>
                                            <input id="secondary_first_name" type="text" class="form-control" name="secondary_first_name" value="{{isset($vendor->secondary_first_name)  ? $vendor->secondary_first_name:'' }}" placeholder="Enter First Name">
                                            


                                        </div>
                                
                            
                                    <div class="form-group">
                                        <label for="secondary_middlename">Middle  Name</label>
                                        <input id="secondary_middlename" type="text" class="form-control" name="secondary_middlename" value="{{isset($vendor->secondary_middlename)  ? $vendor->secondary_middlename:'' }}" placeholder="Enter Middle Name">
                                        


                                    </div>
                                
                                
                                    <div class="form-group">
                                        <label for="secondary_lastname">Last Name</label>
                                        <input id="secondary_lastname" type="text" class="form-control" name="secondary_lastname" value="{{isset($vendor->secondary_lastname)  ? $vendor->secondary_lastname:'' }}" placeholder="Enter Last Name">

                                    </div>
                        
                            
                                <div class="form-group">
                                    <label for="secondary_designation">Designation</label>
                                    <input id="secondary_designation" type="text" class="form-control" name="secondary_designation" value="{{isset($vendor->secondary_designation)  ? $vendor->secondary_designation:'' }}" placeholder="Enter designation">
                                    
                                </div>

                                
                                        <div class="form-group">
                                            <label for="department">Department</label>
                                            <input id="secondary_department" type="text" class="form-control" name="secondary_department" value="{{isset($vendor->secondary_department)  ? $vendor->secondary_department:'' }}" placeholder="Enter Department">
                                        
                                        </div>
                        
                            
                                <div class="form-group">
                                    <label for="secondary_email">Email</label>
                                    <input id="secondary_email" type="text" class="form-control secondary_email" name="secondary_email" value="{{isset($vendor->secondary_email)  ? $vendor->secondary_email:'' }}" placeholder="Enter Email" >
                                   
                                    
                                </div>

                            
                                        <div class="form-group">
                                            <label for="altemail">Alternate Email</label>
                                            <input id="secondary_emailalt" type="text" class="form-control second_altemail" name="secondary_emailalt" value="{{isset($vendor->secondary_emailalt)  ? $vendor->secondary_emailalt:'' }}" placeholder="Enter Email">
                                            <span class="altemailerror" style="display: none;">Invalid email id</span>
                                            
                                        </div>
                
                           
                                <div class="form-group">
                                    <label for="mobile">Mobile No.</label><br>
                                    <input type="hidden" name="second_coun_code" id="second_count_code">
                                     <input type="tel" id="second_mobile" class="form-control" name="secondary_mobile" value="{{isset($vendor->secondary_mobile)  ? $vendor->secondary_mobile:'' }}"> 
                                    
                                    
                                    
                                </div>

                              
                                    <div class="form-group">
                                            <label for="altmobile">Alternate Mobile No.</label><br>
                                            <input type="hidden" name="second_altcount_code" id="second_altcount_code">
                                             <input type="tel" id="second_altmobile" class="form-control" name="mobilealt" value="{{isset($vendor->altmobile)  ? $vendor->altmobile:'' }}"> 
                                           
                                    
                                            
                                    </div>
                    
                                
                                    <div class="form-group">
                                        <label for="landline">Landline No.</label>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <input type="hidden" name="second_countl_code" id="second_countl_code" value="91">
                                            <input id="second_city_code" type="text" class="form-control" name="secondcity_code" style="width:200px;" value="" placeholder="Enter STD Code" maxlength="5">
                                            </div>
                                            <div class="col-sm-6">
                                            <input id="second_landline" type="text" class="form-control" maxlength="8" name="second_landline" value="{{isset($vendor->second_landline)  ? $vendor->second_landline:'' }}" placeholder="Enter Landline">
                                            </div>
                                        </div>
                                    </div>  
                                    <div class="form-group">
                                        <label for="secondary_anniversary">Anniversary</label>
                                        
                                        <input id="secondary_anniversary" type="date" class="form-control" name="secondary_anniversary" value="{{isset($vendor->secondary_anniversary)  ? $vendor->secondary_anniversary:'' }}">
                                        

                                    </div>
                        

                                
                                    <div class="form-group">
                                        <label for="secondary_birthday">Birthday</label>
                                        
                                        <input id="secondary_birthday" type="date" class="form-control" name="secondary_birthday" value="{{isset($vendor->secondary_birthday)  ? $vendor->secondary_birthday:'' }}">

                                    </div>             
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            
            <div class="col-md-12">
                <div class="card ">
                    <div class="card-header">
                        <strong><h3>{{ __('Company Details')}}</h3></strong>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="company_name">Company Name<span class="text-red">*</span></label>
                                        <input id="company_name" type="text" class="form-control" name="company_name" value="{{isset($vendor->company_name)  ? $vendor->company_name:'' }}" placeholder="Enter Company Name" required="">
                                        
                                    </div>
                                </div>
                                   
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="email">Client Type<span class="text-red">*</span></label>
                                       <select  class="form-control clientType" name="clientType" id="clientType" >
                                        <option value="">Select Client Type</option> 

                                        @if(isset($vendor->clientType) && $vendor->clientType=='Consumer' || $vendor->clientType=='Unregistered' || $vendor->clientType=='Registered-Composite' || $vendor->clientType== 'Registered' )
                               
                                                <option value="Consumer"  {{ ($vendor->clientType) == 'Consumer' ? 'selected' : '' }}>Consumer</option>

                                                <option value="Unregistered"  {{ ($vendor->clientType) == 'Unregistered' ? 'selected' : '' }}>Unregistered</option>

                                        
                                                <option value="Registered"  {{ ($vendor->clientType) == 'Registered' ? 'selected' : '' }}>Registered</option>

                                                <option value="Registered-Composite"  {{ ($vendor->clientType) == 'Registered-Composite' ? 'selected' : '' }}>Registered-Composite</option>
                                            @else
                                                <option value="Consumer">Consumer</option> 
                                                <option value="Unregistered">Unregistered</option> 
                                                <option value="Registered">Registered</option> 
                                                <option value="Registered-Composite">Registered-Composite</option> 
                                            @endif
                                        </select>
                                        
                                    </div>
                                </div>
                                    
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="gst">GST Number<span class="text-red">*</span></label>
                                        <input id="gst" type="text" class="form-control gst" name="gst_number" value="{{isset($vendor->gst_number)  ? $vendor->gst_number:'' }}" placeholder="Enter GST Number"  maxlength="15" style="text-transform:uppercase;" >
                                        <span class="gstverify"></span>
                                        <span class="gsterror"></span>
                                        
                                    </div>  
                                </div>

                                 <div class="col-sm-6"></div>

                                 <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Address Line 1</label>
                                        <textarea class="form-control" name="address_1" rows="2">{{isset($vendor->address_1)  ? $vendor->address_1:'' }}</textarea>

                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Address Line 2</label>
                                        <textarea class="form-control" name="address_2" rows="2">{{isset($vendor->address_2)  ? $vendor->address_2:'' }}</textarea>

                                    </div>
                                </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                        <label for="country">Country</label>
                                        <select  class="form-control" name="country_id" id="country" >
                                        <option value="">Select Country</option> 
                                            @foreach($countries as $country)


                                                @if($country->exists && $country->id == $vendor->country_id)
                                                    <option value="{{$country->id}}" selected="selected">{{$country->name}}</option> 
                                                @else
                                                    <option value="{{$country->id}}">{{$country->name}}</option>
                                                @endif 
                                             @endforeach
                                        
                                        </select>
                                        
                                        
                                </div>
                            </div>
                            
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="state">State</label>
                                    <select  class="form-control" name="state_id" id="tradestate" data-url="{{route('getCity')}}">

                                        <option value="">Select State</option> 
                                            @foreach($states as $state)
                                                @if($state->exists && $state->id == $vendor->state_id)
                                                    <option value="{{ $state->id }}" selected="selected">{{ $state->name }}</option>
                                                @else
                                                    <option value="{{$state->id}}">{{$state->name}}</option>
                                                @endif 
                                            @endforeach
                                        
                                        </select>
                                    
                                </div>
                            </div>
                       
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="city">City</label>
                                    <select  class="form-control" name="city_id" id="tradecity">
                                       @foreach($cities as $city)
                                                @if($city->exists && $city->id == $vendor->city_id)
                                                    <option value="{{ $city->id }}" selected="selected">{{ $city->name }}</option>

                                                @else
                                                    <option value="{{$city->id}}">{{$city->name}}</option> 
                                                @endif
                                             @endforeach 
                                    </select>
                                    
                                </div>
                            </div>

                            

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="pincode">Pincode</label>
                                    <input id="pincode" type="text" class="form-control" name="pincode" placeholder="Enter Pincode" value="{{isset($vendor->pincode)  ? $vendor->pincode:'' }}">
                                    
                                </div> 
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="secondlatitude">Latitude</label>
                                    <input id="secondlatitude" type="text" class="form-control" name="latitude" value="{{isset($vendor->latitude)  ? $vendor->latitude:'' }}" placeholder="Enter Latitude" >
                                    
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="secondlongitude">Longitude</label>
                                    <input id="secondlongitude" type="text" class="form-control" name="longitude" value="{{isset($vendor->longitude)  ? $vendor->longitude:'' }}" placeholder="Enter Longitude" >
                                    
                                </div>
                            </div>

                        </div>      
                    </div>
                </div>
            </div>

            
        </div>
        <div class="row">
            <!-- start message area-->
            
            <!-- end message area-->
            <div class="col-md-12">
                <div class="card ">
                    <div class="card-body">
                        <div class="col-md-12" style="text-align: center;">
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">{{ __('Update')}}</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- push external js -->
    @push('script') 
     <script src="{{ asset('plugins/select2/dist/js/select2.min.js') }}"></script> 
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>

    <script type="text/javascript">

    /*var route = "{{ url('categorysearch') }}";
    $('#search').typeahead({
            source: function (query, process) {
                return $.get(route, {
                    query: query
                }, function (data) {
                    return process(data);
                });
            }
        });
*/
 /*var route = "{{ url('categorysearch') }}";
 $('#subcat').typeahead({
            source: function (query, process) {
                return $.get(route, {
                    query: query
                }, function (data) {
                    return process(data);
                });
            }
        });*/
    </script>

    <script>
        /*$(document).ready(function(){
            console.log($("#progroup").data('url'));
        });*/
        /*var route = "{{ url('procat') }}";
        $('#progroup').typeahead({
            source: function (query, process) {
                return $.get(route, {
                    query: query
                }, function (data) {
                    return process(data);
                });
            }
        });*/
        /*var $company2 = $('#progroup');
        $company2.select2().on('change', function() {
            var url=$("#progroup").data('url');
    $.ajax({
        url:url, // if you say $(this) here it will refer to the ajax call not $('.company2')
        type:'GET',
        success:function(data) {
            
            $.each(data, function(value, key) {
                $company2.append($("<option></option>").attr("value", value).text(key)); // name refers to the objects value when you do you ->lists('name', 'id') in laravel
            });
            $company2.select2(); //reload the list and select the first option
        }
    });
}).trigger('change');*/
    /*$("#progroup").select2({

    placeholder: "Search for category",
    category : true,
    tokenSeparators: [","],
    ajax: {
        url: $("#progroup").data('url'),
        dataType: 'json',
        delay: 250,
        data: function(params) {
            return {
                q: params.term, // search term
            };
        },
        processResults: function(data, params) {
            
            console.log(data);
            return {
                results: data,

            };
        },
        cache: true
    },

}).on("change", function(e) {
//alert('ghnjgfhjg');
    var isNew = $(this).find('.select2-search .select2-search--inline');
    console.log(isNew);
    if (isNew.length) {
        isNew.replaceWith('<option selected value="' + isNew.val() + '">' + isNew.val() + '</option>');
        $.ajax({
            
        });
    }
    $('.select2-search .select2-search--inline input').val('');
});*/
        
    </script> 

    <script type="text/javascript">
        $(function () {
        $('#dropify').dropify();
        });
        $('#tradestate').on('change', function() {
            //alert('xdvgdfgdf');
            var state_id = this.value;
            console.log(state_id);
            var url=$(this).data('url');
            console.log(url);
             $("#tradecity").html('');
            $.ajax({
                url:url,
                type: "GET",
                data: {
                    state_id: state_id
                },
                dataType : 'json',
                success: function(result){
                    console.log(result);
                    $.each(result.city,function(key,value){
                    $("#tradecity").append('<option value="'+value.id+'">'+value.name+'</option>');
                    });
                }
            });
        
        
        });

        $('#secondarystate').on('change', function() {
            //alert('xdvgdfgdf');
            var state_id = this.value;
            console.log(state_id);
            var url=$(this).data('url');
            console.log(url);
             $("#secondarycity").html('');
            $.ajax({
                url:url,
                type: "GET",
                data: {
                    state_id: state_id
                },
                dataType : 'json',
                success: function(result){
                    console.log(result);
                    $.each(result.city,function(key,value){
                    $("#secondarycity").append('<option value="'+value.id+'">'+value.name+'</option>');
                    });
                }
            });
        
        
        });
    </script>
    <!-- image -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>

<link href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/11.0.9/css/intlTelInput.css" rel="stylesheet" media="screen">
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/11.0.9/js/intlTelInput.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/11.0.9/js/intlTelInput.min.js"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/11.0.9/js/utils.js"></script> -->
   
    <script type="text/javascript"> 
    $('#vedit').submit(function () {        
    //alert('fbcbcvbc');
            var clienttype =   $('#clientType').val();
            console.log(clienttype); 
            if(clienttype == 'Registered' || clienttype =='Registered-Composite'){
                //alert('gst');

                var inputvalues = $(".gst").val(); 
                //alert(inputvalues); 
                if(inputvalues==''){
                   // alert('fbhgfhgf');
                    $(".gstmsg").html('Please Enter GSTIN Number');
                    $(".gst").focus();  
                    return false;  
                }
                var gstinformat = new RegExp('^[0-9]{2}[A-Z]{5}[0-9]{4}[A-Z]{1}[1-9]{1}Z[a-zA-Z0-9]{1}$');

                if (gstinformat.test(inputvalues)) { 
                //$(".gstverify").html("GSTIN Number Format is Verified");  
                //$(this).removeclass(".gsterror");
                    return true;    
                } else {    
                    $(".gsterror").html('Please Enter Valid GSTIN Number');    
                    //$(".gst").val('');    
                    $(".gst").focus();  
                    return false;  
                }   
            }   
   
    });      
    
</script>  

<script type="text/javascript">              
    
$(".email").change(function () {    
var inputvalues = $(this).val();    
var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;    
if(!regex.test(inputvalues)){    
$(".emailerror").html("invalid email id");    
return regex.test(inputvalues);    
}    

});    
      

$("#number").intlTelInput({

  separateDialCode: true,
  preferredCountries:["in"],
  hiddenInput: "full",
  utilsScript: "//cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.3/js/utils.js"
});

$('#altmobile').intlTelInput({
    separateDialCode: true,
  preferredCountries:["in"],
  hiddenInput: "full",
  utilsScript: "//cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.3/js/utils.js"
});

$('#city_code').intlTelInput({
    separateDialCode: true,
  preferredCountries:["in"],
  hiddenInput: "full",
  utilsScript: "//cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.3/js/utils.js"
});


$('#second_mobile').intlTelInput({
    separateDialCode: true,
  preferredCountries:["in"],
  hiddenInput: "full",
  utilsScript: "//cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.3/js/utils.js"
});

$('#second_altmobile').intlTelInput({
    separateDialCode: true,
  preferredCountries:["in"],
  hiddenInput: "full",
  utilsScript: "//cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.3/js/utils.js"
});

$('#second_city_code').intlTelInput({
    separateDialCode: true,
  preferredCountries:["in"],
  hiddenInput: "full",
  utilsScript: "//cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.3/js/utils.js"
});

  $(function () {
        $("#number").keypress(function (e) {
            var num=$(this).value;
            //alert(num);
            var keyCode = e.keyCode || e.which;
 
            $("#lblError").html("");
 
            //Regex for Valid Characters i.e. Numbers.
            var regex = /^[0-9]+$/;
            
            //Validate TextBox value against the Regex.
            var isValid = regex.test(String.fromCharCode(keyCode));
            if (!isValid) {
                $("#lblError").html("Only Numbers allowed.");
                return false;  
            }
            else{
                return true;
            }
 
            //return isValid;
        });
    });   


    $(function () {
        $("#mobile").keypress(function (e) {
            //alert('dgfdfhh');
            var num=$(this).value;
            //alert(num);
            var keyCode = e.keyCode || e.which;
 
            $("#mblError").html("");
 
            //Regex for Valid Characters i.e. Numbers.
            var regex = /^[0-9]+$/;
            
            //Validate TextBox value against the Regex.
            var isValid = regex.test(String.fromCharCode(keyCode));
            if (!isValid) {
                $("#mblError").html("Only Numbers allowed.");
                e.preventDefault();
                return false;  
            }
            else{
                return true;
            }
 
            //return isValid;
        });
    });   

$(document).ready(function () {        
    
$("#number").change(function () {   
var getCode = $(this).intlTelInput('getSelectedCountryData').dialCode;
console.log(getCode);
$('#count_code').val(getCode);
var inputvalues = $(this).val();    
var regex = /^(\+?\d{1,4}[\s-])?(?!0+\s+,?$)\d{10}\s*,?$/;
              if(!regex.test(inputvalues)){    
                $("#lblError").html("invalid mobile number");    
                return regex.test(inputvalues);  
                return false;  
                }      

});   


$("#second_mobile").change(function (event) {   
var getCode = $(this).intlTelInput('getSelectedCountryData').dialCode;
console.log(getCode);
$('#second_count_code').val(getCode);
var inputvalues = $(this).val();    
var regex = /^(\+?\d{1,4}[\s-])?(?!0+\s+,?$)\d{10}\s*,?$/;
              if(!regex.test(inputvalues)){    
                $("#mblError").html("invalid mobile number");    
                //return regex.test(inputvalues); 
                event.preventDefault(); 
                return false;  
                }      

});   


$('#progroup').change(function() {
       
            
            var product=$("#progroup :selected").map((_, e) => e.value).get();
            console.log(product);
            var publicurl= $(this).data('url');
            console.log(publicurl);
            if(product!=''){
                $.ajax({
                    url:publicurl,
                    type:'GET',
                    data:{'id':product},
                    success:function(data){
                        console.log(data);
                        var row='';
                                row+='<option value=>Select Product Category</option>';
                                jQuery.each(data, function(i, cat){
                                row+='<option value='+cat['id']+'>'+cat['name']+'</option>';
                                });
                            $('.procategory').css('display','block');
                            $('#procat').html(row);
                    }
                });
            }
        });

        $('.subcat').change(function() { 
            //console.log('gfbhngfgfh');
            var sub=$(".subcat :selected").map((_, e) => e.value).get();
            console.log(sub);
            var publicurl= $('.subcat').data('url');
            //console.log(publicurl);
            if(sub!=''){

                $.ajax({
                    url:publicurl+'/subcat',
                    type:'GET',
                    data:{'id':sub},
                    success:function(data){
                        console.log(data);
                        var row='';

                            row+='<option value="">Select Category</option>'; 

                            jQuery.each(data, function(i, subcat){
                            row+='<option value='+subcat['id']+'>'+subcat['name']+'</option>';
                            });

                            $('.subcategory').css('display','block');
                            $('#subcat').html(row);
                    }
                });
              
            }
        });
/*$('.progroup').keypress(function() {
        alert('fbghfhgfh');
            
            var product=$(".productgroup").val();
            console.log(product);
            var publicurl= $(this).data('url');
            if(product!=''){
                $.ajax({
                    url:publicurl+'/childcat/',
                    type:'GET',
                    data:{'id':product},
                    success:function(data){
                        console.log(data);
                        var row='';
                                row+='<option value=>Select Product Category</option>';
                                jQuery.each(data, function(i, cat){
                                row+='<option value='+cat['id']+'>'+cat['name']+'</option>';
                                });
                            $('.procategory').css('display','block');
                            $('#procat').html(row);
                    }
                });
            }
});*/

/*$("#landline").change(function () {    
var inputvalues = $(this).val();    
var regex = /^[\d]{3,4}[\-\s]*[\d]{6,7}$/;
              if(!regex.test(inputvalues)){    
                $("#lndlineError").html("invalid mobile number");    
                return regex.test(inputvalues);   
                return false;   
                }      

});    */
    
}); 

</script> 
    @endpush
@endsection
