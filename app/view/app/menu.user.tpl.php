            
            <?php $active = '';?>
            <ul class="navbar-nav nav-right">
                <li class="nav-item dropdown">
                    <?php if(isset($view['page']) && !empty($view['page'])):?>
                    <?php
                        $active = ($view['page'] === 'login' || $view['page'] === 'profil') ? ' text-green' : '';
                    ?>
                    <?php endif;?>
                    <a
                        class="nav-link dropdown-toggle <?=$active;?>" 
                        data-toggle="dropdown"
                        href="#" 
                        title="Benutzerprofil"><i class="fa fa-user"></i>
                        <?php if(isset($_SESSION['user']) && !empty($_SESSION['user'])):?>
                        
                            <small><?=$_SESSION['user'];?></small>
                        
                        <?php endif;?>
                    </a>
                    <div class="dropdown-menu">
                        <?php if($_SESSION['role'] === '-1'):?>
                        <a class="dropdown-item" href="<?=$view['url'];?>?rt=login">Login</a>
                        <?php else:?>
                            <?php if(isset($view['userHasOrder']) && $view['userHasOrder'] === true):?>
                            <a class="dropdown-item" href="<?=$view['url'];?>?rt=profil&act=order">Bestellungen</a>
                            <?php endif;?>
                        <a class="dropdown-item" href="<?=$view['url'];?>?rt=profil&act=profil">Einstellungen</a>
                        <a class="dropdown-item" href="<?=$view['url'];?>?rt=logout">Logout</a>
                        <?php endif;?>
                    </div>
                </li>
                <?php if($_SESSION['role'] !== '1'):?>
                <li class="nav-item">
                    <a href="#" class="nav-link" data-toggle="modal" data-target="#shopCartModal" title="Warenkorb"><i class="fas fa-shopping-cart"></i></a>
                </li>
                <?php endif;?>
            </ul>