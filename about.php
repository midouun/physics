<?php include 'init.php'; ?>
<!DOCTYPE html>
<html lang="<?php echo $_SESSION['lang']; ?>" dir="<?php echo $dir; ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $lang['about_the_teacher']; ?></title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="index.php"><?php echo $lang['home']; ?></a></li>
                <li><a href="about.php"><?php echo $lang['about']; ?></a></li>
                <li><a href="schedule.php"><?php echo $lang['schedule']; ?></a></li>
                <li><a href="lessons.php"><?php echo $lang['lessons']; ?></a></li>
                <li><a href="contact.php"><?php echo $lang['contact']; ?></a></li>
                <li><a href="admin/login.php"><?php echo $lang['admin']; ?></a></li>
            </ul>
            <div class="lang-switcher">
                <form action="" method="get" style="display:inline;">
                    <select name="lang" onchange="this.form.submit()">
                        <option value="en" <?php echo ($_SESSION['lang'] === 'en') ? 'selected' : ''; ?>>English</option>
                        <option value="ar" <?php echo ($_SESSION['lang'] === 'ar') ? 'selected' : ''; ?>>العربية</option>
                    </select>
                </form>
            </div>
        </nav>
    </header>
    <main>
        <section id="about">
            <h2><?php echo $lang['about_the_teacher']; ?></h2>
            <?php
            $about_content_file = __DIR__ . '/content/about_content.html';

            // Check if the about content file exists
            if (file_exists($about_content_file)) {
                // Attempt to read the file content
                $file_content = file_get_contents($about_content_file);

                // Check if file_get_contents was successful (returns false on failure)
                if ($file_content !== false) {
                    // IMPORTANT SECURITY NOTE:
                    // Content from WYSIWYG editor is HTML. Displaying it directly can be a security risk (XSS)
                    // if not properly sanitized. For a production environment, it is HIGHLY recommended
                    // to use a robust HTML sanitization library like HTML Purifier on the server-side
                    // before saving the content, or before displaying it here.
                    // Example (conceptual, as external libraries are not allowed for implementation):
                    // require_once 'path/to/htmlpurifier/library/HTMLPurifier.auto.php';
                    // $config = HTMLPurifier_Config::createDefault();
                    // $purifier = new HTMLPurifier($config);
                    // $clean_html = $purifier->purify($file_content);
                    // echo $clean_html;

                    // For this exercise, we are assuming the admin is trusted and will not inject malicious code.
                    // In a real scenario, this line is where the purified HTML would be echoed.
                    echo $file_content;
                } else {
                    // Error reading the file, likely due to permissions
                    error_log("Failed to read about_content.html for display: " . $about_content_file);
                    echo '<p>' . $lang['error_read_about'] . '</p>';
                }
            } else {
                // File does not exist, display a warning message
                echo '<p>' . $lang['warning_about_not_found'] . '</p>';
            }
            ?>
        </section>
    </main>
    <footer>
        <p>&copy; 2025 Samahi Abdelhak</p>
    </footer>
</body>
</html>