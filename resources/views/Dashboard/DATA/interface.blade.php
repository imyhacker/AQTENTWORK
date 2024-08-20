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
                                <table class="table table-bordered" id="myTable2">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>MAC</th>
                                            <th>Last UP</th>
                                            <th>TRX (GB)</th>
                                            <th>TTX (GB)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            function bytesToGB($bytes) {
                                                return number_format($bytes / (1024 * 1024 * 1024), 2);
                                            }
                                        @endphp
                                        @php $no = 1; @endphp
                                        @foreach ($response as $index => $schedule)
                                            <tr>
                                                <td>{{ $no++ }}</td>
                                                <td>{{ $schedule['.id'] }}</td>
                                                <td>{{ $schedule['name'] ?? "N/A" }}</td>
                                                <td>{{ $schedule['mac-address'] ?? "N/A" }}</td>
                                                <td>{{ $schedule['last-link-up-time'] }}</td>
                                                <td>{{ bytesToGB($schedule['rx-byte'] ?? 0) }} GB</td>
                                                <td>{{ bytesToGB($schedule['tx-byte'] ?? 0) }} GB</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
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
