<?php 
include "../../config/koneksi.php";

if(@$_GET['act'] == ''){
?>


<div class="row">
    <div class="col-lg-12">
         <h1>Anggota <small>Data anggota</small></h1>
         <ol class="breadcrumb">
             <li><a href="index.html"><i class="icon-dashboard"></i> anggota</a></li>
      	</ol>
	</div>
</div><!-- /.row -->

<!-- tampilkan data anggota -->
<div class="row">
	<div class="col-lg-12">
		<div class="table-responsive">
			<table class="table table-bordered table-hover table-striped">
				<tr>
					<th>No</th>
					<th>ID</th>
					<th>Nama</th>
					<th>Alamat</th>
					<th>Gender</th>
					<th>Jurusan</th>
					<th>Angkatan</th>
				<!-- 	<th>Opsi</th> -->
				</tr>
				<?php 
					$koneksi = mysqli_query($connect,"SELECT * FROM tb_anggota");
					$no = 1;
					foreach ($koneksi as $data){
				?>
				<tr>
					<td align="center"><?php echo $no++; ?></td>
					<td><?php echo $data['kode_anggota']; ?></td>
					<td><?php echo $data['nama']; ?></td>
					<td><?php echo $data['alamat']; ?></td>
					<td align="center"><?php echo $data['jk']; ?></td>
					<td><?php echo $data['jurusan']; ?></td>
					<td align="center"><?php echo $data['angkatan']; ?></td>
					<!-- <td align="center">
						<a id="edit_anggota" data-toggle="modal" data-target="#edit" data-id="<?php echo $data['kode_anggota']; ?>" data-nama="<?php echo $data['nama']; ?>" data-jk="<?php echo $data['jk']; ?>" data-jurusan="<?php echo $data['jurusan']; ?>" data-angkatan="<?php echo $data['angkatan']; ?>" data-alamat="<?php echo $data['alamat']; ?>">
						<button class="btn btn-info btn-xs"><i class="fa fa-edit"></i> Edit</button></a>
						<a href="?page=anggota&act=del&kode_anggota=<?php echo $data['kode_anggota']; ?>" onclick="return confirm('Yakin menghapus data ini?')">
						<button class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Hapus</button>
						</a>
					</td> -->
				</tr>
			<?php } ?>
			</table>
		</div>
		<!-- <button type="button" class="btn btn-success" data-toggle="modal" data-target="#tambah">Tambah Data</button> -->
		<!-- Tambah data -->
		<div id="tambah" class="modal fade" role="dialog">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Tambah Data Anggota</h4>
					</div>
					<form action="" method="POST" enctype="multipart/form-data">
						<div class="modal-body">
							<div class="form-group">
								<label class="control-label" for="kode_anggota">ID</label>
								<input type="text" name="kode_anggota" class="form-control" id="kode_anggota" required>
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
								<label class="control-label" for="jk">Gender</label>
								<select name="jk" class="form-control" id="jk" required>
									<option value="L">Laki-Laki</option>
									<option value="P">Perempuan</option>
								</select>
							</div>
							<div class="form-group">
								<label class="control-label" for="jurusan">Jurusan</label>
								<input type="text" name="jurusan" class="form-control" id="jurusan" required>
							</div>
							<div class="form-group">
								<label class="control-label" for="angkatan">Angkatan</label>
								<input type="text" name="angkatan" class="form-control" id="angkatan" required>
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
						$kode_anggota = $_POST['kode_anggota'];
						$nama = $_POST['nama'];
						$alamat = $_POST['alamat'];
						$jk = $_POST['jk'];
						$jabatan = $_POST['jabatan'];
						$jurusan = $_POST['jurusan'];
						$angkatan = $_POST['angkatan'];
						mysqli_query($connect, "INSERT INTO tb_anggota (kode_anggota, nama, jk, jurusan, angkatan, alamat) VALUES ('$kode_anggota','$nama','$jk', '$jurusan','$angkatan','$alamat')");
						 echo "<script>window.location='?page=anggota';</script>";
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
						<h4 class="modal-title">Edit Data Anggota</h4>
					</div>
					<form id="form" enctype="multipart/form-data">
						<div class="modal-body" id="modal-edit">
							<div class="form-group">
								<label class="control-label" for="nama">Nama</label>
								<input type="hidden" id="kode_anggota" name="kode_anggota">
								<input type="text" name="nama" class="form-control" id="nama" required>
							</div>
							<div class="form-group">
								<label class="control-label" for="alamat">Alamat</label>
								<input type="text" name="alamat" class="form-control" id="alamat" required>
							</div>
							<div class="form-group">
								<label class="control-label" for="jk">Gender</label>
								<select name="jk" class="form-control" id="jk" required>
									<option value="L">Laki-Laki</option>
									<option value="P">Perempuan</option>
								</select>
							</div>
							<div class="form-group">
								<label class="control-label" for="jurusan">Jurusan</label>
								<input type="text" name="jurusan" class="form-control" id="jurusan" required>
							</div>
							<div class="form-group">
								<label class="control-label" for="angkatan">Angkatan</label>
								<input type="text" name="angkatan" class="form-control" id="angkatan" required>
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
			$(document).on("click", "#edit_anggota", function(){
				var kodeanggota = $(this).data('id');
				var namaanggota = $(this).data('nama');
				var alamatanggota = $(this).data('alamat');
				var jkanggota = $(this).data('jk');
				var jabatananggota = $(this).data('jabatan');
				var jurusananggota = $(this).data('jurusan');
				var angkatananggota = $(this).data('angkatan');
				$("#modal-edit #kode_anggota").val(kodeanggota);
				$("#modal-edit #nama").val(namaanggota);
				$("#modal-edit #alamat").val(alamatanggota);
				$("#modal-edit #jk").val(jkanggota);
				$("#modal-edit #jabatan").val(jabatananggota);
				$("#modal-edit #jurusan").val(jurusananggota);
				$("#modal-edit #angkatan").val(angkatananggota);
			})
			// Proses Edit
			$(document).ready(function(e){
				$("#form").on("submit", function(e){
					e.preventDefault();
					$.ajax({
						url : 'models/proses_edit_anggota.php',
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
	$kode_anggota = $_GET['kode_anggota'];
	mysqli_query($connect, "DELETE FROM tb_anggota WHERE kode_anggota='$kode_anggota'");
	header('location: ?page=anggota');
}
 ?>