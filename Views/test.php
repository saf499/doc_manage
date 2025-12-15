<?php if(session()->getFlashdata('success')): ?>
    <div class="alert alert-success">
        <?= session()->getFlashdata('success'); ?>
    </div>
<?php endif; ?>

<h1>Senarai test</h1>
<a href="/test/create">Daftar Projek Baru</a>
<table border="1">
    <tr>
        <th>ID</th>
        <th>Tajuk</th>
        <th>Comment</th>
        <th>Integer</th>
        <th>Option</th>
        <th>Year</th>
        <th>Registration date</th>
    </tr>
    <?php foreach ($test as $t): ?>
    <tr>
        <td><?= $t['test_id'] ?></td>
        <td><?= $t['test_tajuk'] ?></td>
        <td><?= $t['test_comment'] ?></td>
        <td><?= $t['test_int'] ?></td>
        <td><?= $t['test_option'] ?></td>
        <td><?= $t['tahun'] ?></td>
        <td><?= $t['reg_date']?></td>
    </tr>
    <?php endforeach; ?>
</table>

<?php var_dump($test);
exit;
?>
