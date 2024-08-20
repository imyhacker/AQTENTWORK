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
                                            <th>Start Date</th>
                                            <th>Start Time</th>
                                            <th>Interval</th>
                                            <th>Run Count</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($response as $index => $schedule)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $schedule['.id'] }}</td>
                                                <td>{{ $schedule['name'] }}</td>
                                                <td>{{ $schedule['start_date'] }}</td>
                                                <td>{{ $schedule['start_time'] }}</td>
                                                <td>{{ $schedule['interval'] }}</td>
                                                <td>{{ $schedule['run_count'] }}</td> <!-- Add this line -->
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
