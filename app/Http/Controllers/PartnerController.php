<?php

namespace App\Http\Controllers;

use App\Models\Partner;
use Illuminate\Http\Request;

class PartnerController extends Controller
{
    public function index()
    {
        $partners = Partner::all();
        return view('admin.partners', compact('partners'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'logo' => 'required|string',
            'name' => 'required|string|max:255',
        ]);

        Partner::create($request->all());

        notify()->success('Partner successfully created');
        return redirect()->route('partners.index');
    }

    public function update(Request $request, Partner $partner)
    {
        $request->validate([
            'logo' => 'required|string',
            'name' => 'required|string|max:255',
        ]);

        $partner->update($request->all());

        notify()->success('Partner successfully updated');
        return redirect()->route('partners.index');
    }

    public function destroy(Partner $partner)
    {
        $partner->delete();

        notify()->success('Partner successfully deleted');
        return redirect()->route('partners.index');
    }
}