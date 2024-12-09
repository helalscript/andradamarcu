<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\VocabularyGroup;
use Exception;
use Illuminate\Http\Request;
use App\Helpers\Helper;

class VocabularyGroupController extends Controller
{
    public function index(Request $request)
    {
        try {
            // Get 'per_page' from the request or default to 1000
            $per_page = $request->get('per_page', 1000);

            $data = VocabularyGroup::where('status', 'active')
                ->paginate($per_page);
            // Return success response
            return Helper::jsonResponse(true, 'Successfully fetched privacy policy data.', 200, $data, true);
        } catch (Exception $e) {
            return Helper::jsonErrorResponse('Something went wrong', 403);
        }
    }
}
