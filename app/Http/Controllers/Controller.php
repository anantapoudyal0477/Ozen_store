<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\Accessories;
use App\Models\Administrator;
use App\Models\AdminNavigationLinks;
use App\Models\AdminPasswordResets;
use App\Models\Brand;
use App\Models\Cart;
use App\Models\Categories;
use App\Models\CompanyBrand;
use App\Models\Contacts;
use App\Models\Copyright;
use App\Models\Dashboard;
use App\Models\Footer;
use App\Models\GlassesBrands;
use App\Models\GlassesColor;
use App\Models\GlassesMaterial;
use App\Models\GlassesStyles;
use App\Models\GlassesUsages;
use App\Models\Header;
use App\Models\Login;
use App\Models\Navigation;
use App\Models\Products;
use App\Models\ProductTypes;
use App\Models\Register;
use App\Models\Services;
use App\Models\Setting;
use App\Models\Socials;
use App\Models\User;
use App\Models\UserNavigationLinks;
use App\Models\ViewerHomeFeatures;
use App\Models\ViewerHomeHero;
use App\Models\ViewerHomeHeroStats;
use App\Models\ViewerHome_cta;

use Exception;
use Illuminate\Support\Facades\Log;

abstract class Controller
{
    /** @var string */
    protected string $pageTitle = '';

    /** @var array */
    protected array $messages = [
        'email.required' => 'Please enter your email address.',
        'email.email' => 'Please enter a valid email address.',
        'email.exists' => 'This email is not registered.',
        'password.required' => 'Please enter your password.',
        'password.min' => 'Password must be at least 6 characters long.',
    ];
    /**
     * Set page title
     */
    protected function setPageTitle(string $title, ?string $brandName = null): void
    {
        if (empty($brandName)) {
            $this->pageTitle = $title;
        } else {
            $this->pageTitle = $title . ' - ' . $brandName;
        }

        view()->share('pageTitle', $this->pageTitle);
    }


    /**
     * Get page title
     */
    public function getPageTitle(): string
    {
        return $this->pageTitle;
    }

    /**********************************************************************/
    /*******************VIEWER      PAGE        ***************************/
    /**********************************************************************/
    /**********************************************************************/
    /**********************************************************************/

    /**
     * Get common data for views
     */
  public static function getCommonData(): array
{
    try {
        return [
            'brand' => CompanyBrand::first() ?? null,
            'contact' => [
                'Phone' => Contacts::first()->Phone ?? 'N/A',
                'Email' => Contacts::first()->Email ?? 'N/A',
                'Address' => Contacts::first()->Address ?? 'N/A',
            ],
            'copyright' => Copyright::first() ?? null,
            'links' => Navigation::where('is_active', true)->orderBy('order')->get(),
            'socials' => Socials::all(),
        ];
    } catch (Exception $e) {
        Log::error('Error fetching common data: ' . $e->getMessage());
        return [
            'brand' => null,
            'contact' => [],
            'copyright' => null,
            'links' => collect(),
            'socials' => collect(),
        ];
    }
}

    /**
     * Render viewer pages with common data
     */
   protected function renderViewerPage(string $view, string $title, array $additionalData = [])
{
    try {
        $data = $this->getCommonData();

        $brand = $data['brand'] ?? null;
        $links = $data['links'] ?? collect();
        $socials = $data['socials'] ?? collect();
        $copyright = $data['copyright'] ?? [];
        $contact = $data['contact'] ?? [];

        $this->setPageTitle($title, $brand['company_brand_name'] ?? null);

        $viewData = array_merge([
            'brand' => $brand,
            'contact' => $contact,
            'copyright' => $copyright,
            'socials' => $socials,
            'links' => $links,
        ], $additionalData);

        return view($view, $viewData);

    } catch (\Exception $e) {
        Log::error("Error rendering viewer page '{$view}': " . $e->getMessage());

        return response()->view('Error.Errorpage', [
            'message' => 'Sorry, something went wrong while loading this page.'
        ], 500);
    }
}


    protected function renderErrorPage(string $view, string $title, int $errorCode = 404)
    {
        try {
            $data = $this->getCommonData();
            $brand = $data['brand'] ?? null;
            $links = $data['links'] ?? [];
            $socials = $data['social'] ?? [];
            $copyright = $data['copyright'] ?? [];
            $contact = $data['contact'] ?? [];

            $this->setPageTitle($title, $brand['company_brand_name'] ?? null);

            // Merge optional additional data
            $viewData = array_merge([
                // 'PageData'   => $PageData,
                // 'FooterData' => $FooterData,
                'brand' => $brand,
                'contact' => $contact,
                'copyright' => $copyright,
                'socials' => $socials,
                'links' => $links,
            ]);
            return view($view, $viewData);
        } catch (\Exception $e) {
            Log::error("Error rendering Error page '{$view}': " . $e->getMessage());

            return response()->view('Error.Errorpage', [
                'message' => 'Sorry, something went wrong while loading this page.'
            ], 500);
        }
    }


    /**********************************************************************/
    /*******************   ADMIN      PAGE      ***************************/
    /**********************************************************************/
    /**********************************************************************/
    /**********************************************************************/


    /**
     * Fetch all model data for admin panel
     */
   protected function fetchAllModelDataForAdmin(): array
{
    $models = [
        'about' => About::class,
        'accessories' => Accessories::class,
        'admin_navigation' => AdminNavigationLinks::class,
        'brand' => Brand::class,
        'categories' => Categories::class,
        'company_brand' => CompanyBrand::class,
        'contacts' => Contacts::class,
        'copyright' => Copyright::class,
        'dashboard' => Dashboard::class,
        'footer' => Footer::class,
        'glasses_brands' => GlassesBrands::class,
        'glasses_colors' => GlassesColor::class,
        'glasses_styles' => GlassesStyles::class,
        'glasses_usages' => GlassesUsages::class,
        'header' => Header::class,
        'login' => Login::class,
        'navigation' => Navigation::class,
        'products' => Products::class,
        'product_types' => ProductTypes::class,
        'register' => Register::class,
        'services' => Services::class,
        'settings' => Setting::class,
        'socials' => Socials::class,
        'users' => User::class,
        'viewer_home_features' => ViewerHomeFeatures::class,
        'viewer_home_hero' => ViewerHomeHero::class,
        'viewer_home_hero_stats' => ViewerHomeHeroStats::class,
        'viewer_home_cta' => ViewerHome_cta::class,
    ];

    $singleRowModels = ['about','brand','company_brand','contacts','copyright'];

    try {
        foreach ($models as $key => $model) {
            $models[$key] = in_array($key, $singleRowModels)
                ? $model::first()
                : $model::all();
        }
        return $models;

    } catch (\Exception $ex) {
        Log::error('Error fetching admin data: ' . $ex->getMessage());

        foreach ($models as $key => $model) {
            $models[$key] = in_array($key, $singleRowModels)
                ? null
                : collect();
        }

        return $models;
    }
}


    /**
     * Render Admin View Pages (with all models)
     */
protected function renderAdminViewPage(string $view, string $title, array $additionalData = [])
{
    try {
        $data = $this->fetchAllModelDataForAdmin();

        // Safely get single-row models (may be null)
        $companyBrand = $data['company_brand'] ?? null;
        $brand = $data['brand'] ?? null;

        // Determine which brand name to use for the title
        $brandName = $companyBrand->company_brand_name
            ?? $brand->name
            ?? null;

        // Set page title dynamically
        $this->setPageTitle($title, $brandName);

        // Merge all data with any additional custom view data
        $viewData = array_merge($data, $additionalData);

        return view($view, $viewData);
    } catch (\Exception $e) {
        Log::error("Error rendering admin view '{$view}': " . $e->getMessage());

        return response()->view('Error.Administrator.ErrorPage', [
            'message' => 'Sorry, something went wrong while loading this page.'
        ], 500);
    }
}


    /**********************************************************************/
    /*******************   USER      PAGE      ***************************/
    /**********************************************************************/
    /**********************************************************************/
    /**********************************************************************/

    protected function fetchAllModelDataForUser(): array
    {
        $models = [
            'User' => User::class,
            'User_navigation' => UserNavigationLinks::class,
            'company_brand' => CompanyBrand::class,
            'contacts' => Contacts::class,
            'footer' => Footer::class,
            'socials' => Socials::class,
            'copyright' => Copyright::class,
        ];

        try {
            foreach ($models as $key => $model) {
                // Use first() for single-row tables, all() for others
                $models[$key] = in_array($key, [
                    'company_brand',
                    'contacts',
                    'copyright'
                ])
                    ? $model::first()
                    : $model::all();
            }
            return $models;
        } catch (\Exception $ex) {
            Log::error('Error fetching admin data: ' . $ex->getMessage());
            foreach ($models as $key => $model) {
                $models[$key] = in_array($key, [
                    'about',
                    'brand',
                    'company_brand',
                    'contacts',
                    'copyright'
                ])
                    ? null
                    : collect();
            }
            return $models;
        }
    }


        /**
         * Render user View Pages (with all models)
         */
        protected function renderUserViewPage(string $view, string $title, array $additionalData = [])
        {
            try {
                $data = $this->fetchAllModelDataForUser();

                // Dynamically extract all keys to variables
                // extract($data);

                // Determine which brand name to use for the title
                $brandName = $company_brand->company_brand_name
                    ?? ($brand->company_brand_name ?? null);

                // Set page title dynamically
                $this->setPageTitle($title, $brandName);

                // Merge all data with any additional custom view data
                $viewData = array_merge($data, $additionalData);

                // Debug check (optional)
                // dd($viewData);
                // dd($view);

                return view($view, $viewData);
            } catch (\Exception $e) {
                Log::error("Error rendering admin view '{$view}': " . $e->getMessage());

                return response()->view('Error.User.404', [
                    'message' => 'Sorry, something went wrong while loading this page.'
                ], 500);
            }
        }



}
