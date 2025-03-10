    <?php

    require __DIR__ . '/manager.php';
    require __DIR__ . '/admin.php';
    require __DIR__ . '/roomservices.php';
    require __DIR__ . '/client.php';

    use App\Exports\UsersExport;

    use App\Http\Controllers\AuthnController;
    use App\Http\Controllers\FinancialmanagementController;
    use App\Http\Controllers\ReservationController;
    use App\Http\Controllers\ResetPasswordController;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Route;

    Route::get('/user', function (Request $request) {
        return $request->user();
    })->middleware('auth:sanctum');


    // middleware for logout for Use Token -> middleware
    Route::middleware('auth:sanctum')->group(function () {

        //  Email Verification Notice  3 Routes

        Route::get('/email/verify', [AuthnController::class, 'VerifyNotice'])->name('verification.notice');

        // Email Verification Handler

        Route::get('/email/verify/{id}/{hash}', [AuthnController::class, 'VerifyEmail'])->middleware(['signed'])->name('verification.verify');

        // Resending the Verification Email
        Route::post('/email/ResendEmail', [AuthnController::class, 'ResendEmail'])->middleware(['throttle:6,1'])->name('verification.send');


        // Reset Password  3 Routes
        // Handling the Form Submission   { password reset link ->cin:e}
        Route::post('/forgot-password', [ResetPasswordController::class, 'forgetpassword'])->name('password.email');


        // Resetting the Password  {?token?}
        Route::get('/reset-password/{token}', [ResetPasswordController::class, 'reset_password'])->name('password.reset');

        // Handling updating the user's password in the database {Your password has been reset ->cin:raw:e,p,pc,tm}
        Route::post('/reset-password', [ResetPasswordController::class, 'update_password'])->name('password.update');


        Route::post('/logout', [AuthnController::class, 'logout'])->middleware('auth:sanctum');
    });

    // ----------------------------------------------------------------------------------
    Route::middleware('guest')->group(function () {
        Route::post('/register', [AuthnController::class, 'register']);
        Route::post('/login', [AuthnController::class, 'login']);
    });


    // ----------------------------------------------------------------------------------------------
    Route::group([
        'prefix' => 'finacially',
        'middleware' => ['auth:sanctum', 'role:financial'],
        'as' => 'finacially.'
    ], function () {

        // Route::post('/financialManager', [FinancialmanagementController::class, 'delete']);

        Route::apiResource('/financialManager', FinancialmanagementController::class)->names([

            'index'   => 'financial.index',
            'store'   => 'financial.store',
            'delete'   => 'financial.delete',
            'show'   => 'financial.show',


        ]);
        Route::apiResource('/reservation', ReservationController::class);
    });
    
    
    // ----------------------------------------------------------------------------------------------
    
    //  Route for export excel
    // Route::get('export', function () {
    //     return Excel::download(new UsersExport, 'users.xlsx');
    // });

    // --------------------------------------------------------------------------------------
    // Route::apiResource('/contactus', ContactUsController::class);
    // Route::apiResource('/category', CategoryController::class);
    // Route::post('/contact', [ContactUsController::class, 'submit']);
    // Route::apiResource('/employee', EmployeeController::class);
    // Route::apiResource('/financial', FinancialmanagementController::class);
    // Route::apiResource('/Loyalty_Program', Loyalty_ProgramController::class);
    // Route::apiResource('/reservation', ReservationController::class);
    // Route::apiResource('/category', CategoryController::class);
    // Route::apiResource('/room', RoomController::class);
    // Route::apiResource('/review', ReviewController::class);
    // Route::get('/searchroom', [RoomController::class, 'searchroom']);
    // Route::apiResource('/service', ServiceController::class);
    // Route::apiResource('/user', UserController::class);
    // Route::apiResource('/whishlist', WhishlistController::class);
