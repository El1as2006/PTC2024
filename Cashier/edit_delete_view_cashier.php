<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require '../lang/lang.php';
require_once '../funcs/funcs.php';
$conn = include_once "../conexion.php";

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
	header('Location: ../login_view.php');
	exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Modern, flexible and responsive Bootstrap 5 admin &amp; dashboard template">
	<meta name="author" content="Bootlab">
	<link rel="stylesheet" href="../package/dist/sweetalert2.css">
	<script src="../package/dist/sweetalert2.min.js"></script>
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

	<title>Edit-Delete Users Cashier</title>
	<style>
		body {
			opacity: 0;
		}
	</style>
	<script src="../js/settings_admin.js"></script>
	<!-- END SETTINGS -->
	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-120946860-7"></script>
	<script>
		window.dataLayer = window.dataLayer || [];

		function gtag() {
			dataLayer.push(arguments);
		}
		gtag('js', new Date());

		gtag('config', 'UA-120946860-7');
	</script>
</head>
<body>
	<div class="wrapper">
	<nav id="sidebar" class="sidebar">
            <a class='sidebar-brand' href='index_view_cashier.php'>
                <img src="../assets/images/banko logos-03.png" width="130px" />
            </a>
            <div class="sidebar-content">
                <div class="sidebar-user">

                    <img src="../img/avatars/profile-use.png" class="img-fluid rounded-circle mb-2" alt="" />
                    <div class="fw-bold"><?php
                                            echo ($_SESSION['username']); ?></div>
                    <small>Cashier</small>
                </div>

                <ul class="sidebar-nav">
                    <li class="sidebar-header">
                        Main
                    </li>
                    <li class="sidebar-item">
						<a class='sidebar-link' href='index_view_cashier.php'>
							<i class="align-middle me-2" data-feather="home"></i> <span class="align-middle"><?= lang("Principal Index") ?></span>
						</a>
					</li>
					<li class="sidebar-item"> 
                        <a class='sidebar-link' href='createuser_view_cashier.php'>
                            <i class="align-middle me-2 far fa-fw fa-user"></i> <span
                                class="align-middle"><?= lang("Create New User"); ?></span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class='sidebar-link' href='edit_delete_view.php'>
                            <i class="align-middle me-2" data-feather="users"></i> <span class="align-middle"><?= lang("Edit/Delete Users"); ?></span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class='sidebar-link' href='addingaccounts_cashier.php'>
                            <i class="align-middle me-2 far fa-fw fa-dollar-sign"></i> <span class="align-middle"><?= lang("Add Bank Account") ?></span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class='sidebar-link' href='addingcards_cashier.php'>
                            <i class="align-middle me-2 far fa-fw fa-credit-card"></i> <span class="align-middle"><?= lang("Add Debit/Credit Card") ?></span>
                        </a>
                    </li>

                </ul>
            </div>
        </nav>
		<div class="main">
			<nav class="navbar navbar-expand navbar-theme">
				<a class="sidebar-toggle d-flex me-2">
					<i class="hamburger align-self-center"></i>
				</a>
				<div class="navbar-collapse collapse">
					<ul class="navbar-nav ms-auto">
						<li class="nav-item dropdown ms-lg-2">
							<a class="nav-link dropdown-toggle position-relative" href="#" id="userDropdown"
								data-bs-toggle="dropdown">
								<i class="align-middle fas fa-language"></i>
							</a>
							<div class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
								<a class="dropdown-item" href="edit_delete_view.php?lang=en"><i
										class="align-middle me-1 fas fa-fw fa-user"></i> English</a>
								<div class="dropdown-divider"></div>
								<a class="dropdown-item" href="edit_delete_view.php?lang=es"><i
										class="align-middle me-1 fas fa-fw fa-comments"></i> Español</a>
								<div class="dropdown-divider"></div>
								<a class="dropdown-item" href="edit_delete_view.php?lang=de"><i
										class="align-middle me-1 fas fa-fw fa-comments"></i> Deutsch</a>
							</div>
						</li>
						<li class="nav-item dropdown ms-lg-2">
							<a class="nav-link dropdown-toggle position-relative" href="#" id="userDropdown"
								data-bs-toggle="dropdown">
								<i class="align-middle fas fa-cog"></i>
							</a>
							<div class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
								<a class="dropdown-item" href="../logout.php"><i
										class="align-middle me-1 fas fa-fw fa-arrow-alt-circle-right"></i><?= lang("Sign out") ?></a>
							</div>
						</li>
					</ul>
				</div>
			</nav>
			<main class="content">
				<div class="container-fluid">
					<div class="header">
						<h1 class="header-title">
							<?= lang("Edit/Delete Users") ?>
						</h1>
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb">

							</ol>
						</nav>
					</div>
					<div class="col-12">
						<div class="card">
							<div class="card-header">
								<h5 class="card-title"><?= lang("Always responsive") ?></h5>
								<h6 class="card-subtitle text-muted"> </h6>
							</div>
							<form action="edit_delete_view_cashier.php" method="POST">
								<div class="card-body">
									<div class="row">
										<div class="col-sm-12 col-md-6">
											<div id="datatables-buttons_filter" class="dataTables_filter">
												<label><?= Lang("Search by DUI:") ?>
													<input type="text" id="letra" name="letra"
														class="form-control form-control-sm" placeholder="00000000-0"
														aria-controls="datatables-buttons" maxlength="10">
												</label>
												<button type="submit"
													class="btn btn-primary"><?= lang("Search") ?></button>
											</div>
										</div>
									</div>
								</div>
							</form>
							<div class="table-responsive">
								<table class="table table-striped">
									<thead>
										<tr>
											<th style="width:20%;"><?= lang("Name") ?></th>
											<th style="width:15%"><?= lang("Username") ?></th>
											<th style="width:15%">DUI</th>
											<th class="d-none d-md-table-cell" style="width:20%">Email</th>

										</tr>
									</thead>
									<tbody>
									<?php
									$i = [];

									if ($_SERVER["REQUEST_METHOD"] == "POST") {

										if (empty($_POST['letra'])) {
											echo "<script>
													Swal.fire({ 
														title: 'This field is required', 
														text: 'Please fill in DUI field.', 
														icon: 'error', 
														button: 'Close' 
													}).then(function() {
														window.location = 'edit_delete_view.php';
													});
												</script>";
											exit;
										} else {
											$letra = htmlspecialchars(trim($_POST["letra"]));
											$encrypted_dui = encryptPayload($letra);

											$pgsql = "SELECT * FROM users WHERE dui LIKE :letra";
											$stmt = $conn->prepare($pgsql);
											$stmt->execute([':letra' => "%$letra%"]);
											$i = $stmt->fetchAll(PDO::FETCH_ASSOC);

											$data = [];
											foreach ($i as $row) {
												$decrypted_row = [
													'name' => $row['name'],
													'username' => $row['username'],
													'dui' => decryptPayload($row['dui']),
													'email' => decryptPayload($row['email']),
													'id' => $row['id'] 
												];
												$data[] = $decrypted_row;
											}

											function filterArray($item) {
												global $letra;
												return stripos($item['dui'], $letra) !== false;
											}

											$filteredData = array_filter($data, 'filterArray');
										}

										if (!empty($filteredData)) {
											foreach ($filteredData as $data) { ?>
												<tr>
													<td class="d-none d-xl-table-cell">
														<?php echo htmlspecialchars($data["name"]); ?>
													</td>
													<td class="d-none d-xl-table-cell">
														<?php echo htmlspecialchars($data["username"]); ?>
													</td>
													<td class="d-none d-xl-table-cell">
														<?php echo htmlspecialchars($data['dui']); ?>
													</td>
													<td class="d-none d-md-table-cell">
														<?= htmlspecialchars($data['email']); ?>
													</td>
													<td class="table-action">
														<a href="edituser_view.php?id=<?php echo urlencode($data['id']); ?>"
														class="btn btn-outline-primary"><?= Lang("Edit") ?></a>
													</td>
													<td class="table-action">
														<a href="../deleteuser.php?id=<?php echo urlencode($data['id']); ?>"
														class="btn btn-outline-primary"><?= Lang("Delete") ?></a>
													</td>
													<td class="table-action">
														<a href="../deactivateuser.php?id=<?php echo urlencode($data['id']); ?>"
														class="btn btn-outline-primary"><?= Lang("Desactivate") ?></a>
													</td>
													<td class="table-action">
														<a href="../activateuser.php?id=<?php echo urlencode($data['id']); ?>"
														class="btn btn-outline-primary"><?= Lang("Activate") ?></a>
													</td>
												</tr>
											<?php }
										} else {
											echo "<tr><td colspan='8'>No results found.</td></tr>";
										}
									}
								?>
</tbody>

								</table>
							</div>
						</div>
					</div>
				</div>
			</main>
			<footer class="footer">
				<div class="container-fluid">
					<div class="row text-muted">
						<div class="col-8 text-start">

						</div>
						<div class="col-4 text-end">
							<p class="mb-0">
								&copy; 2024 - <a class='text-muted' href='index_view_cashier.php'>Banko</a>
							</p>
						</div>
					</div>
				</div>
			</footer>
		</div>
	</div>
	<svg width="0" height="0" style="position:absolute">
		<defs>
			<symbol viewBox="0 0 512 512" id="ion-ios-pulse-strong">
				<path
					d="M448 273.001c-21.27 0-39.296 13.999-45.596 32.999h-38.857l-28.361-85.417a15.999 15.999 0 0 0-15.183-10.956c-.112 0-.224 0-.335.004a15.997 15.997 0 0 0-15.049 11.588l-44.484 155.262-52.353-314.108C206.535 54.893 200.333 48 192 48s-13.693 5.776-15.525 13.135L115.496 306H16v31.999h112c7.348 0 13.75-5.003 15.525-12.134l45.368-182.177 51.324 307.94c1.229 7.377 7.397 11.92 14.864 12.344.308.018.614.028.919.028 7.097 0 13.406-3.701 15.381-10.594l49.744-173.617 15.689 47.252A16.001 16.001 0 0 0 352 337.999h51.108C409.973 355.999 427.477 369 448 369c26.511 0 48-22.492 48-49 0-26.509-21.489-46.999-48-46.999z">
				</path>
			</symbol>
		</defs>
	</svg>
	<script src="../js/app.js"></script>

	<script>
		document.addEventListener('DOMContentLoaded', function () {
			const cardNumberInput = document.getElementById('card_number');

			cardNumberInput.addEventListener('input', function (e) {
				// Elimina caracteres no permitidos
				const currentValue = e.target.value.replace(/\D/g, '');

				// Aplica mascara al numero de tarjeta
				let maskedValue = '';
				for (let i = 0; i < currentValue.length; i++) {
					if (i > 0 && i % 4 === 0) {
						maskedValue += '-';
					}
					maskedValue += currentValue[i];
				}

				// limitar el numero de tarjeta a 16 caracteres
				maskedValue = maskedValue.slice(0, 19);

				// actualiza el valor del campo de entrada
				e.target.value = maskedValue;
			});
		});
	</script>
	<script>
		document.addEventListener('DOMContentLoaded', function () {
			const duiInput = document.getElementById('letra');

			duiInput.addEventListener('input', function (e) {
				// elimina caracteres no permitidos
				const currentValue = e.target.value.replace(/\D/g, '');

				// aplica mascara al dui
				let maskedValue = '';
				for (let i = 0; i < currentValue.length; i++) {
					if (i === 8) {
						maskedValue += '-';
					}
					maskedValue += currentValue[i];
				}

				// limitar el dui a 10 caracteres
				maskedValue = maskedValue.slice(0, 10);

				// actualiza el valor del campo de entrada
				e.target.value = maskedValue;
			});
		});
	</script>
</body>
</html