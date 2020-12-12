<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="id_modaltambah" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Kampung</h5>
        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>

      </div>
      <?= form_open('kampung/simpandata', ['class' => 'formkampung']) ?>
     
      <div class="modal-body">

                <div class="form-group row">
                    <label for="" class="col-sm-2 col-form-label">Kampung</label>
                    <div class="col-sm-6">
                        <select name="kd_kec" id="kd_kec" class="form-control">
                        
                    <?php 
                    foreach ($tampildata as $value):
                    ?>                    
                            <option value="<?= $value['kd_kec'] ?>"><?= $value['nm_kec'] ?></option>

                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

            <div class="form-group row">
                <label for="" class="col-sm-2 col-form-label">Kode Kampung</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="kd_kp" name="kd_kp">
                        <div class="invalid-feedback errorKdkp">
                            
                        </div>
                    </div>
            </div>  
            
            <div class="form-group row">
                <label for="" class="col-sm-2 col-form-label">Nama Kampung</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="nm_kp" name="nm_kp">
                        <div class="invalid-feedback errorNmkp">
                            
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
        $('.formkampung').submit(function (e) { 
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
                        
                        if(response.error.kd_kp){
                            $('#kd_kp').addClass('is-invalid');
                            $('.errorKdkp').html(response.error.kd_kp);
                        }else{
                            $('#kd_kp').removeClass('is-invalid');
                            $('.errorKdkp').html('');
                        }

                        if(response.error.nm_kp){
                            $('#nm_kp').addClass('is-invalid');
                            $('.errorNmkp').html(response.error.nm_kp);
                        }else{
                            $('#nm_kp').removeClass('is-invalid');
                            $('.errorNmkp').html('');
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
                        datakampung();
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