<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Halaman Login</title>
    <!-- icon -->
    <link rel="icon" href="test" type="image/x-icon" />
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.2/css/all.css" />
    <!-- Google Fonts Roboto -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" />
    <!-- MDB -->
    <link rel="stylesheet" href="{{ asset('login/css/bootstrap-login-form.min.css') }}" />

    {{-- listapp --}}
    <link rel="stylesheet" href="{{ asset('css/boxicons.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sweetalert2.css') }}">
    <link rel="stylesheet" href="{{ asset('css/datatables.css') }}">
    <link rel="stylesheet" href="{{ asset('css/flatpickr.css') }}">
    <link rel="stylesheet" href="{{ asset('simplelineicons/css/simple-line-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('css/flatpickr.css') }}">
    <link rel="stylesheet" href="{{ asset('css/monthSelect.css') }}">
    <link rel="stylesheet" href="{{ asset('css/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('css/slick-theme.css') }}">
    <link rel="stylesheet" href="{{ asset('summernote/summernote.css') }}">
    <link rel="stylesheet" href="{{ asset('css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/fixedColumns.dataTables.min.css') }}">
</head>

<body>
    <style>
        .divider:after,
        .divider:before {
            content: "";
            flex: 1;
            height: 1px;
            background: #eee;
        }

        .h-custom {
            height: calc(100% - 73px);
        }

        @media (max-width: 450px) {
            .h-custom {
                height: 100%;
            }
        }
    </style>

    <section class="vh-100">
        <div class="container-fluid h-custom">
            <div class="row text-center p-5">
                {{-- <H2>Sistem Monitoring Keuangan</H2> --}}
                <H2>Programmer Test Case</H2>
            </div>
            <div class="row d-flex justify-content-center align-items-center">
                <div class="col-md-9 col-lg-6 col-xl-5">
                    <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/draw2.webp"
                        class="img-fluid" alt="Sample image">
                </div>
                <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
                    <form>
                        <!-- Username/Badge input -->
                        <div class="form-outline mb-4">
                            <input type="text" id="form3Example3" class="form-control form-control-lg"
                                placeholder="Enter a valid Username" />
                            <label class="form-label" for="form3Example3">Username</label>
                        </div>

                        <!-- Password input -->
                        <div class="form-outline mb-3">
                            <input type="password" id="form3Example4" class="form-control form-control-lg"
                                placeholder="Enter password" />
                            <label class="form-label" for="form3Example4">Password</label>
                        </div>

                        <div class="form-grup">
                            <strong>Google recaptcha :</strong>
                            {!! NoCaptcha::renderJs() !!}
                            {!! NoCaptcha::display(['id' => 'g-recaptcha']) !!}
                        </div>
                        <div class="text-center text-lg-start mt-4 pt-2">
                            <button type="button" class="btn btn-primary btn-lg" id="btnLogin"
                                style="padding-left: 2.5rem; padding-right: 2.5rem;">Login</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
        <div
            class="d-flex flex-column flex-md-row text-center text-md-start justify-content-between py-4 px-4 px-xl-5 bg-primary">
            <!-- Copyright -->
            <div class="text-white mb-3 mb-md-0">
                Copyright © 2024. by Ilham Nur.
            </div>
            <!-- Copyright -->
        </div>
    </section>
    <!-- End your project here-->

    <!-- MDB -->
    <script type="text/javascript" src="{{ asset('login/js/mdb.min.js') }}"></script>
    {{-- listjsapp --}}
    <script type="text/javascript" src="{{ asset('js/jquery.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/sweetalert2.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/app/functions.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/datatables.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/flatpickr.js') }}"></script>
    <script type="text/javascript" src="{{ asset('summernote/summernote.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/apexcharts.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/chart.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/monthSelect.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/slick.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/dataTables.fixedColumns.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/chartjs-plugin-datalabels.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.26/webcam.min.js"
        integrity="sha512-dQIiHSl2hr3NWKKLycPndtpbh5iaHLo6MwrXm7F0FM5e+kL2U16oE9uIwPHUl6fQBeCthiEuV/rzP3MiAB8Vfw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script type="text/javascript" src="{{ asset('js/select2.min.js') }}"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://kit.fontawesome.com/645e1e723c.js" crossorigin="anonymous"></script>
    <script src="{{ asset('js/qrcode.min.js') }}"></script>
    <!-- Custom scripts -->
    <script type="text/javascript">
        $(document).ready(function() {

            $("#btnLogin").click(function(e) {
                e.preventDefault();

                var email = $("#form3Example3").val();
                var password = $("#form3Example4").val();
                var recaptchaResponse = grecaptcha.getResponse();
                const csrfToken = $('meta[name="csrf-token"]').attr('content');

                if (!email) {
                    showMessage("error", "Masukkan Username");
                } else if (!password) {
                    showMessage("error", "Masukkan Password");
                }  else if (!recaptchaResponse) {
                    showMessage("error", "Mohon lengkapi reCAPTCHA!");
                }

                if (!navigator.onLine) {
                    showMessage("error", "Koneksi Internet Error");
                    return;
                }

                if (email && password) {
                    Swal.fire({
                        title: 'Cheking...',
                        text: 'Please wait while we check data.',
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });
                    $.ajax({
                        type: "POST",
                        url: "{{ route('ceklogin') }}",
                        data: {
                            UserName: email,
                            Password: password,
                            'g-recaptcha-response': recaptchaResponse,
                            _token: csrfToken
                        },
                        success: function(response) {
                            if (response.redirect_url) {
                                window.location.href = response.redirect_url;
                            } else {
                                showMessage("error", "Login Gagal");
                            }
                        },
                        error: function(xhr, status, error) {
                            if (xhr.status === 401) {
                                showMessage("error", "Login Gagal");
                            }
                        }
                    });
                }
            });

        });
    </script>
</body>

</html>
