<?php if(count($groups) == 0): ?>
	<p>No Groups.</p>
<?php else: ?>
	<table class="table table-striped">
		<thead>
			<tr>
				<th><?= sort_table_by('id', 'Group Id') ?></th>
				<th><?= sort_table_by('name', 'Group Name') ?></th>
				<th>
					<a class="btn btn-primary pull-right" href="<?=  action("{$namespace}\GroupController@create") ?>">
						<i class="fa fa-plus"></i>
						New Group
					</a>
				</th>
			</tr>
		</thead>

		<tbody>
			<?php foreach($groups as $group): ?>
				<tr>
					<td><?= $group->id ?></td>
					<td><?= $group->name ?></td>
					<td>
						<a href="<?= action("{$namespace}\GroupController@edit", [$group->id]) ?>">
							<i class="fa fa-edit large-icon"></i>
						</a>

						<a href="<?= action("{$namespace}\GroupController@destroy", [$group->id]) ?>" data-method="delete">
							<i class="fa fa-times large-icon"></i>
						</a>
					</td>
				</tr>
			<?php endforeach ?>
		</tbody>
	</table>

	<div class="text-center">
		<?= $groups->links() ?>
	</div>
<?php endif ?>
