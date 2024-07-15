@extends('layout.header')

@section('title', 'Transaksi')

@section('main')
    <style>
        #tableTransaksi_filter {
            display: none;
        }
    </style>

    <div class="container-fluid">
        <div>
            <h3 class="mt-3 fw-bold">Transaksi</h3>
        </div>

        <!-- Modal Tambah-->
        <div class="modal fade" id="modalTambahTransaksi" tabindex="-1" aria-labelledby="modalTambahTransaksiLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="modalTambahTransaksiLabel">Add New</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="company" class="form-label fw-bold">Company</label>
                            <input type="text" class="form-control" id="company" value="testcase" disabled>
                        </div>
                        <div class="mb-3">
                            <label for="code" class="form-label fw-bold">Code</label>
                            <input type="text" class="form-control" id="code" value="<<AutoGenerate>>" required>
                        </div>
                        <div class="mb-3">
                            <label for="date" class="form-label fw-bold">Date</label>
                            <input type="date" class="form-control" id="date" value="2023-12-28" required>
                        </div>
                        <div class="mb-3">
                            <label for="account" class="form-label fw-bold">Account</label>
                            <select class="form-select" id="account" required>
                                <option value="" selected disabled>Please select account</option>
                                <option value="Biaya Adm Bank - 800-01 - 800-01 (testcase)">Biaya Adm Bank - 800-01 - 800-01
                                    (testcase)</option>
                                <option value="Ak. Penyusutan Gedung - 192-01">Ak. Penyusutan Gedung - 192-01</option>
                            </select>
                            <div id="errItemAccountGroup" class="text-danger ">The Account field is required</div>
                        </div>
                        <div class="mb-3">
                            <label for="note" class="form-label fw-bold">Note</label>
                            <textarea class="form-control" id="note" placeholder="Note"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Back</button>
                        <button type="button" id="save" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </div>
        </div>
        <!--End Modal Tambah-->

        <!-- Modal Edit-->
        <div class="modal fade" id="modalEditTransaksi" tabindex="-1" aria-labelledby="modalEditTransaksiLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="modalEditTransaksiLabel">Edit Transaksi</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        {{-- <div class="mb-3">
                            <label for="company" class="form-label fw-bold">Company</label>
                            <input type="text" class="form-control" id="company" value="testcase" disabled>
                        </div> --}}
                        <div class="mb-3">
                            <label for="code" class="form-label fw-bold">Code</label>
                            <input type="text" class="form-control" id="codeEditTransaksi" value="" required>
                            <div id="errcodeEditTransaksi" class="text-danger ">The Account field is required</div>
                        </div>
                        <div class="mb-3">
                            <label for="date" class="form-label fw-bold">Date</label>
                            <input type="date" class="form-control" id="dateEditTransaksi" value="" required>
                            <div id="errdateEditTransaksi" class="text-danger ">The Account field is required</div>
                        </div>
                        {{-- <div class="mb-3">
                            <label for="account" class="form-label fw-bold">Account</label>
                            <select class="form-select" id="account" required>
                                <option value="" selected disabled>Please select account</option>
                                <option value="Biaya Adm Bank - 800-01 - 800-01 (testcase)">Biaya Adm Bank - 800-01 -
                                    800-01
                                    (testcase)</option>
                                <option value="Ak. Penyusutan Gedung - 192-01">Ak. Penyusutan Gedung - 192-01</option>
                            </select>
                            <div id="errItemAccountGroup" class="text-danger ">The Account field is required</div>
                        </div> --}}
                        <div class="mb-3">
                            <label for="note" class="form-label fw-bold">Note</label>
                            <textarea class="form-control" id="noteEditTransaksi" placeholder="Note"></textarea>
                            {{-- <div id="errnoteEditTransaksi" class="text-danger ">The Account field is required</div> --}}
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Back</button>
                        <button type="button" id="saveEditTransaksi" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </div>
        </div>
        <!--End Modal Edit-->

        <div class="row mb-2">
            <div class="col d-flex">
                <input id="txSearch" type="text" style="width: 250px; min-width: 250px;"
                    class="form-control rounded-3" placeholder="Search">
            </div>
            <div class="col d-flex justify-content-end">
                <button type="button" id="btnTambahTransaksi" class="btn btn-primary">Add New</button>
            </div>
        </div>
        <div class="containerTableTransaksi">
            <div class="table-responsive">
                <table id="tableTransaksi" class="table table-hover w-100">
                    <thead>
                        <tr class="table-primary">
                            <th scope="col">No.</th>
                            <th scope="col">Company</th>
                            <th scope="col">Code</th>
                            <th scope="col">Date</th>
                            <th scope="col">Account</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- <tr >
                        <td>
                            <a class="btn btnDetailAttendance" data-bs-toggle="modal">
                                <img src="{{ asset('icons/delete.svg') }}"></a>
                            <a class="btn btnEditAttendance" data-bs-toggle="modal">
                                <img src="{{ asset('icons/Edit.svg') }}">
                            </a>
                        </td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                    </tr> --}}
                    </tbody>
                </table>
            </div>
        </div>

    </div>



@endsection

@section('script')
    <script>
        $(document).ready(function() {
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            const loadSpin = `
        <div id="loading-spinner" class="d-flex justify-content-center align-items-center mt-5">
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>`;

            function fetchDataTransaksi() {
                // Append spinner to the container
                $('.containerTableTransaksi').append(loadSpin);
                $('#tableTransaksi tbody').hide();

                $.ajax({
                    url: "{{ route('listtransaksi') }}",
                    type: 'GET',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                    },
                    success: function(data) {
                        console.log(data);

                        var table2;
                        if ($.fn.DataTable.isDataTable('#tableTransaksi')) {
                            table2 = $('#tableTransaksi').DataTable();
                        } else {
                            table2 = $('#tableTransaksi').DataTable({
                                lengthChange: false,
                                "bSort": true,
                                "aaSorting": [],
                                pageLength: 5,
                                responsive: true,
                                language: {
                                    search: ""
                                }
                            });

                            $('#txSearch').on('keyup', function() {
                                table2.search(this.value).draw();
                            });
                        }

                        $('#loading-spinner').remove();
                        $('#tableTransaksi tbody').show();
                        table2.clear().draw();

                        data.data.forEach(function(item) {
                            let oidTransaksi = item.Oid;
                            let numberTransaksi = item.RowCountNumber || '-';
                            let companyTransaksi = item.CompanyName || '-';
                            let codeTransaksi = item.Code || '-';
                            let dateTransaksi = item.Date || '-';
                            let accountTransaksi = item.AccountName || '-';
                            let statusTransaksi = item.StatusName || '-';

                            table2.row.add([
                                numberTransaksi,
                                companyTransaksi,
                                codeTransaksi,
                                dateTransaksi,
                                accountTransaksi,
                                statusTransaksi,
                                `<a class="btn btnDetailTransaksi" data-oid="${oidTransaksi}" data-bs-toggle="modal">
                                <img src="{{ asset('icons/detail.svg') }}">
                            </a>
                            <a class="btn btnDeletTransaksi" data-oid="${oidTransaksi}" data-bs-toggle="modal">
                                <img src="{{ asset('icons/delete.svg') }}">
                            </a>
                            <a class="btn btnEditTransaksi" data-oid="${oidTransaksi}" data-codetransaksi="${codeTransaksi}" data-datetransaksi="${dateTransaksi}" data-bs-toggle="modal">
                                <img src="{{ asset('icons/Edit.svg') }}">
                            </a>`
                            ]).draw(false);
                        });
                    },
                    error: function(xhr) {
                        console.error('Error fetching data', xhr);
                        $('#loading-spinner').remove();
                    }
                });
            }

            fetchDataTransaksi();

            $('#btnTambahTransaksi').on('click', function() {
                function validasiTransaksi() {
                    let isValid1 = true;
                    // Check itemGroup
                    if ($('#account').val() === null) {
                        $('#errItemAccountGroup').removeClass('d-none');
                        isValid1 = false;
                    } else {
                        $('#errItemAccountGroup').addClass('d-none');
                    }
                    return isValid1;
                }

                $('#account').on('change keyup', function() {
                    validasiTransaksi();
                });

                $('#save').click(function() {
                    if (validasiTransaksi()) {
                        Swal.fire({
                            title: "Do you want to save the New Transaction?",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Yes',
                            reverseButtons: true
                        }).then((result) => {
                            if (result.isConfirmed) {
                                let formData = new FormData();
                                formData.append('company', $('#company').val());
                                formData.append('code', $('#code').val());
                                formData.append('date', $('#date').val());
                                formData.append('account', $('#account').val());
                                formData.append('note', $('#note').val());

                                var csrfToken = $('meta[name="csrf-token"]').attr(
                                    'content');

                                Swal.fire({
                                    title: 'Saving...',
                                    text: 'Please wait while we Save your data.',
                                    allowOutsideClick: false,
                                    didOpen: () => {
                                        Swal.showLoading();
                                    }
                                });

                                $.ajax({
                                    type: "POST",
                                    url: "{{ route('addtransaksi') }}",
                                    headers: {
                                        'X-CSRF-TOKEN': csrfToken
                                    },
                                    data: formData,
                                    processData: false,
                                    contentType: false,
                                    success: function(response) {
                                        Swal.fire({
                                            title: 'Transaksi Save Successfully',
                                            icon: 'success',
                                        });
                                        $('#modalTambahTransaksi').modal(
                                            'hide');
                                        fetchDataTransaksi();
                                    },
                                    error: function() {
                                        Swal.fire({
                                            title: 'An error occurred!',
                                            icon: 'error',
                                        });
                                    }
                                });
                            }
                        });
                    }

                });
                $('#modalTambahTransaksi').modal('show');
            });

            // Event delegation for dynamically added elements
            $(document).on('click', '.btnDeletTransaksi', function() {
                let id = $(this).data('oid');
                console.log('Delete ID:', id);

                Swal.fire({
                    title: "Apakah Kamu Yakin?",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#5D87FF',
                    cancelButtonColor: '#49BEFF',
                    confirmButtonText: 'Ya',
                    cancelButtonText: 'Tidak',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({
                                    title: 'Deleting...',
                                    text: 'Please wait while we Delete your data.',
                                    allowOutsideClick: false,
                                    didOpen: () => {
                                        Swal.showLoading();
                                    }
                                });
                        $.ajax({
                            type: "GET",
                            url: "{{ route('deletetransaksi') }}",
                            data: {
                                id: id,
                            },
                            success: function(response) {
                                if (response.status === 204) {
                                    Swal.fire({
                                        title: "Berhasil Menghapus Transaksi",
                                        icon: "success"
                                    });
                                    fetchDataTransaksi();
                                } else {
                                    Swal.fire({
                                        title: "Gagal Menghapus Transaksi",
                                        icon: "error"
                                    });
                                }
                            },
                            error: function(xhr) {
                                Swal.fire({
                                    title: "Gagal Menghapus Transaksi",
                                    icon: "error"
                                });
                            }
                        });
                    }
                });
            });


            $(document).on('click', '.btnEditTransaksi', function() {
                let id = $(this).data('oid');
                let codeValue = $(this).data('codetransaksi');
                let dateValue = $(this).data('datetransaksi');

                $('#codeEditTransaksi').val(codeValue);
                $('#dateEditTransaksi').val(dateValue);

                console.log('Edit ID:', id);
                $('#modalEditTransaksi').modal('show');

                function validasiTransaksiEdit() {
                    let isValid = true;

                    if ($('#codeEditTransaksi').val().trim() === '') {
                        $('#errcodeEditTransaksi').removeClass('d-none');
                        isValid = false;
                    } else {
                        $('#errcodeEditTransaksi').addClass('d-none');
                    }

                    if ($('#dateEditTransaksi').val().trim() === '') {
                        $('#errdateEditTransaksi').removeClass('d-none');
                        isValid = false;
                    } else {
                        $('#errdateEditTransaksi').addClass('d-none');
                    }

                    return isValid;
                }

                validasiTransaksiEdit();

                $('#codeEditTransaksi, #dateEditTransaksi').on('change keyup',
                    function() {
                        validasiTransaksiEdit();
                    });

                // Event listener untuk tombol save pada modal edit
                $('#saveEditTransaksi').click(function() {
                    if (validasiTransaksiEdit()) {


                        // Lakukan aksi penyimpanan data di sini
                        Swal.fire({
                            title: "Apakah Kamu Yakin?",
                            icon: 'question',
                            showCancelButton: true,
                            confirmButtonColor: '#5D87FF',
                            cancelButtonColor: '#49BEFF',
                            confirmButtonText: 'Ya',
                            cancelButtonText: 'Tidak',
                            reverseButtons: true
                        }).then((result) => {
                            if (result.isConfirmed) {
                                Swal.fire({
                                    title: 'Updating...',
                                    text: 'Please wait while we update your data.',
                                    allowOutsideClick: false,
                                    didOpen: () => {
                                        Swal.showLoading();
                                    }
                                });

                                $.ajax({
                                    type: "POST",
                                    headers: {
                                        'X-CSRF-TOKEN': csrfToken,
                                    },
                                    url: "{{ route('updatetransaksi') }}",
                                    data: {
                                        id: id,
                                        code: $('#codeEditTransaksi').val(),
                                        date: $('#dateEditTransaksi').val(),
                                        note: $('#noteEditTransaksi').val(),
                                    },
                                    success: function(response) {
                                        if (response.status === 'success') {
                                            Swal.fire({
                                                title: "Berhasil Mengedit Transaksi",
                                                icon: "success"
                                            });
                                            $('#modalEditTransaksi').modal(
                                                'hide');
                                            fetchDataTransaksi
                                                (); // Fungsi untuk refresh data transaksi
                                        } else {
                                            Swal.fire({
                                                title: "Gagal Mengedit Transaksi",
                                                text: response.error ||
                                                    'Terjadi kesalahan saat mengedit transaksi.',
                                                icon: "error"
                                            });
                                        }
                                    },
                                    error: function() {
                                        Swal.fire({
                                            title: "Terjadi Kesalahan",
                                            text: "Gagal menghubungi server. Silakan coba lagi nanti.",
                                            icon: "error"
                                        });
                                    }
                                });
                            }
                        });
                    }
                });

                $(document).on('click', '.btnDetailTransaksi', function() {
                    let id = $(this).data('oid');
                    console.log('Detail ID:', id);
                });
            });
        })
    </script>

@endsection
