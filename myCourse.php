<?php include 'includes/header.php'; ?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Course Page</title>
        <style>
            :root {
                --primary-color: #6d28d9;
                --secondary-color: #4c1d95;
                --text-color: #1f2937;
                --light-gray: #f3f4f6;
                --white: #ffffff;
            }

            body {
                margin: 0;
                font-family: Arial, sans-serif;
                display: flex;
                height: 100vh;
                background-color: var(--light-gray);
            }

            .sidebar {
                width: 250px;
                background: var(--primary-color);
                color: var(--white);
                padding: 20px;
                position: fixed;
                height: 100%;
                overflow-y: auto;
            }

            .sidebar h2 {
                font-size: 20px;
            }

            .sidebar ul {
                list-style: none;
                padding: 0;
            }

            .sidebar ul li {
                padding: 10px;
                cursor: pointer;
                border-bottom: 1px solid var(--secondary-color);
            }

            .content {
                margin-left: 270px;
                padding: 20px;
                flex: 1;
            }

            .module {
                background: var(--white);
                padding: 20px;
                margin-bottom: 20px;
                border-radius: 5px;
                box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
            }

            iframe {
                width: 100%;
                height: 300px;
                border: none;
            }

            @media (max-width: 768px) {
                .sidebar {
                    width: 100%;
                    position: relative;
                }

                .content {
                    margin-left: 0;
                }
            }
        </style>
    </head>

    <body>
        <div class="sidebar">
            <h2>Course Modules</h2>
            <ul>
                <li onclick="showModule('module1')">Module 1: Introduction</li>
                <li onclick="showModule('module2')">Module 2: Basics</li>
                <li onclick="showModule('module3')">Module 3: Advanced Concepts</li>
            </ul>
        </div>
        <div class="content">
            <div id="module1" class="module">
                <h2>Module 1: Introduction</h2>
                <p>Welcome to this course. This module will give you an overview.</p>
                <iframe src="https://www.youtube.com/embed/dQw4w9WgXcQ" allowfullscreen></iframe>
            </div>
            <div id="module2" class="module" style="display: none;">
                <h2>Module 2: Basics</h2>
                <p>This module covers the fundamental concepts.</p>
                <iframe src="https://www.youtube.com/embed/3JZ_D3ELwOQ" allowfullscreen></iframe>
            </div>
            <div id="module3" class="module" style="display: none;">
                <h2>Module 3: Advanced Concepts</h2>
                <p>Now, let's move on to advanced topics.</p>
                <iframe src="https://www.youtube.com/embed/ktjafK4SgWM" allowfullscreen></iframe>
            </div>
        </div>
        <script>
            function showModule(moduleId) {
                document.querySelectorAll('.module').forEach(module => {
                    module.style.display = 'none';
                });
                document.getElementById(moduleId).style.display = 'block';
            }
        </script>
    </body>

</html>