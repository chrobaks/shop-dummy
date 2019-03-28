
    <div class="container">
        <div class="row bottom-buffer">
            <div class="col-12">
                <h1><?=$view['pageTitle'];?></h1>
                <hr>
            </div>
        </div>

        <?php if (isset($view['pageText'])):?>

        <div class="row bottom-buffer">
            <div class="col-12">
                <p class="font-weight-bold text-green text-center"><?=$view["pageText"];?></p>
            </div>
        </div>

        <?php endif;?>

        <div class="row bottom-buffer">
            <?php if(isset($view['cats']) && !empty($view['cats'])):?>
                    <?php foreach((array) $view['cats'] as $cat):?>

                    <div class="col-sm-3 col-md-3  bottom-buffer">
                    <div class="card category">
                    <div class="card-header"><?=$cat['cat_name'];?> (<?=$cat['acount'];?>)</div>
                        <div class="card-body">
                            <p class="card-text"><?=$cat['description'];?></p>
                            <a href="<?=$view['url'];?>?rt=<?php if($_SESSION['role'] === '1'):?>shop<?php else:?>article<?php endif;?>&act=category&cat=<?=$cat['id'];?>" class="btn btn-primary">
                            <i class="fa fa-eye" aria-hidden="true"></i> zu den Artikeln
                            </a>
                        </div>
                    </div>
                    </div>

                    <?php endforeach;?>
                <?php endif;?>
        </div>
    </div>