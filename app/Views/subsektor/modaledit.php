<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="id_modaledit" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Rubah Subsektor</h5>
        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>

      </div>
      <?= form_open('subsektor/updatedata', ['class' => 'formsubsek']) ?>
      <?= csrf_field(); ?>
      <div class="modal-body">

          <div class="form-group row">
              <input type="hidden" name="id_subsek" value="<?= $id_subsek ?>">
              <label for="" class="col-sm-2 col-form-label">Satuan Kerja</label>
              <div class="col-sm-6">
                  <select name="kd_satker" id="kd_satker" class="form-control">
                      <option value="<?= $kd_satker ?>" <?php if ($kd_satker == true) echo "selected"; ?>><?= $nm_satker ?></option>
                      <?php foreach ($tampildataSatker as $value) {?>
                      <option value="<?= $value['kd_satker'] ?>" ><?= $value['nm_satker'] ?></option>
                      <?php } ?>
                  </select>
              </div>
          </div>  
          
          <div class="form-group row">
              <label for="" class="col-sm-2 col-form-label">Sektor</label>
              <div class="col-sm-6">
                  <select name="kd_sek" id="kd_sek" class="form-control">
                      <option value="<?= $kd_sek ?>" <?php if ($kd_sek == true) echo "selected"; ?>><?= $nm_sek ?></option>
                      <?php foreach ($tampildataSek as $value) {?>
                      <option value="<?= $value['kd_sek'] ?>" ><?= $value['nm_sek'] ?></option>
                      <?php } ?>
                  </select>
              </div>
          </div> 
            
            <div class="form-group row">
                <label for="" class="col-sm-2 col-form-label">SubSektor</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="nm_subsek" name="nm_subsek" value="<?= $nm_subsek?>">
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
        $('.formsubsek').submit(function (e) { 
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
                        datasubsektor();
                    

                },
                error: function(xhr, ajaxOptions, thrownError){
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            });

            return false;
            
        });
    });
</script>