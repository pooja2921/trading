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
        </style>
    @endpush

    
    <div class="container-fluid">
        <div class="page-header">
            <div class="row align-items-end">
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
                            
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                           <label class="d-block">Salutation</label>
                                            <select  class="form-control" name="salutation">

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
                                                <input id="first_name" type="text" class="form-control" name="first_name" value="" placeholder="Enter First Name" required="">
                                                <div class="help-block with-errors"></div>


                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="middle_name">Middle  Name</label>
                                                <input id="middle_name" type="text" class="form-control" name="middle_name" value="" placeholder="Enter Middle Name">
                                                <div class="help-block with-errors"></div>


                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="last_name">Last Name</label>
                                                <input id="last_name" type="text" class="form-control" name="last_name" value="" placeholder="Enter Last Name">
                                                <div class="help-block with-errors"></div>


                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="email">Email<span class="text-red">*</span></label>
                                                <input id="email" type="text" class="form-control email" name="email" value="" placeholder="Enter Email" required="">
                                                <span class="emailerror" style="display: none;">Invalid email id</span>
                                                <div class="help-block with-errors"></div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="mobile">Mobile</label>
                                                <input type="hidden" name="coun_code" id="count_code">
                                                 <input type="tel" id="number" class="form-control" name="mobile" > 
                                                <!-- <input id="mobile" type="text" class="form-control" name="mobile" value="" placeholder="Enter Mobile" maxlength="10" required>  -->
                                                <span id="lblError" style="color: red"></span>
                                                <div class="help-block with-errors"></div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="landline">Landline</label>
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
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="company_name">Company Name</label>
                                                <input id="company_name" type="text" class="form-control" name="company_name" value="" placeholder="Enter Company Name">
                                                <div class="help-block with-errors"></div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="gst">GST Number<span class="text-red">*</span></label>
                                                <input id="gst" type="text" class="form-control gst" name="gst_number" value="" placeholder="Enter GST Number" required maxlength="15">
                                                <span class="gstverify"></span>
                                                <span class="gsterror"></span>
                                                <div class="help-block with-errors"></div>
                                            </div>       
                                        
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="d-block">Status<span class="text-red">*</span></label>
                                            <select  class="form-control" name="status" required="">

                                                <option value="">Select Status</option> 
                                                <option value="1">Active</option> 
                                                <option value="0">Inactive</option> 
                                            </select>
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
                        <div class="card-header">
                            <strong><h3>{{ __('Address')}}</h3></strong>
                        </div>
                        <div class="card-body">
                                        <div class="form-group">
                                            <label>Address</label>
                                            <textarea class="form-control" name="address_1" rows="2"></textarea>

                                        </div>
                                    
                                        <div class="form-group">
                                            <label for="state">State</label>
                                            <select  class="form-control" name="state_id" id="tradestate" data-url="{{route('getCity')}}">

                                                <option value="">Select State</option> 
                                                    @foreach($states as $state)
                                                        <option value="{{$state->id}}">{{$state->name}}</option> 
                                                     @endforeach
                                                
                                                </select>
                                            <div class="help-block with-errors"></div>
                                        </div>
                                   

                                        <div class="form-group">
                                            <label for="city">City</label>
                                            <select  class="form-control" name="city_id" id="tradecity">
                                                
                                            </select>
                                            <div class="help-block with-errors"></div>
                                        </div>

                                      

                                        <div class="form-group">
                                            <label for="pincode">Pincode</label>
                                            <input id="pincode" type="text" class="form-control" name="pincode" value="" placeholder="Enter Pincode">
                                            <div class="help-block with-errors"></div>
                                        </div>
                                  
                                        <div class="form-group">
                                            <label for="latitude">Latitude</label>
                                            <input id="latitude" type="text" class="form-control" name="latitude" value="" placeholder="Enter Latitude" >
                                            <div class="help-block with-errors"></div>
                                        </div>
                                  
                                        <div class="form-group">
                                            <label for="longitude">Longitude</label>
                                            <input id="longitude" type="text" class="form-control" name="longitude" value="" placeholder="Enter Longitude" >
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    
                                            
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card ">
                        <div class="card-header">
                            <strong><h3>{{ __('Shipping Address')}}</h3></strong>
                            <div><button type="button" class="class=" name="billingtoo" onclick="FillBilling(this.form)" btn=""style="margin-left: 174px;background-color: #19B5FE !important;color:#fff;border: #19B5FE;">
                            Copy billing Address
                        </button></div>
                        </div>
                        <div class="card-body">
                                        <div class="form-group">
                                            <label>Shipping Address</label>
                                            <textarea class="form-control" name="address_2" rows="2"></textarea>

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
                                            <input id="secondpincode" type="text" class="form-control" name="secondary_pincode" value="" placeholder="Enter Pincode">
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    
                            
                                        <div class="form-group">
                                            <label for="secondlatitude">Latitude</label>
                                            <input id="secondlatitude" type="text" class="form-control" name="secondary_latitude" value="" placeholder="Enter Latitude" >
                                            <div class="help-block with-errors"></div>
                                        </div>
                        
                        
                                        <div class="form-group">
                                            <label for="secondlongitude">Longitude</label>
                                            <input id="secondlongitude" type="text" class="form-control" name="secondary_longitude" value="" placeholder="Enter Longitude" >
                                            <div class="help-block with-errors"></div>
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
           
        $(".gst").change(function () {    
            //alert('fcbghdf');
            var inputvalues = $(this).val();    
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
        });          
               
</script>   

<script type="text/javascript">
$("#number").intlTelInput();


$('#clientform').click(function () {        
    
//$(".email").change(function (e) {  
 
var inputvalues = $(".email").val();    
var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;    
if(!regex.test(inputvalues)){    
$(".emailerror").show();    
//return regex.test(inputvalues); 
return false; 
}    

//});    
    
    //$("#number").change(function () {   
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

    //});

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
    f.address_2.value = f.address_1.value;
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
