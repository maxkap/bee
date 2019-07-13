$(document).ready(function () {


    $(".fastView").click(function () {

        var formData = new FormData($('form')[0]);
        $.ajax({
            url: "http://"+path+"index/fast_view/",
            dataType: 'text',
            cache: false,
            contentType: false,
            processData: false,
            data: formData,
            type: 'post',
            beforeSend:function(){
                $(".loader").fadeIn();
            },
            success: function (res) {
                $(".loader").fadeOut();
                $("#fastView .modal-body").html(res);
                $("#fastView").modal('show');
            }
        });

        return false;
    });

    $(".add-comment").submit(function () {
        var formData = new FormData($(this)[0]);

        $.ajax({
            url: "http://"+path+"index/add_comment/",
            dataType: 'text',
            cache: false,
            contentType: false,
            processData: false,
            data: formData,
            type: 'post',
            beforeSend:function(){
                $(".loader").fadeIn();
            },
            success: function (res) {
                 $(".loader").fadeOut();
                if (res == 'success'){                    
                    $('.form-answer').removeClass('alert-danger');
                    $('.form-answer').addClass('alert-success');
                    $('.form-answer').fadeIn();                    
                    $('.form-answer').html('Ваш комментарий отправлен, но появится после одобрения администратором')
                }
                else{
                    $('.form-answer').addClass('alert-danger');
                    $('.form-answer').removeClass('alert-success');
                    $('.form-answer').fadeIn();                    
                    $('.form-answer').html('В процессе добавления произошла ошибка, попробуйте немного позже или свяжитесь с нами')
                }
            }
        });

        return false;
    });




    $(".form-signin").submit(function () {
        var formData = $(this).serialize();

        $.ajax({
            url: "http://"+path+"login/run/",
            dataType: 'text',
            data: formData,
            type: 'post',
            success: function (result) {
                console.log(result);
                res = jQuery.parseJSON(result);
                if (res.success) {
                    location.href = "http://"+path+"admin/"
                } else {
                    $(".login-error").fadeIn();
                    $(".login-error").html(res.error);
                }

            }
        });

        return false;
    });


    $('body').on("click", ".order-name", function () {
        var sort = $(this).attr('data-sort');
        $(".order-email").attr('data-sort', 'none');
        $(".order-time-add").attr('data-sort', 'none');        
        location.href = "http://"+path+"?order_name=" + getSort(sort)
    });
    $('body').on("click", ".order-email", function () {
        var sort = $(this).attr('data-sort');
        $(".order-name").attr('data-sort', 'none');
        $(".order-time-add").attr('data-sort', 'none');
        location.href = "http://"+path+"?order_email=" + getSort(sort)
    });
    $('body').on("click", ".order-time-add", function () {
        var sort = $(this).attr('data-sort');
        $(".order-email").attr('data-sort', 'none');
        $(".order-name").attr('data-sort', 'none');
        location.href = "http://"+path+"?order_time_add=" + getSort(sort)
    });


});


function getSort(sort) {
    if (sort == 'desc') {
        return 'asc';
    } else {
        return 'desc'
    }
}