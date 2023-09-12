<?php
session_start();
?>
<?php
$pythonScriptPath = "C:\\xampp\\htdocs\\Stage\\python_script"; // Replace with your actual path
$command = 'cd ' . $pythonScriptPath . ' && python main.py'; // Navigate to the directory and execute the script
$output = shell_exec($command);

#echo "<pre>$output</pre>";
?>
<?php
    $command = escapeshellcmd('python ../python script/main.py');
    $output = shell_exec($command);
    echo $output;
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!-- Boxicons -->
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
	<!-- My CSS -->
	<link rel="stylesheet" href="style.css">

	<title>AdminHub</title>
	<script src="table2excel.js"> </script>

</head>
<body>
	<?php
    require_once ('../database.php');
	$conn = config::getConnexion();
	$requete="SELECT * FROM mail_data";
	$query=$conn->prepare($requete);
	$query->execute();
	$result=$query->fetchAll(PDO::FETCH_ASSOC);

	$requete2="SELECT count(*) AS mail_count FROM mail_data";
	$query2=$conn->prepare($requete2);
	$query2->execute();
	$result2 = $query2->fetch(PDO::FETCH_ASSOC);
	$mailCount = $result2['mail_count'];

    ?>
	<!-- SIDEBAR -->
	<section id="sidebar">
		<a href="#" class="brand">
			<i class='bx bxs-smile'></i>
			<span class="text">Esprit</span>
		</a>
		<ul class="side-menu top">
			<li class="active">
				<a href="#">
					<i class='bx bxs-dashboard' ></i>
					<span class="text">Tableau De Bord</span>
				</a>
			</li>
			<li>
				<a href="page_admin.php">
					<i class='bx bxs-message-dots' ></i>
					<span class="text">Réclamations</span>
				</a>
			</li>
			<li>
				<a href="../reclamation.html">
					<i class='bx bxs-message-dots' ></i>
					<span class="text">Envoyer une Réclamation</span>
				</a>
			</li>
			<?php
			if($_SESSION["Role"]=="admin")
			{
			echo('<li>
				<a href="../signup.html">
					<i class="bx bxs-group" ></i>
					<span class="text">Créer Compte</span>
				</a>
			</li>');
			}
			?>
		</ul>
		<ul class="side-menu">
			<li>
				<a href="#">
					<i class='bx bxs-cog' ></i>
					<span class="text">Paramètres
					</span>
				</a>
			</li>
			<li>
				<a href="deconnexion.php" class="logout">
					<i class='bx bxs-log-out-circle' ></i>
					<span class="text">Se déconnecter
					</span>
				</a>
			</li>
		</ul>
	</section>
	<!-- SIDEBAR -->
	<!-- CONTENT -->
	<section id="content">
		<!-- NAVBAR -->
		<nav>
			<i class='bx bx-menu' ></i>
			<a href="#" class="nav-link">Categories</a>
			<form>
				<div class="form-input">
					<input type="search" id="searchInput" placeholder="Rechercher..." name="search">
					<button id="searchButton" class="search-btn"><i class='bx bx-search' ></i></button>
				</div>
			</form>
			<input type="checkbox" id="switch-mode" hidden>
			<label for="switch-mode" class="switch-mode"></label>
			<a href="#" class="notification">
				<i class='bx bxs-bell' ></i>
				<span class="num">8</span>
			</a>
			<a href="#" class="profile">
				<img src="img/jawher.jpg">
			</a>
		</nav>
		<!-- NAVBAR -->

		<!-- MAIN -->
		<main>
			<div class="head-title">
				<div class="left">
					<h1>Tableau de bord</h1>
					<ul class="breadcrumb">
						<li>
							<a href="#">Tableau de bord</a>
						</li>
						<li><i class='bx bx-chevron-right' ></i></li>
						<li>
							<a class="active" href="#">Acceuil</a>
						</li>
					</ul>
				</div>
				<a href="#" class="btn-download" id="downloadexcel">
					<i class='bx bxs-cloud-download' ></i>
					<span class="text">Télecharger Excel</span>
				</a>		
			</div>

			<ul class="box-info">
				<li>
					<i class='bx bxs-calendar-check' ></i>
					<span class="text">
						<h3><?php echo $mailCount; ?></h3>
						<p>Mails</p>
					</span>
				</li>
				<li>
					<i class='bx bxs-group' ></i>
					<span class="text">
						<h3>1</h3>
						<p>Visiteurs</p>
					</span>
				</li>
			</ul>
			<div class="table-data">
				<div class="order">
					<div class="head">
						<h3>Mails récentes</h3>
						<i class='bx bx-search' ></i>
						<i class='bx bx-filter' ></i>
					</div>
					<table id="example-table">
						<thead>
							<tr>
								<th>Email</th>
								<th>Pays</th>
								<th>Type d'offre</th>
								<th>Entreprise</th>
								<th>Compétences requises</th>
								<th>Durée de stage</th>
								<th>Département</th>
							</tr>
						</thead>
						<tbody>
    						<?php
    							foreach($result as $row) {
        						echo '<tr>';
        						echo '<td><a href="hello.php?t1_id=' . $row['msg_id'] . '">' . $row['email'] . '</a></td>';
        						echo '<td>' . $row['region'] . '</td>'; 
        						echo '<td>' . $row['offer_type'] . '</td>'; 
        						echo '<td>' . $row['comp_name'] . '</td>'; 
        						echo '<td>' . $row['req_skills'] . '</td>'; 
        						echo '<td>' . $row['duration'] . '</td>'; 
        						echo '<td>' . $row['dept_name'] . '</td>'; 
        						echo '</tr>';
    							}
   							?>
						</tbody>
					</table>
					<script> document.getElementById('downloadexcel').addEventListener('click',function()
					{
						var table2excel = new Table2Excel();
                        table2excel.export(document.querySelectorAll("#example-table"));
					});  
					</script>
					<script>
    					// Add an event listener to all anchor tags within the table
    					var tableRows = document.querySelectorAll('tbody tr td a');
    					tableRows.forEach(function(row) {
        					row.addEventListener('click', function(event) {
            				event.preventDefault(); // Prevent default link behavior
            			var t1_id = this.getAttribute('href').split('=')[1]; // Get the t1_id from the link
            			window.location.href = '../attachments.php?t1_id=' + t1_id; // Redirect to hello.php with t1_id parameter
        					});
    					});
					</script>
					<script>
        document.addEventListener("DOMContentLoaded", function () {
            const searchInput = document.getElementById("searchInput");
            const searchButton = document.getElementById("searchButton");
            const dataTable = document.getElementById("example-table");
            const rows = dataTable.querySelectorAll("tbody tr");

            searchButton.addEventListener("click", function () {
				event.preventDefault();
                const searchText = searchInput.value.toLowerCase();
                const filteredRows = Array.from(rows).filter(row => {
                    const cells = row.querySelectorAll("td");
                    return Array.from(cells).some(cell => cell.textContent.toLowerCase().includes(searchText));
                });

                // Hide all rows
                rows.forEach(row => (row.style.display = "none"));

                // Show filtered rows
                filteredRows.forEach(row => (row.style.display = ""));
            });
        });
    </script>
				</div>
			</div>
		</main>
		<!-- MAIN -->
	</section>
	<!-- CONTENT -->
	<script src="script.js"></script>
</body>
</html>