<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(): View|Factory|Application
    {
        $employees = User::where('role', 'employee')->paginate(25);
        return view('admin.employees.index', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create(): View|Factory|Application
    {
        return view('admin.employees.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateEmployeeRequest $request
     * @return RedirectResponse
     */
    public function store(CreateEmployeeRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['password'] = bcrypt($data['password']);
        $data['role'] = 'employee';
        $data['created_by'] = auth()->user()->id;
        User::create($data);
        session()->flash('success', 'Employee Created Successfully');
        return redirect()->route('admin.employees.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  User  $employee
     * @return Application|Factory|View
     */
    public function show(User $employee): View|Factory|Application
    {
        $customers = Customer::where('assigned_to', $employee->id)->get();
        return view('admin.employees.show', compact('employee', 'customers'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  User $employee
     * @return Application|Factory|View
     */
    public function edit(User $employee): View|Factory|Application
    {
        return view('admin.employees.edit', compact('employee'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateEmployeeRequest $request
     * @param  User $employee
     * @return RedirectResponse
     */
    public function update(UpdateEmployeeRequest $request, User $employee): RedirectResponse
    {
        $data = $request->validated();
        if($request->has('password'))
        {
            $data['password'] = bcrypt($data['password']);
        }
        $employee->update($data);
        session()->flash('success', 'Employee Updated Successfully');
        return redirect()->route('admin.employees.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  User $employee
     * @return RedirectResponse
     */
    public function destroy(User $employee): RedirectResponse
    {
        try {
            $employee->delete();
            session()->flash('success', 'Employee Deleted Successfully');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            session()->flash('error', 'Something went wrong');
        }
        return redirect()->route('admin.employees.index');
    }
}
