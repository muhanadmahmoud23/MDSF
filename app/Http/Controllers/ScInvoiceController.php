<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Company;
use App\Models\Scinvoice;
use Illuminate\Http\Request;

class ScInvoiceController extends Controller
{

    public function index()
    {
        $branches = Branch::all();
        $companies = Company::all();
       
        return view(
            'sales.invoice',
            [
                'branches'  => $branches,
                'companies' => $companies,
            ]
        );
    }

    public function pivotInvoice(Request $request)
    {
        $main_cat = "";
        if($request->Branch && $request->Company){
            $main_cat = 'Soon';
        }
        if($request->multiple){
            $main_cat=$request;
            $main_cat = Scinvoice::whereIn('prod_id', $request->multiple)->get();
        }
        if ($request->UOM_id) {
            $main_cat = Scinvoice::where('Uom_id', $request->UOM_id)->get();
        }
        if ($request->prod_id) {
            $main_cat = Scinvoice::where('prod_id', $request->prod_id)->get();
        }
        if ($request->endDate && $request->Begindate) {
            if ($request->Begindate < $request->endDate) {
                $main_cat = Scinvoice::where('created_at', '>=', $request->Begindate)->where('created_at', '<=', $request->endDate)->get();
            }
        }

        return response()->json($main_cat);
    }

    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
