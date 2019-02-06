<?php session_start(); ?>

<div id="top-nav">
	<ul>
		<li><a href="Home.php">Home Page</a></li>

		<!-- user page -->
		<?php if (isset($_SESSION['user'])) { ?> <li><a href="user.php">User</a></li> <?php } ?>

		<!-- admin page -->
		<?php if (isset($_SESSION['admin'])) { ?> <li><a href="admin.php">Admin</a></li> <?php } ?>

		<!-- Posting an Ad page -->
		<?php if (isset($_SESSION['user'])) { ?> <li><a href="Have%20something%20to%20sell.php">Have Something to Sell</a></li> <?php } ?>

		<!-- general search -->
		<li><a href="Browse%20available%20good.php">Browse Available Goods</a></li>
		
		<li><a href="store.php">Store</a></li>

		<!-- logout -->
		<?php if (isset($_SESSION['user'])||isset($_SESSION['admin'])) { ?> <li><a href="logout.php">Logout</a><li> <?php } ?>
	</ul>
</div>