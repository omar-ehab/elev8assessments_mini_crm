@extends('layouts.app')
@section('title', $customer->name)
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row justify-content-between">
            <div class="col-md-10">
                <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Customers /</span> {{ $customer->name }}
                </h4>
            </div>
        </div>
        @include('layouts.partials._session')
        <div class="card">
            <h5 class="card-header">{{ $customer->name }}</h5>
            <div class="table-responsive text-nowrap">
                <table class="table table-hover table-striped">
                    <tbody class="table-border-bottom-0">
                    <tr>
                        <td>Name</td>
                        <td>{{ $customer->name }}</td>
                    </tr>
                    <tr>
                        <td>Mobile</td>
                        <td>{{ $customer->mobile }}</td>
                    </tr>
                    <tr>
                        <td>Mobile</td>
                        <td>{{ $customer->email ?? '--' }}</td>
                    </tr>
                    <tr>
                        <td>Address</td>
                        <td>{{ $customer->address ?? '--' }}</td>
                    </tr>
                    <tr>
                        <td>Landline</td>
                        <td>{{ $customer->landline ?? '--' }}</td>
                    </tr>
                    <tr>
                        <td>Assigned To</td>
                        <td>{{ $customer->assigned_to ? $customer->assignedTo->name : '--' }}</td>
                    </tr>
                    <tr>
                        <td>Added By</td>
                        <td>{{ $customer->addedBy->name }}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card mt-4">
            <div class="row justify-content-between align-items-center">
                <div class="col-md-10">
                    <h5 class="card-header">{{ $customer->name }} Actions</h5>
                </div>
                <div class="col-md-2">
                    <button class="btn btn-primary"
                            type="button"
                            data-bs-toggle="modal"
                            data-bs-target="#addActionResult"
                    >
                        <i class="bx bx-plus me-1"></i>
                        Add Action
                    </button>
                </div>
            </div>
            <div class="table-responsive text-nowrap">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th scope="col">Created By</th>
                        <th scope="col">Action</th>
                        <th scope="col">Created At</th>
                        <th scope="col">Noted By</th>
                        <th scope="col">Note</th>
                        <th scope="col">Noted At</th>
                        <th scope="col">Actions</th>
                    </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                    @forelse($customer->actions as $action)
                        <tr>
                            <td>{{ $action->recordedBy->name }}</td>
                            <td>{{ $action->action->name }}</td>
                            <td>{{ $action->created_at->diffForHumans() }}</td>
                            <td>{{ $action->notedBy ? $action->notedBy->name : '--' }}</td>
                            <td>{{ $action->note }}</td>
                            <td>{{ $action->note ? $action->updated_at->diffForHumans() : '--' }}</td>
                            <td>
                                <button type="button"
                                        class="btn btn-warning btn-sm"
                                        data-bs-toggle="modal"
                                        data-bs-target="#editActionResult"
                                        data-bs-customer-id="{{ $customer->id }}"
                                        data-bs-action-id="{{ $action->id }}"
                                        data-bs-action-note="{{ $action->note }}"
                                >
                                    <i class="bx bx-edit-alt me-1"></i>
                                    Edit Note
                                </button>
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="10" class="text-center">There is no actions!</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div
        class="modal fade"
        id="addActionResult"
        aria-labelledby="addActionResultLabel"
        tabindex="-1"
        style="display: none"
        aria-hidden="true"
    >
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteConfirmationLabel">Add Action</h5>
                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Close"
                    ></button>
                </div>
                <form action="{{ route('admin.customers.actions', $customer->id) }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <label class="form-label @error('action') text-danger @enderror"
                                       for="action">
                                    Action
                                    <span class="text-danger">*</span>

                                </label>
                                <select name="action" id="action" class="form-control">
                                    <option selected value="">-------</option>
                                    @foreach(App\Enums\ActionTypeEnum::values() as $key => $value)
                                        <option value="{{ $key }}" {{ old('action') == $key ? 'selected' : '' }}>
                                            {{ $value }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('action')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-12 mt-3">
                                <label class="form-label @error('note') text-danger @enderror" for="note">
                                    Note
                                </label>
                                <input type="text" class="form-control @error('note') is-invalid @enderror"
                                       id="note"
                                       name="note"
                                       value="{{ old('note') }}"
                                       placeholder="Note"/>
                                @error('note')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                            Close
                        </button>
                        <button type="submit" class="btn btn-primary">
                            <i class="bx bx-save me-1"></i>
                            Save
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div
        class="modal fade"
        id="editActionResult"
        aria-labelledby="editActionResultLabel"
        tabindex="-1"
        style="display: none"
        aria-hidden="true"
    >
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteConfirmationLabel">Edit Action Note</h5>
                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Close"
                    ></button>
                </div>
                <form action="" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <label class="form-label @error('note') text-danger @enderror" for="update-note">
                                    Note
                                </label>
                                <input type="text" class="form-control @error('note') is-invalid @enderror"
                                       id="update-note"
                                       name="note"
                                       value="{{ old('note') }}"
                                       placeholder="Note"/>
                                @error('note')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                            Close
                        </button>
                        <button type="submit" class="btn btn-primary" id="update-btn" formaction="">
                            <i class="bx bx-save me-1"></i>
                            Save
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        const deleteConfirmationModal = document.getElementById('editActionResult')
        deleteConfirmationModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget
            const customerId = button.getAttribute('data-bs-customer-id')
            const actionId = button.getAttribute('data-bs-action-id')
            const actionNote = button.getAttribute('data-bs-action-note')
            const url = `/dashboard/admin/customers/${customerId}/actions/${actionId}/update`
            const noteInput = document.getElementById('update-note')
            const submitBtn = document.getElementById('update-btn')
            submitBtn.setAttribute('formaction', url);
            noteInput.value = actionNote;
        });
    </script>
@endpush
