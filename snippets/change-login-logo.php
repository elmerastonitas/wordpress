
<?php

/**
 * Change WordPress login logo.
 *
 * This code snippet customizes the WordPress login page logo. It replaces the default logo with a specific image and adjusts some styles to ensure it fits the available space. Additionally, it modifies the logo link to point to the main website and open in a new tab.
 * 
 * To use this code snippet:
 * 1. Add the code to `functions.php` or use the Code Snippets plugin (https://wordpress.org/plugins/code-snippets/).
 * 2. Replace the URL in the `background-image` property with the URL of your desired logo.
 */

/* Defines the function that customizes the logo */
function custom_login_logo()
{
    /* Insert custom CSS on login page */
    ?>
    <style type="text/css">
        #login h1 a,
        .login h1 a {
            background-image: url('https://elmerastonitas.com/wp-content/uploads/2023/11/logo-ea.webp'); /* URL of the new logo */
            height: 50px; /* Adjust the height of the logo */
            width: 100%; /* Set the width of the logo to 100% */
            background-size: contain; /* Ensures that the logo fits inside the container without being cropped */
            padding-bottom: 30px; /* Add space below the logo */
            display: block; /* Makes the logo link take up all the space in the container */
            text-indent: -9999px; /* Hides the link text (WordPress default text) */
        }
    </style>
    <script type="text/javascript">
        // Add JavaScript to modify the logo link behavior
        document.addEventListener('DOMContentLoaded', function() {
            var logoLink = document.querySelector('.login h1 a'); // Select the logo link
            if (logoLink) {
                logoLink.href = 'https://elmerastonitas.com'; // Change the logo link to the main website
                logoLink.target = '_blank'; // Open link in new tab
                logoLink.title = 'Ir a elmerastonitas.com'; // Add a title to the link to improve accessibility
                logoLink.setAttribute('aria-label', 'Ir a elmerastonitas.com'); // Improve accessibility for screen readers
            }
        });
    </script>
    <?php
}

// Hooks the 'custom_login_logo' function to the 'login_enqueue_scripts' action, allowing for custom styles or scripts to be added to the WordPress login page.

add_action('login_enqueue_scripts', 'custom_login_logo');
