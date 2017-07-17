$(document).ready(function() {

    $("a[rel=transcript]").fancybox();
    $("a[rel=national_copy]").fancybox();

    $(".glyphicon-search").click(function() {
        // var $fileLocation = $(this).prev();
        // if($fileLocation.val() != "") {
        //     window.open(".." + $fileLocation.val());
        // }
    });

    $(".remove-file-span").click(function() {
        $(this).parent()
            .find("#file_upload").val("").parent()
            .find(".uploadInput").val("");
        $(this).parent().find('.remove-file-span').addClass("display-none");
    });

    openFileBrowse();

});

function openFileBrowse()
{
    $('.form-control.input-file.uploadInput').click(function () {

        var fileUpload = $(this).parent().find('.fileUpload'),
            fileName   = $(this).parent().find('.uploadInput');

        fileUpload.click();
        fileUpload.change(function() {
            if(fileUpload[0].files.length > 25) {
                $(this).parent().find(".error").removeClass("display-none").text("Allow 25 maximum files upload.");
                $(this).val("");
            } else {
                var filename = "";
                for(var i=0; i< fileUpload[0].files.length; i++) {
                    if(filename == "") {
                        filename = fileUpload[0].files[i].name;
                    } else {
                        filename += ", " + fileUpload[0].files[i].name;
                    }
                }

                fileName.val(filename);

                $(this).parent()
                    .find(".remove-file-span").removeClass("display-none")
                    .parent().find(".error").addClass("display-none");
            }
        });
    });
}