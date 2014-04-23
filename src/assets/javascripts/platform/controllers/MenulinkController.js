Platform.MenulinkController = function($scope)
{
	$scope.data = Platform.data;
	$scope.menulinks = typeof Platform.data.menu_links === 'undefined' ? [] : Platform.data.menu_links;

	$scope.remove = function(index)
	{
		$scope.menulinks.splice(index, 1);
	}

	$scope.add = function()
	{
		$scope.menulinks.push({ id: '',  url: '', title: ''});
	}
}