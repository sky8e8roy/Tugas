<table class="table table-sm table-striped" id="datasatker">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode Satuan Kerja</th>
                            <th>Nama Satuan Kerja</th>
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
                        <td><?= $value['kd_satker']; ?></td>
                        <td><?= $value['nm_satker']; ?></td>
                        <td>
                            <button type="button" class="btn btn-info btn-sm" onclick="edit('<?= $value['kd_satker'] ?>')">
                                <i class="fa fa-pencil"></i> 
                            </button>&nbsp;
                            <button type="button" class="btn btn-danger btn-sm" onclick="hapus('<?= $value['kd_satker'] ?>')">
                                <i class="fa fa-trash"></i>
                            </button>
                        </td>
                    </tr>

                    <?php endforeach; ?>
                    </tbody>       
                </table>
<script>
 $(document).ready(function () {
     $('#datasatker').DataTable();
 });

 function edit(kd_satker){
     $.ajax({
         type: "post",
         url: "<?= site_url('satker/formedit') ?>",
         data: {
            kd_satker: kd_satker
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
 function hapus(kd_satker){
    Swal.fire({
    title: 'HAPUS',
    text: `Anda yakin akan menghapus data Satuan Kerja ${kd_satker} ini?!`,
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
         url: "<?= site_url('satker/hapus') ?>",
         data: {
            kd_satker: kd_satker
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
             datasatker();
             }
             
         },
         error: function(xhr, ajaxOptions, thrownError){
             alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError );
         }
     });
    }
    })
 }