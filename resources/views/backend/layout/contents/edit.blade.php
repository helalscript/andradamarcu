@extends('backend.app')

{{-- Title for the User Dashboard --}}
@section('title', 'Contents')
@section('title_url')
    <a href="{{ route('contents.index') }}">Contents</a>
@endsection
@section('tabName')
    Update
@endsection

{{-- Push additional styles if needed --}}
@push('styles')
    {{-- Add any specific styles for the User Dashboard page here --}}
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.0/dist/sweetalert2.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.css">
    <style>
        .text-center {
            text-align: end;
        }

        .table-topbar {
            display: flex;
            justify-content: space-between;
            margin-bottom: 40px;
        }

        .dataTables_info {
            margin-top: 20px;
        }

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
@endpush



{{-- Main content of the User Dashboard page --}}
@section('content')
    <div class="card">
        <div class="card-body max-sm:overflow-scroll">
            <h1>Update Contents</h1>
            <div class="flex justify-end mb-6">
                <a href="{{ route('contents.index',['contentType' => $data->type]) }}"
                    class="text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20">Back</a>
            </div>
            <form action="{{ route('contents.update', $data->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT') <!-- Add the PUT method for update -->
                <div class="grid grid-cols-1 gap-5 xl:grid-cols-12">

                    <input type="text" name="type" value="{{ $data->type }}" hidden>

                    {{-- ------------------- Content Text Field ------------- --}}
                    <div class="xl:col-span-12">
                        <label for="content" class="inline-block mb-2 text-base font-medium">Content <span
                                style="color: red">*</span> </label>
                        <textarea name="content" id="content"
                            class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                            rows="3" placeholder="Enter Content Here">{{ old('content', $data->content) }}</textarea>
                        @error('content')
                            <div style="color: red">{{ $message }}</div>
                        @enderror
                    </div><!--end col-->

                    {{-- ================== Only for contact_us content =================== --}}
                    @if ($data->type === 'contact_us')
                        {{-- ------------------- Title Input Field ------------- --}}
                        <div class="xl:col-span-12">
                            <label for="url" class="inline-block mb-2 text-base font-medium">Url<span
                                    style="color: red">*</span></label>
                            <input type="text" name="url" id="url"
                                class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 @error('url') is-invalid @enderror"
                                placeholder="www.example.com" value="{{ old('url', $data->url) }}" required>
                            @error('url')
                                <div style="color: red">{{ $message }}</div>
                            @enderror
                        </div><!--end col-->

                        {{-- ------------------- Image Upload Field ------------- --}}
                        <div class="xl:col-span-12">
                            <label for="logo" class="inline-block mb-2 text-base font-medium">Logo<span
                                    style="color: red">*</span></label>
                            <input type="file" name="logo" id="logo"
                                class="dropify form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                data-default-file="{{ $data->logo ? asset( $data->logo) : '' }}" />
                            @error('logo')
                                <div style="color: red">{{ $message }}</div>
                            @enderror
                        </div><!--end col-->
                    @endif

                </div><!--end grid-->

                {{-- ------------------- Form Buttons ------------- --}}
                <div class="flex justify-start mt-6 gap-x-4">
                    <button type="submit"
                        class="text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20">Update</button>
                </div>
            </form>
        </div>

    </div>
@endsection


@push('scripts')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://jeremyfagis.github.io/dropify/dist/js/dropify.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.dropify').dropify();
        })
    </script>
@endpush
