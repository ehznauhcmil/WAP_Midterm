const fileInput = document.getElementById("file-upload");
const fileNamePreview = document.getElementById("fileNamePreview");

fileInput.addEventListener("change", () => {
  const file = fileInput.files[0];

  fileNamePreview.textContent = "No file selected";

  if (file) {
    fileNamePreview.textContent = file.name;
  } else {
    fileNamePreview.textContent = "No file selected";
  }
});
