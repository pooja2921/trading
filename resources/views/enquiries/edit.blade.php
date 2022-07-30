@extends('inventory.layout') 
@section('title', 'Edit Enquiry')
@section('content')
    <!-- push external head elements to head -->
    @push('head')
        <link rel="stylesheet" href="{{ asset('plugins/select2/dist/css/select2.min.css') }}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.css">
        <style>
            .protable{
                overflow-x: auto;
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
                            <h5>{{ __('Edit Enquiry')}}</h5>
                            <span>{{ __('Edit Enquiry')}}</span>
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
                                <a href="#">{{ __('Edit Enquiry')}}</a>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <form class="forms-sample" method="POST" action="{{ route('enquiry.update',$enquiry->id) }}" enctype= multipart/form-data id="clientform">
        @csrf
        @method('PUT')
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
                                       <label class="d-block">Company Name (Client Name)</label>
                                       <select class="form-control select2" name="client" id="clientdetail" data-url="{{url('searchclient')}}">
                                        @foreach($clients as $client)
                                        @if($client->id==$enquiry->client_id)
                                        <option value="{{$client->first_name.' '.$client->last_name .'-'.$client->company_name.'-'.$client->citydetail->name}}" data-id="{{$client->id}}" selected="true">{{$client->first_name.' '.$client->last_name .'-'.$client->company_name.'-'.$client->citydetail->name}}</option>
                                        @else
                                        <option value="{{$client->first_name.' '.$client->last_name .'-'.$client->company_name.'-'.$client->citydetail->name}}" data-id="{{$client->id}}">{{$client->first_name.' '.$client->last_name .'-'.$client->company_name.'-'.$client->citydetail->name}}</option>
                                        @endif
                                        @endforeach
                                    </select>
                                       
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                    <label>Company Name (Corporate Name)</label>
                                    <select class="form-control select2" name="corporate_name" id="corpdetail" data-url="{{url('corporatesearch')}}">
                                        @foreach($corporates as $corporate)
                                            @if($corporate->id==$enquiry->corporate_id)
                                                <option value="{{$corporate->first_name.' '.$corporate->last_name .'-'.$corporate->company_name.'-'.$corporate->citydetail->name}}" data-id="{{$corporate->id}}" selected="true">{{$corporate->first_name.' '.$corporate->last_name .'-'.$corporate->company_name.'-'.$corporate->citydetail->name}}</option>
                                            @else
                                                <option value="{{$corporate->first_name.' '.$corporate->last_name .'-'.$corporate->company_name.'-'.$corporate->citydetail->name}}" data-id="{{$corporate->id}}">{{$corporate->first_name.' '.$corporate->last_name .'-'.$corporate->company_name.'-'.$corporate->citydetail->name}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    
                                    </div>
                                </div>
                                    
                                <div class="col-sm-6">    
                                        <div class="form-group">
                                            <label for="first_name">Client Quotation Number</label>
                                            <input id="first_name" type="text" class="form-control" name="client_quotation_number" value="{{isset($enquiry->client_quotation_number) ? $enquiry->client_quotation_number:''}}" placeholder="Enter Client Quotation Number" >
                                            


                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="middle_name">Email Received from<span class="text-red">*</span></label>
                                            <input id="middle_name" type="text" class="form-control" name="email_received_from" value="{{isset($enquiry->email_received_from) ? $enquiry->email_received_from:''}}" placeholder="Enter Email">
                                            


                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="last_name">Email Received On (Date)</label>
                                            <input id="last_name" type="date" class="form-control" name="email_received_date" value="{{isset($enquiry->email_received_date) ? $enquiry->email_received_date:''}}" placeholder="Enter Email Received On">
                                            


                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="email">Sales and Procurement Specialist</label>
                                            
                                            <select  class="form-control sales" name="sales_procurement_specialist" id="sales" >

                                                <option value="">Select Sales Specialist</option> 
                                                    @foreach($users as $user)
                                                        @if($user->user_code==$enquiry->user_code)
                                                        <option value="{{$user->user_code}}" selected>{{$user->name}}</option> 
                                                        @else
                                                            <option value="{{$user->user_code}}">{{$user->name}}</option>
                                                        @endif 
                                                    @endforeach
                                                
                                                </select>
                                                        
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="user_id">User ID</label>
                                            <input id="user_id" type="text" class="form-control userid" name="user_code" value="{{isset($enquiry->user_code) ? $enquiry->user_code:''}}" placeholder="Enter User ID"readonly>
                                       
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
                                        <label for="client_code">Client Code</label>
                                        <input type="hidden" class="clientid" name="client_id" value="">
                                        <input id="client_code" type="text" class="form-control client_code" name="client_code" value="{{isset($enquiry->client_code) ? $enquiry->client_code:''}}" placeholder="Enter Client Code" readonly>
                                        
                                    </div>       
                                
                                
                                    <div class="form-group">
                                        <label class="d-block">Contact Person (Client)</label>
                                        <input id="contact_person" type="text" class="form-control contact_person client" name="contact_person" value="{{isset($enquiry->contact_person) ? $enquiry->contact_person:''}}" placeholder="Enter Contact Person" readonly>
                                    </div>

                                    <div class="form-group">
                                        <label class="d-block">Email</label>
                                        <input id="Email" type="text" class="form-control clemail" name="email" value="{{isset($enquiry->email) ? $enquiry->email:''}}" placeholder="Enter Email" readonly>
                                    </div>

                                    <div class="form-group">
                                        <label class="d-block">Mobile</label>
                                        <input id="Mobile" type="text" class="form-control clmobile" name="mobile" value="{{isset($enquiry->mobile) ? $enquiry->mobile:''}}" placeholder="Enter Mobile" readonly>
                                    </div>

                                    <div class="form-group">
                                        <label class="d-block">Landline</label>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <input type="hidden" name="countl_code" id="countl_code" value="">
                                                <input id="city_code" type="text" class="form-control" name="city_code" style="width:200px;" value="{{isset($enquiry->city_code) ? $enquiry->city_code:''}}" placeholder="Enter STD Code" maxlength="5" readonly>
                                            </div>
                                            <div class="col-sm-6">
                                                <input id="company_name" type="text" class="form-control cllandline" name="landline" value="{{isset($enquiry->landline) ? $enquiry->landline:''}}" placeholder="Enter Landline" readonly>
                                            </div>
                                        </div>
                                    </div>
                                
                                    <div class="form-group">
                                        <label class="d-block">Company Name</label>
                                        <input id="company_name" type="text" class="form-control" name="company_name" value="{{isset($enquiry->company_name) ? $enquiry->company_name:''}}" placeholder="Enter Company Name" readonly>
                                    </div>
                                

                                <div class="form-group">
                                    <label>Address Line 1</label>
                                    <textarea class="form-control" name="client_address_line1" rows="2" readonly>{{isset($enquiry->client_address_line1) ? $enquiry->client_address_line1:''}}</textarea>

                                </div>

                                <div class="form-group">
                                    <label>Address Line 2</label>
                                    <textarea class="form-control" name="client_address_line2" rows="2" readonly>{{isset($enquiry->client_address_line2) ? $enquiry->client_address_line2:''}}</textarea>

                                </div>
                            
                                <div class="form-group">
                                    <label for="state">State</label>
                                    <select  class="form-control" name="client_state_id" id="tradestate" data-url="{{route('getCity')}}" readonly>

                                        <option value="">Select State</option> 
                                            @foreach($states as $state)
                                                @if($state->exists && $state->id == $enquiry->client_state_id)
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
                                    <select  class="form-control" name="client_city_id" id="tradecity" readonly>
                                        @foreach($cities as $city)
                                            @if($city->exists && $city->id == $enquiry->client_city_id)
                                                <option value="{{ $city->id }}" selected="selected">{{ $city->name }}</option>

                                            @else
                                                <option value="{{$city->id}}">{{$city->name}}</option> 
                                            @endif
                                        @endforeach     
                                    </select>
                                    <div class="help-block with-errors"></div>
                                </div>

                                      

                                <div class="form-group">
                                    <label for="pincode">Pincode</label>
                                    <input id="pincode" type="text" class="form-control" name="pincode" value="{{isset($enquiry->pincode) ? $enquiry->pincode:''}}" placeholder="Enter Pincode" readonlyreadonly>
                                    
                                </div>
                          
                                <div class="form-group">
                                    <label for="country">Country</label>
                                    <select  class="form-control" name="client_country_id" id="country" readonly>
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
                                <label for="corporate_id">Corporate Code</label>
                                <input type="hidden" name="corporate_id" class="corpid" value="">
                                 <input id="corporate_id" type="text" class="form-control corpcode" name="corporate_code" value="{{isset($enquiry->corporate_code) ? $enquiry->corporate_code:''}}" placeholder="Enter Corporate Code" readonly>
                                
                            </div>

                            <div class="form-group">
                                <label class="d-block">Contact Person (Corporate)</label>
                                <input id="corp_contact_person" type="text" class="form-control corpname" name="corp_contact_person" value="{{isset($enquiry->corp_contact_person) ? $enquiry->corp_contact_person:''}}" placeholder="Enter Corporate Contact Person" readonly>
                            </div>

                            <div class="form-group">
                                <label class="d-block">Email</label>
                                <input id="Email" type="text" class="form-control coemail" name="corporate_email" value="{{isset($enquiry->corporate_email) ? $enquiry->corporate_email:''}}" placeholder="Enter Email" readonly>
                            </div>

                            <div class="form-group">
                                <label class="d-block">Mobile</label>
                                <input id="Mobile" type="text" class="form-control comobile" name="corporate_mobile" value="{{isset($enquiry->corporate_mobile) ? $enquiry->corporate_mobile:''}}" placeholder="Enter Mobile" readonly>
                            </div>

                            <div class="form-group">
                                <label class="d-block">Landline</label>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <input type="hidden" name="countl_code" id="countl_code" value="">
                                        <input id="corp_city_code" type="text" class="form-control" 
                                        name="corp_city_code" style="width:200px;" value="{{isset($enquiry->corp_city_code) ? $enquiry->corp_city_code:''}}" placeholder="Enter STD Code" maxlength="5" readonly>
                                    </div>
                                    <div class="col-sm-6">
                                        <input id="corporate_landline" type="text" class="form-control colandline" name="corporate_landline" value="{{isset($enquiry->corporate_landline) ? $enquiry->corporate_landline:''}}" placeholder="Enter Landline" readonly>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="d-block">Company Name</label>
                                <input id="company_name" type="text" class="form-control corpcompany" name="corporate_company_name" value="{{isset($enquiry->corporate_company_name) ? $enquiry->corporate_company_name:''}}" placeholder="Enter Company Name" readonly>
                            </div>

                            <div class="form-group">
                                <label>Address Line 1</label>
                                <textarea class="form-control coaddress" name="corporate_address_line1" rows="2" readonly>{{isset($enquiry->corpotate_address_line1) ? $enquiry->corpotate_address_line1:''}}</textarea>

                            </div>

                            <div class="form-group">
                                <label>Address Line 2</label>
                                <textarea class="form-control coaddress_2" name="corporate_address_line2" rows="2" readonly>{{isset($enquiry->corpotate_address_line2) ? $enquiry->corpotate_address_line2:''}}</textarea>

                            </div>

                            <div class="form-group">
                                <label for="state_id">State</label>
                                <select  class="form-control costate" name="corporate_state_id" id="corporate_id" data-url="{{route('getCity')}}" readonly>

                                    <option value="">Select State</option> 
                                        @foreach($states as $state)
                                            @if($state->exists && $state->id == $enquiry->corporate_state_id)
                                                <option value="{{ $state->id }}" selected="selected">{{ $state->name }}</option>

                                            @else
                                                <option value="{{$state->id}}">{{$state->name}}</option> 
                                            @endif
                                        @endforeach
                                    
                                    </select>
                                    
                            </div>

                            <div class="form-group">
                                <label for="city">City</label>
                                <select  class="form-control cocity" name="corporate_city_id" id="secondarycity" readonly>
                                   <option value="">Select City</option> 
                                        @foreach($cities as $city)
                                            @if($city->exists && $city->id == $enquiry->corporate_city_id)
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
                                <input id="secondpincode" type="text" class="form-control copincode" name="corporate_pincode" value="{{isset($enquiry->corporate_pincode) ? $enquiry->corporate_pincode:''}}" placeholder="Enter Pincode" readonly>
                                
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

        <div class="protable">
            <table class="table" id="producttable" width="100%">
                <thead>
                    <tr>
                        <th style="width:1%"></th>
                        <th title="Field #1" style="width:10%">Product Description</th>
                        <th title="Field #2" style="width:15%">Customer UOM</th>
                        <th title="Field #3" style="width:10%">Quantity</th>
                        <th title="Field #4" style="width:10%">Product</th>
                        <th title="Field #13" style="width:10%">Image</th>
                        <th title="Field #6" style="width:10%">Product Group</th>
                        <th title="Field #7" style="width:10%">Product Category</th>
                        <th title="Field #8" style="width:10%">Product Sub Category</th>
                        <!-- <th width="8%">Remove</th> -->
                        
                        <th title="Field #9" style="width:10%">Product Specification</th>

                        <th title="Field #10" style="width:10%">Product Name</th>
                        <th title="Field #11" style="width:10%">UOM</th>  
                        
                    </tr>
                </thead>
                <tbody>
                    @foreach($enquiry->enquirydetail as $key=>$detail)
                    
                    <tr id="{{$key+1}}" class="inventoryadjust" > 
                        <td ></td>
                        <td>
                            <textarea class="form-control" id="search_selected" name="customer_product_description[]" rows="2" style="width: 125px;height: 82px;">{{isset($detail['customer_product_description']) ? $detail['customer_product_description']:''}}</textarea>
                            {{--<input type="text" id="search_selected" name="customer_product_description[]" class="form-control searchproduct_1" placeholder="Product" value="{{isset($detail['customer_product_description']) ? $detail['customer_product_description']:''}}" autocomplete="off">--}}
                        </td>
                        <td>
                            <select  class="form-control" name="customer_UOM[]" id="customer_uom" style="width:100px;">

                                    <option value="">Select UOM</option> 
                                        @foreach($measurements as $measurement)
                                             @if($measurement->id==$detail->customer_UOM)
                                                <option value="{{$measurement->id}}" selected="selected">{{$measurement->name}}</option> 
                                            @else
                                                    
                                                <option value="{{$measurement->id}}">{{$measurement->name}}</option> 
                                            @endif  
                                        @endforeach
                                    
                                </select>
                           {{--<input type="text" name="customer_UOM[]" class="form-control" placeholder="UOM"  value="{{isset($detail['customer_UOM']) ? $detail['customer_UOM']:''}}">--}}
                        </td>
                        <td>
                           <input type="number" name="quantity[]" class="form-control" placeholder="Quantity" aria-describedby="basic-addon1" value="{{isset($detail['quantity']) ? $detail['quantity']:''}}" min="0" style="width: 100px;"> 
                        </td>
                        <td>
                            <select class="form-control select2" name="product[]" id="productdetail" data-url="{{url('searchproduct')}}" data-publicurl="{{url('/')}}">
                                <option value="">Select Product</option> 
                                @foreach($products as $product)
                                @if($detail->product_id == $product->id)

                                    <option value="{{$product->name .'-'. $product->brand .'-'. $product->description}}" data-id="{{$product->id}}" selected="true">{{$product->name.'-'.$product->brand.'-'.$product->description}}</option>
                                    
                                @else
                                     <option value="{{$product->name .'-'. $product->brand .'-'. $product->description}}" data-id="{{$product->id}}">{{$product->name.'-'.$product->brand.'-'.$product->description}}</option>
                                @endif
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <input type="hidden" id="product_id" name="product_id[]"  class="form-control product_id" placeholder="product Id"  value="{{isset($detail['product_id']) ? $detail['product_id']:''}}">
                            <input type="hidden" name="image[]" class="imgval" value="{{$detail['image']}}">
                            @if($detail['image'] !='')
                            <img src=" {{ url('images/upload/item/'.$detail['image'])}}" alt="" id="output_image" class="img" style="width: 100px; height: 70px;">
                            @else
                            <img src="{{url('img/Image.png')}}" alt="" id="output_image"  class="img" style="width: 100px; height: 70px;">
                            @endif
                            
                           
                        </td>
                        
                        <td>
                            <input type="hidden" id="progroup" name="product_group_id[]"  class="form-control parentcat" placeholder="Product Group"  autocomplete="off" value="{{isset($detail['product_group_id']) ? $detail['product_group_id']:''}}">

                            {{-- <input type="text" id="groupname" name="product_group"  class="form-control parentname" placeholder="Product Group" value="{{$progroup[0]['name']}}" autocomplete="off"> --}}
                            <textarea class="form-control parentname" id="groupname" name="product_group[]" rows="2" data-url="{{url('/')}}" style="width: 100px;height: 82px;">
                                @foreach($progroup as $key=>$value)
                                    @if($detail['product_group_id']==$value->id)
                                        {{$value->name}}
                                    @endif
                                @endforeach
                            </textarea>
                        </td>
                        <td>
                            
                            <textarea class="form-control scat" id="scat" name="product_category_id[]" rows="2" style="display:none;">

                                @foreach($detail->products as $product)
                                    @foreach($product->productcategory as $key=>$post_tag)
                                        @if($key==0)
                                            {{$post_tag->parentcategory->id}}
                                        @else
                                            {{(','.$post_tag->parentcategory->id)}}
                                        @endif
                                    @endforeach
                                @endforeach
                            
                            </textarea>
                            <textarea class="form-control subcat" id="search_selected" name="product_category_name[]" rows="2" data-url="{{url('/')}}" style="width: 125px;height: 82px;">
                                @foreach($detail->products as $product)
                                    @foreach($product->productcategory as $key=>$post_tag)
                                        @if($key==0)
                                            {{$post_tag->parentcategory->name}}
                                        @else
                                            {{(','.$post_tag->parentcategory->name)}}
                                        @endif
                                    @endforeach
                                @endforeach
                                {{--@foreach($parentcategory as $key=>$value)
                                @if($key==0)
                                    {{$value->name}}
                                @else
                                    {{','.$value->name}}
                                @endif
                                @endforeach--}}
                            </textarea>
                                       
                        </td>
                        <td>
                            <textarea class="form-control proscat" name="product_subcategory_id[]"  id="proscat" rows="2" style="display:none;">
                                @foreach($detail->products as $product)
                                    @foreach($product->productcategory as $Key=>$post_tag)

                                        @if($key==0)
                                            {{$post_tag->subcategory->id}}
                                        @else
                                            {{','.$post_tag->subcategory->id}}
                                        @endif
                                    @endforeach
                                @endforeach
                            </textarea>

                                {{--<select class="form-control select2 prosubcat" id="prosubcat" name="product_subcategory_id[]" multiple="multiple" style="display:none;">

                                    @foreach($childcategory as $child){
                            
                                    <option value="{{$child->id}}" selected='true'>{{$child->name}}</option>
                                    @endforeach
                                </select>--}}

                                <textarea class="form-control prosubcat" id="search_selected" name="product_subcategory_name[]"  id="prosubcat" rows="2" data-url="{{url('/')}}" style="width: 125px;height: 82px;">
                                    @foreach($detail->products as $product)
                                        @foreach($product->productcategory as $Key=>$post_tag)

                                            @if($key==0)
                                                {{$post_tag->subcategory->name}}
                                            @else
                                            @if($loop->first !='')
                                                {{','.$post_tag->subcategory->name}}
                                            @else
                                                {{$post_tag->subcategory->name}}
                                            @endif
                                            
                                            @endif
                                        @endforeach
                                    @endforeach
                                    {{--@foreach($childcategory as $Key=>$child)
                                    @if($key==0)
                                    {{$child->name}}
                                    @else
                                    {{','.$child->name}}
                                    @endif
                                    @endforeach--}}
                                </textarea>
                        </td>
                        <td>

                            <textarea class="form-control spec" name="product_specification[]" rows="2" id="spec" style="width: 100px;height: 82px;">{{isset($detail['product_specification']) ? $detail['product_specification']:''}}</textarea>

                            
                        </td>
                        <td>
                            <input id="title" type="text" class="form-control proname" name="product_name[]" value="{{isset($detail['product_name']) ? $detail['product_name']:''}}" placeholder="Enter  Product Name"  style="width: 100px;">
                        </td>
                        <td>
                           
                                <select  class="form-control" name="UOM[]" id="measurement" style="width:100px;">

                                    <option value="">Select UOM</option> 
                                        @foreach($measurements as $measurement)
                                            @if($measurement->id==$detail->UOM)
                                                <option value="{{$measurement->id}}" selected="selected">{{$measurement->name}}</option> 
                                            @else
                                                    
                                                <option value="{{$measurement->id}}">{{$measurement->name}}</option> 
                                            @endif  
                                        @endforeach
                                    
                                </select>
                        </td>
                       

                        
                        <!-- <td > <label></label><a href="javascript:;" data-count_val="" class="deleterow"><i class="ik ik-trash-2 f-16 text-red"></i></a></td> -->

                    </tr>
                    @endforeach
               
                </tbody>
            </table>
            <div >
                <input type="button" id="addrow" value="Add Row" class="btn btn-info addrow" data-url="{{url('/')}}" data-products="{{isset($products) ? $products:''}}" data-measurement="{{isset($measurements) ? $measurements:''}}">
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
                    return process(data);
                });
            }
        });
    
    </script>

    <script type="text/javascript">

    var url = "{{ url('corporatesearch') }}";
    $('#corporate_name').typeahead({
            source: function (query, process) {
                return $.get(url, {
                    query: query
                }, function (data) {
                    return process(data);
                });
            }
        });
    
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

    var measurements=$(this).data('measurement');
    var url=$(this).data('url');

    row +=  '<tr id="'+ counter +'" class="inventoryadjust">';
    row +=  '<td>';
    row +=  '</td>';
    row +=  '<td>';
    row +=  '<textarea class="form-control" id="search_selected" name="customer_product_description[]" rows="2" style="width: 125px;height: 82px;"></textarea>';
    row +=  '</td>';

    row+=   '<td>';
    row+=   '<select  class="form-control customeruom" name="customer_UOM[]" id="customeruom" style="width:100px;">';
    row+='<option value="">Select UOM</option>';
        $.each(measurements, function(i, measurement) {

    row+='<option value="' + measurement.id +'">'+measurement.name+'</option>';
            
            });
                                    
    row +=  '</select>';
    row +=  '</td>';

    row +=  '<td>';
    row +=  '<input type="number" name="quantity[]" class="form-control" placeholder="Quantity" aria-describedby="basic-addon1" value="" min="0" style="width: 100px;"> ';
    row +=  '</td>';
    row+=   '<td>';
   row+='<select class="form-control select2" name="product[]" id="productdetail_'+counter+'">';

            $.each(products, function(i, product) {

    row+='<option value="' + product.name +'-'+ product.brand +'-'+ product.description+'" data-id="'+product.id+'">'+product.name+'-'+product.brand+'-'+product.description+'</option>';
            
            });

    row+='</select>';
    row +=  '</td>';

    row+=   '<td>';
    row+= '<input type="hidden" id="product_id" name="product_id[]"  class="form-control product_id" placeholder="product Id"  autocomplete="off">';

    row+='<input type="hidden" name="image[]" class="imgval">';

    row+= '<img src="'+url+'/img/Image.png'+'" alt="" id="output_image" class="img"  style="width: 100px; height: 70px;">';
    row +=  '</td>';

    row+=   '<td>';
    row+= '<input type="hidden" id="progroup" name="product_group_id[]"  class="form-control parentcat" placeholder="Product Group"  autocomplete="off">';

    row+= '<input type="text" id="groupname" name="product_group_name[]"  class="form-control parentname" placeholder="Product Group"  autocomplete="off">';
    row +=  '</td>';

    row+=   '<td>';
    row+=   '<textarea class="form-control scat" id="scat" name="product_category_id[]" rows="2" data-url="'+url+'" style="display:none;"></textarea>';

    row+= '<textarea class="form-control subcat" id="search_selected" name="product_category_name[]" rows="2" data-url="'+url+'" style="width: 100px;height: 82px;"></textarea>';

    row +=  '</td>';

    row+=   '<td>';
    row+=   '<textarea class="form-control proscat" id="search_selected" name="product_subcategory_id[]"  id="proscat" rows="2" data-url="'+url+'" style="display:none;"></textarea>';
    

    row+= '<textarea class="form-control prosubcat" id="search_selected" name="product_subcategory_name[]"  id="prosubcat" rows="2" data-url="'+url+'" style="width: 100px;height: 82px;"></textarea>';

    row +=  '</td>';

    row+=   '<td>';
    row+=   '<textarea class="form-control spec" name="product_specification[]" rows="2" style="width: 100px;height: 82px;"></textarea>';
    row +=  '</td>';

    row+=   '<td>';
    
    row+=   '<input id="title" type="text" class="form-control proname" name="product_name[]" value="" placeholder="Enter Product Name" style="width: 100px;">';
    row +=  '</td>';

    row+=   '<td>';
    row+=   '<select  class="form-control measurement" name="UOM[]" id="measurement" style="width:100px;">';
    row+='<option value="">Select UOM</option>';
        $.each(measurements, function(i, measurement) {

    row+='<option value="' + measurement.id +'">'+measurement.name+'</option>';
            
        });            
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

                        jQuery.each(res.pro.productcategory, function(index, value){
                            //console.log(value.parentgroup);
                        var cat = scope.find('.parentname').val(value.parentgroup.name);
                        var ppcat = scope.find('.parentcat').val(value.parentgroup.id);
                        });

                        var subcat=scope.find('.subcat');
                        subcat.find('option').remove();
                        
                        jQuery.each(res.procategories, function(index, value){
                            var parentcat=res.parentcat;
                            if(jQuery.inArray(value.id,parentcat)){
                                subcat.append($("<option value="+value.id+" selected='true'>"+value.name+"</option>")); 
                            }
                            });

                        jQuery.each(res.parentcategory, function(index, value){
                            //alert(index);
                           
                            if(index==0) {
                                scope.find('.scat').append(value.id); 
                                subcat.append(value.name); 
                            }else{
                                scope.find('.scat').append(','+value.id);
                                subcat.append(','+value.name);
                            }
                        });

                        var prosubcat=scope.find('.prosubcat');
                        prosubcat.find('option').remove();
                        
                        jQuery.each(res.subcategories, function(index, value){
                            var subchildcat=res.subcat;
                            if(jQuery.inArray(value.id,subchildcat)){
                                prosubcat.append($("<option value="+value.id+" selected='true'>"+value.name+"</option>")); 
                            }
                            });

                        jQuery.each(res.childcategory, function(index, value){
                        
                                
                                if (index==0) {
                                    scope.find('.proscat').append(value.id);
                                    prosubcat.append(value.name); 
                                 }else{
                                    scope.find('.proscat').append(','+value.id); 
                                    prosubcat.append(','+value.name);
                                 }
                            
                            });

                        scope.find('.proname').val(res.pro.name);

                        scope.find('.spec').val(res.pro.model_details);

                        var uom = scope.find('.measurement');
                        //console.log($uom);
                        
                        //console.log(res.measurements);
                        //console.log(res.pro.measurement_id);
                        jQuery.each(res.measurements, function(index, value){
                            
                            if(value.id == res.pro.measurement_id){ 
                                uom.append($("<option value="+value.id+" selected='selected'>"+value.name+"</option>"));
                            }
                            else{
                                uom.append($("<option value="+value.id+">"+value.name+"</option>"));
                            }
                        });
                        scope.find('.imgval').val(res.pro.image);
                        var detailUrl=publicurl+'/images/upload/item/'+res.pro.image;
                        //console.log(detailUrl);
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
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/11.0.9/js/utils.js"></script> -->
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



                        
                        
                        
                        
                        
                        
                    }
                });
        });

        $('#corpdetail').change(function() { 
            //alert('gnjghjgh');
            var url=$(this).data('url');
            var id=$('#corpdetail option:selected').data('id');
            //console.log(url);
            //console.log(id);
             $.ajax({
                    url:url,
                    type:'GET',
                    data:{'id':id},
                    success:function(res){
                        console.log(res.corp.id);   
                        
                        $('.corpid').val(res.corp.id);
                        $('.corpcode').val(res.corp.corporate_code);
                        $('.corpname').val(res.corp.first_name);
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

                       
                        $('.copincode').val(res.pincode);
                       
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
    </script>

     
    @endpush
@endsection
