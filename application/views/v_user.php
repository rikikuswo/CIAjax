<!DOCTYPE html>
<html>
<head>
<title>Page Title</title>
<link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/css/bootstrap.css'?>">
<link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/css/jquery.dataTables.css'?>">
</head>
<body>
<div class="container">
	<div class="row">
		<button class="btn btn-info" data-toggle="modal" data-target="#modalTambah">Tambah Data</button>
		<div class="reload">
			<table class="table" id="tbluser">
				<thead>
					<tr>
						<th>Nama</th>
						<th>Handphone</th>
						<th>Role</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody id="isitbluser">
					
				</tbody>
			</table>
		</div>
	</div>
</div>

<!-- Modal Tambah -->
<div class="modal fade" id="modalTambah">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				Tambah Data
			</div>
			<form>
				<div class="modal-body">
					<div class="form-group row">
					    <label class="col-sm-2 col-form-label">Nama</label>
					    <div class="col-sm-10">
					      <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama">
					    </div>
					</div>
					<div class="form-group row">
					    <label class="col-sm-2 col-form-label">Handphone</label>
					    <div class="col-sm-10">
					      <input type="text" class="form-control" name="handphone" id="handphone" placeholder="Handphone">
					    </div>
					</div>
					<div class="form-group row">
					    <label class="col-sm-2 col-form-label">Role</label>
					    <div class="col-sm-10">
					      <select name="role" id="role" class="form-control">
					      	<option value="">-Pilih-</option>
					      	<option value="1">Admin</option>
					      	<option value="2">User</option>
					      </select>
					    </div>
					</div>
				</div>
				<div class="modal-footer">				
			      	<button class="btn btn-info" id="btnSimpan">Simpan</button>
			      	<button class="btn btn-default" modal-dismiss="modal">Batal</button>
				</div>
			</form>
		</div>
	</div>
</div>

<!-- Modal Edit -->
<div class="modal fade" id="modalEdit">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				Ubah Data
			</div>
			<form>
				<div class="modal-body">
					<div class="form-group row">
					    <label class="col-sm-2 col-form-label">ID</label>
					    <div class="col-sm-10">
					      <input type="text" class="form-control" name="edit_iduser" id="iduser2" disabled="">
					    </div>
					</div>
					<div class="form-group row">
					    <label class="col-sm-2 col-form-label">Nama</label>
					    <div class="col-sm-10">
					      <input type="text" class="form-control" name="edit_nama" id="nama2">
					    </div>
					</div>
					<div class="form-group row">
					    <label class="col-sm-2 col-form-label">Handphone</label>
					    <div class="col-sm-10">
					      <input type="text" class="form-control" name="edit_handphone" id="handphone2">
					    </div>
					</div>
					<div class="form-group row">
					    <label class="col-sm-2 col-form-label">Role</label>
					    <div class="col-sm-10">
					      <select name="edit_role" id="role2" class="form-control">
					      	<option value="">-Pilih-</option>
					      	<option value="1">Admin</option>
					      	<option value="2">User</option>
					      </select>
					    </div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>				
			      	<button class="btn btn-info" id="btnUpdate">Simpan</button>
				</div>
			</form>
		</div>
	</div>
</div>

<!--modal hapus-->
<div class="modal fade" id="modalHapus">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                Hapus Barang
            </div>
            <form class="form-horizontal">
            <div class="modal-body">         
                    <input type="hidden" name="iduser" id="iduser" value="">
                    <div class="alert alert-warning">
                    	<p>Apakah Anda yakin mau menghapus user ini?</p>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                <button class="btn btn-danger" id="btnHapus">Hapus</button>
            </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript" src="<?php echo base_url().'assets/js/jquery.js'?>"></script>
<script type="text/javascript" src="<?php echo base_url().'assets/js/bootstrap.js'?>"></script>
<script type="text/javascript" src="<?php echo base_url().'assets/js/jquery.dataTables.js'?>"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script type="text/javascript">
$(document).ready(function(){

	tampildatauser(); //memanggil function untuk menampilkan data

	$('#tbluser').dataTable(); //memanggil datatables

	//menampilkan isi table user
	function tampildatauser() {
		$.ajax({
			type:"GET",
			url:"<?php echo base_url('index.php/user/data_user')?>",
			dataType:"JSON",
			success: function (data) {
				var tbody='';
				for (var i = 0; i<data.length; i++) {
					tbody += 	'<tr>'+
								'<td>'+data[i].nama+'</td>'+
								'<td>'+data[i].telp+'</td>'+
								'<td>'+data[i].role+'</td>'+
								'<td>'+
									'<a href="javascript:;" class="btn btn-success btn-sm btnEdit" data="'+data[i].iduser+'">Edit</a>'+
									'<a href="javascript:;" class="btn btn-danger btn-sm btnHapus" data="'+data[i].iduser+'">Hapus</a>'+
								'</td>'+
								'</tr>'
				}
				$('#isitbluser').html(tbody);
			}
		});
	}

	//simpan data
	$('#btnSimpan').on('click', function(){
		var nama = $('#nama').val();
		var handphone = $('#handphone').val();
		var role = $('#role').val();
		$.ajax({
			type:"POST",
			url:"<?= base_url('index.php/user/simpan_user')?>",
			dataType:'json',
			data:{nama:nama, handphone:handphone, role:role},
			success: function(data){
				$('[name="nama"]').val("");
				$('[name="handphone"]').val("");
				$('[name="role"]').val("");
				$('#modalTambah').modal('hide');
				swal({
					title:"Success!",
					text: "Data has been saved successfully!",
                  	icon: "success",
                  	button: "OK",
				});
				tampildatauser();
			}
		});
		return false;
	});

	//Edit Data
	$('#isitbluser').on('click', '.btnEdit', function() {
		var id=$(this).attr('data');
		$.ajax({
			type:"GET",
			url:"<?= base_url('index.php/user/get_user')?>",
			dataType:"JSON",
			data:{id:id},
			success: function(data) {
				$.each(data,function(iduser, nama, telp, role){
					$('#modalEdit').modal('show');
					$('[name="edit_iduser"]').val(data.iduser);
					$('[name="edit_nama"]').val(data.nama);
					$('[name="edit_handphone"]').val(data.telp);
					$('[name="edit_role"]').val(data.role);
				});
			}
		});
		return false;
	});

	//simpan update data
	$('#btnUpdate').on('click', function(){
		var iduser = $('#iduser2').val();
		var nama = $('#nama2').val();
		var handphone = $('#handphone2').val();
		var role = $('#role2').val();
		$.ajax({
			type:"POST",
			url:"<?= base_url('index.php/user/update_user')?>",
			dataType:'json',
			data:{iduser:iduser, nama:nama, handphone:handphone, role:role},
			success: function(data){
				$('[name="edit_iduser"]').val("");
				$('[name="edit_nama"]').val("");
				$('[name="edit_handphone"]').val("");
				$('[name="edit_role"]').val("");
				$('#modalEdit').modal('hide');
				swal({
					title:"Success!",
					text: "Data has been updated successfully!",
                  	icon: "success",
                  	button: "OK",
				});
				tampildatauser();
			}
		});
		return false;
	});

	//get hapus
	$('#isitbluser').on('click','.btnHapus', function() {
		var id = $(this).attr('data');
		$('#modalHapus').modal('show');
		$('[name="iduser"]').val(id);
	});

	//Hapus User
	$('#btnHapus').on('click', function(){
		var id = $('#iduser').val();
		$.ajax({
			type:"POST",
			url:"<?= base_url('index.php/user/hapus_user')?>",
			dataType:"JSON",
			data:{iduser:id},
			success: function(data){
				$('#modalHapus').modal('hide');
				swal({
					title:"Success!",
					text: "Data has been deleted successfully!",
                  	icon: "success",
                  	button: "OK",
				});
				tampildatauser();
			}
		});
		return false;
	});

});
</script>
</body>
</html>