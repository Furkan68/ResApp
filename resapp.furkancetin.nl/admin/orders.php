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

<div class="container" ng-init="displayOrdersByUser();">
    <div class="starter-template">

        <ul class="list-group">
            <li ng-repeat="order in orders" class="list-group-item">
                <div class="row">
                    <div class="col-xs-9">
                        <h5 class="list-group-item-heading">Tafel {{order.tablenumber}}</h5>
                        <p class="list-group-item-text">
                            {{order.amount}} x {{ order.product }}
                        </p>
                    </div>
                    <div class="col-xs-3">

                        <button ng-if="order.inprogress == 0" ng-click="inprogressOrder(order.id)" type="button" class="btn btn-primary" >
                            <span class="glyphicon glyphicon-hourglass" aria-hidden="true"></span>
                        </button>

                        <button ng-if="order.inprogress != 0" ng-click="deliveredOrder(order.id)" type="button" class="btn btn-success">
                            <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
                        </button>

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