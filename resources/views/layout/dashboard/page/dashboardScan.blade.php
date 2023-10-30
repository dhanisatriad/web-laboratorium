@extends('layout.dashboard.template')
@section('contents')
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4 mb-5">
                @if (session()->has('success'))
                    <div class="alert alert-primary alert-dismissible fade show my-3" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                @if ($errors->any())
                    {!! implode(
                        '',
                        $errors->all(' <div class="alert alert-danger my-3 alert-dismissible fade show" role="alert">:message<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                            </div>'),
                    ) !!}
                @endif
                <div class="card my-4  shadow">
                    <div class="card-header text-white bg-primary fs-4">
                        <i class="fas fa-table me-1"></i>
                        Daftar Permohonan
                    </div>
                    <div class="card-body table-responsive">
                        <h1>QR Code Scanner</h1>

                        <a id="btn-scan-qr">
                            <img
                                src="https://dab1nmslvvntp.cloudfront.net/wp-content/uploads/2017/07/1499401426qr_icon.svg">
                        </a>

                        <canvas hidden="" id="qr-canvas"></canvas>

                        <div id="qr-result" hidden="">
                            <b>Data:</b> <span id="outputData"></span>
                        </div>


                        <div class="content">
                            <p>Enter Your Barcode : <input type='text' id="input_scan"></p>
                            <p><button type="button" id="btn_clear_text" class="btn btn-success"
                                    style="margin-left:132px;"><span class="glyphicon glyphicon-remove"></span> Clear
                                    Text</button></p>
                        </div>
                    </div>



                </div>
            </div>
        </main>
    </div>

    <script>
        $(document).ready(function() {
            // $(document).click(function() {
            //     $('#input_scan').val("").focus();
            // });
            // $('#input_scan').val("").focus();
            // $('#input_scan').keyup(function(e) {
            //     var tex = $(this).val();
            //     //   console.log(tex);
            //     if (tex !== "" && e.keyCode === 13) {
            //         var result = confirm("Your Barcode is : " + tex);
            //         if (result) $('#input_scan').focus();
            //     }
            //     e.preventDefault();
            // });
            // $('#btn_clear_text').click(function() {
            //     $('#input_scan').val("").focus();
            // });
        });
    </script>
    <script src="/js/qrCodeScanner.js"></script>
@endsection
