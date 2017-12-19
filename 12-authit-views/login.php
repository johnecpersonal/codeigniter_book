<div class="container">

    <h1>Login</h1>

    <p><a href="<?php echo site_url('auth/signup'); ?>">Sign Up</a> | <a href="<?php echo site_url('auth/forgot'); ?>">Forgot Password?</a></p>

    <?php if($error) echo '<p class="text-danger">'. $error .'</p>'; ?>

    <?php echo form_open(); ?>

    <div class="form-group">
        <?php echo form_label('Email Address:', 'email'); ?>
        <?php echo form_input(array(
            'name' => 'email',
            'value' => set_value('email'),
            'class'=> 'form-control',
            'id' => 'email',
        )); ?>
        <?php echo form_error('email', '<p class="text-danger">', '</p>'); ?>
    </div>

    <div class="form-group">
        <?php echo form_label('Password:', 'password'); ?>
        <?php echo form_password(array(
            'name' => 'password',
            'value' => set_value('password'),
            'class' => 'form-control',
            'id' => 'password',
        )); ?>
        <?php echo form_error('password', '<p class="text-danger">', '</p>'); ?>
    </div>

    <?php echo form_submit(array(
        'type' => 'submit',
        'value' => 'Login',
        'class' => 'btn btn-primary',
    )); ?>

    <?php echo form_close(); ?>
</div>
