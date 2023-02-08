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
                <a href="{{ route('employee.customers.create') }}" class="btn btn-primary">
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
                        <th scope="col">Landline</th>
                        <th scope="col">Address</th>
                        <th scope="col">Actions</th>

                    </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                    @forelse($customers as $customer)
                        <tr>
                            <td>{{ $customer->name }}</td>
                            <td>{{ $customer->mobile }}</td>
                            <td>{{ $customer->email ?? '--' }}</td>
                            <td>{{ $customer->landline ?? '--' }}</td>
                            <td>{{ $customer->address ?? '--' }}</td>
                            <td>
                                <div class="d-flex">
                                    <a class="btn btn-primary btn-sm"
                                       href="{{ route('employee.customers.show', $customer->id) }}">
                                        <i class="bx bx-show-alt me-1"></i> Show
                                    </a>

                                    <a class="btn btn-warning btn-sm mx-3"
                                       href="{{ route('employee.customers.edit', $customer->id) }}">
                                        <i class="bx bx-edit-alt me-1"></i> Edit
                                    </a>
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
@endsection

