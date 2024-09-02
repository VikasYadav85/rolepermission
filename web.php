<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\str;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\WhoweareController;
use App\Http\Controllers\OurVisionController;
use App\Http\Controllers\OurMissionController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\EducationController;
use App\Http\Controllers\JobPostController;
use App\Http\Controllers\SustainabilityController;
use App\Http\Controllers\OurHistoryController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\PlantNumberController;
use App\Http\Controllers\AppsController;
use App\Http\Controllers\TermsController;
use App\Http\Controllers\ApplyNowController;
use App\Http\Controllers\CareerController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PrivacyCenterController;
use App\Http\Controllers\SignupController;
use App\Http\Controllers\ProductsTimelineController;
use App\Http\Controllers\AboutUsController;
use App\Http\Controllers\AwardsController;
use App\Http\Controllers\HomeAboutusController;
use App\Http\Controllers\HomeSustainabilityController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeCareersController;
use App\Http\Controllers\HomebrandController;
use App\Http\Controllers\HomeBrandsController;
use App\Http\Controllers\BrandBannerController;
use App\Http\Controllers\GalleryImagesController;
use App\Http\Controllers\TeambannerController;
use App\Http\Controllers\ProductNumberController;
use App\Http\Controllers\FrontController\HomeController;
use App\Http\Controllers\FrontController\FrontMediaController;
use App\Http\Controllers\FrontController\FrontCareerController;
use App\Http\Controllers\FrontController\FrontSustainabilityController;
use App\Http\Controllers\FrontController\FrontTeamController;
use App\Http\Controllers\FrontController\FrontBrandController;
use App\Http\Controllers\FrontController\FrontAboutusController;
use App\Http\Controllers\FrontController\FrontTermsController;


Route::get('/', function () {
    return redirect(route('home'));
});
Route::group(['prefix' => 'admin'], function () {
// Route::group(['middleware' => 'guest'], function(){
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login-check');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('signup', [SignupController::class, 'signup'])->name('signup');
Route::post('save-user', [SignupController::class, 'create'])->name('save-user');
Route::post('change-password', [SignupController::class, 'changepass'])->name('change-password');
Route::get('/forget', [SignupController::class, 'forget'])->name('forget');
Route::post('forget-password', [SignupController::class, 'forgetpassword'])->name('forget-password');
Route::get('otp_validation', [SignupController::class, 'otp_validation'])->name('otp_validation');
Route::post('validation', [SignupController::class, 'validation'])->name('validation');
Route::post('new_password', [SignupController::class, 'new_password'])->name('new_password');
// });

// Route::group(['middleware' => 'auth'], function () {
  Route::group(['middleware' => ['isAdmin']], function () { 
    Route::resource('permissions',App\Http\Controllers\PermissionController::class);
    Route::get('permissions/{id}/destroy',[App\Http\Controllers\PermissionController::class,'destroy']);
    // ->middleware('permission:Delete')
    Route::resource('roles',App\Http\Controllers\RoleController::class);
    Route::get('roles/{id}/destroy',[App\Http\Controllers\RoleController::class,'destroy']);

    Route::get('roles/{roleid}/addpermissiontorole',[App\Http\Controllers\RoleController::class,'addpermissiontorole']);
    Route::PUT('roles/{roleid}/updatepermissiontorole',[App\Http\Controllers\RoleController::class,'updatepermissiontorole']);



    Route::controller(UserController::class)->group(function () {
      Route::get('user-index', 'index')->name('user-index');
      Route::get('user-create', 'create')->name('user-create');
      Route::post('user-store', 'store')->name('user-store');
      Route::get('user-edit/{id}', 'edit')->name('user-edit');
      Route::get('user-view/{id}', 'view')->name('user-view');
      Route::get('user-delete/{id}', 'delete')->name('user-delete');
    });







    Route::get('dashboard', [DashboardController::class, 'dashboardAnalytics'])->name('dashboard');
    // Route::get('who_we_are', [WhoweareController::class, 'index'])->name('who_we_are');
    // Route::post('save-who-we-are', [WhoweareController::class, 'store'])->name('save-who-we-are');

    Route::get('banner', [BannerController::class, 'index'])->name('banner');
    Route::get('list-banner', [BannerController::class, 'list'])->name('list-banner');
    Route::post('save_banner', [BannerController::class, 'store'])->name('save_banner');
    Route::get('banner-view/{id}', [BannerController::class, 'view'])->name('banner-view');
    Route::get('banner-edit/{id}', [BannerController::class, 'edit'])->name('banner-edit');
    Route::get('banner-delete/{id}', [BannerController::class, 'delete'])->name('banner-delete');

    Route::get('list-Sustainability', [SustainabilityController::class, 'list'])->name('list-Sustainability');
    Route::get('sustainability-add', [SustainabilityController::class, 'index'])->name('sustainability-add');
    Route::post('save-sustainability', [SustainabilityController::class, 'store'])->name('save-sustainability');
    Route::get('view-sustainability/{id}', [SustainabilityController::class, 'view'])->name('view-sustainability');
    Route::get('delete-sustainability/{id}', [SustainabilityController::class, 'delete'])->name('delete-sustainability');
    Route::get('edit-sustainability/{id}', [SustainabilityController::class, 'edit'])->name('edit-sustainability');

    Route::get('list-Our-History', [OurHistoryController::class, 'list'])->name('list-Our-History');
    Route::get('OurHistory', [OurHistoryController::class, 'create'])->name('OurHistory');
    Route::post('save-Our-History', [OurHistoryController::class, 'save'])->name('save-Our-History');
    Route::get('OurHistory-view/{id}', [OurHistoryController::class, 'view'])->name('OurHistory-view');

    Route::get('list-team', [TeamController::class, 'list'])->name('list-team');
    Route::get('ajax_team', [TeamController::class, 'ajax_team'])->name('ajax_team');

    Route::get('add-team', [TeamController::class, 'create'])->name('add-team');    
    Route::post('save-team', [TeamController::class, 'save'])->name('save-team');
    Route::get('view-team/{id}', [TeamController::class, 'view'])->name('view-team');
    Route::get('edit-team/{id}', [TeamController::class, 'edit'])->name('edit-team');
    Route::get('delete-team/{id}', [TeamController::class, 'delete'])->name('delete-team');

    Route::controller(BrandController::class)->group(function () {
        Route::get('Brand-list', 'index')->name('Brand-list');
        Route::get('Brand-add', 'add')->name('Brand-add');
        Route::post('Brand-save', 'store')->name('Brand-save');
        Route::get('Brand-edit/{id}', 'edit')->name('Brand-edit');
        Route::get('Brand-delete/{id}', 'delete')->name('Brand-delete');
        Route::get('Brand-view/{id}', 'view')->name('Brand-view');
    });

    Route::controller(MediaController::class)->group(function () {
        Route::get('media-list', 'index')->name('media-list');
        Route::get('media-add', 'add')->name('media-add');
        Route::post('media-save', 'store')->name('media-save');
        Route::get('media-delete/{id}', 'delete')->name('media-delete');
        Route::get('media-view/{id}', 'view')->name('media-view');
        Route::get('media-edit/{id}', 'update')->name('media-edit');

    });

    Route::controller(AboutUsController::class)->group(function () {
        Route::get('about-us-list', 'index')->name('about-us-list');
        Route::get('about-us-add', 'add')->name('about-us-add');
        Route::post('about-us-save', 'store')->name('about-us-save');
        Route::get('about-us-delete/{id}', 'delete')->name('about-us-delete');
        Route::get('about-us-view/{id}', 'view')->name('about-us-view');
        Route::get('about-us-edit/{id}', 'update')->name('about-us-edit');
    });

    Route::controller(GalleryImagesController::class)->group(function () {
        Route::get('gallery-list', 'index')->name('gallery-list');
        Route::get('gallery-add', 'add')->name('gallery-add');
        Route::post('gallery-save', 'store')->name('gallery-save');
        Route::get('gallery-delete/{id}', 'delete')->name('gallery-delete');
        Route::get('gallery-view/{id}', 'view')->name('gallery-view');
        Route::get('gallery-edit/{id}', 'edit')->name('gallery-edit');
    });

    Route::controller(ProductsTimelineController::class)->group(function () {
        Route::get('products-timelin-list', 'index')->name('products-timelin-list');
        Route::get('products-timelin-add', 'add')->name('products-timelin-add');
        Route::post('products-timelin-save', 'store')->name('products-timelin-save');
        Route::get('products-timelin-delete/{id}', 'delete')->name('products-timelin-delete');
        Route::get('products-timelin-view/{id}', 'view')->name('products-timelin-view');
        Route::get('products-timelin-edit/{id}', 'update')->name('products-timelin-edit');
    });

    Route::controller(AwardsController::class)->group(function () {
        Route::get('awards-list', 'index')->name('awards-list');
        Route::get('awards-add', 'add')->name('awards-add');
        Route::post('awards-save', 'store')->name('awards-save');
        Route::get('awards-delete/{id}', 'delete')->name('awards-delete');
        Route::get('awards-view/{id}', 'view')->name('awards-view');
        Route::get('awards-edit/{id}', 'update')->name('awards-edit');
    });

    Route::controller(CareerController::class)->group(function () {
        Route::get('career-list', 'index')->name('career-list');
        Route::get('job_banner_list', 'job_banner_list')->name('job_banner_list');
        Route::get('career_banner_list', 'career_banner_list')->name('career_banner_list');
        Route::get('career-add', 'create')->name('career-add');
        Route::get('career_banner_add', 'career_banner_add')->name('career_banner_add');
        Route::get('job_banner_add', 'job_banner_add')->name('job_banner_add');
        Route::post('career-save', 'store')->name('career-save');
        Route::post('career_banner_save', 'career_banner_save')->name('career_banner_save');
        Route::post('job_banner_save', 'job_banner_save')->name('job_banner_save');
        Route::get('career-delete/{id}', 'destroy')->name('career-delete');
        Route::get('career-view/{id}', 'view')->name('career-view');
        Route::get('career_banner_view/{id}', 'career_banner_view')->name('career_banner_view');
        Route::get('job_banner_view/{id}', 'job_banner_view')->name('job_banner_view');
        Route::get('career-edit/{id}', 'update')->name('career-edit');
        Route::get('career_banner_edit/{id}', 'career_banner_edit')->name('career_banner_edit');
        Route::get('job_banner_edit/{id}', 'job_banner_edit')->name('job_banner_edit');
    });
    Route::get('/download-pdf/{filename}', [CareerController::class, 'downloadPdf'])->name('download.pdf');

    Route::controller(TermsController::class)->group(function () {
        // Route::get('terms-list', 'index')->name('terms-list');
        Route::get('terms-add', 'create')->name('terms-add');
        Route::post('terms-save', 'store')->name('terms-save');
        Route::get('terms-delete/{id}', 'destroy')->name('terms-delete');
        Route::get('terms-view/{id}', 'view')->name('terms-view');
        Route::get('terms-edit/{id}', 'update')->name('terms-edit');
    });
    Route::controller(PrivacyCenterController::class)->group(function () {
        Route::get('privacy-list', 'index')->name('privacy-list');
        Route::get('privacy-add', 'create')->name('privacy-add');
        Route::post('privacy-save', 'store')->name('privacy-save');
        Route::get('privacy-delete/{id}', 'destroy')->name('privacy-delete');
        Route::get('privacy-view/{id}', 'view')->name('privacy-view');
        Route::get('privacy-edit/{id}', 'update')->name('privacy-edit');
    });

    Route::controller(WhoweareController::class)->group(function () {
        // Route::get('who_we_are_list', 'index')->name('who_we_are_list');
        Route::get('who_we_are_list', 'add')->name('who_we_are_list');
        Route::post('who_we_are_save', 'store')->name('who_we_are_save');
        Route::get('who_we_are_delete/{id}', 'delete')->name('who_we_are_delete');
        Route::get('who_we_are_view/{id}', 'view')->name('who_we_are_view');
        Route::get('who_we_are_edit/{id}', 'edit')->name('who_we_are_edit');
        Route::get('our-value', 'our_value')->name('our-value');
        Route::post('save-our-value', 'save')->name('save-our-value');
    });

    Route::controller(OurVisionController::class)->group(function () {
        // Route::get('our_vision_list', 'index')->name('our_vision_list');
        Route::get('our_vision_list', 'add')->name('our_vision_list');
        Route::post('our_vision_save', 'store')->name('our_vision_save');
        Route::get('our_vision_delete/{id}', 'delete')->name('our_vision_delete');
        Route::get('our_vision_view/{id}', 'view')->name('our_vision_view');
        Route::get('our_vision_edit/{id}', 'edit')->name('our_vision_edit');
    });

    Route::controller(OurMissionController::class)->group(function () {
        // Route::get('our_mission_list', 'index')->name('our_mission_list');
        Route::get('our_mission_list', 'add')->name('our_mission_list');
        Route::post('our_mission_save', 'store')->name('our_mission_save');
        Route::get('our_mission_delete/{id}', 'delete')->name('our_mission_delete');
        Route::get('our_mission_view/{id}', 'view')->name('our_mission_view');
        Route::get('our_mission_edit/{id}', 'edit')->name('our_mission_edit');
    }); 

    Route::controller(HomeAboutusController::class)->group(function () {
        // Route::get('about-us', 'index')->name('about-us');
        Route::get('about-us', 'create')->name('about-us');
        Route::post('about-us-save', 'store')->name('about-us-save');
        Route::get('about-us-delete/{id}', 'destroy')->name('about-us-delete');
        Route::get('about-us-view/{id}', 'view')->name('about-us-view');
        Route::get('about-us-edit/{id}', 'update')->name('about-us-edit');
    });
    Route::controller(HomeSustainabilityController::class)->group(function () {
        // Route::get('home-sustainablity', 'index')->name('home-sustainablity');
        Route::get('home-sustainablity', 'create')->name('home-sustainablity');
        Route::post('home-sustainablity-save', 'store')->name('home-sustainablity-save');
        Route::get('home-sustainablity-delete/{id}', 'destroy')->name('home-sustainablity-delete');
        Route::get('home-sustainablity-view/{id}', 'view')->name('home-sustainablity-view');
        Route::get('home-sustainablity-edit/{id}', 'update')->name('home-sustainablity-edit');
    });
    Route::controller(BrandBannerController::class)->group(function () {
        Route::get('brand-banner', 'create')->name('brand-banner');
        Route::post('brand-banner-save', 'store')->name('brand-banner-save');
    });
    Route::controller(HomeCareersController::class)->group(function () {
        // Route::get('home-careers', 'index')->name('home-careers');
        Route::get('home-careers', 'create')->name('home-careers');
        Route::post('home-careers-save', 'store')->name('home-careers-save');
        Route::get('home-careers-delete/{id}', 'destroy')->name('home-careers-delete');
        Route::get('home-careers-view/{id}', 'view')->name('home-careers-view');
        Route::get('home-careers-edit/{id}', 'update')->name('home-careers-edit');
    });
    Route::controller(HomebrandController::class)->group(function () {
        // Route::get('home-brand', 'index')->name('home-brand');
        Route::get('home-brand', 'create')->name('home-brand');
        Route::post('home-brand-saves', 'store')->name('home-brand-saves');
        Route::get('home-brand-delete/{id}', 'destroy')->name('home-brand-delete');
        Route::get('home-brand-view/{id}', 'view')->name('home-brand-view');
        Route::get('home-brand-edit/{id}', 'update')->name('home-brand-edit');
    });

    Route::controller(TeambannerController::class)->group(function () {
        // Route::get('team-banner', 'index')->name('team-banner');
        Route::get('team-banner', 'create')->name('team-banner');
        Route::post('team-banner-save', 'store')->name('team-banner-save');
        Route::get('team-banner-delete/{id}', 'destroy')->name('team-banner-delete');
        Route::get('team-banner-view/{id}', 'view')->name('team-banner-view');
        Route::get('team-banner-edit/{id}', 'update')->name('team-banner-edit');
    });


    Route::controller(ProductNumberController::class)->group(function () {
        
        Route::get('product-number', 'list')->name('product-number');
       
        Route::get('add-product-number', 'create')->name('add-product-number');
        Route::post('save-product-number', 'store')->name('save-product-number');
        Route::get('edit-product-number/{id}', 'update')->name('edit-product-number');
        Route::get('delete-product-number/{id}', 'destroy')->name('delete-product-number');
    });

    Route::controller(PlantNumberController::class)->group(function () {
        
        Route::get('plant-number', 'list')->name('plant-number');
        Route::get('add-plant-number', 'create')->name('add-plant-number');
        Route::post('save-plant-number', 'store')->name('save-plant-number');
        Route::get('edit-plant-number/{id}', 'update')->name('edit-plant-number');
        Route::get('delete-plant-number/{id}', 'destroy')->name('delete-plant-number');
    });



    Route::controller(DepartmentController::class)->group(function () {
        Route::get('department-list', 'index')->name('department-list');
        Route::get('department-add', 'create')->name('department-add');
        Route::post('department-save', 'save')->name('department-save');
        Route::get('department-edit/{id}', 'edit')->name('department-edit');
        Route::get('department-delete/{id}', 'delete')->name('department-delete');
        
    });
    Route::controller(EducationController::class)->group(function () {
        Route::get('education-list', 'index')->name('education-list');
        Route::get('education-add', 'create')->name('education-add');
        Route::post('education-save', 'save')->name('education-save');
        Route::get('education-edit/{id}', 'edit')->name('education-edit');
        Route::get('education-delete/{id}', 'delete')->name('education-delete');
        
    });

    Route::controller(JobPostController::class)->group(function () {
        Route::get('job-list', 'index')->name('job-list');
        Route::get('job-add', 'create')->name('job-add');
        Route::post('job-save', 'save')->name('job-save');
        Route::get('job-edit/{id}', 'edit')->name('job-edit');
        Route::get('job-delete/{id}', 'delete')->name('job-delete');
        Route::get('job-view/{id}', 'view')->name('job-view');
        Route::get('pdf_download/{id}', 'pdf_download')->name('pdf_download');
        
        Route::get('job-view/{id}', 'view')->name('job-view');
        
    });


    Route::controller(ApplyNowController::class)->group(function () {
        Route::get('candidate-list', 'index')->name('candidate-list');
        Route::get('pdf_downloadcandidate/{id}', 'pdf_downloadcandidate')->name('pdf_downloadcandidate');
    });

    Route::controller(HomeBrandsController::class)->group(function () {
        
        Route::get('home-brand-list', 'list')->name('home-brand-list');
        Route::get('home-brand-add', 'create')->name('home-brand-add');
        Route::post('home-brand-save', 'store')->name('home-brand-save');
        Route::get('home-brand-edit/{id}', 'update')->name('home-brand-edit');
        Route::get('home-brand-delete/{id}', 'destroy')->name('home-brand-delete');
        Route::get('home-brand-view/{id}', 'view')->name('home-brand-view');
    });
});
});

//************************************************************Front view route ***********************************************************

Route::controller(HomeController::class)->group(function () {
    Route::get('home', 'index')->name('home');
    Route::get('contact', 'contact')->name('contact');
    Route::post('get-in-touch', 'get_in_touch')->name('get-in-touch');
    Route::post('subscription', 'subscription')->name('subscription');
});

Route::controller(FrontSustainabilityController::class)->group(function () {
    Route::get('sustainability', 'index')->name('sustainability');
    Route::get('sustainability-details/{id}', 'details')->name('sustainability-details');
    

});


Route::controller(FrontCareerController::class)->group(function () {
    Route::get('career', 'index')->name('career');
    Route::get('career-details/{id}', 'job_details')->name('career-details');
    Route::get('test_career', 'test_career')->name('test_career');
    Route::post('career_filter', 'career_filter')->name('career_filter');
    Route::get('pdf_download/{id}', 'pdf_download')->name('pdf_download');  


});

Route::get('/downloads-pdf/{filename}', [FrontCareerController::class, 'downloadPdfs'])->name('downloads.pdf');

Route::controller(FrontMediaController::class)->group(function () {
    Route::get('media', 'index')->name('media');
    Route::get('media-details/{id}', 'details')->name('media-details');
});

Route::controller(FrontTeamController::class)->group(function () {
    Route::get('our-team', 'index')->name('our-team');
    Route::get('team', 'index')->name('team');
    Route::get('team_member_details/{id}', 'team_details')->name('team_member_details');
}); 

Route::controller(FrontBrandController::class)->group(function () {
    Route::get('our-brands', 'index')->name('our-brands');
});

Route::controller(FrontAboutusController::class)->group(function () {
    Route::get('who-we-are', 'index')->name('who-we-are');
    Route::get('get_all_gallery_image/{id}', 'all_images')->name('get_all_gallery_image');

});
Route::controller(FrontTermsController::class)->group(function () {
    Route::get('terms', 'terms')->name('terms');
    Route::get('terms-pdf', 'downloadPDF')->name('terms-pdf');
    Route::get('Privacy-Center', 'Privacy')->name('Privacy-Center');
    Route::get('Privacy-Center-pdf/{id}', 'Privacypdf')->name('Privacy-Center-pdf');


});
Route::post('/apply_job', [CareerController::class, 'apply_job'])->name('apply_job');



