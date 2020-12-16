<table class="table table-sm table-striped" id="datasektor">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode Sektor</th>
                            <th>Nama Sektor</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>         
                    <tbody>
                    <?php 
                    $nomor = 1;
                    foreach ($tampildata as $value):
                        # code...
                    ?>
                    <tr>
                        <td><?= $nomor++; ?></td>
                        <td><?= $value['kd_sek']; ?></td>
                        <td><?= $value['nm_sek']; ?></td>
                        <td>
                            <button type="button" class="btn btn-info btn-sm" onclick="edit('<?= $value['kd_sek'] ?>')">
                                <i class="fa fa-pencil"></i> 
                            </button>&nbsp;
                            <button type="button" class="btn btn-danger btn-sm" onclick="hapus('<?= $value['kd_sek'] ?>')">
                                <i class="fa fa-trash"></i>
                            </button>
                        </td>
                    </tr>

                    <?php endforeach; ?>
                    </tbody>       
                </table>
<script>
 $(document).ready(function () {
     $('#datasektor').DataTable();
 });

 function edit(kd_sek){
     $.ajax({
         type: "post",
         url: "<?= site_url('sektor/formedit') ?>",
         data: {
            kd_sek: kd_sek
         },
         dataType: "json",
         success: function(response) {
             //jika berhasil maka akan di tampung modal yang ada di tampildata.php
             if (response.sukses){
             $('.viewmodal').html(response.sukses).show();
             $('#id_modaledit').modal('show');
             }
             
         },
         error: function(xhr, ajaxOptions, thrownError){
             alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError );
         }
     });
 }
 function hapus(kd_sek){
    Swal.fire({
    title: 'HAPUS',
    text: `Anda yakin akan menghapus data Sektor ${kd_sek} ini?!`,
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Ya!',
    cancelButtonText: 'Batal'
    }).then((result) => {
    if (result.isConfirmed) {
        $.ajax({
         type: "post",
         url: "<?= site_url('sektor/hapus') ?>",
         data: {
            kd_sek: kd_sek
         },
         dataType: "json",
         success: function(response) {
             //jika berhasil maka akan di tampung modal yang ada di tampildata.php
             if (response.sukses){
             Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: response.sukses,
            })
             datasektor();
             }
             
         },
         error: function(xhr, ajaxOptions, thrownError){
             alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError );
         }
     });
    }
    })
 }