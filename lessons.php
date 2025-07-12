<?php include 'init.php'; ?>
<!DOCTYPE html>
<html lang="<?php echo $_SESSION['lang']; ?>" dir="<?php echo $dir; ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $lang['lessons']; ?></title>
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
        <section id="lessons">
            <h2><?php echo $lang['downloadable_lessons']; ?></h2>
            <ul>
                <li><a href="#" download><?php echo $lang['lesson_1']; ?></a></li>
                <li><a href="#" download><?php echo $lang['lesson_2']; ?></a></li>
                <li><a href="#" download><?php echo $lang['lesson_3']; ?></a></li>
                <li><a href="#" download><?php echo $lang['lesson_4']; ?></a></li>
            </ul>
        </section>
    </main>
    <footer>
        <p>&copy; 2025 Samahi Abdelhak</p>
    </footer>
</body>
</html>