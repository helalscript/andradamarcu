    <!-- Layout config Js -->
    <script src="{{asset('backend/js/layout.js')}}"></script>
    <!-- Tailwind CSS -->
      <link rel="stylesheet" href="{{asset('backend')}}/css/tailwind2.css">
      @vite('resources/css/app.css')

    <style>
        .fl-wrapper {
            z-index: 999999 !important;
        }
    </style>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.css">
    <style>
        .form-input {
            border: 2px solid #f0f3f7;
            border-radius: 6px;
        }
        .dropify-wrapper {
            height: 400px;
        }
        .dropify-wrapper .dropify-preview .dropify-render img {
            display: block;
        margin-left: auto;
        margin-right: auto;
        }
    </style>
@stack('styles')

