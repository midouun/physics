<?php include 'init.php'; ?>
<!DOCTYPE html>
<html lang="<?php echo $_SESSION['lang']; ?>" dir="<?php echo $dir; ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $lang['weekly_schedule']; ?></title>
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
        <section id="schedule">
            <h2><?php echo $lang['weekly_schedule']; ?></h2>
            <table>
                <thead>
                    <tr>
                        <th><?php echo $lang['time']; ?></th>
                        <th><?php echo $lang['monday']; ?></th>
                        <th><?php echo $lang['tuesday']; ?></th>
                        <th><?php echo $lang['wednesday']; ?></th>
                        <th><?php echo $lang['thursday']; ?></th>
                        <th><?php echo $lang['friday']; ?></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>8:00 - 9:00</td>
                        <td><?php echo $lang['physics_101']; ?></td>
                        <td></td>
                        <td><?php echo $lang['physics_101']; ?></td>
                        <td></td>
                        <td><?php echo $lang['physics_101']; ?></td>
                    </tr>
                    <tr>
                        <td>9:00 - 10:00</td>
                        <td></td>
                        <td><?php echo $lang['physics_201']; ?></td>
                        <td></td>
                        <td><?php echo $lang['physics_201']; ?></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>10:00 - 11:00</td>
                        <td><?php echo $lang['physics_201']; ?></td>
                        <td><?php echo $lang['physics_101']; ?></td>
                        <td><?php echo $lang['physics_201']; ?></td>
                        <td><?php echo $lang['physics_101']; ?></td>
                        <td><?php echo $lang['physics_201']; ?></td>
                    </tr>
                    <tr>
                        <td>11:00 - 12:00</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
        </section>
    </main>
    <footer>
        <p>&copy; 2025 Samahi Abdelhak</p>
    </footer>
</body>
</html>