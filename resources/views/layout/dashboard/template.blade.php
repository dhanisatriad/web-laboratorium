<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Laboratorium - Dashboard</title>

    {{-- bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
    {{-- style --}}
    <link href="/css/styles.css" rel="stylesheet" />

    {{-- table --}}
    <link rel="stylesheet" href="https://unpkg.com/bootstrap-table@1.21.1/dist/bootstrap-table.min.css">
    {{-- table --}}

    {{-- jquery --}}
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"
        integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    {{-- <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/typeahead.js/0.11.1/typeahead.bundle.min.js" integrity="sha512-qOBWNAMfkz+vXXgbh0Wz7qYSLZp6c14R0bZeVX2TdQxWpuKr6yHjBIM69fcF8Ve4GUX6B6AKRQJqiiAmwvmUmQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> --}}
    {{-- jquery --}}

    {{-- font --}}
    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
    {{-- font --}}

    <script type="text/javascript" src="/js/jquery.alphanum.js"></script>

    {{-- scanner --}}
    <script src="https://rawgit.com/sitepoint-editors/jsqrcode/master/src/qr_packed.js"></script>
    {{-- scanner --}}

    {{-- trix editor --}}
    <link rel="stylesheet" type="text/css" href="/css/trix.css">
    <script type="text/javascript" src="/js/trix.js"></script>
    {{-- trix editor --}}

    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <style>
        trix-toolbar [data-trix-button-group="file-tools"] {
            display: none;
        }

        .hid-text {
            display: none;
        }

        .show-hid:hover .hid-text {
            display: inline-block;
            animation: fade-in 500ms;
        }

        .search:focus {
            display: inline-block;
            animation: fade-in 500ms;
        }

        .hid-text.did-fade-in {
            display: inline-block;
            animation: fade-out 3s;
        }

        #layoutSidenav_content {
            background-color: #d3eaf2
        }

        @keyframes fade-in {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        @keyframes fade-out {
            from {

            }

            to {

            }
        }





        /* .fit-image {
            width: 200px;
            object-fit: cover;
            height: 200px;
        } */
    </style>

</head>

@include('layout/dashboard/dashboard_nav')
@include('layout/dashboard/sidebar')
@yield('contents')
</div>

{{-- table --}}
{{-- <script src="https://unpkg.com/bootstrap-table@1.21.1/dist/bootstrap-table.min.js"></script> --}}
{{-- table --}}
<script src="/js/scripts.js"></script>


</body>

</html>
