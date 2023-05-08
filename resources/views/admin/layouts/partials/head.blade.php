<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Dashboard Platform Pelatihan- Dinas Perpustakaan dan Kearsipan Kabupaten Madiun</title>
    <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
    <link rel="shortcut icon" href="{{ asset('assets/admin/img/logodinas.png') }}" type="image/x-icon" />
    <link href="https://cdn.datatables.net/1.13.2/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <!-- Fonts and icons /assets/admin/img/logodinas.jpg-->
    <script src="/assets/admin/js/plugin/webfont/webfont.min.js"></script>
    {{-- Data Tables --}}
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" type="text/css" href="/assets/admin/css/profile.css">
    {{-- Trix Editor --}}
    <link rel="stylesheet" type="text/css" href="/assets/admin/css/trix.css">
    <script type="text/javascript" src="/assets/admin/js/trix.js"></script>
    <style>
        trix-toolbar [data-trix-button-group="file-tools"] {
            display: none;
        }
    </style>

    <script>
        WebFont.load({
            google: {
                "families": ["Lato:300,400,700,900"]
            },
            custom: {
                "families": ["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands",
                    "simple-line-icons"
                ],
                urls: ['/assets/admin/css/fonts.min.css']
            },
            active: function() {
                sessionStorage.fonts = true;
            }
        });
    </script>

    <!-- CSS Files -->
    <link rel="stylesheet" href="/assets/admin/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/admin/css/atlantis.min.css">

    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link rel="stylesheet" href="/assets/admin/css/demo.css">
</head>
