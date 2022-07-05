@extends('inventory.layout') 
@section('title', 'Edit Product')
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
                            <h5>{{ __('Edit Product')}}</h5>
                            <span>{{ __('Edit Product')}}</span>
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
                                <a href="#">{{ __('Edit Product')}}</a>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <form class="forms-sample" method="POST" action="{{ route('items.update',$items->id) }}" enctype= multipart/form-data>
        @csrf
        @method('PUT')
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
                                       <label class="d-block">Product Group</label>
                                        <select  class="form-control parentcat" name="product_group_id" data-url="{{url('item/getchildcat')}}">

                                        <option value="">Select Category</option> 
                                          @foreach($categories as $vcat)

                                                    @if(in_array($vcat->id,$selected_tags))
                                                        <option value="{{$vcat->id}}" selected="true" > {{$vcat->name}}</option>
                                                    @else
                                                        <option value="{{$vcat->id}}">{{$vcat->name}}</option> 
                                                    @endif  
                                                   
                                                @endforeach
                            
                                        </select>
                                    </div>
                                    <div class="form-group subcategory">
                                        <label class="d-block">Product Category</label>
                                        <select  class="form-control  select2 subcat" id="procat"  name="product_category_id[]" data-url="{{url('/')}}" multiple="multiple">

                                        <option value="">Select Category</option> 
                                         @foreach($procategories as $cat)
                                          
                                            @if(in_array($cat->id,$parentcat))
                                                <option value="{{$cat->id}}" selected="true" > {{$cat->name}}</option>
                                            @endif 
                                          @endforeach
                            
                                        </select>
                                    </div>
                                    <div class="form-group childcategory" >
                                        <label class="d-block">Product Sub Category</label>
                                        <select  class="form-control childcat select2" name="sub_category_id[]" id="prosubcat" data-url="{{url('/')}}" multiple="multiple">

                                        <option value="">Select Category</option> 
                                          @foreach($subcategories as $scat)
                                          
                                            @if(in_array($scat->id,$subcat))
                                                <option value="{{$scat->id}}" selected="true" > {{$scat->name}}</option>
                                            @endif 
                                          @endforeach
                            
                                        </select>
                                    </div>

                                    <div class="itemform">
                                        <div class="form-group">
                                            <label for="title">Product Name<span class="text-red">*</span></label>
                                            <input id="title" type="text" class="form-control" name="name" value="{{$items->name}}" placeholder="Enter Product Name" >

                                           

                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="title">Brand<span class="text-red">*</span></label>
                                            <input id="Brand" type="text" class="form-control" name="brand" value="{{$items->brand}}" placeholder="Enter Brand">
                                            
                                        </div>

                                        <div class="form-group">
                                            <label for="title">Model Details<span class="text-red">*</span></label>
                                            <input id="item" type="text" class="form-control" name="model_details" value="{{$items->model_details}}" placeholder="Enter >Model Details" >
                                            <div class="help-block with-errors"></div>
                                        </div>

                                        <div class="form-group">
                                            <label for="title">Size</label>
                                                <div class="row">
                                                <div class="col-sm-6">
                                                    <input id="Size" type="text" class="form-control" name="size" value="{{isset($items->size) ? $items->size:''}}" placeholder="Enter Size" >

                                                    
                                                </div>
                                                <div class="col-sm-6">
                                            <input id="Size" type="text" class="form-control" name="size_unit" value="{{isset($items->size_unit) ? $items->size_unit:''}}" placeholder="Enter Size Like 10" >
                                            </div>
                                        </div>
                                    </div>

                                        <div class="form-group">
                                            <label>Other Specifications</label>
                                            <textarea class="form-control" name="description" rows="2">{{$items->description}}</textarea>

                                        </div>

                                        <div class="form-group">
                                            <label for="country">UOM</label>
                                            <select  class="form-control" name="measurement_id" id="measurement" >

                                                <option value="">Select Unit</option> 
                                                    @foreach($measurements as $measurement)

                                                    @if($measurement->id==$items->measurement_id)
                                                        <option value="{{$measurement->id}}" selected="selected">{{$measurement->name}}</option>

                                                    @else
                                                    
                                                        <option value="{{$measurement->id}}">{{$measurement->name}}</option> 
                                                    @endif  
                                                    @endforeach
                                                
                                                </select>
                                            <div class="help-block with-errors"></div>
                                        </div>

                                        <div class="form-group">
                                            <label for="price">Image</label>
                                            @if(isset($items->image))
                                            
                                            <input type="file" id="dropify" class="dropify" data-default-file=" {{ url('images/upload/item/'.$items['image'])}}" name="file">
                                            
                                            @endif
                                            
                                        </div>
                                    </div>
                                    
                                    </div>

                                    <div class="col-sm-4 formitm" >

                                        <div class="form-group">
                                                <label for="title">Reference Link</label>
                                                <input id="p_image_link" type="text" class="form-control" name="reference_link" value="{{isset($items->reference_link) ? $items->reference_link:''}}" placeholder="Enter Reference Link" >
                                                
                                            </div>

                                            <div class="form-group">
                                                <label for="title">Video Link</label>
                                                <input id="video" type="text" class="form-control" name="video_link" value="{{isset($items->video_link) ? $items->video_link:''}}" placeholder="Enter Video Link" >
                                                
                                            </div>

                                            <div class="form-group">
                                                <label for="title">Image Link</label>
                                                <input id="image_link" type="text" class="form-control" name="image_link" value="{{isset($items->image_link) ? $items->image_link:''}}" placeholder="Enter Image Link" >
                                                
                                            </div>

                                        <div class="form-group">
                                                <label for="title">Warranty Period</label>
                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <input id="Warranty" type="text" class="form-control number" name="warranty" value="{{isset($items->warranty) ? $items->warranty:''}}" placeholder="In Period" >
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <select name="warranty_year" class="form-control">
                                                            <option value="">Select Year</option>
                                                            @if($items->warranty_year=='1' || $items->warranty_year=='2' || $items->warranty_year=='3' || $items->warranty_year=='4' || $items->warranty_year=='5' || $items->warranty_year=='6' || $items->warranty_year=='7' || $items->warranty_year=='8' || $items->warranty_year=='9' ||  $items->warranty_year=='10'  || $items->warranty_year=='11' || $items->warranty_year=='12')
                                                            <option value="1"@if ($items->warranty_year == '1') {{ 'selected' }} @endif>1</option>
                                                            <option value="2"@if ($items->warranty_year == '2') {{ 'selected' }} @endif>2</option>
                                                            <option value="3"@if ($items->warranty_year == '3') {{ 'selected' }} @endif>3</option>
                                                            <option value="4"@if ($items->warranty_year == '4') {{ 'selected' }} @endif>4</option>
                                                            <option value="5"@if ($items->warranty_year == '5') {{ 'selected' }} @endif>5</option>
                                                            <option value="6"@if ($items->warranty_year == '6') {{ 'selected' }} @endif>6</option>
                                                            <option value="7"@if ($items->warranty_year == '7') {{ 'selected' }} @endif>7</option>
                                                            <option value="8"@if ($items->warranty_year == '8') {{ 'selected' }} @endif>8</option>
                                                            
                                                            <option value="9"@if ($items->warranty_year == '9') {{ 'selected' }} @endif>9</option>
                                                            <option value="10" @if ($items->warranty_year == '10') {{ 'selected' }} @endif>10</option>
                                                            <option value="11" @if ($items->warranty_year == '11') {{ 'selected' }} @endif>11</option>
                                                            <option value="12" @if ($items->warranty_year == '12') {{ 'selected' }} @endif>12</option>
                                                        @endif
                                                        </select>
                                                    
                                                    
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <select class="form-control" name="warranty_month" id="warranty_month">
                                                          <option value="">Select Month</option>
                                                            @if($items->warranty_month=='January' || $items->warranty_month=='February' || $items->warranty_month=='March' || $items->warranty_month=='April' || $items->warranty_month=='May' || $items->warranty_month=='June' || $items->warranty_month=='July' || $items->warranty_month=='August' || $items->warranty_month=='September' ||  $items->warranty_month=='October'  || $items->warranty_month=='November' || $items->warranty_month=='December')
                                                        <option value="January" @if ($items->warranty_month == 'January') {{ 'selected' }} @endif>January</option>
                                                        <option value="February" @if ($items->warranty_month == 'February') {{ 'selected' }} @endif>February</option>
                                                        <option value="March" @if ($items->warranty_month == 'March') {{ 'selected' }} @endif>March</option>
                                                        <option value="April" @if ($items->warranty_month == 'April') {{ 'selected' }} @endif>April</option>
                                                        <option value="May" @if ($items->warranty_month == 'May') {{ 'selected' }} @endif>May</option>
                                                        <option value="June" @if ($items->warranty_month == 'June') {{ 'selected' }} @endif>June</option>
                                                        <option value="July" @if ($items->warranty_month == 'July') {{ 'selected' }} @endif>July</option>
                                                        <option value="August" @if ($items->warranty_month == 'August') {{ 'selected' }} @endif>August</option>
                                                        <option value="September" @if ($items->warranty_month == 'September') {{ 'selected' }} @endif>September</option>
                                                        <option value="October" @if ($items->warranty_month == 'October') {{ 'selected' }} @endif>October</option>
                                                        <option value="November" @if ($items->warranty_month == 'November') {{ 'selected' }} @endif>November</option>
                                                        <option value="December" @if ($items->warranty_month == 'December') {{ 'selected' }} @endif>December</option>
                                                      @endif
                                                    </select>
                                                      
                                                        </select>
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <select name="warranty_week" class="form-control">
                                                            <option value="">Select Week</option>
                                                            @if($items->warranty_week=='1 week' || $items->warranty_week=='2 week' || $items->warranty_week=='3 week' )
                                                            <option value="1 week" @if ($items->warranty_week == '1 week') {{ 'selected' }} @endif>1 week</option>
                                                            <option value="2 week" @if ($items->warranty_week == '2 week') {{ 'selected' }} @endif>2 week</option>
                                                            <option value="3 week" @if ($items->warranty_week == '3 week') {{ 'selected' }} @endif>3 week</option>
                                                      @endif
                                                        </select>
                                                    
                                                    
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <select class="form-control" name="warranty_days" id="warranty_days">
                                                          <option value="">Select Days</option>
                                                          @foreach($days as $day)
                                                          @if($day->exists && $day->id == $items->warranty_days)
                                                          <option value="{{$day->id}}" selected="selected">{{$day->name}}</option>
                                                          @else
                                                          <option value="{{$day->id}}">{{$day->name}}</option>
                                                          @endif
                                                          @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                        <div class="form-group">
                                                <label for="title">Lifecycle </label>     
                                                <div class="row"> 
                                                    <div class="col-sm-4">
                                                        <input id="lifecycle" type="text" class="form-control lifecycle_number" name="lifecycle" value="{{isset($items->lifecycle) ? $items->lifecycle:''}}" placeholder="Lifecycle" >
                                                    </div>            
                                                <div class="col-sm-4">
                                                    <select name="lifecycle_year" class="form-control">
                                                            <option value="">Select Year</option>
                                                            @if($items->lifecycle_year=='1' || $items->lifecycle_year=='2' || $items->lifecycle_year=='3' || $items->lifecycle_year=='4' || $items->lifecycle_year=='5' || $items->lifecycle_year=='6' || $items->lifecycle_year=='7' || $items->lifecycle_year=='8' || $items->lifecycle_year=='9' ||  $items->lifecycle_year=='10'  || $items->lifecycle_year=='11' || $items->lifecycle_year=='12')
                                                            <option value="1"@if ($items->lifecycle_year == '1') {{ 'selected' }} @endif>1</option>
                                                            <option value="2"@if ($items->lifecycle_year == '2') {{ 'selected' }} @endif>2</option>
                                                            <option value="3"@if ($items->lifecycle_year == '3') {{ 'selected' }} @endif>3</option>
                                                            <option value="4"@if ($items->lifecycle_year == '4') {{ 'selected' }} @endif>4</option>
                                                            <option value="5"@if ($items->lifecycle_year == '5') {{ 'selected' }} @endif>5</option>
                                                            <option value="6"@if ($items->lifecycle_year == '6') {{ 'selected' }} @endif>6</option>
                                                            <option value="7"@if ($items->lifecycle_year == '7') {{ 'selected' }} @endif>7</option>
                                                            <option value="8"@if ($items->lifecycle_year == '8') {{ 'selected' }} @endif>8</option>
                                                            
                                                            <option value="9"@if ($items->lifecycle_year == '9') {{ 'selected' }} @endif>9</option>
                                                            <option value="10" @if ($items->lifecycle_year == '10') {{ 'selected' }} @endif>10</option>
                                                            <option value="11" @if ($items->lifecycle_year == '11') {{ 'selected' }} @endif>11</option>
                                                            <option value="12" @if ($items->lifecycle_year == '12') {{ 'selected' }} @endif>12</option>
                                                      @endif
                                                    </select>
                                                    
                                                </div>
                                                <div class="col-sm-4">
                                                
                                                    <select name="lifecycle_month" class="form-control">
                                                        <option value="">Select Month</option>
                                                        @if($items->lifecycle_month=='January' || $items->lifecycle_month=='February' || $items->lifecycle_month=='March' || $items->lifecycle_month=='April' || $items->lifecycle_month=='May' || $items->lifecycle_month=='June' || $items->lifecycle_month=='July' || $items->lifecycle_month=='August' || $items->lifecycle_month=='September' ||  $items->lifecycle_month=='October'  || $items->lifecycle_month=='November' || $items->lifecycle_month=='December')
                                                        <option value="January" @if ($items->lifecycle_month == 'January') {{ 'selected' }} @endif>January</option>
                                                        <option value="February" @if ($items->lifecycle_month == 'February') {{ 'selected' }} @endif>February</option>
                                                        <option value="March" @if ($items->lifecycle_month == 'March') {{ 'selected' }} @endif>March</option>
                                                        <option value="April" @if ($items->lifecycle_month == 'April') {{ 'selected' }} @endif>April</option>
                                                        <option value="May" @if ($items->lifecycle_month == 'May') {{ 'selected' }} @endif>May</option>
                                                        <option value="June" @if ($items->lifecycle_month == 'June') {{ 'selected' }} @endif>June</option>
                                                        <option value="July" @if ($items->lifecycle_month == 'July') {{ 'selected' }} @endif>July</option>
                                                        <option value="August" @if ($items->lifecycle_month == 'August') {{ 'selected' }} @endif>August</option>
                                                        <option value="September" @if ($items->lifecycle_month == 'September') {{ 'selected' }} @endif>September</option>
                                                        <option value="October" @if ($items->lifecycle_month == 'October') {{ 'selected' }} @endif>October</option>
                                                        <option value="November" @if ($items->lifecycle_month == 'November') {{ 'selected' }} @endif>November</option>
                                                        <option value="December" @if ($items->lifecycle_month == 'December') {{ 'selected' }} @endif>December</option>
                                                      @endif
                                                    </select>
                                                </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                <div class="col-sm-6">
                                                    <select name="lifecycle_week" class="form-control">
                                                        <option value="">Select Week</option>
                                                        @if($items->lifecycle_week=='1 week' || $items->lifecycle_week=='2 week' || $items->lifecycle_week=='3 week' )
                                                        <option value="1 week" @if ($items->lifecycle_week == '1 week') {{ 'selected' }} @endif>1 week</option>
                                                        <option value="2 week" @if ($items->lifecycle_week == '2 week') {{ 'selected' }} @endif>2 week</option>
                                                        <option value="3 week" @if ($items->lifecycle_week == '3 week') {{ 'selected' }} @endif>3 week</option>
                                                      @endif
                                                    </select>
                                                    
                                                </div>
                                                <div class="col-sm-6">
                                                    <select class="form-control" name="lifecycle_days" id="lifecycle">
                                                          <option value="">Select Days</option>
                                                          @foreach($days as $day)
                                                          @if($day->exists && $day->id == $items->lifecycle_days)
                                                          <option value="{{$day->id}}" selected="selected">{{$day->name}}</option>
                                                          @else
                                                          <option value="{{$day->id}}">{{$day->name}}</option>
                                                          @endif
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
                                                    @if($country->exists && $country->id == $items->country_id)
                                                    <option value="{{$country->id}}" selected="selected">{{$country->name}}</option>
                                                    @else
                                                        <option value="{{$country->id}}" >{{$country->name}}</option> 
                                                    @endif
                                                     @endforeach
                                                
                                                </select>
                                            </div>

                                        
                                        

                                        <div class="form-group">
                                            <label for="available">MATERIAL FORM</label>
                                            <select  class="form-control" name="product_nature" id="pronature" >
                                                <option value="">Select MATERIAL FORM</option> 
                                                @if(isset($items->product_nature) && $items->product_nature== 'Solid' || $items->product_nature== 'Breakable' || $items->product_nature== 'Liquid')
                                               <option value="Solid" @if ($items->product_nature == 'Solid') {{ 'selected' }} @endif>Solid</option> 
                                               <option value="Breakable" @if ($items->product_nature == 'Breakable') {{ 'selected' }} @endif>Breakable</option>
                                               
                                               <option value="Liquid" @if ($items->product_nature == 'Liquid') {{ 'selected' }} @endif>Liquid</option>
                                                @else

                                                    <option value="Solid">Solid</option> 
                                                    <option value="Breakable">Breakable</option> 
                                                    <option value="Liquid">Liquid</option> 
                                                 
                                                @endif
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="available">Packing Volume</label>
                                            <div class="row">
                                            <div class="col-sm-6">
                                                    <input id="volume" type="text" class="form-control" name="packing_volume" value="{{isset($items->volume_unit) ? $items->packing_volume:''}}" placeholder="Enter Packing Volume" >
                                                </div>
                                            <div class="col-sm-6">
                                            <input id="volume" type="text" class="form-control" name="volume_unit" value="{{isset($items->volume_unit) ? $items->volume_unit:''}}" placeholder="Enter Like Meter">
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
                                    <button type="submit" class="btn btn-primary" id="submit" value="submit">{{ __('Update')}}</button>
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
    <!-- <script>
        $(document).ready(function() {
            
            $('.itemform').css("display", "none");
            $('.formitm').css("display", "none");
            
        });
    </script> -->
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
            alert('dbvgdfdf');
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
    </script>
    <script>
        $(document).on('change', '.childcat', function() {
            $('.itemform').css("display", "block");
            $('.formitm').css("display", "block");
        });
    </script>
    <script>
    $('.number').keypress(function(event) {
    var $this = $('.number');
    if ((event.which != 46 || $this.val().indexOf('.') != -1) &&
       ((event.which < 48 || event.which > 57) &&
       (event.which != 0 && event.which != 8))) {
           event.preventDefault();
    }

    var text = $('.number').val();
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
<script type="text/javascript">
    $('.lifecycle_number').keypress(function(event) {
    var $this = $('.lifecycle_number');
    if ((event.which != 46 || $this.val().indexOf('.') != -1) &&
       ((event.which < 48 || event.which > 57) &&
       (event.which != 0 && event.which != 8))) {
           event.preventDefault();
    }

    var text = $('.lifecycle_number').val();
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
