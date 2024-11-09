@extends('layout.app')
@section('title', $title)
@section('content')
    {{ show_msg() }}

    <!-- Nilai MIN dan MAX Variabel -->
    <h4 class="card-title font-weight-bold text-primary mb-3">Nilai MIN dan MAX Variabel</h4>
    <div class="card card-primary card-outline">
        <div class="card-header d-flex justify-content-between">
            <div class="btn-group" role="group">
                <div class="form-group mr-1" {{ is_hidden('maut.create') }}>
                    <a class="btn btn-primary" href="{{ route('maut.create') }}"><i class="fa fa-plus"></i> Tambah</a>
                </div>
                <div class="form-group mr-1" {{ is_hidden('maut.cetak') }}>
                    <a class="btn btn-secondary" href="{{ route('maut.cetak') }}" target="_blank">
                        <span class="fa fa-print"></span> Cetak</a>
                </div>
            </div>
        </div>
        <div class="card-body p-0 table-responsive">
            <table id="tableMinMax" class="table table-bordered table-hover table-striped m-0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kelas</th>
                        <th>Mapel</th>
                        <th>Topik</th>
                        <th>Model Belajar</th>
                        <th>Variabel</th>
                        <th>Nilai MIN</th>
                        <th>Nilai MAX</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($rows['minMax'] as $index => $row)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $row['kelas'] }}</td>
                            <td>{{ $row['mapel'] }}</td>
                            <td>{{ $row['topik'] }}</td>
                            <td>{{ $row['model'] }}</td>
                            <td>{{ $row['variabel'] }}</td>
                            <td>{{ $row['nilaiMIN'] }}</td>
                            <td>{{ $row['nilaiMAX'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div id="paginationMinMax" class="pagination-container mt-2"></div>
        </div>
    </div>

    <!-- Nilai Utility -->
    <h4 class="card-title font-weight-bold text-primary mb-3 mt-3">Nilai Utility</h4>
    <div class="card card-primary card-outline">
        <div class="card-header d-flex justify-content-between">
            <div class="btn-group" role="group">
                <div class="form-group mr-1" {{ is_hidden('maut.create') }}>
                    <a class="btn btn-primary" href="{{ route('maut.create') }}"><i class="fa fa-plus"></i> Tambah</a>
                </div>
                <div class="form-group mr-1" {{ is_hidden('maut.cetak') }}>
                    <a class="btn btn-secondary" href="{{ route('maut.cetak') }}" target="_blank">
                        <span class="fa fa-print"></span> Cetak</a>
                </div>
            </div>
        </div>
        <div class="card-body p-0 table-responsive">
            <table id="tableUtility" class="table table-bordered table-hover table-striped m-0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kelas</th>
                        <th>Mapel</th>
                        <th>Guru</th>
                        <th>Topik</th>
                        <th>Model Belajar</th>
                        <th>Variabel</th>
                        <th>Nama Siswa</th>
                        <th>Nilai</th>
                        <th>Normalisasi</th>
                        <th>Utility</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($rows['nilai'] as $index => $row)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $row['kelas'] }}</td>
                            <td>{{ $row['mapel'] }}</td>
                            <td>{{ $row['nama_guru'] }}</td>
                            <td>{{ $row['topik'] }}</td>
                            <td>{{ $row['model_belajar'] }}</td>
                            <td>{{ $row['variabel'] }}</td>
                            <td>{{ $row['nama_siswa'] }}</td>
                            <td>{{ $row['nilai'] }}</td>
                            <td>{{ round($row['nilai_normalized'], 3) }}</td>
                            <td>{{ round($row['weighted_value'], 3) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div id="paginationUtility" class="pagination-container mt-2"></div>
        </div>
    </div>

    <!-- Total MAUT -->
    <h4 class="card-title font-weight-bold text-primary mb-3 mt-3">Total MAUT</h4>
    <div class="card card-primary card-outline">
        <div class="card-header d-flex justify-content-between">
            <div class="btn-group" role="group">
                <div class="form-group mr-1" {{ is_hidden('maut.create') }}>
                    <a class="btn btn-primary" href="{{ route('maut.create') }}"><i class="fa fa-plus"></i> Tambah</a>
                </div>
                <div class="form-group mr-1" {{ is_hidden('maut.cetak') }}>
                    <a class="btn btn-secondary" href="{{ route('maut.cetak') }}" target="_blank">
                        <span class="fa fa-print"></span> Cetak</a>
                </div>
            </div>
        </div>
        <div class="card-body p-0 table-responsive">
            <table id="tableTotalMAUT" class="table table-bordered table-hover table-striped m-0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kelas</th>
                        <th>Mapel</th>
                        <th>Topik</th>
                        <th>Model Belajar</th>
                        <th>Total Weighted Value</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($rows['totalMAUT'] as $key => $row)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $row['kelas'] }}</td>
                            <td>{{ $row['mapel'] }}</td>
                            <td>{{ $row['topik'] }}</td>
                            <td>{{ $row['model_belajar'] }}</td>
                            <td>{{ round($row['total_weighted_value'], 3) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div id="paginationTotalMAUT" class="pagination-container mt-2"></div>
        </div>
    </div>

    <!-- Average MAUT -->
    <h4 class="card-title font-weight-bold text-primary mb-3 mt-3">Average MAUT</h4>
    <div class="card card-primary card-outline">
        <div class="card-header d-flex justify-content-between">
            <div class="btn-group" role="group">
                <div class="form-group mr-1" {{ is_hidden('maut.create') }}>
                    <a class="btn btn-primary" href="{{ route('maut.create') }}"><i class="fa fa-plus"></i> Tambah</a>
                </div>
                <div class="form-group mr-1" {{ is_hidden('maut.cetak') }}>
                    <a class="btn btn-secondary" href="{{ route('maut.cetak') }}" target="_blank">
                        <span class="fa fa-print"></span> Cetak</a>
                </div>
            </div>
        </div>
        <div class="card-body p-0 table-responsive">
            @php
                // Find the highest average_value in the array for conditional highlighting
                $maxAverageValue = max(array_column($rows['averageMAUT'], 'average_value'));
            @endphp
            <table id="tableAverageMAUT" class="table table-bordered table-hover table-striped m-0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Model Belajar</th>
                        <th>Total Value</th>
                        <th>Count</th>
                        <th>Average Value</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($rows['averageMAUT'] as $key => $row)
                        <tr class="{{ $row['average_value'] == $maxAverageValue ? 'highlight-row' : '' }}">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $row['model_belajar'] }}</td>
                            <td>{{ round($row['total_value'], 3) }}</td>
                            <td>{{ $row['count'] }}</td>
                            <td>{{ round($row['average_value'], 3) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div id="paginationAverageMAUT" class="pagination-container mt-2"></div>
        </div>
    </div>


    <style>
        .highlight-row {
            background-color: #d4edda;
            /* Light green background */
            color: #155724;
            font-weight: 900;
            /* Dark green text */
        }


        /* Styling for pagination buttons */
        .pagination-container {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-wrap: wrap;
            margin-top: 20px;
        }

        .pagination-container .page-btn {
            padding: 8px 16px;
            margin: 0 4px;
            border: 1px solid #007bff;
            background-color: #fff;
            color: #007bff;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s, color 0.3s;
        }

        .pagination-container .page-btn.active {
            background-color: #007bff;
            color: #fff;
        }

        .pagination-container .page-btn:hover {
            background-color: #0056b3;
            color: #fff;
        }

        .pagination-container .page-dots {
            margin: 0 5px;
            color: #007bff;
        }
    </style>

    <script>
        // JavaScript to manage table pagination
        function paginateTable(tableId, paginationId, rowsPerPage) {
            const table = document.getElementById(tableId).getElementsByTagName('tbody')[0];
            const rows = table.getElementsByTagName('tr');
            const pagination = document.getElementById(paginationId);
            let currentPage = 1;

            function displayPage(page) {
                const start = (page - 1) * rowsPerPage;
                const end = start + rowsPerPage;
                for (let i = 0; i < rows.length; i++) {
                    rows[i].style.display = i >= start && i < end ? '' : 'none';
                }
            }

            function setupPagination() {
                pagination.innerHTML = '';
                const pageCount = Math.ceil(rows.length / rowsPerPage);
                for (let i = 1; i <= pageCount; i++) {
                    const pageBtn = document.createElement('button');
                    pageBtn.classList.add('page-btn');
                    pageBtn.textContent = i;
                    pageBtn.onclick = () => {
                        currentPage = i;
                        displayPage(currentPage);
                        const activeBtn = pagination.querySelector('.active');
                        if (activeBtn) activeBtn.classList.remove('active');
                        pageBtn.classList.add('active');
                    };
                    if (i === 1) pageBtn.classList.add('active');
                    pagination.appendChild(pageBtn);
                }
            }

            displayPage(currentPage);
            setupPagination();
        }

        document.addEventListener('DOMContentLoaded', () => {
            paginateTable('tableMinMax', 'paginationMinMax', 10);
            paginateTable('tableUtility', 'paginationUtility', 10);
            paginateTable('tableTotalMAUT', 'paginationTotalMAUT', 10);
            paginateTable('tableAverageMAUT', 'paginationAverageMAUT', 10);
        });
    </script>
@endsection
