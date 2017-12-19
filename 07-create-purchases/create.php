<div class="container">
    <h1>Create</h1>
    <?php echo validation_errors(); ?>
    <?php echo form_open('purchases/create'); ?>
        <div class="form-group">
            <label for="date">Date:</label>
            <input type="text" class="form-control" name="date" value="<?php echo set_value('date'); ?>">
        </div>
        <div class="form-group">
            <label for="price">Price:</label>
            <input type="text" class="form-control" name="price" value="<?php echo set_value('price'); ?>">
        </div>
        <div class="form-group">
            <label for="description">Description:</label>
            <input type="text" class="form-control" name="description" value="<?php echo set_value('description'); ?>">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
