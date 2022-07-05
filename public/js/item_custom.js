$(document).ready(function() {
    $("#variants_check").click(function() {
        $("#veriants_show").toggle();
        if (this.checked) {
            $('.inventory_portlet').hide();
            $('.price_portlet').hide();
            $('.variant_preview').show();
        } else {
            // $("#kt_table_2>tbody tr").remove();
            $('.inventory_portlet').show();
            $('.price_portlet').show();
            $('.variant_preview').hide();
        }
    });
});



// tags add and select

$("#kt_select2_tags").select2({
    placeholder: "Search for tags",
    tags: true,
    tokenSeparators: [","],
    ajax: {
        url: $("#kt_select2_tags").data('tagurl'),
        dataType: 'json',
        delay: 250,
        data: function(params) {
            return {
                q: params.term, // search term
            };
        },
        processResults: function(data, params) {
            // parse the results into the format expected by Select2
            // since we are using custom formatting functions we do not need to
            // alter the remote JSON data, except to indicate that infinite
            // scrolling can be used
            console.log(data);
            return {
                results: data,

            };
        },
        cache: true
    },

    // minimumInputLength: 1,
    // maximumSelectionLength: 1
    // templateResult: formatRepo, // omitted for brevity, see the source of this page
    //templateSelection: formatRepoSelection // omitted for brevity, see the source of this page
}).on("change", function(e) {
    var isNew = $(this).find('.select2-results__option--highlighted');

    if (isNew.length) {
        isNew.replaceWith('<option selected value="' + isNew.val() + '">' + isNew.val() + '</option>');
        $.ajax({
            // ... store tag ...
        });
    }
    $('.select2-container .select2-search--inline input').val('');
});



var mytable_length = $("#myTable>tbody tr").length;
// alert(mytable_length);
if(mytable_length != 0)
{
    var counter = mytable_length + 1;
}
else
{
    var counter = 1;
}

$(document).ready(function() {

    $("#addrow").click(function() {
        var row ='';
        var attribute = $('.all_attribute').data('attribute');

        // alert(counter);
        row +=  '<tr id="'+ counter +'">';
        row +=  '<td style="width: 40%;">';
        row +=  '<select class="form-control attributes" name="attribute">';
                $.each(attribute, function(i, attr) {
        row +=      '<option value="' + attr.id + '">' + attr.name + '</option>'
                });
        
        row +=  '</select>';
       
        row +=  '</td>';
        row +=  '<td>';
        row +=  '<input class="kt_tagify tags_' + counter + '" placeholder="Add varitation" value="">';
        row +=  '</td>';
        row +=  '<td width="8%"> <label></label><a href="javascript:;" data-count_val="' + counter + '" class="btn btn-outline-hover-danger btn-elevate btn-circle btn-icon optiondelete "><i class="la la-close"></i></a></td>';
        row +=  '</tr>';

        $("#veriants_show").find("#myTable>tbody").append(row);
        tagifyAppend(counter);
        counter++;
    });
});

$('.add_attribute').click(function(){

    var attribute_value = $('.attribute').val();
    var url = $(this).data('url');

    if(attribute_value){
        $.ajax({
            type:"POST",
            url:url,
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            dataType: 'json',
            data:{'name':attribute_value},
            success:function(res){
                console.log(res);
                if(res.status == 'success')
                {
                    
                    var row ='';
                    var attribute = $('.all_attribute').data('attribute');

                    // alert(counter);
                    row +=  '<tr id="'+ counter +'">';
                    row +=  '<td style="width: 40%;">';
                    row +=  '<select class="form-control attributes" name="attribute">';
                        $.each(res.attribute, function(i, attr) {
                            if(attr.id == res.data.id)
                            {
                                row +='<option value="' + attr.id + '" selected>' + attr.name + '</option>'
                            }
                            else
                            {
                                row +='<option value="' + attr.id + '">' + attr.name + '</option>'
                            }
                   
                        });
                    // row +=  '<option value="custom">Custom</option>';
                    row +=  '</select>';
                    // row +=  '<input text="type" class="form-control" name="custom_attribute" value="" style="display:none">';
                    row +=  '</td>';
                    row +=  '<td>';
                    row +=  '<input class="kt_tagify tags_' + counter + '" placeholder="Add varitation" value="">';
                    row +=  '</td>';
                    row +=  '<td width="8%"> <label></label><a href="javascript:;" data-count_val="' + counter + '" class="btn btn-outline-hover-danger btn-elevate btn-circle btn-icon optiondelete "><i class="ik ik-trash-2 f-16 text-red"></i></a></td>';
                    row +=  '</tr>';

                    $("#veriants_show").find("#myTable>tbody").append(row);
                    tagifyAppend(counter);
                    counter++;
                    $('#kt_modal_1').modal('hide');
                    $('.attribute').val('');
                }
                else{
                    $(".attribute_error").append('<span style="color:red;">'+res.data+' attribute already added.</span>');
                    $('.attribute').val('');
                }
            
            }
        });
    }
});

var all_tags = new Array();
var array_counter = [];

$("table.variants-list").on("click", ".optiondelete", function(event) {
    var counter = $(this).data('count_val');
    var all_count_val = [];
    $("#myTable>tbody tr").each(function() {
        all_count_val.push(this.id);
    });

    all_tags = [];
    array_counter =[];
    var old_variant = $('textarea[name=variant_option]').val();

        // console.log(old_variant);
        if(old_variant !='')
        {
            
                // console.log(jQuery.parseJSON(old_variant));
                for (var q = 0; q < jQuery.parseJSON(old_variant).length; q++) {

                    if(all_count_val[q] != counter)
                    {
                        all_tags["tags_" + (q+1)] = jQuery.parseJSON(old_variant)[q];
                        array_counter.push(q+1);
                        // createVariations();
                    }

                }

                $(this).closest("tr").remove();
                if($("#myTable>tbody tr").length == 0)
                {
                    delete all_tags["tags_" + counter];
                    // console.log(all_tags);
                    $('textarea[name=variant_option]').val('');
                    $(document).find("#kt_table_2 tbody tr").remove();
                }
                console.log(all_tags);
                createVariations();

            // }
        }
        $(this).closest("tr").remove();

});

$(document).ready(function() {
    var mytable_length = $("#myTable>tbody tr").length;
    if(mytable_length != 0)
    {
        for(var p = 1; p <= mytable_length; p++)
        {
                array_counter.push(p);

            tagifyAppend(p);
            var lfm_val = $(this).find('.lfm_val_'+p).data('lfm_val');

            addcomboimage(lfm_val);
        }
    }
    else
    {
        if(jQuery.inArray(counter, array_counter ))
        {
            array_counter.push(counter);
        }
        tagifyAppend(counter);
        
        counter++;
    }

});

function tagifyAppend(counter) {
    var tagify;
    // var input = document.querySelector('#myTable>tbody tr input[name="tags_' + counter + '"]');
    var input = document.querySelector('#myTable>tbody tr .tags_' + counter );
    console.log(input);
    // init Tagify script on the above inputs
    tagify = new Tagify(input, {
        // whitelist: ["A# .NET", "A# (Axiom)", "A-0 System", "A+", "A++", "ABAP", "ABC", "ABC ALGOL", "ABSET", "ABSYS", "ACC", "Accent", "Ace DASL", "ACL2", "Avicsoft", "ACT-III", "Action!", "ActionScript", "Ada", "Adenine", "Agda", "Agilent VEE", "Agora", "AIMMS", "Alef", "ALF", "ALGOL 58", "ALGOL 60", "ALGOL 68", "ALGOL W", "Alice", "Alma-0", "AmbientTalk", "Amiga E", "AMOS", "AMPL", "Apex (Salesforce.com)", "APL", "AppleScript", "Arc", "ARexx", "Argus", "AspectJ", "Assembly language", "ATS", "Ateji PX", "AutoHotkey", "Autocoder", "AutoIt", "AutoLISP / Visual LISP", "Averest", "AWK", "Axum", "Active Server Pages", "ASP.NET", "B", "Babbage", "Bash", "BASIC", "bc", "BCPL", "BeanShell", "Batch (Windows/Dos)", "Bertrand", "BETA", "Bigwig", "Bistro", "BitC", "BLISS", "Blockly", "BlooP", "Blue", "Boo", "Boomerang", "Bourne shell (including bash and ksh)", "BREW", "BPEL", "B", "C--", "C++ – ISO/IEC 14882", "C# – ISO/IEC 23270", "C/AL", "Caché ObjectScript", "C Shell", "Caml", "Cayenne", "CDuce", "Cecil", "Cesil", "Céu", "Ceylon", "CFEngine", "CFML", "Cg", "Ch", "Chapel", "Charity", "Charm", "Chef", "CHILL", "CHIP-8", "chomski", "ChucK", "CICS", "Cilk", "Citrine (programming language)", "CL (IBM)", "Claire", "Clarion", "Clean", "Clipper", "CLIPS", "CLIST", "Clojure", "CLU", "CMS-2", "COBOL – ISO/IEC 1989", "CobolScript – COBOL Scripting language", "Cobra", "CODE", "CoffeeScript", "ColdFusion", "COMAL", "Combined Programming Language (CPL)", "COMIT", "Common Intermediate Language (CIL)", "Common Lisp (also known as CL)", "COMPASS", "Component Pascal", "Constraint Handling Rules (CHR)", "COMTRAN", "Converge", "Cool", "Coq", "Coral 66", "Corn", "CorVision", "COWSEL", "CPL", "CPL", "Cryptol", "csh", "Csound", "CSP", "CUDA", "Curl", "Curry", "Cybil", "Cyclone", "Cython", "Java", "Javascript", "M2001", "M4", "M#", "Machine code", "MAD (Michigan Algorithm Decoder)", "MAD/I", "Magik", "Magma", "make", "Maple", "MAPPER now part of BIS", "MARK-IV now VISION:BUILDER", "Mary", "MASM Microsoft Assembly x86", "MATH-MATIC", "Mathematica", "MATLAB", "Maxima (see also Macsyma)", "Max (Max Msp – Graphical Programming Environment)", "Maya (MEL)", "MDL", "Mercury", "Mesa", "Metafont", "Microcode", "MicroScript", "MIIS", "Milk (programming language)", "MIMIC", "Mirah", "Miranda", "MIVA Script", "ML", "Model 204", "Modelica", "Modula", "Modula-2", "Modula-3", "Mohol", "MOO", "Mortran", "Mouse", "MPD", "Mathcad", "MSIL – deprecated name for CIL", "MSL", "MUMPS", "Mystic Programming L"],
        // blacklist: [".NET", "PHP"], // <-- passed as an attribute in this demo
    });
  
    tagify.on('add', function() {
            var type = $(document).find('#myTable>tbody tr .tags_' + counter).closest("tr").find("select").children("option:selected").val();
            console.log(type);
            var old_variant = $('textarea[name=variant_option]').val();

            if(old_variant !='')
            {
                if(all_tags =='' || all_tags == [])
                {
                    // console.log(jQuery.parseJSON(old_variant));
                    for (var q = 0; q < jQuery.parseJSON(old_variant).length; q++) {
                        // console.log(jQuery.parseJSON(old_variant)[q]);
                        all_tags["tags_" + (q+1)] = jQuery.parseJSON(old_variant)[q];
                    }
                }
            }
            console.log(input.value);
            all_tags["tags_" + counter] = { "value": JSON.parse(input.value), "type": type };

            if(jQuery.inArray(counter, array_counter ))
            {
                array_counter.push(counter);
            }

            // console.log(all_tags);
            createVariations();
        })
        .on('remove', function() {

            if (input.value) {
                // alert(counter);
                console.log(input.value);
                var type = $(document).find('#myTable>tbody tr .tags_' + counter).closest("tr").find("select").children("option:selected").val();
                all_tags["tags_" + counter] = { "value": JSON.parse(input.value), "type": type };

                if(jQuery.inArray(counter, array_counter ))
                {
                    array_counter.push(counter);
                }

            } else {
                // console.log(counter);
                delete all_tags["tags_" + counter];

                var index = array_counter.indexOf(counter);
                    if (index >= 0) {
                        array_counter.splice( index, 1 );
                }
                // array_counter.pop(counter);

            }

            createVariations();
            // console.log(all_tags);

        })
        .on('input', function() {
            // console.log("original input value: ", input.value);
        })
        .on('edit', function() {
            console.log("original edit value: ", input.value);
        })
        .on('invalid', function() {
            console.log("original invalid value: ", input.value);
        })
        .on('click', function() {
            console.log("original click value: ", input.value);
        });
    
}

function createVariations() {
    var tags_only = [];
    var option_tags = [];
    //alert('dgfbdhdfhd');
    var array_option_counter = Array.from(new Set(array_counter));
     //console.log(array_option_counter);
    for (var i = 0; i < array_option_counter.length; i++) {
        // alert('fdgfdg'+array_option_counter[i]);
        if(jQuery.inArray(all_tags["tags_" + array_option_counter[i]], all_tags ))
        {
            tags_only.push(all_tags["tags_" + array_option_counter[i]]["value"]);

            option_tags.push(Object.assign({}, all_tags["tags_" + array_option_counter[i]]));
        }
    }

    $('textarea[name=variant_option]').val(JSON.stringify(option_tags));

    var combinations_array = createCombinations(tags_only);
    var new_combo_array = [];
    for (var j = 0; j < combinations_array.length; j++) {
        new_combo_array.push(combinationName(combinations_array[j]));
    }

    $("tr[data-combo]").each(function() {
        if (!new_combo_array.includes($(this).data('combo'))) {
            $(this).remove();
        }
    });

    var weight_unit = $('.all_units').data('weight');
    var weight_option = [];
    $.each(weight_unit, function(i, unit) {
        // console.log(unit.symbol);
        weight_option.push('<option value="' + unit.id + '">' + unit.symbol + '</option>');
    });
    // console.log(new_combo_array);


    for (var k = 0; k < new_combo_array.length; k++) {
        
        // console.log(new_combo_array[k]);

        // var count_no = new_combo_array.indexOf(new_combo_array[k]);
        // alert('ind-'+count_no);
        var row = '<tr data-combo="' + new_combo_array[k] + '">' +
            '<td>' +
            '<div class="kt-avatar kt-avatar--outline kt-avatar--danger" id="kt_user_avatar_4_' + remove_slash(new_combo_array[k]) + '"+>' +
            '<input type="file" id="dropify" class="dropify" data-default-file=" https://dummyimage.com/65x65&text=No+Image" style=";width:70px;height:65px;background-repeat: no-repeat;background-size: 65px 65px;" name="variantfile[]">'+

            '</div>' +
            '</td>' +
            '<td>' + new_combo_array[k] +
            '<input type="hidden" class="form-control" name="variant[]" value="' + new_combo_array[k] + '">' +
            '</td>' +
            '<td>' +
            '<div class="input-group">' +
            '<input type="text" class="form-control number variant_price_'+[k]+'" placeholder="0.00" name="price[]" value="">' +
            '</div>' +
            '</td>' +
            '<td>' +
            '<div class="input-group">' +
            '<input type="text" class="form-control number" placeholder="0.00" name="sale_price[]" value="">' +
            '</div>' +
            '</td>' +
            '<td><input type="number" class="form-control" placeholder="0" name="quantity[]" ></td>' +
            '<td><input type="text" class="form-control" placeholder="SKU" name="sku[]" ></td>' +
            
            '<td> <i class="ik ik-trash-2 f-16 text-red combinationdelete"></i></td>' +
            '</tr>';
        var tbody = $(document).find("#kt_table_2 tbody");
        if (tbody.find('[data-combo="' + new_combo_array[k] + '"]').length == 0) {
            tbody.append(row);
            addcomboimage(remove_slash(new_combo_array[k]));
        }
    }
}

$("table#kt_table_2").on("click", ".combinationdelete", function(event) {
    $(this).closest("tr").remove();

});

function remove_slash(value){
    var string = value.replace(/\//g, '');
    return string;
}

function combinationName(arr) {
    var str_combo = "";
    for (var j = 0; j < arr.length; j++) {
        if (j == 0) {
            str_combo = arr[j]["value"];
        } else {
            str_combo = str_combo + "/" + arr[j]["value"];
        }
    }
    return str_combo;
}

function createCombinations(arguments) {

    var r = [],
        arg = arguments;
    max = arg.length - 1;

    function helper(arr, i) {
        for (var j = 0, l = arg[i].length; j < l; j++) {
            var a = arr.slice(0); // clone arr
            a.push(arg[i][j]);
            if (i == max)
                r.push(a);
            else
                helper(a, i + 1);
        }
    }
    helper([], 0);
    return r;
}

function addcomboimage(counter) {
    
    // alert(counter);
    if ($('#lfm_' + counter).length) {

    
        $("#thumbnail_" + counter).change(function() {
            $("#holder_" + counter).css("background-image", "url(" + $("#thumbnail_" + counter).val() + ")");
            console.log( $("#thumbnail_" + counter).val() );
            $(".avatar_cancel_" + counter).show();
        });
        $(".avatar_cancel_" + counter).click(function() {
            $(".avatar_cancel_" + counter).hide();
            $(this).closest(".kt-avatar").find("#thumbnail_" + counter).val('');
            $(this).closest(".kt-avatar").find("#holder_" + counter).css("background-image", "url(https://dummyimage.com/65x65&text=No+Image)");
        });
    }
    $('#kt_datetimepicker_'+counter).datetimepicker({
        format: "dd M yyyy",
        todayHighlight: true,
        autoclose: true,
        startView: 2,
        minView: 2,
        forceParse: 0,
        pickerPosition: 'bottom-left'
    });
}

// create product variant

var option1 = new Array();
var option2 = new Array();

function AddArrayVariant(tagifydata_1, tagifydata_2) {
    console.log(tagifydata_2);
    if (tagifydata_1 != null) {
        option1.push(tagifydata_1);
        console.log(cartesian(option1));
    }
    console.log(option1);

    if (tagifydata_2 != null) {
        option2.push(tagifydata_2);
        console.log(option1);
        console.log(option2);

        console.log(cartesian(option1, option2));
    }
}

function AddVariant(tagifydata_1, tagifydata_2) {

    // console.log(option2);
    // console.log(tagifydata_1);
    var counter = 0;

    counter = $('#kt_table_2 tr').length - 0;
    var option_counter = $('#myTable tbody tr').length;
    

    var newRow = $("<tr class='option_" + option_counter + "'>");

    var cols = "";

    cols += '<td>' + tagifydata_1 + '</td>';
    cols += '<td><input type="text" class="form-control number variant_price_'+counter+'" placeholder="Price" name="" ></td>';
    cols += '<td><input type="text" class="form-control number" placeholder="Sale price" name="" ></td>';
    cols += '<td><input type="text" class="form-control" placeholder="Quantity" name="" ></td>';
    cols += '<td><input type="text" class="form-control" placeholder="SKU" name="" ></td>';
    cols += '<td> <i class="la la-trash kt-font-danger"></i></td>';

    newRow.append(cols);
    $("#kt_table_2").append(newRow);
    // });

    counter++;

}

$("#form_validation_products").submit(function() {
    // $(this).prop("checked") == true
    $('.variants_creat_msg').html('');
    $('.variants_price_msg').html('');
    $('.single_price_msg').html('');
    $('.title_msg').html('');
    var title = $('input[name=name]').val();
    if(title == '')
    {
        $('.title_msg').html('<span style="color:red;">This field is required.</span>');
        return false;
    }
    if($('#variants_check').prop("checked") == true)
    {
        var mytable_length = $("#myTable>tbody tr").length;
        var kt_table_2_length = $("#kt_table_2>tbody tr").length;
    
        if(mytable_length == 0)
        {
            $('.variants_creat_msg').html('<span style="color:red;">Please create variants.</span>');
            return false;
        }
        else if(mytable_length !=0 && kt_table_2_length == 0)
        {
            $('.variants_creat_msg').html('<span style="color:red;">Please create variants.</span>');
            return false;
        }
        else if(mytable_length !=0 && kt_table_2_length != 0)
        {
            var kt_table_2_price =new Array();
            for(var p = 0; p < kt_table_2_length; p++)
            {
                var pricevalue =  $("#kt_table_2>tbody tr").find('.variant_price_'+p).val();
                if(pricevalue !='')
                {
                    kt_table_2_price.push(pricevalue);
                }
            }
            if(kt_table_2_length != kt_table_2_price.length)
            {
                $('.variants_price_msg').html('<span style="color:red;">Please all variants price fill.</span>');
                return false;
            }
            else
            {
                return true;
            }
            
        }
        else
        {
            return true;
        }
        
    }
    else 
    {
        var price = $('input[name=single_price]').val();
        if(price == '')
        {
            $('.single_price_msg').html('<span style="color:red;">This field is required.</span>');
            return false;
        }
        else
        {
            return true;
        }
    }
    
    // alert($('#variants_check').prop("checked"));
      
    
});


//keyperss validation only numbers enter
$(document).on("keydown",'.number', function(e) {
    // Allow: backspace, delete, tab, escape, enter and .
    if ($.inArray(e.keyCode, [46, 8, 27, 13, 110, 190]) !== -1 ||
         // Allow: Ctrl+A, Command+A
        (e.keyCode === 9 && (e.ctrlKey === true || e.metaKey === true)))
         // Allow: home, end, left, right, down, up
        {
             // let it happen, don't do anything
             return;
    }
    // Ensure that it is a number and stop the keypress
    if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
        e.preventDefault();
    }

});
