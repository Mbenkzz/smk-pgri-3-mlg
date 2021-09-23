<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
	<h1 class="h2"><?= $type ?> Berita</h1>
	<div class="btn-toolbar mb-2 mb-md-0 ml-2">
		<div class="btn-group mr-2">
			<a class="btn btn-sm btn-outline-danger" href="<?= BASE_URL ?>admin-ea/berita">Kembali</a>
		</div>
	</div>
</div>

<form class="row mb-5" id="Form<?=$type?>">
	<fieldset class="form-group col-12">
		<label for="input_title">Judul Berita</label>
		<input type="text" name="input_title" class="form-control" id="input_title" placeholder="Judul Berita" value="<?= isset($values->berita_title) ? $values->berita_title : "" ?>">
		<small class="text-danger"></small>
	</fieldset>
	<fieldset class="form-group col-md-6 col-lg-3">
		<label for="input_file">Unggah Gambar</label>
		<input type="file" id="input_file" name="input_file" class="form-control-file border">
	</fieldset>
	<fieldset class="form-group col-md-6">
		<label for="input_tag">Tags</label>
		<select multiple="" name="input_tag[]" id="input_tag" class="form-control" lang="id">
			<?php if(isset($tags)) : ?>
				<?php foreach($tags as $key => $value) : ?>
					<option value="<?= strtolower($value) ?>" selected="selected"><?= ucwords($value) ?></option>
				<?php endforeach ?>
			<?php endif ?>
		</select>
		<small class="text-muted">Anda dapat menambah sendiri dengan mengetiknya lalu tekan enter</small>
	</fieldset>
	<fieldset class="col-12">
		<label for="">Description</label>
		<textarea class="form-control" id="ckeditor" name="input_description"><?= isset($values->berita_description) ? $values->berita_description : "" ?></textarea>
	</fieldset>
	<fieldset class="form-group col-md-6 mt-3">
		<div class="checkbox">
			<label>
				<input type="checkbox" name="isactive" <?= isset($values->isactive) ? $values->isactive ? "checked" : "" : "checked" ?>> Active
			</label>
		</div>
		<div class="btn-group">
			<button type="submit" class="btn btn-primary"><?= $type ?></button>
			<?php if (strtolower($type) != "add") :?>
				<a role="button" onclick="preview()" href="#" class="btn btn-secondary text-white">Simpan dan Pratinjau</a>
			<?php endif ?>
		</div>
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
		$("#input_title").keyup(function(event) {
			var $this = $(this);
			if (search_timeout != undefined) {
				clearTimeout(search_timeout);
			}
			search_timeout = setTimeout(function () {
				search_timeout = undefined;
				$.ajax({
					url : '<?= BASE_URL ?>admin-ea/berita/check',
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

		$("#input_tag").select2({
			width: "100%",
			multiple: true,
			tags: true,
			ajax: {
                url: '<?= BASE_URL . "admin-ea/berita/tags" ?>',
                data : function(params){
                	var tags = $("#input_tag").val().join('", "');
                	var query = {
                		search : params.term,
                		not_in : tags
                	}
                	return query;
                },
                dataType: 'json',
                processResults: function (data) {
                    var res = [];
                    for(var i  = 0 ; i < data.length; i++) {
                        res.push({id:data[i].id, text:data[i].text});
                    }
                    return {
                        results: res
                    }
                },
            }
		});

		$("#FormAdd").submit(function(event) {
			event.preventDefault();

			for (instance in CKEDITOR.instances) {
				CKEDITOR.instances[instance].updateElement();
			}

			$.ajax({
				url : '<?= BASE_URL ?>admin-ea/berita/formprocess',
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
							location.href = '<?= BASE_URL ?>admin-ea/berita';
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
					url : '<?= BASE_URL ?>admin-ea/berita/formprocess/<?= $values->berita_id ?>',
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
								location.href = '<?= BASE_URL ?>admin-ea/berita';
							}, 1000);
						}
					}
				});
			});
		<?php endif; ?>
	});
	<?php if ($type == "Edit"): ?>
		function preview() {
			for (instance in CKEDITOR.instances) {
					CKEDITOR.instances[instance].updateElement();
				}

				$.ajax({
					url : '<?= BASE_URL ?>admin-ea/berita/formprocess/<?= $values->berita_id ?>',
					type: 'post',
					data: new FormData(document.getElementById("FormEdit")),
					processData: false,
					contentType: false,
					cache: false,
					async: false,
					success: function(res) {
						var res = eval('(' + res + ')');
						showNotification(res.RESULT, res.DATA);
						if(res.RESULT == "BERHASIL") {
							location.href = '<?= BASE_URL ?>admin-ea/berita/preview/<?= $values->berita_id ?>';
						}
					}
				});
		}
	<?php endif ?>
</script>