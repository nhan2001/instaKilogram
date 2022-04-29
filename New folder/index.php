<!-- This file will be included in every php files -->
<html>
	<body>
		<header>
		<!-- May change logo to avoid name conflict -->
			<div class="logo">
            <a href="index.html">
                <img src="logo.png" alt="logos" align="left"></a>
			</div>
			<h1><?php  
				for ($x = 1; $x <= 15; $x++) {
				echo "&nbsp";
}
				?>   InstaKilogram</h1> 
			<?php  
				for ($x = 1; $x <= 160; $x++) {
				echo "&nbsp";
}
				?>
			<a href="index.html">Login</a> <!-- index.html -->
		</header> <br>
		<hr>
		<!-- Main... -->
		<footer>
		<!-- Create files for each php files. Each may include this php file -->
		<?php
			echo '<a href="About.php">About</a> -
			<a href="Copyright.php">Copyright</a> -
			<a href="Privacy.php">Privacy</a> -
			<a href="Help.php">Help</a>';
		?>
		</footer>
	</body>
</html>