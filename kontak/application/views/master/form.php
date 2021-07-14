<div class="container">
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-12 box">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12">
						<h3>FORM</h3>
				</div>
                <div class="col-lg-12">
                    <form action="" id="formUser">
                        <div class="mb-3 row d-none">
                            <label for="inputId" class="col-sm-2 col-form-label">ID</label>
                            <div class="col-sm-10">
                                <input id="id" type="id" class="form-control" id="inputId" required disabled>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="inputNama" class="col-sm-2 col-form-label">Nama</label>
                            <div class="col-sm-10">
                                <input id="nama" type="nama" class="form-control" id="inputNama" required>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="inputNo" class="col-sm-2 col-form-label">Nomor HP</label>
                            <div class="col-sm-10">
                                <input id="no_hp" type="no_hp" class="form-control" id="inputNo" required>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-10">
                                <input id="email" type="email" class="form-control" id="inputEmail" required>
                            </div>
                        </div>
                        <!-- <input class="form-control" type="text" id="exampleFormControlInput1"> -->
                        </div>
                        <div class="col-lg-6 col-sm-12" style="float:right;">
                            <button type="submit" class="btn btn-primary">Save changes</button>
                            <a href="<?php echo base_url(); ?>" class="btn btn-secondary">Back</a>
                        </div>
                    </form>
                </div>
                <div align="center">
                    <p class="countdown">

                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        var p = $('p.countdown');
		p.hide();
        var pathArray = window.location.pathname.split( '/' );
        var id = pathArray[5];
        if (id != undefined) {
            $.ajax({
                type: "GET",
                url: "<?php echo RESTAPI; ?>",
                data: {
                    "id": id
                },
                dataType: "json",
                success: function(response){
                    var data = response.data[0];
                    $('#formUser').find('input').val(function (index, value) {
                        return data[this.id];
                    });
                }
            });
        }
        
        $("#formUser").submit(function(e) {
            e.preventDefault(); // avoid to execute the actual submit of the form.
            var form = $("#formUser");
            if ($("#id").val()==""){
                var url = "<?php echo RESTAPI; ?>buat";
            } else {
                var url = "<?php echo RESTAPI; ?>ubah";
            }
            var arrdata = {
                "id"    : $("#id").val(),
                "nama"  : $("#nama").val(),
                "no_hp" : $("#no_hp").val(),
                "email" : $("#email").val()
            }
            $.ajax({
                type: "POST",
                url: url,
                data: arrdata,
                success: function(response)
                {
                    var newdata = response.data;
                    $('#formUser').find('in put').val(function (index, value) {
                        return newdata[this.id];
                    });
                    p.show();
                    alert(response.message);
                    redirect();
                }
            });
        });
    });
    // this is the id of the form

    function redirect(){
        var count = 5;
        var countdown = setInterval(function(){
            $("p.countdown").html(count + " redirecting.");
            if (count == 0) {
            clearInterval(countdown);
            window.open('<?php echo base_url(); ?>', "_self");

            }
            count--;
        }, 1000);
    }
</script>