<?php

namespace App\Http\Controllers;

use App\Models\Organization;
use App\Models\OrganizationAddress;
use Illuminate\Http\Request;

class OrganizationController extends Controller
{
    public function index()
    {
        $organizations = Organization::all();
        return view('organizations.index', compact('organizations'));
    }

    
    public function items(Request $request)
    {
        $query = $request->input('query');
        $organizations = Organization::where('name', 'LIKE', "%{$query}%")->select('id', 'name')->get();
        return response()->json($organizations);
    }

    public function store(Request $request)
    {   
        $name = $request->input('name');
        $description = 'Описание будет добавлено позже.';

        $organizationRequest =[
            'name' => $name,
            'description' => $description
        ];

        $organization = Organization::create($organizationRequest);
        return response()->json($organization);
    }

    // public function organization($id) {
    //     $organization = Organization::find($id);
    //     return view('organizations.card', compact('organization'));
    // }

    public function create()
    {
        return view('organizations.create');
    }
}
