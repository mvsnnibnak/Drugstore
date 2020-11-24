<?php
$dbc = mysqli_connect('localhost', 'root', 'root', 'form');
if(!isset($_COOKIE['user_id'])) {
    if(isset($_POST['submit'])) {
        $user_username = mysqli_real_escape_string($dbc, trim($_POST['username']));
        $user_password = mysqli_real_escape_string($dbc, trim($_POST['password']));

        if(!empty($user_username) && !empty($user_username)) {
            $query = "SELECT `user_id` , `username` FROM `signup` WHERE 
            username = '$user_username' AND password = ('$user_password')";
            $data =mysqli_query($dbc, $query);
            if(mysqli_num_rows($data) == 1) {
                $row = mysqli_fetch_assoc($data);
                setcookie('user_id', $row['user_id'], time() + (60*60*24*30));
                setcookie('username', $row['username'], time() + (60*60*24*30));
                $home_url = 'http://' . $_SERVER['HTTP_HOST'];
                header('Location: '. $home_url);
            } 
            else {
                echo 'Вибачте, ви повинні ввести правильно імя користувача и пароль ';
            } 
        }
            else {
                echo 'Вибачте ви повинні заповнити поле вірно';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Аптека</title>
    <link rel="stylesheet" href="Style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" />
</head>
<body class="bgReg">
    <header class="menu">

    <label for="checkbox-menu">
				<ul class="menu touch">
                    <li><a class = "logo" href="Index.html">PALPITATION</a></li>
                    <li><a href="Index.html">Tablets</a></li>
					<li><a href="Rent_page.php">Buy Form</a></li>
					<li><a href="admin.html">Buy Now</a></li>
                    <li><a href="history_rent.html">History Buy</a></li>
                    <li><a href="Signup.php">Registration</a></li>
                    <li><a href="audentefication.php">Audentification</a></li>
				</ul>
            </label>
            
    </header>
    

	<div class="main-signin">
        <?php
            if(empty($_COOKIE['username'])){
        ?>
		<div class="main-signin__head">
			<p>Audentificate</p>
		</div>
		<form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
		<div class="main-signin__middle">
			<div class="middle__form">
            <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
				<input type="text" name="username" placeholder="Login">
                <input type="password" name="password" placeholder="Password">
                <input type="submit" name="submit" value="SEND">
            </form>
			</div>
		</div>
		<div class="main-signin__foot">
			<div class="foot__left">
				<p>Submit abroud:</p>
			</div>
			<div class="foot__right">
                <br />
                <a style=" color:white" href="signup.php">Реєстрація</a>
            </div>
        </div>
        <?php
            }
            else {
                ?>
                <div class="menu_aud">
                <p><a href="myprofile.php">Мій профіль</a></p>
                <p><a href="exit.php">Вийти</a></p>
            </div>
                <?php
            }
            ?>
	</div>
    
    <script src="Script.js"></script>
    
</body>
</html>