            
            <?php if (isset($view['formMsg'])):?>

            <div class="row bottom-buffer">
                <div class="col-12">
                    <p class="pfont-weight-bold text-green text-center"><?=$view["formMsg"];?></p>
                </div>
            </div>

            <?php endif;?>

            <?php if($_SESSION['role'] === '1' && isset($view['articleCat'])):?>
            <div class="row bottom-buffer">
                <div class="col-sm-12 col-md-12 bottom-buffer">
                    <div class="card articel">
                        <div class="card-header">
                            <b>Kategorie / <?=$view['articleCat']['cat_name'];?></b>
                        </div>
                        <div class="card-body">
                        <form action="<?=$view['url'];?>?rt=article&act=catDelete" method="post">
                            <dl class="row">
                                <dt class="col-sm-2"><label for="">Beschreibung</label></dt>
                                <dd class="col-sm-9">
                                <p class="card-text"><?=$view['articleCat']['description'];?></p>
                                <hr>
                                
                                    <input type="hidden" name="id" value="<?=$view['articleCat']['id'];?>">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-trash" aria-hidden="true"></i> Kategorie löschen
                                    </button>
                                </dd>
                            </dl>
                        </form>
                        </div>
                    </div>
                </div>
            </div>
            <?php endif;?>

            <div class="row bottom-buffer">
            
            <?php if(isset($view['articles']) && !empty($view['articles'])):?>
                <?php foreach((array) $view['articles'] as $article):?>

                <?php if($_SESSION['role'] !== '1'):?>
                
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
                                </dd>
                            </dl>
                        </form>
                        </div>
                    </div>
                </div>

                <?php else:?>

                <div class="col-sm-12 col-md-12 bottom-buffer">
                <form action="<?=$view['url'];?>?rt=article&act=updateArticle&cat=<?=$view['articleCat']['id'];?>" method="post">
                    <div class="card articel">
                    
                        <input type="hidden" name="id" value="<?=$article['id'];?>">
                        <input type="hidden" name="cat_id" value="<?=$view['articleCat']['id'];?>">
                        <input type="hidden" name="image_url" value="<?=$article['image_url'];?>">
                        
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
                            <dl class="row">
                                <dt class="col-sm-2"><img width="120" height="120" src="<?=IMAGE_URL.$article['image_url'];?>"></dt>
                                <dd class="col-sm-9">
                                    <p class="card-text">
                                        <input type="text" name="article_name" value="<?=$article['article_name'];?>"> <label> : Name</label>
                                    </p>
                                    <p class="card-text">
                                        <input type="text" name="price" value="<?=$article['str_price'];?>"> <label> : € Preis</label>
                                    </p>
                                    <p class="card-text">
                                        
                                        <select name="delivery_status">
                                            <option value="0" <?php if((int) $article['delivery_status'] !== 1):?> selected<?php endif;?>>Nicht verfügbar</option>
                                            <option value="1" <?php if((int) $article['delivery_status'] === 1):?> selected<?php endif;?>>Verfügbar</option>
                                        </select> <label> : Lieferstatus</label>
                                    </p>
                                    <p class="card-text">
                                        <label>Beschreibung:</label><br>
                                        <textarea name="article_description"><?=$article['article_description'];?></textarea>
                                    </p>
                                </dd>
                            </dl>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-wrench" aria-hidden="true"></i> Änderungen speichern
                        </button>
                    </div>
                </form>
                </div>

                <?php endif;?>

                <?php endforeach;?>
            <?php endif;?>

            </div>
            