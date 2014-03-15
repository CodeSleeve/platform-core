<?= Form::open(['url' => $action, 'method' => $method, 'class' => 'form']) ?>

	<div class="form-group">
		<label for="name">Name</label>

		<input type="text" name="name" class="form-control" placeholder="Name of the role to be referenced by developer (you would not want to change this)" value="<?= $role->name ?>">

		<?= show_message_when('name', $errors) ?>
	</div>

	<div class="form-group">
		<label for="name">Alias</label>

		<input type="text" name="alias" class="form-control" placeholder="Human readable version of this role" value="<?= $role->alias ?>">

		<?= show_message_when('alias', $errors) ?>
	</div>

	<div class="actions text-center push-down-more">
		<?= Form::submit('Save', ['class' => 'btn btn-primary']) ?>

		<span style="padding: 0px 10px;">or</span> <a href="<?= $cancel ?>">Cancel</a>
	</div>

<?= Form::close(); ?>