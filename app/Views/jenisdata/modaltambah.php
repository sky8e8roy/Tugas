<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="id_modaltambah" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah jenisdata</h5>
        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>

      </div>
      <?= form_open('jenisdata/simpandata', ['class' => 'formjenisdata']) ?>
     
      <div class="modal-body">

                
                <div class="form-group row">
                    <label for="" class="col-sm-2 col-form-label">Jenis Data</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nm_jenis_data" name="nm_jenis_data">
                            <div class="invalid-feedback errorNmjenisdata">
                                
                            </div>
                        </div>
                </div>

                <div class="form-group row">
                    <label for="" class="col-sm-2 col-form-label">Satuan</label>
                    <div class="col-sm-6">
                        <select name="kd_sat" id="kd_sat" class="form-control">
                        
                    <?php 
                    foreach ($tampildataSat as $value):
                    ?>                    
                            <option value="<?= $value['kd_sat'] ?>"><?= $value['nm_sat'] ?></option>

                            <?php endforeach; ?>
                        </select>
                    </div>
                </div> 
            

                <div class="form-group row">
                    <label for="" class="col-sm-2 col-form-label">Subsektor</label>
                    <div class="col-sm-6">
                        <select name="id_subsek" id="id_subsek" class="form-control">
                        
                    <?php 
                    foreach ($tampildataSubsek as $value):
                    ?>                    
                            <option value="<?= $value['id_subsek'] ?>"><?= $value['nm_subsek'] ?></option>

                            <?php endforeach; ?>
                        </select>
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
        $('.formjenisdata').submit(function (e) { 
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
                        
                        if(response.error.nm_jenis_data){
                            $('#nm_jenis_data').addClass('is-invalid');
                            $('.errorNmjenisdata').html(response.error.nm_jenis_data);
                        }else{
                            $('#nm_jenis_data').removeClass('is-invalid');
                            $('.errorNmjenisdata').html('');
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
                        datajenisdata();
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