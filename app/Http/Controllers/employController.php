<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Session;
use App\Models\Employe;
use App\Models\Company;
class employController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $employees = Employe::paginate(10);
        return view('employees.index')->with('employees', $employees);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $companies = Company::orderBy('name')->get();
        return view('employees.new')->with('companies', $companies);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate request
        $request->validate([
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'email' => 'nullable|email:rfc,dns',
            'phone' => 'nullable|numeric',
        ]);
        // Create new employe
        $employe = new Employe;
        $employe->first_name = $request->input('first_name');
        $employe->last_name = $request->input('last_name');
        $employe->email = $request->input('email');
        $employe->phone = $request->input('phone');
        $employe->company_id = $request->input('company_id');
        $employe->save();
        // redirect back to companies page
        Session::flash('message', "New employe added successfully!");
        return redirect()->route('employees.index');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $employe = Employe::find($id);
        $companies = Company::orderBy('name')->get();
        return view('Employees.edit')->with('employe', $employe)->with('companies', $companies);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Validate request
        $request->validate([
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'email' => 'nullable|email:rfc,dns',
            'phone' => 'nullable|numeric',
        ]);
        $employe = Employe::find($request->input('id'));
        $employe->first_name = $request->input('first_name');
        $employe->last_name = $request->input('last_name');
        $employe->email = $request->input('email');
        $employe->phone = $request->input('phone');
        $employe->company_id = $request->input('company_id');
        $employe->save();
        // redirect back to companies page
        Session::flash('message', "Employe updated successfully!");
        return redirect()->route('employees.index');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $employe = Employe::where('id', $id)->first();
        $employe->delete();
        // redirect back to companies page
        Session::flash('message', "Employe deleted successfully!");
        return redirect()->route('employees.index');
    }
}
