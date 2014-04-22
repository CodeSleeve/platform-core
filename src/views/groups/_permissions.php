<div class="input-group permissions-region" ng-repeat="permission in permissions">
	<input type="text" name="permissions[]" class="form-control" placeholder="Permission name" value="{{permission}}">
	<span class="input-group-addon"><i class="fa fa-times" ng-click="removePermission($index)"></i></span>
</div>