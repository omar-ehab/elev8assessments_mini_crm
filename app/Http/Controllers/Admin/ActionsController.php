<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateActionRequest;
use App\Http\Requests\UpdateActionRequest;
use App\Models\Action;
use App\Models\Customer;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ActionsController extends Controller
{
    public function store(CreateActionRequest $request, Customer $customer): RedirectResponse
    {

        $data = $request->validated();
        $data['customer_id'] = $customer->id;
        $data['recorded_by'] = auth()->user()->id;
        if ($data['note'])
        {
            $data['noted_by'] = auth()->user()->id;
        }
        Action::create($data);
        session()->flash('success', 'Action Added Successfully');
        return redirect()->back();
    }

    public function update(UpdateActionRequest $request, Customer $customer, Action $action): RedirectResponse
    {
        $data = $request->validated();
        $data['noted_by'] = auth()->user()->id;
        $action->update($data);
        session()->flash('success', 'Action Note Updated Successfully');
        return redirect()->back();
    }
}
