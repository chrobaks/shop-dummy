
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

        <?php include_once $view['pageAction'].'.tpl.php';?>
        
    </div>