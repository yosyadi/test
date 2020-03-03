<?php 
include "config/koneksi.php";

if(@$_GET['act'] == ''){
?>

<div class="row">
    <div class="col-lg-12">
         <h1>profesor <small>Data profesor</small></h1>
         <ol class="breadcrumb">
             <li><a href="index.html"><i class="icon-dashboard"></i> profesor</a></li>
      	</ol>
	</div>
</div>

<!-- tampilkan data profesor -->
<div class="row">
	<div class="col-lg-12">
		<div class="table-responsive">
			<table class="table table-bordered table-hover table-striped">
				<tr>
					<th>No</th>
					<th>NIK</th>
					<th>Nama</th>
					<th>Alamat</th>
					<th>Gender</th>
					<th>Opsi</th>
				</tr>
				<?php 
					$koneksi = mysqli_query($connect,"SELECT * FROM tb_profesor");
					$no = 1;
					foreach ($koneksi as $data){
				?>
				<tr>
					<td align="center"><?php echo $no++; ?></td>
					<td><?php echo $data['nik']; ?></td>
					<td><?php echo $data['nama']; ?></td>
					<td><?php echo $data['alamat']; ?></td>
					<td align="center"><?php echo $data['gender']; ?></td>
					<td align="center">
						<a id="edit_profesor" data-toggle="modal" data-target="#edit" data-id="<?php echo $data['nik']; ?>" data-nama="<?php echo $data['nama']; ?>" data-alamat="<?php echo $data['alamat']; ?>" data-gender="<?php echo $data['gender']; ?>" >
						<button class="btn btn-info btn-xs"><i class="fa fa-edit"></i> Edit</button></a>
						<a href="?page=Profesor&act=del&nik=<?php echo $data['nik']; ?>" onclick="return confirm('Yakin menghapus data ini?')">
						<button class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Hapus</button>
						</a>
					</td>
				</tr>
			<?php } ?>
			</table>
		</div>
		<button type="button" class="btn btn-success" data-toggle="modal" data-target="#tambah">Tambah Data</button>
		<!-- Tambah data -->
		<div id="tambah" class="modal fade" role="dialog">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Tambah Data profesor</h4>
					</div>
					<form action="" method="POST" enctype="multipart/form-data">
						<div class="modal-body">
							<div class="form-group">
								<label class="control-label" for="nik">ID</label>
								<input type="text" name="nik" class="form-control" id="nik" required>
							</div>
							<div class="form-group">
								<label class="control-label" for="nama">Nama</label>
								<input type="text" name="nama" class="form-control" id="nama" required>
							</div>
							<div class="form-group">
								<label class="control-label" for="alamat">Alamat</label>
								<input type="text" name="alamat" class="form-control" id="alamat" required>
							</div>
							<div class="form-group">
								<label class="control-label" for="gender">Gender</label>
								<select name="gender" class="form-control" id="gender" required>
									<option value="Laki-Laki">Laki-Laki</option>
									<option value="Perempuan">Perempuan</option>
								</select>
							</div>
						</div>
						<div class="modal-footer">
							<button type="reset" class="btn btn-denger">Reset</button>
							<input type="submit" class="btn btn-success" name="tambah" value="Simpan">
						</div>
						
						<!-- proses tambah data -->
					</form>
					<?php
					if(@$_POST['tambah']){
						$nik = $_POST['nik'];
						$nama = $_POST['nama'];
						$alamat = $_POST['alamat'];
						$gender = $_POST['gender'];
						mysqli_query($connect, "INSERT INTO tb_profesor (nik, nama, alamat,gender) VALUES ('$nik','$nama','$alamat','$gender')");
						 echo "<script>window.location='?page=Profesor';</script>";
					}
					?>
				</div>
			</div>
		</div>

		<div id="edit" class="modal fade" role="dialog">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Edit Data profesor</h4>
					</div>
					<form id="form" enctype="multipart/form-data">
						<div class="modal-body" id="modal-edit">
							<div class="form-group">
								<label class="control-label" for="nama">Nama</label>
								<input type="hidden" id="nik" name="nik">
								<input type="text" name="nama" class="form-control" id="nama" required>
							</div>
							<div class="form-group">
								<label class="control-label" for="alamat">Alamat</label>
								<input type="text" name="alamat" class="form-control" id="alamat" required>
							</div>
							<div class="form-group">
								<label class="control-label" for="gender">Gender</label>
								<select name="gender" class="form-control" id="gender" required>
									<option value="Laki-Laki">Laki-Laki</option>
									<option value="Perempuan">Perempuan</option>
								</select>
							</div>
						</div>
						<div class="modal-footer">
							<input type="submit" class="btn btn-success" name="edit" value="Simpan">
						</div>
					</form>
				</div>
			</div>
		</div>
		<script src="assets/js/jquery-1.10.2.js"></script>
		<script type="text/javascript">
			$(document).on("click", "#edit_profesor", function(){
				var kodeprofesor = $(this).data('id');
				var namaprofesor = $(this).data('nama');
				var alamatprofesor = $(this).data('alamat');
				var genderprofesor = $(this).data('gender');
				$("#modal-edit #nik").val(kodeprofesor);
				$("#modal-edit #nama").val(namaprofesor);
				$("#modal-edit #alamat").val(alamatprofesor);
				$("#modal-edit #gender").val(genderprofesor);
			})
			// Proses Edit
			$(document).ready(function(e){
				$("#form").on("submit", function(e){
					e.preventDefault();
					$.ajax({
						url : 'models/proses_edit_profesor.php',
						type : 'POST',
						data : new FormData(this),
						contentType : false,
						cache : false,
						processData : false,
						success : function(msg){
							$('.table').html(msg);
						}
					});
				});
			})
		</script>
	</div>
</div>

<?php 
}else if(@$_GET['act'] == del){
	$nik = $_GET['nik'];
	mysqli_query($connect, "DELETE FROM tb_profesor WHERE nik='$nik'");
	header('location: ?page=Profesor');
}
 ?>