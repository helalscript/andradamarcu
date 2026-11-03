<?php
use App\Http\Controllers\API\Auth\SocialLoginController;

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::get('/',function (){
    if (Auth::check()){
        return redirect()->route('dashboard');
    }else{
        return redirect()->route('login');
    }
});


//social login
Route::get('/social-login/{provider}', [SocialLoginController::class, 'RedirectToProvider']);
Route::get('/social-login/{provider}/callback', [SocialLoginController::class, 'HandleProviderCallback']);

Route::get('/run-command', function () {
    return view('components.backend.command_runner');
})->name('run.command.form');

Route::post('/run-command', function (Request $request) {
    // Validate the command input
    $request->validate([
        'command' => 'required|string',
    ]);

    // Get the command from the input
    $command = $request->input('command');

    // Strip "php artisan" from the command if present
    $cleanedCommand = trim(str_replace(['php artisan', 'artisan'], '', $command));

    try {
        // Run the cleaned Artisan command
        Artisan::call($cleanedCommand);
        $output = Artisan::output();
    } catch (\Exception $e) {
        // Handle any errors from the Artisan command
        $output = "Error running command: " . $e->getMessage();
    }

    // Return the output to the view
    return redirect()->route('run.command.form')->with('output', $output);
})->name('run.command');
require __DIR__.'/auth.php';
