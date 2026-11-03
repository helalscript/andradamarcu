<?php

namespace App\Http\Controllers\Web\Backend;

use App\Http\Controllers\Controller;
use App\Models\ContentCMS;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Helpers\Helper;

class ContentCMSController extends Controller
{
    public function index(Request $request)
    {
        $contentType = $request->contentType;

        if ($request->ajax()) {
            $data = ContentCMS::when($contentType, function ($query, $contentType) {
                return $query->where('type', $contentType);
            }, function ($query) {
                return $query->whereIn('type', ['how_to_use', 'privacy_policy']);
            })
                ->latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('status', function ($data) {
                    $status = '<label class="inline-flex items-center cursor-pointer">';
                    $status .= '<input onclick="showStatusChangeAlert(' . $data->id . ')" type="checkbox" value="" class="sr-only peer" id="customSwitch' . $data->id . '" name="status"';
                    if ($data->status == "active") {
                        $status .= ' checked';
                    }
                    $status .= '>';
                    $status .= '<div class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[\'\'] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"></div>';
                    $status .= '</label>';

                    return $status;
                })
                ->addColumn('action', function ($data) {
                    return '<div role="group" style="gap: 10px;display: flex;">
                    <a class="flex items-center justify-center w-8 h-8 transition-all rounded-md bg-slate-100 text-slate-500 hover:text-custom-500 hover:bg-custom-100 dark:bg-zink-600 dark:text-zink-200" href="' . route('contents.edit', $data->id) . '">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 3a2.85 2.83 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5Z"></path><path d="m15 5 4 4"></path></svg>
                    </a>
                    <a href="#!" onclick="showDeleteConfirm(' . $data->id . ')" class="flex items-center justify-center w-8 h-8 transition-all rounded-md bg-slate-100 text-slate-500 hover:text-red-500 hover:bg-red-100 dark:bg-zink-600 dark:text-zink-200">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 6h18"></path><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"></path><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"></path><line x1="10" x2="10" y1="11" y2="17"></line><line x1="14" x2="14" y1="11" y2="17"></line></svg>
                    </a>
                </div>';
                })
                ->rawColumns(['status', 'action'])
                ->make(true);
        }
        return view("backend.layout.contents.index", compact('contentType'));
    }

    public function create(Request $request)
    {
        $contentType = $request->contentType;
        return view("backend.layout.contents.create", compact('contentType'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'content' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'url' => 'nullable|string|max:255',
        ]);

        // Check how many active rows exist
        $activeCount = ContentCMS::where('status', 'active')->count();

        // If there are already 3 active rows, set the status of the new entry to inactive
        $validatedData['status'] = $activeCount < 1000 ? 'active' : 'inactive';

        // Image store in local with a random number in the filename
        if ($request->hasFile('logo')) {
            $validatedData['logo'] = Helper::fileUpload($request->file('logo'), 'contents', time() . '_' . getFileName($request->file('logo')));
        }

        ContentCMS::create($validatedData);

        flash()->success('contents Created Successfully');
        return redirect()->route('contents.index', ['contentType' => $request->type]);
    }



    public function edit(Request $request,string $id)
    {
        $data = ContentCMS::findOrFail($id);
        return view("backend.layout.contents.edit", compact("data"));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'content' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'url' => 'nullable|string|max:255',
        ]);

        $contents = ContentCMS::findOrFail($id);

        // Background Image store: delete old background image if a new one is uploaded
        if ($request->hasFile('logo')) {
            if ($validatedData['logo'] && file_exists(public_path($contents->logo))) {
                Helper::fileDelete(public_path($contents->logo));
            }
            $validatedData['logo'] = Helper::fileUpload($request->file('logo'), 'contents', time() . '_' . getFileName($request->file('logo')));
        }

        // Update the contents tip with validated data
        $contents->update($validatedData);
        flash()->success('contents Updated Successfully');
        return redirect()->route('contents.index', ['contentType' => $request->type]);
    }


    public function destroy(string $id)
    {
        $data = ContentCMS::findOrFail($id);
        if (empty($data)) {
            return response()->json([
                "success" => false,
                "message" => "Item not found."
            ], 404);
        }

        $data->delete();

        return response()->json([
            "success" => true,
            "message" => "Item deleted successfully."
        ]);
    }

    public function status(string $id)
    {
        $data = ContentCMS::findOrFail($id);

        if (empty($data)) {
            return response()->json([
                "success" => false,
                "message" => "Item not found."
            ], 404);
        }

        // Count the number of currently active rows
        $activeCount = ContentCMS::where('status', 'active')->count();

        // Toggle status with constraints
        if ($data->status == 'active') {
            $data->status = 'inactive';
        } else {
            // Check if we can activate this item
            if ($activeCount >= 1000) {
                return response()->json([
                    'success' => false,
                    'message' => 'You can only activate up to 1000 contents.'
                ], 400);
            }
            // Changing from inactive to active
            $data->status = 'active';
        }

        $data->save();

        return response()->json([
            'success' => true,
            'message' => 'Item status changed successfully.'
        ]);
    }

}
