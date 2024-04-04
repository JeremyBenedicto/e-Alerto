function handleFileInputClick() {
    document.getElementById('photo').click();
}


document.querySelector('.upload-btn').addEventListener('click', handleFileInputClick);


document.getElementById('photo').addEventListener('change', function() {
    
    document.getElementById('uploadForm').style.display = 'block';
});

document.getElementById('uploadForm').addEventListener('submit', function(event) {
    event.preventDefault();

    var formData = new FormData();
    formData.append('photo', document.getElementById('photo').files[0]);

    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'upload.php', true);
    xhr.onload = function() {
        if (xhr.status === 200) {
            document.getElementById('message').textContent = xhr.responseText;
        } else {
            document.getElementById('message').textContent = 'An error occurred during upload';
        }
    };
    xhr.send(formData);
});

function refreshPage() {
    location.reload();
}

document.getElementById('uploadButton').addEventListener('click', function() {
    setTimeout(function(){
        location.reload();
    }, 1000);
});