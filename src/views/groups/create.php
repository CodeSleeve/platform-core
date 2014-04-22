<h3>
	<i class="icon-plus"></i>
	Creating Group
</h3><hr>

<?= render("platform::groups._form", [
	'group' => $group,
	'action' => action("{$namespace}\GroupController@store"),
	'method' => 'POST',
	'cancel' => action("{$namespace}\GroupController@index")
]) ?>