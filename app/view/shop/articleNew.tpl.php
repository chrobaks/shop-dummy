
<?php if (isset($view['formMsg'])):?>

<div class="row bottom-buffer">
    <div class="col-12">
        <p class="pfont-weight-bold text-green text-center"><?=$view["formMsg"];?></p>
    </div>
</div>

<?php endif;?>

<form action="<?=$view['url'];?>?rt=shop&act=addArticle&cat=0"  enctype="multipart/form-data" class="needs-validation" method="post" name="formArticleNew">
<input type="hidden" name="id" value="0">

<div class="row bottom-buffer">
        <div class="col-3"><label for="cat_id">Kategorie*:</label></div>
        <div class="col-6">
            <select class="form-control" id="cat_id" name="cat_id" value="" required>
                <option value="0" selected>Neue Kategorie anlegen</option>
                <?php foreach((array) $view['cats'] as $cat):?>
                <option value="<?=$cat['id'];?>"><?=$cat['cat_name'];?></option>
                <?php endforeach;?>
            </select>
            <div class="valid-feedback">Valid.</div>
            <div class="invalid-feedback">Der Artikelname ist nicht korrekt!</div>
        </div>
    </div>

    <div class="row bottom-buffer row-cat-name">
        <div class="col-3"><label for="cat_name">Kategoriename*:</label></div>
        <div class="col-6">
            <input type="text" class="form-control" id="cat_name" placeholder="Kategoriename" name="cat_name" value="">
        </div>
    </div>

    <div class="row bottom-buffer row-cat-name">
        <div class="col-3"><label for="description">Kategoriebeschreibung*:</label></div>
        <div class="col-6">
            <input type="text" class="form-control" id="description" placeholder="Kategoriebeschreibung" name="description" value="">
        </div>
    </div>

    <div class="row bottom-buffer">
        <div class="col-3"><label for="article_name">Artikelname*:</label></div>
        <div class="col-6">
            <input type="text" class="form-control" id="article_name" placeholder="Artikelname" name="article_name" value="" required>
            <div class="valid-feedback">Valid.</div>
            <div class="invalid-feedback">Der Artikelname ist nicht korrekt!</div>
        </div>
    </div>

    <div class="row bottom-buffer">
        <div class="col-3"><label for="price">Preis*:</label></div>
        <div class="col-6">
            <input type="text" class="form-control" id="price" placeholder="Artikelpreis" name="price" value="" required>
            <div class="valid-feedback">Valid.</div>
            <div class="invalid-feedback">Der Preis ist nicht korrekt!</div>
        </div>
    </div>

    <div class="row bottom-buffer">
        <div class="col-3"><label for="delivery_status">Lieferstatus*:</label></div>
        <div class="col-6">
            <select name="delivery_status" class="form-control" id="delivery_status" required>
                <option value="0">Nicht verfügbar</option>
                <option value="1" selected>Verfügbar</option>
            </select>
            <div class="valid-feedback">Valid.</div>
            <div class="invalid-feedback">Der Lieferstatus ist nicht korrekt!</div>
        </div>
    </div>

    <div class="row bottom-buffer">
        <div class="col-3"><label for="image_url ">Produkt-Bild:</label></div>
        <div class="col-6">
            <input type = "file" name = "image" />
        </div>
    </div>

    <div class="row bottom-buffer">
        <div class="col-3"><label for="article_description">Beschreibung* (max. 150 Zeichen):</label></div>
        <div class="col-6">
            <textarea type="text" max="150" class="form-control" id="article_description" placeholder="Artikel Beschreibung" name="article_description" required>
            </textarea>
            <div class="valid-feedback">Valid.</div>
            <div class="invalid-feedback">Die Beschreibung ist nicht korrekt!</div>
        </div>
    </div>

    <div class="row bottom-buffer">
        <div class="col-3"></div>
        <div class="col-6">
            <button type="submit" class="btn btn-primary"><i class="fa fa-sign-in-alt"></i> Produkt speichern</button>
        </div>
    </div>

</form> 