@extends('layouts.app')
@section('title', 'Edit Customer')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><a href="{{ route('employee.customers.index') }}" class="fw-light">Customers
                /</a>
            Edit Customer
        </h4>
        <!-- Basic Layout -->
        <div class="row">
            <div class="col-xl">
                <div class="card mb-4">
                    <div class="card-body">
                        <form action="{{ route('employee.customers.update', $customer->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row mb-3">
                                <div class="col-sm-12 col-md-6">
                                    <label class="form-label @error('name') text-danger @enderror" for="name">
                                        Name
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                           id="name"
                                           name="name"
                                           value="{{ old('name', $customer->name) }}"
                                           placeholder="Customer Name"/>
                                    @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <label class="form-label @error('mobile') text-danger @enderror" for="mobile">
                                        Mobile
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" class="form-control @error('mobile') is-invalid @enderror"
                                           id="mobile"
                                           name="mobile"
                                           value="{{ old('mobile', $customer->mobile) }}"
                                           placeholder="Customer Mobile"/>
                                    @error('mobile')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-sm-12 col-md-6">
                                    <label class="form-label @error('email') text-danger @enderror" for="email">
                                        Email
                                    </label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                                           id="email"
                                           name="email"
                                           value="{{ old('email', $customer->email) }}"
                                           placeholder="Customer Email"/>
                                    @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <label class="form-label @error('landline') text-danger @enderror" for="landline">
                                        Landline
                                    </label>
                                    <input type="text" class="form-control @error('landline') is-invalid @enderror"
                                           id="landline"
                                           name="landline"
                                           value="{{ old('landline', $customer->landline) }}"
                                           placeholder="Customer Landline"/>
                                    @error('landline')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                            </div>
                            <div class="row mt-4">
                                <div class="col-sm-12">
                                    <label class="form-label @error('address') text-danger @enderror" for="address">
                                        Address
                                    </label>
                                    <input type="text" class="form-control @error('address') is-invalid @enderror"
                                           id="address"
                                           name="address"
                                           value="{{ old('address', $customer->address) }}"
                                           placeholder="Customer Address"/>
                                    @error('address')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="bx bx-save me-1"></i>
                                        Save
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
