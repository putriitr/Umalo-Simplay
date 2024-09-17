    <?php

    use App\Http\Controllers\Admin\MasterData\BidangPerusahaanController;
    use App\Http\Controllers\Admin\MasterData\KategoriController;
    use Illuminate\Support\Facades\Route;
    use App\Http\Controllers\HomeController;
    use Illuminate\Support\Facades\Auth;
    use App\Http\Controllers\Admin\Member\MemberController;
    use App\Http\Controllers\Admin\FAQ\FAQController;
    use App\Http\Controllers\Admin\Monitoring\MonitoringController;
    use App\Http\Controllers\Admin\Parameter\CompanyParameterController;
    use App\Http\Controllers\Admin\Produk\ProdukController;
    use App\Http\Controllers\Member\Portal\PortalController;
    use App\Http\Controllers\Member\Produk\ProdukMemberController;
    use App\Http\Controllers\Admin\Slider\SliderController;
    use App\Http\Controllers\Admin\Activity\ActivityController;
    use App\Http\Controllers\Member\Activity\ActivityMemberController;
    use App\Http\Controllers\Admin\BrandPartner\BrandPartnerController;
    use App\Http\Controllers\Admin\Meta\MetaController;
    use App\Http\Controllers\Member\Meta\MetaMemberController;
    use App\Http\Controllers\Member\Profile\ProfileMemberController;
    use App\Http\Controllers\Admin\Location\LocationController;
    use App\Http\Controllers\Admin\Visitor\VisitorController;
    use App\Http\Controllers\Member\Location\LocationMemberController;
    use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

    /*
    |--------------------------------------------------------------------------
    | Web Routes
    |--------------------------------------------------------------------------
    */


    // Guest Routes (No Authentication Required)

    Route::group(['prefix' => LaravelLocalization::setLocale()], function() {
        Route::get('/', [HomeController::class, 'index'])->name('home');
        Route::get('/about', [HomeController::class, 'about'])->name('about');
        // Rute lainnya
        Route::get('/products', [ProdukMemberController::class, 'index'])->name('product.index');
        Route::get('/products/category/{id}', [ProdukMemberController::class, 'index'])->name('product.category');
        Route::get('/product/{id}', [ProdukMemberController::class, 'show'])->name('product.show');

        Route::get('/products/filter/{id}', [ProdukMemberController::class, 'filterByCategory'])->name('filterByCategory');

        Route::get('/activity', [ActivityMemberController::class, 'activity'])->name('activity');
        Route::get('/activities/{activity}', [ActivityMemberController::class, 'show'])->name('activity.show');
        Route::get('/member/meta/{slug}', [MetaMemberController::class, 'showMetaBySlug'])->name('member.meta.show');
        Route::get('/member/meta', [MetaMemberController::class, 'showMeta'])->name('member.meta.index');
        Route::get('/locations', [LocationMemberController::class, 'index']);

    Auth::routes();
    });


    // Member Routes (Authenticated Users with "member" role)
Route::middleware(['auth', 'user-access:member'])->group(function () {
    Route::group(['prefix' => LaravelLocalization::setLocale()], function() {
        Route::get('/portal', [PortalController::class, 'index'])->name('portal');
        Route::get('/portal/user-product', [PortalController::class, 'UserProduk'])->name('portal.user-product');
        Route::get('/product/user-product/{id}', [PortalController::class, 'detailProduk'])->name('user-product.show');
        Route::get('/portal/photos', [PortalController::class, 'photos'])->name('portal.photos');
        Route::get('/portal/instructions', [PortalController::class, 'instructions'])->name('portal.instructions');
        Route::get('/portal/tutorials', [PortalController::class, 'videos'])->name('portal.tutorials');
        Route::get('/portal/controlgenerations', [PortalController::class, 'ControllerGenerations'])->name('portal.controlgenerations');
        Route::get('/portal/document', [PortalController::class, 'document'])->name('portal.document');
        Route::get('/portal/qna', [PortalController::class, 'Faq'])->name('portal.qna');
        Route::get('/portal/monitoring', [PortalController::class, 'Monitoring'])->name('portal.monitoring');
        Route::get('/portal/monitoring/detail/{userProduk}', [PortalController::class, 'showInspeksiMaintenance'])->name('portal.monitoring.detail');

        Route::get('/profile', [ProfileMemberController::class, 'show'])->name('profile.show');
        Route::get('/profile/edit', [ProfileMemberController::class, 'edit'])->name('profile.edit');
        Route::put('/profile/update', [ProfileMemberController::class, 'update'])->name('profile.update');
    });
});



Route::middleware(['auth', 'user-access:admin'])->group(function () {
    Route::group(['prefix' => LaravelLocalization::setLocale()], function() {
        Route::get('dashboard', [HomeController::class, 'dashboard'])->name('dashboard');

        Route::resource('admin/members', MemberController::class);
        Route::get('members/{id}/add-products', [MemberController::class, 'addProducts'])->name('members.add-products');
        Route::post('members/{id}/store-products', [MemberController::class, 'storeProducts'])->name('members.store-products');
        Route::get('members/{id}/edit-products', [MemberController::class, 'editProducts'])->name('members.edit-products');
        Route::put('members/{id}/update-products', [MemberController::class, 'updateProducts'])->name('members.update-products');
        Route::post('/members/{id}/update-password', [MemberController::class, 'updatePassword'])->name('members.updatePassword');
        Route::post('/admin/validate-password', [MemberController::class, 'validatePassword'])->name('admin.validatePassword');

        Route::get('admin/monitoring', [MonitoringController::class, 'index'])->name('admin.monitoring.index');
        Route::get('admin/monitoring/{id}', [MonitoringController::class, 'show'])->name('admin.monitoring.show');
        Route::get('monitoring/{id}', [MonitoringController::class, 'monitoringDetail'])->name('monitoring.detail');
        Route::get('admin/monitoring/create/{userProdukId}', [MonitoringController::class, 'create'])->name('admin.monitoring.create');
        Route::post('admin/monitoring/store', [MonitoringController::class, 'store'])->name('admin.monitoring.store');
        Route::get('admin/monitoring/{id}/edit', [MonitoringController::class, 'edit'])->name('admin.monitoring.edit');
        Route::put('admin/monitoring/{id}', [MonitoringController::class, 'update'])->name('admin.monitoring.update');

        Route::prefix('admin/inspeksi')->name('admin.inspeksi.')->group(function () {
            Route::get('/{userProdukId}', [MonitoringController::class, 'inspeksiIndex'])->name('index');
            Route::get('/create/{userProdukId}', [MonitoringController::class, 'inspeksiCreate'])->name('create');
            Route::post('/store/{userProdukId}', [MonitoringController::class, 'inspeksiStore'])->name('store');
            Route::get('/edit/{id}', [MonitoringController::class, 'inspeksiEdit'])->name('edit');
            Route::put('/update/{id}/{userProdukId}', [MonitoringController::class, 'inspeksiUpdate'])->name('update');
            Route::delete('/destroy/{id}', [MonitoringController::class, 'inspeksiDestroy'])->name('destroy');
            Route::get('/show/{id}', [MonitoringController::class, 'inspeksiShow'])->name('show');


        });

        Route::get('/admin/visitors', [VisitorController::class, 'index'])->name('admin.visitors');
        Route::resource('admin/produk', ProdukController::class)->names('admin.produk');
            Route::resource('admin/parameter', CompanyParameterController::class);
            Route::resource('admin/bidangperusahaan', BidangPerusahaanController::class);
            Route::resource('admin/kategori', KategoriController::class)->names('admin.kategori');
            Route::resource('admin/faq', FAQController::class)->names('admin.faq');
            Route::resource('admin/slider', SliderController::class)->names('admin.slider');
            Route::resource('admin/activity', ActivityController::class)->names('admin.activity');
            Route::resource('admin/brand', BrandPartnerController::class)->names('admin.brand');
            Route::resource('admin/meta', MetaController::class)->names('admin.meta');
            Route::post('/froala/upload_image', [MetaController::class, 'uploadImage'])->name('froala.upload_image');
            Route::resource('admin/location', LocationController::class)->names('admin.location');


    });
});


