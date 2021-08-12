<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Session;
use App\Models\Company;
class companyController extends Controller
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
        $companies = Company::paginate(10);
        return view('companies.index')->with('companies', $companies);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('companies.new');
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
            'name' => 'required|unique:companies|max:255',
            'email' => 'nullable|email:rfc,dns',
            'logo' => 'mimes:jpeg,jpg,png,gif|max:2048|nullable'
        ]);
        //upload logo image
        if ($request->file('logo') != null) {
            $logoPath = $request->file('logo')->store('public');
            $logoPathArray = explode("/", $logoPath);
            $logoPath = $logoPathArray[1];
        } else {
            $logoPath = "";
        }
        // create new company
        $company = new Company;
        $company->name = $request->input('name');
        $company->email = $request->input('email');
        $company->logo = $logoPath;
        $company->website = $request->input('website');
        $company->save();
        // redirect back to companies page
        Session::flash('message', "New company added successfully!");
        return redirect()->route('companies.index');
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
        $company = Company::find($id);
        return view('companies.edit')->with('company', $company);
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
            'name' => 'required|max:255',
            'email' => 'nullable|email:rfc,dns',
            'logo' => 'mimes:jpeg,jpg,png,gif|max:2048|nullable'
        ]);
        $company = Company::find($request->input('id'));
        //upload logo image
        if ($request->file('logo') != null) {
            $logoPath = $request->file('logo')->store('public');
            $logoPathArray = explode("/", $logoPath);
            $logoPath = $logoPathArray[1];
            $company->logo = $logoPath;
        }
        // create new company
        $company->name = $request->input('name');
        $company->email = $request->input('email');
        $company->website = $request->input('website');
        $company->save();
        // redirect back to companies page
        Session::flash('message', "Company updated successfully!");
        return redirect()->route('companies.index');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $company = Company::where('id', $id)->first();
        $company->delete();
        // redirect back to companies page
        Session::flash('message', "Company deleted successfully!");
        return redirect()->route('companies.index');
    }
}
