
    <div class="container">
        <div class="row bottom-buffer">
            <div class="col-12">
                <h1><?=$view['pageTitle'];?></h1>
                <hr>
                
            </div>
        </div>


        <?php if(!empty($view['pageText'])):?>
        <div class="row bottom-buffer">
            <div class="col-12"><p class="text-green font-weight-bold"><?=$view['pageText'];?></p></div>
        </div>
        <?php endif;?>

        <?php if(isset($view['formMsg'])):?>
        <div class="row bottom-buffer">
            <div class="col-12"><p class="text-green font-weight-bold"><?=$view['formMsg'];?></p></div>
        </div>
        <?php endif;?>

        <?php include_once $view['pageAction'].'.tpl.php';?>

    </div>

