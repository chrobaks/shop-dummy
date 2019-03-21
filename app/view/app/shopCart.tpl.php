<!-- Modal -->
<?php 
    $disabled = (isset($_SESSION['shopCart']) && !empty($_SESSION['shopCart'])) ? '' : ' disabled';
?>
<div class="modal fade" id="shopCartModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle"><i class="fas fa-shopping-cart"></i>  Warenkorb</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body"></div>
            <div class="modal-msg"><p>Keine Artikel im Warenkorb!</p></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Schliessen</button>
                <button <?=$disabled;?> type="button" class="btn btn-primary btn-shop" data-act="rq=updateShopCart">Speichern</button>
                <button <?=$disabled;?> type="button" class="btn btn-primary btn-shop" data-act="rt=order">Zur Kasse</button>
                <button <?=$disabled;?> type="button" class="btn btn-warning btn-shop" data-act="rq=deleteShopCart">Leeren</button>
            </div>
        </div>
    </div>
</div>
