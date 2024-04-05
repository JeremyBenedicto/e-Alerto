<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dark Mode Example</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            transition: background-color 0.3s ease;
            background-color: #fff;
            color: #333;
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 600px;
            margin: auto;
        }

        button {
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            cursor: pointer;
            outline: none;
            border-radius: 5px;
        }

        button:hover {
            background-color: #0056b3;
        }

        .dark-mode {
            background-color: #333;
            color: #fff;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Dark Mode Example</h1>
        <p>This is a simple example of dark mode.</p>
        <button onclick="toggleDarkMode()">Toggle Dark Mode</button>
    </div>

    <script>
        function toggleDarkMode() {
            const body = document.body;
            body.classList.toggle('dark-mode');
        }
    </script>
</body>
</html>
