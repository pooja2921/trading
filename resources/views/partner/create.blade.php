@extends('inventory.layout') 
@section('title', 'Add Supply Partner')
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
            .secondemail{
                color: red;
            }
            .secondmblerror{
                color: red;
            }
            #firstname{
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
                            <h5>{{ __('Add Supply Partner')}}</h5>
                            <span>{{ __('Create new Supply Partner')}}</span>
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
                                <a href="#">{{ __('Add Supply Partner')}}</a>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <form class="forms-sample" method="POST" action="{{ route('vendor.store') }}" enctype= multipart/form-data id="vendorform">
            @csrf
            <!-- start message area-->
            @include('include.message')
            <!-- end message area-->
        <div class="row">
            
                <div class="col-md-12">
                    <div class="card ">
                        <div class="card-header">
                            <strong><h3>{{ __('Product Category')}}</h3></strong>
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
                                            <select class="form-control select2 productgroup" id="progroup" name="product_group_id[]" multiple="multiple" data-url="{{url('/')}}" required="">
                                                @foreach($categories as $category)
                                                <option value="{{$category->id}}">{{ $category->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 procategory" style="display: none;" >
                                    <div class="form-group">
                                            
                                                <label class="d-block">Product Category<span class="text-red">*</span></label>
                                                <select class="form-control select2 subcat" id="procat" name="product_category_id[]" multiple="multiple" data-url="{{url('/')}}" required="">
                                                </select>
                                        </div>
                                    </div>
                                    

                                    <div class="col-sm-6 subcategory" style="display:none;">

                                        <div class="form-group">
                                        <label class="d-block">Sub Category<span class="text-red">*</span></label>
                                          
                                        <select  class="form-control select2" id="subcat" name="sub_category_id[]"  multiple="multiple" required="">
                                        </select>
                                        </div>
                                        
                                    </div>
                                              
                                            <div class="col-sm-6">    
                                            <div class="form-group">
                                                <label for="bussiness_nature">Nature Of Business <span class="text-red">*</span></label>
                                                <select  class="form-control" id="bussiness_nature" name="bussiness_nature" required="">

                                            <option value="">Select Nature Of Business </option> 
                                              
                                                <option value="Manufacturer">Manufacturer</option> 
                                                <option value="Distributor">Distributor</option>
                                                 <option value="Wholesaler">Wholesaler</option>
                                                <option value="Dealer">Dealer</option> 
                                                <option value="Trader">Trader</option>
                                                <option value="Retailer">Retailer</option>
                                            
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
                                          
                                            <option value="Mr">Mr</option> 
                                            <option value="Mrs">Mrs</option> 
                                            <option value="Miss">Miss</option> 
                                        
                                        </select>
                                    </div>
                        
                                    
                
                                        <div class="form-group">
                                            <label for="first_name">First Name<span class="text-red">*</span></label>
                                            <input id="first_name" type="text" class="form-control" name="first_name" value="{{old('first_name')}}" placeholder="Enter First Name" required="">
                                            <div class="help-block with-errors"></div>


                                        </div>
                
                                    <div class="form-group">
                                        <label for="middle_name">Middle  Name</label>
                                        <input id="middle_name" type="text" class="form-control" name="middle_name" value="{{old('middle_name')}}" placeholder="Enter Middle Name">
                                        


                                    </div>
                
        
                                    <div class="form-group">
                                        <label for="last_name">Last Name<span class="text-red">*</span></label>
                                        <input id="last_name" type="text" class="form-control" name="last_name" value="{{old('last_name')}}" placeholder="Enter Last Name">
                                        <div class="lasterror" style="display:none;">If last name is not available please insert NA</div>


                                    </div>
                            
                            
                                <div class="form-group">
                                    <label for="designation">Designation</label>
                                    <input id="designation" type="text" class="form-control" name="designation" value="" placeholder="Enter designation">
                                    <div class="help-block with-errors"></div>
                                </div>

                                
                                <div class="form-group">
                                    <label for="department">Department</label>
                                    <input id="department" type="text" class="form-control" name="department" value="{{old('department')}}" placeholder="Enter Department">
                                
                                </div>
                            
                            
                                <div class="form-group">
                                    <label for="email">Email<span class="text-red">*</span></label>
                                    <input id="email" type="text" class="form-control email" name="email"  id="emailval" value="" placeholder="Enter Email" required="">
                                    <span class="emailerror"></span>
                                    
                                </div>

                
                                        <div class="form-group">
                                            <label for="altemail">Alternate Email</label>
                                            <input id="altemail" type="text" class="form-control altemail" name="emailalt" value="{{old('emailalt')}}" placeholder="Enter Email">
                                            <span class="altemailerror" style="display: none;">Invalid email id</span>
                                            
                                        </div>
                    
                           
                                <div class="form-group">
                                    <label for="mobile">Mobile No.<span class="text-red">*</span></label><br>
                                    <input type="hidden" name="coun_code" id="count_code">
                                     <input type="tel" id="number" class="form-control" name="mobile" required> 
                                    
                                    <span id="lblError" style="color: red"></span>
                                    
                                </div>

                            
                                    <div class="form-group">
                                            <label for="altmobile">Alternate Mobile No.</label><br>
                                            <input type="hidden" name="altcount_code" id="altcount_code" value="91">
                                             <input type="tel" id="altmobile" class="form-control" name="mobilealt" value="{{old('mobilealt')}}"> 
                                           
                                            <span id="altmblError" style="color: red"></span>
                                            
                                    </div>
                    

                                
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
                                        
                                    </div>

                                
                                    <div class="form-group">
                                        <label for="anniversary">Anniversary</label>
                                        
                                        <input id="anniversary" type="date" class="form-control" name="anniversary" value="{{old('anniversary')}}">
                                        

                                    </div>
                                
                                    <div class="form-group">
                                        <label for="birthday">Birthday</label>
                                        
                                        <input id="birthday" type="date" class="form-control" name="birthday" value="{{old('birthday')}}">

                                    </div>
                            

                            
                                {{-- <div class="form-group">
                                    <label for="landline">Landline  No.</label>
                                    <div class="row">
                                    <div class="col-sm-6">
                                    <input id="city_code" type="text" class="form-control" name="city_code" value="" placeholder="Enter Code">
                                    </div>
                                    <div class="col-sm-6">
                                    <input id="landline" type="text" class="form-control" name="landline" value="" placeholder="Enter Landline">
                                    </div>
                                    </div>
                                    <span id="lndlineError" style="color: red"></span>
                                    <div class="help-block with-errors"></div>
                                </div> --}}
                                
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
                                        <select  class="form-control" name="secondary_salutation" id="second_sal">

                                        <option value="">Select Salutation</option> 
                                          
                                            <option value="Mr">Mr</option> 
                                            <option value="Mrs">Mrs</option> 
                                            <option value="Miss">Miss</option> 
                                        
                                        </select>
                                    </div>
                                
                                    
                           
                                        <div class="form-group">
                                            <label for="secondary_first_name">First Name</label>
                                            <input id="secondary_first_name" type="text" class="form-control" name="secondary_first_name" value="{{old('secondary_first_name')}}" placeholder="Enter First Name">
                                            <div id="firstname"></div>

                                        </div>
                                
                            
                                    <div class="form-group">
                                        <label for="secondary_middlename">Middle  Name</label>
                                        <input id="secondary_middlename" type="text" class="form-control" name="secondary_middlename" value="{{old('secondary_middlename')}}" placeholder="Enter Middle Name">
                                        


                                    </div>
                                
                                
                                    <div class="form-group">
                                        <label for="secondary_lastname">Last Name</label>
                                        <input id="secondary_lastname" type="text" class="form-control" name="secondary_lastname" value="{{old('secondary_lastname')}}" placeholder="Enter Last Name">

                                    </div>
                        
                            
                                <div class="form-group">
                                    <label for="secondary_designation">Designation</label>
                                    <input id="secondary_designation" type="text" class="form-control" name="secondary_designation" value="" placeholder="Enter designation">
                                    
                                </div>

                                
                                        <div class="form-group">
                                            <label for="department">Department</label>
                                            <input id="secondary_department" type="text" class="form-control" name="secondary_department" value="{{old('secondary_department')}}" placeholder="Enter Department">
                                        
                                        </div>
                        
                            
                                <div class="form-group">
                                    <label for="secondary_email">Email</label>
                                    <input id="secondary_email" type="text" class="form-control secondary_email" name="secondary_email" value="" placeholder="Enter Email" >
                                   
                                    
                                </div>

                            
                                        <div class="form-group">
                                            <label for="secondary_emailalt">Alternate Email</label>
                                            <input id="secondary_emailalt" type="text" class="form-control secondary_emailalt" name="secondary_emailalt" value="{{old('secondary_emailalt')}}" placeholder="Enter Email">
                                            
                                            
                                        </div>
                
                           
                                <div class="form-group">
                                    <label for="mobile">Mobile No.</label><br>
                                    <input type="hidden" name="second_coun_code" id="second_count_code"  value="91">
                                     <input type="tel" id="second_mobile" class="form-control" name="secondary_mobile"> 
                                    <div id="secondmblerror"></div>
                                    
                                </div>

                              
                                    <div class="form-group">
                                            <label for="altmobile">Alternate Mobile No.</label><br>
                                            <input type="hidden" name="second_altcount_code" id="second_altcount_code" value="91">
                                             <input type="tel" id="second_altmobile" class="form-control" name="second_mobilealt" value="{{old('second_mobilealt')}}">     
                                    </div>
                    
                                
                                    <div class="form-group">
                                        <label for="landline">Landline No.</label>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <input type="hidden" name="second_countl_code" id="second_countl_code" value="91">
                                            <input id="second_city_code" type="text" class="form-control" name="second_city_code" style="width:200px;" value="" placeholder="Enter STD Code" maxlength="5">
                                            </div>
                                            <div class="col-sm-6">
                                            <input id="second_landline" type="text" class="form-control" maxlength="8" name="second_landline" value="{{old('second_landline')}}" placeholder="Enter Landline">
                                            </div>
                                        </div>
                                        
                                    </div> 
                                    <div class="form-group">
                                        <label for="secondary_anniversary">Anniversary</label>
                                        
                                        <input id="secondary_anniversary" type="date" class="form-control" name="secondary_anniversary" value="{{old('secondary_anniversary')}}">
                                        

                                    </div>
                        

                                
                                    <div class="form-group">
                                        <label for="secondary_birthday">Birthday</label>
                                        
                                        <input id="secondary_birthday" type="date" class="form-control" name="secondary_birthday" value="{{old('secondary_birthday')}}">

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
                                        <input id="company_name" type="text" class="form-control" name="company_name" value="{{old('company_name')}}" placeholder="Enter Company Name" required="">
                                        
                                    </div>
                                </div>
                                   
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="email">GST Type<span class="text-red">*</span></label>
                                       <select  class="form-control clientType" name="clientType" id="clientType" required="">
                                        <option value="">Select GST Type</option> 
                                        
                                            <option value="Consumer">Consumer</option> 
                                            <option value="Unregistered">Unregistered</option> 
                                            <option value="Registered">Registered</option> 
                                            <option value="Registered-Composite">Registered-Composite</option> 
                                    
                                        </select>
                                        
                                    </div>
                                </div>
                                    
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="gst">GST Number<span class="text-red">*</span></label>
                                        <input id="gst" type="text" class="form-control gst" name="gst_number" value="{{old('gst_number')}}" placeholder="Enter GST Number"  maxlength="15" style="text-transform:uppercase;" >
                                        <span class="gstverify"></span>
                                        <span class="gsterror"></span>
                                        
                                    </div>  
                                </div>

                                <div class="col-sm-6"></div>
                                
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Address Line 1</label>
                                        <textarea class="form-control" name="address_1" rows="2"></textarea>

                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Address Line 2</label>
                                        <textarea class="form-control" name="address_2" rows="2"></textarea>

                                    </div>
                                </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                        <label for="country">Country</label>
                                        <select  class="form-control" name="country_id" id="country" >
                                        <option value="">Select Country</option> 
                                            @foreach($countries as $country)
                                                <option value="{{$country->id}}">{{$country->name}}</option> 
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
                                                <option value="{{$state->id}}">{{$state->name}}</option> 
                                             @endforeach
                                        
                                        </select>
                                    
                                </div>
                            </div>
                       
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="city">City</label>
                                    <select  class="form-control" name="city_id" id="tradecity">
                                        
                                    </select>
                                    
                                </div>
                            </div>

                            
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="pincode">Pincode</label>
                                    <input id="pincode" type="text" class="form-control" name="pincode" placeholder="Enter Pincode">
                                    
                                </div> 
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="secondlatitude">Latitude</label>
                                    <input id="secondlatitude" type="text" class="form-control" name="latitude" value="{{old('latitude')}}" placeholder="Enter Latitude" >
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="secondlongitude">Longitude</label>
                                    <input id="secondlongitude" type="text" class="form-control" name="longitude" value="{{old('longitude')}}" placeholder="Enter Longitude" >
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
                        <div class="card-body">
                            <div class="col-md-12" style="text-align: center;">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary" id="submit" value="submit">{{ __('Submit')}}</button>
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

    var route = "{{ url('categorysearch') }}";
 $('#search').typeahead({
            source: function (query, process) {
                return $.get(route, {
                    query: query
                }, function (data) {
                    return process(data);
                });
            }
        });

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

        $('.productgroup').change(function() {
        
            
            var product=$(".productgroup :selected").map((_, e) => e.value).get();
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
        });

        $('.procategory').change(function() { 
            //console.log('gfbhngfgfh');
            var sub=$(".procategory :selected").map((_, e) => e.value).get();
            //console.log(parent);
            var publicurl= $('.subcat').data('url');
            console.log(publicurl);
            if(sub!=''){

                $.ajax({
                    url:publicurl+'/subcat/',
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




 
//$("#mobile").intlTelInput(); 



$('#vendorform').submit(function (e) {         
  // alert('ghnghjgfjf');
 



 var lastname=$("#last_name").val();
 //console.log(lastname);

 if(lastname==''){
    $(".lasterror").show();   
    return false; 
 }
 else if(lastname=='NA'){
    return true;
 }
 /*else{
    return true;
 }*/

 


var email = $("#email").val();    
//alert(email);
var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;    
if(!regex.test(email)){    
$(".emailerror").html("invalid email id");    
return regex.test(email); 
return false;   
} 

var getCode = $("#number").intlTelInput('getSelectedCountryData').dialCode;
//alert(getCode);
$('#count_code').val(getCode);
var inputvalues = $("#number").val();    
var regex = /^(\+?\d{1,4}[\s-])?(?!0+\s+,?$)\d{10}\s*,?$/;
              if(!regex.test(inputvalues)){    
                $("#lblError").html("invalid mobile number");    
                return regex.test(inputvalues);  
                
                return false;  
                } 
                
                
var clienttype =   $('#clientType').val();
    console.log(clienttype); 
    if(clienttype =='Registered' || clienttype =='Registered-Composite'){
        //alert('xdgdfxgdfg');

        var inputvalues = $(".gst").val();  
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

if($('#second_sal').val()!=''){
    var first=$('#secondary_first_name').val();
    if(first ==''){
        $('#firstname').html('please Enter First Name');
        return false;
    }
    else{
        return true;
    }

    var secondmobile=$('#second_mobile').val();
    console.log(secondmobile);
    if (secondmobile.length < 1) {
        alert('vxcvxcvx');
    }
    if(secondmobile ==''){
        $('#secondmblerror').html('please Enter Mobile No.');
        return false;
    }
    else{
        return true;
    }
}

/*var inputvalues = $("#secondary_email").val();    
var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;    
if(!regex.test(inputvalues)){    
$(".secondemail").html("invalid email id");    
//return regex.test(inputvalues);
event.preventDefault();
return false;    
}*/

     
  
/*var getCodes = $("#altmobile").intlTelInput('getSelectedCountryData').dialCode;
//console.log(getCode);
$('#altcount_code').val(getCodes);
var alt = $("#altmobile").val();    
var regex = /^(\+?\d{1,4}[\s-])?(?!0+\s+,?$)\d{10}\s*,?$/;
              if(!regex.test(alt)){    
                $("#mblError").html("invalid mobile number");    
                //return regex.test(inputvalues); 
                event.preventDefault(); 
                return false;  
                }*/       


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
 
            //return isValid;
        });
    });  
    $(function () {
        $("#mobile").keypress(function (e) {
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
               
                return false;  
            }
            else{
                return true;
            }
 
            //return isValid;
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

});    */





</script>  
   
@endpush
@endsection
