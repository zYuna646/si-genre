<?php

namespace App\Http\Controllers;

use App\Models\Pikr;
use Illuminate\Http\Request;

class LandingPikrController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('q');
        $query = Pikr::query();

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                    ->orWhere('desc', 'like', '%' . $search . '%');
            });
        }

        $pikrs = $query->latest()->paginate(6);

        $items = $pikrs->map(function ($pikr) {
            return [
                'id' => $pikr->id,
                'name' => $pikr->name,
                'desc' => $pikr->desc,
                'logo_url' => $pikr->logo ? asset('storage/' . $pikr->logo) : null,
                'initials' => substr($pikr->name ?? '', 0, 2),
                'detail_url' => route('pikr.detail', $pikr->id),
            ];
        });

        return response()->json([
            'items' => $items,
            'current_page' => $pikrs->currentPage(),
            'last_page' => $pikrs->lastPage(),
            'per_page' => $pikrs->perPage(),
            'total' => $pikrs->total(),
        ]);
    }
}