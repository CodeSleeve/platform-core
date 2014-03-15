
<div class="row">
	<label class="col-sm-3" for="first_name">First Name:</label>

	<p class="col-sm-9"><?= $user->first_name ?></p>
</div>

<div class="row">
	<label class="col-sm-3" for="last_name">Last Name:</label>

	<p class="col-sm-9"><?= $user->last_name ?></p>
</div>

<div class="row">
	<label class="col-sm-3" for="email">Email:</label>

	<p class="col-sm-9"><?= $user->email ?></p>
</div>

<div class="row">
	<label class="col-sm-3" for="role_ids[]">Roles:</label>

	<p class="col-sm-9">
		<?php foreach ($user->roles as $role): ?>
			<span><?= $role->alias ?> </span>
		<?php endforeach ?>
	</p>
</div>