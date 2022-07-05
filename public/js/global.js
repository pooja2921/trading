$('.clientstatus').change(function() {
  //alert('fghfhgfhgf');

  var scope = $(this).closest('tr'); 
  var id = $(this).data("id");
  console.log(id);
  var url=$(this).data("url");
  console.log(url);
  var stat=$('.clientstatus option:selected', scope).val();
  console.log(stat);
  $.ajax({
    url: url,
    type: 'GET',
    data: {
      "stat":stat
    },
    success: function(data) {
      console.log(data);
    }
  });

  console.log("It failed");
});


$('.chngstatus').change(function() {
  //alert('fghfhgfhgf');

  var scope = $(this).closest('tr'); 
  var id = $(this).data("id");
  console.log(id);
  var url=$(this).data("url");
  console.log(url);
  var stat=$('.chngstatus option:selected', scope).val();
  console.log(stat);
  $.ajax({
    url: url,
    type: 'GET',
    data: {
      "stat":stat
    },
    success: function(data) {
      console.log(data);
    }
  });

  console.log("It failed");
});


$(document).on('click','.deletebyid',function(){
  //alert('ghfhgfh');
    if(!confirm("Do you really want to delete?")) {
         return false;
    }
  var url=$(this).data("url");
   console.log(url);
  var id=$(this).data("id");
   console.log(id);
$.ajax({
    url: url,
    type: 'GET',
    data: {
      "id":id
    },
    success: function(data) {
      console.log(data);
      if (data.status == "success") {
        //alert('jgjghj');
           //$(document).find("tr").find("[data-id=" + data.data + "]").closest("tr").remove();
            location.reload();
      }
    }
  });

  console.log("It failed");
});

//edit attribute
$(document).on('click','.editbyid',function(){
  //alert('ghfhgfh');
    
  var url=$(this).data("url");
   //console.log(url);
  var id=$(this).data("id");
   //console.log(id);
  $.ajax({
    url: url,
    type: 'GET',
    data: {
      "id":id
    },
    success: function(data) {
      console.log(data.status);
      if (data.status == "success") {
          //alert(data.attr.name);
          $("#categoryView").modal("show");
          $('.attrname').val(data.attr.name);
          $('.attrid').val(data.attr.id);
      }
    }
  });

  console.log("It failed");
});


//edit measure
$(document).on('click','.measureid',function(){
  //alert('ghfhgfh');
    
  var url=$(this).data("url");
  console.log(url);
  var id=$(this).data("id");
  console.log(id);
  $.ajax({
    url: url,
    type: 'GET',
    data: {
      "id":id
    },
    success: function(data) {
      console.log(data.status);
      if (data.status == "success") {
          //alert(data.attr.name);
          $("#categoryView").modal("show");
          $('.attrname').val(data.attr.name);
          $('.attrid').val(data.attr.id);
      }
    }
  });

  console.log("It failed");
});


//edit delivery
$(document).on('click','.deliveryid',function(){
  //alert('ghfhgfh');
    
  var url=$(this).data("url");
  console.log(url);
  var id=$(this).data("id");
  console.log(id);
  $.ajax({
    url: url,
    type: 'GET',
    data: {
      "id":id
    },
    success: function(data) {
      console.log(data.status);
      if (data.status == "success") {
          //alert(data.attr.name);
          $("#categoryView").modal("show");
          $('.attrname').val(data.attr.expected_delivery);
          $('.attrid').val(data.attr.id);
      }
    }
  });

  console.log("It failed");
});



//update  attribute
$('.updateform').click(function(){
  //alert('dgdfgdgdf');
  var url=$(this).data("url");
  var id=$('.attrid').val();
  //alert(id);
  var attrname=$('.attrname').val();
  //alert(attrname);
  $.ajax({
    url: url,
    type: 'GET',
    data: {
      "id":id,
      "name":attrname
    },
    success: function(data) {
      console.log(data);
      if (data.status == "success") {
          //alert(data.attr.name);
           
           location.reload();
      }
    }
  });

  console.log("It failed");

});

//edit category

$(document).on('click','.editbycatid',function(){
  //alert('ghfhgfh');
    
  var url=$(this).data("url");
 console.log(url);
  var id=$(this).data("id");
  // console.log(id);
  var imgurl=$('#imgurl').data('imgurl');
  //console.log(imgurl);
  var dlturl=$('#deleteurl').data('dlturl');
  console.log(dlturl);

  $.ajax({
    url: url,
    type: 'GET',
    data: {
      "id":id
    },
    success: function(data) {
      console.log(data);
      if (data.status == "success") {
          console.log(data);
          var row='';
          var img='';
          $("#categoryView").modal("show");
            $('.catid').val(data.category.id);
            $('.catname').val(data.category.name);
            $('.catslug').val(data.category.slug);

          if(data.category.image){
            img+='<span class="remove_image" style="display:flex;" data-id="'+data.category.id+'" data-delete_url="'+dlturl+'/'+data.category.id+'">';
            img+='<i class="fa fa-times"></i>';
            img+='</span>';
            img+='<img class="thumbnail" src="'+imgurl+'/'+data.category.image+'" style="width: 30%">';
            
            
          }
          row+='<label class="d-block">Parent Category</label>';
              row+='<select data-live-search="true" class="form-control  m_selectpicker parentcategory" name="parent_id">';
                row+='<option value="">Select Parent</option>';
                                
                    $.each(data.parentcategory, function(i, cate) {
                        if(cate.id == data.category.parent_id){
                            row+='<option value="'+cate.id+'" selected>'+cate.name+'</option>';

                        }else{
                            row+='<option value="'+cate.id+'">'+cate.name+'</option>';
                      
                        }
                    });

                row+='</select>';
                $('.appndimg').html(img);
                $('.appendparent').html(row);
      }
    }
  });

  console.log("It failed");
});


$(document).on('click','.editbysubcat',function(){
  //alert('ghfhgfh');
    
  var url=$(this).data("url");
 //console.log(url);
  var id=$(this).data("id");
  // console.log(id);
  var imgurl=$('#imgurl').data('imgurl');
  //console.log(imgurl);
  var dlturl=$('#deleteurl').data('dlturl');
  //console.log(dlturl);

  $.ajax({
    url: url,
    type: 'GET',
    data: {
      "id":id
    },
    success: function(data) {
      console.log(data);
      if (data.status == "success") {
          console.log(data);
          var row='';
          var img='';
          $("#categoryView").modal("show");
            $('.catid').val(data.category.id);
            $('.catname').val(data.category.name);
            $('.catslug').val(data.category.slug);

          if(data.category.image){
            img+='<span class="remove_image" style="display:flex;" data-id="'+data.category.id+'" data-delete_url="'+dlturl+'/'+data.category.id+'">';
            img+='<i class="fa fa-times"></i>';
            img+='</span>';
            img+='<img class="thumbnail" src="'+imgurl+'/'+data.category.image+'" style="width: 30%">';
            
            
          }
          row+='<label class="d-block">Parent Category</label>';
              row+='<select data-live-search="true" class="form-control  m_selectpicker parentcategory" name="parent_id">';
                row+='<option value="">Select Parent</option>';
                                
                    $.each(data.parentcategory, function(i, cate) {
                        if(cate.id == data.category.parent_id){
                            row+='<option value="'+cate.id+'" selected>'+cate.name+'</option>';

                        }else{
                            row+='<option value="'+cate.id+'">'+cate.name+'</option>';
                      
                        }
                    });

                row+='</select>';
                $('.appndimg').html(img);
                $('.appendparent').html(row);
      }
    }
  });

  console.log("It failed");
});



//update category
/*$('.updatecategory').click(function(){
//alert('bhfhfgh');

var url=$(this).data("url");
//console.log(url);
  var id=$('.catid').val();
  //alert(id);
  var catname=$('.catname').val();
  //alert(catname);
  var catslug=$('.catslug').val();
  //alert(catslug);
  var cattype=$('.cattype').val();

  $.ajax({
    url: url,
    type: 'GET',
    data: {
      "id":id,
      "name":catname,
      "slug":catslug,
      "type":cattype
    },
    success: function(data) {
      console.log(data);
      if (data.status == "success") {
          //alert(data.attr.name);
           
           //location.reload();
      }
    }
  });

});*/
//edit role
$(document).on('click','.editroleid',function(e){
  //alert('ghfhgfh');
  var url=$(this).data("url");
  console.log(url);
  var id=$(this).data("id");
  console.log(id);
    $.ajax({
    url: url,
    type: 'GET',
    data: {
      "id":id
    },
    success: function(data) {
       $("#permissiondiv").html('');
      //console.log(data);
      if (data.status == "success") {
          console.log(data);
          var row='';
          $("#roledit").modal("show");
          $('.rolename').val(data.role.name);
          $('.roleid').val(data.role.id);
          $.each(data.permissions, function(i, permission) {
            //console.log(i +"" +permission);
                    row='<div class="col-sm-12">';
                           row+='<label class="custom-control custom-checkbox">'; 
                              if($.inArray(parseInt(i), data.role_permission)>=0){                    
                             row+='<input type="checkbox" class="custom-control-input" id="item_checkbox" name="permissions[]" value="'+i+'" checked> <span class="custom-control-label">'+permission+'</span>';

                          }else{
                                row+='<input type="checkbox" class="custom-control-input" id="item_checkbox" name="permissions[]" value="'+i+'"><span class="custom-control-label">'+permission+'</span>';                         
                          }
                            
                           row+='</label>';
                     row+='</div>';
                     //console.log(row);
                   // e.preventDefault();

   // $('div .appendpermission').html('');
                     $('div .appendpermission').append(row);
                });
                
      }
    }
  });

  console.log("It failed");
});

//edit user
$(document).on('click','.edituserid',function(){
  var url=$(this).data("url");
  console.log(url);
  var id=$(this).data("id");
  console.log(id);
  $.ajax({
    url: url,
    type: 'GET',
    data: {
      "id":id
    },
      success: function(data) {
        console.log(data);
         $("#permissionappend").html('');
        if (data.status == "success") {
           // console.log(data);
          var row='';
          $("#categoryView").modal("show");
          $('.username').val(data.user.name);
          $('.useremail').val(data.user.email);
          $('.userid').val(data.user.id);
          $.each(data.userpermission,function(i,permission){
            //console.log(permission);
            row='<span class="badge badge-dark m-1">'+permission.name+'</span>';
            console.log(row);
            $('div .permission').append(row);
          });

        }
      }
  });
});

//detail category
$(document).on('click','.detailbycatid',function(){
 
  var url=$(this).data("url");
  //console.log(url);
  var id=$(this).data("id");
  //console.log(id);
  var imgurl=$('#imgurl').data('imgurl');
  //console.log(imgurl);
  $.ajax({
    url: url,
    type: 'GET',
    data: {
      "id":id
    },
    success: function(data) {
      //console.log(data);
      if (data.status == "success") {
         // console.log(data);
          var img='';
          $("#productView").modal("show");
           
          $('.catname').text(data.category.name);
          if(data.category.image){
            img+='<img class="thumbnail" src="'+imgurl+'/'+data.category.image+'" style="width: 100%">';
          
          }
          //console.log(img);
          $('.appendimg').html(img);
          
      }
    }
  });

  console.log("It failed");
});

$(document).on('click','.remove_image',function(){
  alert('dfgdfgdg');
   var scope = $(this);
var id=$(this).data('id');
console.log(id);
var url=$(this).data('delete_url');
console.log(url);

$.ajax({
            type:"GET",
            url:  url ,
            data: {
              "id":id
            },
            success: function(response) {
                  console.log(response);
                if( response.status == 'success' ) {
                  //alert('gfhbfgh');
                    console.log($('.appndimg').html());
                }
            },
            error: function( data ) {
                
            }

            });
});


$(document).on('click','.editstate',function(){
//alert('fcbgdgd');
var id=$(this).data('id');
//console.log(id);

var url=$(this).data('url');
//console.log(url);
$.ajax({
    url: url,
    type: 'GET',
    data: {
      "id":id
    },
      success: function(data) {
        console.log(data);
        if (data.status == "success") {
           //console.log(data);
         
          $("#stateView").modal("show");
          $('.statename').val(data.state.name);
          $('.stateid').val(data.state.id);
          

        }
      }
  });
});

/*
$('#spansearch').click(function(){
$('.closeicon').css('display','block');
});*/

//var selectedTrashDelete = function() {

        $('#selectall').on('click', function() {
          alert('fbgfhgfh');
            // fetch selected IDs

            /*var ids = datatable.rows('.kt-datatable__row--active').nodes().find('.kt-checkbox--single > [type="checkbox"]').map(function(i, chk) {
                return $(chk).val();

            });
            // get current url second parameter
            var currenturl = $(location).attr('href'),
                parts = currenturl.split("/"),
                last_part = parts[parts.length - 2];

            if (ids.length > 0) {
                // learn more: https://sweetalert2.github.io/

                swal.fire({

                    buttonsStyling: false,
                    text: "Are you sure to delete " + ids.length + " selected records ?",
                    type: "danger",

                    confirmButtonText: "Yes, delete!",
                    confirmButtonClass: "btn btn-sm btn-bold btn-danger",

                    showCancelButton: true,
                    cancelButtonText: "No, cancel",
                    cancelButtonClass: "btn btn-sm btn-bold btn-brand"
                }).then(function(result) {
                    if (result.value) {
                        //Call JQUERY HTTP METHOD TO DELETE THE ROWS!
                        // let url = window.location.href + "/trashall";

                        if (last_part == 'trash') {
                            var urlWithoutHash = location.protocol + '//' + location.host + location.pathname;
                            urlWithoutHash = urlWithoutHash.replace('/trash/index', "");
                            var url = urlWithoutHash + "/deleteall";
                            var title = 'Trash';
                            var message = 'Your selected records have been deleted!';
                            var cancelled_message = 'You selected records have not been deleted!';

                        } else {
                            var url = window.location.href + "/trashall";
                            var title = 'Delete';
                            var message = 'Your selected records have been trash!';
                            var cancelled_message = 'You selected records have not been trash!';
                        }

                        $.ajax({
                            url: url,
                            type: 'post',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            data: {
                                ids: JSON.stringify(ids)
                            },
                            dataType: 'json',
                            success: function(data) {
                                // console.info(data);

                                if (data.status == "success") {
                                    datatable.rows('.kt-datatable__row--active').nodes().fadeOut(300, function() {
                                        $(this).remove();
                                    });

                                    swal.fire({
                                        title: title,
                                        text: message + ' :(',
                                        type: 'success',
                                        buttonsStyling: false,
                                        confirmButtonText: "OK",
                                        confirmButtonClass: "btn btn-sm btn-bold btn-brand",
                                    });

                                }

                            },
                            error: function(data) {
                                if (data.status == "danger") {

                                    swal.fire({
                                        title: 'Cancelled',
                                        text: cancelled_message + ' :)',
                                        type: 'error',
                                        buttonsStyling: false,
                                        confirmButtonText: "OK",
                                        confirmButtonClass: "btn btn-sm btn-bold btn-brand",
                                    });
                                }
                            }
                        });


                        // result.dismiss can be 'cancel', 'overlay',
                        // 'close', and 'timer'
                    } else if (result.dismiss === 'cancel') {
                        swal.fire({
                            title: 'Cancelled',
                            text: cancelled_message + ' :)',
                            type: 'error',
                            buttonsStyling: false,
                            confirmButtonText: "OK",
                            confirmButtonClass: "btn btn-sm btn-bold btn-brand",
                        });
                    }
                });
            }*/
        });
    //}