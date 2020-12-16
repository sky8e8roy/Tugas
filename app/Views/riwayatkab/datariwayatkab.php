<table class="table table-sm table-striped" id="datariwayatkab">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Jenis Data</th>
                            <th>Jumlah Data</th>
                            <th>Tahun</th>
                            <th>Kabupaten</th>
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
                        <td><?= $value['jlh_data']; ?></td>
                        <td><?= $value['thn']; ?></td>
                        <td><?= $value['nm_kab']; ?></td>
                        <td>
                            <button type="button" class="btn btn-info btn-sm" onclick="edit('<?= $value['id_riwayatdata'] ?>')">
                                <i class="fa fa-pencil"></i> 
                            </button>&nbsp;
                            <button type="button" class="btn btn-danger btn-sm" onclick="hapus('<?= $value['id_riwayatdata'] ?>')">
                                <i class="fa fa-trash"></i>
                            </button>
                        </td>
                    </tr>

                    <?php endforeach; ?>
                    </tbody>       
                </table>
<script>
 $(document).ready(function () {
     $('#datariwayatkab').DataTable();
 });

 function edit(id_riwayatdata){
     $.ajax({
         type: "post",
         url: "<?= site_url('riwayat_kabupaten/formedit') ?>",
         data: {
            id_riwayatdata: id_riwayatdata
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
 function hapus(id_riwayatdata){
    Swal.fire({
    title: 'HAPUS',
    text: `Anda yakin akan menghapus data riwayatkab ini?!`,
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
         url: "<?= site_url('riwayat_kabupaten/hapus') ?>",
         data: {
            id_riwayatdata: id_riwayatdata
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
             datariwayatkab();
             }
             
         },
         error: function(xhr, ajaxOptions, thrownError){
             alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError );
         }
     });
    }
    })
 }