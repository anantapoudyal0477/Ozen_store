<?php


use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Controller;


use App\Http\Controllers\IndexController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ServicesController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;

use App\Http\Controllers\Admin\Admin_LoginController;
use App\Http\Controllers\Doctor\Doctor_LoginController;
use App\Http\Controllers\Staff\Staff_LoginController;



Route::get('/', [IndexController::class, 'index'])->name('Index');

// About
Route::get('/About', [AboutController::class, 'index'])->name('About');

// Products Group
Route::prefix('Products')->name('Products.')->group(function () {
    Route::get('/', [ProductsController::class, 'index'])->name('index');
    Route::get('/{id}', [ProductsController::class, 'show'])->name('show');
    Route::put('update/{id}', [ProductsController::class, 'update'])->name('update');
    Route::delete('delete/{id}', [ProductsController::class, 'destroy'])->name('destroy');
});


// Services Group
Route::prefix('Services')->name('Services.')->group(function () {
    Route::get('/', [ServicesController::class, 'index'])->name('index');
    Route::get('/{id}', [ServicesController::class, 'show'])->name('show');
    Route::post('submit', [ServicesController::class, 'submit'])->name('submit');
});

// Contact Group
Route::prefix('Contact')->name('Contact.')->group(function () {
    Route::get('/', [ContactController::class, 'index'])->name('index');
    Route::post('submit', [ContactController::class, 'submit'])->name('submit');
});

Route::prefix('stay-connected')->name('stay-connected.')->group(function () {
    Route::get('/', [ContactController::class, 'StayConnected'])->name('StayConnected');
});

// Login Group
Route::prefix('Login')->name('Login.')->group(function () {
    Route::get('/', [LoginController::class, 'index'])->name('index');
    Route::post('submit', [LoginController::class, 'submit'])->name('submit');
});

Route::prefix('/admin/login')->name('AdministratorLogin.')->group(function () {

    Route::get('/', [Admin_LoginController::class, 'index'])->name('index');
    Route::post('/', [Admin_LoginController::class, 'submit'])->name('submit');
});

// doctor login
Route::prefix('/doctor/login')->name('DoctorLogin.')->group(function () {
    Route::get('/', [Doctor_LoginController::class, 'index'])->name('index');
    Route::post('/', [Doctor_LoginController::class, 'submit'])->name('submit');
});
//staff login
Route::prefix('/staff/login')->name('StaffLogin.')->group(function () {
    Route::get('/', [Staff_LoginController::class, 'index'])->name('index');
    Route::post('/', [Staff_LoginController::class, 'submit'])->name('submit');
});




// Register Group
Route::prefix('Register')->name('Register.')->group(function () {
    Route::get('/', [RegisterController::class, 'index'])->name('index');
    Route::post('submit', [RegisterController::class, 'submit'])->name('submit');
});

// user
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\User_ServicesController;
use App\Http\Controllers\User\User_ProductsController;
use App\Http\Controllers\User\User_CartController;
use App\Http\Controllers\User\User_WishlistController;
use App\Http\Controllers\User\User_OrderController;
use App\Http\Controllers\User\User_CheckoutController;
use App\Http\Controllers\User\User_EyeLensController;
use App\Http\Controllers\User\User_AppointmentController;
use App\Http\Controllers\User\User_PaymentController;


use App\Http\Middleware\UsersMiddleware;


Route::prefix('User')
    ->name('User.')
    ->middleware(UsersMiddleware::class)
    ->group(function () {

        /* ================= Homepage ================= */
        Route::get('', [UserController::class, 'index'])
            ->name('Homepage.index');

        Route::post('logout', [LoginController::class, 'logout'])
            ->name('logout');


        /* ================= Services ================= */
        Route::prefix('services')
            ->name('services.')
            ->group(function () {

                Route::get('/', [User_ServicesController::class, 'index'])
                    ->name('index');

                /* -------- Prescription Glasses -------- */
                Route::prefix('PrescriptionGlasses')
                    ->name('PrescriptionGlasses.')
                    ->group(function () {

                        Route::get('/', [User_ServicesController::class, 'indexPrescription'])
                            ->name('index');

                        Route::get('/create', [User_ServicesController::class, 'createPrescription'])
                            ->name('create');

                        Route::post('/FrameForPrescriptionGlasses', [User_ServicesController::class, 'FrameForPrescriptionGlasses'])
                            ->name('FrameForPrescriptionGlasses');

                        Route::post('/store', [User_ServicesController::class, 'storePrescription'])
                            ->name('store');

                        Route::get('/edit/{id}', [User_ServicesController::class, 'editPrescription'])
                            ->name('edit');

                        Route::put('/update/{id}', [User_ServicesController::class, 'updatePrescription'])
                            ->name('update');

                        Route::delete('/delete/{id}', [User_ServicesController::class, 'deletePrescription'])
                            ->name('destroy');
                    });


                /* -------- Lens Replacement -------- */
                Route::prefix('Lens')
                    ->name('LensReplacement.')
                    ->group(function () {

                        Route::get('/', [User_EyeLensController::class, 'index'])
                            ->name('index');

                        Route::get('/create', [User_EyeLensController::class, 'create'])
                            ->name('create');

                        Route::post('/store', [User_EyeLensController::class, 'store'])
                            ->name('store');

                        Route::get('/{id}', [User_EyeLensController::class, 'show'])
                            ->name('show');

                        Route::put('/update/{id}', [User_EyeLensController::class, 'update'])
                            ->name('update');

                        Route::delete('/delete/{id}', [User_EyeLensController::class, 'destroy'])
                            ->name('destroy');
                    });


                /* -------- Appointment -------- */
                Route::prefix('appointment')
                    ->name('appointment.')
                    ->group(function () {

                        Route::get('/', [User_AppointmentController::class, 'index'])
                            ->name('index');

                        Route::get('/create', [User_AppointmentController::class, 'create'])
                            ->name('create');

                        Route::post('/', [User_AppointmentController::class, 'store'])
                            ->name('store');

                        Route::get('/fetch-doctors/{page?}', [User_AppointmentController::class, 'fetchDoctors'])
                            ->name('fetchDoctors');

                        Route::get('/{id}', [User_AppointmentController::class, 'show'])
                            ->name('show');

                        Route::get('/{id}/edit', [User_AppointmentController::class, 'edit'])
                            ->name('edit');

                        Route::put('/{id}', [User_AppointmentController::class, 'update'])
                            ->name('update');

                        Route::delete('/{id}', [User_AppointmentController::class, 'destroy'])
                            ->name('destroy');
                    });
            });


        /* ================= Products ================= */
        Route::prefix('products')
            ->name('products.')
            ->group(function () {

                Route::get('/{type?}', [User_ProductsController::class, 'index'])
                    ->name('index');

                Route::get('/', [User_ProductsController::class, 'create'])
                    ->name('create');

                Route::post('/', [User_ProductsController::class, 'store'])
                    ->name('store');

                Route::get('/{id}', [User_ProductsController::class, 'show'])
                    ->name('show');

                Route::get('/{id}/edit', [User_ProductsController::class, 'edit'])
                    ->name('edit');

                Route::put('/{id}', [User_ProductsController::class, 'update'])
                    ->name('update');

                Route::delete('/{id}', [User_ProductsController::class, 'destroy'])
                    ->name('destroy');
            });


        /* ================= Cart ================= */
        Route::prefix('cart')
            ->name('cart.')
            ->group(function () {

                Route::get('/', [User_CartController::class, 'index'])
                    ->name('index');

                Route::post('/add/{id}', [User_CartController::class, 'store'])
                    ->name('store');

                Route::post('/', [User_CartController::class, 'storeMultipleItems'])
                    ->name('storeMultipleItems');

                Route::put('/update/{id}', [User_CartController::class, 'update'])
                    ->name('update');

                Route::delete('/remove/{id}', [User_CartController::class, 'destroy'])
                    ->name('destroy');

                Route::get('/count', [User_CartController::class, 'count'])
                    ->name('count');

                Route::delete('/clear', [User_CartController::class, 'clear'])
                    ->name('clear');
            });


        /* ================= Checkout ================= */
        Route::prefix('checkout')
            ->name('checkout.')
            ->group(function () {

                Route::get('/', [User_CheckoutController::class, 'index'])
                    ->name('index');

                Route::post('/store', [User_CheckoutController::class, 'store'])
                    ->name('store');

                Route::put('/update/{id}', [User_CheckoutController::class, 'update'])
                    ->name('update');

                Route::delete('/remove/{id}', [User_CheckoutController::class, 'destroy'])
                    ->name('destroy');

                Route::get('/count', [User_CheckoutController::class, 'count'])
                    ->name('count');
            });


        /* ================= Wishlist ================= */
        Route::prefix('wishlist')
            ->name('wishlist.')
            ->group(function () {

                Route::get('/', [User_WishlistController::class, 'index'])
                    ->name('index');

                Route::post('/{id}', [User_WishlistController::class, 'store'])
                    ->name('store');

                Route::delete('/{id}', [User_WishlistController::class, 'destroy'])
                    ->name('destroy');

                Route::get('/count', [User_WishlistController::class, 'count'])
                    ->name('count');
            });


        /* ================= Orders ================= */
        Route::prefix('orders')
            ->name('orders.')
            ->group(function () {

                Route::get('/', [User_OrderController::class, 'index'])
                    ->name('index');

                Route::post('/', [User_OrderController::class, 'store'])
                    ->name('store');

                Route::get('/{id}', [User_OrderController::class, 'show'])
                    ->name('show');

                Route::put('/{id}', [User_OrderController::class, 'update'])
                    ->name('update');

                Route::delete('/{id}', [User_OrderController::class, 'destroy'])
                    ->name('destroy');
            });


        /* ================= Payment ================= */
        Route::prefix('payment')
            ->name('payment.')
            ->group(function () {

                Route::get('/{order_no}', [User_PaymentController::class, 'index'])
                    ->name('index');

                Route::get('json/{order_no}', [User_PaymentController::class, 'showOrderJson'])
                    ->name('json');
            });
    });


// admin
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\Admin_DashboardController;
use App\Http\Controllers\Admin\Admin_SettingController;
use App\Http\Controllers\Admin\Admin_CategoriesController;
use App\Http\Controllers\Admin\Admin_ProductsController;
use App\Http\Controllers\Admin\Admin_AboutController;
use App\Http\Controllers\Admin\Admin_AccessoriesController;
use App\Http\Controllers\Admin\Admin_NavigationLinksController;
use App\Http\Controllers\Admin\Admin_CompanyBrandController;
use App\Http\Controllers\Admin\Admin_ContactController;
use App\Http\Controllers\Admin\Admin_CopyrightController;
use App\Http\Controllers\Admin\Admin_GlassesBrandsController;
use App\Http\Controllers\Admin\Admin_GlassesColorController;
use App\Http\Controllers\Admin\Admin_GlassesStylesController;
use App\Http\Controllers\Admin\Admin_GlassesUsagesController;
use App\Http\Controllers\Admin\Admin_ProductTypesController;
use App\Http\Controllers\Admin\Admin_ServicesController;
use App\Http\Controllers\Admin\Admin_SocialsController;
use App\Http\Controllers\Admin\Admin_AppointmentController;
use App\Http\Controllers\Admin\Admin_OrdersController;
use App\Http\Controllers\Admin\Admin_StaffController;
use App\Http\Controllers\Admin\Admin_UsersController;
use App\Http\Controllers\Admin\Admin_DoctorsController;
use App\Http\Controllers\Admin\Admin_SuppliersController;
use App\Http\Controllers\Admin\Admin_SalesController;


use App\Http\Middleware\AdminMiddleware;


Route::prefix('Administrator')
    ->name('Administrator.')
    ->middleware(AdminMiddleware::class)
    ->group(function () {

        // Homepage
        Route::get('', [AdminController::class, 'index'])
            ->name('Homepage.index');

        // Dashboard
        Route::get('dashboard', [Admin_DashboardController::class, 'index'])
            ->name('Dashboard.index');
        Route::get('dashboard/ajax-data', [Admin_DashboardController::class, 'ajaxDashboardData'])->name('ajaxDashboardData');

        /*
        |--------------------------------------------------------------------------
        | Products
        |--------------------------------------------------------------------------
        */
        Route::prefix('Products')->name('Products.')->group(function () {
            Route::get('/', [Admin_ProductsController::class, 'index'])->name('index');
            Route::get('/create', [Admin_ProductsController::class, 'create'])->name('create');
            Route::post('/', [Admin_ProductsController::class, 'store'])->name('store');
            Route::get('/{id}', [Admin_ProductsController::class, 'show'])->name('show');
            Route::get('/{id}/edit', [Admin_ProductsController::class, 'edit'])->name('edit');
            Route::put('/{id}', [Admin_ProductsController::class, 'update'])->name('update');
            Route::delete('/{id}', [Admin_ProductsController::class, 'destroy'])->name('destroy');
            Route::delete('/bulk-delete', [Admin_ProductsController::class, 'bulkDelete'])->name('bulkDelete');
        });

        /*
|--------------------------------------------------------------------------
| Sales report
|--------------------------------------------------------------------------
*/
Route::prefix('Sales')->name('Sales.')->group(function () {
    Route::get('/', [Admin_SalesController::class, 'index'])->name('index');

    // AJAX routes
    Route::get('/filter-date', [Admin_SalesController::class, 'filterByDate'])->name('filterDate');
    Route::get('/search', [Admin_SalesController::class, 'searchOrders'])->name('search');
    Route::get('/paginate', [Admin_SalesController::class, 'paginateOrders'])->name('paginate');
});

        /*
        |--------------------------------------------------------------------------
        | Categories
        |--------------------------------------------------------------------------
        */
        Route::get('Categories', [Admin_CategoriesController::class, 'index'])->name('Categories.index');
        Route::get('Categories/create', [Admin_CategoriesController::class, 'create'])->name('Categories.create');
        Route::post('Categories', [Admin_CategoriesController::class, 'store'])->name('Categories.store');
        Route::get('Categories/{id}', [Admin_CategoriesController::class, 'show'])->name('Categories.show');
        Route::get('Categories/{id}/edit', [Admin_CategoriesController::class, 'edit'])->name('Categories.edit');
        Route::put('Categories/{id}', [Admin_CategoriesController::class, 'update'])->name('Categories.update');
        Route::delete('Categories/{id}', [Admin_CategoriesController::class, 'destroy'])->name('Categories.delete');



        /*
        |--------------------------------------------------------------------------
        | Accessories
        |--------------------------------------------------------------------------
        */
        Route::get('Accessories', [Admin_AccessoriesController::class, 'index'])->name('Accessories.index');
        Route::get('Accessories/create', [Admin_AccessoriesController::class, 'create'])->name('Accessories.create');
        Route::post('Accessories', [Admin_AccessoriesController::class, 'store'])->name('Accessories.store');
        Route::get('Accessories/{id}', [Admin_AccessoriesController::class, 'show'])->name('Accessories.show');
        Route::get('Accessories/{id}/edit', [Admin_AccessoriesController::class, 'edit'])->name('Accessories.edit');
        Route::put('Accessories/{id}', [Admin_AccessoriesController::class, 'update'])->name('Accessories.update');
        Route::delete('Accessories/{id}', [Admin_AccessoriesController::class, 'destroy'])->name('Accessories.delete');

        /*
        |--------------------------------------------------------------------------
        | Product Types
        |--------------------------------------------------------------------------
        */
        Route::get('Product_Types', [Admin_ProductTypesController::class, 'index'])->name('Product_Types.index');
        Route::get('Product_Types/create', [Admin_ProductTypesController::class, 'create'])->name('Product_Types.create');
        Route::post('Product_Types', [Admin_ProductTypesController::class, 'store'])->name('Product_Types.store');
        Route::get('Product_Types/{id}', [Admin_ProductTypesController::class, 'show'])->name('Product_Types.show');
        Route::get('Product_Types/{id}/edit', [Admin_ProductTypesController::class, 'edit'])->name('Product_Types.edit');
        Route::put('Product_Types/{id}', [Admin_ProductTypesController::class, 'update'])->name('Product_Types.update');
        Route::delete('Product_Types/{id}', [Admin_ProductTypesController::class, 'destroy'])->name('Product_Types.delete');


        Route::prefix('Glasses')->name('Glasses.')->group(function () {
            /*
                 |--------------------------------------------------------------------------
                 | Glasses Colors
                 |--------------------------------------------------------------------------
                 */
            Route::get('Colors', [Admin_GlassesColorController::class, 'index'])->name('Colors.index');
            Route::get('Colors/create', [Admin_GlassesColorController::class, 'create'])->name('Colors.create');
            Route::post('Colors', [Admin_GlassesColorController::class, 'store'])->name('Colors.store');
            Route::get('Colors/{id}', [Admin_GlassesColorController::class, 'show'])->name('Colors.show');
            Route::get('Colors/{id}/edit', [Admin_GlassesColorController::class, 'edit'])->name('Colors.edit');
            Route::put('Colors/{id}', [Admin_GlassesColorController::class, 'update'])->name('Colors.update');
            Route::delete('Colors/{id}', [Admin_GlassesColorController::class, 'destroy'])->name('Colors.delete');


            /*
            |--------------------------------------------------------------------------
            | Glasses Styles
            |--------------------------------------------------------------------------
            */
            Route::get('Styles', [Admin_GlassesStylesController::class, 'index'])->name('Styles.index');
            Route::get('Styles/create', [Admin_GlassesStylesController::class, 'create'])->name('Styles.create');
            Route::post('Styles', [Admin_GlassesStylesController::class, 'store'])->name('Styles.store');
            Route::get('Styles/{id}', [Admin_GlassesStylesController::class, 'show'])->name('Styles.show');
            Route::get('Styles/{id}/edit', [Admin_GlassesStylesController::class, 'edit'])->name('Styles.edit');
            Route::put('Styles/{id}', [Admin_GlassesStylesController::class, 'update'])->name('Styles.update');
            Route::delete('Styles/{id}', [Admin_GlassesStylesController::class, 'destroy'])->name('Styles.delete');

            /*
            |--------------------------------------------------------------------------
            | Glasses Usages
            |--------------------------------------------------------------------------
            */
            Route::get('Usages', [Admin_GlassesUsagesController::class, 'index'])->name('Usages.index');
            Route::get('Usages/create', [Admin_GlassesUsagesController::class, 'create'])->name('Usages.create');
            Route::post('Usages', [Admin_GlassesUsagesController::class, 'store'])->name('Usages.store');
            Route::get('Usages/{id}', [Admin_GlassesUsagesController::class, 'show'])->name('Usages.show');
            Route::get('Usages/{id}/edit', [Admin_GlassesUsagesController::class, 'edit'])->name('Usages.edit');
            Route::put('Usages/{id}', [Admin_GlassesUsagesController::class, 'update'])->name('Usages.update');
            Route::delete('Usages/{id}', [Admin_GlassesUsagesController::class, 'destroy'])->name('Usages.delete');

            /*
                   |--------------------------------------------------------------------------
                   | glasses Brands
                   |--------------------------------------------------------------------------
                   */
            Route::get('Brands', [Admin_GlassesBrandsController::class, 'index'])->name('Brands.index');
            Route::get('Brands/create', [Admin_GlassesBrandsController::class, 'create'])->name('Brands.create');
            Route::post('Brands', [Admin_GlassesBrandsController::class, 'store'])->name('Brands.store');
            Route::get('Brands/{id}', [Admin_GlassesBrandsController::class, 'show'])->name('Brands.show');
            Route::get('Brands/{id}/edit', [Admin_GlassesBrandsController::class, 'edit'])->name('Brands.edit');
            Route::put('Brands/{id}', [Admin_GlassesBrandsController::class, 'update'])->name('Brands.update');
            Route::delete('Brands/{id}', [Admin_GlassesBrandsController::class, 'destroy'])->name('Brands.delete');

        });
        /*
                 |--------------------------------------------------------------------------
                 | company Brands
                 |--------------------------------------------------------------------------
                 */
        Route::get('Brand', [Admin_CompanyBrandController::class, 'index'])->name('Brand.index');
        Route::get('Brand/create', [Admin_CompanyBrandController::class, 'create'])->name('Brand.create');
        Route::post('Brand', [Admin_CompanyBrandController::class, 'store'])->name('Brand.store');
        Route::get('Brand/{id}', [Admin_CompanyBrandController::class, 'show'])->name('Brand.show');
        Route::get('Brand/{id}/edit', [Admin_CompanyBrandController::class, 'edit'])->name('Brand.edit');
        Route::put('Brand/{id}', [Admin_CompanyBrandController::class, 'update'])->name('Brand.update');
        Route::delete('Brand/{id}', [Admin_CompanyBrandController::class, 'destroy'])->name('Brand.delete');
        /*
        |--------------------------------------------------------------------------
        | Services
        |--------------------------------------------------------------------------
        */
        Route::get('Services', [Admin_ServicesController::class, 'index'])->name('Services.index');
        Route::get('Services/create', [Admin_ServicesController::class, 'create'])->name('Services.create');
        Route::post('Services', [Admin_ServicesController::class, 'store'])->name('Services.store');
        Route::get('Services/{id}', [Admin_ServicesController::class, 'show'])->name('Services.show');
        Route::get('Services/{id}/edit', [Admin_ServicesController::class, 'edit'])->name('Services.edit');
        Route::put('Services/{id}', [Admin_ServicesController::class, 'update'])->name('Services.update');
        Route::delete('Services/{id}', [Admin_ServicesController::class, 'destroy'])->name('Services.delete');

        /*
        |--------------------------------------------------------------------------
        | Settings
        |--------------------------------------------------------------------------
        */
        Route::get('Settings', [Admin_SettingController::class, 'index'])->name('Settings.index');
        Route::get('Settings/create', [Admin_SettingController::class, 'create'])->name('Settings.create');
        Route::post('Settings', [Admin_SettingController::class, 'store'])->name('Settings.store');
        Route::get('Settings/{id}', [Admin_SettingController::class, 'show'])->name('Settings.show');
        Route::get('Settings/{id}/edit', [Admin_SettingController::class, 'edit'])->name('Settings.edit');
        Route::put('Settings/{id}', [Admin_SettingController::class, 'update'])->name('Settings.update');
        Route::delete('Settings/{id}', [Admin_SettingController::class, 'destroy'])->name('Settings.delete');

        /*
        |--------------------------------------------------------------------------
        | Administrators
        |--------------------------------------------------------------------------
        */
        Route::get('Administrators', [AdminController::class, 'index'])->name('Administrators.index');
        Route::get('Administrators/create', [AdminController::class, 'create'])->name('Administrators.create');
        Route::post('Administrators', [AdminController::class, 'store'])->name('Administrators.store');
        Route::get('Administrators/{id}', [AdminController::class, 'show'])->name('Administrators.show');
        Route::get('Administrators/{id}/edit', [AdminController::class, 'edit'])->name('Administrators.edit');
        Route::put('Administrators/{id}', [AdminController::class, 'update'])->name('Administrators.update');
        Route::delete('Administrators/{id}', [AdminController::class, 'destroy'])->name('Administrators.delete');

        /*
        |--------------------------------------------------------------------------
        | Contacts
        |--------------------------------------------------------------------------
        */
        Route::get('Contacts', [Admin_ContactController::class, 'index'])->name('Contacts.index');
        Route::get('Contacts/create', [Admin_ContactController::class, 'create'])->name('Contacts.create');
        Route::post('Contacts', [Admin_ContactController::class, 'store'])->name('Contacts.store');
        Route::get('Contacts/{id}', [Admin_ContactController::class, 'show'])->name('Contacts.show');
        Route::get('Contacts/{id}/edit', [Admin_ContactController::class, 'edit'])->name('Contacts.edit');
        Route::put('Contacts/{id}', [Admin_ContactController::class, 'update'])->name('Contacts.update');
        Route::delete('Contacts/{id}', [Admin_ContactController::class, 'destroy'])->name('Contacts.delete');

        /*
        |--------------------------------------------------------------------------
        | About
        |--------------------------------------------------------------------------
        */
        Route::get('About', [Admin_AboutController::class, 'index'])->name('About.index');
        Route::get('About/create', [Admin_AboutController::class, 'create'])->name('About.create');
        Route::post('About', [Admin_AboutController::class, 'store'])->name('About.store');
        Route::get('About/{id}', [Admin_AboutController::class, 'show'])->name('About.show');
        Route::get('About/{id}/edit', [Admin_AboutController::class, 'edit'])->name('About.edit');
        Route::put('About/{id}', [Admin_AboutController::class, 'update'])->name('About.update');
        Route::delete('About/{id}', [Admin_AboutController::class, 'destroy'])->name('About.delete');

        /*
        |--------------------------------------------------------------------------
        | Socials
        |--------------------------------------------------------------------------
        */
        Route::get('Socials', [Admin_SocialsController::class, 'index'])->name('Socials.index');
        Route::get('Socials/create', [Admin_SocialsController::class, 'create'])->name('Socials.create');
        Route::post('Socials', [Admin_SocialsController::class, 'store'])->name('Socials.store');
        Route::get('Socials/{id}', [Admin_SocialsController::class, 'show'])->name('Socials.show');
        Route::get('Socials/{id}/edit', [Admin_SocialsController::class, 'edit'])->name('Socials.edit');
        Route::put('Socials/{id}', [Admin_SocialsController::class, 'update'])->name('Socials.update');
        Route::delete('Socials/{id}', [Admin_SocialsController::class, 'destroy'])->name('Socials.delete');

        /*
        |--------------------------------------------------------------------------
        | Copyrights
        |--------------------------------------------------------------------------
        */
        Route::get('Copyrights', [Admin_CopyrightController::class, 'index'])->name('Copyrights.index');
        Route::get('Copyrights/create', [Admin_CopyrightController::class, 'create'])->name('Copyrights.create');
        Route::post('Copyrights', [Admin_CopyrightController::class, 'store'])->name('Copyrights.store');
        Route::get('Copyrights/{id}', [Admin_CopyrightController::class, 'show'])->name('Copyrights.show');
        Route::get('Copyrights/{id}/edit', [Admin_CopyrightController::class, 'edit'])->name('Copyrights.edit');
        Route::put('Copyrights/{id}', [Admin_CopyrightController::class, 'update'])->name('Copyrights.update');
        Route::delete('Copyrights/{id}', [Admin_CopyrightController::class, 'destroy'])->name('Copyrights.delete');

        /*
        |--------------------------------------------------------------------------
        | Navigation Links
        |--------------------------------------------------------------------------
        */
        Route::get('Navigation', [Admin_NavigationLinksController::class, 'index'])->name('Navigation.index');
        Route::get('Navigation/create', [Admin_NavigationLinksController::class, 'create'])->name('Navigation.create');
        Route::post('Navigation', [Admin_NavigationLinksController::class, 'store'])->name('Navigation.store');
        Route::get('Navigation/{id}', [Admin_NavigationLinksController::class, 'show'])->name('Navigation.show');
        Route::get('Navigation/{id}/edit', [Admin_NavigationLinksController::class, 'edit'])->name('Navigation.edit');
        Route::put('Navigation/{id}', [Admin_NavigationLinksController::class, 'update'])->name('Navigation.update');
        Route::delete('Navigation/{id}', [Admin_NavigationLinksController::class, 'destroy'])->name('Navigation.delete');


        //appointments
        Route::prefix('Appointment')->name('Appointment.')->group(function () {
            Route::get('/', [Admin_AppointmentController::class, 'index'])->name('index');
            Route::get('/{id}', [Admin_AppointmentController::class, 'show'])->name('show');
            //store
            Route::post('/', [Admin_AppointmentController::class, 'store'])->name('store');
            Route::put('/{id}', [Admin_AppointmentController::class, 'update'])->name('update');

            Route::delete('/{id}', [Admin_AppointmentController::class, 'destroy'])->name('destroy');
        });
        //orders
        // routes/web.php
        Route::prefix('Orders')->name('Orders.')->group(function () {
            Route::get('/', [Admin_OrdersController::class, 'index'])->name('index');
            Route::get('/{id}', [Admin_OrdersController::class, 'show'])->name('show');
            Route::put('/{id}', [Admin_OrdersController::class, 'update'])->name('update');
            Route::delete('/{id}', [Admin_OrdersController::class, 'destroy'])->name('destroy');

            // New route for AJAX status update
            Route::post('/{id}/status', [Admin_OrdersController::class, 'updateStatus'])->name('updateStatus');
        });

        //users, Staff, suppliers, doctors routes can be added here
        Route::prefix('Users')->name('UsersManagement.')->group(function () {
            Route::get('/', [Admin_UsersController::class, 'index'])->name('index');

            Route::post('/', [Admin_UsersController::class, 'store'])->name('store');
            Route::get('/{id}', [Admin_UsersController::class, 'edit'])->name('edit');
            Route::post('/{id}', [Admin_UsersController::class, 'update'])->name('update');
            Route::delete('/{id}', [Admin_UsersController::class, 'destroy'])->name('delete');
        });

        Route::prefix('Staff')->name('Staff.')->group(function () {
            Route::get('/', [Admin_StaffController::class, 'index'])->name('index');
        });
        Route::prefix('Suppliers')->name('Suppliers.')->group(function () {
            Route::get('/', [Admin_SuppliersController::class, 'index'])->name('index');
        });
        Route::prefix('Doctors')->name('Doctors.')->group(function () {
            Route::get('/', [Admin_DoctorsController::class, 'index'])->name('index');
        });

        /*
        |--------------------------------------------------------------------------
        | Logout
        |--------------------------------------------------------------------------
        */
        Route::post('logout', [Admin_LoginController::class, 'logout'])
            ->name('logout');
    });




//fallback Route

Route::fallback([\App\Http\Controllers\ErrorController::class, 'handle404']);
