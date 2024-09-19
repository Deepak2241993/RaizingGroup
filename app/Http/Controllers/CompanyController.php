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

/**
 * @OA\Post(
 *     path="/company",
 *     summary="Create a new company",
 *     tags={"Company"},
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"company_name", "tax_location", "email", "city", "country"},
 *             @OA\Property(property="company_name", type="string", example="Example Company"),
 *             @OA\Property(property="tax_id", type="string", example="GST12345678"),
 *             @OA\Property(property="tax_location", type="string", example="Jammu"),
 *             @OA\Property(property="tax_document", type="string", format="binary"),
 *             @OA\Property(property="tax_card", type="string", format="binary"),   
 *             @OA\Property(property="tax_number", type="string", example="TAN12345678"),
 *             @OA\Property(property="company_id", type="string", format="binary"),  
 *             @OA\Property(property="billing_address", type="string", example="123 Street, City"),
 *             @OA\Property(property="billing_location", type="string", example="New Delhi"),
 *             @OA\Property(property="email", type="string", format="email", example="abc@gmail.com"),
 *             @OA\Property(property="mobile", type="string", example="9876543210"),
 *             @OA\Property(property="head_address_office", type="string", example="Head Office Address"),
 *             @OA\Property(property="street", type="string", example="Street"),
 *             @OA\Property(property="city", type="string", example="City"),
 *             @OA\Property(property="postal_code", type="number", example="110012"),
 *             @OA\Property(property="country", type="string", example="India"),
 *             @OA\Property(property="web_link", type="url", example="http://example.com")
 *         )
 *     ),
 *     @OA\Response(
 *         response=201,
 *         description="Company created successfully",
 *         @OA\JsonContent(
 *             @OA\Property(property="success", type="boolean", example=true),
 *             @OA\Property(property="message", type="string", example="Company created successfully")
 *         )
 *     ),
 *     @OA\Response(
 *         response=400,
 *         description="Invalid input data",
 *         @OA\JsonContent(
 *             @OA\Property(property="success", type="boolean", example=false),
 *             @OA\Property(property="message", type="string", example="Invalid data provided")
 *         )
 *     )
 * )
 */


public function store(Request $request, Company $company)
{
    // Validate the required fields
    $this->validate($request, [
        'company_name' => 'required|string',
        'tax_location' => 'required|string',
        'email'        => 'required|email',
        'city'         => 'required|string',
        'country'      => 'required|string'
    ]);

    $data = [];

    // Handling file uploads
    if ($request->hasFile('tax_document')) {
        $file = $request->file('tax_document');
        $tax_document = $this->upload_single_image($file, $folder = 'tax_document');
        $data['gst_file'] = $folder . "/" . $tax_document;
    }
    if ($request->hasFile('tax_card')) {
        $file = $request->file('tax_card');
        $tax_card = $this->upload_single_image($file, $folder = 'tax_card');
        $data['cpan'] = $folder . "/" . $tax_card;
    }
    if ($request->hasFile('company_id')) {
        $file = $request->file('company_id');
        $company_id = $this->upload_single_image($file, $folder = 'company_id');
        $data['mca'] = $folder . "/" . $company_id;
    }

    // Map API fields to database fields
    $data['compname'] = $request->company_name;       // company_name
    $data['cgst'] = $request->tax_id;                 // gst_location (in your db as 'cgst')
    $data['gst_location'] = $request->tax_location;
    $data['tan'] = $request->tax_number;
    $data['billing_address'] = $request->billing_address;
    $data['billing_address_location'] = $request->billing_location;
    $data['compemail'] = $request->email;             // email
    $data['compmob'] = $request->mobile;
    $data['head_office_address'] = $request->head_address_office;
    $data['compstreet'] = $request->street;
    $data['compcity'] = $request->city;               // city
    $data['compcode'] = $request->postal_code;
    $data['compcountry'] = $request->country;         // country
    $data['web_link'] = $request->web_link;

    // Save the data to the database
    $result = $company->create($data);

    // Return appropriate response
    if ($result) {
        return response()->json([
            'success' => true,
            'error' => false,
            'data' => $result,
            'message' => 'Company Created Successfully'
        ], 201);
    } else {
        return response()->json([
            'success' => false,
            'error' => true,
            'message' => 'Failed to create company'
        ], 400);
    }
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
