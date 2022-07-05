//== Class definition

var SummernoteDemo = function () {    
    //== Private functions
    var demos = function () {

        $('.summernote').summernote({
            height: 250
        });

        $('.summernote').summernote('code', $('.summernote').attr('data-content'));      
        
    }

    $("button[value=submit]").click(function() {
        $('<textarea name="content" style="display:none;">'+ $('.summernote').summernote('code') +'</textarea>').insertAfter('.summernote');
    });

    return {
        // public functions
        init: function() {
            demos(); 
        }
    };
}();



//== Initialization
jQuery(document).ready(function() {
    SummernoteDemo.init();
});