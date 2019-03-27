            
            <?php if (isset($view['formMsg'])):?>

            <div class="row bottom-buffer">
                <div class="col-12">
                    <p class="pfont-weight-bold text-green text-center"><?=$view["formMsg"];?></p>
                </div>
            </div>

            <?php endif;?>

            <div class="row bottom-buffer">
            
            <?php if(isset($view['articles']) && !empty($view['articles'])):?>
                <?php foreach((array) $view['articles'] as $article):?>

                <div class="col-sm-12 col-md-12 bottom-buffer">
                    <div class="card articel">
                        <div class="card-header">
                            <b><?=$article['article_name'];?></b>
                            <div class="float-right">
                                Lieferstatus: 
                                <?php if((int) $article['delivery_status'] === 1):?>
                                <span class="text-green">Verfügbar</span>
                                <?php else:?><span class="text-red">Derzeit nicht lieferbar</span> 
                                <?php endif;?>
                            </div>
                        </div>
                        <div class="card-body">
                        <form action="<?=$view['url'];?>?rq=shopCart" method="post" class="formAjax" name="artclForm<?=$article['id'];?>">
                            <dl class="row">
                                <dt class="col-sm-2"><img width="120" height="120" src="<?=IMAGE_URL.$article['image_url'];?>"></dt>
                                <dd class="col-sm-9">
                                <p class="card-text"><?=$article['article_description'];?></p>
                                <p class="card-text">
                                    <b>Artikel-Nr:</b> <?=$article['id'];?><br>
                                    <b>Preis:</b> <span id="price_sum"><?=$article['str_price'];?></span> €
                                </p>
                                    <label for="article_count">Anzahl : </label>
                                    <input type="hidden" name="id" value="<?=$article['id'];?>">
                                    <input type="hidden" name="basic_price" value="<?=$article['price'];?>">
                                    <input type="number" name="article_count" id="article_count" min="1" value="1">
                                    <input type="hidden" name="cat_id" value="<?=$view['articleCat']['id'];?>">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-shopping-cart" aria-hidden="true"></i> in den Warenkorb
                                    </button>
                                    <span class="form-msg shopOrder text-green font-weight-bold"></span>
                                </dd>
                            </dl>
                        </form>
                        </div>
                    </div>
                </div>

                <?php endforeach;?>
            <?php endif;?>

            </div>
            