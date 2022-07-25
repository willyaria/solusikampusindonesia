@extends('layouts.app')

@section('content')

<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap.min.css">

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
            
            <br>
            <button class="btn btn-primary btn-sm btn-flat" data-toggle="modal" data-target="#modal-add"><i class="fa fa-plus"></i>Tambah</button>
            <br>
            <br>
            <table id="instansi" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Aksi</th>
                        <th>Instansi</th>
                        <th>Deskripsi</th>
                    </tr>
                </thead>
                <tbody>

				</tbody>
            </table>


        </div>
    </div>
</div>

<div class="modal inmodal fade" id="modal-add" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xs">
        <!-- <form name="frm_add" id="frm_add" class="form-horizontal" action="" method="POST" enctype="multipart/form-data">
            @csrf -->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">Tambah Instansi</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group"><label class="col-lg-2 control-label">Instansi</label>
                        <div class="col-lg-10" style="padding-bottom: 10px;"><input type="text" name="nama_instansi" id="nama_instansi" class="form-control" autocomplete="true"></div>
                    </div>
                    <div class="form-group"><label class="col-lg-2 control-label">Deskripsi</label>
                        <div class="col-lg-10"><textarea type="text" name="deskripsi" id="deskripsi" rows="3" class="form-control" autocomplete="true"></textarea></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-white" data-dismiss="modal">Tutup</button>
                    <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="on_save()">Simpan</button>
                </div>
            </div>
        <!-- </form> -->
    </div>
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script src="//cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap.min.js"></script>
<script type="text/javascript">
    var table;
	
	$(document).ready(function() {
		table = $('#instansi').DataTable({
			processing: true,
			serverSide: true,
			"ordering": 'true',
			"order": [0, 'desc'],
			ajax: "{{ url('listInstansi') }}",
			columns: 
			[
				{ data: 'id', name: 'id' },               
				{ data: 'action', name: 'action' },
				{ data: 'nama', name: 'nama' },
				{ data: 'deskripsi', name: 'deskripsi' }
			]
		});
	});

    function on_save()
	{
		$.ajax({
			type: "POST",
			url: "{{ url('createInstansi') }}",
			data: {	
				"_token"		: "{{ csrf_token() }}",
				ins	    	    : $("#nama_instansi").val(),
				des	            : $("#deskripsi").val(),
			} ,
			success:function(data){
                table.ajax.reload(null,false);
				$("#nama_instansi").val('');
                $("#deskripsi").val('');
            },
			complete:function () {
			}
        });
	}

	$(document).on('click', '.delete', function(){
		user_id = $(this).attr('id');
		$('#id_hapus').val(user_id);
        $('#hapus_id').html(user_id);
        $('#delete_modal').modal('show');
	});
	
	$(document).on('click', '.delete', function(){
        user_id = $(this).attr('id');
		$.ajax({
			url:"hapusInstansi/"+user_id,
			beforeSend:function(){
				
			},
			success:function(data)
			{
				table.ajax.reload(null,false);
			}, 
			complete:function () {

            } 
		})
	});
    
</script>

@endsection
