<?php

namespace App\Http\Controllers\Web\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Helpers\Helper;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = User::where('role', 'user')
                ->where('email_verified_at', '!=', null)
                ->latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('avatar', function ($data) {
                    $url = $data->avatar ? asset($data->avatar) : asset('backend/images/avatar-2.png');
                    return '
                    <img src="' . $url . '" alt="image" width="50px" height="50px" style="margin-left:20px; border-radius:50%;">';
                })
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

                          <a href="#!" onclick="showModal(' . $data->id . ')" data-modal-target="openModal" type="button" class="flex items-center justify-center w-8 h-8 transition-all duration-200 ease-linear rounded-md bg-slate-100 text-slate-500 hover:text-custom-500 hover:bg-custom-100 dark:bg-zink-600 dark:text-zink-200 dark:hover:bg-custom-500/20 dark:hover:text-custom-500"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" data-lucide="eye" class="lucide lucide-eye inline-block w-3 h-3"><path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"></path><circle cx="12" cy="12" r="3"></circle></svg> </a>
                    
                          <a href="#!" onclick="showDeleteConfirm(' . $data->id . ')" class="flex items-center justify-center w-8 h-8 transition-all rounded-md bg-slate-100 text-slate-500 hover:text-red-500 hover:bg-red-100 dark:bg-zink-600 dark:text-zink-200">
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 6h18"></path><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"></path><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"></path><line x1="10" x2="10" y1="11" y2="17"></line><line x1="14" x2="14" y1="11" y2="17"></line></svg>
                    </a>
                </div>';
                })
                ->rawColumns(['avatar', 'status', 'action'])
                ->make(true);
        }
        return view("backend.layout.users.index");
    }

    // public function create()
    // {
    //     return view("backend.layout.users.create");
    // }

    // public function store(Request $request)
    // {
    //     $validatedData = $request->validate([
    //         'user_id' => 'nullable|exists:users,id',
    //         'title' => 'required|string|max:255',
    //         'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
    //     ]);

    //     $validatedData['user_id'] = Auth::id();
    //     $validatedData['type'] = "blog";
    //     // Conditional status assignment based on user's role
    //     if (Auth::user()->role === 'admin') {
    //         $validatedData['status'] = 'publish';
    //     } else {
    //         $validatedData['status'] = 'pending';
    //     }

    //     // Image store in local with a random number in the filename
    //     if ($request->hasFile('image')) {
    //         $validatedData['image'] = Helper::fileUpload($request->file('image'), 'blogs', time() . '_' . getFileName($request->file('image')));
    //     }

    //     Blog::create($validatedData);
    //     flash()->success('Blog Created Successfully');
    //     return redirect()->route('users.index');
    // }


    // public function edit(string $id)
    // {
    //     $data = Blog::findOrFail($id);
    //     return view("backend.layout.users.edit", compact("data"));
    // }

    // public function update(Request $request, $id)
    // {
    //     $validatedData = $request->validate([
    //         'user_id' => 'nullable|exists:users,id',
    //         'title' => 'required|string|max:255',
    //         'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    //     ]);

    //     $blog = Blog::findOrFail($id);
    //     $validatedData['type'] = "blog";

    //     // Image store: delete old image if a new one is uploaded
    //     if ($request->hasFile('image')) {
    //         if ($validatedData['image'] && file_exists(public_path($blog->image))) {
    //             Helper::fileDelete(public_path($blog->image));
    //         }
    //         $validatedData['image'] = Helper::fileUpload($request->file('image'), 'blogs', time() . '_' . getFileName($request->file('image')));
    //     }

    //     $blog->update($validatedData);
    //     flash()->success('Blog Updated Successfully');
    //     return redirect()->route('users.index');
    // }


    public function show(string $id)
    {
        $data = User::findOrFail($id);
        return view('backend.layout.users.show', compact('data'));
    }
    public function destroy(string $id)
    {
        $data = User::findOrFail($id);
        if (empty($data)) {
            return response()->json([
                "success" => false,
                "message" => "Item not found."
            ], 404);
        }

        if (!empty($data->image)) {
            Helper::fileDelete(public_path($data->image));
        }

        $data->delete();

        return response()->json([
            "success" => true,
            "message" => "Item deleted successfully."
        ]);
    }
    public function status(string $id)
    {
        $data = User::findOrFail($id);

        if (empty($data)) {
            return response()->json([
                "success" => false,
                "message" => "Item not found."
            ], 404);
        }


        // Toggle status with constraints
        if ($data->status == 'active') {
            $data->status = 'inactive';
        } else {
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
