<div class="container">
    <h1>Delete this purchase?</h1>
    <?php echo form_open('purchases/destroy', '', ['id' => $id]); ?>
        <button type="submit" class="btn btn-danger">Yes</button>
        <a href="<?php echo site_url('purchases/browse'); ?>" class="btn btn-secondary" role="button" aria-disabled="true">No</a>
    </form>
</div>
