<?php 
include "../../config/koneksi.php";

if(@$_GET['act'] == ''){
?>

<div class="row">
    <div class="col-lg-12">
         <h1>Staf <small>Data Staf</small></h1>
         <ol class="breadcrumb">
             <li><a href="index.html"><i class="icon-dashboard"></i> Staf</a></li>
      	</ol>
	</div>
</div>

<!-- tampilkan data Staf -->
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
					<th>Jabatan</th>
					<th>Telpon</th>
					<th>Jam Tugas</th>
					<!-- <th>Opsi</th> -->
				</tr>
				<?php 
					$koneksi = mysqli_query($connect,"SELECT * FROM tb_staf");
					$no = 1;
					foreach ($koneksi as $data){
				?>
				<tr>
					<td align="center"><?php echo $no++; ?></td>
					<td><?php echo $data['kode_petugas']; ?></td>
					<td><?php echo $data['nama']; ?></td>
					<td><?php echo $data['alamat']; ?></td>
					<td align="center"><?php echo $data['jk']; ?></td>
					<td><?php echo $data['jabatan']; ?></td>
					<td><?php echo $data['telp']; ?></td>
					<td align="center"><?php echo $data['jam_tugas']; ?></td>
					<!-- <td align="center">
						<a id="edit_staf" data-toggle="modal" data-target="#edit" data-id="<?php echo $data['kode_petugas']; ?>" data-nama="<?php echo $data['nama']; ?>" data-alamat="<?php echo $data['alamat']; ?>" data-jk="<?php echo $data['jk']; ?>" data-jabatan="<?php echo $data['jabatan']; ?>" data-telp="<?php echo $data['telp']; ?>" data-jam_tugas="<?php echo $data['jam_tugas']; ?>">
						<button class="btn btn-info btn-xs"><i class="fa fa-edit"></i> Edit</button></a>
						<a href="?page=staf&act=del&kode_petugas=<?php echo $data['kode_petugas']; ?>" onclick="return confirm('Yakin menghapus data ini?')">
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
						<h4 class="modal-title">Tambah Data Staf</h4>
					</div>
					<form action="" method="POST" enctype="multipart/form-data">
						<div class="modal-body">
							<div class="form-group">
								<label class="control-label" for="kode_petugas">ID</label>
								<input type="text" name="kode_petugas" class="form-control" id="kode_petugas" required>
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
								<label class="control-label" for="jabatan">Jabatan</label>
								<select name="jabatan" class="form-control" id="jabatan" required>
									<option value="A">A</option>
									<option value="B">B</option>
									<option value="C">C</option>
									<option value="D">D</option>
								</select>
							</div>
							<div class="form-group">
								<label class="control-label" for="telp">Telpon</label>
								<input type="number" name="telp" class="form-control" id="telp" required>
							</div>
							<div class="form-group">
								<label class="control-label" for="jam_tugas">Jam Kerja</label>
								<select name="jam_tugas" class="form-control" id="jam_tugas" required>
									<option value="07:00 - 12.30">07:00 - 12.30</option>
									<option value="12:30 - 16.30">12:30 - 16.30</option>
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
						$kode_petugas = $_POST['kode_petugas'];
						$nama = $_POST['nama'];
						$alamat = $_POST['alamat'];
						$jk = $_POST['jk'];
						$jabatan = $_POST['jabatan'];
						$telp = $_POST['telp'];
						$jam_tugas = $_POST['jam_tugas'];
						mysqli_query($connect, "INSERT INTO tb_staf (kode_petugas, nama, alamat,jk,jabatan,telp,jam_tugas) VALUES ('$kode_petugas','$nama','$alamat','$jk','$jabatan','$telp','$jam_tugas')");
						 echo "<script>window.location='?page=staf';</script>";
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
						<h4 class="modal-title">Edit Data Staf</h4>
					</div>
					<form id="form" enctype="multipart/form-data">
						<div class="modal-body" id="modal-edit">
							<div class="form-group">
								<label class="control-label" for="nama">Nama</label>
								<input type="hidden" id="kode_petugas" name="kode_petugas">
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
								<label class="control-label" for="jabatan">Jabatan</label>
								<select name="jabatan" class="form-control" id="jabatan" required>
									<option value="A">A</option>
									<option value="B">B</option>
									<option value="C">C</option>
									<option value="D">D</option>
								</select>
							</div>
							<div class="form-group">
								<label class="control-label" for="telp">Telpon</label>
								<input type="number" name="telp" class="form-control" id="telp" required>
							</div>
							<div class="form-group">
								<label class="control-label" for="jam_tugas">Jam Kerja</label>
								<select name="jam_tugas" class="form-control" id="jam_tugas" required>
									<option value="07:00 - 12.30">07:00 - 12.30</option>
									<option value="12:30 - 16.30">12:30 - 16.30</option>
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
			$(document).on("click", "#edit_staf", function(){
				var kodestaf = $(this).data('id');
				var namastaf = $(this).data('nama');
				var alamatstaf = $(this).data('alamat');
				var jkstaf = $(this).data('jk');
				var jabatanstaf = $(this).data('jabatan');
				var telpstaf = $(this).data('telp');
				var jamtugasstaf = $(this).data('jam_tugas');
				$("#modal-edit #kode_petugas").val(kodestaf);
				$("#modal-edit #nama").val(namastaf);
				$("#modal-edit #alamat").val(alamatstaf);
				$("#modal-edit #jk").val(jkstaf);
				$("#modal-edit #jabatan").val(jabatanstaf);
				$("#modal-edit #telp").val(telpstaf);
				$("#modal-edit #jam_tugas").val(jamtugasstaf);
			})
			// Proses Edit
			$(document).ready(function(e){
				$("#form").on("submit", function(e){
					e.preventDefault();
					$.ajax({
						url : 'models/proses_edit_staf.php',
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
	$kode_petugas = $_GET['kode_petugas'];
	mysqli_query($connect, "DELETE FROM tb_staf WHERE kode_petugas='$kode_petugas'");
	header('location: ?page=staf');
}
 ?>