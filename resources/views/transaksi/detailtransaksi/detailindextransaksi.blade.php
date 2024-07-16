@extends('layout.header')

@section('title', 'Detail Transaksi')

@section('main')
    <style>
        #tableTransaksi_filter {
            display: none;
        }
    </style>

    <div class="container-fluid">
        <a href="{{ route('transaksi') }}" class="btn btn-primary">Back</a>

        <div>
            <h3 class="mt-3 fw-bold">Detail Transaksi : <span id="isiCode">-</span></h3>
        </div>



        <!-- Modal Tambah-->
        <div class="modal fade" id="modalTambahDetailTransaksi" tabindex="-1" aria-labelledby="modalTambahDetailTransaksiLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="modalTambahDetailTransaksiLabel">Create New</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="ItemDetailAdd" class="form-label fw-bold">Item</label>
                            <input type="text" class="form-control" id="ItemDetailAdd" value="
Item A DELETE 240511EHDLo - DEL-213144-0511Yj">
                            <div id="errItemDetailAdd" class="text-danger d-none">The Item field is required</div>
                        </div>
                        <div class="mb-3">
                            <label for="quantityDetailAdd" class="form-label fw-bold">Quantity</label>
                            <input type="text" class="form-control" id="quantityDetailAdd" value="" required>
                            <div id="errQuantityDetailAdd" class="text-danger d-none">The Quantity field is required</div>
                        </div>
                        <div class="mb-3">
                            <label for="itemUnitDetailAdd" class="form-label fw-bold">Item Unit</label>
                            <select class="form-select" id="itemUnitDetailAdd" required>
                                <option value="" selected disabled>Please select account</option>
                                <option value="PCS">PCS</option>
                            </select>
                            <div id="errItemUnitDetailAdd" class="text-danger d-none">The Item Unit field is required</div>
                        </div>
                        <div class="mb-3">
                            <label for="noteDetailAdd" class="form-label fw-bold">Note</label>
                            <textarea class="form-control" id="noteDetailAdd" placeholder="Note"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Back</button>
                        <button type="button" id="saveDetail" class="btn btn-primary">Save</button>
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
                <button type="button" id="btnCreateDetail" class="btn btn-primary">Add New</button>
            </div>
        </div>
        <div class="containerTableTransaksi">
            <div class="table-responsive">
                <table id="tableTransaksi" class="table table-hover w-100">
                    <thead>
                        <tr class="table-primary">
                            <th scope="col">Item</th>
                            <th scope="col">Quentity</th>
                            <th scope="col">Item Unit</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>
                                <a class="btn btnDetailAttendance" data-bs-toggle="modal">
                                    <img src="{{ asset('icons/delete.svg') }}"></a>
                                <a class="btn btnEditAttendance" data-bs-toggle="modal">
                                    <img src="{{ asset('icons/Edit.svg') }}">
                                </a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </div>



@endsection

@section('script')
    <script>
        function getQueryParams() {
            let params = {};
            window.location.search.substring(1).split("&").forEach(function(param) {
                let pair = param.split("=");
                params[decodeURIComponent(pair[0])] = decodeURIComponent(pair[1]);
            });
            return params;
        }

        let queryParams = getQueryParams();
        let oid = queryParams['id'];
        let codevalue = queryParams['codevalue'];

        $('#isiCode').text(codevalue);
    </script>

    <script>
        $(document).on('click', '#btnCreateDetail', function() {
            $('#modalTambahDetailTransaksi').modal('show');


            $('#quantityDetailAdd').on('input', function() {
                this.value = this.value.replace(/[^0-9]/g, '');
            });

            function validasiDetailTransaksi() {
                let isValid1 = true;

                // Check Item
                if ($('#ItemDetailAdd').val().trim() === "") {
                    $('#errItemDetailAdd').removeClass('d-none');
                    isValid1 = false;
                } else {
                    $('#errItemDetailAdd').addClass('d-none');
                }

                // Check Quantity
                if ($('#quantityDetailAdd').val().trim() === "") {
                    $('#errQuantityDetailAdd').removeClass('d-none');
                    isValid1 = false;
                } else {
                    $('#errQuantityDetailAdd').addClass('d-none');
                }

                // Check Item Unit
                if ($('#itemUnitDetailAdd').val() === null || $('#itemUnitDetailAdd').val() === "") {
                    $('#errItemUnitDetailAdd').removeClass('d-none');
                    isValid1 = false;
                } else {
                    $('#errItemUnitDetailAdd').addClass('d-none');
                }

                return isValid1;
            }
            validasiDetailTransaksi();

            $('#ItemDetailAdd, #quantityDetailAdd, #itemUnitDetailAdd').on('change keyup', function() {
                validasiDetailTransaksi();
            });

            $('#saveDetail').click(function() {
                if (validasiDetailTransaksi()) {
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
                            formData.append('oid', oid);
                            formData.append('Item', $('#ItemDetailAdd').val());
                            formData.append('quantity', $('#quantityDetailAdd').val());
                            formData.append('itemUnit', $('#itemUnitDetailAdd').val());
                            formData.append('note', $('#noteDetailAdd').val());

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
                                url: "{{ route('detailtransaksiadd') }}",
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
        });
    </script>
@endsection
