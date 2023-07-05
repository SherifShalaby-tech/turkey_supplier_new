<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="rtl">
    <head>
        @include('Admin.layouts.headcss')
{{--        <link rel="stylesheet" href="sweetalert2.min.css">--}}
        @yield('css')
    </head>
    <body class="vertical-layout vertical-menu-modern 2-columns   fixed-navbar" data-open="click"
          data-menu="vertical-menu-modern" data-col="2-columns">
        @include('sweetalert::alert')
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
        <style>
            .preview-images-container {
                /* display: flex;
                flex-wrap: wrap;
                gap: 10px;
                margin-top: 20px; */
                display: grid;
                grid-template-columns: repeat(auto-fill, 170px);
            }
            .preview-certificates-container {
                /* display: flex;
                flex-wrap: wrap;
                gap: 10px;
                margin-top: 20px; */
                display: grid;
                grid-template-columns: repeat(auto-fill, 170px);
            }
            .preview {
                position: relative;
                width: 150px;
                height: 150px;
                padding: 4px;
                box-shadow: 1px 1px 2px rgba(0, 0, 0, 0.2);
                margin: 30px 0px;
                border: 1px solid #ddd;
            }

            .preview img {
                width: 100%;
                height: 100%;
                box-shadow: 1px 1px 2px rgba(0, 0, 0, 0.2);
                border: 1px solid #ddd;
                object-fit: cover;

            }

            .delete-btn {
                position: absolute;
                top: 156px;
                right: 0px;
                /*border: 2px solid #ddd;*/
                border: none;
                cursor: pointer;
            }

            .delete-btn {
                background: transparent;
                color: rgba(235, 32, 38, 0.97);
            }

            .crop-btn {
                position: absolute;
                top: 156px;
                left: 0px;
                /*border: 2px solid #ddd;*/
                border: none;
                cursor: pointer;
                background: transparent;
                color: #007bff;
            }
        </style>
        <style>
            .variants {
                display: flex;
                justify-content: center;
                align-items: center;
            }

            .variants>div {
                margin-right: 5px;
            }

            .variants>div:last-of-type {
                margin-right: 0;
            }

            .file {
                position: relative;
                display: flex;
                justify-content: center;
                align-items: center;
            }

            .file>input[type='file'] {
                display: none
            }

            .file>label {
                font-size: 1rem;
                font-weight: 300;
                cursor: pointer;
                outline: 0;
                user-select: none;
                border-color: rgb(216, 216, 216) rgb(209, 209, 209) rgb(186, 186, 186);
                border-style: solid;
                border-radius: 4px;
                border-width: 1px;
                background-color: hsl(0, 0%, 100%);
                color: hsl(0, 0%, 29%);
                padding-left: 16px;
                padding-right: 16px;
                padding-top: 16px;
                padding-bottom: 16px;
                display: flex;
                justify-content: center;
                align-items: center;
            }

            .file>label:hover {
                border-color: hsl(0, 0%, 21%);
            }

            .file>label:active {
                background-color: hsl(0, 0%, 96%);
            }

            .file>label>i {
                padding-right: 5px;
            }

            .file--upload>label {
                color: hsl(204, 86%, 53%);
                border-color: hsl(204, 86%, 53%);
            }

            .file--upload>label:hover {
                border-color: hsl(204, 86%, 53%);
                background-color: hsl(204, 86%, 96%);
            }

            .file--upload>label:active {
                background-color: hsl(204, 86%, 91%);
            }

            .file--uploading>label {
                color: hsl(48, 100%, 67%);
                border-color: hsl(48, 100%, 67%);
            }

            .file--uploading>label>i {
                animation: pulse 5s infinite;
            }

            .file--uploading>label:hover {
                border-color: hsl(48, 100%, 67%);
                background-color: hsl(48, 100%, 96%);
            }

            .file--uploading>label:active {
                background-color: hsl(48, 100%, 91%);
            }

            .file--success>label {
                color: hsl(141, 71%, 48%);
                border-color: hsl(141, 71%, 48%);
            }

            .file--success>label:hover {
                border-color: hsl(141, 71%, 48%);
                background-color: hsl(141, 71%, 96%);
            }

            .file--success>label:active {
                background-color: hsl(141, 71%, 91%);
            }

            .file--danger>label {
                color: hsl(348, 100%, 61%);
                border-color: hsl(348, 100%, 61%);
            }

            .file--danger>label:hover {
                border-color: hsl(348, 100%, 61%);
                background-color: hsl(348, 100%, 96%);
            }

            .file--danger>label:active {
                background-color: hsl(348, 100%, 91%);
            }

            .file--disabled {
                cursor: not-allowed;
            }

            .file--disabled>label {
                border-color: #e6e7ef;
                color: #e6e7ef;
                pointer-events: none;
            }

            @keyframes pulse {
                0% {
                    color: hsl(48, 100%, 67%);
                }

                50% {
                    color: hsl(48, 100%, 38%);
                }

                100% {
                    color: hsl(48, 100%, 67%);
                }
            }
        </style>
        @include('Admin.layouts.navbar')
        @include('Admin.layouts.sidebar')
        @yield('content')
        <div class="sidenav-overlay"></div>
        <div class="drag-target"></div>
        @include('Admin.layouts.footer')
        @include('Admin.layouts.footerjs')
        {{-- <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <x-livewire-alert::scripts /> --}}
        @stack('js')


    </body>
</html>
