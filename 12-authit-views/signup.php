<div class="container">

    <h1>Sign Up</h1>

	<p><a href="<?php echo site_url('auth/login'); ?>">Login</a></p>

	<?php if($error) echo '<p class="text-danger">'. $error .'</p>'; ?>

    <?php echo form_open(); ?>

    <div class="form-group">
        <?php echo form_label('Email Address', 'email'); ?>
        <?php echo form_input(array(
            'name' => 'email',
            'value' => set_value('email'),
            'class' => 'form-control',
            'id' => 'email',
        )); ?>
        <?php echo form_error('email', '<p class="text-danger">', '</p>'); ?>
    </div>
    <div class="form-group">
        <?php echo form_label('Password', 'password'); ?>
        <?php echo form_password(array(
            'name' => 'password',
            'value' => set_value('password'),
            'class' => 'form-control',
            'id' => 'password',
        )); ?>
        <?php echo form_error('password', '<p class="text-danger">', '</p>'); ?>
    </div>
    <div class="form-group">
        <?php echo form_label('Confirm Password', 'password_conf'); ?>
        <?php echo form_password(array(
            'name' => 'password_conf',
            'value' => set_value('password_conf'),
            'class' => 'form-control',
            'id' => 'password_conf',
        )); ?>
        <?php echo form_error('password_conf', '<p class="text-danger">', '</p>'); ?>
    </div>
    <?php echo form_submit(array(
        'type' => 'submit',
        'value' => 'Sign Up',
        'class' => 'btn btn-primary',
    )); ?>

    <?php echo form_close(); ?>

</div>
