const dropArea = document.getElementById("drop-area");
const inputFile = document.getElementById("input-file");

inputFile.addEventListener("change", uploadImage);

function uploadImage(){
    inputFile.files[0];
    let imgLink = URL.createObjectURL(inputFile.files[0]);
    document.querySelector('.img-view').style.backgroundImage= `url(${imgLink})`;
    document.querySelector('.img-view').textContent = "";
    document.querySelector('.img-view').style.border = 0;
}

dropArea.addEventListener("dragover", function(e){
    e.preventDefault();
});
dropArea.addEventListener("drop", function(e){
    e.preventDefault();
    inputFile.files = e.dataTransfer.files;
    uploadImage();
});
