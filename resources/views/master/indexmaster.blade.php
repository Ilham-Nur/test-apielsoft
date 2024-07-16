@extends('layout.header')

@section('title', 'Master')

@section('main')
    <style>
        #data-list_filter {
            display: none;
        }
    </style>

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
                                    <input type="text" class="form-control" id="company" value="testcase" disabled>
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
                                    <input type="text" class="form-control" id="itemType" value="Product" disabled>
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

        <!-- Modal Edit-->
        <div class="modal fade" id="modalEditProduct" tabindex="-1" aria-labelledby="modalEditProductLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="modalEditProductLabel">Edit Product</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mt-3">
                                    <label for="company" class="form-label fw-bold">Company</label>
                                    <input type="text" class="form-control" id="companyEdit" value="testcase"
                                        disabled>
                                </div>
                                <div class="mt-3">
                                    <label for="code" class="form-label fw-bold">Code</label>
                                    <input type="text" class="form-control" id="codeEdit" value="<<Auto>>" required>
                                </div>
                                <div class="mt-3">
                                    <label for="itemGroup" class="form-label fw-bold">Item Group</label>
                                    <select class="form-select" id="itemGroupEdit" required>
                                        <option value="" disabled>Select Item Group</option>
                                        <option value="PRODUCT LAIN - LAIN">PRODUCT LAIN - LAIN</option>
                                        <option value="SERVICE LAIN - LAIN">SERVICE LAIN - LAIN</option>
                                    </select>
                                    <div id="errItemGroupEdit" class="text-danger ">Please select Item Group!</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mt-3">
                                    <label for="itemType" class="form-label fw-bold">Item Type</label>
                                    <input type="text" class="form-control" id="itemTypeEdit" value="Product"
                                        disabled>
                                </div>
                                <div class="mt-3">
                                    <label for="title" class="form-label fw-bold">Title</label>
                                    <input type="text" class="form-control" id="titleEdit" value=""
                                        placeholder="Tittle" required>
                                    <div id="errTitleEdit" class="text-danger ">The Title field is required!</div>
                                </div>
                                <div class="mt-3">
                                    <label for="itemAccountGroup" class="form-label fw-bold">Item Account Group</label>
                                    <select class="form-select" id="itemAccountGroupEdit" required>
                                        <option value="" disabled>Select Account Group</option>
                                        <option value="DEFAULT - DEF (TESTCASE)">DEFAULT - DEF (TESTCASE)</option>
                                    </select>
                                    <div id="errItemAccountGroupEdit" class="text-danger ">Please select Item Account
                                        Group!</div>
                                </div>
                            </div>
                            <div class="mt-3">
                                <label for="itemUnit" class="form-label fw-bold">Item Unit</label>
                                <select class="form-select" id="itemUnitEdit" required>
                                    <option value="" disabled>Select Unit</option>
                                    <option value="PCS">PCS</option>
                                </select>
                                <div id="errItemUnitEdit" class="text-danger">Please select Item Unit!</div>
                            </div>
                            <div class="mt-3 ms-4 form-check">
                                <input type="checkbox" class="form-check-input" id="isActiveEdit">
                                <label for="isActive" class="form-check-label">Is Active</label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Back</button>
                        <button type="button" id="saveProductEdit" class="btn btn-primary">Save</button>
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
                // Append spinner to the container
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

                        var table;
                        if ($.fn.DataTable.isDataTable('#data-list')) {
                            table = $('#data-list').DataTable();
                        } else {
                            table = $('#data-list').DataTable({
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
                                table.search(this.value).draw();
                            });
                        }

                        $('#loading-spinner').remove();
                        $('#data-list tbody').show();
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
                                `<a class="btn btnDeletProduct" data-oid="${oid}" data-bs-toggle="modal">
                        <img src="{{ asset('icons/delete.svg') }}">
                    </a>
                    <a class="btn btnEditProduct" data-oid="${oid}" data-title="${title}" data-company="${company}" data-code="${code}" data-itemGroup="${itemGroup}" data-isActive="${isActive}" data-balance="${balance}" data-bs-toggle="modal">
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

            fetchDataProduct();

        $(document).on('click', '#btnTambahDataManual', function(e) {
            e.preventDefault();
          
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
                                        $('#modalTambahHarian').modal('hide');
                                        fetchDataProduct();
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
                $('#modalTambahHarian').modal('show');
            });

        });

        $(document).on('click', '.btnDeletProduct', function(e) {
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
                        url: "{{ route('deleteproduct') }}",
                        data: {
                            id: id,
                        },
                        success: function(response) {
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

        $(document).on('click', '.btnEditProduct', function(e) {
            let id = $(this).data('oid');
            let titleEdit = $(this).data('title');
            let companyEdit = $(this).data('company');
            let codeEdit = $(this).data('code');
            let itemGroupEdit = $(this).data('itemgroup');
            let isActiveEdit = $(this).data('isactive');
            let balanceEdit = $(this).data('balance');
            console.log('Item Group:', itemGroupEdit);

            $('#titleEdit').val(titleEdit);
            $('#companyEdit').val(companyEdit);
            $('#codeEdit').val(codeEdit);
            $('#itemGroupEdit').val(itemGroupEdit);
            $('#balanceEdit').val(balanceEdit);

            if (isActiveEdit === 'Yes') {
                $('#isActiveEdit').prop('checked', true);
            } else {
                $('#isActiveEdit').prop('checked', false);
            }

            function validateInputEdit() {
                let isValidEdit = true;

                // Check itemGroup
                if ($('#itemGroupEdit').val() === null) {
                    $('#errItemGroupEdit').removeClass('d-none');
                    isValidEdit = false;
                } else {
                    $('#errItemGroupEdit').addClass('d-none');
                }

                // Check title
                if ($('#titleEdit').val().trim() === '') {
                    $('#errTitleEdit').removeClass('d-none');
                    isValidEdit = false;
                } else {
                    $('#errTitleEdit').addClass('d-none');
                }

                // Check itemAccountGroup
                if ($('#itemAccountGroupEdit').val() === null) {
                    $('#errItemAccountGroupEdit').removeClass('d-none');
                    isValidEdit = false;
                } else {
                    $('#errItemAccountGroupEdit').addClass('d-none');
                }

                // Check itemUnit
                if ($('#itemUnitEdit').val() === null) {
                    $('#errItemUnitEdit').removeClass('d-none');
                    isValidEdit = false;
                } else {
                    $('#errItemUnitEdit').addClass('d-none');
                }

                return isValidEdit;
            }
            validateInputEdit();

            // Attach event handlers to inputs and selects
            $('#itemGroupEdit, #titleEdit, #itemAccountGroupEdit, #itemUnitEdit').on('change keyup', function() {
                validateInputEdit();
            });

            // Save button click event
            $('#saveProductEdit').on('click', function() {
                if (validateInputEdit()) {
                    Swal.fire({
                        title: "Do you want to update the product?",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes',
                        reverseButtons: true
                    }).then((result) => {
                        if (result.isConfirmed) {
                            let formData = new FormData();
                            formData.append('id', id);
                            formData.append('company', $('#companyEdit').val());
                            formData.append('company', $('#companyEdit').val());
                            formData.append('code', $('#codeEdit').val());
                            formData.append('itemGroup', $('#itemGroupEdit').val());
                            formData.append('itemType', $('#itemTypeEdit').val());
                            formData.append('title', $('#titleEdit').val());
                            formData.append('itemAccountGroup', $('#itemAccountGroupEdit').val());
                            formData.append('itemUnit', $('#itemUnitEdit').val());
                            formData.append('isActive', $('#isActiveEdit').is(':checked') ? 1 : 0);

                            var csrfToken = $('meta[name="csrf-token"]').attr('content');

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
                                url: "{{ route('updateproduct') }}",
                                headers: {
                                    'X-CSRF-TOKEN': csrfToken
                                },
                                data: formData,
                                processData: false,
                                contentType: false,
                                success: function(response) {
                                    Swal.fire({
                                        title: 'Product Updated Successfully',
                                        icon: 'success',
                                    });
                                    $('#modalEditProduct').modal('hide');
                                    fetchDataProduct();
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

            $('#modalEditProduct').modal('show');
        });
    </script>





@endsection
