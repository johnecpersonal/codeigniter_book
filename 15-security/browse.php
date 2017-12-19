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
                <td><?php echo xss_clean($purchase['id']) ?></td>
                <td><?php echo xss_clean($purchase['date']) ?></td>
                <td><?php echo xss_clean($purchase['price']) ?></td>
                <td><?php echo xss_clean($purchase['description']) ?></td>
                <td>
                    <a href="<?php echo site_url('purchases/edit/'.xss_clean($purchase['id'])); ?>">Edit</a>
                </td>
                <td>
                    <a href="<?php echo site_url('purchases/delete/'.xss_clean($purchase['id'])); ?>">Delete</a>
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
