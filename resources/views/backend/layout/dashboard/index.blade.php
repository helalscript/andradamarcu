@extends('backend.app')
@section('title', 'Dashboard')
@section('title_url')
    <a href="{{ route('dashboard') }}">Dashboard</a>
@endsection
@push('styles')
    <link href="{{ asset('vendor/flasher/flasher.min.css') }}" rel="stylesheet">
@endpush
@section('content')

    <div class="grid grid-cols-12 2xl:grid-cols-12 gap-x-5">
        <div class="col-span-12 card md:col-span-6 lg:col-span-3 2xl:col-span-2">
            <div class="text-center card-body">
                <div
                    class="flex items-center justify-center mx-auto text-purple-500 bg-purple-100 rounded-full size-14 dark:bg-purple-500/20">
                    <i data-lucide="package"></i>
                </div>
                <h5 class="mt-4 mb-2"><span class="counter-value" data-target="0">0</span></h5>
                <p onclick="trigger()" class="text-slate-500 dark:text-zink-200">Total User</p>
            </div>
        </div><!--end col-->


    @endsection

    @push('scripts')
        <script src="{{ asset('backend/js/datatables/jquery-3.7.0.js') }}"></script>
        <script src="{{ asset('vendor/flasher/flasher.min.js') }}"></script>
    @endpush
