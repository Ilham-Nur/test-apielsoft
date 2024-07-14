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
        <div class="row mb-2">
            <div class="col d-flex">
                <input id="txSearch" type="text" style="width: 250px; min-width: 250px;" class="form-control rounded-3" placeholder="Search">
            </div>
            <div class="col d-flex justify-content-end">
                <button type="button" id="btnTambahDataManual" class="btn btn-primary">Add Product</button>
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
                        var table2 = $('#tableTransaksi').DataTable({
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
                                `<a class="btn btnDeletProduct" data-bs-toggle="modal">
                                <img src="{{ asset('icons/detail.svg') }}">
                            </a>
                            <a class="btn btnDeletProduct" data-bs-toggle="modal">
                                <img src="{{ asset('icons/delete.svg') }}">
                            </a>
                            <a class="btn btnEditAttendance" data-bs-toggle="modal">
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
        });
    </script>


@endsection
