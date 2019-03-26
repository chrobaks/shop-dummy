<div class="container">

        <div class="row bottom-buffer">
            <div class="col-12">
                <h1><?=$view['pageTitle'];?></h1>
                <hr>
            </div>
        </div>

        <?php if (isset($view['formMsg'])):?>

        <div class="row bottom-buffer">
            <div class="col-12">
                <p class="font-weight-bold text-green text-center"><?=$view["formMsg"];?></p>
            </div>
        </div>

        <?php endif;?>

        <?php include_once $view['subPage'].'.tpl.php';?>

</div>

