<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require '../lang/lang.php';
require '../funcs/funcs.php';
$conn = include_once "../conexion.php";

if (!isset($_SESSION['logged_admin']) || $_SESSION['logged_admin'] !== true) {
    header('Location: ../login_view.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Modern, flexible and responsive Bootstrap 5 admin &amp; dashboard template">
	<meta name="author" content="Bootlab">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

	<title>Adding Bank Accounts</title>
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
	    <style>
        .tableresponsive {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }
    </style>
    <style>
    th {
        cursor: pointer;
        position: relative;
        padding-right: 30px; /* Aumenta el padding para más separación */
    }
    th .sort-arrow {
        position: absolute;
        right: 10px; /* Ajusta la posición de las flechas */
    }
    .asc::after {
        content: "\f0de"; /* Unicode de fa-arrow-up */
        font-family: "Font Awesome 5 Free";
        font-weight: 900;
        color: black; /* Cambia esto al color que prefieras */
    }
    .desc::after {
        content: "\f0dd"; /* Unicode de fa-arrow-down */
        font-family: "Font Awesome 5 Free";
        font-weight: 900;
        color: black; /* Cambia esto al color que prefieras */
    }
    </style>
</head>

<body>
	<div class="wrapper">
		<nav id="sidebar" class="sidebar">
			<a class='sidebar-brand' href='index_view.php'>
				<img src="../assets/images/banko logos-03.png" width="130px" />
			</a>
			<div class="sidebar-content">



				<div class="sidebar-user">
					<img src="../img/avatars/profile-use.png" class="img-fluid rounded-circle mb-2" alt="" />
					<div class="fw-bold"><?php
											echo $_SESSION["username"]; ?></div>
					<small>Admin</small>
				</div>
				<ul class="sidebar-nav">
					<li class="sidebar-header">
						Main
					</li>
					<li class="sidebar-item">
						<a class='sidebar-link' href='index_view.php'>
							<i class="align-middle me-2" data-feather="home"></i> <span class="align-middle"><?= lang("Principal Index") ?></span>
						</a>
					</li>
					<li class="sidebar-item">
						<a class='sidebar-link' href='createuser_view.php'>
							<i class="align-middle me-2 far fa-fw fa-user"></i> <span class="align-middle"><?= lang("Create New User") ?></span>
						</a>
					</li>
					<li class="sidebar-item">
                        <a class='sidebar-link' href='edit_delete_view.php'>
                            <i class="align-middle me-2" data-feather="users"></i> <span class="align-middle"><?= lang("Edit/Delete Users"); ?></span>
                        </a>
                    </li>
					<li class="sidebar-item">
						<a class='sidebar-link' href='addingcards.php'>
							<i class="align-middle me-2 far fa-fw fa-credit-card"></i> <span class="align-middle"><?= lang("Add Debit/Credit Card") ?></span>
						</a>
					</li>
					<li class="sidebar-item">
                        <a class='sidebar-link' href='listingtransferences_view.php'>
                            <i class="align-middle me-2" data-feather="book"></i> <span class="align-middle"><?= lang("Listing Transferences") ?></span>
                        </a>
                    </li>
					<li class="sidebar-item">
                        <a class='sidebar-link' href='listingpayments_view.php'>
                            <i class="align-middle me-2 far fa-fw fa-credit-card"></i> <span class="align-middle"><?= lang("Listing Payments") ?></span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class='sidebar-link' href='listingcharges_view.php'>
                            <i class="align-middle me-2 fas fa-fw fa-donate"></i> <span class="align-middle"><?= lang("Listing Charges") ?></span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class='sidebar-link' href='listingcardspayment_view.php'>
                            <i class="align-middle me-2 far fa-fw fa-credit-card"></i> <span class="align-middle"><?= lang("Listing Cards Payment") ?></span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class='sidebar-link' href='passrecord_view.php'>
                            <i class="align-middle me-2" data-feather="eye-off"></i> <span class="align-middle"><?= lang("Record of password changes") ?></span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class='sidebar-link' href='bank_applications.php'>
                            <i class="align-middle me-2 far fa-fw fa-user"></i> <span class="align-middle"><?= lang("Clients Requests") ?></span>
                        </a>
                    </li>
				</ul>


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
							<a class="nav-link dropdown-toggle position-relative" href="#" id="userDropdown" data-bs-toggle="dropdown">
								<i class="align-middle fas fa-language"></i>
							</a>
							<div class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
								<a class="dropdown-item" href="addingaccounts.php?lang=en"><i class="align-middle me-1 fas fa-fw fa-user"></i> English</a>
								<div class="dropdown-divider"></div>
								<a class="dropdown-item" href="addingaccounts.php?lang=es"><i class="align-middle me-1 fas fa-fw fa-comments"></i> Español</a>
								<div class="dropdown-divider"></div>
								<a class="dropdown-item" href="addingaccounts.php?lang=de"><i class="align-middle me-1 fas fa-fw fa-comments"></i> Deutsch</a>
							</div>
						</li>
						<li class="nav-item dropdown ms-lg-2">
							<a class="nav-link dropdown-toggle position-relative" href="#" id="userDropdown" data-bs-toggle="dropdown">
								<i class="align-middle fas fa-cog"></i>
							</a>
							<div class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
								<a class="dropdown-item" href="../logout.php"><i class="align-middle me-1 fas fa-fw fa-arrow-alt-circle-right"></i><?= lang("Sign out") ?></a>
							</div>
						</li>
					</ul>
				</div>
			</nav>
			<main class="content">
				<div class="container-fluid">
					<div class="header">
						<h1 class="header-title">
							<?= lang("Adding Bank Accounts") ?>
						</h1>
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb">

							</ol>
						</nav>
					</div>
					<div class="col-12">
					<div class="col-12">
    <div class="card">
        <div class="card-header">
            <h5 class="card-title"><?= lang("Always responsive") ?></h5>
            <h6 class="card-subtitle text-muted"></h6>
        </div>
        <div class="table-responsive">
            <table class="table table-striped">

                <?php
                // Configuración de la paginación
                $limit = 8; 
                $page = isset($_GET['page']) ? (int)$_GET['page'] : 1; 
                $offset = ($page - 1) * $limit;

                // Consulta paginada
                $resultado = $conn->prepare("SELECT * FROM users LIMIT :limit OFFSET :offset");
                $resultado->bindParam(':limit', $limit, PDO::PARAM_INT);
                $resultado->bindParam(':offset', $offset, PDO::PARAM_INT);
                $resultado->execute();
                $i = $resultado->fetchAll(PDO::FETCH_ASSOC);

                // Contar el número total de usuarios
                $stmt2 = $conn->query("SELECT COUNT(*) as total FROM users");
                $total_rows = $stmt2->fetch(PDO::FETCH_ASSOC)['total'];
                $total_pages = ceil($total_rows / $limit);
                ?>
                <thead>
                    <tr>
                        <th style="width:20%;" data-sort="name">
                            <?= lang("Name") ?>
                            <span class="sort-arrow"></span>
                        </th>
                        <th style="width:15%" data-sort="username">
                            <?= lang("Username") ?>
                            <span class="sort-arrow"></span>
                        </th>
                        <th style="width:15%" data-sort="dui">
                            DUI
                            <span class="sort-arrow"></span>
                        </th>
                        <th class="d-none d-md-table-cell" style="width:20%" data-sort="email">
                            Email
                            <span class="sort-arrow"></span>
                        </th>
                        <th style="width:15%" data-sort="actions">
                            <?= lang("Actions") ?>
                            <span class="sort-arrow"></span>
                        </th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    foreach ($i as $data) { ?>
                        <tr>
                            <td>
                                <?php echo $data["name"] ?>
                            </td>
                            <td>
                                <?php echo $data["username"] ?>
                            </td>
                            <td>
                                <?php echo decryptPayload($data['dui']) ?>
                            </td>
                            <td class="d-none d-md-table-cell">
                                <?= decryptPayload($data['email']) ?>
                            </td>
															<td class="table-action">
									<a href="generateaccount.php?id=<?php echo $data['id'];?>" class="btn btn-outline-primary">
										<i class="fas fa-eye"></i> <?= lang("View Account") ?>
									</a>
								</td>

                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        <div class="card-body"> 
            <div class="col-sm-12 col-md-7">
                <div class="dataTables_paginate paging_simple_numbers" id="datatables-dashboard-projects_paginate">
                    <ul class="pagination pagination-md">
                        <!-- Botón "Previous" -->
                        <?php if ($page > 1) { ?>
                            <li class="page-item"><a class="page-link" href="?page=<?= ($page - 1) ?>"><i class="fas fa-angle-left"></i></a></li>
                        <?php } else { ?>
                            <li class="page-item disabled"><span class="page-link"><i class="fas fa-angle-left"></i></span></li>
                        <?php } ?>
    
                        <!-- Números de página -->
                        <?php for ($i = 1; $i <= $total_pages; $i++) { ?>
                            <li class="page-item <?= ($i == $page) ? 'active' : '' ?>"><a class="page-link"
                                    href="?page=<?= $i ?>"><?= $i ?></a></li>
                        <?php } ?>
    
                        <!-- Botón "Next" -->
                        <?php if ($page < $total_pages) { ?>
                            <li class="page-item"><a class="page-link" href="?page=<?= ($page + 1) ?>"><i class="fas fa-angle-right"></i></a></li>
                        <?php } else { ?>
                            <li class="page-item disabled"><span class="page-link"><i class="fas fa-angle-right"></i></span></li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </div>
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
								&copy; 2024 - <a class='text-muted' href='index_view.php'>Banko</a>
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
				<path d="M448 273.001c-21.27 0-39.296 13.999-45.596 32.999h-38.857l-28.361-85.417a15.999 15.999 0 0 0-15.183-10.956c-.112 0-.224 0-.335.004a15.997 15.997 0 0 0-15.049 11.588l-44.484 155.262-52.353-314.108C206.535 54.893 200.333 48 192 48s-13.693 5.776-15.525 13.135L115.496 306H16v31.999h112c7.348 0 13.75-5.003 15.525-12.134l45.368-182.177 51.324 307.94c1.229 7.377 7.397 11.92 14.864 12.344.308.018.614.028.919.028 7.097 0 13.406-3.701 15.381-10.594l49.744-173.617 15.689 47.252A16.001 16.001 0 0 0 352 337.999h51.108C409.973 355.999 427.477 369 448 369c26.511 0 48-22.492 48-49 0-26.509-21.489-46.999-48-46.999z">
				</path>
			</symbol>
		</defs>
	</svg>
	<script src="../js/app.js"></script>
	<script>
        document.querySelectorAll('th[data-sort]').forEach(th => {
            th.addEventListener('click', () => {
                const table = th.closest('table');
                const tbody = table.querySelector('tbody');
                const rows = Array.from(tbody.querySelectorAll('tr'));
                const index = Array.from(th.parentNode.children).indexOf(th);
                const order = th.classList.contains('asc') ? 'desc' : 'asc';
                
                rows.sort((a, b) => {
                    const aText = a.children[index].textContent.trim();
                    const bText = b.children[index].textContent.trim();

                    if (!isNaN(aText) && !isNaN(bText)) {
                        return order === 'asc' ? aText - bText : bText - aText;
                    } else {
                        return order === 'asc' ? aText.localeCompare(bText) : bText.localeCompare(aText);
                    }
                });

                tbody.innerHTML = '';
                rows.forEach(row => tbody.appendChild(row));

                th.classList.toggle('asc', order === 'asc');
                th.classList.toggle('desc', order === 'desc');
                th.parentNode.querySelectorAll('th').forEach(sibling => {
                    if (sibling !== th) {
                        sibling.classList.remove('asc', 'desc');
                    }
                });
            });
        });
    </script>

</body>


<!-- Mirrored from spark.bootlab.io/pages-blank by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 19 Mar 2024 03:35:27 GMT -->

</html>