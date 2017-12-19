<div class="container">

	<h1>Forgot Password</h1>

	<p><a href="<?php echo site_url('auth/login'); ?>">Login</a></p>

	<?php if($success): ?>
		<?php echo '<p class="text-success">Thank you. We have sent you an email with further instructions on how to reset your password.</p>'; ?>
	<?php else: ?>
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

	    <?php echo form_submit(array(
	    	'type' => 'submit',
	    	'value' => 'Reset Password',
	    	'class' => 'btn btn-primary',
	    )); ?>

	    <?php echo form_close(); ?>
    <?php endif; ?>
</div>
