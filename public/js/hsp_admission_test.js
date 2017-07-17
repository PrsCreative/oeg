$(document).ready(function() {

    var modal_confirm_book  = $('#modal_confirm_book');
    var parent_btn_book     = {};
    var confirm             = false;

    $(".btn-book").click(function() {
        parent_btn_book = $(this).closest('form');;
        modal_confirm_book.modal('toggle');
    });

    $("#confirm_parent_location").submit(function() {
        if(!confirm){
            parent_btn_book = $(this);
            modal_confirm_book.modal('toggle');
        }
        return confirm;
    });

    $(document).on("click",".btn-success",function() {
        confirm = true;
        parent_btn_book.submit();
        modal_confirm_book.modal('toggle');
    });

    $(document).on("click",".btn-danger",function() {
        modal_confirm_book.modal('toggle');
    });

    $('.selectpicker').on('change', function(){
        location.href = $(this).find("option:selected").data('url');
    });

});