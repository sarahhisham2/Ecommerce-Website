 <?php

use App\Http\Controllers\UserController;

use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use Illuminate\Http\Request;

    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\Route;

    Route::post('login', [UserController::class, 'login']);
    Route::post('register', [UserController::class,'register']);
    Route::get('/products', [ProductController::class,'index']);
    Route::post('/upload-file', [ProductController::class,'uploadFile']);
    Route::get('/products/{product}', [ProductController::class,'show']);

    Route::group(['middleware' => 'auth:api'], function () {
        Route::get('/users', [UserController::class,'index']);
        Route::get('users/{user}', [UserController::class,'show']);
        Route::patch('users/{user}', [userController::class,'update']);
        Route::get('users/{user}/orders', [userController::class,'showOrders']);
        Route::patch('products/{product}/units/add', [ProductController::class,'updateUnits']);
        Route::patch('orders/{order}/deliver', [OrderController::class,'deliverOrder']);
        Route::resource('/orders', OrderController::class);
        Route::resource('/products', ProductController::class)->except(['index', 'show']);
    });
