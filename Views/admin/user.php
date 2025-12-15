<!DOCTYPE html>
<html>
<head>
    <title>Staff List</title>
</head>
<body>
    <table>
        <thead>
            <tr>
                <th>NoStaff</th>
                <th>Name</th>
                <th>Email</th>
                <th>Roles</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($staf as $s) : ?>
            <tr>
                <td><?= $s['nostaff'] ?? 'N/A' ?></td>
                <td><?= $s['name'] ?? 'N/A' ?></td>
                <td><?= $s['email'] ?? 'N/A' ?></td>
                <td><?= $s['roles'] ?? 'N/A' ?></td>
            </tr><?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
