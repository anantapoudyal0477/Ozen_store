<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

use App\Models\EyeLens;
use App\Models\EyeLensDimensions;
use App\Models\EyeLensOptics;
use App\Models\EyeLensFeatures;
use App\Models\EyeLensType;
use App\Models\Materials;
use App\Models\Brand;
use App\Models\WearingReplacements;
use App\Models\GlassesColor;
use App\Models\Order;
use App\Models\OrderItem;

use App\Http\Controllers\Controller;

class User_EyeLensController extends Controller
{
    // List all lenses for the user
    public function index()
    {
        $userLenses = EyeLens::where('user_id', Auth::id())->get();

        return $this->renderUserViewPage(
            'User.Services.LensReplacement.index',
            'Eye Lenses',
            ['userLenses' => $userLenses]
        );
    }

    // Show create form
    public function create()
    {
        return $this->renderUserViewPage(
            'User.Services.LensReplacement.create',
            'Eye Lenses',
            [
                'brands' => Brand::all(),
                'materials' => Materials::all(),
                'lensTypes' => EyeLensType::all(),
                'optics' => EyeLensOptics::all(),
                'features' => EyeLensFeatures::all(),
                'dimensions' => EyeLensDimensions::all(),
                'wearingReplacements' => WearingReplacements::all(),
                'colors' => GlassesColor::all()
            ]
        );
    }

    // Store new lens + create order
    public function store(Request $request)
    {
        // ✅ Validation
        $validated = $request->validate([
            'lens_name' => 'required|string|max:255',
            'lens_type_id' => 'required|exists:eye_lens_types,id',
            'brand_id' => 'required|exists:brands,id',
            'material_id' => 'required|exists:materials,id',
            'wearing_replacement_id' => 'required|exists:wearing_replacements,id',
            'sphere' => 'nullable|numeric|min:-20|max:20',
            'cylinder' => 'nullable|numeric|min:-10|max:10',
            'axis' => 'nullable|integer|min:0|max:180',
            'add_power' => 'nullable|numeric|min:0|max:10',
            'base_curve' => 'required|numeric|min:5|max:15',
            'diameter' => 'required|numeric|min:10|max:20',
            'water_content' => 'nullable|numeric|min:0|max:100',
            'oxygen_permeability' => 'nullable|string|max:50',
            'color_id' => 'nullable|string|max:50',
            'uv_protection' => 'nullable|boolean',
        ]);

        // 1️⃣ Create EyeLens
        $eyeLens = EyeLens::create([
            'lens_name' => $validated['lens_name'],
            'lens_type_id' => $validated['lens_type_id'],
            'brand_id' => $validated['brand_id'],
            'material_id' => $validated['material_id'],
            'wearing_replacement_id' => $validated['wearing_replacement_id'],
            'user_id' => Auth::id(),
        ]);

        // 2️⃣ Optics
        EyeLensOptics::create([
            'eye_lens_id' => $eyeLens->id,
            'sphere' => $validated['sphere'],
            'cylinder' => $validated['cylinder'],
            'axis' => $validated['axis'],
            'add_power' => $validated['add_power'],
        ]);

        // 3️⃣ Dimensions
        EyeLensDimensions::create([
            'eye_lens_id' => $eyeLens->id,
            'base_curve' => $validated['base_curve'],
            'diameter' => $validated['diameter'],
            'water_content' => $validated['water_content'],
            'oxygen_permeability' => $validated['oxygen_permeability'],
        ]);

        // 4️⃣ Features
        EyeLensFeatures::create([
            'eye_lens_id' => $eyeLens->id,
            'color_id' => $validated['color_id'],
            'uv_protection' => $validated['uv_protection'] ?? 0,
        ]);

        // ✅ 5️⃣ CREATE ORDER
        $order = Order::create([
            'user_id' => Auth::id(),
            'order_number' => 'ORD-' . strtoupper(Str::random(10)),
            'quantity' => 1,
            'total_price' => 0, // you can calculate later
            'status' => 'pending',
        ]);

        // ✅ 6️⃣ CREATE ORDER ITEM (Lens)
        OrderItem::create([
            'order_id' => $order->id,
            'product_id' => null,
            'eye_lens_id' => $eyeLens->id,
            'quantity' => 1,
            'isPrescription' => 'yes',
        ]);

        // // ✅ Final response (clean)
        // return redirect()
        //     ->route('User.services.LensReplacement.index')
        //     ->with('success', 'Lens ordered successfully.');
        return response()->json([
    'success' => true,
    'message' => 'Lens Replacement added successfully.'
]);
    }

    // Show specific lens
    public function show($id)
    {
        $lens = EyeLens::where('user_id', Auth::id())->findOrFail($id);
        return view('User.Services.LensReplacement.show', compact('lens'));
    }

    // Update lens
    public function update(Request $request, $id)
    {
        $lens = EyeLens::where('user_id', Auth::id())->findOrFail($id);

        $request->validate([
            'lens_type' => 'required|string|max:255',
            'prescription' => 'required|string|max:255',
        ]);

        $lens->update($request->only('lens_type', 'prescription'));

        return redirect()
            ->route('User.Services.LensReplacement.index')
            ->with('success', 'Lens updated successfully.');
    }

    // Delete lens
    public function destroy($id)
    {
        $lens = EyeLens::where('user_id', Auth::id())->findOrFail($id);
        $lens->delete();

        return redirect()
            ->route('User.Services.LensReplacement.index')
            ->with('success', 'Lens deleted successfully.');
    }
}
