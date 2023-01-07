$('.copy-icon').each(function() {
    $(this).click(function() {
        var $temp = $("<input>");
        $("body").append($temp);
        var response_id = $(this).attr('data-id');
        $temp.val($('.response-content-text-'+response_id).text()).select();
        document.execCommand("copy");
        $temp.remove();

        showMessage({status:'success',title:'Copied!',message:'Text has been Copied.'})
        /*Swal.fire(
            'Copied!',
            'Text has been Copied.',
            'success'
        );*/
    });
});

// created by nitish
$('.report-icon').click(function() {
    $('.report-input').val("");
    var response_id = $(this).attr('data-id');
    $("#response_id").val(response_id);
    $("#request_bad_content").modal('show');
    $(".reported_content").text($('.response-content-text-'+response_id).text());
});

$('.copy-icon-add').each(function() {
    $(this).click(function() {
        var response_id = $(this).attr('data-id');
        var $temp = $("<div style='white-space: pre-line;color:#000000;background-color:#fff;background:#fff'>");
        $('body').append($temp);
        $temp.attr("contenteditable", true)
            .html($('.response-content-text-'+response_id).html()).select()
            .on("focus", function() { document.execCommand('selectAll',false,null); })
            .focus();
        document.execCommand("copy");
        $temp.remove();
        showMessage({status:'success',title:'Copied!',message:'Text has been Copied.'});
        return false;


        var $temp = $("<input>");
        $("body").append($temp);
        var response_id = $(this).attr('data-id');
        $temp.val($('.response-content-text-'+response_id).html()).select();
        document.execCommand("copy");
        $temp.remove();
        showMessage({status:'success',title:'Copied!',message:'Text has been Copied.'})
    });
});
$('.report-icon-add').each(function() {
    $(this).click(function() {
        var response_id = $(this).attr('data-id');
        $("#response_id").val(response_id);
        $("#request_bad_content").modal('show');
        setTimeout(() => {
            $(".reported_content").text($(this).parent().parent().parent().find('.response-content-text-'+response_id).text().trim());
        }, 1000);
    });
});
