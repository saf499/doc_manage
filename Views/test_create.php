<h2>Testo</h2>
<form action="/test/store" method="post">
    <?= csrf_field() ?>
    <label for="test_tajuk">Tajuk</label>
    <input type="text" name="test_tajuk" required><br>

    <label for="test_comment">Comment</label>
    <input type="text" name="test_comment" required><br>

    <label for="test_int">Integer</label>
    <input type="number" step="0.01" name="test_int" required><br>

    <label for="test_option">Kereta</label><br>
    <select id="test_option" name="test_option" required>
        <option value="proton">Proton</option>
        <option value="perodua">Perodua</option>
        <option value="toyota">Toyota</option>
        <option value="honda">Honda</option>
    </select><br><br>

    <label for="tahun">Tahun</label><br>
    <input type="number" step="1" name="tahun" required><br>

    <button type="submit">test</button>
</form>