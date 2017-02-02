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
<div class="container" ng-init="displayCategories()">
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
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="button" ng-click="insertCategory()" class="btn btn-default">{{ buttonName }}</button>
                </div>
            </div>


        </form>
        <br/>
        <label>Zoeken:</label>
        <input type="search" class="form-control" ng-model="searchUser" placeholder="Voer uw zoekopdracht in"> <br/>

        <table class="table table-striped">
            <thead>
            <tr>
                <th>Categorie</th>
                <th></th>
            </tr>
            </thead>
            <tbody>

            </tbody>
            <tr ng-repeat="category in categories | filter:searchCategory">
                <td>{{ category.name}}</td>
                <td>
                    <button class="btn btn-info" ng-click="updateCategory(category.id, category.name)"><span
                            class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Wijzig
                    </button>
                    <button class="btn btn-danger" ng-click="deleteCategory(category.id)"><span
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