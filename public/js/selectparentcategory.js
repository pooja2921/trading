$('#imageenable').on('change', function() {
    $('#imageBody').toggle();
});

$(document).ready(function(){
    // if($("select[name=type]").val() == "other"){
    //     $("input[name=othertype]").closest(".form-group").css("display", "block");
    // }
    $("select[name=type]").change(function(){
        if($("select[name=type]").val() == "other"){
            $("input[name=othertype").closest(".form-group").css("display", "block");
        } else{
            $("input[name=othertype").closest(".form-group").css("display", "none");
        }
    });
});



$(document).ready(function(){
    var publicurl = $('#publicurl').data('value');
     
     var type='item';
     //alert(type);
    $.ajax({
        type: 'GET',
        url: publicurl+'/backend/getselectedcategory',
        data:{type:type},
        dataType: 'json',
        success: function(data) {
            if(data.length > 0)  {
                var $select = $('.parentcategory');
                    $select.find('option').remove();
                    $('.parentcategory').append($("<option value='0'>Select Parent</option>"));
                jQuery.each(data, function(index, value){
                    jQuery.each(value, function(index, cat){
                        $('.parentcategory').append($("<option value="+cat['id']+">"+showChild(cat['depth'], cat['name'])+"</option>"));
                    });
                });
            }
            else{
                
            }
        },
        beforeSend : function(){
           //-----loading image
        },
        complete : function(){
           //-----loading image
        }
    });
});



function showChild(depth,name){
    var str = '&nbsp&nbsp';
    padding = str.repeat(depth*2);
    return padding+name;
}

