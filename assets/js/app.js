var app = angular.module('blog', []);

app.controller('ErrorController', ['$scope',function($scope){
    $scope.setMsg = function(){
        $.ajax({
            type: 'POST',
            data: $('#lForm').serialize(),
            success: function (data) {
                if(data.success === true) {
                    alert('Successful!');
                    window.location.href = data.href;
                } else{
                    console.log(data);
                    $scope.errorMsg = data;
                }
            },
            async:false,
            error: function () {
                msg = 'The error with AJAX request has happened.';
            },
            dataType: 'json'
        });
    }
}]);
