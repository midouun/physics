<?php
include 'init.php';

$message_sent = false;
$error_message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $message_body = htmlspecialchars(trim($_POST['message'])); // Renamed to avoid conflict with $message variable

    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $to = TEACHER_EMAIL; // Use constant from config.php
        $subject = 'New Message from Website Contact Form';
        $body = "Name: $name\nEmail: $email\n\nMessage:\n$message_body";
        $headers = "From: $email";

        if (mail($to, $subject, $body, $headers)) {
            $message_sent = true;
        } else {
            $error_message = 'Sorry, there was an error sending your message. Please try again later.';
            error_log("Failed to send email from contact form. To: " . $to . ", From: " . $email);
        }
    } else {
        $error_message = 'Invalid email format.';
    }
}
?>
<!DOCTYPE html>
<html lang="<?php echo $_SESSION['lang']; ?>" dir="<?php echo $dir; ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $lang['contact_me']; ?></title>
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
        <section id="contact">
            <h2><?php echo $lang['contact_me']; ?></h2>
            <p>Email: <a href="mailto:<?php echo TEACHER_EMAIL; ?>"><?php echo TEACHER_EMAIL; ?></a></p>
            
            <?php if ($message_sent): ?>
                <p style="color: green;"><?php echo $lang['thank_you_message_sent']; ?></p>
            <?php elseif ($error_message): ?>
                <p style="color: red;"><?php echo $error_message; ?></p>
            <?php endif; ?>

            <form action="contact.php" method="post">
                <div>
                    <label for="name"><?php echo $lang['name']; ?></label>
                    <input type="text" id="name" name="name" required>
                </div>
                <div>
                    <label for="email"><?php echo $lang['email']; ?></label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div>
                    <label for="message"><?php echo $lang['message']; ?></label>
                    <textarea id="message" name="message" rows="5" required></textarea>
                </div>
                <button type="submit"><?php echo $lang['send_message']; ?></button>
            </form>
        </section>
    </main>
    <footer>
        <p><?php echo $lang['copyright_text']; ?></p>
    </footer>
</body>
</html>