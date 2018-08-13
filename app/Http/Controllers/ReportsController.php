<?php

namespace App\Http\Controllers;

use App\Report;
use Illuminate\Http\Request;

class ReportsController extends Controller
{
    function __construct()
    {
        $this->middleware('auth', ['except' => ['create','store']]);
        $this->middleware('roles:admin',['except' => ['create','store']]);

    }

    public function index()
    {

        $reports = Report::with(['user','reportable'])->orderBy('created_at', request('sorted', 'DESC'))->paginate(7);

        return view('reports.index', compact('reports'));
    }

    public function destroy($id)
    {

        Report::findOrFail($id)->delete();

        return redirect()->route('reportes.index');
    }
}
