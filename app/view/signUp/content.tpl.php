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

        <form action="<?=$view['url'];?>?rt=signUp&act=signUp" class="needs-validation" method="post">
        <div class="row bottom-buffer">
            <div class="col-2"><label for="email">Email-Adesse:</label></div>
            <div class="col-6">
                <input type="email" class="form-control" id="email" placeholder="Deine Email@Adressse" name="email" required>
                <div class="valid-feedback">Valid.</div>
                <div class="invalid-feedback">Deine Email-Adresse ist nicht korrekt!</div>
            </div>
        </div>
        <div class="row bottom-buffer">
            <div class="col-2"><label for="pass">Dein Password:</label></div>
            <div class="col-6">
                <input type="password" class="form-control" id="pass" placeholder="Dein Passwort" name="pass" required>
                <div class="valid-feedback">Valid.</div>
                <div class="invalid-feedback">Dein Passwort ist nicht korrekt!</div>
            </div>
        </div>
        <div class="row bottom-buffer">
            <div class="col-2"></div>
            <div class="col-6">
                <button type="submit" class="btn btn-primary">
                    <i class="fa fa-user-plus" aria-hidden="true"></i> Registrieren
                </button>
            </div>
        </div>
        </form> 

</div>

