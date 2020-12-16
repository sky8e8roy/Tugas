<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="id_modaledit" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Rubah Riwayat Kabupaten</h5>
        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>

      </div>
      <?= form_open('riwayat_kabupaten/updatedata', ['class' => 'formriwayatkab']) ?>
      <?= csrf_field(); ?>
      <div class="modal-body">

          <div class="form-group row">
              <input type="hidden" name="id_riwayatdata" value="<?= $id_riwayatdata ?>">
              <label for="" class="col-sm-2 col-form-label">Jenis Data</label>
              <div class="col-sm-6">
                  <select name="id_jenis_data" id="id_jenis_data" class="form-control">
                      <option value="<?= $id_jenis_data ?>" <?php if ($id_jenis_data == true) echo "selected"; ?>><?= $nm_jenis_data ?></option>
                      <?php foreach ($tampiljenisdata as $value) {?>
                      <option value="<?= $value['id_jenis_data'] ?>" ><?= $value['nm_jenis_data'] ?></option>
                      <?php } ?>
                  </select>
              </div>
          </div>  
          
          <div class="form-group row">
              <label for="" class="col-sm-2 col-form-label">Kabupaten</label>
              <div class="col-sm-6">
                  <select name="kd_kab" id="kd_kab" class="form-control">
                      <option value="<?= $kd_kab ?>" <?php if ($kd_kab == true) echo "selected"; ?>><?= $nm_kab ?></option>
                      <?php foreach ($tampildataKab as $value) {?>
                      <option value="<?= $value['kd_kab'] ?>" ><?= $value['nm_kab'] ?></option>
                      <?php } ?>
                  </select>
              </div>
          </div> 
            
            <div class="form-group row">
                <label for="" class="col-sm-2 col-form-label">Jumlah Data</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="jlh_data" name="jlh_data" value="<?= $jlh_data?>">
                        <div class="invalid-feedback errorNmkp">
                            
                        </div>
                    </div>
            </div> 
            
            <div class="form-group row">
                <label for="" class="col-sm-2 col-form-label">Tahun</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="thn" name="thn" value="<?= $thn?>">
                        <div class="invalid-feedback errorNmkp">
                            
                        </div>
                    </div>
            </div> 
      </div>
      
        <div class="modal-footer">    
            <button type="submit" class="btn btn-primary btnsimpan">Update</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
    <?= form_close() ?>
    </div>
  </div>
</div>
<script>
    $(document).ready(function () {
        $('.formriwayatkab').submit(function (e) { 
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
                    $('.btnsimpan').html('Update');                    
                },
                success: function (response) {
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

                        $('#id_modaledit').modal('hide');
                        datariwayatkab();
                    

                },
                error: function(xhr, ajaxOptions, thrownError){
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            });

            return false;
            
        });
    });
</script>