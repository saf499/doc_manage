<h1>Edit User</h1>
<form action="/users/update/<?= esc($SPK_USERS['ID']) ?>" method="post" enctype="multipart/form-data">
    <label for="NAME">Username:</label>
    <input type="text" name="NAME" id="NAME" value="<?= esc($SPK_USERS['NAME']) ?>" required>
    <br><br>
    <label for="EMAIL">Email:</label>
    <input type="email" name="EMAIL" id="EMAIL" value="<?= esc($SPK_USERS['EMAIL']) ?>" required>
    <br><br>
    <label for="GENDER">Gender:</label>
        <select name="GENDER" class="form-control">
            <option value=""
                <?= empty($SPK_USERS['GENDER']) ? 'selected' : '' ?>>
                -- Select --
            </option>
            <option value="Male"
                <?= $SPK_USERS['GENDER'] === 'Male' ? 'selected' : '' ?>>
                Male
            </option>
            <option value="Female"
                <?= $SPK_USERS['GENDER'] === 'Female' ? 'selected' : '' ?>>
                Female
            </option>
        </select><br><br>

    <label for="AGE">Age:</label>
    <input type="number" name="AGE" id="AGE" value="<?= esc($SPK_USERS['AGE']) ?>">
    <br><br>

    <label for="PROFILE_PIC">Profile Picture:</label>
    <input type="file" name="PROFILE_PIC" id="PROFILE_PIC">
    <br>
    <?php if (!empty($SPK_USERS['PROFILE_PIC'])): ?>
    <p>Current Picture: <?= esc($SPK_USERS['PROFILE_PIC']) ?></p>
    <?php else: ?>
        <p>No profile picture uploaded.</p>
    <?php endif; ?>

    <label for="RESUME">Resume (PDF):</label>
    <input type="file" name="RESUME" id="RESUME">
    <br>
    <?php if (!empty($SPK_USERS['RESUME'])): ?>
    <p>Current Resume: <?= esc($SPK_USERS['RESUME']) ?></p>
    <?php else: ?>
        <p>No resume uploaded.</p>
    <?php endif; ?>

    <button type="submit">Update</button>
</form>
<a href="/users">Back to User List</a>