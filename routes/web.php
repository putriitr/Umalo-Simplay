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
    use App\Http\Controllers\Member\ContactMenu\ContactMenuController;
    use App\Http\Controllers\Member\Brand\BrandController;
    use App\Http\Controllers\Admin\QnaGuest\QnaGuestController;
    use App\Http\Controllers\Guest\Message\GuestMessageController;
    use App\Http\Controllers\CustomerController;
    use App\Http\Controllers\Admin\Ticket\TicketController;
    use App\Http\Controllers\Member\Ticket\TicketMemberController;
    use App\Http\Controllers\Admin\Distributor\DistributorApprovalController;
    use App\Http\Controllers\Distribution\Portal\DistributionController;
    use App\Http\Controllers\Auth\RegisterController;
    use App\Http\Controllers\Distribution\Portal\TicketDistributorController;
    use App\Http\Controllers\Distribution\Portal\QuotationController;
    use App\Http\Controllers\Admin\Quotation\QuotationAdminController;

    /*
    |--------------------------------------------------------------------------
    | Web Routes
    |--------------------------------------------------------------------------
    */


    // Guest Routes (No Authentication Required)
    Route::group(['prefix' => LaravelLocalization::setLocale()], function () {
        Route::get('/', [HomeController::class, 'index'])->name('home');
        Route::get('/about', [HomeController::class, 'about'])->name('about');
        // Rute lainnya
        Route::get('/customers', [CustomerController::class, 'index'])->name('customers.index');
        Route::get('/products', [ProdukMemberController::class, 'index'])->name('product.index');
        Route::get('/products/category/{id}', [ProdukMemberController::class, 'index'])->name('product.category');
        Route::get('/product/{id}', [ProdukMemberController::class, 'show'])->name('product.show');
        Route::get('/products/filter/{id}', [ProdukMemberController::class, 'filterByCategory'])->name('filterByCategory');
        Route::get('/products/search', [ProdukMemberController::class, 'search'])->name('products.search');
        Route::post('/products/search', [ProdukMemberController::class, 'search'])->name('products.search');
        Route::get('/activity', [ActivityMemberController::class, 'activity'])->name('activity');
        Route::get('/activities/{activity}', [ActivityMemberController::class, 'show'])->name('activity.show');
        Route::get('/member/meta/{slug}', [MetaMemberController::class, 'showMetaBySlug'])->name('member.meta.show');
        Route::get('/member/meta', [MetaMemberController::class, 'showMeta'])->name('member.meta.index');
        Route::get('/locations', [LocationMemberController::class, 'index']);
        Route::get('/contact', [ContactMenuController::class, 'index'])->name('contact');
        Route::post('/contact', [ContactMenuController::class, 'store']);
        Route::get('/brands', [BrandController::class, 'index']);
        Route::get('/admin/guest-messages', [GuestMessageController::class, 'index'])->name('admin.guest-messages.index');
        Route::post('/guest-messages', [GuestMessageController::class, 'store'])->name('guest-messages.store');

        // Distributor Registration
        Route::get('/distributors/register', [RegisterController::class, 'showDistributorRegistrationForm'])->name('distributors.register');
        Route::post('/distributors/register', [RegisterController::class, 'registerDistributor']);
        Route::get('/distributors/waiting', function () {
            return view('auth.distributor_waiting');
        })->name('distributors.waiting');

        // Admin Qna Guest
        Route::prefix('admin')->name('admin.')->group(function () {
            Route::resource('qnaguest', QnaGuestController::class);
        });

        Auth::routes();
    });


    // Member Routes (Authenticated Users with "member" role)
    Route::middleware(['auth', 'user-access:member'])->group(function () {
        Route::group(['prefix' => LaravelLocalization::setLocale()], function () {
            Route::get('/portal', [PortalController::class, 'index'])->name('portal');
            Route::get('/portal/user-product', [PortalController::class, 'UserProduk'])->name('portal.user-product');
            Route::get('/product/user-product/{id}', [PortalController::class, 'detailProduk'])->name('user-product.show');
            Route::get('/portal/photos', [PortalController::class, 'photos'])->name('portal.photos');
            Route::get('/portal/instructions', [PortalController::class, 'instructions'])->name('portal.instructions');
            Route::get('/portal/tutorials', [PortalController::class, 'videos'])->name('portal.tutorials');
            Route::get('/portal/controlgenerations', [PortalController::class, 'ControllerGenerations'])->name('portal.controlgenerations');
            Route::get('/portal/document', [PortalController::class, 'document'])->name('portal.document');
            Route::get('/portal/qna', [PortalController::class, 'Faq'])->name('portal.qna');

            
            Route::get('/portal/tickets', [TicketMemberController::class, 'index'])->name('tickets.index');
            Route::get('/portal/tickets/create', [TicketMemberController::class, 'create'])->name('tickets.create');
            Route::post('/portal/tickets', [TicketMemberController::class, 'store'])->name('tickets.store');
            Route::get('/portal/tickets/{id}', [TicketMemberController::class, 'show'])->name('tickets.show');
            Route::get('/portal/tickets/{id}/edit', [TicketMemberController::class, 'edit'])->name('tickets.edit');
            Route::put('/portal/tickets/{id}/cancel', [TicketMemberController::class, 'cancel'])->name('tickets.cancel');
            Route::put('/portal/tickets/{id}', [TicketMemberController::class, 'update'])->name('tickets.update');


            Route::get('/portal/monitoring', [PortalController::class, 'Monitoring'])->name('portal.monitoring');
            Route::get('/portal/monitoring/detail/{userProduk}', [PortalController::class, 'showInspeksiMaintenance'])->name('portal.monitoring.detail');

            Route::get('/profile', [ProfileMemberController::class, 'show'])->name('profile.show');
            Route::get('/profile/edit', [ProfileMemberController::class, 'edit'])->name('profile.edit');
            Route::put('/profile/update', [ProfileMemberController::class, 'update'])->name('profile.update');
        });
    });

    // Distributor Routes (Authenticated Users with "distributor" role)
    Route::middleware(['auth', 'user-access:distributor'])->group(function () {
        Route::group(['prefix' => LaravelLocalization::setLocale()], function () {
            Route::get('/portal/distribution', [DistributionController::class, 'index'])->name('distribution');
            Route::get('/portal/distribution/request-quotation', [DistributionController::class, 'requestQuotation'])->name('distribution.request-quotation');
            Route::get('/portal/distribution/create-po', [DistributionController::class, 'createPO'])->name('distribution.create-po');
            Route::get('/portal/distribution/invoices', [DistributionController::class, 'invoices'])->name('distribution.invoices');
            // Routes for Distributor Ticketing Service
            Route::get('/portal/distribution/tickets', [TicketDistributorController::class, 'index'])->name('distribution.tickets.index');
            Route::get('/portal/distribution/tickets/create', [TicketDistributorController::class, 'create'])->name('distribution.tickets.create');
            Route::post('/portal/distribution/tickets', [TicketDistributorController::class, 'store'])->name('distribution.tickets.store');
            Route::get('/portal/distribution/tickets/{id}', [TicketDistributorController::class, 'show'])->name('distribution.tickets.show');
            Route::get('/portal/distribution/tickets/{id}/edit', [TicketDistributorController::class, 'edit'])->name('distribution.tickets.edit');
            Route::put('/portal/distribution/tickets/{id}/cancel', [TicketDistributorController::class, 'cancel'])->name('distribution.tickets.cancel');
            Route::put('/portal/distribution/tickets/{id}', [TicketDistributorController::class, 'update'])->name('distribution.tickets.update');
            Route::post('/portal/distribution/product/{id}/add-to-quotation', [ProdukMemberController::class, 'addToQuotation'])->name('Distributor.product.addToQuotation');
        
            // Quotation Routes
            Route::get('/portal/distribution/quotations/{id}', [QuotationController::class, 'show'])->name('quotations.show'); // View quotation
            Route::put('/portal/distribution/quotations/{id}/cancel', [QuotationController::class, 'cancel'])->name('quotations.cancel'); // Cancel quotation
        
        });
    });

    Route::middleware(['auth', 'user-access:admin'])->group(function () {
        Route::group(['prefix' => LaravelLocalization::setLocale()], function () {
            Route::get('dashboard', [HomeController::class, 'dashboard'])->name('dashboard');

            Route::resource('admin/members', MemberController::class);
            Route::get('members/{id}/add-products', [MemberController::class, 'addProducts'])->name('members.add-products');
            Route::post('members/{id}/store-products', [MemberController::class, 'storeProducts'])->name('members.store-products');
            Route::get('members/{id}/edit-products', [MemberController::class, 'editProducts'])->name('members.edit-products');
            Route::put('members/{id}/update-products', [MemberController::class, 'updateProducts'])->name('members.update-products');
            Route::post('/members/{id}/update-password', [MemberController::class, 'updatePassword'])->name('members.updatePassword');
            Route::post('/admin/validate-password', [MemberController::class, 'validatePassword'])->name('admin.validatePassword');

            Route::get('/admin/distributors', [DistributorApprovalController::class, 'index'])->name('admin.distributors.index');
            Route::post('/admin/distributors/{id}/approve', [DistributorApprovalController::class, 'approve'])->name('admin.distributors.approve');
            Route::get('/admin/distributors/{id}', [DistributorApprovalController::class, 'show'])->name('admin.distributors.show');

            // Routes Tiketing Layanan untuk Admin
            Route::get('/admin/tickets', [TicketController::class, 'index'])->name('admin.tickets.index');
            Route::put('/admin/tickets/{id}/process', [TicketController::class, 'process'])->name('admin.tickets.process');
            Route::put('/admin/tickets/{id}/complete', [TicketController::class, 'complete'])->name('admin.tickets.complete');
            Route::get('/admin/tickets/{id}', [TicketController::class, 'show'])->name('admin.tickets.show');


            Route::get('admin/monitoring', [MonitoringController::class, 'index'])->name('admin.monitoring.index');
            Route::get('admin/monitoring/{id}', [MonitoringController::class, 'show'])->name('admin.monitoring.show');
            Route::get('monitoring/{id}', [MonitoringController::class, 'monitoringDetail'])->name('monitoring.detail');
            Route::get('admin/monitoring/create/{userProdukId}', [MonitoringController::class, 'create'])->name('admin.monitoring.create');
            Route::post('admin/monitoring/store', [MonitoringController::class, 'store'])->name('admin.monitoring.store');
            Route::get('admin/monitoring/{id}/edit', [MonitoringController::class, 'edit'])->name('admin.monitoring.edit');
            Route::put('admin/monitoring/{id}', [MonitoringController::class, 'update'])->name('admin.monitoring.update');

            Route::get('/admin/quotations', [QuotationAdminController::class, 'index'])->name('admin.quotations.index');
            Route::put('/quotations/{id}/status', [QuotationAdminController::class, 'updateStatus'])->name('admin.quotations.updateStatus');
            Route::post('/quotations/{id}/upload-file', [QuotationAdminController::class, 'uploadFile'])->name('admin.quotations.uploadFile');

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
