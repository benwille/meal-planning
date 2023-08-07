</div> <!--end container-->
<footer class="container-fluid mt-5 pt-3 text-light bg-primary">
	<div>
		<div class="d-flex">

			<p>Copyright
				<?php echo date('Y') // TODO: . ', Ben Wille';?>
			</p>

			<div class="ml-auto">
				<?php
      $end = microtime(true) - $start;
				// echo '(' . number_format($end, 2) . ' seconds)';
				// echo duration($end);
				?>
			</div>
		</div>
	</div>
</footer>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
	integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
	integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
</script>
<script src="https://code.jquery.com/jquery-3.7.0.min.js"
	integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
<script src="<?php echo url_for('/js/theme.js'); ?>">
</script>
<!-- <script src="<?php echo url_for('/js/jquery.slim.min.js'); ?>">
</script>
<script
	src="<?php echo url_for('/js/popper.min.js'); ?>">
</script>
<script
	src="<?php echo url_for('/js/bootstrap.min.js'); ?>">
</script> -->
</body>

</html>


<?php db_disconnect($database); ?>