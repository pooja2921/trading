@extends('inventory.layout') 
@section('title', 'Edit Cliets')
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
            .gstverify{
                color: #4b9732;
            }
            .lasterror{
                color: red;
            }
            .altemailerror{
                color: red;
            }
            .gstmsg{
                color:red;
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
                            <h5>{{ __('Edit Clients')}}</h5>
                            <span>{{ __('Edit Clients')}}</span>
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
                                <a href="#">{{ __('Edit Clients')}}</a>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <form class="forms-sample" method="POST" action="{{ route('client.update',$client->id) }}" enctype= multipart/form-data id="editform">
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
                                       <label class="d-block">Salutation<span class="text-red">*</span></label>
                                        <select  class="form-control" name="salutation" required="">

                                        <option value="">Select Salutation</option> 
                                          @if(isset($client->salutation) && $client->salutation== 'Mr' || $client->salutation== 'Mrs' || $client->salutation== 'Miss'  )
                               
                                                <option value="Mr"  @if ($client->salutation == 'Mr') {{ 'selected' }} @endif>Mr</option>

                                                <option value="Mrs" @if ($client->salutation == 'Mrs') {{ 'selected' }} @endif>Mrs</option>

                                                <option value="Miss" @if ($client->salutation == 'Miss') {{ 'selected' }} @endif>Miss</option>
                                                        
                                            @else

                                            <option value="Mr">Mr</option> 
                                            <option value="Mrs">Mrs</option> 
                                            <option value="Miss">Miss</option> 
                                            @endif
                                        
                                        </select>
                                    </div>
                                </div>
                                    
                                <div class="col-sm-6">    
                                        <div class="form-group">
                                            <label for="first_name">First Name<span class="text-red">*</span></label>
                                            <input id="first_name" type="text" class="form-control" name="first_name" value="{{isset($client->first_name) ? $client->first_name:''}}" placeholder="Enter First Name" required="">
                                            <div class="help-block with-errors"></div>


                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="middle_name">Middle  Name</label>
                                            <input id="middle_name" type="text" class="form-control" name="middle_name" value="{{isset($client->middle_name) ? $client->middle_name :''}}" placeholder="Enter Middle Name">
                                            <div class="help-block with-errors"></div>


                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="last_name">Last Name<span class="text-red">*</span></label>
                                            @if(isset($client->last_name) && $client->last_name!='')
                                            <input id="last_name" type="text" class="form-control" name="last_name" value="{{isset($client->last_name) ? $client->last_name :''}}" placeholder="Enter Last Name" required="">
                                            @else
                                            <input id="last_name" type="text" class="form-control" name="last_name" value="NA" placeholder="Enter Last Name" required="">
                                            @endif
                                            <div class="lasterror" style="display:none;">If last name is not available please insert NA</div>


                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="designation">Designation<span class="text-red">*</span></label>
                                                <input id="designation" type="text" class="form-control" name="designation" value="{{isset($client->designation) ? $client->designation :''}}" placeholder="Enter Designation" required="">

                                            </div>
                                        </div>

                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="department">Department<span class="text-red">*</span></label>
                                                <input id="department" type="text" class="form-control" name="department" value="{{isset($client->department) ? $client->department :''}}" placeholder="Enter Department" required="">
                                            
                                            </div>
                                        </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="email">Official Email<span class="text-red">*</span></label>
                                            <input id="email" type="text" class="form-control" name="email" value="{{isset($client->email) ? $client->email:''}}" placeholder="Enter Email" required="">
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="altemail">Alternate Email</label>
                                                <input id="altemail" type="text" class="form-control altemail" name="emailalt" value="{{isset($client->emailalt) ? $client->emailalt:''}}" placeholder="Enter Email">
                                                <span class="altemailerror" style="display: none;">Invalid email id</span>
                                                
                                            </div>
                                        </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="mobile">Mobile No.<span class="text-red">*</span></label><br>
                                            
                                                <input type="hidden" name="coun_code" id="count_code" value="91">
                                                 <input type="tel" id="number" class="form-control" name="mobile" value="{{isset($client->mobile) ? $client->mobile:''}}" required=""> 
                                                 <span id="lblError" style="color: red"></span>
                                            
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>

                                     <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="altmobile">Alternate Mobile No.</label><br>
                                                <input type="hidden" name="altcount_code" id="altcount_code" value="91">
                                                 <input type="tel" id="altmobile" class="form-control" name="mobilealt"  value="{{isset($client->mobilealt) ? $client->mobilealt:''}}"> 
                                               
                                                <span id="altmblError" style="color: red"></span>
                                                
                                            </div>
                                        </div>

                                    <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="landline">Landline No.</label>
                                                <div class="row">
                                                <div class="col-sm-6">
                                                    <input type="hidden" name="countl_code" id="countl_code" value="91">
                                                    <input id="city_code" type="text" class="form-control" name="city_code" value="{{isset($client->city_code) ? str_replace("-", " ", $client->city_code):''}}" placeholder="Enter STD Code">
                                                    </div>
                                                    <div class="col-sm-6">
                                                    <input id="landline" type="text" class="form-control" name="landline" value="{{isset($client->landline) ? $client->landline:''}}" placeholder="Enter Landline">
                                                    </div>
                                                    </div>
                                                
                                                <span id="lndlineError" style="color: red"></span>
                                                <div class="help-block with-errors"></div>
                                            </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="company_name">Company Name<span class="text-red">*</span></label>
                                            <input id="company_name" type="text" class="form-control" name="company_name" value="{{isset($client->company_name) ? $client->company_name :''}}" placeholder="Enter Company Name" required="">
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="email">Client Type<span class="text-red">*</span></label>
                                               <select  class="form-control" name="clientType" id="clientType" >
                                            <option value="">Select Client Type</option> 
                                                @if(isset($client->clientType) && $client->clientType=='Consumer' || $client->clientType=='Unregistered' || $client->clientType=='Registered-Composite' || $client->clientType== 'Registered' )
                               
                                                <option value="Consumer"  {{ ($client->clientType) == 'Consumer' ? 'selected' : '' }}>Consumer</option>

                                                <option value="Unregistered"  {{ ($client->clientType) == 'Unregistered' ? 'selected' : '' }}>Unregistered</option>

                                        
                                                <option value="Registered"  {{ ($client->clientType) == 'Registered' ? 'selected' : '' }}>Registered</option>

                                                <option value="Registered-Composite"  {{ ($client->clientType) == 'Registered-Composite' ? 'selected' : '' }}>Registered-Composite</option>
                                                        
                                            @else
                                                    <option value="Consumer">Consumer</option> 
                                                    <option value="Unregistered">Unregistered</option> 
                                                    <option value="Registered">Registered</option> 
                                                    <option value="Registered-Composite">Registered-Composite</option> 
                                                @endif    
                                               
                                            
                                            </select>
                                                <span class="" style="display: none;">Invalid email id</span>
                                                <div class="help-block with-errors"></div>
                                            </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="gst">GST Number<span class="text-red">*</span></label>
                                            <input id="gst" type="text" class="form-control gst" name="gst_number" value="{{isset($client->gst_number) ? $client->gst_number:''}}" placeholder="Enter GST Number" style="text-transform:uppercase;">

                                            <span class="gstverify"></span>
                                            <span class="gstmsg"></span>
                                                <span class="gsterror"></span>
                                           
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
                        <div class="card-header">
                            <strong><h3>{{ __('Billing Address')}}</h3></strong>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Address Line 1<span class="text-red">*</span></label>
                                            <textarea class="form-control" name="address" rows="2" required="">{{isset($client->address) ? $client->address:''}}</textarea>

                                        </div>
                                        </div>
                                        <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Address Line 2</label>
                                            <textarea class="form-control" name="address_1" rows="2">{{isset($client->address_1) ? $client->address_1:''}}</textarea>
                                        </div>
                                        </div>
                                        <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="country">Country<span class="text-red">*</span></label>
                                            <select  class="form-control" name="country_id" id="country" required="">
                                            <option value="">Select Country</option> 
                                                @foreach($countries as $country)
                                                @if($country->exists && $country->id == $client->country_id)
                                                        <option value="{{ $country->id }}" selected="selected">{{ $country->name }}</option>

                                                @else
                                                    <option value="{{$country->id}}">{{$country->name}}</option>
                                                @endif 
                                                 @endforeach
                                            
                                            </select>
                                        
                                        </div>
                                        </div>
                                        <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="state">State<span class="text-red">*</span></label>
                                            <select  class="form-control" name="state_id" id="tradestate" data-url="{{route('getCity')}}" required="">

                                                <option value="">Select State</option> 
                                                @foreach($states as $state)
                                                    @if($state->exists && $state->id == $client->state_id)
                                                        <option value="{{ $state->id }}" selected="selected">{{ $state->name }}</option>

                                                    @else
                                                        <option value="{{$state->id}}">{{$state->name}}</option> 
                                                    @endif
                                                @endforeach
                                                
                                                </select>
                                            <div class="help-block with-errors"></div>
                                        </div>
                                        </div>
                                        <div class="col-sm-6">

                                        <div class="form-group">
                                            <label for="city">City<span class="text-red">*</span></label>
                                            <select  class="form-control" name="city_id" id="tradecity" required="">
                                                <option value="">Select City</option> 
                                                    @foreach($cities as $city)
                                                        @if($city->exists && $city->id == $client->city_id)
                                                            <option value="{{ $city->id }}" selected="selected">{{ $city->name }}</option>

                                                        @else
                                                            <option value="{{$city->id}}">{{$city->name}}</option> 
                                                        @endif
                                                     @endforeach
                                            </select>
                                            <div class="help-block with-errors"></div>
                                        </div>

                                        </div>
                                        
                                        <div class="col-sm-6">

                                        <div class="form-group">
                                            <label for="pincode">Pincode<span class="text-red">*</span></label>
                                            <input id="pincode" type="text" class="form-control" name="pincode" placeholder="Enter Pincode" value="{{isset($client->pincode) ? $client->pincode :''}}" >
                                            <div class="help-block with-errors"></div>
                                        </div>
                                        </div>
                                        <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="latitude">Latitude</label>
                                            <input id="latitude" type="text" class="form-control" name="latitude" placeholder="Enter Latitude" value="{{isset($client->latitude) ? $client->latitude :''}}">
                                            <div class="help-block with-errors"></div>
                                        </div>
                                        </div>
                                        <div class="col-sm-6">
                                  
                                        <div class="form-group">
                                            <label for="longitude">Longitude</label>
                                            <input id="longitude" type="text" class="form-control" name="longitude"  placeholder="Enter Longitude" value="{{isset($client->longitude) ? $client->longitude :''}}">
                                            <div class="help-block with-errors"></div>
                                        </div>
                                        </div>
                                        </div>
                                    
                                            
                        </div>
                    </div>
            </div>

            {{--<div class="col-md-6">
                <div class="card ">
                    <div class="card-header">
                        <strong><h3>{{ __('Shipping Address')}}</h3></strong>
                        <div><button type="button" class="class=" name="billingtoo" onclick="FillBilling(this.form)" btn=""style="margin-left: 174px;background-color: #19B5FE !important;color:#fff;border: #19B5FE;">
                        Copy Billing Address
                    </button></div>
                    </div>
                    <div class="card-body">
                        
                                    <div class="form-group">
                                        <label>Shipping Address Line 1</label>
                                        <textarea class="form-control" name="address_2" rows="2">{{isset($client->address_2) ? $client->address_2:''}}</textarea>

                                    </div>

                                    <div class="form-group">
                                            <label>Shipping Address Line 2</label>
                                            <textarea class="form-control" name="altaddress" rows="2">{{isset($client->altaddress) ? $client->altaddress:''}}</textarea>

                                    </div>

                                    <div class="form-group">
                                            <label for="country">Country</label>
                                            <select  class="form-control" name="secondary_country_id" id="country" >
                                            <option value="">Select Country</option> 
                                                @foreach($countries as $country)
                                                @if($country->exists && $country->id == $client->secondary_country_id)
                                                        <option value="{{ $country->id }}" selected="selected">{{ $country->name }}</option>

                                                @else
                                                    <option value="{{$country->id}}">{{$country->name}}</option>
                                                @endif 
                                                 @endforeach
                                            
                                            </select>
                                        
                                        </div>
                            
                                    <div class="form-group">
                                        <label for="state">State</label>
                                        <select  class="form-control" name="secondary_state_id" id="secondarystate" data-url="{{route('getCity')}}">

                                            <option value="">Select State</option> 
                                                @foreach($states as $state)
                                                @if($state->id == $client->secondary_state_id)
                                                        <option value="{{ $state->id }}" selected="selected">{{ $state->name }}</option>

                                                    @else
                                                    <option value="{{$state->id}}">{{$state->name}}</option> 
                                                    @endif
                                                 @endforeach
                                            
                                            </select>
                                        <div class="help-block with-errors"></div>
                                    </div>

                                    <div class="form-group">
                                        <label for="city">City</label>
                                        <select  class="form-control" name="secondary_city_id" id="secondarycity">
                                            <option value="">Select City</option> 
                                                @foreach($cities as $city)
                                                    @if($city->exists && $city->id == $client->secondary_city_id)
                                                        <option value="{{ $city->id }}" selected="selected">{{ $city->name }}</option>

                                                    @else
                                                        <option value="{{$city->id}}">{{$city->name}}</option> 
                                                    @endif
                                                 @endforeach
                                        </select>
                                        <div class="help-block with-errors"></div>
                                    </div>

                                    <div class="form-group">
                                        <label for="secondpincode">Pincode</label>
                                        <input id="secondpincode" type="text" class="form-control" name="secondary_pincode"  placeholder="Enter Pincode"  value="{{isset($client->secondary_pincode) ? $client->secondary_pincode :''}}">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                
                        
                                    <div class="form-group">
                                        <label for="secondlatitude">Latitude</label>
                                        <input id="secondlatitude" type="text" class="form-control" name="secondary_latitude" value="{{isset($client->secondary_latitude) ? $client->secondary_latitude :''}}" placeholder="Enter Latitude">
                                        <div class="help-block with-errors"></div>
                                    </div>
                    
                    
                                    <div class="form-group">
                                        <label for="secondlongitude">Longitude</label>
                                        <input id="secondlongitude" type="text" class="form-control" name="secondary_longitude" value="{{isset($client->secondary_longitude) ? $client->secondary_longitude :''}}" placeholder="Enter Longitude">
                                        <div class="help-block with-errors"></div>
                                    </div>
                    </div>
                </div>
            </div>--}}
        </div>
        <div class="row">
                <!-- start message area-->
                
                <!-- end message area-->
                <div class="col-md-12">
                    <div class="card ">
                        <div class="card-header">
                            <strong><h3>{{ __('Personal Information')}}</h3></strong>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="anniversary">Anniversary</label>
                                        
                                        <input id="anniversary" type="date" class="form-control" name="anniversary" value="{{isset($client->birthday) ? $client->birthday :''}}">
                                        

                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="birthday">Birthday</label>
                                        
                                        <input id="birthday" type="date" class="form-control" name="birthday" value="{{isset($client->birthday) ? $client->birthday :''}}">

                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label >Website</label>
                                        <input id="website" type="text" class="form-control" name="website" value="{{isset($client->website) ? $client->website :''}}" placeholder="Enter Website">

                                    </div>
                                </div>

                                

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Facebook Personal Id</label>
                                        <input id="facebook" type="text" class="form-control" name="facebook_id" value="{{isset($client->facebook_id) ? $client->facebook_id :''}}" placeholder="Enter Facebook Personal Id">

                                    </div>
                                </div>

                                <div class="col-sm-6">

                                    <div class="form-group">
                                        <label>Facebook Business Page</label>
                                        <input id="facebook_page" type="text" class="form-control" name="facebook_bussiness_page" value="{{isset($client->facebook_bussiness_page) ? $client->facebook_bussiness_page :''}}" placeholder="Enter Facebook Business Page">

                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Linkedin Personal Id</label>
                                        <input id="facebook" type="text" class="form-control" name="linkedin_id" value="{{isset($client->linkedin_id) ? $client->linkedin_id :''}}" placeholder="Enter Facebook Personal Id">

                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Linkedin Business Page</label>
                                        <input id="facebook_page" type="text" class="form-control" name="linkedin_bussiness_page" value="{{isset($client->linkedin_bussiness_page) ? $client->linkedin_bussiness_page :''}}" placeholder="Enter Linkedin Business Page">

                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Youtube</label>
                                        <input id="youtube" type="text" class="form-control" name="youtube" value="{{isset($client->youtube) ? $client->youtube :''}}" placeholder="Enter Youtube">

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
        </form>
    </div>
    <!-- push external js -->
    @push('script') 
    
    
    <script type="text/javascript">
        $(function () {
        $('#dropify').dropify();
        });

         $('#tradestate').on('change', function() {
            alert('xdvgdfgdf');
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
    </script>
    <!-- image -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>

<link href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/11.0.9/css/intlTelInput.css" rel="stylesheet" media="screen">
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/11.0.9/js/intlTelInput.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/11.0.9/js/intlTelInput.min.js"></script>
   <!--  <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/11.0.9/js/utils.js"></script> -->

    <script type="text/javascript"> 
    $('#editform').submit(function () {        
  //alert('fbcbcvbc');
  var clienttype =   $('#clientType').val();
            console.log(clienttype); 
            if(clienttype == 'Registered' || clienttype =='Registered-Composite'){
                //alert('gst');

                var inputvalues = $(".gst").val(); 
                //alert(inputvalues); 
                if(inputvalues==''){
                    
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
    /*$(document).ready(function () {      
        $(".gst").change(function () {    
            //alert('fcbghdf');
            var inputvalues = $(this).val(); 
            var clienttype =   $('#clientType').val();
            console.log(clienttype);
            var gstinformat = new RegExp('^[0-9]{2}[A-Z]{5}[0-9]{4}[A-Z]1}[1-9A-Z]{1}Z[0-9A-Z]{1}$');    
            if (gstinformat.test(inputvalues)) {    
                return true;    
            } else {    
                $(".gsterror").html('Please Enter Valid GSTIN Number');    
                //$(".gst").val('');    
                $(".gst").focus();    
            }    
        });          
     });  */    
</script>   

<script type="text/javascript">        
/*$(document).ready(function () { 
    alert('bvbvcb');
});*/
$("#last_name").change(function () {  
//alert('bcbcvb');        
 var lastname=$("#last_name").val();
 //console.log(lastname);

 if(lastname==''){
    $(".lasterror").show();   
    return false; 
 }
 else if(lastname=='NA'){
    return true;
 }
});

$(".email").change(function () { 
//alert('xvxvxc');   
var inputvalues = $(".email").val();    
var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;    
if(!regex.test(inputvalues)){    
$(".emailerror").html("invalid email id");    
return regex.test(inputvalues);    
}    

}); 


$('#altemail').change(function (e) { 

var inputvalues = $(this).val();    
var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;    
if(!regex.test(inputvalues)){    
$(".altemailerror").show();    
//return regex.test(inputvalues); 
return false; 
}   
});   
    
//});  

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
 
            return isValid;
        });
    }); 


    $(function () {
        $("#altmobile").keypress(function (e) {
            var num=$(this).value;
            //alert(num);
            var keyCode = e.keyCode || e.which;
 
            $("#altmblError").html("");
 
            //Regex for Valid Characters i.e. Numbers.
            var regex = /^[0-9]+$/;
            
 
            //Validate TextBox value against the Regex.
            var isValid = regex.test(String.fromCharCode(keyCode));
            if (!isValid) {
                $("#altmblError").html("Only Numbers allowed.");
                return false;  
            }
            else{
                return true;
            }
 
        
        });
    });    
       
    
$("#number").change(function () {   
var getCode = $("#number").intlTelInput('getSelectedCountryData').dialCode;
console.log(getCode);
$('#count_code').val(getCode);
var inputvalues = $("#number").val();    
var regex = /^(\+?\d{1,4}[\s-])?(?!0+\s+,?$)\d{10}\s*,?$/;
              if(!regex.test(inputvalues)){    
                $("#lblError").html("invalid mobile number");    
                return regex.test(inputvalues);  
                return false;  
                }      

});   


$("#altmobile").change(function () {   
    var getCode = $("#altmobile").intlTelInput('getSelectedCountryData').dialCode;
    console.log(getCode);
    $('#altcount_code').val(getCode);
    var inputvalues = $("#altmobile").val();    
    var regex = /^(\+?\d{1,4}[\s-])?(?!0+\s+,?$)\d{10}\s*,?$/;
                  if(!regex.test(inputvalues)){    
                    $("#altmblError").html("invalid mobile number");    
                    return regex.test(inputvalues);  
                    return false;  
                    }      

});

$("#city_code").change(function () {  
//alert('fbghfghf');
    var getCode = $("#city_code").intlTelInput('getSelectedCountryData').dialCode;
    console.log(getCode);
    $('#countl_code').val(getCode);
    var inputvalues = $("#city_code").val();    
       

});

</script> 



     
     <script type="text/javascript">
// address  secondary address  copy js start
    function FillBilling(f) {
  if(f.billingtoo.onclick) {
    f.address_2.value = f.address.value;
    f.altaddress.value = f.address_1.value;
    f.secondary_country_id.value = f.country_id.value;
    f.secondary_state_id.value = f.state_id.value;
    f.secondary_city_id.value = f.city_id.value;
    f.secondary_pincode.value = f.pincode.value;
    f.secondary_latitude.value = f.latitude.value;
    f.secondary_longitude.value = f.longitude.value;

  }
}
</script>
     
    @endpush
@endsection
