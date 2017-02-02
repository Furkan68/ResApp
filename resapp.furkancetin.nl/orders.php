<?php

session_start();

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

<div class="container" ng-init="displayOrders();">
    <div class="starter-template">

        <p style="color:{{message_color}}; text-align: center;">{{message}}</p>

        <ul class="list-group">
            <li ng-repeat="order in orders" class="list-group-item">
                <div class="row">
                    <div class="col-xs-9">
                        <h5 class="list-group-item-heading">{{order.amount}} x {{ order.product }}</h5>
                        <p class="list-group-item-text">
                            {{order.amount}} x € <b>{{ order.productprice | number:2 }}</b> =
                            {{order.amount*order.productprice | number:2}}
                        </p>
                    </div>
                    <div class="col-xs-3">

                        <button ng-if="order.inprogress == 0" ng-click="deleteOrder(order.id)" type="button" class="btn btn-danger" >
                            <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                        </button>

                        <button ng-if="order.inprogress != 0" type="button" class="btn btn-default" disabled>
                            <span class="glyphicon glyphicon-hourglass" aria-hidden="true"></span>
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