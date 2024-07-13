@extends('layout.header')

@section('title', 'Master')

@section('main')


    <div class="container-fluid">
        <div>
            <h3 class=" mt-3 fw-bold">Master Item</h3>
        </div>

        <!-- Modal Tambah-->
        <div class="modal fade" id="modalTambahHarian" tabindex="-1" aria-labelledby="modalTambahHarianLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="modalTambahHarianLabel">Add Product</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mt-3">
                                    <label for="company" class="form-label fw-bold">Company</label>
                                    <input type="text" class="form-control" id="company" value="testcase" required>
                                </div>
                                <div class="mt-3">
                                    <label for="code" class="form-label fw-bold">Code</label>
                                    <input type="text" class="form-control" id="code" value="<<Auto>>" required>
                                </div>
                                <div class="mt-3">
                                    <label for="itemGroup" class="form-label fw-bold">Item Group</label>
                                    <select class="form-select" id="itemGroup" required>
                                        <option value="" selected disabled>Select Item Group</option>
                                        <option value="PRODUCT LAIN - LAIN - P1">PRODUCT LAIN - LAIN - P1</option>
                                    </select>
                                    <div id="errItemGroup" class="text-danger ">Please select Item Group!</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mt-3">
                                    <label for="itemType" class="form-label fw-bold">Item Type</label>
                                    <input type="text" class="form-control" id="itemType" value="Product" required>
                                </div>
                                <div class="mt-3">
                                    <label for="title" class="form-label fw-bold">Title</label>
                                    <input type="text" class="form-control" id="title" value=""
                                        placeholder="Tittle" required>
                                    <div id="errTitle" class="text-danger ">The Title field is required!</div>
                                </div>
                                <div class="mt-3">
                                    <label for="itemAccountGroup" class="form-label fw-bold">Item Account Group</label>
                                    <select class="form-select" id="itemAccountGroup" required>
                                        <option value="" selected disabled>Select Account Group</option>
                                        <option value="DEFAULT - DEF (TESTCASE)">DEFAULT - DEF (TESTCASE)</option>
                                    </select>
                                    <div id="errItemAccountGroup" class="text-danger ">Please select Item Account
                                        Group!</div>
                                </div>
                            </div>
                            <div class="mt-3">
                                <label for="itemUnit" class="form-label fw-bold">Item Unit</label>
                                <select class="form-select" id="itemUnit" required>
                                    <option value="" selected disabled>Select Unit</option>
                                    <option value="PCS">PCS</option>
                                </select>
                                <div id="errItemUnit" class="text-danger">Please select Item Unit!</div>
                            </div>
                            <div class="mt-3 ms-4 form-check">
                                <input type="checkbox" class="form-check-input" id="isActive" checked>
                                <label for="isActive" class="form-check-label">Is Active</label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Back</button>
                        <button type="button" id="saveProduct" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </div>
        </div>
        <!--End Modal Tambah-->

        <div class="d-flex float-end mb-2">
            <div class="d-flex gap-1 ">
                <button type="button" id="btnTambahDataManual" class="btn btn-primary">Add Product</button>
            </div>
        </div>
        <div class="containerdatalist mt-1">
            <table id="data-list" class="table table-responsive table-hover">
                <thead>
                    <tr class="table-primary">
                        <th scope="col">Tittle</th>
                        <th scope="col">Company</th>
                        <th scope="col">Code</th>
                        <th scope="col">ItemGrup</th>
                        <th scope="col">Is Active</th>
                        <th scope="col">Balance</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- <tr >
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>
                            <a class="btn btnDetailAttendance" data-bs-toggle="modal">
                                <img src="{{ asset('icons/delete.svg') }}"></a>
                            <a class="btn btnEditAttendance" data-bs-toggle="modal"> <img
                                    src="{{ asset('icons/Edit.svg') }}"></a>
        
                        </td>
                    </tr> --}}
                </tbody>
            </table>
        </div>
    </div>

@endsection

@section('script')
    <script>
        const loadSpin = `<div id="loading-spinner" class="d-flex justify-content-center align-items-center mt-5">
        <div class="spinner-border d-flex justify-content-center align-items-center text-primary" role="status"><span class="visually-hidden">Loading...</span></div>
    </div>`;

        $(document).ready(function() {
            var csrfToken = $('meta[name="csrf-token"]').attr('content');

            function fetchDataProduct() {
                $('.containerdatalist').append(loadSpin);
                $('#data-list tbody').hide();

                $.ajax({
                    url: "{{ route('list') }}",
                    type: 'GET',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                    },
                    success: function(data) {
                        console.log(data.data);
                        var table = $('#data-list').DataTable({
                            searching: false,
                            lengthChange: false,
                            "bSort": true,
                            "aaSorting": [],
                            pageLength: 5,
                            responsive: true,
                            language: {
                                search: ""
                            }
                        });

                        $('#loading-spinner').remove();

                        table.clear().draw();

                        data.data.forEach(function(item) {
                            let oid = item.Oid;
                            let title = item.ListFormat.Title || '-';
                            let company = item.CompanyName || '-';
                            let code = item.Code || '-';
                            let itemGroup = item.ItemGroupName || '-';
                            let isActive = item.IsActive ? 'Yes' : 'No';
                            let balance = item.BalanceAmount || '-';

                            table.row.add([
                                title,
                                company,
                                code,
                                itemGroup,
                                isActive,
                                balance,
                                `<a class="btn btnDeletProduct"  data-oid="${oid}" data-bs-toggle="modal">
                                <img src="{{ asset('icons/delete.svg') }}">
                            </a>
                            <a class="btn btnEditAttendance"  data-oid="${oid}" data-bs-toggle="modal">
                                <img src="{{ asset('icons/Edit.svg') }}">
                            </a>`
                            ]).draw(false);
                        });

                        $('#data-list tbody').show();
                    },
                    error: function(xhr) {
                        console.error('Error fetching data', xhr);
                        $('#loading-spinner').remove();
                    }
                });
            }
            fetchDataProduct();
        });
    </script>
    <script>
        $(document).on('click', '#btnTambahDataManual', function(e) {
            e.preventDefault();

            $(document).ready(function() {
                function validateInput() {
                    let isValid = true;

                    // Check itemGroup
                    if ($('#itemGroup').val() === null) {
                        $('#errItemGroup').removeClass('d-none');
                        isValid = false;
                    } else {
                        $('#errItemGroup').addClass('d-none');
                    }

                    // Check title
                    if ($('#title').val().trim() === '') {
                        $('#errTitle').removeClass('d-none');
                        isValid = false;
                    } else {
                        $('#errTitle').addClass('d-none');
                    }

                    // Check itemAccountGroup
                    if ($('#itemAccountGroup').val() === null) {
                        $('#errItemAccountGroup').removeClass('d-none');
                        isValid = false;
                    } else {
                        $('#errItemAccountGroup').addClass('d-none');
                    }

                    // Check itemUnit
                    if ($('#itemUnit').val() === null) {
                        $('#errItemUnit').removeClass('d-none');
                        isValid = false;
                    } else {
                        $('#errItemUnit').addClass('d-none');
                    }

                    return isValid;
                }

                // Attach event handlers to inputs and selects
                $('#itemGroup, #title, #itemAccountGroup, #itemUnit').on('change keyup', function() {
                    validateInput();
                });

                // Validate form on save button click
                $('#saveProduct').on('click', function() {
                    if (validateInput()) {
                        Swal.fire({
                            title: "Do you want to Add Product?",
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
                                formData.append('itemGroup', $('#itemGroup').val());
                                formData.append('itemType', $('#itemType').val());
                                formData.append('title', $('#title').val());
                                formData.append('itemAccountGroup', $('#itemAccountGroup')
                                    .val());
                                formData.append('itemUnit', $('#itemUnit').val());
                                formData.append('isActive', $('#isActive').is(':checked') ?
                                    1 : 0);

                                var csrfToken = $('meta[name="csrf-token"]').attr(
                                    'content');

                                Swal.fire({
                                    title: 'Saving...',
                                    text: 'Please wait while we save your data.',
                                    allowOutsideClick: false,
                                    didOpen: () => {
                                        Swal.showLoading();
                                    }
                                });

                                $.ajax({
                                    type: "POST",
                                    url: "{{ route('addproduct') }}",
                                    headers: {
                                        'X-CSRF-TOKEN': csrfToken
                                    },
                                    data: formData,
                                    processData: false,
                                    contentType: false,
                                    success: function(response) {
                                        Swal.fire({
                                            title: 'Berhasil Menambahkan Product',
                                            icon: 'success',
                                        });
                                    },
                                    error: function() {
                                        Swal.fire({
                                            title: 'Terjadi kesalahan!',
                                            icon: 'error',
                                        });
                                    }
                                });
                            }
                        });
                    }
                });
            });

            $('#modalTambahHarian').modal('show');
        });
    </script>
    <script>
         $(document).on('click', '.btnDeletProduct', function(e){
            let id = $(this).data('oid');

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
                            $.ajax({
                            type: "GET",
                            url: "{{ route('deleteproduct') }}",
                            data: {
                                id : id,
                            },
                            success: function (response) {
                                if (response.status === 'success') {
                                    Swal.fire({
                                        title: "Berhasil Menghapus Product",
                                        icon: "success"
                                    });
                                    fetchDataProduct();
                                } else {
                                    Swal.fire({
                                        title: "Gagal Menghapus Product",
                                        icon: "error"
                                    });
                                }
                            }
                        });
                    }
                })
            });
    </script>



@endsection
