@extends('inventory.layout') 
@section('title', 'Add Enquiry')
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
        </style>
    @endpush

    
    <div class="container-fluid">
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="ik ik-user-plus bg-blue"></i>
                        <div class="d-inline">
                            <h5>{{ __('Add Enquiry')}}</h5>
                            <span>{{ __('Create new Enquiry')}}</span>
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
                                <a href="#">{{ __('Add Enquiry')}}</a>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <form class="forms-sample" method="POST" action="{{ route('enquiry.store') }}" enctype= multipart/form-data id="clientform">
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
                            
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                       <label class="d-block">Client Name</label>
                                        <select class="form-control select2" name="client_name" id="clientdetail" data-url="{{url('searchclient')}}">
                                            @foreach($clients as $client)

                                            <option value="{{$client->first_name.' '.$client->last_name .'-'.$client->company_name.'-'.$client->citydetail->name}}" data-id="{{$client->id}}">{{$client->first_name.' '.$client->last_name .'-'.$client->company_name.'-'.$client->citydetail->name}}</option>
                                            @endforeach
                                        </select>
                                        {{-- <input id="client_name" type="text" class="form-control" name="client_name" value="{{old('client_name')}}" placeholder="Enter Client Name"> --}}
                                    </div>
                                </div>
                                    
                                <div class="col-sm-6">    
                                        <div class="form-group">
                                            <label for="first_name">Client Quotation Number</label>
                                            <input id="first_name" type="text" class="form-control" name="client_quotation_number" value="" placeholder="Enter Client Quotation Number" >
                                            <div class="help-block with-errors"></div>


                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="middle_name">Email Received from<span class="text-red">*</span></label>
                                            <input id="middle_name" type="text" class="form-control" name="email_received_from" value="" placeholder="Enter Email">
                                            


                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="last_name">Email Received On (Date)</label>
                                            <input id="last_name" type="date" class="form-control" name="email_received_date" value="" placeholder="Enter Email Received On">
                                            <div class="help-block with-errors"></div>


                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="email">Sales and Procurement Specialist</label>
                                            
                                            <select  class="form-control sales" name="sales_procurement_specialist" id="sales" >

                                                <option value="">Select Sales Specialist</option> 
                                                @foreach($users as $user)
                                                    @if($user->id==$user_id)
                                                        <option value="{{$user->id}}" selected>{{$user->name}}</option> 
                                                    @else
                                                        <option value="{{$user->id}}" >{{$user->name}}</option> 
                                                    @endif
                                                @endforeach
                                                
                                                </select>
                                                        
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="user_id">User ID</label>
                                            <input id="user_id" type="text" class="form-control userid" name="user_id" value="{{$user_id}}" placeholder="Enter User ID" readonly>
                                           
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
                <div class="col-md-6">
                    <div class="card ">
                        
                        <div class="card-body">
                               
                                    <div class="form-group">
                                        <label for="Client Name">Client Name</label>
                                       
                                           <input type="hidden" class="clientid" name="client_id" value="">
                                            <input id="Client_Name" type="text" class="form-control client" name="client" value="" placeholder="Enter Client Name" readonly="">
                                    </div>
                                
                                    <div class="form-group">
                                        <label for="client_code">Client Code</label>
                                        <input id="client_code" type="text" class="form-control client_code" name="client_code" value="" placeholder="Enter Client Code" readonly>
                                        
                                    </div>       
                                
                                
                                    <div class="form-group">
                                        <label class="d-block">Contact Person</label>
                                        <input id="contact_person" type="text" class="form-control contact_person" name="contact_person" value="" placeholder="Enter Contact Person" >
                                    </div>
                                
                                    <div class="form-group">
                                        <label class="d-block">Email</label>
                                        <input id="Email" type="text" class="form-control clemail" name="email" value="" placeholder="Enter Email" readonly>
                                    </div>

                                    <div class="form-group">
                                        <label class="d-block">Mobile</label>
                                        <input id="Mobile" type="text" class="form-control clmobile" name="mobile" value="" placeholder="Enter Mobile" readonly>
                                    </div>

                                    <div class="form-group">
                                        <label class="d-block">Landline</label>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <input type="hidden" name="countl_code" id="countl_code" value="">
                                                <input id="city_code" type="text" class="form-control" name="city_code" style="width:200px;" value="" placeholder="Enter STD Code" maxlength="5" readonly>
                                            </div>
                                            <div class="col-sm-6">
                                                <input id="company_name" type="text" class="form-control cllandline" name="landline" value="" placeholder="Enter Landline" readonly>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="d-block">Company Name</label>
                                        <input id="company_name" type="text" class="form-control company_name" name="company_name" value="" placeholder="Enter Company Name" readonly>
                                    </div>
                                

                                <div class="form-group">
                                    <label>Address Line 1</label>
                                    <textarea class="form-control address_1" name="client_address_line1" rows="2" readonly></textarea>

                                </div>

                                <div class="form-group">
                                    <label>Address Line 2</label>
                                    <textarea class="form-control address_2" name="client_address_line1" rows="2" readonly></textarea>

                                </div>
                            
                                <div class="form-group">
                                    <label for="state">State</label>
                                    <select  class="form-control clstate" name="client_state_id" id="tradestate" data-url="{{route('getCity')}}" readonly>

                                        <option value="">Select State</option> 
                                            @foreach($states as $state)
                                                <option value="{{$state->id}}">{{$state->name}}</option> 
                                             @endforeach
                                        
                                        </select>
                                    <div class="help-block with-errors"></div>
                                </div>
                           

                                <div class="form-group">
                                    <label for="city">City</label>
                                    <select  class="form-control clcity" name="client_city_id" id="tradecity" readonly>
                                                
                                    </select>
                                    <div class="help-block with-errors"></div>
                                </div>

                                      

                                <div class="form-group">
                                    <label for="pincode">Pincode</label>
                                    <input id="pincode" type="text" class="form-control clpincode" name="pincode" value="" placeholder="Enter Pincode" readonly>
                                    
                                </div>
                          
                                <div class="form-group">
                                    <label for="country">Country</label>
                                    <select  class="form-control clcountry" name="client_country_id" id="country" readonly>
                                        <option value="">Select Country</option> 
                                            @foreach($countries as $country)
                                            @if($country->id==99)
                                            <option value="{{$country->id}}" selected="selected">{{$country->name}}</option>
                                            @else
                                                <option value="{{$country->id}}">{{$country->name}}</option>
                                            @endif 
                                            @endforeach
                                        
                                        </select>
                                </div>
                                            
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card ">
                        
                        <div class="card-body">
                                        <div class="form-group">

                                            <label>Corporate Name</label>
                                            <select class="form-control select2" name="corporate_name" id="corpdetail" data-url="{{url('corporatesearch')}}">
                                            @foreach($corporates as $corporate)
                                            <option value="{{$corporate->first_name.' '.$corporate->last_name .'-'.$corporate->company_name.'-'.$corporate->citydetail->name}}" data-id="{{$corporate->id}}">{{$corporate->first_name.' '.$corporate->last_name .'-'.$corporate->company_name.'-'.$corporate->citydetail->name}}</option>
                                            @endforeach
                                            </select>
                                            <!-- <input id="corporate_name" type="text" class="form-control" name="corporate_name" value="" placeholder="Enter Corporate Name"> -->
                                            

                                        </div>
                                
                                        <div class="form-group">
                                            <label for="corporate_id">Corporate code</label>
                                            <input type="hidden" name="corporate_id" class="corpid" value="">
                                             <input id="corporate_id" type="text" class="form-control corpcode" name="corporate_code" value="" placeholder="Enter Corporate Id" readonly>
                                            
                                        </div>

                                        <div class="form-group">
                                        <label class="d-block">Contact Person</label>
                                        <input id="corp_contact_person" type="text" class="form-control" name="corp_contact_person" value="" placeholder="Enter Corporate Contact Person">
                                    </div>

                                    <div class="form-group">
                                        <label class="d-block">Email</label>
                                        <input id="Email" type="text" class="form-control coemail" name="corporate_email" value="" placeholder="Enter Email" readonly>
                                    </div>

                                    <div class="form-group">
                                        <label class="d-block">Mobile</label>
                                        <input id="Mobile" type="text" class="form-control comobile" name="corporate_mobile" value="" placeholder="Enter Mobile" readonly>
                                    </div>

                                    <div class="form-group">
                                        <label class="d-block">Landline</label>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <input type="hidden" name="countl_code" id="countl_code" value="">
                                                <input id="corp_city_code" type="text" class="form-control" 
                                                name="corp_city_code" style="width:200px;" value="" placeholder="Enter STD Code" maxlength="5" readonly>
                                            </div>
                                            <div class="col-sm-6">
                                                <input id="corporate_landline" type="text" class="form-control colandline" name="corporate_landline" value="" placeholder="Enter Landline" readonly>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="d-block">Company Name</label>
                                        <input id="company_name" type="text" class="form-control corpcompany" name="corporate_company_name" value="{{old('company_name')}}" placeholder="Enter Company Name" readonly>
                                    </div>

                                    

                                    <div class="form-group">
                                        <label>Address Line 1</label>
                                        <textarea class="form-control coaddress" name="corpotate_address_line1" rows="2" readonly></textarea>

                                    </div>

                                    <div class="form-group">
                                        <label>Address Line 2</label>
                                        <textarea class="form-control coaddress_2" name="corpotate_address_line2" rows="2" readonly></textarea>

                                    </div>

                                    <div class="form-group">
                                        <label for="state_id">State</label>
                                        <select  class="form-control costate" name="corporate_state_id" id="corporate_id" data-url="{{route('getCity')}}" readonly>

                                            <option value="">Select State</option> 
                                                @foreach($states as $state)
                                                    <option value="{{$state->id}}">{{$state->name}}</option> 
                                                 @endforeach
                                            
                                            </select>
                                            
                                    </div>

                                        <div class="form-group">
                                            <label for="city">City</label>
                                            <select  class="form-control cocity" name="corporate_city_id" id="secondarycity" readonly>
                                               <option value="">Select City</option> 
                                                    @foreach($cities as $city)
                                                        <option value="{{$city->id}}">{{$city->name}}</option> 
                                                     @endforeach 
                                            </select>
                                            
                                        </div>

                                        <div class="form-group">
                                            <label for="secondpincode">Pincode</label>
                                            <input id="secondpincode" type="text" class="form-control copincode" name="secondary_pincode" value="" placeholder="Enter Pincode" readonly>
                                            <div class="help-block with-errors"></div>
                                        </div>  

                                        <div class="form-group">
                                            <label for="country">Country</label>
                                            <select  class="form-control cocountry" name="corporate_country_id" id="corp_country" readonly>
                                                <option value="">Select Country</option> 
                                                    @foreach($countries as $country)
                                                    @if($country->id==99)
                                                    <option value="{{$country->id}}" selected="selected">{{$country->name}}</option>
                                                    @else
                                                        <option value="{{$country->id}}">{{$country->name}}</option>
                                                    @endif 
                                                    @endforeach
                                                
                                            </select>
                                        </div>      
                        </div>
                    </div>
                </div>
            </div>

        <div>
            <table class="table" id="producttable" width="100%">
                <thead>
                    <tr>
                        <th style="width:1%"></th>
                        <th title="Field #1" style="width:15%">Product Description</th>
                        <th title="Field #2" style="width:5%">Customer UOM</th>
                        <th title="Field #3" style="width:10%">Quantity</th>
                        <th title="Field #4" style="width:15%">Product</th>
                        <th title="Field #5" style="width:10%">Image</th>
                        <th title="Field #6" style="width:10%">Product Group</th>
                        <th title="Field #7" style="width:10%">Product Category</th>
                        <th title="Field #8" style="width:10%">Product Sub Category</th>
                        <!-- <th width="8%">Remove</th> -->
                        <th title="Field #9" style="width:10%">Product Name</th>
                        <th title="Field #10" style="width:10%">Product Specification</th>
                        <th title="Field #11" style="width:15%">UOM</th> 

                    </tr>
                </thead>
                <tbody>
                
                    <tr id="1" class="inventoryadjust" > 
                        <td></td>
                        <td>
                            <textarea class="form-control" id="search_selected" name="customer_product_description[]" rows="2"></textarea>
                            
                        </td>
                        <td>
                            <input type="text" name="customer_UOM[]" class="form-control" placeholder="UOM"  value="">      
                        </td>
                        <td>
                           <input type="text" name="quantity[]" class="form-control" placeholder="Quantity" aria-describedby="basic-addon1" value=""> 
                        </td>
                        <td>
                            <select class="form-control select2" name="product[]" id="productdetail" data-url="{{url('searchproduct')}}" data-publicurl="{{url('/')}}">
                                @foreach($products as $product)

                                <option value="{{$product->name .'-'. $product->brand .'-'. $product->description}}" data-id="{{$product->id}}">{{$product->name.'-'.$product->brand.'-'.$product->description}}</option>
                                @endforeach
                            </select>
                            <!-- <input type="text" id="product_name" name="product_name[]" class="form-control searchproduct_1" placeholder="Product"  autocomplete="off"> -->
                        </td>
                        <td>
                            <input type="hidden" id="product_id" name="product_id[]"  class="form-control product_id" placeholder="product Id"  autocomplete="off">

                            <img src="{{url('img/Image.png')}}" alt="" id="output_image" class="img" style="width: 100px; height: 70px;">
                        </td>
                        
                        <td>
                            <select  class="form-control parentcat" name="product_group_id" data-url="{{url('item/getchildcat')}}" id="progroup">

                                <option value="">Select Product Group</option> 
                                @foreach($categories as $category)
                                        
                                    <option value="{{$category->id}}">{{$category->name}}</option> 
                                        
                                @endforeach
                                                    
                            </select>
                        </td>
                        <td>
                            <select class="form-control select2 subcat" id="procat" name="product_category_id[]" multiple="multiple" data-url="{{url('/')}}">
                            </select>
                                       
                        </td>
                        <td>
                           
                            <select class="form-control select2" id="prosubcat" name="sub_category_id[]" multiple="multiple" >
                            </select>
                        </td>
                        <td>
                            <input id="title" type="text" class="form-control proname" name="name[]" value="" placeholder="Enter  Product Name" >
                        </td>
                        <td>
                            <textarea class="form-control spec" name="description" rows="2" id="spec"></textarea>
                        </td>
                        <td>
                           
                                <select  class="form-control measurement" name="customer_UOM[]" id="measurement" >

                                    <option value="">Select UOM</option> 
                                        @foreach($measurements as $measurement)
                                            
                                            <option value="{{$measurement->id}}">{{$measurement->name}}</option> 
                                            
                                        @endforeach
                                    
                                </select>
                        </td>
                        
                        <!-- <td > <label></label><a href="javascript:;" data-count_val="" class="deleterow"><i class="ik ik-trash-2 f-16 text-red"></i></a></td> -->

                    </tr>

                    {{--<tr id="2" class="inventoryadjust" > 
                        <td ></td>
                        <td>
                            <textarea class="form-control" id="search_selected" name="customer_product_description[]" rows="2"></textarea>

                            
                        </td>
                        <td>
                            <input type="text" name="customer_UOM[]" class="form-control" placeholder="UOM"  value=""> 
                                
                        </td>
                        <td>
                           <input type="text" name="quantity[]" class="form-control" placeholder="Quantity" aria-describedby="basic-addon1" value=""> 
                        </td>
                        <td>
                            <select class="form-control select2" name="product_name[]" id="productdetail" data-url="{{url('searchproduct')}}">
                                @foreach($products as $product)

                                <option value="{{$product->name .'-'. $product->brand .'-'. $product->description}}" data-id="{{$product->id}}">{{$product->name.'-'.$product->brand.'-'.$product->description}}</option>
                                @endforeach
                            </select>
                            <!-- <input type="text" id="product_name" name="product_name[]" class="form-control searchproduct_1" placeholder="Product"  autocomplete="off"> -->
                        </td>
                        <td>
                            <input type="hidden" id="product_id" name="product_id[]"  class="form-control product_id" placeholder="product Id"  autocomplete="off">

                            <input type="text" id="product_code" name="product_code[]"  class="form-control product_code" placeholder="product Id"  autocomplete="off">
                            
                           
                        </td>
                        
                        <td>
                            <select  class="form-control parentcat" name="product_group_id" data-url="{{url('item/getchildcat')}}" id="progroup">

                                <option value="">Select Product Group</option> 
                                @foreach($categories as $category)
                                        
                                    <option value="{{$category->id}}">{{$category->name}}</option> 
                                        
                                @endforeach
                                                    
                            </select>
                        </td>
                        <td>
                            
                                            
                           
                            <select class="form-control select2 subcat" id="procat" name="product_category_id[]" multiple="multiple" data-url="{{url('/')}}">
                            </select>
                                       
                        </td>
                        <td>
                           
                                <select class="form-control select2" id="prosubcat" name="sub_category_id[]" multiple="multiple" >
                                </select>
                        </td>
                        <td>
                            <input id="title" type="text" class="form-control proname" name="name[]" value="" placeholder="Enter  Product Name" >
                        </td>
                        <td>
                            <textarea class="form-control spec" name="description" rows="2" id="spec"></textarea>
                        </td>
                        <td>
                           
                                <select  class="form-control measurement" name="customer_UOM[]" id="measurement" >

                                    <option value="">Select UOM</option> 
                                        @foreach($measurements as $measurement)
                                            
                                            <option value="{{$measurement->id}}">{{$measurement->name}}</option> 
                                            
                                        @endforeach
                                    
                                </select>
                        </td>
                        
                        <td>
                            
                            <img src="{{url('img/Image.png')}}" alt="" id="output_image"  style="width: 72%; height: 20px;">
            
                        </td>

                        
                        <!-- <td > <label></label><a href="javascript:;" data-count_val="" class="deleterow"><i class="ik ik-trash-2 f-16 text-red"></i></a></td> -->

                    </tr>

                    <tr id="3" class="inventoryadjust" > 
                        <td ></td>
                        <td>
                            <textarea class="form-control" id="search_selected" name="customer_product_description[]" rows="2"></textarea>

                            
                        </td>
                        <td>
                            <input type="text" name="customer_UOM[]" class="form-control" placeholder="UOM"  value=""> 
                                
                        </td>
                        <td>
                           <input type="text" name="quantity[]" class="form-control" placeholder="Quantity" aria-describedby="basic-addon1" value=""> 
                        </td>
                        <td>
                            <select class="form-control select2" name="product_name[]" id="productdetail" data-url="{{url('searchproduct')}}">
                                @foreach($products as $product)

                                <option value="{{$product->name .'-'. $product->brand .'-'. $product->description}}" data-id="{{$product->id}}">{{$product->name.'-'.$product->brand.'-'.$product->description}}</option>
                                @endforeach
                            </select>
                            <!-- <input type="text" id="product_name" name="product_name[]" class="form-control searchproduct_1" placeholder="Product"  autocomplete="off"> -->
                        </td>
                        <td>
                            <input type="hidden" id="product_id" name="product_id[]"  class="form-control product_id" placeholder="product Id"  autocomplete="off">

                            <input type="text" id="product_code" name="product_code[]"  class="form-control product_code" placeholder="product Id"  autocomplete="off">
                            
                           
                        </td>
                        
                        <td>
                            <select  class="form-control parentcat" name="product_group_id" data-url="{{url('item/getchildcat')}}" id="progroup">

                                <option value="">Select Product Group</option> 
                                @foreach($categories as $category)
                                        
                                    <option value="{{$category->id}}">{{$category->name}}</option> 
                                        
                                @endforeach
                                                    
                            </select>
                        </td>
                        <td>
                            
                                            
                           
                            <select class="form-control select2 subcat" id="procat" name="product_category_id[]" multiple="multiple" data-url="{{url('/')}}">
                            </select>
                                       
                        </td>
                        <td>
                           
                                <select class="form-control select2" id="prosubcat" name="sub_category_id[]" multiple="multiple" >
                                </select>
                        </td>
                        <td>
                            <input id="title" type="text" class="form-control proname" name="name[]" value="" placeholder="Enter  Product Name" >
                        </td>
                        <td>
                            <textarea class="form-control spec" name="description" rows="2" id="spec"></textarea>
                        </td>
                        <td>
                           
                                <select  class="form-control measurement" name="customer_UOM[]" id="measurement" >

                                    <option value="">Select UOM</option> 
                                        @foreach($measurements as $measurement)
                                            
                                            <option value="{{$measurement->id}}">{{$measurement->name}}</option> 
                                            
                                        @endforeach
                                    
                                </select>
                        </td>
                        
                        <td>
                            
                            <img src="{{url('img/Image.png')}}" alt="" id="output_image"  style="width: 72%; height: 20px;">
            
                        </td>

                        
                        <!-- <td > <label></label><a href="javascript:;" data-count_val="" class="deleterow"><i class="ik ik-trash-2 f-16 text-red"></i></a></td> -->

                    </tr>

                    <tr id="4" class="inventoryadjust" > 
                        <td ></td>
                        <td>
                            <textarea class="form-control" id="search_selected" name="customer_product_description[]" rows="2"></textarea>

                            
                        </td>
                        <td>
                            <input type="text" name="customer_UOM[]" class="form-control" placeholder="UOM"  value=""> 
                                
                        </td>
                        <td>
                           <input type="text" name="quantity[]" class="form-control" placeholder="Quantity" aria-describedby="basic-addon1" value=""> 
                        </td>
                        <td>
                            <select class="form-control select2" name="product_name[]" id="productdetail" data-url="{{url('searchproduct')}}">
                                @foreach($products as $product)

                                <option value="{{$product->name .'-'. $product->brand .'-'. $product->description}}" data-id="{{$product->id}}">{{$product->name.'-'.$product->brand.'-'.$product->description}}</option>
                                @endforeach
                            </select>
                            <!-- <input type="text" id="product_name" name="product_name[]" class="form-control searchproduct_1" placeholder="Product"  autocomplete="off"> -->
                        </td>
                        <td>
                            <input type="hidden" id="product_id" name="product_id[]"  class="form-control product_id" placeholder="product Id"  autocomplete="off">

                            <input type="text" id="product_code" name="product_code[]"  class="form-control product_code" placeholder="product Id"  autocomplete="off">
                            
                           
                        </td>
                        
                        <td>
                            <select  class="form-control parentcat" name="product_group_id" data-url="{{url('item/getchildcat')}}" id="progroup">

                                <option value="">Select Product Group</option> 
                                @foreach($categories as $category)
                                        
                                    <option value="{{$category->id}}">{{$category->name}}</option> 
                                        
                                @endforeach
                                                    
                            </select>
                        </td>
                        <td>
                            
                                            
                           
                            <select class="form-control select2 subcat" id="procat" name="product_category_id[]" multiple="multiple" data-url="{{url('/')}}">
                            </select>
                                       
                        </td>
                        <td>
                           
                                <select class="form-control select2" id="prosubcat" name="sub_category_id[]" multiple="multiple" >
                                </select>
                        </td>
                        <td>
                            <input id="title" type="text" class="form-control proname" name="name[]" value="" placeholder="Enter  Product Name" >
                        </td>
                        <td>
                            <textarea class="form-control spec" name="description" rows="2" id="spec"></textarea>
                        </td>
                        <td>
                           
                                <select  class="form-control measurement" name="customer_UOM[]" id="measurement" >

                                    <option value="">Select UOM</option> 
                                        @foreach($measurements as $measurement)
                                            
                                            <option value="{{$measurement->id}}">{{$measurement->name}}</option> 
                                            
                                        @endforeach
                                    
                                </select>
                        </td>
                        
                        <td>
                            
                            <img src="{{url('img/Image.png')}}" alt="" id="output_image"  style="width: 72%; height: 20px;">
            
                        </td>

                        
                        <!-- <td > <label></label><a href="javascript:;" data-count_val="" class="deleterow"><i class="ik ik-trash-2 f-16 text-red"></i></a></td> -->

                    </tr>

                    <tr id="5" class="inventoryadjust" > 
                        <td ></td>
                        <td>
                            <textarea class="form-control" id="search_selected" name="customer_product_description[]" rows="2"></textarea>

                            
                        </td>
                        <td>
                            <input type="text" name="customer_UOM[]" class="form-control" placeholder="UOM"  value=""> 
                                
                        </td>
                        <td>
                           <input type="text" name="quantity[]" class="form-control" placeholder="Quantity" aria-describedby="basic-addon1" value=""> 
                        </td>
                        <td>
                            <select class="form-control select2" name="product_name[]" id="productdetail" data-url="{{url('searchproduct')}}" data-publicurl="{{url('/')}}">
                                @foreach($products as $product)

                                <option value="{{$product->name .'-'. $product->brand .'-'. $product->description}}" data-id="{{$product->id}}">{{$product->name.'-'.$product->brand.'-'.$product->description}}</option>
                                @endforeach
                            </select>
                            <!-- <input type="text" id="product_name" name="product_name[]" class="form-control searchproduct_1" placeholder="Product"  autocomplete="off"> -->
                        </td>
                        <td>
                            <input type="hidden" id="product_id" name="product_id[]"  class="form-control product_id" placeholder="product Id"  autocomplete="off">

                            <input type="text" id="product_code" name="product_code[]"  class="form-control product_code" placeholder="product Id"  autocomplete="off">
                            
                           
                        </td>
                        
                        <td>
                            <select  class="form-control parentcat" name="product_group_id" data-url="{{url('item/getchildcat')}}" id="progroup">

                                <option value="">Select Product Group</option> 
                                @foreach($categories as $category)
                                        
                                    <option value="{{$category->id}}">{{$category->name}}</option> 
                                        
                                @endforeach
                                                    
                            </select>
                        </td>
                        <td>
                            
                                            
                           
                            <select class="form-control select2 subcat" id="procat" name="product_category_id[]" multiple="multiple" data-url="{{url('/')}}">
                            </select>
                                       
                        </td>
                        <td>
                           
                                <select class="form-control select2" id="prosubcat" name="sub_category_id[]" multiple="multiple" >
                                </select>
                        </td>
                        <td>
                            <input id="title" type="text" class="form-control proname" name="name[]" value="" placeholder="Enter  Product Name" >
                        </td>
                        <td>
                            <textarea class="form-control spec" name="description" rows="2" id="spec"></textarea>
                        </td>
                        <td>
                           
                                <select  class="form-control measurement" name="customer_UOM[]" id="measurement" >

                                    <option value="">Select UOM</option> 
                                        @foreach($measurements as $measurement)
                                            
                                            <option value="{{$measurement->id}}">{{$measurement->name}}</option> 
                                            
                                        @endforeach
                                    
                                </select>
                        </td>
                        
                        <td>
                            
                            <img src="{{url('img/Image.png')}}" alt="" id="output_image"  style="width: 72%; height: 20px;">
            
                        </td>

                        
                        <!-- <td > <label></label><a href="javascript:;" data-count_val="" class="deleterow"><i class="ik ik-trash-2 f-16 text-red"></i></a></td> -->

                    </tr>
                    <tr id="5" class="inventoryadjust" > 
                        <td ></td>
                        <td>
                            <textarea class="form-control" id="search_selected" name="customer_product_description[]" rows="2"></textarea>
                            
                        </td>
                        <td>
                            <input type="text" name="customer_UOM[]" class="form-control" placeholder="UOM"  value=""> 
                                
                        </td>
                        <td>
                           <input type="text" name="quantity[]" class="form-control" placeholder="Quantity" aria-describedby="basic-addon1" value=""> 
                        </td>
                        <td>
                            <input type="text" id="product_name" name="product_name[]" class="form-control searchproduct_1" placeholder="Product"  autocomplete="off">
                        </td>
                        <td>
                            <input type="text" id="product_id" name="product_id[]"  class="form-control product_id" placeholder="product Id"  autocomplete="off">    
                        </td>
                        
                        <td>
                            <input type="text" id="product_group" name="product_group_id[]"  class="form-control parentcat" placeholder="Product Group"  autocomplete="off">

                            <select  class="form-control parentcat" name="product_group_id" data-url="{{url('item/getchildcat')}}" id="progroup">

                                <option value="">Select Product Group</option> 
                                @foreach($categories as $category)
                                        
                                    <option value="{{$category->id}}">{{$category->name}}</option> 
                                        
                                @endforeach
                                                    
                            </select>
                        </td>
                        <td>
                            
                            <input type="text" id="product_category" name="product_category_id[]"  class="form-control procat" placeholder="Product Category"  autocomplete="off">             
                           
                            <select class="form-control select2 subcat" id="procat" name="product_category_id[]" multiple="multiple" data-url="{{url('/')}}">
                            </select>
                                       
                        </td>
                        <td>
                            <input type="text" id="product_subcategory" name="sub_category_id[]"  class="form-control prosubcat" placeholder="Product Category"  autocomplete="off"> 

                                <select class="form-control select2" id="prosubcat" name="sub_category_id[]" multiple="multiple" >
                                </select>
                        </td>
                        <td>
                            <input id="title" type="text" class="form-control" name="name" value="" placeholder="Enter  Product Name" >
                        </td>
                        <td>
                            <textarea class="form-control" name="description" rows="2"></textarea>
                        </td>
                        <td>
                           
                                <select  class="form-control" name="customer_UOM[]" id="measurement" >

                                    <option value="">Select UOM</option> 
                                        @foreach($measurements as $measurement)
                                            
                                            <option value="{{$measurement->id}}">{{$measurement->name}}</option> 
                                            
                                        @endforeach
                                    
                                </select>
                        </td>
                        
                        <td>
                            
                            <img src="{{url('img/Image.png')}}" alt="" id="output_image" class="img"  style="width: 72%; height: 20px;">
            
                        </td>

                        
                        <!-- <td > <label></label><a href="javascript:;" data-count_val="" class="deleterow"><i class="ik ik-trash-2 f-16 text-red"></i></a></td> -->

                    </tr>--}}
               
                </tbody>
            </table>
            <div >
                <input type="button" id="addrow" value="Add Row" class="btn btn-info addrow" data-url="{{url('/')}}" data-products="{{isset($products) ? $products:''}}">
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
                                    <button type="submit" class="btn btn-primary">{{ __('Submit')}}</button>
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

    var route = "{{ url('searchclient') }}";
    $('#client_name').typeahead({
            source: function (query, process) {
                return $.get(route, {
                    query: query
                }, function (data) {
                    console.log(data);
                    return process(data);
                });
            }
        });
    
    </script>

    <script type="text/javascript">

    /*var url = "{{ url('corporatesearch') }}";
    $('#corporate_name').typeahead({
            source: function (query, process) {
                return $.get(url, {
                    query: query
                }, function (data) {
                    return process(data);
                });
            }
        });
    */
    </script>
    
<script type="text/javascript">
    $("#addrow").click(function() {
    //console.log(counter);
    var row ='';
    var count = $("#producttable>tbody tr").length;
    //console.log(count);
    var counter=count+1;
    //console.log(counter);
    var products=$(this).data('products');

    var url=$(this).data('url');

    row +=  '<tr id="'+ counter +'" class="inventoryadjust">';
    row +=  '<td>';
    row +=  '</td>';
    row +=  '<td>';
    row +=  '<textarea class="form-control" id="search_selected" name="customer_product_description[]" rows="2"></textarea>';
    row +=  '</td>';

    row+=   '<td>';
    row+=   '<input type="text" name="customer_UOM[]" class="form-control" placeholder="UOM"  value="">';
    row +=  '</td>';

    row +=  '<td>';
    row +=  '<input type="text" name="quantity[]" class="form-control" placeholder="Quantity" aria-describedby="basic-addon1" value=""> ';
    row +=  '</td>';
    row+=   '<td>';
    row+='<select class="form-control select2" name="product_name[]" id="productdetail_'+counter+'">';

            $.each(products, function(i, product) {

    row+='<option value="' + product.name +'-'+ product.brand +'-'+ product.description+'" data-id="'+product.id+'">'+product.name+'-'+product.brand+'-'+product.description+'</option>';
            
            });

    row+='</select>';
    row += '</td>';

    row+= '<td>';
    row+= '<input type="hidden" id="product_id" name="product_id[]"  class="form-control product_id" placeholder="product Id"  autocomplete="off">';

    row+= '<img src="'+url+'/img/Image.png'+'" alt="" id="output_image" class="img"  style="width: 100px; height: 70px;">';
    row += '</td>';

    row+= '<td>';
    row+= '<input type="text" id="product_name" name="product_name[]" class="form-control searchproduct_1" placeholder="Product"  autocomplete="off">';
    row +='</td>';

    row+= '<td>';
    row+= '<select class="form-control select2 subcat" id="procat" name="product_category_id[]" multiple="multiple" data-url="">';
    row+= '</select>';
    row +='</td>';

    row+= '<td>';
    row+= '<select class="form-control select2" id="prosubcat" name="sub_category_id[]" multiple="multiple">';
    row +='</select>';
    row +='</td>';

    row+=   '<td>';
    row+=   '<input id="title" type="text" class="form-control proname" name="name" value="" placeholder="Enter Product Name" >';
    row +=  '</td>';

    row+=   '<td>';
    row+=   '<textarea class="form-control spec" name="description" rows="2"></textarea>';
    row +=  '</td>';

    row+=   '<td>';
    row+=   '<select  class="form-control measurement" name="customer_UOM[]" id="measurement" >';
                          
    row+=   '</select>';
    row +=  '</td>';
    
    /*row +=  '<td width="8%"> <label></label><a href="javascript:;" data-count_val="' + counter + '" class="deleterow"><i class="ik ik-trash-2 f-16 text-red"></i></a></td>';*/
    row +=  '</tr>';

    $('.inventoryadjust:last').after(row);

    $('#productdetail_'+counter+'').change(function() { 
            //alert('gnjghjgh');
            var scope = $(this).closest('tr'); 
            var url=$('#productdetail').data('url');
            var publicurl=$("#addrow").data('url');
            var id=scope.find('#productdetail_'+counter+' option:selected').data('id');
            console.log(publicurl);
            console.log(id);
             $.ajax({
                    url:url,
                    type:'GET',
                    data:{'id':id},
                    success:function(res){
                        console.log(res);   
                       scope.find('.product_id').val(res.pro.id);
                        //$('.client').val(res.client.first_name);
                        scope.find('.product_code').val(res.pro.product_code);

                        var $selectcity = scope.find('.parentcat');
                        console.log($selectcity);
                        $selectcity.find('option').remove();
                        //console.log(res.productcategory)
                        jQuery.each(res.productcategory, function(index, value){
                            //console.log(value.parentcategory.id);
                            if(value.product_id == res.pro.id){ 
                                $selectcity.append($("<option value="+value.parentcategory.id+" selected='selected'>"+value.parentcategory.name+"</option>"));
                            }
                        });

                        scope.find('.proname').val(res.pro.name);

                        scope.find('.spec').val(res.pro.model_details);

                        var $uom = scope.find('.measurement');
                        //console.log($uom);
                        
                        //console.log(res.measurements);
                        //console.log(res.pro.measurement_id);
                        jQuery.each(res.measurements, function(index, value){
                            //console.log(value.parentcategory.id);
                            if(value.id == res.pro.measurement_id){ 
                                $uom.append($("<option value="+value.id+" selected='selected'>"+value.name+"</option>"));
                            }
                            else{
                                $uom.append($("<option value="+value.id+">"+value.name+"</option>"));
                            }
                        });
                        var detailUrl=publicurl+'/images/upload/item/'+res.pro.image;
                        console.log(detailUrl);
                        scope.find("img#output_image").attr('src' , detailUrl);
                           
                    }
                });
        });

    });

    
    
</script>
<!-- <script>
    $(document).on('click', '.deleterow', function(event) {
        //event.preventDefault();
        alert('ghgfhf');
        $($(this).closest("tr")).remove();
        
    });
</script> -->
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/11.0.9/js/utils.js"></script>
<script type="text/javascript">
    $(".clmobile").intlTelInput({

  separateDialCode: true,
  preferredCountries:["in"],
  hiddenInput: "full",
  utilsScript: "//cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.3/js/utils.js"
});

    
    $(".comobile").intlTelInput({

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
 
 $('#corp_city_code').intlTelInput({
    separateDialCode: true,
  preferredCountries:["in"],
  hiddenInput: "full",
  utilsScript: "//cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.3/js/utils.js"
});
</script>
<script type="text/javascript">

        $('.parentcat').change(function() { 
            var parent = $('.parentcat').val();
            //alert(parent);
            var publicurl= $(this).data('url');
            //alert(publicurl);
            var public=$(this).data('public');
            if(parent!=''){

                $.ajax({
                    url:publicurl,
                    type:'GET',
                    data:{'id':parent},
                    success:function(data){
                        //console.log(data);
                        var row='';
                            
                            row+='<option value=>Select Parent</option>';
                            jQuery.each(data, function(i, cat){
                                row+='<option value='+cat['id']+'>'+cat['name']+'</option>';
                            });
                            
                            $('.subcategory').css('display','block');
                            $('#procat').html(row);
                    }
                });
              
            }
        });

        
    </script>
    <script>
        $(document).on('change', '.subcat', function() {
            //alert('dbvgdfdf');
            var parentid = $(".subcat :selected").map((_, e) => e.value).get();
            console.log(parentid);
            var publicurl= $(this).data('url');
            //alert(publicurl);
            if(parentid!=''){

                $.ajax({
                    url:publicurl+'/item/getsubcat/',
                    type:'GET',
                    data:{'id':parentid},
                    success:function(res){
                        console.log(res);
                        var row='';
                       
                                jQuery.each(res, function(i, cat){
                                row+='<option value='+cat['id']+'>'+cat['name']+'</option>';
                                });
                            
                            $('.childcategory').css('display','block');
                            $('#prosubcat').html(row);
                            
                    }
                });
            }
        });

        
        $('#clientdetail').change(function() { 
            //alert('gnjghjgh');
            var url=$(this).data('url');
            var id=$('#clientdetail option:selected').data('id');
            console.log(url);
            console.log(id);
             $.ajax({
                    url:url,
                    type:'GET',
                    data:{'id':id},
                    success:function(res){
                        console.log(res);   
                        $('.clientid').val(res.client.id);
                        $('.client').val(res.client.first_name);
                        $('.client_code').val(res.client.client_code);
                        $('.company_name').val(res.client.company_name);

                        $('.clemail').val(res.client.email);
                        $('.clmobile').val(res.client.mobile);
                        $('#city_code').val(res.client.city_code);
                        $('.cllandline').val(res.client.landline);

                        $('.address_1').val(res.client.address);
                        $('.address_2').val(res.client.address_1);

                        //var state='';
                        //state+='<option value="'+res.statedetail.id+'">'+res.statedetail.name+'</option>';

                        var $select = $('.clstate');
                        $select.find('option').remove();

                        jQuery.each(res.states, function(index, value){

                            if(value.id == res.client.statedetail.id){ 
                                $select.append($("<option value="+value.id+" selected='selected'>"+value.name+"</option>"));
                            }else{

                                $select.append($("<option value="+value.id+">"+value.name+"</option>"));
                            }
                        });


                        var $selectcity = $('.clcity');
                        $selectcity.find('option').remove();

                        jQuery.each(res.cities, function(index, value){

                            if(value.id == res.client.citydetail.id){ 
                                $selectcity.append($("<option value="+value.id+" selected='selected'>"+value.name+"</option>"));
                            }else{

                                $selectcity.append($("<option value="+value.id+">"+value.name+"</option>"));
                            }
                        });

                        $('.clpincode').val(res.client.pincode);

                        var $country = $('.clcountry');
                        $country.find('option').remove();

                        jQuery.each(res.countries, function(index, value){

                            if(value.id == res.client.countrydetail.id){ 
                                $country.append($("<option value="+value.id+" selected='selected'>"+value.name+"</option>"));
                            }else{

                                $country.append($("<option value="+value.id+">"+value.name+"</option>"));
                            }
                        });



                        /*$('.clstate').append(
                              $.map(selectValues, (v,k) => $("<option>").val(res.statedetail.id).text(res.statedetail.name))
                              // $.map(selectValues, (v,k) => new Option(v, k)) // using plain JS
                            );*/
                        //append($('<option>').val(res.statedetail.id).text(res.statedetail.name));
                        //$('.clstate').append('<option value="'+res.statedetail.id+'">'+res.statedetail.name+'</option>');
                        
                        
                        
                        
                        
                    }
                });
        });

        $('#corpdetail').change(function() { 
            //alert('gnjghjgh');
            var url=$(this).data('url');
            var id=$('#corpdetail option:selected').data('id');
            console.log(url);
            console.log(id);
             $.ajax({
                    url:url,
                    type:'GET',
                    data:{'id':id},
                    success:function(res){
                        console.log(res);   

                        /*$('.client').val(res.first_name);*/
                        
                        $('.corpid').val(res.corp.id);
                        $('.corpcode').val(res.corp.corporate_code);
                        $('.corpcompany').val(res.corp.company_name);

                        $('.coemail').val(res.corp.email);
                        $('.comobile').val(res.corp.mobile);
                        $('#corp_city_code').val(res.corp.city_code);
                        $('.colandline').val(res.corp.landline);

                        $('.coaddress').val(res.corp.address);
                        $('.coaddress_2').val(res.corp.address_1);

                        var $select = $('.costate');
                        $select.find('option').remove();

                        jQuery.each(res.states, function(index, value){

                            if(value.id == res.corp.statedetail.id){ 
                                $select.append($("<option value="+value.id+" selected='selected'>"+value.name+"</option>"));
                            }else{

                                $select.append($("<option value="+value.id+">"+value.name+"</option>"));
                            }
                        });

                        var $selectcity = $('.cocity');
                        $selectcity.find('option').remove();

                        jQuery.each(res.cities, function(index, value){

                            if(value.id == res.corp.citydetail.id){ 
                                $selectcity.append($("<option value="+value.id+" selected='selected'>"+value.name+"</option>"));
                            }else{

                                $selectcity.append($("<option value="+value.id+">"+value.name+"</option>"));
                            }
                        });

                        //$('.costate').val(res.address_1);
                        //$('.cocity').val(res.address_1);
                        $('.copincode').val(res.pincode);
                        //$('.cocountry').val(res.address_1);
                        var $country = $('.cocountry');
                        $country.find('option').remove();

                        jQuery.each(res.countries, function(index, value){

                            if(value.id == res.corp.countrydetail.id){ 
                                $country.append($("<option value="+value.id+" selected='selected'>"+value.name+"</option>"));
                            }else{

                                $country.append($("<option value="+value.id+">"+value.name+"</option>"));
                            }
                        });
                        
                    }
                });
        });

        $('.sales').change(function(){
            //alert('ghfhgf');
            var id=$('.sales option:selected').val();
            //console.log(id);
            $('.userid').val(id);
        });

        $('#productdetail').change(function() { 
            //alert('gnjghjgh');
            var scope = $(this).closest('tr'); 
            var url=$(this).data('url');
            var publicurl=$(this).data('publicurl');
            var id=$('#productdetail option:selected').data('id');
            console.log(url);
            console.log(id);
             $.ajax({
                    url:url,
                    type:'GET',
                    data:{'id':id},
                    success:function(res){
                        console.log(res);   
                        scope.find('.product_id').val(res.pro.id);
                        //$('.client').val(res.client.first_name);
                        scope.find('.product_code').val(res.pro.product_code);

                        var $selectcity = scope.find('.parentcat');
                        console.log($selectcity);
                        $selectcity.find('option').remove();
                        //console.log(res.productcategory)
                        jQuery.each(res.productcategory, function(index, value){
                            //console.log(value.parentcategory.id);
                            if(value.product_id == res.pro.id){ 
                                $selectcity.append($("<option value="+value.parentcategory.id+" selected='selected'>"+value.parentcategory.name+"</option>"));
                            }
                        });

                        //scope.find('.product_code').val(res.pro.product_code);

                        //scope.find('.product_code').val(res.pro.product_code);

                        //scope.find('.product_code').val(res.pro.product_code);

                        scope.find('.proname').val(res.pro.name);

                        scope.find('.spec').val(res.pro.model_details);

                        var $uom = scope.find('.measurement');
                        //console.log($uom);
                        $uom.find('option').remove();
                        //console.log(res.measurements);
                        //console.log(res.pro.measurement_id);
                        jQuery.each(res.measurements, function(index, value){
                            //console.log(value.parentcategory.id);
                            if(value.id == res.pro.measurement_id){ 
                                $uom.append($("<option value="+value.id+" selected='selected'>"+value.name+"</option>"));
                            }
                            else{
                                $uom.append($("<option value="+value.id+">"+value.name+"</option>"));
                            }
                        });
                        var detailUrl=publicurl+'/images/upload/item/'+res.pro.image;
                        console.log(detailUrl);
                        scope.find("img#output_image").attr('src' , detailUrl);
                           
                    }
                });
        });
    </script>  

     
    @endpush
@endsection
