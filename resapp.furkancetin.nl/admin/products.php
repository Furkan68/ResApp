<?php
include "template/check.php";
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

<div class="container" ng-init="displayProducts(); displayCategories();">
    <div class="starter-template">

        <form role="form" class="form-horizontal">
            <input type="hidden" ng-model="id">
            <div class="form-group">
                <label class="col-sm-2 control-label">Naam:</label>
                <div class="col-sm-10">
                    <input type="text" ng-model="name" name="name" class="form-control">
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label">Beschrijving:</label>
                <div class="col-sm-10">
                    <textarea ng-model="description" name="description" class="form-control" rows="3"></textarea>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label">Prijs:</label>
                <div class="col-sm-10">
                    <input type="number" step='0.01' ng-model="price" name="price" class="form-control">
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label">Categorie:</label>
                <div class="col-sm-10">
                    <select name="categories" ng-model="categoryid" class="form-control" >
                        <option ng-repeat="category in categories" value="{{category.id}}">{{category.name}}</option>
                    </select>
                </div>

                <p style="color:{{message_color}}; text-align: center;">{{message}}</p>
            </div>


            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="button" ng-click="insertProduct()" class="btn btn-default">{{ buttonName }}</button>
                </div>
            </div>


        </form>
        <br/>
        <label>Zoeken:</label>
        <input type="search" class="form-control" ng-model="searchProduct" placeholder="Voer uw zoekopdracht in"> <br/>

        <table class="table table-striped">
            <thead>
            <tr>
                <th>Naam</th>
                <th>Beschrijving</th>
                <th>Prijs €</th>
                <th>Categorie</th>
                <th></th>
            </tr>
            </thead>
            <tbody>

            </tbody>
            <tr ng-repeat="product in products | filter:searchProduct">
                <td>{{ product.name }}</td>
                <td>{{ product.description }}</td>
                <td>€ <b>{{ product.price | number:2 }}</b></td>
                <td>{{ product.category }}</td>
                <td>
                    <button class="btn btn-info" ng-click="updateProduct(product.id, product.name, product.description, product.price, product.categoryid)"><span
                            class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Wijzig
                    </button>
                    <button class="btn btn-danger" ng-click="deleteProduct(product.id)"><span
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