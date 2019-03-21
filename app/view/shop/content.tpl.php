
    <div class="container">
        <div class="row bottom-buffer">
            <div class="col-12">
                <h1>
                    <?=$view['pageTitle'];?>
                    <?php if(isset($view['articleCat']) && !empty($view['articleCat'])):?>
                      (<?=$view['articleCat']['acount'];?>)
                    <?php endif;?>
                </h1>
                <hr>
            </div>
        </div>

        <?php 
            $tpl = (isset($view['subPage'])) ? $view['subPage'].'.tpl.php' : 'articles.tpl.php';
            include_once $tpl;
        ?>
        
    </div>