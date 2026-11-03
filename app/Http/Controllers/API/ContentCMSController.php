<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\ContentCMS;
use App\Models\Faq;
use Exception;
use Illuminate\Http\Request;
use App\Helpers\Helper;
class ContentCMSController extends Controller
{

    public function PrivacyPolicyContent(Request $request)
    {
        try {
            // Get 'per_page' from the request or default to 1000
            $per_page = $request->get('per_page', 1000);

            $data = ContentCMS::where('status', 'active')
                ->where('type', 'privacy_policy')
                ->orderBy('position', 'asc')  // 'ase' should be 'asc' for ascending order
                ->select('id', 'content', 'position')  // Only select the 'id' and 'content' columns
                ->paginate($per_page);
            // Return success response
            return Helper::jsonResponse(true, 'Successfully fetched privacy policy data.', 200, $data, true);
        } catch (Exception $e) {
            return Helper::jsonErrorResponse('Something went wrong', 403);
        }
    }
    public function HowToUseContent(Request $request)
    {
        try {
            // Get 'per_page' from the request or default to 1000
            $per_page = $request->get('per_page', 1000);

            $data = ContentCMS::where('status', 'active')
                ->where('type', 'how_to_use')
                ->orderBy('position', 'asc')  // 'ase' should be 'asc' for ascending order
                ->select('id', 'content', 'position')  // Only select the 'id' and 'content' columns
                ->paginate($per_page);
            // Return success response
            return Helper::jsonResponse(true, 'Successfully fetched How To Use Content data.', 200, $data, true);
        } catch (Exception $e) {
            return Helper::jsonErrorResponse('Something went wrong', 403);
        }
    }

}
