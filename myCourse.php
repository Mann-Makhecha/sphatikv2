<?php include 'includes/header.php'; ?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Course Page</title>
        <link rel="stylesheet" href="./css/home_style.css">
        <link rel="stylesheet" href="./css/innerCourse.css">
    </head>

    <body>
        <div class="course-container">
            <div class="sidebar">
                <h2>Course Modules</h2>
                <ul>
                    <li onclick="showModule('module1')">Module 1</li>
                    <li onclick="showModule('module2')">Module 2</li>
                    <li onclick="showModule('module3')">Module 3</li>
                </ul>
            </div>

            <button class="mobile-button"><svg xmlns="http://www.w3.org/2000/svg" height="2.2rem"
                    viewBox="0 -960 960 960" width="2.2rem" class="backSvg">
                    <path d="m321-80-71-71 329-329-329-329 71-71 400 400L321-80Z" />
                </svg></button>
            <div class="content">
                <div id="module1" class="module">
                    <h2>Module 1: Introduction</h2>
                    <p>Welcome to this course. This module will give you an overview.</p>
                    <div class="f-container">
                        <iframe class="responsive-iframe" src="#"></iframe>
                    </div>
                </div>
                <div id="module2" class="module" style="display: none;">
                    <h2>Module 2: Basics</h2>
                    <p>This module covers the fundamental concepts.</p>
                    <div class="f-container">
                        <iframe class="responsive-iframe" src="#"></iframe>
                    </div>
                </div>
                <div id="module3" class="module" style="display: none;">
                    <h2>Module 3: Advanced Concepts</h2>
                    <p>Now, let's move on to advanced topics.</p>
                    <div class="f-container">
                        <iframe class="responsive-iframe" src="#"></iframe>
                    </div>
                </div>
            </div>
        </div>
        <script>
            const sidebar = document.querySelector(".sidebar");
            const mobileButton = document.querySelector(".mobile-button");

            mobileButton.addEventListener("click", () => {
                sidebar.classList.toggle("s-active");
                mobileButton.classList.toggle("m-active");
            });

            function showModule(moduleId) {
                document.querySelectorAll(".module").forEach((module) => {
                    module.style.display = "none";
                });
                document.getElementById(moduleId).style.display = "block";
            }</script>
    </body>

</html>