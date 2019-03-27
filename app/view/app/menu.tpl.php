

<header>
    <nav class="navbar navbar-expand-md fixed-top  bg-light">
        <a class="navbar-brand logo" href="<?=$view['url'];?>"><img src="<?=IMAGE_URL;?>logo.png" alt=""></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"><i class="fa fa-align-justify"></i></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            
            <?php include_once 'menu.page.tpl.php';?>
            <?php include_once 'menu.user.tpl.php';?>

            <form class="form-inline mt-2 mt-md-0" 
             action="<?=$view['url'];?>?rt=<?php if($_SESSION['role'] === '1'):?>shop<?php else:?>article<?php endif;?>&act=search" 
             method="post">
                <input class="form-control mr-sm-2" name="str_search" type="text" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Suche</button>
            </form>
        </div>
    </nav>
</header>