@extends('inventory.layout') 
@section('title', 'RFQ To Supply Partner')
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
            .protable{
                overflow-x: auto;
            }
            /*.prosubcategory .select2{
                display: none;
            }*/
        </style>
    @endpush

    <form class="forms-sample" method="POST" action="{{ route('storerfq') }}" enctype= multipart/form-data id="clientform">
    @csrf
    @include('include.message')
    <div class="container-fluid">
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="ik ik-user-plus bg-blue"></i>
                        <div class="d-inline">
                            <h5>{{ __('RFQ To Supply Partner')}}</h5>
                            <span>{{ __('RFQ To Supply Partner')}}</span>
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
                                <a href="#">{{ __('RFQ To Supply Partner')}}</a>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>


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
                                       <label class="d-block">Enquiry Number</label>
                                        
                                        <input id="enquiry_id" type="hidden" class="form-control" name="enquiry_id" value="{{isset($enquiry->id) ? $enquiry->id:''}}"> 

                                        <input id="client_name" type="text" class="form-control" name="client_name" value="{{isset($enquiry->enquiry_no) ? $enquiry->enquiry_no:''}}" placeholder="Enter Client Name"> 
                                    </div>
                                </div>
                                <div class="col-sm-6">  
                                    <div class="form-group">

                                        <label>Client Code</label>
                                    
                                        <input id="corporate_name" type="text" class="form-control" name="client_code" value="{{isset($enquiry->client_code) ? $enquiry->client_code:''}}" placeholder="Enter Corporate Name">
                                            

                                    </div>
                                </div>
                                <div class="col-sm-6">    
                                        <div class="form-group">
                                            <label for="first_name">Client Location</label>
                                            <input id="first_name" type="text" class="form-control" name="client_quotation_number" value="{{isset($enquiry->citydetail->name) ? $enquiry->citydetail->name:''}}" placeholder="Enter Client Quotation Number" >

                                        </div>
                                    </div>
                                    {{--<div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="middle_name">UnqRngCode</label>
                                            <input id="middle_name" type="text" class="form-control" name="UnqRngCode" value="{{isset($enquiry->UnqRngCode) ? $enquiry->UnqRngCode:''}}" placeholder="Enter UnqRngCode">

                                        </div>
                                    </div>--}}
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="last_name">User ID</label>
                                            <input id="user_id" type="text" class="form-control userid" name="user_id" value="{{isset($enquiry->user_code) ? $enquiry->user_code:''}}" placeholder="Enter User ID" readonly>
                                            


                                        </div>
                                    </div>
                                    {{--<div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="email">Timestamp</label>
                                            
                                            <input id="time" type="text" class="form-control " name="timestamp" value="" placeholder="Enter Timestamp">
                                                        
                                        </div>
                                    </div>--}}

                                    {{--<div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="user_id">RFQ TO VEN (Reqest Num)</label>
                                            <input id="time" type="text" class="form-control " name="timestamp" value="" placeholder="Enter Timestamp">
                                           
                                        </div>
                                    </div>--}}

                                
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
                            <th title="Field #1" style="width:15%">Supply Partner Code</th>

                            <th title="Field #2" style="width:15%">Product Description</th>

                            <th title="Field #3" style="width:5%">Customer UOM</th>

                            <th title="Field #4" style="width:10%">Quantity</th>

                            <th title="Field #5" style="width:10%">Product Name</th>
                            <th title="Field #6" style="width:5%">Product Code</th>
                            <th title="Field #7" style="width:10%">Product Group</th>
                            <th title="Field #8" style="width:10%">Product Category</th>
                            <th title="Field #9" style="width:10%">Product Sub Category</th>

                            <th title="Field #10" style="width:10%">Product Specification</th>
                            
                            <th title="Field #11" style="width:10%">Image</th>
        
                            <th title="Field #12" style="width:15%">UOM</th> 

                        </tr>
                    </thead>
                    <tbody>
                    @foreach($enquiry->enquirydetail as $key=>$detail)
                        <tr id="{{$key+1}}" class="inventoryadjust" >

                            <td></td>
                            <td>
                                <div>
                                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModalCenter">{{ __('Select Supply Partner')}}</button>
                                </div>

                                <div style="display:none;">
                                    <input type="hidden" class="form-control" name="enquiry_item_id[]"  value="{{isset($detail['id']) ? $detail['id']:''}}">

                                     <div class="venappend"></div>
                                 <textarea class="form-control vendorid_{{$key+1}}" name="vendorid[]" rows="2"></textarea>
                                

                                </div>

                                <textarea class="form-control enqvendor vendorcode_{{$key+1}}" name="vendor_code[]" rows="2" style="margin-top: 10px;"></textarea>
                            </td>
                            <td>
                                <textarea class="form-control" id="search_selected" name="customer_product_description[]" rows="2"     style="width: 125px;height: 82px;">{{isset($detail['customer_product_description']) ? $detail['customer_product_description']:''}}</textarea>
                                
                            </td>
                            <td>
                                <select  class="form-control customeruom" name="customer_UOM[]" id="customeruom" style="width:100px;">

                                        <option value="">Select UOM</option> 
                                            @foreach($measurements as $measurement)
                                                
                                                @if($measurement->id==$detail->customer_UOM)
                                                    <option value="{{$measurement->id}}" selected="selected">{{$measurement->name}}</option> 
                                                
                                                @endif  
                                                
                                            @endforeach
                                        
                                </select>
                                    
                            </td>

                            <td>
                               <input type="number" name="quantity[]" class="form-control" placeholder="Quantity" aria-describedby="basic-addon1" value="{{isset($detail['quantity']) ? $detail['quantity']:''}}" readonly=""> 
                            </td>
                            
                            <td>
                                <input type="hidden" id="product_id" name="product_id[]"  value="{{isset($detail['product_id']) ? $detail['product_id']:''}}" class="form-control product_id" placeholder="Product Id">

                                <input id="title" type="text" class="form-control proname" name="product_name[]" value="{{isset($detail['product_name']) ? $detail['product_name']:''}}" placeholder="Enter Product Name" readonly="">
                                
                            </td>

                            <td>

                                <input id="title" type="text" class="form-control procode" name="product_code[]" value="{{isset($detail['product_code']) ? $detail['product_code']:''}}" placeholder="Enter Product Code" readonly="">

                               
                            </td>
                            
                            <td>
                                <input type="hidden" id="progroup" name="product_group_id[]" value="{{isset($detail['product_group_id']) ? $detail['product_group_id']:''}}" class="form-control parentcat" placeholder="Product Group"  autocomplete="off">

                                {{--<select class="form-control progroup" id="parentcat" name="productgroupid[]" data-url="{{url('/')}}" style="width: 100px;">
                                    @foreach($progroup as $key=>$value)
                                        @if($detail['product_group_id']==$value->id)
                                            <option value="{{$value->id}}" selected='true'>{{$value->name}}</option>
                                        @endif
                                    @endforeach
                                </select>--}}

                                <textarea class="form-control parentname" id="groupname" name="product_group[]" rows="2" data-url="{{url('/')}}" style="width: 100px;height: 82px;">
                                    @foreach($progroup as $key=>$value)
                                        @if($detail['product_group_id']==$value->id)
                                            {{$value->name}}
                                        @endif
                                    @endforeach
                                </textarea>

                                <!-- <input type="text" id="groupname" name="product_group" class="form-control parentname"  value="{{$progroup[0]['name']}}" placeholder="Product Group"  autocomplete="off" readonly=""> -->

                            </td>
                            <td>

                                {{--<select class="form-control select2" name="productcategoryid[]" id="procat" data-publicurl="{{url('/')}}" multiple="multiple">

                                
                                    @foreach($detail->products as $product)
                                        @foreach($product->productcategory as $Key=>$post_tag)

                                        <option value="{{$post_tag->parentcategory->id}}" selected='true'>{{$post_tag->parentcategory->name}}</option>
                                            
                                        @endforeach
                                    @endforeach
                                </select>--}}

                                {{--<select class="form-control select2 subcategory" id="procat" name="product_category_id[]" multiple="multiple" data-url="{{url('/')}}" style="display:none;">

                                    @foreach($parentcategory as $value)
                                               
                                    <option value="{{$value->id}}" selected='true'>{{$value->name}}</option>
                                    
                                    @endforeach
                                </select>--}}

                                <textarea class="form-control tradesubcat" id="search_selected" name="product_category_name[]" rows="2" data-url="{{url('/')}}" style="width: 100px;height: 82px;">
                                    @foreach($detail->products as $product)
                                        @foreach($product->productcategory as $Key=>$post_tag)
                                            @if($key==0)
                                            {{$post_tag->parentcategory->name}}
                                            @else
                                            {{','.$post_tag->parentcategory->name}}
                                            @endif
                                        @endforeach
                                    @endforeach
                                </textarea>
                                    {{--@foreach($parentcategory as $key=>$value)

                                    @foreach($progroup as $val)
                                    @if($val->id==$value->parent_id)
                                    @if($key==0)
                                        {{$value->name}}
                                    @else
                                        {{','.$value->name}}
                                    @endif
                                    @endif
                                    @endforeach
                                    @endforeach--}}
                                  
                            </td>
                            <td>
                                {{--<select class="form-control select2 prosubcategory" id="prosubcategory" name="product_subcategory_id[]" multiple="multiple" data-url="{{url('/')}}" style="display:none;">

                                    @foreach($childcategory as $child)
                            
                                    <option value="{{$child->id}}" selected='true'>{{$child->name}}</option>
                                    @endforeach
                                </select>--}}

                                <textarea class="form-control prosubcat" id="search_selected" name="product_subcategory_name[]"  id="prosubcat" rows="2" data-url="{{url('/')}}" style="width: 100px;height: 82px;">
                                    @foreach($detail->products as $product)
                                        @foreach($product->productcategory as $Key=>$post_tag)
                                            @if($key==0)
                                            {{$post_tag->subcategory->name}}
                                            @else
                                            {{','.$post_tag->subcategory->name}}
                                            @endif
                                        @endforeach
                                    @endforeach
                                    {{--@foreach($childcategory as $Key=>$child)
                                        @if($detail['product_subcategory_id']==$child->id)
                                            @if($key==0)
                                            {{$child->name}}
                                            @else
                                            {{','.$child->name}}
                                            @endif
                                        @endif
                                    @endforeach--}}
                                </textarea>
                            </td>

                            
                            
                            <td>
                                <textarea class="form-control spec" name="product_specification[]" rows="2" id="spec">{{isset($detail['product_specification']) ? $detail['product_specification']:''}}</textarea>
                            </td>
                            
                            <td>
                                
                                <input type="hidden" name="image[]" class="imgval">
                                @if($detail['image'] !='')
                                    <img src=" {{ url('images/upload/item/'.$detail['image'])}}" alt="" id="output_image" class="img" style="width: 100px; height: 70px;">
                                @else
                                    <img src="{{url('img/Image.png')}}" alt="" id="output_image"  class="img" style="width: 100px; height: 70px;">
                                @endif
                               
                            </td>
                            
                            <td>
                               
                                    <select  class="form-control measurement" name="UOM[]" id="measurement" style="width:100px;">

                                        <option value="">Select UOM</option> 
                                            @foreach($measurements as $measurement)
                                                
                                                @if($measurement->id==$detail->UOM)
                                                    <option value="{{$measurement->id}}" selected="selected">{{$measurement->name}}</option> 
                                                
                                                @endif 
                                                
                                            @endforeach
                                        
                                    </select>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                
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


        
    </div>
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterLabel"  aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterLabel">{{ __('Select Supply Partner')}}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="state">State</label>
                            <select  class="form-control" name="state_id" id="tradestate" data-url="{{route('getCity')}}">

                                <option value="">Select State</option> 
                                    @foreach($states as $state)
                                        <option value="{{$state->id}}">{{$state->name}}</option> 
                                     @endforeach
                                
                                </select>
                        </div>
                        <div class="form-group">
                            <label for="city">City</label>
                            <select  class="form-control" name="city_id" id="tradecity">
                                
                            </select>
                            <div class="help-block with-errors"></div>
                        </div>

                        <div class="form-group">
                            <label for="city">Product Group<span class="text-red">*</span></label>
                            <select  class="form-control productgroup" name="product_group_id" data-url="{{url('/')}}" id="" required="" html-autocomplete="off" >
                                <option value="">Select Product Group</option>

                                    @foreach($categories as $category)
                                        <option value="{{$category->id}}">{{ $category->name}}</option>
                                    @endforeach
                                
                            </select>
                            
                        </div>

                        <div class="procategory" style="display: none;" >
                            <div class="form-group">
                                    
                                <label class="d-block">Product Category</label>
                                <select class="form-control  subcat select2" id="procat" name="product_category_id[]" data-url="{{url('/')}}" multiple="multiple" >
                                    <option value="0"></option>
                                </select>
                            </div>
                        </div>
                                    

                        <div class="subcategory" style="display:none;">

                            <div class="form-group">
                                <label class="d-block">Product Sub Category</label>
                                  
                                <select  class="form-control child select2" id="subcat" name="sub_category_id[]"  data-url="{{url('/')}}" multiple="multiple">
                                    <option value="0"></option>
                                </select>
                            </div>
                            
                        </div>

                        <div class="form-group">
                            <label for="city">Supply Partner</label>
                           
                            <select  class="form-control select2 tradevendor" name="vendor_id[]" id="tradevendor" multiple="multiple">
                                {{-- <option value="">Select Supply Partner</option>

                                    @foreach($vendors as $vendor)
                                        <option value="{{$vendor->id}}">{{$vendor->first_name}}</option> 
                                    @endforeach --}}
                                
                            </select>
                            
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Close')}}</button>
                        <button type="button" class="btn btn-primary submit" data-url="{{url('/')}}">{{ __('Submit')}}</button>
                    </div>
                </div>
            </div>
    </div>
    </form>
    <!-- push external js -->
    @push('script') 
    <script src="{{ asset('plugins/select2/dist/js/select2.min.js') }}"></script> 

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
        $(function () {
        $('#dropify').dropify();
        });
/*state and city*/
        $('#tradestate').on('change', function() {
            //alert('xdvgdfgdf');
            var state_id = this.value;
            //console.log(state_id);
            var url=$(this).data('url');
            //console.log(url);
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
            //console.log(state_id);
            var url=$(this).data('url');
            //console.log(url);
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
    <script>

        $('.productgroup').change(function() {
        
            var progroup=$(".productgroup :selected").map((_, e) => e.value).get();
            console.log(progroup);
            var state=$('#tradestate').val();
            console.log(state);
            var city=$('#tradecity').val();
            console.log(city);
            var publicurl= $(this).data('url');
            console.log(publicurl);
            //$('.productgroup').html('');
            //$('.subcat').html('');
            //$('.subcat').removeData();
            if(progroup!=''){
                $.ajax({
                    url:publicurl+'/searchvendor',
                    type:'GET',
                    data:{'progroup':progroup,'state':state,'city':city},
                    success:function(data){
                        console.log(data);
                        var row='';
                        row+='<option value="">Select Supply Partner</option>'; 

                            jQuery.each(data, function(i, vendor){
                                
                               // $('.vendor_code').val(vendor['vendor_code']);
                            row+='<option value='+vendor['id']+' code='+vendor['vendor_code']+'>'+vendor['first_name']+'</option>';
                            });

                            //$('.subcategory').css('display','block');
                            $('.tradevendor').html(row);

                                /*row+='<option value=>Select Product Category</option>';
                                jQuery.each(data, function(i, cat){
                                row+='<option value='+cat['id']+'>'+cat['name']+'</option>';
                                });
                                //console.log(row);
                            $('.procategory').css('display','block');
                            //console.log($('#procat').html());

                            $('.subcat').html(row);*/
                    }
                });
                //row+='<option value="0"></option>';
            }
        });

        $('.procategory').change(function() { 
            //console.log('gfbhngfgfh');
            var sub=$(".procategory :selected").map((_, e) => e.value).get();
            //console.log(parent);
            var publicurl= $('.subcat').data('url');
            //console.log(publicurl);
            //$('.procategory :selected').remove();
            //$('.child').removeData();
            if(sub!=''){
                //$('.child').html('');
                $.ajax({
                    url:publicurl+'/subcategory',
                    type:'GET',
                    data:{'id':sub},
                    success:function(data){
                        //$('.child').html('');
                        //console.log(data);
                        var row='';

                            row+='<option value="">Select Category</option>'; 

                            jQuery.each(data, function(i, subcat){
                            row+='<option value='+subcat['id']+'>'+subcat['name']+'</option>';
                            });

                            $('.subcategory').css('display','block');
                            $('.child').html(row);
                            //row+='<option value="0"></option>';
                    }
                });
              
            }
        });


        $('.subcategory').change(function(){
            //alert('fdghfdhgf');
            
            var scope = $(this); 
            var progroup=$(".productgroup :selected").map((_, e) => e.value).get();
            //console.log(progroup);
            var procat=$(".procategory :selected").map((_, e) => e.value).get();
            //console.log(procat);
            
            var subcat=$(".subcategory :selected").map((_, e) => e.value).get();
            //console.log(subcat);
            var state=$('#tradestate').val();
            //console.log(state);
            var city=$('#tradecity').val();
            //console.log(city);
            var publicurl= $('.child').data('url');
            //console.log(publicurl);

            $.ajax({
                    url:publicurl+'/searchvendor',
                    type:'GET',
                    data:{'progroup':progroup,'procat':procat,'subcat':subcat,'state':state,'city':city},
                    success:function(data){
                        //console.log(data);
                        var row='';

                            row+='<option value="">Select Supply Partner</option>'; 

                            jQuery.each(data, function(i, vendor){
                                
                               // $('.vendor_code').val(vendor['vendor_code']);
                            row+='<option value='+vendor['id']+' code='+vendor['vendor_code']+'>'+vendor['first_name']+'</option>';
                            });

                            //$('.subcategory').css('display','block');
                            $('.tradevendor').html(row);
                            //row+='<option value="0"></option>';
                    }
                    });

        });

        $('.submit').click(function(){
            //alert('fvgdfgdf');
            var count = $("#producttable>tbody tr").length;
            //console.log(count);
            var counter=count+1;
            //console.log(counter);
            var scope = $(this); 
            var vendor= $(".tradevendor :selected").map((_, e) => e.value).get();
             //console.log(vendor);

            var progroup=$(".productgroup option:selected").val();
            //console.log(progroup);
            var procat=$(".procategory :selected").map((_, e) => e.value).get();
            //console.log(procat);
            
            var subcat=$(".subcategory :selected").map((_, e) => e.value).get();
            //console.log(subcat);

            //var progroup='';
            var productgroup=$('.parentcat').map(function() {
                     return $.trim(this.value);
            }).get();
            
            //console.log(productgroup);

            var publicurl= $(this).data('url');

                //$('.vendorid').val('');
                //$('.vendorcode').val('');
            //$('.venappend').append('');
            //$('.productgroup').html('');
            //$('.procategory').html('');
            //$('.subcategory').empty();
            //$('.enqvendor').val('');
            $.ajax({
                    url:publicurl+'/vendorcode',
                    type:'GET',
                    data:{'vendor':vendor},
                    success:function(data){
                        console.log(data);
                        
                        //var vendorcode=$('.vendorcode').val(vendor.vendor_code);
                        var pcat='';
                        //pcat+='<select class="form-control select2 vendorid_1" id="procat" name="vendorid[]" multiple="multiple" style="display:none;">';

                        //pcat+='<option value="0"></option>';
                        jQuery.each(data, function(index, vendor){
                            jQuery.each(productgroup, function(i, category){
                                var counti=i+1;
                               // console.log(vendor);

                            if(category==progroup){
                                //console.log($('.vendorid_'+counti).append(vendor.id));
                                //alert('test');
                                //console.log($('.vendorid_'+counti).val(JSON.stringify(vendor.id)));
                                //console.log($('.vendorid_'+counti).val(vendor.id)); 
                                if (index==0) {

                                    
                                    $('.vendorcode_'+counti).append(vendor.vendor_code);
                                    //console.log(().val());
                                    //pcat+='<option value='+vendor.id+'  selected="true">'+vendor.vendor_code+'</option>'; 
                                    //var a = vendor.id;
                                    $('.vendorid_'+counti).append(vendor.id);
                                    //console.log(('.vendorcode_'+counti).text());
                                }else{
                                    //pcat+='<option value='+vendor.id+'  selected="true">'+vendor.vendor_code+'</option>';
                                    //console.log(('.vendorcode_'+counti).val());
                                    //$('.vendorid_'+counti).append(','+vendor.id);
                                    $('.vendorcode_'+counti).append(','+vendor.vendor_code);
                                    $('.vendorid_'+counti).append(','+vendor.id);
                                    //console.log(('.vendorcode_'+counti).text());
                                }
                            }
                        });
                            
                        });
                        pcat+='</select>';
                        $('.venappend').append(pcat);
                        // $("#exampleModalCenter").reload();
                        $('#exampleModalCenter').modal('toggle');
                        //$('#exampleModalCenter').modal('toggle');
                    }
                });
           
        });
    </script> 
    <!-- image -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>


    @endpush
@endsection
