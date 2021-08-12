<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Employe;
use App\Models\Company;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $companies = Company::count();
        $employees = Employe::count();
        return view('home')->with(compact('companies', 'employees'));
    }
}
