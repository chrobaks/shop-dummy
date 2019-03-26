<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="SEO-Küche, Shop">
        <title><?=$view['title'];?> / <?=$view['pageTitle'];?></title> 
        <link rel="shortcut icon" type="image/x-icon" href="<?=IMAGE_URL;?>favicon.ico">
        <link rel='stylesheet' href='<?=CSS_URL;?>bootstrap.min.css' type='text/css' media='all' />
        <link rel='stylesheet' href='<?=CSS_URL;?>bootstrap-grid.min.css' type='text/css' media='all' />
        <link rel='stylesheet' href='<?=CSS_URL;?>app.css' type='text/css' media='all' />
        <link rel="stylesheet" href="<?=CSS_URL;?>all.min.css">
    </head>
    <body id="app">
    
        <?php include_once 'app/menu.tpl.php';?>

        <div class="app-content">
        
        <?php include_once $view['page'].'/content.tpl.php';?>

        </div>

        <?php include_once 'app/footer.tpl.php';?>

        <?php include_once 'app/shopCart.tpl.php';?>

        <script type="text/javascript" src="<?=JS_URL;?>jquery-3.3.1.min.js"></script>
        <script type="text/javascript" src="<?=JS_URL;?>bootstrap.bundle.min.js"></script>
        <script type="text/javascript" src="<?=JS_URL;?>ShopCart.js"></script>
        <script type="text/javascript" src="<?=JS_URL;?>app.js"></script>
        <script type="text/javascript">
        
            const AppConfig = {
                url : '<?=$view['url'];?>'
            };
            
            $(function () {
                
                App.setEvents();

                <?php if(isset($view['shopCart']) && !empty($view['shopCart'])):?>

                ShopCart.setShopCart(<?=json_encode($view['shopCart']);?>);

                <?php endif;?>

            });
        </script>
    </body>
</html>

