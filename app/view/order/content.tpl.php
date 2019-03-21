<div class="container">
        <div class="row bottom-buffer">
            <div class="col-12">
                <h1><?=$view['pageTitle'];?></h1>
                <hr>
            </div>
        </div>
        <div class="row bottom-buffer">
            <?php if(isset($view['orderShopCart'])):?>
            
            <?php foreach((array) $view['orderShopCart'] as $article):?>

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
                    <form action="<?=$view['url'];?>?rq=updateOrder" method="post" class="formAjax" name="artclForm<?=$article['id'];?>">
                        <dl class="row">
                            <dt class="col-sm-2"><img width="120" height="120" src="<?=IMAGE_URL.$article['image_url'];?>"></dt>
                            <dd class="col-sm-9">
                                <div class="card-text">
                                    <b>Preis:</b> <span id="price_sum"><?=$article['str_price'];?></span> €
                                    <div class="float-right"><b>Artikel-Nr:</b> <?=$article['id'];?></div>
                                </div>
                                <div class="card-text clearfix">
                                        
                                    <p>
                                        <h5>Beschreibung:</h5>
                                        <?=$article['article_description'];?>
                                    </p>
                                    <label for="article_count">Anzahl : </label>
                                    <input type="hidden" name="id" value="<?=$article['id'];?>">
                                    <input type="hidden" name="basic_price" value="<?=$article['price'];?>">
                                    <input type="number" name="article_count" id="article_count" min="1" value="<?=$view['shopCountList'][$article['id']];?>">
                                    <button type="submit" class="btn btn-primary btn-sm">
                                        <i class="fa fa-wrench" aria-hidden="true"></i> Speichern
                                    </button>
                                    <span class="form-msg shopOrder text-green font-weight-bold"></span>
                                </div>
                            </dd>
                        </dl>
                    </form>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-trash" aria-hidden="true"></i> Entfernen</button>
                    </div>
                </div>
            </div>

            <?php endforeach;?>

            <div class="col-sm-12 col-md-12 bottom-buffer">
                <div class="card articel">
                    <div class="card-header font-weight-bold">Bestellung / Gesamtpreis</div>
                    <div class="card-body">
                    <dl class="row">
                    <dt class="col-sm-2 font-weight-bold">Gesamtpreis</dt>
                    <dd id="order-sum" class="col-sm-9 font-weight-bold text-right text-green"><?=$view["orderSum"];?> €</dd>
                    </dl>
                    </div>
                    <div class="card-footer">
                        <a type="button" href="<?=$view['url'];?>?rt=payment" class="btn btn-primary"><i class="fa fa-arrow-circle-right" aria-hidden="true"></i> zur Zahlungs-Einstellung</a>
                        <a type="button" href="#" class="btn btn-primary"><i class="fa fa-trash" aria-hidden="true"></i> Bestellung löschen</a>
                    </div>
                </div>
            </div>
            <?php endif;?>
        </div>
    </div>