<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\Competence\CompetenceCreateValidation;
use App\Http\Requests\Admin\Competence\CompetenceUpdateValidation;
use App\Models\Competence;
use Illuminate\Http\Request;

class CompetenceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $competences = Competence::all();
        return view('admin.competence.competences', compact('competences'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('admin.competence.createOrUpdate');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function store(CompetenceCreateValidation $request)
    {
        $validate = $request->validated();
        Competence::create($validate);
        return redirect()->route('admin.competences.index')->with(['add' => 'true']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Competence  $competence
     * @return \Illuminate\Http\Response
     */
    public function show(Competence $competence)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Competence  $competence
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit(Request $request, Competence $competence)
    {
        $request->session()->flashInput($competence->toArray());
        return view('admin.competence.createOrUpdate', compact('competence'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Competence  $competence
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function update(CompetenceUpdateValidation $request, Competence $competence)
    {
        $validate = $request->validated();
        $competence->update($validate);
        return redirect()->route('admin.competences.index')->with(['edit' => 'true']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Competence  $competence
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function destroy(Competence $competence)
    {
        $competence->delete();
        return back()->with(['delete' => true]);
    }
}
