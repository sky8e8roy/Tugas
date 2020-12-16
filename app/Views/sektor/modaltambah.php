<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="id_modaltambah" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Sektor</h5>
        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>

      </div>
      <?= form_open('sektor/simpandata', ['class' => 'formsektor']) ?>
      <?= csrf_field() ?>
      <div class="modal-body">
            <div class="form-group row">
                <label for="" class="col-sm-2 col-form-label">Kode Sektor</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="kd_sek" name="kd_sek">
                        <div class="invalid-feedback errorKdsek">
                            
                        </div>
                    </div>
            </div>  
            
            <div class="form-group row">
                <label for="" class="col-sm-2 col-form-label">Nama Sektor</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="nm_sek" name="nm_sek">
                        <div class="invalid-feedback errorNmsek">
                            
                        </div>
                    </div>
            </div>        
      </div>
      
        <div class="modal-footer">    
            <button type="submit" class="btn btn-primary btnsimpan">Save changes</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
    <?= form_close() ?>
    </div>
  </div>
</div>
<script>
    $(document).ready(function () {
        $('.formsektor').submit(function (e) { 
            e.preventDefault();

            $.ajax({
                type: "post",
                url: $(this).attr('action'),
                data: $(this).serialize(),
                dataType: "json",
                beforeSend: function() {
                    $('.btnsimpan').attr('disable','disabled');
                    $('.btnsimpan').html('<i class="fa fa-spin fa-spinner"></i>');
                },
                complete: function() {
                    $('.btnsimpan').removeAttr('disable');
                    $('.btnsimpan').html('Simpan');                    
                },
                success: function (response) {
                    if(response.error){
                        if(response.error.kd_sek){
                            $('#kd_sek').addClass('is-invalid');
                            $('.errorKdsek').html(response.error.kd_sek);
                        }else{
                            $('#kd_sek').removeClass('is-invalid');
                            $('.errorKdsek').html('');
                        }

                        if(response.error.nm_sek){
                            $('#nm_sek').addClass('is-invalid');
                            $('.errorNmsek').html(response.error.nm_sek);
                        }else{
                            $('#nm_sek').removeClass('is-invalid');
                            $('.errorNmsek').html('');
                        }
                        
                    }else{
                       // alert(response.sukses);
                       //ganti alert dengan sweetalert2
                        

                        const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                        })

                        Toast.fire({
                        icon: 'success',
                        title: response.sukses,
                       // text: response.sukses
                        })

                        $('#id_modaltambah').modal('hide');
                        datasektor();
                    }

                },
                error: function(xhr, ajaxOptions, thrownError){
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            });

            return false;
            
        });
    });
</script>