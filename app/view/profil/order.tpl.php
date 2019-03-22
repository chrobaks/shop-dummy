        <div class="row bottom-buffer">
            <div class="col-12">
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">Bestellungs-ID</th>
                            <th scope="col">Zahlungsart</th>
                            <th scope="col">Betrag</th>
                            <th scope="col">Bestellungsdatum</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach($view['userOrder'] as $order):?>
                        <tr>
                        <th scope="row"><?=$order['id'];?></th>
                        <td><?=$order['payment_type'];?></td>
                        <td><?=str_replace('.',',',$order['order_price']);?> €</td>
                        <td><?=$order['createAt'];?></td>
                        </tr>
                    <?php endforeach;?>
                    </tbody>
                </table>
            </div>
        </div>