
<form action="<?=$view['url'];?>?rt=profil" class="needs-validation" method="post">
    <div class="container">
        <div class="row bottom-buffer">
            <div class="col-12">
                <h1><?=$view['pageTitle'];?></h1>
                <hr>
            </div>
        </div>
        <div class="row bottom-buffer">
            <div class="col-2"><label for="email">Email-Adesse:</label></div>
            <div class="col-6">
                <input type="email" class="form-control" id="email" placeholder="Deine Email@Adressse" name="email" value="<?=$view['profil']['email'];?>" required>
                <div class="valid-feedback">Valid.</div>
                <div class="invalid-feedback">Deine Email-Adresse ist nicht korrekt!</div>
            </div>
        </div>
        <div class="row bottom-buffer">
            <div class="col-2"><label for="email"></label></div>
            <div class="col-6">
                <button type="submit" class="btn btn-primary">
                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Speichern
                </button>
            </div>
        </div>
    </div>
</form> 

