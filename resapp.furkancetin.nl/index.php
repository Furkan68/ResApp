<?php
session_start();

if (!isset($_SESSION['restaurantid'])) {
    include "api/createsession.php";
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

<div class="container" ng-init="displayProductsByCategory(); displayCategories();">


    <div class="starter-template">
        <form role="form" class="form-horizontal">
            <div class="form-group">
                <label class="col-sm-2 control-label">Zoeken:</label>
                <div class="col-sm-10"><input type="search" class="form-control" ng-model="searchProduct"
                                              placeholder="Voer uw zoekopdracht in"></div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Filter:</label>
                <div class="col-sm-10">
                    <select ng-model="category" class="form-control" ng-change="displayProductsByCategory()">
                        <option value="0" selected="selected">Alles</option>
                        <option ng-repeat="category in categories" value="{{category.id}}">{{category.name}}</option>
                    </select>
                </div>
            </div>

            <p style="color:{{message_color}}; text-align: center;">{{message}}</p>
        </form>

        <ul class="list-group">

            <li ng-repeat="product in products | filter:searchProduct" class="list-group-item">
                <div class="row">
                    <div class="col-xs-6">
                        <h5 class="list-group-item-heading">{{ product.name }}</h5>
                        <p class="list-group-item-text">
                            € <b>{{ product.price | number:2 }}</b>
                        </p></div>
                    <div class="col-xs-6">
                        <form role="form" novalidate>
                            <input type="hidden" ng-model="id">

                            <label for="amount" class="sr-only">Aantal</label>
                            <input type="number" id="amount" name="amount" ng-model="amount" min="1" max="20" step="1">

                            <button type="button" ng-click="insertOrder(product.id, amount)" class="btn btn-success">
                                Bestel
                            </button>
                        </form>
                    </div>
                </div>
            </li>

        </ul>
    </div>
</div>


<?php

include "template/footer.php";

?>
</body>
</html>