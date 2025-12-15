<h1>User List</h1>
<a href="/users/create">Create New User</a>
<table border="1">
    <tr>
        <th>ID</th>
        <th>Username</th>
        <th>Email</th>
        <th>Files</th>
        <th>Actions</th>
    </tr>
    <?php foreach($SPK_USERS as $user): ?>
    <tr>
        <td><?= esc($user['ID']) ?></td>
        <td><?= esc($user['NAME']) ?></td>
        <td><?= esc($user['EMAIL']) ?></td>
        <td>
        <?php if (!empty($user['RESUME'])): ?>
            <a href="<?= base_url("uploads/users/{$user['ID']}/{$user['RESUME']}") ?>" target="_blank">View</a>
        <?php else: ?>
            N/A
        <?php endif; ?>
        </td>
        <td>
            <a href="/users/edit/<?= esc($user['ID']) ?>">Edit</a>
            <a href="/users/delete/<?= esc($user['ID']) ?>" onclick="return confirm('Are you sure?');">Delete</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
