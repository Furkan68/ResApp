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
                <li <? if ($active == 'index') {echo 'class="active"';} ?>><a href="index.php">Menu</a></li>
                <li <? if ($active == 'orders') {echo 'class="active"';} ?>><a href="orders.php">Bestellingen</a></li>
            </ul>
            <p style="color: white; margin: 15px 0;" class="text-right">
                Restaurant : <?php if(isset($_SESSION['restaurant'])){echo $_SESSION['restaurant'];}; ?> &nbsp;|&nbsp;
                Tafelnummer : <?php if(isset($_SESSION['tablenumber'])){echo $_SESSION['tablenumber'];}; ?>
            </p>

        </div><!--/.nav-collapse -->
    </div>
</nav>