document.addEventListener('DOMContentLoaded', function() {
    var canvas = document.getElementById('canvas');
    var ctx = canvas.getContext('2d');

    var isDrawing = false;
    var lastX = 0;
    var lastY = 0;

    var img = new Image();
    img.onload = function() {
        canvas.width = img.width;
        canvas.height = img.height;
        ctx.drawImage(img, 0, 0);
    };
    img.src = 'assets/human.jpg';

    canvas.addEventListener('mousedown', function(e) {
        isDrawing = true;
        [lastX, lastY] = [e.offsetX, e.offsetY];
    });

    canvas.addEventListener('mousemove', function(e) {
        if (isDrawing) {
            ctx.beginPath();
            ctx.moveTo(lastX, lastY);
            ctx.lineTo(e.offsetX, e.offsetY);
            ctx.strokeStyle = 'red';
            ctx.lineWidth = 2;
            ctx.stroke();
            [lastX, lastY] = [e.offsetX, e.offsetY];
        }
    });

    canvas.addEventListener('mouseup', function() {
        isDrawing = false;
    });

    canvas.addEventListener('mouseleave', function() {
        isDrawing = false;
    });


    document.getElementById('downloadBtn').addEventListener('click', function() {
        var link = document.createElement('a');
        link.download = 'canvas_image.png';
        link.href = canvas.toDataURL('image/png');
        link.click();
    });
});



    