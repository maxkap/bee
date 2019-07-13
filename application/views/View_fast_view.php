
    <div class="bs-example">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Изображение</th>
                    <th>Автор</th>
                    <th>E-mail</th>
                    <th>Дата добавления</th>
                    <th style="width: 40%">Комментрарий</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($data['new_comment']) : ?>
                    <tr>
                        <td>
                            <?php if ($data['new_comment']['image']): ?>
                            <img src ="<?php echo view::GetPath(); ?>downloads/<?php echo $data['new_comment']['image'] ;?>"
                            <?php endif; ?>
                        </td>
                        <td><?php echo $data['new_comment']['name'] ;?></td>
                        <td><?php echo $data['new_comment']['email'] ;?></td>
                        <td><?php echo date('H:i:s d-m-Y', time()) ;?></td>
                        <td><?php echo $data['new_comment']['text'] ;?></td>
                    </tr>
                <?php endif; ?>
                
                
                <?php if ($data['comments']) : ?>
                    <?php foreach ($data['comments'] as $comment) : ?>
                        <tr>
                            <td>
                                <?php if ($comment['image']): ?>
                                <img src ="<?php echo view::GetPath(); ?>downloads/<?php echo $comment['image'] ;?>"
                                <?php endif; ?>
                            </td>
                            <td><?php echo $comment['name'] ;?></td>
                            <td><?php echo $comment['email'] ;?></td>
                            <td><?php echo date('H:i:s d-m-Y', $comment['time_add']) ;?></td>
                            <td><?php echo $comment['text'] ;?></td>
                        </tr>


                    <?php endforeach; ?>
                <?php endif; ?>
                
                
            </tbody>
        </table>
    </div>


