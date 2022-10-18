<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\Cabinet\CabinetCreateValidation;
use App\Http\Requests\Admin\Cabinet\CabinetUpdateValidation;
use App\Models\Cabinet;
use Illuminate\Http\Request;

class CabinetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $cabinets = Cabinet::all();
        return view('admin.cabinet.cabinets', compact('cabinets'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $request->session()->flashInput([]);
        return view('admin.cabinet.createOrUpdate');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function store(CabinetCreateValidation $request)
    {
        $validate = $request->validated();
        Cabinet::create($validate);
        return redirect()->route('admin.cabinets.index')->with(['add' => 'true']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cabinet  $cabinet
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function show(Cabinet $cabinet)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cabinet  $cabinet
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit( Request $request,Cabinet $cabinet)
    {
        $request->session()->flashInput($cabinet->toArray());
        return view('admin.cabinet.createOrUpdate', compact('cabinet'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cabinet  $cabinet
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function update(CabinetUpdateValidation $request, Cabinet $cabinet)
    {
        $validate = $request->validated();
        $cabinet->update($validate);
        return redirect()->route('admin.cabinets.index')->with(['edit' => 'true']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cabinet  $cabinet
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function destroy(Cabinet $cabinet)
    {
        $cabinet->delete();
        return back()->with(['delete' => true]);
    }
}
