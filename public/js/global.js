$(document).ready(function() {
    setFooterHeight();

    $( window ).resize(function() {
        setFooterHeight();
    });
});

function setFooterHeight() {
    var height = $(".footer").height();
    $("body").css("margin-bottom", height);
}