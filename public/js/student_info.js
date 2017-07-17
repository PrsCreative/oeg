$(document).ready(function() {

    var menu,dataNav = null;

    //hover menu
    $('.nav_profile').hover(function () {
        menu = $(this);
        dataNav = menu.attr('data-nav');
        $('#nav_profile_' + dataNav).toggle();
    });

    //click next tab
    $('.btn-next').click(function () {
        var tab_content = $(this).closest('.tab-pane');
        var all_tab     = tab_content.parent();
        all_tab.find('.tab-pane').each(function () {
            $(this).removeClass('active');
        });
        tab_content.next().addClass('active')
        $('#tab').val(tab_content.next().attr('id'));

        checkLastTab();
    });

    //click menu
    $('.nav_profile').click(function () {
        $('#tab').val($(this).attr('data-nav'));
        checkLastTab();
    });

    //click submit all
    var modal_confirm_book = $('#modal_confirm_book');
    $('#btn_all_submit').click(function () {
        modal_confirm_book.modal('toggle');
    });
    $(document).on("click",".btn-success",function() {
        $('#state').val('submit');
        $("#form_student_info").submit();
        modal_confirm_book.modal('toggle');
    });
    $(document).on("click",".btn-danger",function() {
        $('#state').val('edit');
        modal_confirm_book.modal('toggle');
    });

    //check address order checkbox
    var addressOrderCheckbox = $('#addressOrderCheckbox');
    displayShowHide( $('.address-order'), addressOrderCheckbox.is(":checked"), true);
    $(document).on('change', '#addressOrderCheckbox', function () {
        $('.address-order').slideToggle(500);
    });

    //check exp travel choice display
    var expTravelElement = $('.exp-travel');
    displayShowHide( expTravelElement, $('input[name="hasExperience"]:checked').val(), 'yes');
    $(document).on('change', 'input[name="hasExperience"]', function () {
        displayShowHide( expTravelElement, $(this).val(), 'yes');
    });


    checkLastTab();

});

function checkLastTab() {
    if($('#tab').val() == 'survey'){
        $('#submit_all_form').show();
    }else{
        $('#submit_all_form').hide();
    }
}

function displayShowHide( element , currentValue , valueToShow)
{
    if(currentValue === valueToShow ){
        element.show();
        return;
    }
    element.hide();
}