<?php

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

?>

<!DOCTYPE html>
<html lang="cs">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>RedlineMC.net &ndash; Banlist</title>
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link
        href="https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
        rel="stylesheet">
    <link rel="shortcut icon" href="../public/images/favicon.ico">
    <link rel="stylesheet" href="../public/css/style.css">
</head>

<body>
    <main>
        <header id="particles-js" class="d-flex flex-column small">
            <div class="bars">
            </div>
            <div class="navigation d-flex justify-content-between align-items-center row">
                <div class="left d-flex align-items-center">
                    <div class="logo"></div>
                    <p>play.redlinemc.net</p>
                    <nav class="nav">
                        <a class="nav-link" href="../">Home</a>
                        <a class="nav-link" href="/adminteam">AdminTeam</a>
                        <a class="nav-link" href="/shop">Shop</a>
                        <a class="nav-link" href="/blog">Blog</a>
                        <div class="nav-link dropdown">
                            <span>Dropdown</span>
                            <div class="dropdown-content">
                                <a class="nav-link" href="#">Link 1</a>
                                <a class="nav-link" href="#">Link 2</a>
                                <a class="nav-link" href="#">Link 3</a>
                            </div>
                        </div>
                    </nav>
                </div>
            </div>
            <div class="content m-auto">
                <h1>BanList</h1>
            </div>
        </header>

        <section id="banlist">
            <div class="row">
                <div class="info">
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris in felis ac arcu sodales lobortis
                        sit amet non dui.<br>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris in felis ac
                        arcu sodales lobortis sit amet non dui.</p>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Type</th>
                                <th scope="col">ID</th>
                                <th scope="col">Player</th>
                                <th scope="col">Admin</th>
                                <th scope="col">Reason</th>
                                <th scope="col">Expire</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                include '../database.php';
				    	    	$db = mysqli_connect($db_host, $db_user, $db_password, $db_bans);
				    	    	$db->set_charset("utf8");
				    	    	$selectban = mysqli_query($db, "SELECT * FROM `Punishments` ORDER BY `Punishments`.`id` DESC");
				    	    	while ($row = mysqli_fetch_assoc($selectban)) {
				    	    		if ($row['operator'] == null) {
				    	    			$row['operator'] = 'Console';
				    	    		}
				    	    		if ($row['reason'] == 'none') {
				    	    			$row['reason'] = 'The reason was not specified.';
				    	    		}
				    	    		if ($row['end'] == -1) {
				    	    			$expire = '<span class="badge badge-danger">Never</span>';
				    	    		} else {
				    	    			$expire = '<span class="badge badge-success">' . date("H:i:s d.m.Y", ($row['end'])) . '</span>';
                                    }
                                    if ($row['punishmentType'] == 'KICK') {
                                        $type = '<td class="kick">Kick</td>';
                                    } else if ($row['punishmentType'] == 'MUTE' || $row['punishmentType'] == 'TEMP_MUTE') {
                                        $type = '<td class="mute">Mute</td>';
                                    } else if ($row['punishmentType'] == 'BAN' || $row['punishmentType'] == 'TEMP_BAN' || $row['punishmentType'] == 'IP_BAN' || $row['punishmentType'] == 'TEMP_IP_BAN') {
                                        $type = '<td class="ban">Ban</td>';
                                    } else if ($row['punishmentType'] == 'WARNING' || $row['punishmentType'] == 'TEMP_WARNING') {
                                        $type = '<td class="warn">Warn</td>';
                                    }
                                    echo '<tr>';
                                        echo $type;
				    	    			echo '<td>' . $row['id'] . '</td>';
				    	    			echo '<td><img src="https://minotar.net/avatar/' . $row['name'] . '/30" alt=""> ' . $row['name'] . '</td>';
				    	    			echo '<td><img src="https://minotar.net/avatar/' . $row['operator'] . '/30" alt=""> ' . $row['operator'] . '</td>';
				    	    			echo '<td>' . $row['reason'] . '</td>';
				    	    			echo '<td>' . $expire . '</td>';
				    	    		echo '</tr>';
				    	    	}
				    	    	mysqli_close($db);
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
        <footer>
            <div class="row">
                <div class="col-md-10 offset-md-1 row align-items-center">
                    <div class="col-md info">
                        <p>Juega con nosotros!</p>
                        <p class="ip">play.redlinemc.net</p>
                    </div>
                    <div class="col-md copyright">
                        <p>We are not affiliated with mojang.</p>
                        <p>&copy; <span class="year"></span> RedlineMC.net &ndash; | &ndash; All rights reserved.</p>
                    </div>
                </div>
            </div>
        </footer>
    </main>

    <script type="text/javascript" src="../public/js/particles.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
    <script src="../public/js/main.js"></script>
    <script>
    $('.year').text(new Date().getFullYear());
    </script>
</body>

</html>