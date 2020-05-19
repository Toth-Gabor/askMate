require('./bootstrap');
window.Jquery = require('jquery');

$(document).on("click", ".add-tag", function () {
    let tagId = $(this).data('id');
    $(".modal-body #tagId").val( tagId );
    console.log(tagId);
});

