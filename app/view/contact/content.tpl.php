
    
    <form action="<?=$view['url'];?>?rt=contact&act=contact" class="needs-validation" method="post">
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
            <div class="row bottom-buffer">
                <div class="col-2"><label for="email">Email-Adesse:</label></div>
                <div class="col-6">
                    <input type="email" class="form-control" id="email" placeholder="Deine Email@Adressse" name="email" value="" required>
                    <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback">Deine Email-Adresse ist nicht korrekt!</div>
                </div>
            </div>
            <div class="row bottom-buffer">
                <div class="col-2"><label for="message">Deine Nachricht:</label></div>
                <div class="col-6">
                    <textarea class="form-control" id="message" placeholder="Deine Nachricht" name="message" value="" required></textarea>
                    <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback">Dein Passwort ist nicht korrekt!</div>
                </div>
            </div>
            <div class="row bottom-buffer">
                <div class="col-2"></div>
                <div class="col-6">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-sign-in-alt"></i> Nachricht senden</button>
                </div>
            </div>
        </div>
    </form> 