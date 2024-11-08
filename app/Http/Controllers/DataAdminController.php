<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class DataAdminController extends Controller
{

    public function index()
    {
        // Ambil data admin dengan role = 'admin'
    $dataadmin = User::where('role', 'admin')->get();

    return view('admin.data_admin.index', compact('dataadmin'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}
