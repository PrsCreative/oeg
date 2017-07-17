$(document).ready(function () {
    //Page Load Start
    orderChooseCountry();
    checkTermAndCondition();
    birthDatePicker();
    //Page Load End

});

//Function Start
function birthDatePicker()
{
    $('#birthdate').datepicker({
        language: "th-th",
        format: "dd/mm/yyyy",
        endDate: new Date()
    });
}
function orderChooseCountry() {
    var keepOrderCountry = [];
    var elementCountry   = $('[name="country[]"]');

    //on edit
    elementCountry.each(function(){
        var thisCountry  = $(this).val();
        if(this.checked){
            keepOrderCountry.push({
                key: thisCountry,
                val: thisCountry
            });
        }else{
            $.each(keepOrderCountry,function(key,value){
                if(value.key == thisCountry){
                    keepOrderCountry.splice(key,key+1);
                    return false;
                }
            });
        }
        orderChooseCountryDisplay(keepOrderCountry);
    });

    //on change
    elementCountry.change(function(){
        //add or remove data
        var thisCountry  = $(this).val();
        if(this.checked){
            keepOrderCountry.push({
                key: thisCountry,
                val: thisCountry
            });
        }else{
            $.each(keepOrderCountry,function(key,value){
                if(value.key == thisCountry){
                    keepOrderCountry.splice(key,key+1);
                    return false;
                }
            });
        }
        orderChooseCountryDisplay(keepOrderCountry);
    });
}

function orderChooseCountryDisplay(keepOrderCountry)
{
    //define variable
    var showCountry     = '';
    var valueCountry    = '';
    var orderCountry    = $('#orderCountry');
    var orderCountryStr = $('#orderCountryStr');

    //prepare string
    $.each(keepOrderCountry,function(key,value){
        var comma = '';
        if(key != 0){
            comma = ',';
        }
        showCountry  += comma + ' ' + (key+1) + '.' + value.val;
        valueCountry += comma + value.val;
    });

    //display data
    orderCountry.empty();
    orderCountry.html(showCountry);

    //parse value
    orderCountryStr.val(valueCountry);

    //disable another checkbox
    if(keepOrderCountry.length == 2){
        $('[name="country[]"]').each(function(){
            var findValue  = $(this).val();
            var resultFind = $.grep(keepOrderCountry, function(e){ return e.key == findValue; });
            if(resultFind.length == 0){
                $(this).prop("disabled", true);
            }
        });
    }else{
        $('[name="country[]"]').each(function(){
            $(this).prop("disabled", false);
        });
    }
}

function checkTermAndCondition(){
    //define variable
    var confirm             = $('#confirm');
    var submitFormButton    = $('#submitForm');

    //init page check
    if(confirm.checked){
        submitFormButton.prop("disabled", false);
    }else{
        submitFormButton.prop("disabled", true);
    }

    //check case on change
    confirm.change(function(){
        if(this.checked){
            submitFormButton.prop("disabled", false);
        }else{
            submitFormButton.prop("disabled", true);
        }
    });
}
//Function End