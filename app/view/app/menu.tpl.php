

<header>
    <nav class="navbar navbar-expand-md fixed-top  bg-light">
        <a class="navbar-brand logo" href="<?=$view['url'];?>"><img src="<?=IMAGE_URL;?>logo.png" alt=""></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"><i class="fa fa-align-justify"></i></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            
            <?php include_once 'menu.page.tpl.php';?>
            <?php include_once 'menu.user.tpl.php';?>

            <form class="form-inline mt-2 mt-md-0">
                <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>
        </div>
    </nav>
</header>