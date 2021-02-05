<?php if ($this->session->tempdata('message') == TRUE) : ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <p><?php echo $this->session->tempdata('message'); ?>
    </div>
<?php endif; ?>

<a href="<?php echo site_url('petugas/insert');?>" class="btn btn-primary float-right">Tambah</a>
<br /><br />

<div class="container-fluid">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
            <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><?php echo $judul;?></h6>
            </div>
        <div class="card-body">
            <div class="table-responsive">
            <table class="table table-bordered"  id="table" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>NIP</th>
                        <th>Nama</th>
                        <th>Alamat</th>
                        <th>No.Telpon</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <!--looping data provinsi-->	
                </tbody> 
                </table>
                
            </div>
        </div>
    </div>

</div>


<a href="<?php echo site_url('petugas/export');?>" class="btn btn-success float-right">Export Data</a>
<script type="text/javascript">
    var table;
    jQuery(document).ready(function() {
        table = $('#table').DataTable({

            "responsive": true,
            "processing": true,
            "language": {
                "processing": '<i class="fas fa-circle-notch fa-spin fa-1x fa-fw"></i><span>Loading...</span> '
            },
            "serverSide": true,
            "lengthChange": false,
            "pageLength": 5,
            "order": [],
            "ajax": {
                "url": "<?php echo site_url('petugas/datatables') ?>",
                "type": "POST"
            },
            "columnDefs": [{
                "targets": [0],
                "orderable": false,
            }, ],
        });

        $('#table tbody').on('click', '.hapus', () => {
            if (!confirm("Are you sure ?")) {
                return false;
            }
        });
    });
</script>