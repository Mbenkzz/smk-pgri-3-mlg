<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
	<h1 class="h2"><?= $type ?> Jurusan</h1>
	<div class="btn-toolbar mb-2 mb-md-0 ml-2">
		<div class="btn-group mr-2">
			<a class="btn btn-sm btn-outline-danger" href="<?= BASE_URL ?>admin-ea/jurusan">Kembali</a>
		</div>
	</div>
</div>

<form class="row" id="Form<?=$type?>">
	<fieldset class="form-group col-md-4">
		<label for="jur_name">Nama Jurusan</label>
		<input type="text" name="jur_name" class="form-control" id="jur_name" placeholder="Nama Jurusan" value="<?= isset($values->jurusan_name) ? $values->jurusan_name : "" ?>">
	</fieldset>
	<fieldset class="form-group col-md-4">
		<label for="dep_id">Departemen</label>
		<select class="select2 form-control" id="dep_id" name="dep_id">
			<?php foreach($departemen as $value): ?>
				<option value="<?= $value->departement_id ?>" <?= isset($values->departement_id) ? $values->departement_id == $value->departement_id ? "selected" : "" : "" ?>><?= $value->departement_name ?></option>
			<?php endforeach; ?>
		</select>
	</fieldset>
	<fieldset class="form-group col-md-4">
		<label for="input_file">Unggah Gambar</label>
		<input type="file" id="input_file" name="jur_file" class="form-control-file border">
	</fieldset>
	<fieldset class="col-12">
		<label for="">Description</label>
		<textarea class="form-control" id="ckeditor" name="input_jurdesc"><?= isset($values->jurusan_description) ? $values->jurusan_description : "" ?></textarea>
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

		$(".select2").select2({
			width: "100%"
		});

		$("#FormAdd").submit(function(event) {
			event.preventDefault();

			for (instance in CKEDITOR.instances) {
				CKEDITOR.instances[instance].updateElement();
			}

			$.ajax({
				url : '<?= BASE_URL ?>admin-ea/jurusan/formprocess',
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
							location.href = '<?= BASE_URL ?>admin-ea/jurusan';
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
					url : '<?= BASE_URL ?>admin-ea/jurusan/formprocess/<?= explode("/", URI_STRING)[3] ?>',
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
								location.href = '<?= BASE_URL ?>admin-ea/jurusan';
							}, 1000);
						}
					}
				});
			});
		<?php endif; ?>
	});
</script>