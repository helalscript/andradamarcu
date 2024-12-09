@vite('resources/js/app.js')
<script src='{{ asset('backend/libs/choices.js/public/assets/scripts/choices.min.js') }}'></script>
<script src="{{ asset('backend/libs/@popperjs/core/umd/popper.min.js') }}"></script>
<script src="{{ asset('backend/libs/tippy.js/tippy-bundle.umd.min.js') }}"></script>
<script src="{{ asset('backend/libs/simplebar/simplebar.min.js') }}"></script>
<script src="{{ asset('backend/libs/prismjs/prism.js') }}"></script>
<script src="{{ asset('backend/libs/lucide/umd/lucide.js') }}"></script>
<script src="{{ asset('backend/js/tailwick.bundle.js') }}"></script>
<!-- App js -->
<script src="{{ asset('backend/js/app.js') }}"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"
    integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script type="text/javascript" src="https://jeremyfagis.github.io/dropify/dist/js/dropify.min.js"></script>

@stack('scripts')
