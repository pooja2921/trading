
<div class="card text-center otpCard" style="text-align: center;">
 <h5>OTP Verification</h5>
 <!--<img src="assets/img/pincode (1).png" class="" style="width:20%;margin:10px auto;">-->
   <!--<p>A text message with a 6-digit verification code was just send to your mobile number.</p><br>-->
  <div class="col-md-8 offset-md-2">
    <form class="text-center">
      <div class="form-group">
        <label for="password" class="">Enter 4 Digit Password</label>
        <div class="passcode-wrapper">
          <input id="codeBox1" type="number" maxlength="1" onkeyup="onKeyUpEvent(1, event)" onfocus="onFocusEvent(1)">
          <input id="codeBox2" type="number" maxlength="1" onkeyup="onKeyUpEvent(2, event)" onfocus="onFocusEvent(2)">
          <input id="codeBox3" type="number" maxlength="1" onkeyup="onKeyUpEvent(3, event)" onfocus="onFocusEvent(3)">
          <input id="codeBox4" type="number" maxlength="1" onkeyup="onKeyUpEvent(4, event)" onfocus="onFocusEvent(4)">
        </div>  
        <span id="otpErr" class="hidden mob-helpers text-danger">
          <i class="fa fa-times mobile-invalid">&nbsp;</i>Please fill out OTP.
        </span>
      </div>
        <input type="hidden" name="hidden_name" value="{{ $userinfo->name }}">
        <input type="hidden"  class="publicurl" name="hidden_no" value="{{ $userinfo->phone }}" data-url="{{url('/')}}">
    </form>
  </div>
  <p>A one time password send to your mobile number.</p>
</div>

 <script src="{{ asset('src/js/vendor/jquery-3.3.1.min.js') }}"></script>
<!-- <script type="text/javascript">
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
</script>    -->
<script src="https://code.iconify.design/2/2.0.3/iconify.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
    function getCodeBoxElement(index) {
  return document.getElementById('codeBox' + index);
}
function onKeyUpEvent(index, event) {
  const eventCode = event.which || event.keyCode;
  if (getCodeBoxElement(index).value.length === 1) {
     if (index !== 4) {
        getCodeBoxElement(index+ 1).focus();
     } else {
        getCodeBoxElement(index).blur();
        
    var lang = [];
   for(index = 1; index < 5; index++)
   {
    lang.push(getCodeBoxElement(index).value);
   }
   var name = $("input[name=hidden_name]").val();
    var mobile_no = $("input[name=hidden_no]").val();
    var publicurl=$('.publicurl').data('url');
        console.log(lang);
    $.ajax({
      type:'GET',
      url:"{{ route('otp.save') }}",
      data:{name:name, mobile_no:mobile_no, lang:lang},
      success:function(data){
        if(data.info)
        {
          swal({
          text: "Invalid OTP!",
          icon: "error",
          button: "OK!",
        });
        }
        if(data.error)
        {
          swal({
          text: "Something went wrong!",
          icon: "error",
          button: "OK!",
        });
        }
        if(data.success){
          swal({
            title: "Thank You!",
            text: "OTP is Verified!",
            icon: "success",
          });
          setTimeout(() => {
            window.location.href = publicurl+"/dashboard";
                    }, 2000);
        }
          

      }

      });
     }
   
  }
  if (eventCode === 8 && index !== 1) {
     getCodeBoxElement(index - 1).focus();
  }
}
function onFocusEvent(index) {
  for (item = 1; item < index; item++) {
     const currentElement = getCodeBoxElement(item);
  //  alert(currentElement.value);
     if (!currentElement.value) {
          currentElement.focus();
          break;
     }
  }
}
</script>
<!--otp-->
