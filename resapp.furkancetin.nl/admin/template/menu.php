<?php
$active = basename($_SERVER["SCRIPT_FILENAME"], '.php');
?>

<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
                    aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">
                ResApp
            </a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <?php if (isset($_SESSION['role'])) {
                    if ($_SESSION['role'] == 'webmaster') { ?>
                        <li <? if ($active == 'users') {echo 'class="active"';} ?>><a href="/admin/users/">Gebruikers</a></li>
                        <li <? if ($active == 'restaurants') {echo 'class="active"';} ?>><a href="/admin/restaurants/">Restaurants</a></li>
                    <?php } else { ?>
                        <li <? if ($active == 'orders') {echo 'class="active"';} ?>><a href="/admin/orders/">Bestellingen</a></li>
                        <li <? if ($active == 'tables') {echo 'class="active"';} ?>><a href="/admin/tables/">Tafels</a></li>
                        <li <? if ($active == 'categories') {echo 'class="active"';} ?>><a href="/admin/categories/">Categorieën</a></li>
                        <li <? if ($active == 'products') {echo 'class="active"';} ?>><a href="/admin/products/">Producten</a></li>
                    <?php }
                } ?>
            </ul>

            <p style="color: white; margin: 8px 0;" class="text-right">
                Hallo, <?php echo $_SESSION['username']; ?> &nbsp;&nbsp;
                <button type="button" ng-click="logoutUser()" class="btn btn-danger">Afmelden</button>
            </p>
        </div><!--/.nav-collapse -->

    </div>
</nav>