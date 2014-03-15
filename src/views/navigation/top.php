<div class="container-fluid">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="<?= platform_route("dashboard") ?>">Codesleeve Platform</a>
    </div>
    <div class="navbar-collapse collapse">
        <ul class="nav navbar-nav navbar-right">
            <li>
                <a href="<?= platform_route("users.edit", [$currentUser->id]) ?>">My Account</a>
            </li>

            <li>
                <a href="<?= platform_route("sessions.destroy") ?>">Log Out</a>
            </li>
        </ul>
    </div>
</div>

