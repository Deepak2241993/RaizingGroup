<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Brand;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Company::where('is_deleted',0)->orderBy('id', 'DESC')->paginate(10);
        return view('admin.company.index', compact('data'));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.company.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,Company $company)
    {
        $data=$request->all();
        if ($request->hasFile('gst_file')) {
            $file = $request->file('gst_file');
            $gst_file = $this->upload_single_image($file, $folder = 'gst_file');
            $data['gst_file'] = $folder."/".$gst_file;
        }
        if ($request->hasFile('cpan')) {
            $file = $request->file('cpan');
            $cpan = $this->upload_single_image($file, $folder = 'cpan');
            $data['cpan'] = $folder."/".$cpan;
        }
        if ($request->hasFile('mca')) {
            $file = $request->file('mca');
            $mca = $this->upload_single_image($file, $folder = 'mca');
            $data['mca'] = $folder."/".$mca;
        }
        $company->create($data);
        return redirect(route('company.index'))->with('message','Company Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        $data = Brand::where('brands.is_deleted', 0)
        ->where('bcomp',$company->id)
        ->join('companies', 'brands.bcomp', '=', 'companies.id')
        ->select('brands.*', 'companies.compname as comp_name')
        ->orderBy('brands.id', 'DESC')
        ->paginate(20);
        return view('admin.brands.index', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company)
    {
        return view('admin.company.create',compact('company'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Company $company)
    {
        $data=$request->all();
        if ($request->hasFile('gst_file')) {
            $file = $request->file('gst_file');
            $gst_file = $this->upload_single_image($file, $folder = 'gst_file');
            $data['gst_file'] = $folder."/".$gst_file;
        }
        if ($request->hasFile('cpan')) {
            $file = $request->file('cpan');
            $cpan = $this->upload_single_image($file, $folder = 'cpan');
            $data['cpan'] = $folder."/".$cpan;
        }
        if ($request->hasFile('mca')) {
            $file = $request->file('mca');
            $mca = $this->upload_single_image($file, $folder = 'mca');
            $data['mca'] = $folder."/".$mca;
        }
        $company->update($data);
        return redirect(route('company.index'))->with('message','Company updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        if($company->update(['is_deleted'=>1]))
        {
            $response = array('success' => true, 'error' => false, 'message' => 'Data Delete successfully..');
        }
    else{
        $response = array('success' => false, 'error' => true, 'message' => 'Something Went Wrong !');
         }
    return $response;
    }
}
