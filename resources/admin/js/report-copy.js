import * as $ from "jquery";

$('.copy-icon').each(function() {
    console.log('I am here')
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
         console.log('clicked')
        $('.report-input').val("");
        var response_id = $(this).attr('data-id');
        $("#response_id").val(response_id);
        $("#request_bad_content").modal('show');
        $(".reported_content").text($('.response-content-text-'+response_id).text());
    });

// created by nitish
$(".submit-button").click(function() {
    // Get form
    var form = $('#report-form')[0];
    var data = new FormData(form);
    if ($("#message").val() != '') {
        $(".submit-button").prop('disabled', true);
        $.ajax({
            url: "/report-content",
            method:"post",
            data: data,
            cache: false,
            processData: false,
            contentType: false,
            success: function(result){
                if(result.status == 'true') {
                    Swal.fire(
                        'Success',
                        result.message,
                        'success'
                    );
                    $('#request_bad_content').modal('hide');
                    $('body').removeClass('modal-open');
                    $('.modal-backdrop').remove();
                } else {
                    Swal.fire(
                        'Error',
                        result.message,
                        'error'
                    );
                    $("#request_bad_content").modal('hide');
                    $('body').removeClass('modal-open');
                    $('.modal-backdrop').remove();
                }
            }
        });
        $(".submit-button").prop('disabled', false);
    }
});


//On foucs out
$('.sc-XhUPp').on('focusout', function(event){
    var response_id = $(this).attr('data-id');
    var response = $(this).text();
    console.log(response_id);
    // $.ajax({
    //     headers: {
    //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //     },
    //     url: "update-response/"+response_id,
    //     method:"post",
    //     data:{response:response},
    //     cache: false,
    //     success: function(result){
    //         if(result.status == true) {
    //             console.log('updated');
    //         }
    //     }
    // });
});
