<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CompanyStoreRequest;
use App\Http\Requests\AdminCompanyStoreRequest;
use App\Http\Requests\AdminCompanyUpdateRequest;
use App\Company;
use Auth ;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Arr;
use App\Events\DeleteImageEvent;

class CompanyController extends Controller
{


    public function index(){

        $companies = Company::active()->all();
        $page_title = "All Companies";
        return view('home.company.index',compact('page_title','companies'));
    }

    public function show(Company $company){

        $page_title = "$company->name information";
        return view('home.company.show',compact('page_title','company'));
    }

    public function admin_create()
    {
        $this->authorize('admin_create', Company::class );
        return view('admin.company.create');
    }

    public function admin_store(AdminCompanyStoreRequest $request)
    {
        $this->authorize('admin_create', Company::class );
        $validatedData = $request->validated();
        $company = Company::create(  $validatedData );
        $msg = "created company " ;
        return redirect()->route('admin.company.all_company')->withSuccess($msg);
    }

    public function admin_edit(Company $company)
    {
        $this->authorize('update', $company );
        return view('admin.company.edit', compact('company'));
    }

    public function admin_update(AdminCompanyUpdateRequest $request , Company $company)
    {
        $this->authorize('update', $company );
        $company->update($request->validated()); 
        $msg = "update company " ;
        return redirect()->back()->withSuccess($msg);
    }

    public function store(CompanyStoreRequest $request)
    {
        $this->authorize('create', Company::class );
        $validatedData = $request->validated();
        $company = Company::create(  Arr::except($validatedData, ['business_license']) );
        Auth::user()->update(['company_id' => $company->id])  ;
        $this->image_upload($company);
        $msg = "Your request is created awaiting for approval, once its approved , visitor can view your public company profile" ;
        return redirect()->route('user_profile','#company')->withSuccess($msg);
    }

    private function image_upload($company){
        $image_path = request()->business_license->store('uploads/company','public');
        $company->image()->create(['name' => $image_path ]);
    }

    public function all_company()
    {
        $this->authorize('viewAny', Company::class );
        $companies = Company::all();
        return view('admin.company.index',compact('companies'));
    }

    public function destroy(Company $company)
    {
        $this->authorize('delete', $company );
        foreach( $company->user as $user ){
            $user->update([ 'company_id' => null ]);
        }
        event(New DeleteImageEvent($company->image));
        $company->image()->delete();
        $company->delete($company);
        Session::flash('destroy_company','success delete company with title ' . $company->name);
        return back();
    }

}
