<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use App\Models\Customer;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class CustomersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(): View|Factory|Application
    {
        $customers = Customer::with('assignedTo', 'addedBy')
            ->where('assigned_to', auth()->user()->id)
            ->paginate(25);
        return view('employee.customers.index', compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create(): View|Factory|Application
    {
        return view('employee.customers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateCustomerRequest $request
     * @return RedirectResponse
     */
    public function store(CreateCustomerRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['assigned_to'] = auth()->user()->id;
        $data['added_by'] = auth()->user()->id;
        Customer::create($data);
        session()->flash('success', 'Customer Created Successfully');
        return redirect()->route('employee.customers.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  Customer $customer
     * @return Application|Factory|View
     */
    public function show(Customer $customer): View|Factory|Application
    {
        return view('employee.customers.show', compact('customer'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Customer $customer
     * @return Application|Factory|View
     */
    public function edit(Customer $customer): View|Factory|Application
    {
        $customer->load('actions', 'assignedTo', 'addedBy');
        return view('employee.customers.edit', compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateCustomerRequest $request
     * @param Customer $customer
     * @return RedirectResponse
     */
    public function update(UpdateCustomerRequest $request, Customer $customer): RedirectResponse
    {
        $customer->update($request->validated());
        session()->flash('success', 'Customer Updated Successfully');
        return redirect()->route('employee.customers.index');
    }
}
