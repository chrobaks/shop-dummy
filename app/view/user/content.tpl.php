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
                <p class="pfont-weight-bold text-green text-center"><?=$view["formMsg"];?></p>
            </div>
        </div>

        <?php endif;?>

        
        <?php if (isset($view['user'])):?>

        <div class="row bottom-buffer">
            <div class="col-12">
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">User-Email</th>
                            <th scope="col">User-Role</th>
                            <th scope="col">Create At</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach($view['user'] as $user):?>
                        <tr>
                        <th scope="row"><?=$user['id'];?></th>
                        <td><?=$user['email'];?></td>
                        <td><?php if($user['role'] === '0'):?>Benutzer<?php else:?>Admin<?php endif;?></td>
                        <td><?=$user['createAt'];?></td>
                        </tr>
                    <?php endforeach;?>
                    </tbody>
                </table>
            </div>
        </div>

        <?php else:?>

        <div class="row bottom-buffer">
            <div class="col-12">
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">Bestellungs-ID</th>
                            <th scope="col">User-Email</th>
                            <th scope="col">Zahlungsart</th>
                            <th scope="col">Betrag</th>
                            <th scope="col">Bestellungsdatum</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach($view['userOrder'] as $order):?>
                        <tr>
                        <th scope="row"><?=$order['id'];?></th>
                        <td><?=$order['email'];?></td>
                        <td><?=$order['payment_type'];?></td>
                        <td><?=str_replace('.',',',$order['order_price']);?> €</td>
                        <td><?=$order['createAt'];?></td>
                        </tr>
                    <?php endforeach;?>
                    </tbody>
                </table>
            </div>
        </div>

        <?php endif;?>
        
    </div>