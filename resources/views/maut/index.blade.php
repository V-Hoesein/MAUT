@extends('layout.app')
@section('title', $title)
@section('content')
    {{ show_msg() }}

    <h4 class="card-title font-weight-bold text-primary mb-3">Nilai MIN dan MAX Variabel</h4>
    <div class="card card-primary card-outline">
        <div class="card-header d-flex justify-content-between">
            <div class="form-group">
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

    <h4 class="card-title font-weight-bold text-primary mb-3 mt-3">Nilai Utility</h4>
    <div class="card card-primary card-outline">
        <div class="card-header d-flex justify-content-between">
            <div class="form-group">
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

    <style>
        .pagination-container {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-wrap: wrap;
        }
        .pagination-container .page-btn {
            padding: 5px 12px;
            margin: 2px;
            border: 1px solid #007bff;
            background-color: #fff;
            color: #007bff;
            cursor: pointer;
            border-radius: 4px;
            transition: background-color 0.2s;
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
                const maxButtons = 5;
                let startButton = Math.max(1, currentPage - Math.floor(maxButtons / 2));
                let endButton = Math.min(pageCount, startButton + maxButtons - 1);
                startButton = Math.max(1, endButton - maxButtons + 1);

                if (startButton > 1) {
                    const firstBtn = createPageButton(1);
                    pagination.appendChild(firstBtn);
                    if (startButton > 2) pagination.appendChild(createDots());
                }

                for (let i = startButton; i <= endButton; i++) {
                    pagination.appendChild(createPageButton(i));
                }

                if (endButton < pageCount) {
                    if (endButton < pageCount - 1) pagination.appendChild(createDots());
                    pagination.appendChild(createPageButton(pageCount));
                }
            }

            function createPageButton(page) {
                const btn = document.createElement('button');
                btn.textContent = page;
                btn.classList.add('page-btn');
                if (page === currentPage) btn.classList.add('active');
                btn.addEventListener('click', () => setCurrentPage(page));
                return btn;
            }

            function createDots() {
                const dots = document.createElement('span');
                dots.textContent = '...';
                dots.classList.add('page-dots');
                return dots;
            }

            function setCurrentPage(page) {
                currentPage = page;
                displayPage(currentPage);
                setupPagination();
            }

            displayPage(currentPage);
            setupPagination();
        }

        document.addEventListener('DOMContentLoaded', function() {
            paginateTable('tableMinMax', 'paginationMinMax', 10); // Show 10 rows per page for MinMax table
            paginateTable('tableUtility', 'paginationUtility', 10); // Show 10 rows per page for Utility table
        });
    </script>
@endsection
