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

<div class="container" ng-init="displayTables();">
    <div class="starter-template">

        <form role="form" class="form-horizontal">
            <input type="hidden" ng-model="id">
            <div class="form-group">
                <label class="col-sm-2 control-label">Nummer:</label>
                <div class="col-sm-10">
                    <input type="number" ng-model="number" name="number" class="form-control">
                </div>
                <p style="color:{{message_color}}; text-align: center;">{{message}}</p>

            </div>


            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="button" ng-click="insertTable()" class="btn btn-default">{{ buttonName }}</button>
                </div>
            </div>


        </form>
        <br/>
        <label>Zoeken:</label>
        <input type="search" class="form-control" ng-model="searchTable" placeholder="Voer uw zoekopdracht in"> <br/>

        <table class="table table-striped">
            <thead>
            <tr>
                <th>Nummer</th>
                <th></th>
            </tr>
            </thead>
            <tbody>

            </tbody>
            <tr ng-repeat="table in tables | filter:searchTable">
                <td>{{ table.number }}</td>

                <td>
                    <button class="btn btn-info" ng-click="updateTable(table.id, table.number)"><span
                                class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Wijzig
                    </button>
                    <button class="btn btn-danger" ng-click="deleteTable(table.id)"><span
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