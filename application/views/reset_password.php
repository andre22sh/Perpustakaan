<?php echo validation_errors(
	'<div class="alert alert-danger alert-dismissible fade show">',
	'<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		<span aria-hidden="true">&times;</span>
	</button></div>'
); ?>

<?php if ($this->session->tempdata('message') == TRUE) : ?>
	<div class="alert alert-success alert-dismissible fade show" role="alert">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>
		<p><?php echo $this->session->tempdata('message'); ?>
	</div>
<?php endif; ?>

<form method="post" action="<?php echo site_url('user/reset_password/'); ?>">
	<table class="table table-striped">
		<tr>
			<td>Password Lama</td>
			<td>
				<input type="password" name="password_lama" value="<?= set_value('password_lama'); ?>" class="form-control" required>
			</td>
		</tr>
		<tr>
			<td>Password Baru</td>
			<td>
				<input type="password" name="password_baru" value="<?= set_value('password_baru'); ?>" class="form-control" required>
			</td>
		</tr>
		<tr>
			<td>Konfirmasi Password Baru</td>
			<td>
				<input type="password" name="password_baru_ulangi" value="<?= set_value('password_baru_ulangi'); ?>" class="form-control" required>
			</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td><input type="submit" name="submit" value="Simpan" class="btn btn-primary"></td>
		</tr>
	</table>
</form>