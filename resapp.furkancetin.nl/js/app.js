var app = angular.module('resApp', []);

app.controller('resController', function ($scope, $location, $window, $http, $timeout) {

    $scope.buttonName = "Toevoegen";
    $scope.searchObject = $location.search();

    // Login/Logout
    // ----------------------------------------------------------------------------------------------

    $scope.authenticateUser = function () {
        if ($scope.username == null || $scope.password == null) {
            $scope.message_color = "red";
            $scope.message = "Alle velden zijn verplicht.";
        } else {
            $http.post('http://resapp.furkancetin.nl/api/authenticator.php', {
                'username': $scope.username, //ng-model of textbox name
                'password': $scope.password //ng-model of textbox email
            })
                .success(function (data) {
                    console.log(data);

                    if (data['active'] == true) {
                        if (data['role'] == 'webmaster') {
                            $window.location.href = 'http://resapp.furkancetin.nl/admin/users/';
                        } else {
                            $window.location.href = 'http://resapp.furkancetin.nl/admin/orders/';
                        }
                    }

                    if (data['active'] == false) {
                        $scope.message_color = "red";
                        $scope.message = "Uw gebruikersnaam of wachtwoord is onjuist.";
                    }
                })
                .error(function () {
                    console.log("Error");
                })
        }
    };

    $scope.logoutUser = function () {
        $http.get('http://resapp.furkancetin.nl/api/logout.php')
            .success(function (data) {
                $window.location.href = 'http://resapp.furkancetin.nl/admin/login/';
            })
    };

    // SELECT
    // ----------------------------------------------------------------------------------------------

    $scope.displayUsers = function () {
        $http.get('http://resapp.furkancetin.nl/api/select.php', {
            params: {
                section: 'users'
            }
        })
            .success(function (data) {
                $scope.users = data;

            })
    };

    $scope.displayRestaurants = function () {
        $http.get('http://resapp.furkancetin.nl/api/select.php', {
            params: {
                section: 'restaurants'
            }
        })
            .success(function (data) {
                $scope.restaurants = data;
            })
    };

    $scope.displayTables = function () {
        $http.get('http://resapp.furkancetin.nl/api/session.php')
            .success(function (session) {
                $http.get('http://resapp.furkancetin.nl/api/select.php', {
                    params: {
                        section: 'tables',
                        restaurantid: session.restaurantid
                    }
                })
                    .success(function (data) {
                        $scope.tables = data;
                    })
            });
    };


    $scope.displayCategories = function () {
        $http.get('http://resapp.furkancetin.nl/api/session.php')
            .success(function (session) {
                $http.get('http://resapp.furkancetin.nl/api/select.php', {
                    params: {
                        section: 'categories',
                        restaurantid: session.restaurantid
                    }
                })
                    .success(function (data) {
                        $scope.categories = data;
                    })
            });
    };

    $scope.displayProducts = function () {
        $http.get('http://resapp.furkancetin.nl/api/session.php')
            .success(function (session) {
                $http.get('http://resapp.furkancetin.nl/api/select.php', {
                    params: {
                        section: 'products',
                        restaurantid: session.restaurantid
                    }
                })
                    .success(function (data) {
                        $scope.products = data;
                        console.log(data);
                    })
            });
    };

    $scope.displayProductsByCategory = function () {
        console.log($scope.category);
        $http.get('http://resapp.furkancetin.nl/api/session.php')
            .success(function (session) {
                $http.get('http://resapp.furkancetin.nl/api/select.php', {
                    params: {
                        section: 'productsbycategory',
                        restaurantid: session.restaurantid,
                        categoryid: $scope.category
                    }
                })
                    .success(function (data) {
                        $scope.products = data;
                        $scope.amount = 1;
                        console.log(data);
                    })
            });
    };

    $scope.displayOrders = function () {
        $http.get('http://resapp.furkancetin.nl/api/session.php')
            .success(function (session) {
                $http.get('http://resapp.furkancetin.nl/api/select.php', {
                    params: {
                        section: 'orders',
                        restaurantid: session.restaurantid,
                        tableid: session.tableid
                    }
                })
                    .success(function (data) {
                        $scope.orders = data;
                        console.log(data);
                        $timeout($scope.displayOrders, 2000);
                    })
            });
    };

    $scope.displayOrdersByUser = function () {
        $http.get('http://resapp.furkancetin.nl/api/session.php')
            .success(function (session) {
                $http.get('http://resapp.furkancetin.nl/api/select.php', {
                    params: {
                        section: 'ordersForUser',
                        restaurantid: session.restaurantid
                    }
                })
                    .success(function (data) {
                        $scope.orders = data;
                        console.log(data);
                        $timeout($scope.displayOrdersByUser, 1000);
                    })
            });
    };
    // INSERT
    // ----------------------------------------------------------------------------------------------

    $scope.insertUser = function () {
        if ($scope.username == null || $scope.password == null || $scope.restaurantid == null) {
            $scope.message_color = "red";
            $scope.message = "Alle velden zijn verplicht.";
        } else {
            $http.post('http://resapp.furkancetin.nl/api/insert.php?section=users', {
                'username': $scope.username, //ng-model of textbox name
                'password': $scope.password, //ng-model of textbox email
                'restaurantid': $scope.restaurantid, //ng-model of textbox email
                'buttonName': $scope.buttonName, //ng-model of button
                'id': $scope.id //hidden id
            })
                .success(function () {
                    $scope.message_color = "green";
                    $scope.message = "Success.";
                    $scope.username = null; //reset textbox values
                    $scope.password = null; //reset textbox values
                    $scope.restaurantid = null; //reset textbox values
                    $scope.buttonName = "Toevoegen"; //Change textbox value to Add
                    $scope.displayUsers(); //Update the users table
                })
                .error(function () {
                    console.log("Error");
                })
        }
    };

    $scope.insertRestaurant = function () {
        if ($scope.name == null) {
            $scope.message_color = "red";
            $scope.message = "Alle velden zijn verplicht.";
        } else {
            $http.post('http://resapp.furkancetin.nl/api/insert.php?section=restaurants', {
                'name': $scope.name, //ng-model of textbox name
                'buttonName': $scope.buttonName, //ng-model of button
                'id': $scope.id //hidden id
            })
                .success(function () {
                    $scope.message_color = "green";
                    $scope.message = "Success.";
                    $scope.name = null; //reset textbox values
                    $scope.buttonName = "Toevoegen"; //Change textbox value to Add
                    $scope.displayRestaurants(); //Update the users table
                })
                .error(function () {
                    console.log("Error");
                })
        }
    };

    $scope.insertTable = function () {
        if ($scope.number == null) {
            $scope.message_color = "red";
            $scope.message = "Alle velden zijn verplicht.";
        } else {
            $http.post('http://resapp.furkancetin.nl/api/insert.php?section=tables', {
                'number': $scope.number, //ng-model of textbox name
                'buttonName': $scope.buttonName, //ng-model of button
                'id': $scope.id //hidden id
            })
                .success(function () {
                    $scope.message_color = "green";
                    $scope.message = "Success.";
                    $scope.number = null; //reset textbox values
                    $scope.buttonName = "Toevoegen"; //Change textbox value to Add
                    $scope.displayTables(); //Update the users table
                })
                .error(function () {
                    console.log("Error");
                })
        }
    };

    $scope.insertCategory = function () {
        if ($scope.name == null) {
            $scope.message_color = "red";
            $scope.message = "Alle velden zijn verplicht.";
        } else {
            $http.post('http://resapp.furkancetin.nl/api/insert.php?section=categories', {
                'name': $scope.name, //ng-model of textbox name
                'buttonName': $scope.buttonName, //ng-model of button
                'id': $scope.id //hidden id
            })
                .success(function () {
                    $scope.message_color = "green";
                    $scope.message = "Success.";
                    $scope.name = null; //reset textbox values
                    $scope.buttonName = "Toevoegen"; //Change textbox value to Add
                    $scope.displayCategories(); //Update the users table
                })
                .error(function () {
                    console.log("Error");
                })
        }
    };

    $scope.insertProduct = function () {
        if ($scope.name == null || $scope.price == null || $scope.categoryid == null) {
            $scope.message_color = "red";
            $scope.message = "Alle velden zijn verplicht.";
        } else {
            $http.post('http://resapp.furkancetin.nl/api/insert.php?section=products', {
                'name': $scope.name, //ng-model of textbox name
                'description': $scope.description, //ng-model of textbox email
                'price': $scope.price, //ng-model of textbox email
                'categoryid': $scope.categoryid, //ng-model of textbox email
                'buttonName': $scope.buttonName, //ng-model of button
                'id': $scope.id //hidden id
            })
                .success(function () {
                    $scope.message_color = "green";
                    $scope.message = "Success.";
                    $scope.name = null; //reset textbox values
                    $scope.description = null; //reset textbox values
                    $scope.price = null; //reset textbox values
                    $scope.categoryid = null; //reset textbox values
                    $scope.buttonName = "Toevoegen"; //Change textbox value to Add
                    $scope.displayProducts(); //Update the users table
                })
                .error(function () {
                    console.log("Error");
                })
        }
    };

    $scope.insertOrder = function (id, amount) {
        console.log('amount : ' + amount);
        console.log('product : ' + id);
        if (amount == null || id == null) {
            $scope.message_color = "red";
            $scope.message = "Aantal is verplicht.";
        } else {
            $http.post('http://resapp.furkancetin.nl/api/insert.php?section=order', {
                'productid': id, //ng-model of textbox name
                'amount': amount, //ng-model of textbox email
                'id': $scope.id //hidden id
            })
                .success(function (data) {
                    $scope.message_color = "green";
                    $scope.message = "Successvol verstuurd.";
                })
                .error(function () {
                    console.log("Error");
                })
        }
    };

    // UPDATE
    // ----------------------------------------------------------------------------------------------

    $scope.updateUser = function (id, username, password, restaurantid) {
        $scope.id = id;
        $scope.username = username;
        $scope.password = password;
        $scope.restaurantid = restaurantid;
        $scope.buttonName = "Bijwerken";
    };

    $scope.updateRestaurant = function (id, name) {
        $scope.id = id;
        $scope.name = name;
        $scope.buttonName = "Bijwerken";
    };

    $scope.updateTable = function (id, number) {
        $scope.id = id;
        $scope.number = number;
        $scope.buttonName = "Bijwerken";
    };

    $scope.updateCategory = function (id, name) {
        $scope.id = id;
        $scope.name = name;
        $scope.buttonName = "Bijwerken";
    };

    $scope.updateProduct = function (id, name, description, price, categoryid) {
        $scope.id = id;
        $scope.name = name;
        $scope.description = description;
        $scope.price = price;
        $scope.categoryid = categoryid;
        $scope.buttonName = "Bijwerken";
    };

    // DELETE
    // ----------------------------------------------------------------------------------------------

    $scope.deleteUser = function (id) {
        if (confirm("Weet u zeker dat u het wilt verwijderen?")) {
            $http.post("http://resapp.furkancetin.nl/api/delete.php?section=users", {'id': id})
                .success(function () {
                    $scope.message_color = "orange";
                    $scope.message = "Succesvol verwijderd.";
                    $scope.displayUsers();
                })
                .error(function () {
                    console.log("Error");
                })
        }
        else {
            return false;
        }
    };

    $scope.deleteRestaurant = function (id) {
        if (confirm("Weet u zeker dat u het wilt verwijderen?")) {
            $http.post("http://resapp.furkancetin.nl/api/delete.php?section=restaurants", {'id': id})
                .success(function () {
                    $scope.message_color = "orange";
                    $scope.message = "Succesvol verwijderd.";
                    $scope.displayRestaurants();
                })
                .error(function () {
                    console.log("Error");
                })
        }
        else {
            return false;
        }
    };

    $scope.deleteTable = function (id) {
        if (confirm("Weet u zeker dat u het wilt verwijderen?")) {
            $http.post("http://resapp.furkancetin.nl/api/delete.php?section=tables", {'id': id})
                .success(function () {
                    $scope.message_color = "orange";
                    $scope.message = "Succesvol verwijderd.";
                    $scope.displayTables();
                })
                .error(function () {
                    console.log("Error");
                })
        }
        else {
            return false;
        }
    };

    $scope.deleteCategory = function (id) {
        if (confirm("Weet u zeker dat u het wilt verwijderen?")) {
            $http.post("http://resapp.furkancetin.nl/api/delete.php?section=categories", {'id': id})
                .success(function () {
                    $scope.message_color = "orange";
                    $scope.message = "Succesvol verwijderd.";
                    $scope.displayCategories();
                })
                .error(function () {
                    console.log("Error");
                })
        }
        else {
            return false;
        }
    };

    $scope.deleteProduct = function (id) {
        if (confirm("Weet u zeker dat u het wilt verwijderen?")) {
            $http.post("http://resapp.furkancetin.nl/api/delete.php?section=categories", {'id': id})
                .success(function () {
                    $scope.message_color = "orange";
                    $scope.message = "Succesvol verwijderd.";
                    $scope.displayProducts();
                })
                .error(function () {
                    console.log("Error");
                })
        }
        else {
            return false;
        }
    };

    $scope.deleteOrder = function (id) {
        // if (confirm("Weet u zeker dat u het wilt verwijderen?")) {
        $http.post("http://resapp.furkancetin.nl/api/delete.php?section=orders", {'id': id})
            .success(function () {
                $scope.displayOrders();
            })
            .error(function () {
                console.log("Error");
            });
        // }
        // else {
        //     return false;
        // }
    };

    // OTHERS
    // ----------------------------------------------------------------------------------------------
    $scope.deliveredOrder = function (id) {
        $http.post("http://resapp.furkancetin.nl/api/update.php?section=delivered", {'id': id})
            .success(function () {
                $scope.displayOrdersByUser();
            })
            .error(function () {
                console.log("Error");
            });
    };

    $scope.inprogressOrder = function (id) {
        $http.post("http://resapp.furkancetin.nl/api/update.php?section=inprogress", {'id': id})
            .success(function () {
                $scope.displayOrdersByUser();
            })
            .error(function () {
                console.log("Error");
            });
    };

});
