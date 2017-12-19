<h1>Browse</h1>
<table>
    <tr>
        <th>ID</th>
        <th>Date</th>
        <th>Price</th>
        <th>Description</th>
    </tr>
    <?php foreach ($purchases as $purchase): ?>
    <tr>
        <td><?php echo $purchase['id'] ?></td>
        <td><?php echo $purchase['date'] ?></td>
        <td><?php echo $purchase['price'] ?></td>
        <td><?php echo $purchase['description'] ?></td>
    </tr>
    <?php endforeach; ?>
</table>
