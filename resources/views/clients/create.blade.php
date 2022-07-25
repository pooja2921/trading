@extends('inventory.layout') 
@section('title', 'Add Cliets')
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
                            <h5>{{ __('Add Clients')}}</h5>
                            <span>{{ __('Create new Clients')}}</span>
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
                                <a href="#">{{ __('Add Clients')}}</a>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <form class="forms-sample" method="POST" action="{{ route('client.store') }}" enctype= multipart/form-data id="clientform">
        @csrf
        @include('include.message')

            <div class="row">
                <!-- start message area-->
                
                <!-- end message area-->
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
                                              
                                                <option value="Mr">Mr</option> 
                                                <option value="Mrs">Mrs</option> 
                                                <option value="Miss">Miss</option> 
                                            
                                            </select>
                                        </div>
                                    </div>
                                        
                                    <div class="col-sm-6">    
                                            <div class="form-group">
                                                <label for="first_name">First Name<span class="text-red">*</span></label>
                                                <input id="first_name" type="text" class="form-control" name="first_name" value="{{old('first_name')}}" placeholder="Enter First Name" required="">
                                                <div class="help-block with-errors"></div>


                                            </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="middle_name">Middle  Name</label>
                                            <input id="middle_name" type="text" class="form-control" name="middle_name" value="{{old('middle_name')}}" placeholder="Enter Middle Name">
                                            <div class="help-block with-errors"></div>


                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="last_name">Last Name<span class="text-red">*</span></label>
                                            <input id="last_name" type="text" class="form-control" name="last_name" value="{{old('last_name')}}" placeholder="Enter Last Name">
                                            <div class="lasterror" style="display:none;">If last name is not available please insert NA</div>


                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="designation">Designation<span class="text-red">*</span></label>
                                            <input id="designation" type="text" class="form-control" name="designation" value="{{old('designation')}}" placeholder="Enter Designation">

                                        </div>
                                    </div>

                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="department">Department<span class="text-red">*</span></label>
                                                <input id="department" type="text" class="form-control" name="department" value="{{old('department')}}" placeholder="Enter Department">
                                            
                                            </div>
                                        </div>

                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="email">Official Email<span class="text-red">*</span></label>
                                                <input id="email" type="text" class="form-control email" name="email" value="{{old('email')}}" placeholder="Enter Email" required="">
                                                <span class="emailerror" style="display: none;">Invalid email id</span>
                                                <div class="help-block with-errors"></div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="altemail">Alternate Email</label>
                                                <input id="altemail" type="text" class="form-control altemail" name="emailalt" value="{{old('emailalt')}}" placeholder="Enter Email">
                                                <span class="altemailerror" style="display: none;">Invalid email id</span>
                                                
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="mobile">Mobile No.<span class="text-red">*</span></label><br>
                                                <input type="hidden" name="coun_code" id="count_code" value="91">
                                                 <input type="tel" id="number" class="form-control" name="mobile" value="{{old('mobile')}}" required=""> 
                                                
                                                <span id="lblError" style="color: red"></span>
                                               
                                            </div>
                                        </div>
                                         <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="altmobile">Alternate Mobile No.</label><br>
                                                <input type="hidden" name="altcount_code" id="altcount_code">
                                                 <input type="tel" id="altmobile" class="form-control" name="mobilealt" value="{{old('mobilealt')}}"> 
                                               
                                                <span id="altmblError" style="color: red"></span>
                                                
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="landline">Landline No.</label>
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <input type="hidden" name="countl_code" id="countl_code" value="91">
                                                    <input id="city_code" type="text" class="form-control" name="city_code" style="width:200px;" value="" placeholder="Enter STD Code" maxlength="5">
                                                    </div>
                                                    <div class="col-sm-6">
                                                    <input id="landline" type="text" class="form-control" maxlength="8" name="landline" value="{{old('landline')}}" placeholder="Enter Landline">
                                                    </div>
                                                </div>
                                                <span id="city_codeError" style="color: red"></span>
                                                <div class="help-block with-errors"></div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="company_name">Company Name<span class="text-red">*</span></label>
                                                <input id="company_name" type="text" class="form-control" name="company_name" value="{{old('company_name')}}" placeholder="Enter Company Name">
                                                <div class="help-block with-errors"></div>
                                            </div>
                                        </div>
                      
                                         
                                       
                                    <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="email">GST Type<span class="text-red">*</span></label>
                                               <select  class="form-control clientType" name="clientType" id="clientType" >
                                            <option value="">Select GST Type</option> 
                                                
                                                    <option value="Consumer">Consumer</option> 
                                                    <option value="Unregistered">Unregistered</option> 
                                                    <option value="Registered">Registered</option> 
                                                    <option value="Registered-Composite">Registered-Composite</option> 
                                                    
                                               
                                            
                                            </select>
                                                <span class="" style="display: none;">Invalid email id</span>
                                                <div class="help-block with-errors"></div>
                                            </div>
                                    </div>
                                        
                                         <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="gst">GST Number<span class="text-red">*</span></label>
                                                <input id="gst" type="text" class="form-control gst" name="gst_number" value="{{old('gst_number')}}" placeholder="Enter GST Number"  maxlength="15" style="text-transform:uppercase;" >
                                                <span class="gstverify"></span>
                                                 <span class="gstmsg"></span>
                                                <span class="gsterror"></span>
                                                <div class="help-block with-errors"></div>
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
                                            <textarea class="form-control" name="address" rows="2" required="">{{old('address')}}</textarea>

                                        </div>
                                        </div>
                                        
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Address Line 2</label>
                                            <textarea class="form-control" name="address_1" rows="2">{{old('address_1')}}</textarea>

                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="country">Country<span class="text-red">*</span></label>
                                            <select  class="form-control" name="country_id" id="country" required="">
                                            <option value="">Select Country</option> 
                                                @foreach($countries as $country)
                                                    <option value="{{$country->id}}">{{$country->name}}</option> 
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
                                                        <option value="{{$state->id}}">{{$state->name}}</option> 
                                                     @endforeach
                                                
                                                </select>
                                            <div class="help-block with-errors"></div>
                                        </div>
                                        </div>
                                        <div class="col-sm-6">

                                        <div class="form-group">
                                            <label for="city">City<span class="text-red">*</span></label>
                                            <select  class="form-control" name="city_id" id="tradecity" required="">
                                                
                                            </select>
                                            <div class="help-block with-errors"></div>
                                        </div>

                                        </div>
                                        <div class="col-sm-6">

                                        <div class="form-group">
                                            <label for="pincode">Pincode<span class="text-red">*</span></label>
                                            <input id="pincode" type="text" class="form-control" name="pincode" value="{{old('pincode')}}" placeholder="Enter Pincode" required="">
                                            <div class="help-block with-errors"></div>
                                        </div>
                                        
                                        </div>
                                        <div class="col-sm-6">
                                  
                                        <div class="form-group">
                                            <label for="latitude">Latitude</label>
                                            <input id="latitude" type="text" class="form-control" name="latitude" value="{{old('latitude')}}" placeholder="Enter Latitude" >
                                            <div class="help-block with-errors"></div>
                                        </div>
                                        </div>
                                        <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="longitude">Longitude</label>
                                            <input id="longitude" type="text" class="form-control" name="longitude" value="{{old('longitude')}}" placeholder="Enter Longitude">
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
                                            <textarea class="form-control" name="address_2" rows="2">{{old('address_2')}}</textarea>

                                        </div>

                                        <div class="form-group">
                                            <label>Shipping Address Line 2</label>
                                            <textarea class="form-control" name="altaddress" rows="2">{{old('altaddress')}}</textarea>

                                        </div>

                                        <div class="form-group">
                                            <label for="country">Country</label>
                                            <select  class="form-control" name="secondary_country_id" id="secondcountry" >
                                                <option value="">Select Country</option> 
                                                    @foreach($countries as $country)
                                                        <option value="{{$country->id}}">{{$country->name}}</option> 
                                                     @endforeach
                                                
                                            </select>
                                        </div>
                                
                                        <div class="form-group">
                                            <label for="state">State</label>
                                            <select  class="form-control" name="secondary_state_id" id="secondarystate" data-url="{{route('getCity')}}">

                                                <option value="">Select State</option> 
                                                    @foreach($states as $state)
                                                        <option value="{{$state->id}}">{{$state->name}}</option> 
                                                     @endforeach
                                                
                                                </select>
                                            <div class="help-block with-errors"></div>
                                        </div>

                                        <div class="form-group">
                                            <label for="city">City</label>
                                            <select  class="form-control" name="secondary_city_id" id="secondarycity">
                                               <option value="">Select City</option> 
                                                    @foreach($cities as $city)
                                                        <option value="{{$city->id}}">{{$city->name}}</option> 
                                                     @endforeach 
                                            </select>
                                            <div class="help-block with-errors"></div>
                                        </div>

                                        <div class="form-group">
                                            <label for="secondpincode">Pincode</label>
                                            <input id="secondpincode" type="text" class="form-control" name="secondary_pincode" value="{{old('secondary_pincode')}}" placeholder="Enter Pincode">
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    
                            
                                        <div class="form-group">
                                            <label for="secondlatitude">Latitude</label>
                                            <input id="secondlatitude" type="text" class="form-control" name="secondary_latitude" value="{{old('secondary_latitude')}}" placeholder="Enter Latitude" >
                                            <div class="help-block with-errors"></div>
                                        </div>
                        
                        
                                        <div class="form-group">
                                            <label for="secondlongitude">Longitude</label>
                                            <input id="secondlongitude" type="text" class="form-control" name="secondary_longitude" value="{{old('secondary_longitude')}}" placeholder="Enter Longitude" >
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
                                        
                                        <input id="anniversary" type="date" class="form-control" name="anniversary" value="{{old('anniversary')}}">
                                        

                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="birthday">Birthday</label>
                                        
                                        <input id="birthday" type="date" class="form-control" name="birthday" value="{{old('birthday')}}">

                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label >Website</label>
                                        <input id="website" type="text" class="form-control" name="website" value="{{old('website')}}" placeholder="Enter Website">

                                    </div>
                                    
                                    
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Facebook Personal Id</label>
                                        <input id="facebook" type="text" class="form-control" name="facebook_id" value="{{old('facebook_id')}}" placeholder="Enter Facebook Personal Id">

                                    </div>
                                </div>

                                <div class="col-sm-6">

                                    <div class="form-group">
                                        <label>Facebook Business Page</label>
                                        <input id="facebook_page" type="text" class="form-control" name="facebook_bussiness_page" value="{{old('facebook_bussiness_page')}}" placeholder="Enter Facebook Business Page">

                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Linkedin Personal Id</label>
                                        <input id="facebook" type="text" class="form-control" name="linkedin_id" value="{{old('linkedin_id')}}" placeholder="Enter Facebook Personal Id">

                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Linkedin Business Page</label>
                                        <input id="facebook_page" type="text" class="form-control" name="linkedin_bussiness_page" value="{{old('linkedin_bussiness_page')}}" placeholder="Enter Linkedin Business Page">

                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Youtube</label>
                                        <input id="youtube" type="text" class="form-control" name="youtube" value="{{old('youtube')}}" placeholder="Enter Youtube">

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
                                    <button type="submit" id="submit" class="btn btn-primary">{{ __('Submit')}}</button>
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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>

    <script type="text/javascript">

    var route = "{{ url('companysearch') }}";
    $('#company_name').typeahead({
            source: function (query, process) {
                return $.get(route, {
                    query: query
                }, function (data) {
                    return process(data);
                });
            }
        });
    
    </script>
    <script type="text/javascript">
        $(function () {
        $('#dropify').dropify();
        });
/*state and city*/
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
/*state and city js */

/*secondary state and city js */
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
           
        /*$(".gst").change(function () {    
            //alert('fcbghdf');
            var inputvalues = $(this).val();
            var clienttype =   $('#clientType').val();
            console.log(clienttype);    
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
        });      */  
               
</script>   

<script type="text/javascript">
//$("#number").intlTelInput("setCountry", 'In');

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


  /*var input = document.querySelector("#number");
  $("#number").intlTelInput(input, {
    initialCountry: "auto",
    geoIpLookup: function(success) {
      // Get your api-key at https://ipdata.co/
      fetch("https://api.ipdata.co/?api-key=test")
        .then(function(response) {
            console.log(response);
          if (!response.ok) return success("");
          return response.json();
        })
        .then(function(ipdata) {
          success(ipdata.country_code);
        });
    },
    utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.3/js/utils.min.js",
  });*/



/*$("#last_name").change(function () { 
var lastname=$(this).val();
 console.log(lastname);

 if(lastname==''){
    $(".lasterror").show();   
    return false; 
 }
 else if(lastname=='NA'){
    return true;
 }  
});*/



$('#submit').click(function () {        
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
            
//$(".email").change(function (e) {  
 var lastname=$("#last_name").val();
 //console.log(lastname);

 if(lastname==''){
    $(".lasterror").show();   
    return false; 
 }
 /*else if(lastname=='NA'){
    return true;
 }*/

var inputvalues = $(".email").val();    
var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;    
if(!regex.test(inputvalues)){    
$(".emailerror").show();    
//return regex.test(inputvalues); 
return false; 
}    

    
     
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

    //$(".gst").change(function () {    
           
            
            /*var clienttype =   $('.clientType  option:selected').val();
            console.log(clienttype);  */
            /*var inputvalues = $(".gst").val();  
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
            }   */
        //}); 

    });  


$(".email").change(function (e) {  
 

var inputvalues = $(".email").val();    
var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;    
if(!regex.test(inputvalues)){    
$(".emailerror").show();    
//return regex.test(inputvalues); 
return false; 
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
    var getCode = $("#city_code").intlTelInput('getSelectedCountryData').dialCode;
    console.log(getCode);
    $('#countl_code').val(getCode);
    var inputvalues = $("#city_code").val();    
    //var regex = /^(\+?\d{1,4}[\s-])?(?!0+\s+,?$)\d{4}\s*,?$/;
                  //if(!regex.test(inputvalues)){    
                    //$("#city_codeError").html("invalid std code number");    
                    //return regex.test(inputvalues);  
                    //return false;  
                    //}      

});

$(function () {
        $("#number").keypress(function (e) {
            var num=$(this).value;
            //alert(num);
            var keyCode = e.keyCode || e.which;
 
            $("#lblError").html("");
 
            //Regex for Valid Characters i.e. Numbers.
            var regex = /^[0-9]+$/;
            /*if(num.length==10){
                   var validate = true;
              } else {
                  $("#lblError").html('Please put 10  digit mobile number');
                  var validate = false;
              }*/
 
            //Validate TextBox value against the Regex.
            var isValid = regex.test(String.fromCharCode(keyCode));
            if (!isValid) {
                $("#lblError").html("Only Numbers allowed.");
                return false;  
            }
            else{
                return true;
            }
 
        
        });
    });     
      
    
  


/*$("#landline").change(function () {    
var inputvalues = $(this).val();    
var regex = /^[\d]{3,4}[\-\s]*[\d]{6,7}$/;
              if(!regex.test(inputvalues)){    
                $("#lndlineError").html("invalid mobile number");    
                return regex.test(inputvalues);   
                return false;   
                }      

});  */  
    





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
