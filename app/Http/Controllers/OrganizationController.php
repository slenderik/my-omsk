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

    // public function organization($id) {
    //     $organization = Organization::find($id);
    //     return view('organizations.card', compact('organization'));
    // }

    public function create()
    {
        return view('organizations.create');
    }

    // API
    public function items(Request $request)
    {
        $query = $request->input('query');
        $organizations = Organization::where('name', 'LIKE', "%{$query}%")->select('id', 'name')->get();
        return response()->json($organizations);
    }

    public function store(Request $request)
    {   
        // Валидация данных
        $validatedData = $request->validate([
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'name' => 'required|max:255',
            'description' => 'required',
        ]);

        // Сохранение фото
        $logoName = time() . '_' . pathinfo($request->logo->getClientOriginalName(), PATHINFO_FILENAME) . '.' . $request->logo->getClientOriginalExtension();
        $request->logo->storeAs('images', $logoName, 'public');

        // Создание ивента
        $organization = Organization::create([
            'name' => $validatedData['name'],
            'logo_name' => $logoName,
            'description' => $validatedData['description'],
        ]);

        // // Сохранение пути к изображению в базе данных
        // OrganizationAddress::create([
        //     'event_id' => $event->id,
        //     'logo_name' => $imageName
        // ]);
        
        // Перенаправление на главную
        return redirect()->route('organizations.index');
    }
}
