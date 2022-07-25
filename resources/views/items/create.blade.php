@extends('inventory.layout') 
@section('title', 'Add Product')
@section('content')
    <!-- push external head elements to head -->
    @push('head')
        <link rel="stylesheet" href="{{ asset('plugins/select2/dist/css/select2.min.css') }}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.css">
        <style type="text/css">
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
                            <h5>{{ __('Add Product')}}</h5>
                            <span>{{ __('Create new Product')}}</span>
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
                                <a href="#">{{ __('Add Product')}}</a>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <form class="forms-sample" method="POST" action="{{ route('items.store') }}" enctype= multipart/form-data>
        @csrf
        <!-- start message area-->
            @include('include.message')
        <!-- end message area-->
            <div class="row">
                
                <div class="col-md-12">
                    <div class="card ">
                        <div class="card-header">
                            <h3>{{ __('Add Product')}}</h3>
                        </div>
                        <div class="card-body">
                            
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                           <label class="d-block">Product Group<span class="text-red">*</span></label>
                                           <select  class="form-control parentcat" name="product_group_id" data-url="{{url('item/getchildcat')}}" id="progroup" required="">

                                                    <option value="">Select Product Group</option> 
                                                    @foreach($categories as $category)
                                                            
                                                        <option value="{{$category->id}}">{{$category->name}}</option> 
                                                            
                                                    @endforeach
                                                    
                                                </select>
                                            
                                        </div>
                                        <div class="form-group subcategory" style="display: none;">
                                            
                                                <label class="d-block">Product Category<span class="text-red">*</span></label>
                                                <select class="form-control select2 subcat" id="procat" name="product_category_id[]" multiple="multiple" data-url="{{url('/')}}"required="">
                                                </select>
                                        </div>
                                            
                                
                                        <div class="form-group childcategory" style="display: none;">
                                            <label class="d-block">Product Sub Category<span class="text-red">*</span></label>
                                                <select class="form-control select2" id="prosubcat" name="sub_category_id[]" multiple="multiple" required="">
                                                </select>
                                        </div>
                                        <!--<div class="form-group childsubcategory" >
                                        </div> -->
                                        <div class="itemform">
                                            <div class="form-group">
                                                <label for="title"> Product Name<span class="text-red">*</span></label>
                                                <input id="title" type="text" class="form-control" name="name" value="" placeholder="Enter  Product Name" required="">
                                                


                                            </div>
                                            
                                            <div class="form-group">
                                                <label for="title">Brand<span class="text-red">*</span></label>
                                                <input id="brand" type="text" class="form-control" name="brand" value="" placeholder="Enter Brand" required="">
                                                <div class="help-block with-errors"></div>
                                            </div>

                                            <div class="form-group">
                                                <label for="title">Model Details</label>
                                                <input id="item" type="text" class="form-control" name="model_details" value="" placeholder="Enter Model Details">
                                                <div class="help-block with-errors"></div>
                                            </div>

                                            <div class="form-group">
                                                <label for="title">Size</label>
                                                <div class="row">
                                                <div class="col-sm-6">
                                                    <input id="Size" type="text" class="form-control" name="size" value="" placeholder="Enter Size Like 10" >
                                                </div>
                                                <div class="col-sm-6">
                                                <input id="sizeunit" type="text" class="form-control" name="size_unit" value="" placeholder="Enter Like MM" >
                                                </div>
                                               
                                            </div>
                                        </div>

                                            <div class="form-group">
                                                <label>Other Specifications</label>
                                                <textarea class="form-control" name="description" rows="2"></textarea>

                                            </div>

                                            <div class="form-group">
                                                <label for="country">UOM</label>
                                                <select  class="form-control" name="measurement_id" id="measurement" >

                                                    <option value="">Select Unit</option> 
                                                        @foreach($measurements as $measurement)
                                                            
                                                                <option value="{{$measurement->id}}">{{$measurement->name}}</option> 
                                                            
                                                        @endforeach
                                                    
                                                </select>
                                                
                                            </div>

                                           

                                            <div class="form-group">
                                                <label for="price">Image</label>
                                                <input type="file" id="dropify" class="dropify" data-default-file=" {{url('img/Image')}}" name="file">
                                            </div>

                                            

                                            {{--<div class="form-group">
                                                <label>Item Images</label>
                                                <div class="input-images" data-input-name="itemimages" data-label="Drag & Drop  images here or click to browse"></div>
                                            </div>--}}
                                        </div>
                                        
                                        </div>

                                        <div class="col-sm-6 formitm" >

                                            <div class="form-group">
                                                <label for="title">About The Product (Reference Link)</label>
                                                <input id="p_image_link" type="text" class="form-control" name="reference_link" value="" placeholder="Enter Reference Link" >
                                                <div class="help-block with-errors"></div>
                                            </div>

                                            <div class="form-group">
                                                <label for="title">Product Usage/Application Video Link</label>
                                                <input id="video" type="text" class="form-control" name="video_link" value="" placeholder="Enter Video Link" >
                                                <div class="help-block with-errors"></div>
                                            </div>

                                            <div class="form-group">
                                                <label for="title">Product Reference Image Link</label>
                                                <input id="image_link" type="text" class="form-control" name="image_link" value="" placeholder="Enter Image Link" >
                                                
                                            </div>

                                            
                                            <div class="form-group">
                                                <label for="title">Warranty Period</label>
                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <input id="Warranty" type="text" class="form-control number" name="warranty" value="" placeholder="In Period" >
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <select name="warranty_year" class="form-control">
                                                            <option value="">Select Year</option>
                                                            <option value="1">1</option>
                                                            <option value="2">2</option>
                                                            <option value="3">3</option>
                                                            <option value="4">4</option>
                                                            <option value="5">5</option>
                                                            <option value="6">6</option>
                                                            <option value="7">7</option>
                                                            <option value="8">8</option>
                                                            
                                                            <option value="9">9</option>
                                                            <option value="10">10</option>
                                                            <option value="11">11</option>
                                                            <option value="12">12</option>
                                                      
                                                        </select>
                                                    
                                                    
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <select class="form-control" name="warranty_month" id="warranty_month">
                                                          <option value="">Select Month</option>
                                                            <option value="January">January</option>
                                                            <option value="February">February</option>
                                                            <option value="March">March</option>
                                                            <option value="April">April</option>
                                                            <option value="May">May</option>
                                                            <option value="June">June</option>
                                                            <option value="July">July</option>
                                                            <option value="August">August</option>
                                                            <option value="September">September</option>
                                                            <option value="October">October</option>
                                                            <option value="November">November</option>
                                                            <option value="December">December</option>
                                                      
                                                        </select>
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <select name="warranty_week" class="form-control">
                                                            <option value="">Select Week</option>
                                                            <option value="1 week">1 week</option>
                                                            <option value="2 week">2 week</option>
                                                            <option value="3 week">3 week</option>
                                                      
                                                        </select>
                                                    
                                                    
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <select class="form-control" name="warranty_days" id="warranty_days">
                                                          <option value="">Select Days</option>
                                                          @foreach($days as $day)
                                                          <option value="{{$day->id}}">{{$day->name}}</option>
                                                          @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        
                                        <div class="form-group">
                                                <label for="title">Lifecycle </label>     
                                                <div class="row"> 
                                                    <div class="col-sm-4">
                                                        <input id="lifecycle" type="text" class="form-control lifecycle_number" name="lifecycle" value="" placeholder="Lifecycle" >
                                                    </div>            
                                                <div class="col-sm-4">
                                                    <select name="lifecycle_year" class="form-control">
                                                            <option value="0">Select Year</option>
                                                            <option value="1">1</option>
                                                            <option value="2">2</option>
                                                            <option value="3">3</option>
                                                            <option value="4">4</option>
                                                            <option value="5">5</option>
                                                            <option value="6">6</option>
                                                            <option value="7">7</option>
                                                            <option value="8">8</option>
                                                            
                                                            <option value="9">9</option>
                                                            <option value="10">10</option>
                                                            <option value="11">11</option>
                                                            <option value="12">12</option>
                                                      
                                                    </select>
                                                    
                                                </div>
                                                <div class="col-sm-4">
                                                
                                                    <select name="lifecycle_month" class="form-control">
                                                            <option value="0">Select Month</option>
                                                            <option value="January">January</option>
                                                            <option value="February">February</option>
                                                            <option value="March">March</option>
                                                            <option value="April">April</option>
                                                            <option value="May">May</option>
                                                            <option value="June">June</option>
                                                            <option value="July">July</option>
                                                            <option value="August">August</option>
                                                            <option value="September">September</option>
                                                            <option value="October">October</option>
                                                            <option value="November">November</option>
                                                            <option value="December">December</option>
                                                      
                                                    </select>
                                                    
                                                
                                                </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                <div class="col-sm-6">
                                                    <select name="lifecycle_week" class="form-control">
                                                            <option value="">Select Week</option>
                                                            <option value="1 week">1 week</option>
                                                            <option value="2 week">2 week</option>
                                                            <option value="3 week">3 week</option>
                                                      
                                                    </select>
                                                    
                                                </div>
                                                <div class="col-sm-6">
                                                
                                                        <select class="form-control" name="lifecycle_days" id="lifecycle">
                                                          <option value="">Select Days</option>
                                                          @foreach($days as $day)
                                                          <option value="{{$day->id}}">{{$day->name}}</option>
                                                          @endforeach
                                                        </select>
                                                    
                                                
                                                </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="title">Country</label>
                                                <select  class="form-control" name="country_id" id="country" >
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
                                            
                                                <div class="form-group">
                                                <label for="available">MATERIAL FORM</label>
                                                <select  class="form-control" name="product_nature" id="pronature" >
                                                <option value="">Select MATERIAL FORM</option> 
                                                
                                                    <option value="Solid">Solid</option> 
                                                    <option value="Breakable">Breakable</option> 
                                                    <option value="Liquid">Liquid</option> 
                                                 
                                            
                                                </select>
                                                
                                                
                                            </div>

                                            <div class="form-group">
                                                 <label for="available">Packing Volume</label>
                                                <div class="row">
                                                <div class="col-sm-6">
                                                    <input id="volume" type="text" class="form-control" name="packing_volume" value="" placeholder="Enter Packing Volume" >
                                                </div>
                                                <div class="col-sm-6">
                                                <input id="volumeunit" type="text" class="form-control" name="volume_unit" value="" placeholder="Enter Like Meter">
                                                
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    
                                </div>
                                
                            
                            
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                                   
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
        </form>
    </div>
    <!-- push external js -->
    @push('script') 
      <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>
      <script src="{{ asset('plugins/select2/dist/js/select2.min.js') }}"></script> 

    <script type="text/javascript">

   var route = "{{ url('brandsearch') }}";
 $('#brand').typeahead({
            source: function (query, process) {
                return $.get(route, {
                    query: query
                }, function (data) {
                    return process(data);
                });
            }
        });

 
    </script>
    
    <script>
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
                       /* row+='<div class="form-group">';
                            row+='<label class="d-block">Product Category<span class="text-red">*</span></label>';
                            row+='<select class="form-control select2" name="product_category_id[]" multiple="multiple">';*/
                                jQuery.each(res, function(i, cat){
                                row+='<option value='+cat['id']+'>'+cat['name']+'</option>';
                                });
                            /*row+='</select>';
                            row+='</div>';*/
                            /*row+='<label class="d-block">Sub sub-Category</label>';
                            row+='<select class="form-control childcat" name="childcategory_id" data-url='+publicurl+'>';
                            row+='<option value=>Select Parent</option>';
                            jQuery.each(res, function(i, childcat){
                                row+='<option value='+childcat['id']+'>'+childcat['name']+'</option>';
                            });
                            row+='</select>';*/
                            $('.childcategory').css('display','block');
                            $('#prosubcat').html(row);
                            
                    }
                });
            }
        });
    </script>
    <script>
        $(document).on('change', '.childcat', function() {
            $('.itemform').css("display", "block");
            $('.formitm').css("display", "block");
        });
    </script>
    <script>
    $('.number').keypress(function(event) {
    var $this = $(this);
    if ((event.which != 46 || $this.val().indexOf('.') != -1) &&
       ((event.which < 48 || event.which > 57) &&
       (event.which != 0 && event.which != 8))) {
           event.preventDefault();
    }

    var text = $(this).val();
    if ((event.which == 46) && (text.indexOf('.') == -1)) {
        setTimeout(function() {
            if ($this.val().substring($this.val().indexOf('.')).length > 3) {
                $this.val($this.val().substring(0, $this.val().indexOf('.') + 3));
            }
        }, 1);
    }

    if ((text.indexOf('.') != -1) &&
        (text.substring(text.indexOf('.')).length > 2) &&
        (event.which != 0 && event.which != 8) &&
        ($(this)[0].selectionStart >= text.length - 2)) {
            event.preventDefault();
    }      
});
</script>
<script>
    $('.lifecycle_number').keypress(function(event) {
    var $this = $(this);
    if ((event.which != 46 || $this.val().indexOf('.') != -1) &&
       ((event.which < 48 || event.which > 57) &&
       (event.which != 0 && event.which != 8))) {
           event.preventDefault();
    }

    var text = $(this).val();
    if ((event.which == 46) && (text.indexOf('.') == -1)) {
        setTimeout(function() {
            if ($this.val().substring($this.val().indexOf('.')).length > 3) {
                $this.val($this.val().substring(0, $this.val().indexOf('.') + 3));
            }
        }, 1);
    }

    if ((text.indexOf('.') != -1) &&
        (text.substring(text.indexOf('.')).length > 2) &&
        (event.which != 0 && event.which != 8) &&
        ($(this)[0].selectionStart >= text.length - 2)) {
            event.preventDefault();
    }      
});
</script>
    <script src="https://unpkg.com/@yaireo/tagify"></script>
<script src="https://unpkg.com/@yaireo/tagify/dist/tagify.polyfills.min.js"></script>
<link href="https://unpkg.com/@yaireo/tagify/dist/tagify.css" rel="stylesheet" type="text/css" />
<script src="{{url('js/tagify.bundle.js')}}"></script> 
    <script src="{{url('js/item_custom.js')}}"></script>
    
    <script type="text/javascript">
        $(function () {
        $('#dropify').dropify();
        });
    </script>
    <!-- image -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
     
    @endpush
@endsection

                             