<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Simple Drawing App</title>
<style>
body {
  margin: 0;
  padding: 0;
  overflow: hidden;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: flex-start;
  height: 100vh;
}

canvas {
  position: relative;
  display: block;
  background-color: #fff;
  cursor: crosshair;
}

#buttons {
  margin-top: 20px;
}

button {
  margin: 5px;
}

#image {
  position: absolute;
  top: 50px;
  left: 50px;
  pointer-events: none; /* Make the image not interfere with drawing */
}
</style>
</head>
<body>
<div id="buttons">
  <button id="undoBtn">Undo</button>
  <button id="redoBtn">Redo</button>
</div>
<canvas id="canvas"></canvas>
<img id="image" src="assets/" alt="Your Image">
<script>
document.addEventListener("DOMContentLoaded", () => {
    const canvas = document.getElementById("canvas");
    const ctx = canvas.getContext("2d");
    const undoBtn = document.getElementById("undoBtn");
    const redoBtn = document.getElementById("redoBtn");
    
    let isDrawing = false;
    let lastX = 0;
    let lastY = 0;
    let history = [];
    let redoStack = [];
    
    canvas.width = window.innerWidth;
    canvas.height = window.innerHeight;
    
    ctx.lineWidth = 3;
    ctx.lineCap = "round";
    ctx.strokeStyle = "#000";
    
    function startDrawing(e) {
        isDrawing = true;
        draw(e);
    }
    
    function stopDrawing() {
        isDrawing = false;
        ctx.beginPath();
        saveState();
    }
    
    function draw(e) {
        if (!isDrawing) return;
        
        ctx.lineTo(e.clientX, e.clientY);
        ctx.stroke();
        ctx.beginPath();
        ctx.moveTo(e.clientX, e.clientY);
    }
    
    function undo() {
        if (history.length > 0) {
            redoStack.push(ctx.getImageData(0, 0, canvas.width, canvas.height));
            ctx.putImageData(history.pop(), 0, 0);
        }
    }
    
    function redo() {
        if (redoStack.length > 0) {
            history.push(ctx.getImageData(0, 0, canvas.width, canvas.height));
            ctx.putImageData(redoStack.pop(), 0, 0);
        }
    }
    
    function saveState() {
        history.push(ctx.getImageData(0, 0, canvas.width, canvas.height));
        redoStack = [];
    }
    
    canvas.addEventListener("mousedown", startDrawing);
    canvas.addEventListener("mousemove", draw);
    canvas.addEventListener("mouseup", stopDrawing);
    canvas.addEventListener("mouseout", stopDrawing);
    undoBtn.addEventListener("click", undo);
    redoBtn.addEventListener("click", redo);
});
</script>
</body>
</html>
