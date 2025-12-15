<!DOCTYPE html>
<html>
<head>
    <title>User Form</title>
</head>
<body>
    <h2>User Form</h2>

    <?php if (session()->getFlashdata('success')): ?>
        <p style="color: green;"><?= session()->getFlashdata('success') ?></p>
    <?php endif; ?>

    <form action="<?= base_url('/users/store') ?>" method="post" enctype="multipart/form-data">
        <label>Name:</label><br>
        <input type="text" name="NAME"><br><br>

        <label>Email:</label><br>
        <input type="email" name="EMAIL"><br><br>

        <label>Gender:</label><br>
        <select name="GENDER">
            <option value="">-- Select --</option>
            <option value="Male">Male</option>
            <option value="Female">Female</option>
        </select><br><br>

        <label>Age:</label><br>
        <input type="number" name="AGE"><br><br>

        <label for="PROFILE_PIC">Profile Picture:</label><br>
        <input type="file" name="PROFILE_PIC"><br><br>

        <label for="RESUME">Resume (PDF):</label><br>
        <input type="file" name="RESUME"><br><br>

        <button type="submit">Save</button>
    </form>
</body>
</html>
