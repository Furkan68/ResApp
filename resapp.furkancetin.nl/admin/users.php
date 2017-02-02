<?php
include "template/check.php";

if(isset($_SESSION['role'])){
    if($_SESSION['role'] != 'webmaster'){
        header("Location: http://resapp.furkancetin.nl/admin/tables/");
        die();
    }
}
?>
<!DOCTYPE html>
    <html lang="en" ng-app="resApp">

<?php

include "template/head.php";

?>


<body ng-controller="resController">

<?php

include "template/menu.php";

?>

<div class="container" ng-init="displayUsers(); displayRestaurants();">
    <div class="starter-template">

        <form role="form" class="form-horizontal">
            <input type="hidden" ng-model="id">
            <div class="form-group">
                <label class="col-sm-2 control-label">Gebruikersnaam:</label>
                <div class="col-sm-10">
                    <input type="text" ng-model="username" name="username" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Wachtwoord:</label>
                <div class="col-sm-10"><input type="password" ng-model="password" name="password" class="form-control"
                    >
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Restaurants:</label>
                <div class="col-sm-10">
                    <select name="restaurants" ng-model="restaurantid" class="form-control" >
                        <option ng-repeat="restaurant in restaurants" value="{{restaurant.id}}">{{restaurant.name}}</option>
                    </select>
                </div>

                <p style="color:{{message_color}}; text-align: center;">{{message}}</p>
            </div>



            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="button" ng-click="insertUser()" class="btn btn-default">{{ buttonName }}</button>
                </div>
            </div>


        </form>
        <br/>
        <label>Zoeken:</label>
        <input type="search" class="form-control" ng-model="searchUser" placeholder="Voer uw zoekopdracht in"> <br/>

        <table class="table table-striped">
            <thead>
            <tr>
                <th>Gebruikersnaam</th>
                <th>Wachtwoord</th>
                <th>Restaurant</th>
                <th></th>
            </tr>
            </thead>
            <tbody>

            </tbody>
            <tr ng-repeat="user in users | filter:searchUser">
                <td>{{ user.username }}</td>
                <td>{{ user.password }}</td>
                <td>{{ user.restaurant }}</td>
                <td>
                    <button class="btn btn-info" ng-click="updateUser(user.id, user.username, user.password, user.restaurantid)"><span
                                class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Wijzig
                    </button>
                    <button class="btn btn-danger" ng-click="deleteUser(user.id)"><span
                                class="glyphicon glyphicon-remove" aria-hidden="true"></span> Verwijder
                    </button>
                </td>
            </tr>
        </table>
    </div>
</div>


<?php

include "template/footer.php";

?>
</body>
</html>