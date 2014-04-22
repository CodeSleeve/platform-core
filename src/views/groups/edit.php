<h3>
	<i class="fa fa-edit"></i> Editing Group
</h3>

<hr>

<?= render("platform::groups._form", [
	'group' => $group,
	'action' => action("{$namespace}\GroupController@update", [$group->id]),
	'method' => 'PUT',
	'cancel' => action("{$namespace}\GroupController@index")
]) ?>