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
                            <div id="table-container">
            <table class="table table-bordered" id="myTable2">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Start Date</th>
                        <th>Start Time</th>
                        <th>Interval</th>
                        <th>Run Count</th>
                        <th>Jam</th>
                        <th>Hari</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($formattedData as $index => $schedule)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $schedule['.id'] }}</td>
                            <td>{{ $schedule['name'] }}</td>
                            <td>{{ $schedule['start_date'] }}</td>
                            <td>{{ $schedule['start_time'] }}</td>
                            <td>{{ $schedule['interval'] }}</td>
                            <td>{{ $schedule['run_count'] }}</td>
                           <!-- Tampilkan menit jika kecil, dan jam jika besar -->
                           <td>
                                                        @php
                                                            $minutes = $schedule['run_count'] * 20 / 60;
                                                            if ($minutes < 60) {
                                                                echo round($minutes) . ' menit';
                                                            } else {
                                                                echo round($minutes / 60) . ' jam';
                                                            }
                                                        @endphp
                                                    </td>
                                                    
                                                    <!-- Tampilkan jam jika cukup besar, dan hari jika besar -->
                                                    <td>
                                                        @php
                                                            $hours = $schedule['run_count'] * 20 / 60 / 60;
                                                            if ($hours < 24) {
                                                                echo round($hours) . ' jam';
                                                            } else {
                                                                echo round($hours / 24) . ' hari';
                                                            }
                                                        @endphp
                                                    </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
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
