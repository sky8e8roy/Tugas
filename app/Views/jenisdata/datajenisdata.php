<table class="table table-sm table-striped" id="datajenisdata">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Jenisdata</th>
                            <th>Satuan</th>
                            <th>Subsektor</th>
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
                        <td><?= $value['nm_jenis_data']; ?></td>
                        <td><?= $value['nm_sat']; ?></td>
                        <td><?= $value['nm_subsek']; ?></td>
                        <td>
                            <button type="button" class="btn btn-info btn-sm" onclick="edit('<?= $value['id_jenis_data'] ?>')">
                                <i class="fa fa-pencil"></i> 
                            </button>&nbsp;
                            <button type="button" class="btn btn-danger btn-sm" onclick="hapus('<?= $value['id_jenis_data'] ?>')">
                                <i class="fa fa-trash"></i>
                            </button>
                        </td>
                    </tr>

                    <?php endforeach; ?>
                    </tbody>       
                </table>
<script>
 $(document).ready(function () {
     $('#datajenisdata').DataTable();
 });

 function edit(id_jenis_data){
     $.ajax({
         type: "post",
         url: "<?= site_url('jenisdata/formedit') ?>",
         data: {
            id_jenis_data: id_jenis_data
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
 function hapus(id_jenis_data){
    Swal.fire({
    title: 'HAPUS',
    text: `Anda yakin akan menghapus data jenisdata ini?!`,
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
         url: "<?= site_url('jenisdata/hapus') ?>",
         data: {
            id_jenis_data: id_jenis_data
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
             datajenisdata();
             }
             
         },
         error: function(xhr, ajaxOptions, thrownError){
             alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError );
         }
     });
    }
    })
 }