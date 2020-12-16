<?= $this->extend('layout/main') ?>
<?= $this->extend('layout/menu') ?>
<?= $this->section('isi') ?>

<!-- DataTables -->
<link href="<?= base_url() ?>/assets/plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<link href="<?= base_url() ?>/assets/plugins/datatables/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
  <!-- Required datatable js -->
<script src="<?= base_url() ?>/assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>/assets/plugins/datatables/dataTables.bootstrap4.min.js"></script>
 
    <div class="col-sm-12">
        <div class="page-title-box">
            <h4 class="page-title">Data Subsektor</h4>
        </div>
    </div>

    <div class="col-sm-12">
        <div class="card m-b-30">
            <div class="card-body">
                <div class="card-title">
                    <!-- BUTTON modal -->
                <button type="button" class="btn btn-primary btn-sm tomboltambahsubsek" >
                <i class="fa fa-plus-circle"> Tambah</i>
                </button>
                </div>

                <p class="card-text viewdata">

                </p>
            </div>
        </div>
    
    </div>
    <div class="viewmodal" style="display: none;"></div>
<script>
    function datasubsektor() {
        $.ajax({
            url: "<?= site_url('subsektor/ambildata') ?>",
            dataType: "json",
            success: function (response) {
                $('.viewdata').html(response.data);
            },
            error: function(xhr, ajaxOptions, thrownError){
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
    }
   $(document).ready(function () {
        datasubsektor();

        $('.tomboltambahsubsek').click(function(e){
            e.preventDefault();

            $.ajax({
            url: "<?= site_url('subsektor/formtambah') ?>",
            dataType: "json",
            success: function (response) {

                $('.viewmodal').html(response.data).show();
                $('#id_modaltambah').modal('show');
            },
            error: function(xhr, ajaxOptions, thrownError){
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });

        });
    });
</script>
<?= $this->endSection() ?>