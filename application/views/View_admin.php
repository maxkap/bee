<div class="container">

    <div class="page-header">
        <h1>Привет, <?php echo $_SESSION['user_login']?></h1>

    </div>
    
    <div class="alert alert-block alert-error " style="display: none">
    
    <p>
    </p>
    </div>
    
    <div class="alert alert-block alert-success " style="display: none">
    
    <p>
    </p>
    </div>


    <div class="bs-example">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Статус</th>
                    <th>Изображение</th>
                    <th>Автор</th>
                    <th>E-mail</th>
                    <th>Дата добавления</th>
                    <th style="width: 40%">Комментрарий</th>
                    <th>Действие</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($data['comments']) : ?>
                    <?php foreach ($data['comments'] as $comment) : ?>
                        <tr class="comment-row" data-id="<?php echo $comment['comment_id'] ;?>">
                            <td><?php 
                            
                            if ($comment['status'] == 0) echo 'Не принят';
                            if ($comment['status'] == -1) echo 'Отклонен';
                            if ($comment['status'] == 1 || $comment['status'] == 2) echo 'Принят';
                            
                            ?>
                            
                            </td>
                            <td>
                                <?php if ($comment['image']): ?>
                                    <img src ="<?php echo view::GetPath(); ?>downloads/<?php echo $comment['image'] ;?>">
                                <?php else : ?>
                                    <img src ="<?php echo view::GetPath(); ?>downloads/no-image.png">
                                     
                                <?php endif; ?>
                            </td>
                            <td><?php echo $comment['name'] ;?></td>
                            <td><?php echo $comment['email'] ;?></td>
                            <td><?php echo date('H:i:s d-m-Y', $comment['time_add']) ;?></td>
                            <td>
                                <textarea name = "text" class="form-control" data-id="<?php echo $comment['comment_id'] ;?>"><?php echo $comment['text'] ;?></textarea>
                            </td>
                            <td>
                                <div class="btn-group">
                                    <button class="btn btn-primary dropdown-toggle" data-toggle="dropdown">Выберите <span class="caret"></span></button><p></p>
                                    <ul class="dropdown-menu">
                                    <li>
                                        <a href="#" class="save-comment"  data-id="<?php echo $comment['comment_id'] ;?>">Сохранить коммент</a>
                                    </li>
                                    
                                    <li>
                                        <a href="#" class="activate-comment"  data-id="<?php echo $comment['comment_id'] ;?>">Принять</a>
                                    </li> 
                                    
                                    <li class="divider"></li>
                                    <li><a href="#" class="delete-comment"  data-id="<?php echo $comment['comment_id'] ;?>">Отклонить</a></li>
                                    </ul>
                                </div>
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



</div> <!-- /container -->

