<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
	<h1 class="h2"><?= $type ?> Partner</h1>
	<div class="btn-toolbar mb-2 mb-md-0 ml-2">
		<div class="btn-group mr-2">
			<a class="btn btn-sm btn-outline-danger" href="<?= BASE_URL ?>admin-ea/partner">Kembali</a>
		</div>
	</div>
</div>

<form class="row" id="Form<?=$type?>">
	<fieldset class="form-group col-md-6">
		<label for="input_name">Nama Partner</label>
		<input type="text" name="partner_name" class="form-control" id="input_name" placeholder="Nama Partner" value="<?= isset($values->partner_name) ? $values->partner_name : "" ?>" required>
	</fieldset>
	<fieldset class="form-group col-md-6">
		<label for="input_logo">Logo Partner</label>
		<input type="file" name="logo_image" class="form-control-file border" id="input_logo">
	</fieldset>
	<fieldset class="form-group col-md-12">
		<label for="input_alamat">Alamat</label>
		<input type="text" name="partner_address" class="form-control" id="input_alamat" placeholder="Alamat Partner" value="<?= isset($values->partner_address) ? $values->partner_address : "" ?>">
	</fieldset>
	<fieldset class="form-group col-md-6">
		<label for="input_phone">Kontak</label>
		<input type="text" name="partner_phone" class="form-control" id="input_phone" placeholder="08...." value="<?= isset($values->partner_phone) ? $values->partner_phone : "" ?>">
	</fieldset>
	<fieldset class="form-group col-md-6">
		<label for="input_email">Email</label>
		<input type="email" name="partner_email" class="form-control" id="input_email" placeholder="ex: someone@gmail.com" value="<?= isset($values->partner_email) ? $values->partner_email : "" ?>">
	</fieldset>
	<fieldset class="form-group col-md-6 mt-3">
		<div class="checkbox">
			<label>
				<input type="checkbox" name="isactive" <?= isset($values->isactive) ? $values->isactive ? "checked" : "" : "checked" ?>> Active
			</label>
		</div>
		<button type="submit" class="btn btn-primary">Submit</button>
	</fieldset>
</form>
<script type="text/javascript">
	$(document).ready(function() {
		
		$("#FormAdd").submit(function(event) {
			event.preventDefault();

			$.ajax({
				url : '<?= BASE_URL ?>admin-ea/partner/formprocess',
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
							location.href = '<?= BASE_URL ?>admin-ea/partner';
						}, 1000);
					}
				}
			});
		});

		<?php if ($type == "Edit"): ?>
			$("#FormEdit").submit(function(event) {
				event.preventDefault();

				$.ajax({
					url : '<?= BASE_URL ?>admin-ea/partner/formprocess/<?= explode("/", URI_STRING)[3] ?>',
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
								location.href = '<?= BASE_URL ?>admin-ea/partner';
							}, 1000);
						}
					}
				});
			});
		<?php endif; ?>
	});
</script>