document.addEventListener('DOMContentLoaded', function() {
    const yesRadio = document.getElementById('yes');
    const noRadio = document.getElementById('no');
    const lukisanInput = document.getElementById('document-upload');

    function toggleFileInput() {
        if (yesRadio.checked) {
            lukisanInput.style.display = 'block';
            lukisanInput.querySelector('input').setAttribute('required', 'required');
        } else {
            lukisanInput.style.display = 'none';
            lukisanInput.querySelector('input').removeAttribute('required');
        }
    }

    // Initial check on page load
    toggleFileInput();

    // Event listeners for the radio buttons
    yesRadio.addEventListener('change', toggleFileInput);
    noRadio.addEventListener('change', toggleFileInput);
});