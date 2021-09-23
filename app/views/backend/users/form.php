<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
	<h1 class="h2"><?= $type ?> User</h1>
	<div class="btn-toolbar mb-2 mb-md-0 ml-2">
		<div class="btn-group mr-2">
			<a class="btn btn-sm btn-outline-danger" href="<?= BASE_URL ?>admin-ea/users">Kembali</a>
		</div>
	</div>
</div>

<form class="row" id="Form<?=$type?>">
	<fieldset class="form-group col-md-6">
		<label for="input_username">Username</label>
		<input type="text" name="username" class="form-control" id="input_username" placeholder="Username" value="<?= isset($values->username) ? $values->username : "" ?>" required>
		<small class="text-danger"></small>
	</fieldset>
	<fieldset class="form-group col-md-6">
		<label for="input_name">Nama</label>
		<input type="text" name="fullname" value="<?= isset($values->fullname) ? $values->fullname : "" ?>" class="form-control" id="input_name" placeholder="Nama" maxlength="64" required>
	</fieldset>
	<fieldset class="form-group col-md-6">
		<label for="input_pswd">Password</label>
		<input type="password" name="password" class="form-control" id="input_pswd" placeholder="Password" <?= $type == "Add" ? "required" : "" ?>>
		<small class="text-muted"><?= $type == "Edit" ? "Jika anda tidak mengganti password maka jangan diisi" : "" ?></small>
	</fieldset>
	<fieldset class="form-group col-md-6">
		<label for="input_role">Role</label>
		<select name="role" class="form-control" id="input_role" name="role" required>
			<option value="" disabled <?= !isset($values) ? "selected" : "" ?>>Pilih role</option>
			<?php foreach ($role as $value) : ?>
				<option value="<?= $value->ROLE ?>" <?= isset($values->role) ? $values->role == $value->ROLE ? "selected" : "" : "" ?>><?= $value->ROLE_NAME ?></option>
			<?php endforeach ?>
		</select>
		<small class="text-muted"></small>
	</fieldset>
	<fieldset class="form-group col-md-6">
		<div class="checkbox">
			<label>
				<input type="checkbox" name="isactive" <?= isset($values->isactive) ? $values->isactive ? "checked" : "" : "" ?>> Active
			</label>
		</div>
		<button type="submit" class="btn btn-primary">Submit</button>
	</fieldset>
</form>
<script type="text/javascript">
	$(document).ready(function() {
		var searchbefore = '';
		var search_timeout = undefined;
		$("#input_username").keyup(function(event) {
			var $this = $(this);
			if (search_timeout != undefined) {
				clearTimeout(search_timeout);
			}
			search_timeout = setTimeout(function () {
				search_timeout = undefined;
				$.ajax({
					url : '<?= BASE_URL ?>admin-ea/users/check',
					type: 'post',
					data: {
						'username' : $this.val()
					},
					success: function(res) {
						if(res && $this.val() != '<?= isset($values->username) ? $values->username : "" ?>'){
							$this.addClass('text-danger');
							$this.next('small').text('Username sudah digunakan');
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
			$.ajax({
				url : '<?= BASE_URL ?>admin-ea/users/formprocess',
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
							location.href = '<?= BASE_URL ?>admin-ea/users';
						}, 1000);
					}
				}
			});
		});

		<?php if ($type == "Edit"): ?>
			$("#FormEdit").submit(function(event) {
				event.preventDefault();
				$.ajax({
					url : '<?= BASE_URL ?>admin-ea/users/formprocess/<?= explode("/", URI_STRING)[3] ?>',
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
								location.href = '<?= BASE_URL ?>admin-ea/users';
							}, 1000);
						}
					}
				});
			});
		<?php endif; ?>
	});
</script>