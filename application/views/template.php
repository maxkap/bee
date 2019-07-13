<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="description" content="" />
        <meta name="keywords" content="" />
        <meta name="author" content="Maxim Karavaev" />

        <title>Bee test page</title>

        <link href="<?php echo view::GetPath(); ?>bootstrap/css/bootstrap.min.css" rel="stylesheet" />
    </head>

    <body>
        <?php
        include ROOT . '/application/views/View_' . $view . '.php';
        $path = $_SERVER['SERVER_NAME']. view::GetPath();
        ?>
        <script >
            path = "<?php echo $path;?>";
        </script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <script src="<?php echo view::GetPath(); ?>bootstrap/js/bootstrap.min.js"></script>
        <?php if (isset($_SESSION['user_id'])) :?>
        <script src="<?php echo view::GetPath(); ?>js/admin.js"></script>
        <?php endif;?>
        <script src="<?php echo view::GetPath(); ?>js/script.js"></script>
        
        




        <div class="modal fade" id="fastView">
            <div class="modal-dialog" role="document" style="width: 100%;">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title">Предварительный просмотр</h4>
                    </div>
                    <div class="modal-body">
                        <p></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>                        
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

    </body>
</html>