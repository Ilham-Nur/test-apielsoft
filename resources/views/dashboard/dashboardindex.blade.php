@extends('layout.header')

@section('title', 'Home')

@section('main')

<div class="container-fluid">
    <div class="row mt-1">
      <div class="col-lg-4">
        <div class="card" style="background-color: rgb(250, 139, 139);">
          <div class="card-body">
            <div class="row align-items-start">
              <div class="col-8">
                <h5 class="card-title mb-9 fw-semibold">Master Item</h5>
                <h4 class="fw-semibold" id="pengeluaranData">-</h4>
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
      </div>
      <div class="col-lg-4">
        <div class="card" style="background-color: rgb(250, 230, 139);">
          <div class="card-body">
            <div class="row align-items-start">
              <div class="col-8">
                <h5 class="card-title mb-9 fw-semibold">Transaksi Stock</h5>
                <h4 class="fw-semibold"  id="totalTagihanData">-</h4>
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
      </div>
    </div>
  </div>

@endsection

@section('script')


@endsection














