<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
	<h1 class="h2"><?= $type ?> Agenda</h1>
	<div class="btn-toolbar mb-2 mb-md-0 ml-2">
		<div class="btn-group mr-2">
			<a class="btn btn-sm btn-outline-danger" href="<?= BASE_URL ?>admin-ea/agenda">Kembali</a>
		</div>
	</div>
</div>

<form class="row" id="Form<?=$type?>">
	<fieldset class="form-group col-md-12">
		<label for="agenda_title">Judul Agenda</label>
		<input type="text" name="agenda_title" class="form-control" id="agenda_title" placeholder="Judul Agenda" value="<?= isset($values->agenda_title) ? $values->agenda_title : "" ?>">
		<small class="text-danger"></small>
	</fieldset>
	<fieldset class="form-group col-md-3">
		<label for="input_file">Unggah Gambar</label>
		<input type="file" id="input_file" name="agenda_file" class="form-control-file border">
	</fieldset>
	<fieldset class="form-group col-md-3">
		<label class="w-100">Status</label>
		<label>
			<input type="checkbox" name="isactive" <?= isset($values->isactive) ? $values->isactive ? "checked" : "" : "checked" ?>> Active
		</label>
	</fieldset>
	<!--
	<fieldset class="form-group col-md-3">
		<label for="agenda_start" class="w-100">Tanggal Mulai</label>
		<input type="date" name="agenda_start" value="<?= isset($values->agenda_start) ? $values->agenda_start : "" ?>">
	</fieldset>
	<fieldset class="form-group col-md-3">
		<label for="agenda_end"><input type="checkbox" class="mr-1" onclick="document.getElementsByName('agenda_end')[0].disabled = !this.checked" <?= isset($values->agenda_end) ? !empty($values->agenda_end) ? "checked" : "" : "checked" ?>>Tanggal Berakhir</label>
		<input type="date" name="agenda_end" value="<?= isset($values->agenda_end) ? $values->agenda_end : "" ?>" <?= isset($values->agenda_end) ? !empty($values->agenda_end) ? "" : "disabled" : "" ?>>
	</fieldset> -->
	<fieldset class="col-12">
		<label for="">Description</label>
		<textarea class="form-control" id="ckeditor" name="agenda_description"><?= isset($values->agenda_description) ? $values->agenda_description : "" ?></textarea>
	</fieldset>
	<fieldset class="form-group col-md-6 mt-3">
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

		var search_timeout = undefined;
		$("#agenda_title").keyup(function(event) {
			var $this = $(this);
			if (search_timeout != undefined) {
				clearTimeout(search_timeout);
			}
			search_timeout = setTimeout(function () {
				search_timeout = undefined;
				$.ajax({
					url : '<?= BASE_URL ?>admin-ea/agenda/check',
					type: 'post',
					data: {
						'title' : $this.val()
					},
					success: function(res) {
						if(res && $this.val() != '<?= isset($values->berita_title) ? $values->berita_title : "" ?>'){
							$this.addClass('text-danger');
							$this.next('small').text('Judul sudah pernah digunakan');
							$("[type='submit']").attr('disabled', 'disabled');
						} else {
							$this.removeClass('text-danger');
							$this.next('small').text('');
							$("[type='submit']").attr('disabled', false);
						}
					}
				});
			}, 500);
		});

		$("#FormAdd").submit(function(event) {
			event.preventDefault();

			for (instance in CKEDITOR.instances) {
				CKEDITOR.instances[instance].updateElement();
			}

			$.ajax({
				url : '<?= BASE_URL ?>admin-ea/agenda/formprocess',
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
							location.href = '<?= BASE_URL ?>admin-ea/agenda';
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
					url : '<?= BASE_URL ?>admin-ea/agenda/formprocess/<?= explode("/", URI_STRING)[3] ?>',
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
								location.href = '<?= BASE_URL ?>admin-ea/agenda';
							}, 1000);
						}
					}
				});
			});
		<?php endif; ?>
	});
</script>