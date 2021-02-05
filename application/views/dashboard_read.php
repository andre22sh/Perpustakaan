<div class="alert alert-block alert-info">
	<button type="button" class="close" data-dismiss="alert">
		<i class="ace-icon fa fa-times"></i>
	</button>
		<i class="ace-icon fa fa-check green"></i>
			Selamat datang
		        <strong class="green">
					<b><?php echo $petugas;?></b>
				</strong>,<br><br>
			Have Nice A Day						
</div>

<div class="widget-header widget-header-flat widget-header-small">
	<h5 class="widget-title">
		<i class="ace-icon fa fa-signal"></i>
			Kelola Halaman Web
	</h5>
										
</div>
<br>

<div class="row">
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Jumlah Anggota</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            <?php foreach ($data_anggota as $anggota) : ?>
                                <?= $anggota['total']; ?>
                            <?php endforeach ?>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-users fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total judul Buku</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            <?php foreach ($data_buku as $data) : ?>
                                <?= $data['total']; ?>
                            <?php endforeach ?>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-book fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Total Transaksi Peminjaman</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            <?php foreach ($data_peminjaman as $data) : ?>
                                <?= $data['total']; ?>
                            <?php endforeach ?>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-chart-line fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Total Transaksi Pengembalian</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            <?php foreach ($data_pengembalian as $data) : ?>
                                <?= $data['total']; ?>
                            <?php endforeach ?>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-chart-line fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <!-- <h6 class="m-0 font-weight-bold text-primary">Area Chart</h6> -->
    </div>
    <div class="card-body">
        <div id="container"></div>
    </div>
 </div>

 <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>
    <script type="text/javascript">
        // Build the chart
        Highcharts.chart('container', {
            chart: {
                type: 'column'
            },
            title: {
                text: 'Jumlah Stok Buku Yang Tersedia'
            },
            xAxis: {
                categories: [
                    'Buku'
                ],
                /*categories: [
                    'Jan',
                    'Feb',
                    'Mar',
                    'Apr',
                    'May',
                    'Jun',
                    'Jul',
                    'Aug',
                    'Sep',
                    'Oct',
                    'Nov',
                    'Dec'
                ],*/
                crosshair: true
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Jumlah Buku'
                }
            },
            tooltip: {
                headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                    '<td style="padding:0"><b>{point.y:.f} Buku</b></td></tr>',
                footerFormat: '</table>',
                shared: true,
                useHTML: true
            },
            plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0
                }
            },

            //format data penduduk kota
            series: [
                <?php foreach ($buku as $data) : ?> {
                        name: '<?php echo $data['nama_buku']; ?>',
                        data: [<?php echo $data['jumlah_buku']; ?>]
                    },
                <?php endforeach ?>
            ]

            //format data original

            /*series: [{
                name: 'Tokyo',
                data: [49.9, 71.5, 106.4, 129.2, 144.0, 176.0, 135.6, 148.5, 216.4, 194.1, 95.6, 54.4]

            }, {
                name: 'New York',
                data: [83.6, 78.8, 98.5, 93.4, 106.0, 84.5, 105.0, 104.3, 91.2, 83.5, 106.6, 92.3]

            }, {
                name: 'London',
                data: [48.9, 38.8, 39.3, 41.4, 47.0, 48.3, 59.0, 59.6, 52.4, 65.2, 59.3, 51.2]

            }, {
                name: 'Berlin',
                data: [42.4, 33.2, 34.5, 39.7, 52.6, 75.5, 57.4, 60.4, 47.6, 39.1, 46.8, 51.1]

            }]*/
        });
    </script>

<div class="card shadow mb-4">
    <div class="card-header py-3">
    </div>
    <div class="card-body">
        <div id="container1"></div>
    </div>
 </div>

 <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>
    <script type="text/javascript">
        // Build the chart
        Highcharts.chart('container1', {
            chart: {
                type: 'column'
            },
            title: {
                text: 'Laporan Buku yang Dipinjam'
            },
            xAxis: {
                categories: [
                    'Buku'
                ],
                /*categories: [
                    'Jan',
                    'Feb',
                    'Mar',
                    'Apr',
                    'May',
                    'Jun',
                    'Jul',
                    'Aug',
                    'Sep',
                    'Oct',
                    'Nov',
                    'Dec'
                ],*/
                crosshair: true
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Jumlah Buku'
                }
            },
            tooltip: {
                headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                    '<td style="padding:0"><b>{point.y:.f} Buku</b></td></tr>',
                footerFormat: '</table>',
                shared: true,
                useHTML: true
            },
            plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0
                }
            },

            //format data penduduk kota
            series: [
                <?php foreach ($peminjaman as $data) : ?> {
                        name: '<?php echo $data['nama_buku']; ?>',
                        data: [<?php echo $data['jumlah_peminjaman']; ?>]
                    },
                <?php endforeach ?>
            ]

            //format data original

            /*series: [{
                name: 'Tokyo',
                data: [49.9, 71.5, 106.4, 129.2, 144.0, 176.0, 135.6, 148.5, 216.4, 194.1, 95.6, 54.4]

            }, {
                name: 'New York',
                data: [83.6, 78.8, 98.5, 93.4, 106.0, 84.5, 105.0, 104.3, 91.2, 83.5, 106.6, 92.3]

            }, {
                name: 'London',
                data: [48.9, 38.8, 39.3, 41.4, 47.0, 48.3, 59.0, 59.6, 52.4, 65.2, 59.3, 51.2]

            }, {
                name: 'Berlin',
                data: [42.4, 33.2, 34.5, 39.7, 52.6, 75.5, 57.4, 60.4, 47.6, 39.1, 46.8, 51.1]

            }]*/
        });
    </script>
