<div class="container">
    <h1>Browse</h1>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Date</th>
                <th scope="col">Price</th>
                <th scope="col">Description</th>
                <th scope="col">Edit</th>
                <th scope="col">Delete</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($purchases as $purchase): ?>
            <tr>
                <td><?php echo $purchase['id'] ?></td>
                <td><?php echo $purchase['date'] ?></td>
                <td><?php echo $purchase['price'] ?></td>
                <td><?php echo $purchase['description'] ?></td>
                <td>
                    <a href="<?php echo site_url('purchases/edit/'.$purchase['id']); ?>">Edit</a>
                </td>
                <td>
                    <a href="<?php echo site_url('purchases/delete/'.$purchase['id']); ?>">Delete</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <nav aria-label="Browse Pagination">
        <ul class="pagination justify-content-center">
            <?php echo $this->pagination->create_links(); ?>
        </ul>
    </nav>
</div>
