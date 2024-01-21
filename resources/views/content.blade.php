<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="icon" type="image/x-icon" href="assets/logo.png">

    <style>
        body, html {
            height: 100%;
            margin: 0;
            overflow: hidden;
        }

        .body {
            height: 100%;
            overflow-y: auto; /* Enable scrolling for the content */
        }

        section {
            height: 100vh;
        }
    </style>
</head>

<body class="font-poppins"> 
    <section class="bg-center bg-no-repeat bg-white dark:bg-gray-700">
        <div class="body">
            @yield('isihalaman')
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const checkbox = document.querySelector('#toggle');
            const html = document.querySelector('html');
            const storedTheme = localStorage.getItem('theme');

            if (storedTheme) {
                html.classList.add(storedTheme);
                checkbox.checked = storedTheme === 'dark';
            }

            checkbox.addEventListener('click', function() {
                if (checkbox.checked) {
                    html.classList.add('dark');
                    localStorage.setItem('theme', 'dark');
                } else {
                    html.classList.remove('dark');
                    localStorage.setItem('theme', 'light');
                }
            });
        });
    </script>
</body>