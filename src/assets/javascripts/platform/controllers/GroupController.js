Platform.GroupController = function($scope)
{
	$scope.permissions = [];
	$scope.data = Platform.data;

	for (var index in $scope.data.permissions)
	{
		$scope.permissions.push(index);
	}

	$scope.removePermission = function(index)
	{
		$scope.permissions.splice(index, 1);
	}

	$scope.addPermission = function()
	{
		$scope.permissions.push('');
	}
}