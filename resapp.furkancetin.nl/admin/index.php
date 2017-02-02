<?php

if (isset($_SESSION['active'])) {
    if ($_SESSION['active'] == true) {
        if ($_SESSION['role'] == 'webmaster') {
            header("Location: http://resapp.furkancetin.nl/admin/users/");
            die();
        }else{
            header("Location: http://resapp.furkancetin.nl/admin/users/");
            die();
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en" ng-app="resApp">

<?php

include "template/head.php";

?>


<body ng-controller="resController">

<div class="container">

    <form class="form-signin">

        <img id="logo" src="http://resapp.furkancetin.nl/img/logo.png">


        <label for="username" class="sr-only">Gebruikersnaam</label>
        <input type="text" id="username" ng-model="username" name="username" class="form-control" placeholder="Gebruikersnaam" required autofocus>
        <label for="password" class="sr-only">Wachtwoord</label>
        <input type="password" id="password" ng-model="password" name="password" class="form-control" placeholder="Wachtwoord" required>
        <div class="checkbox">
            <label>
                <input type="checkbox" value="remember-me"> Herriner mij
            </label>
        </div>
        <button class="btn btn-lg btn-primary btn-block" type="button" ng-click="authenticateUser()">Aanmelden</button>
        <p style="color:{{message_color}};">{{message}}</p>
    </form>

</div> <!-- /container -->


<?php

include "template/footer.php";

?>
</body>
</html>