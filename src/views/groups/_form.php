
<?= to_javascript(['Platform.data' => $group]) ?>

<?= Form::open(['url' => $action, 'method' => $method, 'class' => 'form', 'ng-controller' => 'Platform.GroupController']) ?>

	<div class="form-group row">
		<div class="col-md-12">
			<label for="name">Name</label>

			<input type="text" name="name" class="form-control" placeholder="Name of the group" value="<?= $group->name ?>">

			<?= show_message_when('name', $errors) ?>
		</div>
	</div>

	<h4>Permissions <small>(<a href="#" ng-click="addPermission()"><i class="fa fa-plus"></i></a>)</small></h4>

	<div class="form-group row">
		<div class="col-md-6">
			<div class="input-group permissions-region" ng-repeat="permission in permissions track by $index">
				<input type="text" name="permissions[]" class="form-control" placeholder="Permission name" value="{{permission}}">
				<span ng-click="removePermission($index)" class="input-group-addon"><i class="fa fa-times"></i></span>
			</div>

			<?= show_message_when('permissions[]', $errors) ?>
		</div>
	</div>

	<div class="actions text-center push-down-more">
		<?= Form::submit('Save', ['class' => 'btn btn-primary']) ?>

		<span style="padding: 0px 10px;">or</span> <a href="<?= $cancel ?>">Cancel</a>
	</div>

<?= Form::close(); ?>