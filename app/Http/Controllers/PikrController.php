<?php

namespace App\Http\Controllers;

use App\Models\Pikr;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class PikrController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pikrs = Pikr::with('user')->latest()->paginate(10);
        return view('master.pikr.index', compact('pikrs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('master.pikr.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'desc' => 'nullable|string',
            'admin_name' => 'required|string|max:255',
            'admin_email' => 'required|email',
            'admin_password' => 'required|string|min:8',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'sk' => 'nullable|mimes:pdf|max:5120',
        ]);

        DB::beginTransaction();
        try {
            // Check if admin already exists
            $existingUser = User::where('email', $request->admin_email)->first();
            
            if ($existingUser) {
                // Use existing user
                $user = $existingUser;
                $message = 'PIKR berhasil dibuat dengan admin yang sudah ada.';
            } else {
                // Create new admin user
                $user = User::create([
                    'name' => $request->admin_name,
                    'email' => $request->admin_email,
                    'password' => Hash::make($request->admin_password),
                    'email_verified_at' => now(),
                ]);
                
                // Assign admin_pikr role to user
                $user->assignRole('admin_pikr');
                $message = 'PIKR berhasil dibuat dengan admin baru.';
            }
            
            $data = [
                'name' => $request->name,
                'desc' => $request->desc,
                'user_id' => $user->id,
            ];
            
            // Handle logo upload
            if ($request->hasFile('logo')) {
                $logo = $request->file('logo');
                $logoPath = $logo->store('pikr/logo', 'public');
                $data['logo'] = $logoPath;
            }
            
            // Handle SK upload
            if ($request->hasFile('sk')) {
                $sk = $request->file('sk');
                $skPath = $sk->store('pikr/sk', 'public');
                $data['sk'] = $skPath;
            }
            
            // Create PIKR with the admin user
            $pikr = Pikr::create($data);
            
            DB::commit();
            return redirect()->route('master.pikr.index')
                ->with('success', $message);
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Pikr $pikr)
    {
        $pikr->load('user');
        return view('master.pikr.show', compact('pikr'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pikr $pikr)
    {
        $pikr->load('user');
        return view('master.pikr.edit', compact('pikr'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pikr $pikr)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'desc' => 'nullable|string',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'sk' => 'nullable|mimes:pdf|max:5120',
        ]);

        $data = [
            'name' => $request->name,
            'desc' => $request->desc,
        ];
        
        // Handle logo upload
        if ($request->hasFile('logo')) {
            // Delete old logo if exists
            if ($pikr->logo) {
                \Storage::disk('public')->delete($pikr->logo);
            }
            
            $logo = $request->file('logo');
            $logoPath = $logo->store('pikr/logo', 'public');
            $data['logo'] = $logoPath;
        }
        
        // Handle SK upload
        if ($request->hasFile('sk')) {
            // Delete old SK if exists
            if ($pikr->sk) {
                \Storage::disk('public')->delete($pikr->sk);
            }
            
            $sk = $request->file('sk');
            $skPath = $sk->store('pikr/sk', 'public');
            $data['sk'] = $skPath;
        }

        $pikr->update($data);

        return redirect()->route('master.pikr.index')
            ->with('success', 'PIKR berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pikr $pikr)
    {
        // Get the user ID before deleting the PIKR
        $userId = $pikr->user_id;
        
        // Delete the PIKR
        $pikr->delete();
        
        // Delete the associated admin user
        User::find($userId)->delete();

        return redirect()->route('master.pikr.index')
            ->with('success', 'PIKR dan admin berhasil dihapus.');
    }
}
