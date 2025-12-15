document.querySelector(".custom-file-input").addEventListener("change", function() {
    let fileName = this.files[0] ? this.files[0].name : "Choose file";
    this.nextElementSibling.innerText = fileName;
});