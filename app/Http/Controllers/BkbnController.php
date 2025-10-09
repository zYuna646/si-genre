<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class BkbnController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bkbns = User::role('admin_bkbn')->latest()->paginate(10);
        return view('master.bkbn.index', compact('bkbns'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('master.bkbn.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
        ]);

        DB::beginTransaction();
        try {
            // Create new admin_bkbn user
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'email_verified_at' => now(),
            ]);
            
            // Assign admin_bkbn role to user
            $user->assignRole('admin_bkbn');
            
            DB::commit();
            return redirect()->route('master.bkbn.index')
                ->with('success', 'Admin BKBN berhasil dibuat.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(User $bkbn)
    {
        return view('master.bkbn.show', compact('bkbn'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $bkbn)
    {
        return view('master.bkbn.edit', compact('bkbn'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $bkbn)
    {
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $bkbn->id,
        ];
        
        if ($request->filled('password')) {
            $rules['password'] = 'string|min:8';
        }
        
        $request->validate($rules);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
        ];
        
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $bkbn->update($data);

        return redirect()->route('master.bkbn.index')
            ->with('success', 'Admin BKBN berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $bkbn)
    {
        $bkbn->delete();

        return redirect()->route('master.bkbn.index')
            ->with('success', 'Admin BKBN berhasil dihapus.');
    }
}