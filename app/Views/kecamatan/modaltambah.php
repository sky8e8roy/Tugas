<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="id_modaltambah" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Kecamatan</h5>
        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>

      </div>
      <?= form_open('kecamatan/simpandata', ['class' => 'formkecamatan']) ?>
     
      <div class="modal-body">

                <div class="form-group row">
                    <label for="" class="col-sm-2 col-form-label">Kabupaten</label>
                    <div class="col-sm-6">
                        <select name="kd_kab" id="kd_kab" class="form-control">
                        
                    <?php 
                    foreach ($tampildata as $value):
                    ?>                    
                            <option value="<?= $value['kd_kab'] ?>"><?= $value['nm_kab'] ?></option>

                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

            <div class="form-group row">
                <label for="" class="col-sm-2 col-form-label">Kode Kecamatan</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="kd_kec" name="kd_kec">
                        <div class="invalid-feedback errorKdkec">
                            
                        </div>
                    </div>
            </div>  
            
            <div class="form-group row">
                <label for="" class="col-sm-2 col-form-label">Nama Kecamatan</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="nm_kec" name="nm_kec">
                        <div class="invalid-feedback errorNmkec">
                            
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
        $('.formkecamatan').submit(function (e) { 
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
                        
                        if(response.error.kd_kec){
                            $('#kd_kec').addClass('is-invalid');
                            $('.errorKdkec').html(response.error.kd_kec);
                        }else{
                            $('#kd_kec').removeClass('is-invalid');
                            $('.errorKdkec').html('');
                        }

                        if(response.error.nm_kec){
                            $('#nm_kec').addClass('is-invalid');
                            $('.errorNmkec').html(response.error.nm_kec);
                        }else{
                            $('#nm_kec').removeClass('is-invalid');
                            $('.errorNmkec').html('');
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
                        datakecamatan();
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