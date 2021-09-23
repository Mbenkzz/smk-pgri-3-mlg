<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="description" content="">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title><?= isset($title) ? $title : "Untitled" ?></title>
	<?php 
	if(isset($stylesheets)) {
		foreach($stylesheets as $css)
			echo "<link rel=\"stylesheet\" $css>";
	}
	if(isset($scripts)) {
		foreach($scripts as $js)
			echo "<script $js></script>";
	}
	?>
</head>
<body>
	<?php
	if(isset($components)) {
		if(in_array('header', $components))
			$this->view("backend/template/header", ['title' => isset($title) ? $title : "Untitled"]);
	}
	?>
	<div class="container-fluid">
		<div class="row">
			<?php
			if(isset($components)) {
				if(in_array('sidebar', $components))
					$this->view("backend/template/sidebar");
			}
			?>
			<main role="main" class="col-md-10 ml-sm-auto col-lg-10 px-4 col-12"><?php $this->view($content, $data); ?></main>
		</div>
	</div>
	<div class="modal fade" id="modal-notification">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header" id="notif-header">
					<h4 class="modal-title" id="notif-title">Modal title</h4>
				</div>
				<div class="modal-body" id="notif-body">
					<p id="notif-message">One fine body&hellip;</p>
				</div>
				<div class="modal-footer" id="notif-footer">
					<button type="button" class="btn" id="notif-button" data-dismiss="modal">Close</button>
				</div>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->

	<div class="modal fade" id="modal-confirmation">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Hapus Data</h4>
				</div>
				<div class="modal-body">
					<p>Apakah anda yakin akan menghapus data ini?</p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
					<button type="button" class="btn btn-secondary" id="btn_confirm_hapus">Hapus</button>
				</div>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
	<?php 
	
	?>
	<script type="text/javascript">
		$(document).ready(function() {
			$("#button-toggler").click(function(e) {
      			e.preventDefault();
      			$(".sidebar").toggleClass("d-none");
    		});
		});

		function toggleActive(id, boolean) {
			$(".toggle").attr("disabled", "disabled");
			$.ajax({
				url: `<?= BASE_URL . URI_STRING ?>/toggle`,
				type: 'POST',
				data: {
					id: id,
					boolean: boolean
				},
				success: function(res) {
					var res = eval('(' + res + ')');
					
					$(".toggle").attr("disabled", false);
					if(typeof render === "function") {
						render(true);
					}
				}
			})
		}

		function showNotification(title, message) {
			$("#notif-title").text(title);
			$("#notif-message").text(message);
			$("#modal-notification").modal({'backdrop' : 'static'});
		}

		function deleteConfirmation(table, pk, id, uri) {
			$("#btn_confirm_hapus").attr('onclick', `deleteNow('${table}', '${pk}', ${id}, '${uri}')`);
			$("#modal-confirmation").modal({'backdrop' : 'static'});
		}

		function deleteNow(table, pk, id, uri) {
			$("#btn_confirm_hapus").attr("disabled", "disabled");
			$("#modal-confirmation").modal("hide");
			$.ajax({
				url: '<?= BASE_URL ?>' + uri,
				type: 'POST',
				data: {
					table: table, 
					pk: pk, 
					id: id
				},
				success: function(res) {
					var res = eval('(' + res + ')');
					showNotification(res.RESULT, res.DATA);
					$("#btn_confirm_hapus").attr("disabled", false);
					if(typeof render === "function") {
						render();
					}
				}
			});
			
		}
	</script>
</body>
</html>