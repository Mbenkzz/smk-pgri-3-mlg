<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
	<h1 class="h2"><?= $type ?> Sosmed</h1>
	<div class="btn-toolbar mb-2 mb-md-0 ml-2">
		<div class="btn-group mr-2">
			<a class="btn btn-sm btn-outline-danger" href="<?= BASE_URL ?>admin-ea/sosmed">Kembali</a>
		</div>
	</div>
</div>

<form class="row" id="Form<?=$type?>">
	<fieldset class="form-group col-md-6">
		<label for="input_platform">Platform</label>
		<input type="text" class="form-control" id="input_platform" placeholder="" value="<?= isset($values->sosmed_platform) ? $values->sosmed_platform : "" ?>" disabled>
	</fieldset>
	<fieldset class="form-group col-md-6">
		<label for="input_akunid">Nama Yang Ditampilkan</label>
		<input type="text" class="form-control" id="input_akunid" name="sosmed_akun" placeholder="@..." value="<?= isset($values->sosmed_akunid) ? $values->sosmed_akunid : "" ?>">
	</fieldset>
	<fieldset class="col-12">
		<label for="input_link">Akun Tautan</label>
		<input type="text" class="form-control" id="input_link" name="sosmed_tautan" placeholder="@..." value="<?= isset($values->sosmed_akuntautan) ? $values->sosmed_akuntautan : "" ?>">
	</fieldset>
	<fieldset class="form-group col-md-6 mt-3">
		<button type="submit" class="btn btn-primary">Submit</button>
	</fieldset>
</form>
<script type="text/javascript">
	$(document).ready(function() {

		$("#FormAdd").submit(function(event) {
			event.preventDefault();

			$.ajax({
				url : '<?= BASE_URL ?>admin-ea/sosmed/formprocess',
				type: 'post',
				data: new FormData(this),
				processData: false,
				contentType: false,
				cache: false,
				async: false,
				success: function(res) {
					var res = eval('(' + res + ')');
					showNotification(res.RESULT, res.DATA);
					if(res.RESULT == "BERHASIL") {
						setTimeout(function(){
							location.href = '<?= BASE_URL ?>admin-ea/sosmed';
						}, 1000);
					}
				}
			});
		});

		<?php if ($type == "Edit"): ?>
			$("#FormEdit").submit(function(event) {
				event.preventDefault();

				$.ajax({
					url : '<?= BASE_URL ?>admin-ea/sosmed/formprocess/<?= explode("/", URI_STRING)[3] ?>',
					type: 'post',
					data: new FormData(this),
					processData: false,
					contentType: false,
					cache: false,
					async: false,
					success: function(res) {
						var res = eval('(' + res + ')');
						showNotification(res.RESULT, res.DATA);
						if(res.RESULT == "BERHASIL") {
							setTimeout(function(){
								location.href = '<?= BASE_URL ?>admin-ea/sosmed';
							}, 1000);
						}
					}
				});
			});
		<?php endif; ?>
	});
</script>