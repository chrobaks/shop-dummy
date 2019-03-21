<div class="container">
    <div class="row bottom-buffer">
        <div class="col-12">
            <h1><?=$view['pageTitle'];?></h1>
            <hr>
        </div>
    </div>
    <div class="row bottom-buffer">
        <div class="col-sm-12 col-md-12 bottom-buffer">
            <div class="card articel">
                <form action="<?=$view['url'];?>?rt=payment" method='post'>
                <div class="card-header font-weight-bold"><?=$view['pageTitle'];?></div>
                <div class="card-body">

                    <?php if (!isset($view['formMsg'])):?>

                    <dl class="row">
                        <dt class="col-sm-2 font-weight-bold"><label for="user_id"> Benutzer:</label></dt>
                        <dd class="col-sm-9">
                            <input readonly type="text" value="<?=$_SESSION['user'];?>">
                        </dd>
                    </dl>
                    <dl class="row">
                        <dt class="col-sm-2 font-weight-bold"><label for="payment_type"> Zahlungsart:</label></dt>
                        <dd class="col-sm-9">
                            <select name="payment_type" id="payment_type">
                                <option value="paypal" selected>Paypal</option>
                                <option value="credit">Kreditkarte</option>
                            </select>
                        </dd>
                    </dl>
                    <dl class="row">
                        <dt class="col-sm-2 font-weight-bold">Gesamtpreis:</dt>
                        <dd class="col-sm-9 font-weight-bold text-green"><?=$view["orderSum"];?> €</dd>
                    </dl>

                    <?php else:?>
                    
                    <dl class="row">
                        <dd class="col-sm-12 font-weight-bold text-green text-center"><?=$view["formMsg"];?></dd>
                    </dl>

                    <?php endif;?>

                </div>
                <div class="card-footer">
                    <?php if (!isset($view['formMsg'])):?>
                    <a type="button" href="<?=$view['url'];?>?rt=order" class="btn btn-primary"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i> Zurück zum Warenkorb</a>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-arrow-circle-right" aria-hidden="true"></i> Jetzt kostenpflichtig bestellen</button>
                    <a type="button" href="#" class="btn btn-primary"><i class="fa fa-trash" aria-hidden="true"></i> Leeren</a>
                    <?php endif;?>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>