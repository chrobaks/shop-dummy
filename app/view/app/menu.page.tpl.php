            
            <?php $active = '';?>
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <?php if(isset($view['page']) && !empty($view['page'])):?>
                    <?php
                        $active = ($view['page'] === 'home') ? ' text-green' : '';
                    ?>
                    <?php endif;?>
                    <a class="nav-link <?=$active;?>" href="<?=$view['url'];?>"><i class="fa fa-home"></i></a>
                </li>
                <?php $active = ''; ?>
                <?php if(isset($view['cats']) && !empty($view['cats'])):?>

                <?php if($_SESSION['role'] === '1'):?>
                <?php $active = ($view['page'] === 'article') ? ' text-green' : '';?>

                <li class="nav-item dropdown">
                        <a
                            class="nav-link dropdown-toggle <?=$active;?>" 
                            data-toggle="dropdown"
                            href="#" 
                            title="Produkte bearbeiten">
                            Produkte
                            <i class="fa fa-shopping-basket"></i>
                            
                        </a>
                        
                    <?php $active = ''; ?>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="<?=$view['url'];?>?rt=shop&act=addArticle&cat=0">Neues Produkt</a>
                    <?php foreach((array) $view['cats'] as $cat):?>

                        <?php if(isset($view['articleCat']) && !empty($view['articleCat'])):?>
                        <?php $active = ((int) $cat['id'] === (int) $view['articleCat']['id']) ? ' text-green' : ''; ?>
                        <?php endif;?>

                        <a class="dropdown-item <?=$active;?>" href="<?=$view['url'];?>?rt=shop&act=category&cat=<?=$cat['id'];?>"><?=$cat['cat_name'];?></a>

                        <?php endforeach;?>
                        
                        <?php $active = ''; ?>
                    </div>
                </li>

                <?php $active = ($view['page'] === 'users') ? ' text-green' : '';?>
                <li class="nav-item dropdown">
                        <a
                            class="nav-link dropdown-toggle <?=$active;?>" 
                            data-toggle="dropdown"
                            href="#" 
                            title="Benutzer bearbeiten">
                            Benutzer
                            <i class="fa fa-users"></i>
                            
                        </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="<?=$view['url'];?>?rt=user&act=allUser">Alle Benutzer</a>
                        <a class="dropdown-item" href="<?=$view['url'];?>?rt=user&act=allOrder">Alle Bestellungen</a>
                    
                    </div>
                </li>
                <?php else:?>

                <?php foreach((array) $view['cats'] as $cat):?>

                <?php if(isset($view['articleCat']) && !empty($view['articleCat'])):?>
                <?php $active = ((int) $cat['id'] === (int) $view['articleCat']['id']) ? ' text-green' : ''; ?>
                <?php endif;?>

                <li class="nav-item">
                    <a class="nav-link <?=$active;?>" href="<?=$view['url'];?>?rt=article&act=category&cat=<?=$cat['id'];?>"><?=$cat['cat_name'];?></a>
                </li>

                <?php endforeach;?>

                <?php endif;?>

                <?php endif;?>

            </ul>