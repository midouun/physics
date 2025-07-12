<?php include 'init.php'; ?>
<!DOCTYPE html>
<html lang="<?php echo $_SESSION['lang']; ?>" dir="<?php echo $dir; ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mr. Samahi Abdelhak - <?php echo $lang['physics_teacher']; ?></title>
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
                        <option value="en" <?php echo ($_SESSION['lang'] === 'en') ? 'selected' : ''; ?>><?php echo $lang['english_lang_name']; ?></option>
                        <option value="ar" <?php echo ($_SESSION['lang'] === 'ar') ? 'selected' : ''; ?>><?php echo $lang['arabic_lang_name']; ?></option>
                    </select>
                </form>
            </div>
        </nav>
    </header>
    <main>
        <section id="hero">
            <h1>Samahi Abdelhak</h1>
            <p><?php echo $lang['physics_teacher']; ?></p>
            <p><?php echo $lang['ain_el_hadjar']; ?></p>
            <p style="margin-top: 1rem;"><?php echo $display_status; ?></p>
        </section>
        <section id="homepage-content">
            <?php
            $homepage_content_file = __DIR__ . '/content/homepage_content.html';
            if (file_exists($homepage_content_file)) {
                $file_content = file_get_contents($homepage_content_file);
                if ($file_content !== false) {
                    // IMPORTANT SECURITY NOTE:
                    // Content from WYSIWYG editor is HTML. Displaying it directly can be a security risk (XSS)
                    // if not properly sanitized. For a production environment, it is HIGHLY recommended
                    // to use a robust HTML sanitization library like HTML Purifier on the server-side
                    // before saving the content, or before displaying it here.
                    echo $file_content;
                } else {
                    error_log("Failed to read homepage_content.html for display: " . $homepage_content_file);
                    echo '<p>' . $lang['error_loading_homepage_content'] . '</p>';
                }
            } else {
                echo '<p>' . $lang['default_homepage_placeholder'] . '</p>';
            }
            ?>
        </section>
    </main>
    <footer>
        <p><?php echo $lang['copyright_text']; ?></p>
    </footer>
</body>
</html>