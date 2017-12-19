<div class="container">
    <?php if ($purchase): ?>
        <h1>Edit</h1>
        <?php echo validation_errors(); ?>
        <?php echo form_open('purchases/edit/'.$purchase['id']); ?>
            <div class="form-group">
                <label for="date">Date:</label>
                <input type="text" class="form-control" name="date" value="<?php echo set_value('date', $purchase['date']); ?>">
            </div>
            <div class="form-group">
                <label for="price">Price:</label>
                <input type="text" class="form-control" name="price" value="<?php echo set_value('price', $purchase['price']); ?>">
            </div>
            <div class="form-group">
                <label for="description">Description:</label>
                <input type="text" class="form-control" name="description" value="<?php echo set_value('description', $purchase['description']); ?>">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    <?php else: ?>
        <p class="text-danger">Can't edit this id</p>
    <?php endif; ?>
</div>
