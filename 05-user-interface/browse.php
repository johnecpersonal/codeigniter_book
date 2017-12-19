<div class="container">
    <h1>Browse</h1>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Date</th>
                <th scope="col">Price</th>
                <th scope="col">Description</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($purchases as $purchase): ?>
            <tr>
                <td><?php echo $purchase['id'] ?></td>
                <td><?php echo $purchase['date'] ?></td>
                <td><?php echo $purchase['price'] ?></td>
                <td><?php echo $purchase['description'] ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
