<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Google reCAPTCHA</title>
    <link 
		href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" 
		rel="stylesheet"
	/>
    <link rel="stylesheet" href="style/reset.css" />
    <link rel="stylesheet" href="style/style.css" />
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>
<body>
<?php
    if (isset($_GET['action']) && $_GET['action'] == 'send') {
        $secret = 'your_secret_key';
        $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . $secret . '&response=' . $_POST['g-recaptcha-response']);
        $responseData = json_decode($verifyResponse);
        if (!$responseData->success) {
            $error = "You have not verified Captcha";
        }
?>
<div class="container">
    <div class="error">
        <?php 
            if(isset($error)) {
                echo "<p>" . $error . "</p>"; 
            } else {
                echo "<p>Verified successfully</p>";  
            }
        ?>
        <a href="index.php">Back</a>
    </div>
</div>
<?php } else { ?>
<div class="container">
    <form action="?action=send" class="form" method="post" enctype="multipart/form-data">
        <p>Who are you?</p>
        <div class="g-recaptcha" data-sitekey="your_site_key"></div>
        <input type="submit" value="Submit" />
    </form>
</div>
<?php } ?>
</body>
</html>