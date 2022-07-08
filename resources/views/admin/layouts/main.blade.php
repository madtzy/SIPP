<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <!-- css -->
    <link rel="stylesheet" type="text/css" href="/css/admin.css">
    {{-- PRIMARY --}}
    {{-- Ajax --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">
    {{-- Datatables --}}
    <link href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    {{-- EXTENSION --}}
    {{-- Button --}}
    <link href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.bootstrap5.min.css" rel="stylesheet">
    <!-- box icon -->
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
    <title>SIPP | {{ $title }}</title>
</head>

<body id="body-pd">
    <header class="header bg-light" id="header">
        <div class="header__toggle">
            <i class='bx bx-menu' id="header-toggle"></i>
        </div>
        <div class="welcome ms-auto"><strong>Welcome, {{ auth()->user()->nama }}</strong></div>
        
        <div class="navbar-nav d-flex">
            <div class="nav-item text-nowrap">
                <form action="/logout" method="post">
                    @csrf
                    <button class="nav-link text-dark bg-light border-0 ms-3 py-3 px-3">
                        <i class="fa-solid fa-right-from-bracket fa-lg"></i>
                    </button>
                </form>
            </div>
        </div>
    </header>
    @include('admin.layouts.sidebar')
    <div class="margin">
        @yield('content')
    </div>
    @include('admin.layouts.footer')
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
    </script> -->
    <script src="/js/admin.js"></script>

    {{-- PRIMARY --}}

    {{-- JQuery --}}
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    {{-- Datatables --}}
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>

    {{-- EXTENSION --}}
    {{-- Button --}}
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.bootstrap5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.colVis.min.js"></script>
    {{-- Stok Otomatis --}}
    <script type="text/javascript">
        $(".stok").keyup(function() {
            var stok_sebelumnya = parseInt($("#stok_sebelumnya").val())
            var stok_tambah = parseInt($("#stok_tambah").val())

            var stok_akhir = stok_sebelumnya + stok_tambah;
            $("#stok_akhir").attr("value", stok_akhir)
        })
    </script>
    <script>
        $(document).ready(function() {
            var table = $('#table').DataTable({
                "sScrollY": ($(window).height() - 430),
                lengthChange: false,
                buttons: [{
                        extend: 'print',
                        title: 'Data Produk',
                        text: '<i class="fa-solid fa-print"></i>',
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: 'pdf',
                        title: 'Data Produk',
                        text: '<i class="fa-solid fa-file-pdf"></i>',
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: 'excel',
                        title: 'Data Produk',
                        text: '<i class="fa-solid fa-file-excel"></i>',
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    'colvis'
                ],
                columnDefs: [{
                    targets: -1,
                    visible: true
                }],
                language: {
                    emptyTable: "Data tidak tersedia",
                    info: "_START_ sampai _END_ dari _TOTAL_ total data",
                    search: "Cari:",
                    loadingRecords: "Tunggu sebentar...",
                    processing: "Memproses...",
                    paginate: {
                        "first": "First",
                        "last": "Last",
                        "next": ">",
                        "previous": "<"
                    },
                }
            });
            table.buttons().container()
                .appendTo('#table_wrapper .col-md-6:eq(0)');
        });
    </script>
</body>

</html>
