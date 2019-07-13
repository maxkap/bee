$(document).ready(function () {

    $('body').on("click", ".delete-comment", function () {
        var id = $(this).attr('data-id');        
        if (confirm("Подтвердите отклонение. Продолжаем?")) {
            
            
            $.ajax({
                data: "comment_id=" + id,
                url: "http://"+path+"admin/delete_comment/",
                type: "GET",
                success: function (res) {
                    console.log(res)
                    $(".comment-row[data-id='"+id+"'] td").first().html('Отклонен');
                    $(".alert-success p").html ("Данные удалены");
                    $(".alert-success").fadeIn();
                    $("html, body").animate({
                        scrollTop: 0
                    }, 600);
                }
            });
        }

    });
    
    $('body').on("click", ".activate-comment", function () {
        
        var id = $(this).attr('data-id'); 
        $.ajax({
            data: "comment_id=" + id,
            url: "http://"+path+"admin/activate_comment/",
            type: "GET",
            success: function () {
               
                $(".comment-row[data-id='"+id+"'] td").first().html('Принят');
                $(".alert-success p").html ("Комментарий активен")
                $(".alert-success").fadeIn();   
                $("html, body").animate({
                    scrollTop: 0
                }, 600);
            }
        });
    });
    
    
    $('body').on("click", ".save-comment", function () {
        
        var id = $(this).attr('data-id'); 
        var comment = $("[name = 'text'][data-id='"+id+"']").val()
        $.ajax({
            data: "comment_id=" + id+"&comment="+comment,
            url: "http://"+path+"admin/save_comment/",
            type: "POST",
            success: function (data) {
                console.log(data);
                $(".alert-success p").html ("Комментарий сохранен");
                $(".alert-success").fadeIn();  
                $("html, body").animate({
                    scrollTop: 0
                }, 600);
            }
        });
    });
    
});