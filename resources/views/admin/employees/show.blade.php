@extends('layouts.app')
@section('title', $employee->name)
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row justify-content-between">
            <div class="col-md-10">
                <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Employees /</span> {{ $employee->name }}
                </h4>
            </div>
        </div>
        @include('layouts.partials._session')
        <div class="card">
            <h5 class="card-header">{{ $employee->name }}</h5>
            <div class="table-responsive text-nowrap">
                <table class="table table-hover table-striped">
                    <tbody class="table-border-bottom-0">
                    <tr>
                        <td>Name</td>
                        <td>{{ $employee->name }}</td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td>{{ $employee->mobile }}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card mt-4">
            <div class="row justify-content-between align-items-center">
                <div class="col-md-10">
                    <h5 class="card-header">{{ $employee->name }} Customers</h5>
                </div>
            </div>
            <div class="table-responsive text-nowrap">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Mobile</th>
                        <th scope="col">Email</th>
                        <th scope="col">Actions</th>
                    </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                    @forelse($customers as $customer)
                        <tr>
                            <td>{{ $customer->name }}</td>
                            <td>{{ $customer->mobile }}</td>
                            <td>{{ $customer->email }}</td>
                            <td>
                                <a class="btn btn-primary btn-sm"
                                   href="{{ route('admin.customers.show', $customer->id) }}">
                                    <i class="bx bx-show-alt me-1"></i> Show
                                </a>
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
        </div>
    </div>
@endsection
