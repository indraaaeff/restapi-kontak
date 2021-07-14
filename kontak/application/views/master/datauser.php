<div class="container">
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-12 box">
			<div class="table-responsive">
				<div class="row">
					<div class="col-lg-8 col-md-8 col-sm-12">
						<h3>Data User</h3>
					</div>
					<div class="col-lg-4 col-md-4 col-sm-12">
						<div class="d-grid gap-2 d-md-flex justify-content-md-end">
							<a href="<?php echo base_url(); ?>datauser/create" class="btn btn-info">Create User</a>
						</div>
					</div>
				</div>
				<hr>
				<table class="table table-dark table-striped" id="table-users">
					<thead>
						<tr>
							<th style="visibility: hidden;">ID</th>
							<th>NAMA</th>
							<th>Nomor HP</th>
							<th>EMAIL</th>
							<th>ACTION</th>
						</tr>
					</thead>
					<tbody></tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<!-- Form Create New User -->
<div class="modal fade" id="deleteUser" tabindex="-1" aria-labelledby="createUserLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="createUserLabel">Confirm Action</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="col-lg-12 col-md-12 col-sm-12 col-12" id="alert"></div>
			<form action="" id="formDelete">
				<div class="modal-body">
					<div class="mb-3 row d-none">
						<label for="inputId" class="col-sm-2 col-form-label">ID</label>
						<div class="col-sm-10">
							<input id="id" type="id" class="form-control" id="inputId" required disabled>
						</div>
					</div>
					<p>Are you sure delete this data ?</p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
					<button type="submit" class="btn btn-danger">Yes, Delete Data</button>
				</div>
				<div align="center">
                    <p class="countdown">

                    </p>
                </div>
			</form>
		</div>
	</div>
</div>
<script>
	$(document).ready(function() {
		var p = $('p.countdown');
		p.hide();
		//datatables
		var table_users = null;
	    table_users = $('#table-users').DataTable({
	        "processing": true,
	        "serverSide": true,
	        "ordering": true,
	        "order": [[ 0, 'asc' ]],
	        "ajax":
	        {
	            "url": "<?php echo RESTAPI; ?>"+"daftar", 
	            "type": "POST"
	        },
	        "deferRender": true,
	        "aLengthMenu": [[5, 10, 50],[ 5, 10, 50]], 
			"columnDefs": [
				{
					"targets": [ 0 ],
					"visible": false,
					"searchable": false
				}
			],
	        "columns": [
	            { "data": "id" , }, 
	            { "data": "nama" }, 
	            { "data": "no_hp" },
	            { "data": "email" },
				{ "render": function ( data, type, row ) {
	                    var html  = "<a href='<?php echo base_url(); ?>datauser/edit/"+row.id+"'>EDIT</a> | "
	                    html += "<a href='' data-id='"+row.id+"' data-bs-toggle='modal' data-bs-target='#deleteUser'>DELETE</a>"
	                    return html
	                }
	            },
	        ],
	    });

		$('#deleteUser').on('show.bs.modal', function (event) {
			var userId = $(event.relatedTarget).context.dataset.id;
			$(this).find(".modal-body #id").val(userId);
		});

		$("#formDelete").submit(function(e) {
			// var mdl = new bootstrap.Modal(document.getElementById('deleteUser'), options);
			e.preventDefault(); // avoid to execute the actual submit of the form.
			var form = $("#formDelete");
			var url = "<?php echo RESTAPI; ?>hapus";
			var arrdata = {
				"id"    : $("#id").val()
			}
			$.ajax({
				type: "POST",
				url: url,
				data: arrdata,
				success: function(response)
				{
					p.show();
					alert(response.message);
					refresh();
				}
			});
		});
	});

	function refresh(){
        var count = 5;
        var countdown = setInterval(function(){
            $("p.countdown").html("Refresh page in "+count + " seconds.");
            if (count == 0) {
            clearInterval(countdown);
            window.open('<?php echo base_url(); ?>', "_self");

            }
            count--;
        }, 1000);
    }
</script>