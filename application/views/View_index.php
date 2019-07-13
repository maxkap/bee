
<div class="container">

    <div class="page-header">
        <h1>Test page</h1>

    </div>


    <div class="bs-example">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Изображение</th>
                    <th class="order-name" data-sort = '<?php echo $data['order_name'] ?>'>Автор</th>
                    <th class="order-email" data-sort = '<?php echo $data['order_email'] ?>'>E-mail</th>
                    <th class="order-time-add" data-sort = '<?php echo $data['order_time_add'] ?>'>Дата добавления</th>
                    <th style="width: 40%">Комментрарий</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($data['comments']) : ?>
                    <?php foreach ($data['comments'] as $comment) : ?>
                        <tr>
                            <td style="text-align: center;">
                                <?php if ($comment['image']): ?>
                                    <img src ="<?php echo view::GetPath(); ?>downloads/<?php echo $comment['image']; ?>">
                                <?php else : ?>
                                    <img src ="<?php echo view::GetPath(); ?>downloads/no-image.png">

                                <?php endif; ?>
                            </td>
                            <td><?php echo $comment['name']; ?></td>
                            <td><?php echo $comment['email']; ?></td>
                            <td><?php echo date('H:i:s d-m-Y', $comment['time_add']); ?></td>
                            <td><?php echo $comment['text']; ?>
                                <?php if ($comment['status'] == 2): ?>
                                    <span style="color:red">(отредактировано админом)</span>
                                <?php endif; ?>    
                            </td>
                        </tr>


                    <?php endforeach; ?>


                <?php else : ?>
                    <tr>
                        <td colspan="5">Упс, данные не найдены(</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>


    <div class="row">
        <div class="col-md-6">
            <h2>Оставьте Ваш отзыв</h2>
            <div class="alert alert-success form-answer" style="display: none" role="alert"></div>
            <form role="form" method="post" class="add-comment" enctype = "multipart/form-data" action="http://localhost/bee/index/add_comment/">
                <div class="form-group">
                    <label >Email</label>
                    <input type="email" class="form-control" required="" name = "email" placeholder="Введите email">
                </div>
                <div class="form-group">
                    <label >Имя</label>
                    <input type="text" class="form-control"  name = "name"  placeholder="Введите имя">
                </div>
                <div class="form-group">
                    <label >Текст</label>
                    <textarea name = "text" class="form-control" required="" placeholder="Введите отзыв"></textarea>
                </div>
                <div class="form-group">
                    <label >Изображение</label>
                    <input type="file" name = "image">
                    <p class="help-block">Форматы JPG, GIF, PNG.</p>
                </div>
                <div class="loader" style="display:none">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>

                <button type="submit" class="btn btn-default">Отправить</button>
                <button  class="btn btn-default fastView">Предварительный просмотр</button>
            </form>

            

        </div>
    </div>


</div> <!-- /container -->

<style>
    [data-sort]{
        cursor: pointer;
    }
    [data-sort='desc']:after{
        content : '↓';   
    }
    [data-sort='none']:after{
        content : '↕';

    }
    [data-sort='asc']:after{
        content : '↑'; 
    }


    .loader {
        height: 100px;
    }
    .loader span {
        display: inline-block;
        vertical-align: middle;
        width: 10px;
        height: 10px;
        margin: 50px auto;
        background: black;
        border-radius: 50px;
        -webkit-animation: loader 0.9s infinite alternate;
        -moz-animation: loader 0.9s infinite alternate;
    }
    .loader span:nth-of-type(2) {
        -webkit-animation-delay: 0.3s;
        -moz-animation-delay: 0.3s;
    }
    .loader span:nth-of-type(3) {
        -webkit-animation-delay: 0.6s;
        -moz-animation-delay: 0.6s;
    }
    @-webkit-keyframes loader {
        0% {
            width: 10px;
            height: 10px;
            opacity: 0.9;
            -webkit-transform: translateY(0);
        }
        100% {
            width: 24px;
            height: 24px;
            opacity: 0.1;
            -webkit-transform: translateY(-21px);
        }
    }
    @-moz-keyframes loader {
        0% {
            width: 10px;
            height: 10px;
            opacity: 0.9;
            -moz-transform: translateY(0);
        }
        100% {
            width: 24px;
            height: 24px;
            opacity: 0.1;
            -moz-transform: translateY(-21px);
        }
    }

</style>

