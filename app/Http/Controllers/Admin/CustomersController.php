<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class CustomersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(): View|Factory|Application
    {
        $customers = Customer::with('assignedTo', 'addedBy')->paginate(25);
        return view('admin.customers.index', compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create(): Application|Factory|View
    {
        $employees = User::where('role', 'employee')->get();
        return view('admin.customers.create', compact('employees'));
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
        $data['added_by'] = auth()->user()->id;
        Customer::create($data);
        session()->flash('success', 'Customer Created Successfully');
        return redirect()->route('admin.customers.index');
    }

    /**
     * Display the specified resource.
     *
     * @param Customer $customer
     * @return Application|Factory|View
     */
    public function show(Customer $customer): Application|Factory|View
    {
        $customer->load(['actions' => function ($query) {
            $query->orderBy('created_at', 'desc');
        }, 'assignedTo', 'addedBy']);
        return view('admin.customers.show', compact('customer'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Customer $customer
     * @return Application|Factory|View
     */
    public function edit(Customer $customer): View|Factory|Application
    {
        $employees = User::where('role', 'employee')->get();
        return view('admin.customers.edit', compact('customer', 'employees'));
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
        return redirect()->route('admin.customers.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Customer $customer
     * @return RedirectResponse
     */
    public function destroy(Customer $customer): RedirectResponse
    {
        try {
            $customer->delete();
            session()->flash('success', 'Customer Deleted Successfully');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            session()->flash('error', 'Something went wrong');
        }
        return redirect()->route('admin.customers.index');
    }
}
