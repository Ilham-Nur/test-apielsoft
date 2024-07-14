@extends('layout.header')

@section('title', 'Home')

@section('main')

    <div class="container-fluid">
        <div class="row mt-1">
            <div class="col-lg-4">
              <a href="{{route('master')}}">
                <div class="card" style="background-color: rgb(250, 139, 139);">
                    <div class="card-body">
                        <div class="row align-items-start">
                            <div class="col-8">
                                <h5 class="card-title mb-9 fw-semibold">Master Item</h5>
                                <h4 class="fw-semibold" id="countMasterData">-</h4>
                                {{-- <div class="d-flex align-items-center pb-1">
                  <span class="me-2 rounded-circle bg-light-danger round-20 d-flex align-items-center justify-content-center">
                    <i class="ti ti-arrow-down-right text-danger"></i>
                  </span>
                  <p class="text-dark me-1 fs-3 mb-0">+9%</p>
                  <p class="fs-3 mb-0">Bulan sebelumnya</p>
                </div> --}}
                            </div>
                        </div>
                    </div>
                </div>
              </a>
            </div>
            <div class="col-lg-4">
              <a href="{{route('transaksi')}}">
                <div class="card" style="background-color: rgb(250, 230, 139);">
                    <div class="card-body">
                        <div class="row align-items-start">
                            <div class="col-8">
                                <h5 class="card-title mb-9 fw-semibold">Transaksi Stock</h5>
                                <h4 class="fw-semibold" id="countTransaksiData">-</h4>
                                {{-- <div class="d-flex align-items-center pb-1">
                  <span class="me-2 rounded-circle bg-light-danger round-20 d-flex align-items-center justify-content-center">
                    <i class="ti ti-arrow-down-right text-danger"></i>
                  </span>
                  <p class="text-dark me-1 fs-3 mb-0">+9%</p>
                  <p class="fs-3 mb-0">Bulan sebelumnya</p>
                </div> --}}
                            </div>
                        </div>
                    </div>
                </div>
              </a>
            </div>
        </div>
    </div>

@endsection

@section('script')
    <script>
        let csrfToken = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            type: "GET",
            url: "{{ route('datalist') }}",
            headers: {
                'X-CSRF-TOKEN': csrfToken,
            },
            success: function(data) {
                console.log(data);
                let countMasterItem = data.item_list.data.length;
                let countTransaksi = data.stock_issue.length;
                $('#countMasterData').text(countMasterItem);
                $('#countTransaksiData').text(countTransaksi);
            },
            error: function(xhr, status, error) {
                console.error('Error:', error);
            }
        });
    </script>

@endsection
