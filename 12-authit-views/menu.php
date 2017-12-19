<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
    <div class="container">
        <a class="navbar-brand" href="<?php echo site_url() ?>">CI App</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav ml-auto">
                <?php if (logged_in()): ?>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo site_url('purchases/browse') ?>">Browse</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo site_url('purchases/create') ?>">Create</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo site_url('auth/logout') ?>">Logout</a>
                </li>
                <?php else: ?>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo site_url('auth/signup') ?>">Sign Up</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo site_url('auth/login') ?>">Login</a>
                </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>
