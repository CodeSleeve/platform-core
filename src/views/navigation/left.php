<ul class="nav nav-sidebar">
	<?php foreach($navigation as $nav): ?>

		<?php if ($nav->shown): ?>
			<li class="<?= active($nav->active) ?>">
				<a href="<?= $nav->url ?>">
					<i class="fa <?= $nav->icon ?>"></i>
					<span style="font-size: 9px;"><?= $nav->title ?></span>
				</a>
			</li>
		<?php endif ?>

	<?php endforeach ?>
</ul>