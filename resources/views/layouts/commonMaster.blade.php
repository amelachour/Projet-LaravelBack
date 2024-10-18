<!DOCTYPE html>

<html class="light-style layout-menu-fixed" data-theme="theme-default" data-assets-path="{{ asset('/assets') . '/' }}" data-base-url="{{url('/')}}" data-framework="laravel" data-template="vertical-menu-laravel-template-free">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

  <title>@yield('title') | Materio - HTML Laravel Free Admin Template </title>
  <meta name="description" content="{{ config('variables.templateDescription') ? config('variables.templateDescription') : '' }}" />
  <meta name="keywords" content="{{ config('variables.templateKeyword') ? config('variables.templateKeyword') : '' }}">
  <!-- laravel CRUD token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <!-- Canonical SEO -->
  <link rel="canonical" href="{{ config('variables.productPage') ? config('variables.productPage') : '' }}">
  <!-- Favicon -->
  <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/favicon/favicon.ico') }}" />

  <!-- Inclure Toastr CSS -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
<!-- SweetAlert2 CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<!-- SweetAlert2 JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Inclure jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Inclure Toastr JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>


  <!-- Include Styles -->
  @include('layouts/sections/styles')

  <!-- Include Scripts for customizer, helper, analytics, config -->
  @include('layouts/sections/scriptsIncludes')
  <style>
        /* Personnaliser l'apparence des toasts */
        .my-custom-toast {
            background-color: #4CAF50; /* Couleur de fond */
            color: white;  /* Couleur du texte */
            border-radius: 5px;  /* Coins arrondis */
            font-size: 16px; /* Taille de la police */
        }

        .my-custom-toast .toast-close-button {
            color: white; /* Couleur du bouton de fermeture */
        }

        /* Personnaliser le toast pour les succès */
        .toastr-success {
            background-color: #4CAF50; /* Couleur de fond pour succès */
        }

        /* Personnaliser le toast pour les erreurs */
        .toastr-error {
            background-color: #F44336; /* Couleur de fond pour erreur */
        }

        /* Personnaliser le toast pour les avertissements */
        .toastr-warning {
            background-color: #FF9800; /* Couleur de fond pour avertissement */
        }

        /* Personnaliser le toast pour les infos */
        .toastr-info {
            background-color: #2196F3; /* Couleur de fond pour info */
        }
    </style>

    <script>
        $(document).ready(function() {
           
            toastr.options = {
                "closeButton": true,
                "debug": false,
                "positionClass": "toast-top-right",
                "onclick": null,
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": "5000", 
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut",
                "toastClass": "my-custom-toast",  
            };

           
         
        });
    </script>
</head>

<body>
  

  <!-- Layout Content -->
  @yield('layoutContent')
  <!--/ Layout Content -->

 

  <!-- Include Scripts -->
  @include('layouts/sections/scripts')

</body>

</html>
