<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
	<h1 class="h2"><?= $type ?> Departement</h1>
	<div class="btn-toolbar mb-2 mb-md-0 ml-2">
		<div class="btn-group mr-2">
			<a class="btn btn-sm btn-outline-danger" href="<?= BASE_URL ?>admin-ea/department">Kembali</a>
		</div>
	</div>
</div>

<form class="row" id="Form<?=$type?>">
	<fieldset class="form-group col-md-6">
		<label for="input_username">Departement name</label>
		<input type="text" name="dep_name" class="form-control" id="input_depname" placeholder="Nama Departement" value="<?= isset($values->departement_name) ? $values->departement_name : "" ?>">
	</fieldset>
	<fieldset class="form-group col-md-6">
		<label for="input_file">Unggah Gambar</label>
		<input type="file" id="input_file" name="input_depfile" class="form-control-file border">
	</label>
</fieldset>
<fieldset class="col-12">
	<label for="">Description</label>
	<textarea class="form-control" id="ckeditor" name="input_depdesc"><?= isset($values->departement_description) ? $values->departement_description : "" ?></textarea>
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
		CKEDITOR.editorConfig = function( config ) {
			config.toolbar = [
			{ name: 'clipboard', items: [ 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo' ] },
			{ name: 'editing', items: [ 'Scayt' ] },
			{ name: 'links', items: [ 'Link', 'Unlink', 'Anchor' ] },
			{ name: 'insert', items: [ 'Table', 'HorizontalRule', 'SpecialChar' ] },
			'/',
			{ name: 'basicstyles', items: [ 'Bold', 'Italic','Underline', 'Strike', '-', 'RemoveFormat' ] },
			{ name: 'paragraph', items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent' ] },
			{ name: 'styles', items: [ 'Styles', 'Format' ] }
			];
		};
		CKEDITOR.replace('ckeditor');

		$("#FormAdd").submit(function(event) {
			event.preventDefault();

			for (instance in CKEDITOR.instances) {
				CKEDITOR.instances[instance].updateElement();
			}

			$.ajax({
				url : '<?= BASE_URL ?>admin-ea/department/formprocess',
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
							location.href = '<?= BASE_URL ?>admin-ea/department';
						}, 1000);
					}
				}
			});
		});

		<?php if ($type == "Edit"): ?>
			$("#FormEdit").submit(function(event) {
				event.preventDefault();

				for (instance in CKEDITOR.instances) {
					CKEDITOR.instances[instance].updateElement();
				}

				$.ajax({
					url : '<?= BASE_URL ?>admin-ea/department/formprocess/<?= explode("/", URI_STRING)[3] ?>',
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
							location.href = '<?= BASE_URL ?>admin-ea/department';
						}, 1000);
						}
					}
				});
			});
		<?php endif; ?>
	});
</script>