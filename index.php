<!DOCTYPE html>
<html>
<head>
	<title>Login Siswa</title>
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
	<style>
		/* Langit malam dengan bintang */
		body {
			margin: 0;
			padding: 0;
			font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
			color: #fff;
			background: radial-gradient(ellipse at bottom, #1b2735 0%, #090a0f 100%);
			overflow: hidden;
		}

		/* Bintang berkerlap-kerlip */
		.night-sky {
			position: fixed;
			width: 100%;
			height: 100%;
			background: transparent;
			z-index: 0;
		}

		.star-static {
			position: absolute;
			width: 2px;
			height: 2px;
			background: white;
			border-radius: 50%;
			opacity: 0.8;
			animation: twinkle 2s infinite alternate;
		}

		@keyframes twinkle {
			from { opacity: 0.2; }
			to { opacity: 1; }
		}

		/* Bintang jatuh */
		.shooting-stars {
			position: fixed;
			width: 100%;
			height: 100%;
			pointer-events: none;
			z-index: 1;
		}

		.star {
			position: absolute;
			width: 2px;
			height: 80px;
			background: linear-gradient(-45deg, white, transparent);
			transform: rotate(45deg);
			animation: shooting 2.5s linear forwards;
			opacity: 0;
			will-change: transform, opacity;
		}

		@keyframes shooting {
			0% {
				transform: translateX(0) translateY(0) rotate(45deg);
				opacity: 1;
			}
			100% {
				transform: translateX(-100vw) translateY(100vh) rotate(45deg);
				opacity: 0;
			}
		}

		/* Card login */
		.card {
			background-color: rgba(0, 0, 0, 0.75);
			border-radius: 12px;
			box-shadow: 0 8px 16px rgba(0, 0, 0, 0.7);
			z-index: 2;
		}

		.card-header {
			background-color: transparent;
			color: white;
			text-align: center;
			font-size: 1.25rem;
			font-weight: bold;
			padding: 15px;
		}

		.form-control {
			background-color: #000;
			border: 2px solid #777;
			border-radius: 8px;
			color: #fff;
		}

		.form-control::placeholder {
			color: #aaa;
		}

		.form-control:focus {
			box-shadow: 0 0 8px #fff;
			border-color: #fff;
			background-color: #111;
		}

		.btn-primary {
			background-color: #ffffff;
			border-color: #ffffff;
			color: #000;
		}

		.btn-primary:hover {
			background-color: #dddddd;
			color: #000;
		}

		a {
			color: #ffffff;
			text-decoration: none;
		}

		a:hover {
			text-decoration: underline;
			color: #ccc;
		}

		.alert {
			background: rgba(255, 0, 0, 0.3);
			color: #fff;
			border: none;
			box-shadow: 0 0 8px red;
		}
	</style>
</head>
<body>

	<!-- Bintang statis -->
	<div class="night-sky" id="night-sky"></div>

	<!-- Bintang jatuh -->
	<div class="shooting-stars" id="stars-container"></div>

	<?php 
	if(isset($_GET['pesan']) && $_GET['pesan']=="gagal"){
		echo "<div class='alert alert-danger text-center'>
			<strong>Perhatian!</strong> Mohon Cek Kembali Data Inputan Anda.
			</div>";
	}
	?>

	<div class="container mt-5 position-relative" style="z-index: 2;">
		<div class="row justify-content-md-center">
			<div class="col-md-4">
				<h4 class="text-center">Login Siswa</h4>
				<div class="card">
					<div class="card-header">
						<img src="kuba.png" width="50%" height="50%">
					</div>
					<div class="card-body">
						<form action="cek-login-siswa.php" method="post">
							<div class="form-group mb-2">
								<label>NISN</label>
								<input type="number" name="nisn" class="form-control" placeholder="Masukkan NISN Anda.." required>
							</div>
							<div class="form-group mb-2">
								<label>NIS</label>
								<input type="number" name="nis" class="form-control" placeholder="Masukkan NIS Anda.." required>
							</div>
							<div class="form-group mb-2 d-flex justify-content-between align-items-center">
								<button type="submit" class="btn btn-primary">LOGIN</button>
								<a href="index2.php">Login Admin/Petugas</a>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Script: Bintang statis -->
	<script>
		const nightSky = document.getElementById('night-sky');
		for (let i = 0; i < 100; i++) {
			const star = document.createElement('div');
			star.classList.add('star-static');
			star.style.top = Math.random() * 100 + '%';
			star.style.left = Math.random() * 100 + '%';
			star.style.animationDuration = (Math.random() * 3 + 2) + 's';
			nightSky.appendChild(star);
		}
	</script>

	<!-- Script: Bintang jatuh -->
	<script>
		const starContainer = document.getElementById('stars-container');

		function createStar() {
			const star = document.createElement('div');
			star.classList.add('star');
			star.style.left = Math.random() * window.innerWidth + 'px';
			star.style.top = Math.random() * -100 + 'px';
			star.style.animationDuration = (Math.random() * 1.5 + 1.5) + 's';
			star.style.opacity = Math.random();
			starContainer.appendChild(star);

			// Hapus setelah animasi
			star.addEventListener('animationend', () => {
				star.remove();
			});
		}

		// Looping animasi menggunakan requestAnimationFrame
		let lastStarTime = 0;
		function starLoop(time) {
			if (time - lastStarTime > 300) {
				createStar();
				lastStarTime = time;
			}
			requestAnimationFrame(starLoop);
		}
		requestAnimationFrame(starLoop);
	</script>

	<script src="bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
