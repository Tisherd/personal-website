<?php

namespace App\Http\Controllers\Sandbox;

use Illuminate\Http\Request;

use Inertia\Inertia;
use Inertia\Response;

use App\Http\Controllers\Controller;
use App\Models\GoogleTableSync;
use App\Services\GoogleTableSyncService;

class GoogleTableSyncController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Sandbox/GoogleTableSync', [
            'items' => GoogleTableSync::all(),
            'googleSheetUrl' => GoogleTableSyncService::getSheet(),
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'value' => 'required|number',
            'content' => 'nullable|string',
            'status' => 'required|in:Allowed,Prohibited',
        ]);

        GoogleTableSync::create($validated);
        return redirect()->route('sandbox.google_table_sync.index');
    }

    public function destroy(GoogleTableSync $googleTableSync)
    {
        $googleTableSync->delete();
        return redirect()->route('sandbox.google_table_sync.index');
    }

    public function generate()
    {
        GoogleTableSync::factory()
            ->count(100)
            ->create();

        return redirect()->route('sandbox.google_table_sync.index');
    }

    public function clear()
    {
        GoogleTableSync::truncate();
        return redirect()->route('sandbox.google_table_sync.index');
    }

    public function updateGoogleSheet(Request $request, GoogleTableSyncService $service)
    {
        try {
            $request->validate(['googleSheetUrl' => 'required|url']);
            $service->setSheet($request->get('googleSheetUrl'));

            return response()->json(['message' => 'Google Sheet успешно обновлен'], 200);
        } catch (\Throwable $error) {
            return response()->json(['error' => $error->getMessage()], 500);
        }
    }
}
