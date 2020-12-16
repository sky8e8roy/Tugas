<table class="table table-sm table-striped" id="datasubsek">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Subsektor</th>
                            <th>Nama Sektor</th>
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
                        <td><?= $value['nm_subsek']; ?></td>
                        <td><?= $value['nm_sek']; ?></td>
                        <td><?= $value['nm_satker']; ?></td>
                        <td>
                            <button type="button" class="btn btn-info btn-sm" onclick="edit('<?= $value['id_subsek'] ?>')">
                                <i class="fa fa-pencil"></i> 
                            </button>&nbsp;
                            <button type="button" class="btn btn-danger btn-sm" onclick="hapus('<?= $value['id_subsek'] ?>')">
                                <i class="fa fa-trash"></i>
                            </button>
                        </td>
                    </tr>

                    <?php endforeach; ?>
                    </tbody>       
                </table>
<script>
 $(document).ready(function () {
     $('#datasubsek').DataTable();
 });

 function edit(id_subsek){
     $.ajax({
         type: "post",
         url: "<?= site_url('subsektor/formedit') ?>",
         data: {
            id_subsek: id_subsek
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
 function hapus(id_subsek){
    Swal.fire({
    title: 'HAPUS',
    text: `Anda yakin akan menghapus data Subsektor ini?!`,
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
         url: "<?= site_url('subsektor/hapus') ?>",
         data: {
            id_subsek: id_subsek
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
             datasubsektor();
             }
             
         },
         error: function(xhr, ajaxOptions, thrownError){
             alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError );
         }
     });
    }
    })
 }