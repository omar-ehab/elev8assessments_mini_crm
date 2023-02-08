@extends('layouts.app')
@section('title', 'Customers')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row justify-content-between">
            <div class="col-md-10">
                <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Customers /</span> All
                    Customers
                </h4>
            </div>
            <div class="col-md-2 text-end">
                <a href="{{ route('admin.customers.create') }}" class="btn btn-primary">
                    <i class="bx bx-plus me-1"></i>
                    Add
                </a>
            </div>
        </div>
        @include('layouts.partials._session')
        <div class="card">
            <h5 class="card-header">Customers</h5>
            <div class="table-responsive text-nowrap">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Mobile</th>
                        <th scope="col">Email</th>
                        <th scope="col">Address</th>
                        <th scope="col">Assigned To</th>
                        <th scope="col">Actions</th>

                    </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                    @forelse($customers as $customer)
                        <tr>
                            <td>{{ $customer->name }}</td>
                            <td>{{ $customer->mobile }}</td>
                            <td>{{ $customer->email ?? '--' }}</td>
                            <td>{{ $customer->address ? \Illuminate\Support\Str::limit($customer->address, 25) : '--' }}</td>
                            <td>{{ $customer->assignedTo ? $customer->assignedTo->name : '--' }}</td>
                            <td>
                                <div class="d-flex">
                                    <a class="btn btn-primary btn-sm"
                                       href="{{ route('admin.customers.show', $customer->id) }}">
                                        <i class="bx bx-show-alt me-1"></i> Show
                                    </a>

                                    <a class="btn btn-warning btn-sm mx-3"
                                       href="{{ route('admin.customers.edit', $customer->id) }}">
                                        <i class="bx bx-edit-alt me-1"></i> Edit
                                    </a>

                                    <button type="button"
                                            class="btn btn-danger btn-sm"
                                            data-bs-toggle="modal"
                                            data-bs-target="#deleteConfirmation"
                                            data-bs-customer-id="{{ $customer->id }}"
                                    >
                                        <i class="bx bx-trash-alt me-1"></i>
                                        Delete
                                    </button>
                                </div>
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="10" class="text-center">There is no customers!</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
            @if($customers->hasPages())
                <div class="d-flex justify-content-center mt-5 mb-3">
                    {{ $customers->links() }}
                </div>
            @endif
        </div>
    </div>
    <div
        class="modal fade"
        id="deleteConfirmation"
        aria-labelledby="deleteConfirmationLabel"
        tabindex="-1"
        style="display: none"
        aria-hidden="true"
    >
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteConfirmationLabel">Delete Customer !</h5>
                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Close"
                    ></button>
                </div>
                <form action="" method="POST">
                    @csrf
                    @method('delete')
                    <div class="modal-body">are you sure you want to delete customer?</div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                            Close
                        </button>
                        <button type="submit" class="btn btn-danger" id="delete-btn" formaction="">
                            <i class="bx bx-trash-alt me-1"></i>
                            Yes, Delete it
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        const deleteConfirmationModal = document.getElementById('deleteConfirmation')
        deleteConfirmationModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget
            const customerId = button.getAttribute('data-bs-customer-id')
            const url = `/dashboard/admin/customers/${customerId}`
            const submitBtn = document.getElementById('delete-btn')
            submitBtn.setAttribute('formaction', url);
        });
    </script>
@endpush
