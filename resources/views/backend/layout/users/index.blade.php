@extends('backend.app')

{{-- Title for the User List Dashboard --}}
@section('title', 'User List')
@section('title_url')
    <a href="{{ route('users.index') }}">User List</a>
@endsection
@section('tabName')
    Home
@endsection

{{-- Push additional styles if needed --}}
@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.0/dist/sweetalert2.min.css" rel="stylesheet">
    <link href="{{ asset('vendor/flasher/flasher.min.css') }}" rel="stylesheet">
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
    </style>
@endpush

{{-- Main content of the Blog Dashboard page --}}
@section('content')
    <div class="card">
        <div class="card-body max-sm:overflow-scroll">
            <div class="flex justify-end mb-6">
                <a href="#!" data-modal-target="openModal" type="button"></a>
            </div>
            <table id="basic_tables" class="display stripe group">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Avatar</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
    <x-backend.modal title="User Details">
        <!-- Modal Content -->
    </x-backend.modal>
@endsection

{{-- Push additional scripts if needed --}}
@push('scripts')
    <script src="{{ asset('backend/js/datatables/data-tables.min.js') }}"></script>
    <script src="{{ asset('backend/js/datatables/data-tables.tailwindcss.min.js') }}"></script>
    <!--buttons dataTables-->
    <script src="{{ asset('backend/js/datatables/datatables.buttons.min.js') }}"></script>
    <script src="{{ asset('backend/js/datatables/jszip.min.js') }}"></script>
    <script src="{{ asset('backend/js/datatables/pdfmake.min.js') }}"></script>
    <script src="{{ asset('backend/js/datatables/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('backend/js/datatables/buttons.print.min.js') }}"></script>

    {{-- <script src="{{ asset('backend/js/datatables/datatables.init.js') }}"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.0/dist/sweetalert2.all.min.js"
        integrity="sha256-BpyIV7Y3e2pnqy8TQGXxsmOiQ4jXNDTOTBGL2TEJeDY=" crossorigin="anonymous"></script>
    <script src="{{ asset('vendor/flasher/flasher.min.js') }}"></script>
    <script>
        $(document).ready(function() {

            let url = "{{ route('users.index') }}";
            let dTable = $('#basic_tables').DataTable({
                order: [],
                destroy: true,
                lengthMenu: [
                    [25, 50, 100, 200, 500, -1],
                    [25, 50, 100, 200, 500, "All"]
                ],
                processing: true,
                responsive: true,
                serverSide: true,
                language: {
                    processing: `<div class="text-center">
                    <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                    <span class="visually-hidden">Loading...</span>
                  </div>
                    </div>`
                },
                scroller: {
                    loadingIndicator: false
                },
                dom: "<'row justify-content-between table-topbar'<'col-md-2 col-sm-4 px-0'l><'col-md-2 col-sm-4 px-0'f>>tipr",
                ajax: {
                    url: url,
                    type: "get",
                    // success: function(res) {
                    //     console.log(res)
                    // }
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'name',
                        name: 'name',
                        orderable: true,
                        searchable: true,
                        render: function(data, type, row) {
                            if (data.length > 50) {
                                return data.substring(0, 50) + '...';
                            } else {
                                return data;
                            }
                        }
                    },
                    {
                        data: 'avatar',
                        name: 'avatar',
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: 'email',
                        name: 'email',
                        orderable: true,
                        searchable: true,
                    },
                    {
                        data: 'status',
                        name: 'status',
                        orderable: true,
                        searchable: false,
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ],
            });
        });


        // Status Change Confirm Alert
        function showStatusChangeAlert(id) {
            event.preventDefault();
            Swal.fire({
                title: 'Are you sure?',
                text: 'You want to update the status?',
                icon: 'info',
                showCancelButton: true,
                confirmButtonText: 'Yes',
                cancelButtonText: 'No',
            }).then((result) => {
                if (result.isConfirmed) {
                    statusChange(id);
                }
            });
        }

        // Status Change
        function statusChange(id) {
            let url = '{{ route('users.status', ':id') }}';
            $.ajax({
                type: "POST",
                url: url.replace(':id', id),
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                },
                success: function(resp) {
                    // Reload DataTable
                    $('#basic_tables').DataTable().ajax.reload();
                    if (resp.success === true) {
                        // show toast message
                        flasher.success(resp.message);
                    } else if (resp.errors) {
                        flasher.error(resp.errors[0]);
                    } else {
                        flasher.error(resp.message);
                    }
                },
                error: function(error) {
                    flasher.error(error.responseJSON.message);
                }
            });
        }

        // Delete Confirm
        function showDeleteConfirm(id) {
            event.preventDefault();
            Swal.fire({
                title: 'Are you sure you want to delete this record?',
                text: 'If you delete this, it will be gone forever.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!',
            }).then((result) => {
                if (result.isConfirmed) {
                    deleteItem(id);
                }
            });
        }

        // Delete Button
        function deleteItem(id) {
            let url = '{{ route('users.destroy', ':id') }}';
            let csrfToken = '{{ csrf_token() }}';
            $.ajax({
                type: "DELETE",
                url: url.replace(':id', id),
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                success: function(resp) {
                    // Reload DataTable
                    $('#basic_tables').DataTable().ajax.reload();
                    if (resp.success === true) {
                        // show toast message
                        flasher.success(resp.message);
                    } else if (resp.errors) {
                        flasher.error(resp.errors[0]);
                    } else {
                        flasher.error(resp.message);
                    }
                },
                error: function(error) {
                    flasher.error(error.responseJSON.message);
                }
            });
        }

        function showModal(id) {
            let modalElement = document.querySelector('[data-modal-target="openModal"]').click()
            // console.log(id);
            let url = '{{ route('users.show', ':id') }}'.replace(':id', id);
            $.ajax({
                type: "GET",
                url: url,
                success: function(resp) {
                    $('#modalBody').html(resp);
                }
            });
        };
    </script>
@endpush
