<x-dcore.head />
<div id="app">
    <div class="main-wrapper main-wrapper-1">
        <div class="navbar-bg"></div>

        <x-dcore.nav />
        <x-dcore.sidebar />

        <div class="main-content">
            <section class="section">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="col-md-12">
                                    <a href="" class="btn btn-block btn-primary"><i class="fa fa-refresh"></i>Refresh</a>
                                </div>
                                <div id="table-container">
                                    <table class="table table-bordered" id="myTable2">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>ID</th>
                                                <th>Name</th>
                                                <th>MAC</th>
                                                <th>Last UP</th>
                                                <th>TRX</th>
                                                <th>TTX</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                if (!function_exists('formatBytes')) {
                                                    function formatBytes($bytes) {
                                                        if ($bytes >= 1024 * 1024 * 1024) {
                                                            return number_format($bytes / (1024 * 1024 * 1024), 2) . ' GB';
                                                        } elseif ($bytes >= 1024 * 1024) {
                                                            return number_format($bytes / (1024 * 1024), 2) . ' MB';
                                                        } elseif ($bytes >= 1024) {
                                                            return number_format($bytes / 1024, 2) . ' KB';
                                                        } else {
                                                            return number_format($bytes, 2) . ' BPS';
                                                        }
                                                    }
                                                }
                                            @endphp
                                            @php $no = 1; @endphp
                                            @foreach ($response as $index => $schedule)
                                                <tr>
                                                    <td>{{ $no++ }}</td>
                                                    <td>{{ $schedule['.id'] }}</td>
                                                    <td>{{ $schedule['name'] ?? "N/A" }}</td>
                                                    <td>{{ $schedule['mac-address'] ?? "N/A" }}</td>
                                                    <td>{{ $schedule['last-link-up-time'] ?? "N/A"}}</td>
                                                    <td>{{ formatBytes($schedule['rx-byte'] ?? 0) }}</td>
                                                    <td>{{ formatBytes($schedule['tx-byte'] ?? 0) }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <x-dcore.footer />
        <x-dcore.modaltambah />
    </div>
</div>
<x-dcore.script />
<script type="text/javascript">
    $(document).ready(function() {
        var table = $('#myTable2').DataTable({
            responsive: true,
            stateSave: true, // Simpan state pencarian, halaman, dll.
            destroy: true // Hancurkan DataTable yang ada sebelum inisialisasi ulang
        });

        function reloadTable() {
            // Simpan status pencarian dan halaman
            var searchValue = table.search();
            var pageInfo = table.page.info();

            // Muat ulang konten tabel
            $('#table-container').load(location.href + " #myTable2", function() {
                // Re-inisialisasi DataTable setelah tabel dimuat ulang
                table = $('#myTable2').DataTable({
                    responsive: true,
                    stateSave: true,
                    destroy: true
                });

                // Setel kembali status pencarian dan halaman
                table.search(searchValue).draw();
                table.page(pageInfo.page).draw(false); // Pertahankan halaman saat ini
            });
        }

        // Panggil fungsi reloadTable setiap 2 detik
        setInterval(reloadTable, 2000); // 2000 milliseconds = 2 seconds

        // Panggil sekali saat pertama kali halaman dimuat
        reloadTable();
    });
</script>
