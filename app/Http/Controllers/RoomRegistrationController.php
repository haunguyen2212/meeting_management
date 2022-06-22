<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Room;
use App\Models\TypeSupport;
use Illuminate\Http\Request;

class RoomRegistrationController extends Controller
{
    
    public function index()
    {
        $types = TypeSupport::select('id', 'name')->get();
        $departments = Department::select('id', 'name')->get();
        $rooms = Room::select('id', 'name')->get();
        return view('shared.register', compact('types', 'departments', 'rooms'));
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
        //
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
