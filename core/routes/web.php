<?php
// ************************************ ADMIN PANEL **********************************************
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

// ── Controladores Back ──────────────────────────────────────────────────────
use App\Http\Controllers\Auth\Back\LoginController as BackLoginController;
use App\Http\Controllers\Auth\Back\ForgotController as BackForgotController;
use App\Http\Controllers\Back\AccountController;
use App\Http\Controllers\Back\BulkDeleteController;
use App\Http\Controllers\Back\OrderController;
use App\Http\Controllers\Back\NotificationController;
use App\Http\Controllers\Back\ItemController;
use App\Http\Controllers\Back\CsvProductController;
use App\Http\Controllers\Back\CampaignController;
use App\Http\Controllers\Back\AffiliateController;
use App\Http\Controllers\Back\AttributeController;
use App\Http\Controllers\Back\AttributeOptionController;
use App\Http\Controllers\Back\BrandController;
use App\Http\Controllers\Back\RootUnitController;
use App\Http\Controllers\Back\RootAttributeController;
use App\Http\Controllers\Back\ReviewController;
use App\Http\Controllers\Back\CategoryController;
use App\Http\Controllers\Back\SubCategoryController;
use App\Http\Controllers\Back\ChieldCategoryController;
use App\Http\Controllers\Back\CouponsController;
use App\Http\Controllers\Back\UserController;
use App\Http\Controllers\Back\ComplaintsBookController;
use App\Http\Controllers\Back\PromoCodeController;
use App\Http\Controllers\Back\TaxController;
use App\Http\Controllers\Back\StateController;
use App\Http\Controllers\Back\ShippingServiceController;
use App\Http\Controllers\Back\CurrencyController;
use App\Http\Controllers\Back\PaymentSettingController;
use App\Http\Controllers\Back\BackupController;
use App\Http\Controllers\Back\TicketController;
use App\Http\Controllers\Back\BcategoryController;
use App\Http\Controllers\Back\PostController;
use App\Http\Controllers\Back\TranactionController;
use App\Http\Controllers\Back\FcategoryController;
use App\Http\Controllers\Back\FaqController;
use App\Http\Controllers\Back\RoleController;
use App\Http\Controllers\Back\StaffController;
use App\Http\Controllers\Back\PageController;
use App\Http\Controllers\Back\SocialController;
use App\Http\Controllers\Back\FeatureController;
use App\Http\Controllers\Back\SettingController;
use App\Http\Controllers\Back\HomePageController;
use App\Http\Controllers\Back\EmailSettingController;
use App\Http\Controllers\Back\SmsSettingController;
use App\Http\Controllers\Back\LanguageController;
use App\Http\Controllers\Back\SliderController;
use App\Http\Controllers\Back\ServiceController;
use App\Http\Controllers\Back\SitemapController;
use App\Http\Controllers\Back\DistritoController;
use App\Http\Controllers\Back\ProvinciaController;
use App\Http\Controllers\Back\DepartamentoController;
use App\Http\Controllers\Back\QuotationSpreadsheetsController;
use App\Http\Controllers\Back\QuotationSpreadsheetsValuesController;
use App\Http\Controllers\Back\CatalogController;
use App\Http\Controllers\Back\SubscriberController;
use App\Http\Controllers\Back\StoreController;

// ── Controladores Auth User ──────────────────────────────────────────────────
use App\Http\Controllers\Auth\User\LoginController as UserLoginController;
use App\Http\Controllers\Auth\User\RegisterController as UserRegisterController;
use App\Http\Controllers\Auth\User\ForgotController as UserForgotController;

// ── Controladores User ───────────────────────────────────────────────────────
use App\Http\Controllers\User\AccountController as UserAccountController;
use App\Http\Controllers\User\TicketController as UserTicketController;
use App\Http\Controllers\User\OrderController as UserOrderController;
use App\Http\Controllers\User\WishlistController;
use App\Http\Controllers\User\SocialLoginController;

// ── Controladores Front ──────────────────────────────────────────────────────
use App\Http\Controllers\Front\FrontendController;
use App\Http\Controllers\Front\HomeCustomizeController;
use App\Http\Controllers\Front\CompareController;
use App\Http\Controllers\Front\CartController;
use App\Http\Controllers\Front\CatalogController as FrontCatalogController;
use App\Http\Controllers\Front\JournalController;
use App\Http\Controllers\Front\BrandController as FrontBrandController;
use App\Http\Controllers\Front\CheckoutController;

// ── Controladores Payment ────────────────────────────────────────────────────
use App\Http\Controllers\Payment\PaytmController;
use App\Http\Controllers\Payment\RazorpayController;
use App\Http\Controllers\Payment\FlutterwaveController;
use App\Http\Controllers\Payment\MercadopagoController;
use App\Http\Controllers\Payment\AuthorizeController;
use App\Http\Controllers\Payment\SslCommerzController;

Route::group(['middleware' => 'adminlocalize'], function () {
  Route::prefix('admin')->group(function () {
    //------------ AUTH ------------
    Route::get('/login', [BackLoginController::class, 'showForm'])->name('back.login');
    Route::post('/login-submit', [BackLoginController::class, 'login'])->name('back.login.submit');
    Route::get('/logout', [BackLoginController::class, 'logout'])->name('back.logout');
    //------------ FORGOT ------------
    Route::get('/forgot', [BackForgotController::class, 'showForm'])->name('back.forgot');
    Route::post('/forgot-submit', [BackForgotController::class, 'forgot'])->name('back.forgot.submit');
    Route::get('/change-password/{token}', [BackForgotController::class, 'showChangePassForm'])->name('back.change.token');
    Route::post('/change-password-submit', [BackForgotController::class, 'changepass'])->name('back.change.password');
    //------------ DASHBOARD & PROFILE ------------
    Route::get('/', [AccountController::class, 'index'])->name('back.dashboard');
    Route::get('/profile', [AccountController::class, 'profileForm'])->name('back.profile');
    Route::post('/profile/update', [AccountController::class, 'updateProfile'])->name('back.profile.update');
    Route::get('/password', [AccountController::class, 'passwordResetForm'])->name('back.password');
    Route::post('/password/update', [AccountController::class, 'updatePassword'])->name('back.password.update');
    Route::get('bulk/deletes', [BulkDeleteController::class, 'bulkDelete'])->name('back.bulk.delete');

    Route::group(['middleware' => 'permissions:Manage Orders'], function () {
        //------------ ORDER ------------
        Route::get('orders', [OrderController::class, 'index'])->name('back.order.index');
        Route::delete('/order/delete/{id}', [OrderController::class, 'delete'])->name('back.order.delete');
        Route::get('/order/print/{id}', [OrderController::class, 'printOrder'])->name('back.order.print');
        Route::get('/order/invoice/{id}', [OrderController::class, 'invoice'])->name('back.order.invoice');
        Route::get('/order/status/{id}/{field}/{value}', [OrderController::class, 'status'])->name('back.order.status');
        Route::get('/order/pdforderpreview/{id}', [OrderController::class, 'getGeneratePDFOrderPreview'])->name('back.order.pdforderpreview');
    });

    //------------ NOTIFICATIONS ------------
    Route::get('/notifications', [NotificationController::class, 'notifications'])->name('back.notifications');
    Route::get('/notifications/view', [NotificationController::class, 'view_notification'])->name('back.view.notification');
    Route::get('/notification/delete/{id}', [NotificationController::class, 'delete'])->name('back.notification.delete');
    Route::get('/notifications/clear', [NotificationController::class, 'clear_notf'])->name('back.notifications.clear');

    Route::group(['middleware' => 'permissions:Manage Products'], function () {
        //------------ ITEM ------------
        Route::get('item/add', [ItemController::class, 'add'])->name('back.item.add');
        Route::get('item/status/{item}/{status}', [ItemController::class, 'status'])->name('back.item.status');
        Route::get('get/subcategory', [ItemController::class, 'getsubCategory'])->name('back.get.subcategory');
        Route::get('get/childcategory', [ItemController::class, 'getChildCategory'])->name('back.get.childcategory');
        Route::post('item/taxes', [ItemController::class, 'getAllTaxes'])->name('back.item.taxes');
        Route::get('item/getspecialprices/{idprod}', [ItemController::class, 'getAllSpecialPricesByIdProd'])->name('back.item.getspecialprices');
        Route::get('item/getproductname/{productname}', [ItemController::class, 'getProductName'])->name('back.item.getproductname');
        Route::get('stock/out/product', [ItemController::class, 'stockOut'])->name('back.item.stock.out');
        Route::resource('item', ItemController::class)->except(['show']);
        Route::get('item/highlight/{item}', [ItemController::class, 'highlight'])->name('back.item.highlight');
        Route::post('item/highlight/update/{item}', [ItemController::class, 'highlight_update'])->name('back.item.highlight.update');
        Route::get('item/galleries/{item}', [ItemController::class, 'galleries'])->name('back.item.gallery');
        Route::post('item/galleries/update', [ItemController::class, 'galleriesUpdate'])->name('back.item.galleries.update');
        Route::delete('item/gallery/{gallery}/delete', [ItemController::class, 'galleryDelete'])->name('back.item.gallery.delete');
        // Bulk product upload
        Route::get('/product/csv/export', [CsvProductController::class, 'export'])->name('back.csv.export');
        Route::get('bulk/product/index', [CsvProductController::class, 'index'])->name('back.bulk.product.index');
        Route::post('csv/import', [CsvProductController::class, 'import'])->name('back.csv.import');
        Route::get('transaction/csv/export', [CsvProductController::class, 'transactionExport'])->name('back.csv.transaction.export');
        Route::get('order/csv/export', [CsvProductController::class, 'orderExport'])->name('back.csv.order.export');
        // Campaign offer
        Route::resource('/campaign', CampaignController::class)->except(['show']);
        Route::get('campaign/status/{id}/{status}/{type}', [CampaignController::class, 'status'])->name('back.campaign.status');
        // --------- DIGITAL PRODUCT -----------//
        Route::get('/digital/create', [ItemController::class, 'deigitalItemCreate'])->name('back.digital.item.create');
        Route::post('/digital/store', [ItemController::class, 'deigitalItemStore'])->name('back.digital.item.store');
        Route::get('/digital/edit/{id}', [ItemController::class, 'deigitalItemEdit'])->name('back.digital.item.edit');
        // --------- LICENSE PRODUCT -----------//
        Route::get('/license/create', [ItemController::class, 'licenseItemCreate'])->name('back.license.item.create');
        Route::post('/license/store', [ItemController::class, 'licenseItemStore'])->name('back.license.item.store');
        Route::get('/license/edit/{id}', [ItemController::class, 'licenseItemEdit'])->name('back.license.item.edit');
        // ----------- AFFILIATE PRODUCT -----------//
        Route::resource('affiliate', AffiliateController::class);
        // ----------- ATTRIBUTE / OPTION -----------//
        Route::prefix('{item}')->group(function () {
            Route::resource('attribute', AttributeController::class)->except(['show']);
            Route::resource('option', AttributeOptionController::class)->except(['show']);
        });
        //------------ BRAND ------------
        Route::get('brand/status/{id}/{status}/{type}', [BrandController::class, 'status'])->name('back.brand.status');
        Route::resource('brand', BrandController::class)->except(['show']);
        //------------ UNIDAD RAIZ ------------
        Route::get('unitroot/status/{id}/{status}/{type}', [RootUnitController::class, 'status'])->name('back.unitroot.status');
        Route::resource('unitroot', RootUnitController::class)->except(['show']);
        //------------ ATRIBUTO RAIZ ------------
        Route::get('attributeroot/status/{id}/{status}/{type}', [RootAttributeController::class, 'status'])->name('back.attributeroot.status');
        Route::resource('attributeroot', RootAttributeController::class)->except(['show']);
        //------------ REVIEW ----------------//
        Route::get('review/status/{id}/{status}', [ReviewController::class, 'status'])->name('back.review.status');
        Route::resource('review', ReviewController::class)->except(['create', 'store', 'edit', 'update']);
    });

    Route::group(['middleware' => 'permissions:Manage Categories'], function () {
        //------------ CATEGORY ------------
        Route::get('category/status/{id}/{status}', [CategoryController::class, 'status'])->name('back.category.status');
        Route::get('category/feature/{id}/{status}', [CategoryController::class, 'feature'])->name('back.category.feature');
        Route::resource('category', CategoryController::class)->except(['show']);
        //------------ SUB CATEGORY ------------
        Route::get('subcategory/status/{id}/{status}', [SubCategoryController::class, 'status'])->name('back.subcategory.status');
        Route::resource('subcategory', SubCategoryController::class)->except(['show']);
        //------------ CHILD CATEGORY ------------
        Route::get('childcategory/status/{id}/{status}', [ChieldCategoryController::class, 'status'])->name('back.childcategory.status');
        Route::resource('childcategory', ChieldCategoryController::class)->except(['show']);
    });

    Route::group(['middleware' => 'permissions:Manage Coupons'], function () {
        Route::get('coupons/status/{id}/{status}', [CouponsController::class, 'status'])->name('back.coupons.status');
        Route::resource('coupons', CouponsController::class)->except(['show']);
    });

    Route::group(['middleware' => 'permissions:Customer List'], function () {
        Route::resource('user', UserController::class)->except(['create', 'store', 'edit']);
    });

    Route::group(['middleware' => 'permissions:Customer List'], function () {
        Route::resource('complaintsbook', ComplaintsBookController::class)->except(['create', 'store', 'edit']);
    });

    Route::group(['middleware' => 'permissions:Ecommerce'], function () {
        //------------ PROMO CODE ------------
        Route::get('code/status/{id}/{status}', [PromoCodeController::class, 'status'])->name('back.code.status');
        Route::resource('code', PromoCodeController::class)->except(['show']);
        //------------ TAX SETTING ------------
        Route::get('tax/status/{id}/{status}', [TaxController::class, 'status'])->name('back.tax.status');
        Route::resource('tax', TaxController::class)->except(['show']);
        Route::get('state/status/{id}/{status}', [StateController::class, 'status'])->name('back.state.status');
        Route::resource('state', StateController::class)->except(['show']);
        //------------ SHIPPING SERVICE ------------
        Route::get('shipping/status/{id}/{status}', [ShippingServiceController::class, 'status'])->name('back.shipping.status');
        Route::resource('shipping', ShippingServiceController::class)->except(['show']);
        //------------ CURRENCY ------------
        Route::get('currency/status/{id}/{status}', [CurrencyController::class, 'status'])->name('back.currency.status');
        Route::resource('currency', CurrencyController::class)->except(['show']);
        //------------ PAYMENT SETTING ------------
        Route::get('/setting/payment', [PaymentSettingController::class, 'payment'])->name('back.setting.payment');
        Route::post('/setting/payment/update', [PaymentSettingController::class, 'update'])->name('back.setting.payment.update');
    });

    Route::group(['middleware' => 'permissions:System Backup'], function () {
        Route::get('system/backup', [BackupController::class, 'systemBackup'])->name('back.system.backup');
        Route::get('database/backup', [BackupController::class, 'databaseBackup'])->name('back.database.backup');
    });

    Route::group(['middleware' => 'permissions:Manages Tickets'], function () {
        Route::resource('ticket', TicketController::class)->except(['show']);
        Route::get('ticket/status/{id}', [TicketController::class, 'status'])->name('back.ticket.status');
    });

    Route::group(['middleware' => 'permissions:Manage Blogs'], function () {
        Route::get('bcategory/status/{id}/{status}', [BcategoryController::class, 'status'])->name('back.bcategory.status');
        Route::resource('bcategory', BcategoryController::class)->except(['show']);
        Route::resource('post', PostController::class)->except(['show']);
        Route::delete('post/delete/{key}/{id}', [PostController::class, 'delete'])->name('back.post.photo.delete');
    });

    Route::group(['middleware' => 'permissions:Transactions'], function () {
        Route::get('/transactions', [TranactionController::class, 'index'])->name('back.transaction.index');
        Route::delete('/transaction/delete/{id}', [TranactionController::class, 'delete'])->name('back.transaction.delete');
    });

    Route::group(['middleware' => 'permissions:Manage Faqs Contents'], function () {
        Route::get('faq-category/status/{id}/{status}', [FcategoryController::class, 'status'])->name('back.fcategory.status');
        Route::resource('fcategory', FcategoryController::class)->except(['show']);
        Route::resource('faq', FaqController::class)->except(['show']);
        Route::get('faq/galleries/{faq}', [FaqController::class, 'galleries'])->name('back.faq.gallery');
        Route::post('faq/galleries/update', [FaqController::class, 'galleriesUpdate'])->name('back.faq.galleries.update');
        Route::delete('faq/gallery/{gallery}/delete', [FaqController::class, 'galleryDelete'])->name('back.faq.gallery.delete');
    });

    Route::group(['middleware' => 'permissions:Manage System User'], function () {
        Route::resource('role', RoleController::class)->except(['show']);
        Route::resource('staff', StaffController::class)->except(['show']);
    });

    Route::group(['middleware' => 'permissions:Manages Pages'], function () {
        Route::get('page/pos/{id}/{pos}', [PageController::class, 'pos'])->name('back.page.pos');
        Route::resource('page', PageController::class)->except(['show']);
    });

    Route::group(['middleware' => 'permissions:Manage Site'], function () {
        Route::resource('social', SocialController::class)->except(['show']);
        Route::get('feature/image', [FeatureController::class, 'featureImage'])->name('back.feature.image');
        Route::resource('feature', FeatureController::class)->except(['show']);
        Route::get('/setting/menu', [SettingController::class, 'menu'])->name('back.setting.menu');
        Route::get('/setting/social', [SettingController::class, 'social'])->name('back.setting.social');
        Route::get('/setting/system', [SettingController::class, 'system'])->name('back.setting.system');
        Route::post('/setting/update', [SettingController::class, 'update'])->name('back.setting.update');
        Route::post('/setting/update/visiable', [SettingController::class, 'visiable'])->name('back.setting.visible.update');
        Route::get('/announcement', [SettingController::class, 'announcement'])->name('back.subscribers.announcement');
        Route::get('/cookie/alert', [SettingController::class, 'cookie'])->name('back.cookie.alert');
        Route::get('/maintainance', [SettingController::class, 'maintainance'])->name('back.setting.maintainance');
        // Home Page Customizations
        Route::get('home-page', [HomePageController::class, 'index'])->name('back.homePage');
        Route::post('home-page/hero/banner/update', [HomePageController::class, 'hero_banner_update'])->name('back.hero.banner.update');
        Route::post('home-page/first/banner/update', [HomePageController::class, 'first_banner_update'])->name('back.first.banner.update');
        Route::post('home-page/secend/banner/update', [HomePageController::class, 'secend_banner_update'])->name('back.secend.banner.update');
        Route::post('home-page/third/banner/update', [HomePageController::class, 'third_banner_update'])->name('back.third.banner.update');
        Route::post('home-page/popular/category/update', [HomePageController::class, 'popular_category_update'])->name('back.popular.category.update');
        Route::post('home-page/tree/cloumn/category/update', [HomePageController::class, 'tree_column_category_update'])->name('back.tree.column.category.update');
        Route::post('home-page/feature/category/category/update', [HomePageController::class, 'feature_category_update'])->name('back.feature.category.update');
        Route::post('home-page4/banner/update', [HomePageController::class, 'homepage4update'])->name('back.home_page4.banner.update');
        Route::post('home-page4/category/update', [HomePageController::class, 'homepage4categoryupdate'])->name('back.home4.category.update');
        //----------- SECTION SETTING -----------//
        Route::get('/setting/section', [SettingController::class, 'section'])->name('back.setting.section');
        //------------ EMAIL TEMPLATE ------------
        Route::get('/setting/email', [EmailSettingController::class, 'email'])->name('back.setting.email');
        Route::post('/setting/email/update', [EmailSettingController::class, 'emailUpdate'])->name('back.email.update');
        Route::get('email/template/{template}/edit', [EmailSettingController::class, 'edit'])->name('back.template.edit');
        Route::put('email/template/update/{template}', [EmailSettingController::class, 'update'])->name('back.template.update');
        // ----------- SMS SETTING ---------------//
        Route::get('/setting/configuration/sms', [SmsSettingController::class, 'sms'])->name('back.setting.sms');
        Route::post('/setting/sms/update', [SmsSettingController::class, 'smsUpdate'])->name('back.sms.update');
        //------------ LANGUAGE SETTING ------------
        Route::resource('language', LanguageController::class);
        Route::get('language/status/{id}/{status}', [LanguageController::class, 'status'])->name('back.language.status');
        //------------ SLIDER ------------
        Route::resource('slider', SliderController::class)->except(['show']);
        //------------ SERVICE ------------
        Route::resource('service', ServiceController::class)->except(['show']);
        // --------- Sitemap ---------
        Route::get('/sitemap', [SitemapController::class, 'index'])->name('back.sitemap.index');
        Route::get('/sitemap/add', [SitemapController::class, 'add'])->name('back.sitemap.add');
        Route::post('/sitemap/store', [SitemapController::class, 'store'])->name('back.sitemap.store');
        Route::get('/sitemap/edit/{id}', [SitemapController::class, 'edit'])->name('back.sitemap.edit');
        Route::put('/sitemap/update/{id}', [SitemapController::class, 'update'])->name('back.sitemap.update');
        Route::get('sitemap/status/{id}/{status}', [SitemapController::class, 'status'])->name('back.sitemap.status');
        Route::delete('/sitemap/delete/{id}/', [SitemapController::class, 'delete'])->name('back.sitemap.delete');
        Route::post('/sitemap/download', [SitemapController::class, 'download'])->name('back.sitemap.download');
    });

    // --- NUEVO CONTENIDO (INICIO) --- //
    Route::group(['middleware' => 'permissions:Manage Locations'], function () {
        Route::resource('distrito', DistritoController::class)->except(['show']);
        Route::resource('provincia', ProvinciaController::class)->except(['show']);
        Route::resource('departamento', DepartamentoController::class)->except(['show']);
    });

    Route::group(['middleware' => 'permissions:Manage Quotations'], function () {
        Route::resource('quotation', QuotationSpreadsheetsController::class)->except(['show']);
        Route::post('/quotation/store', [QuotationSpreadsheetsValuesController::class, 'store'])->name('back.quotationspreadsheetvalues.store');
    });

    Route::group(['middleware' => 'permissions:Manage Catalogs'], function () {
        Route::get('catalog/status/{id}/{status}', [CatalogController::class, 'status'])->name('back.catalog.status');
        Route::resource('catalog', CatalogController::class)->except(['show']);
        Route::post('/catalog/store', [CatalogController::class, 'store'])->name('back.catalog.store');
    });
    // --- NUEVO CONTENIDO (FIN) --- //
  });

  Route::group(['middleware' => 'permissions:Subscribers List'], function () {
    Route::get('/subscribers', [SubscriberController::class, 'index'])->name('back.subscribers.index');
    Route::delete('/subscriber/delete/{id}', [SubscriberController::class, 'delete'])->name('back.subscriber.delete');
    Route::get('/subscribers/send-mail', [SubscriberController::class, 'sendMail'])->name('back.subscribers.mail');
    Route::post('/subscribers/send-mail/submit', [SubscriberController::class, 'sendMailSubmit'])->name('back.subscribers.mail.submit');
  });

  Route::group(['middleware' => 'permissions:Manage Stores'], function () {
    Route::resource('store', StoreController::class)->except(['show']);
  });
});
// ************************************ ADMIN PANEL ENDS **********************************************

// ************************************ GLOBAL LOCALIZATION **********************************************
Route::group(['middleware' => 'maintainance'], function () {
  Route::group(['middleware' => 'localize'], function () {
    // ************************************ USER PANEL **********************************************
    Route::prefix('user')->group(function () {
      //------------ AUTH ------------
      Route::get('/login', [UserLoginController::class, 'showForm'])->name('user.login');
      Route::post('/login-submit', [UserLoginController::class, 'login'])->name('user.login.submit');
      Route::get('/logout', [UserLoginController::class, 'logout'])->name('user.logout');
      Route::get('/remove/account', [UserAccountController::class, 'removeAccount'])->name('user.account.remove');
      //------------ NUEVO CONTENIDO
      Route::post('/login/departamento', [UserLoginController::class, 'getAllDepartamentos'])->name('user.departamento');
      Route::get('/login/provincia', [UserLoginController::class, 'getProvinciaByIdDepartamento'])->name('user.provincia');
      Route::get('/login/distrito', [UserLoginController::class, 'getDistritoByIdProvincia'])->name('user.distrito');
      Route::post('/changeiconuser', [UserAccountController::class, 'changeIconUser'])->name('user.account.changeiconuser');
      //------------ REGISTER ------------
      Route::get('/register', [UserRegisterController::class, 'showForm'])->name('user.register');
      Route::post('/register-submit', [UserRegisterController::class, 'register'])->name('user.register.submit');
      Route::get('/verify-link/{token}', [UserRegisterController::class, 'verify'])->name('user.account.verify');
      //------------ FORGOT ------------
      Route::get('/forgot', [UserForgotController::class, 'showForm'])->name('user.forgot');
      Route::post('/forgot-submit', [UserForgotController::class, 'forgot'])->name('user.forgot.submit');
      Route::get('/change-password/{token}', [UserForgotController::class, 'showChangePassForm'])->name('user.change.token');
      Route::post('/change-password-submit', [UserForgotController::class, 'changepass'])->name('user.change.password');
      //------------ DASHBOARD ------------
      Route::get('/dashboard', [UserAccountController::class, 'index'])->name('user.dashboard');
      Route::get('/profile', [UserAccountController::class, 'profile'])->name('user.profile');
      // ----------- TICKET ---------------//
      Route::get('/ticket', [UserTicketController::class, 'ticket'])->name('user.ticket');
      Route::get('/ticket/new', [UserTicketController::class, 'ticketNew'])->name('user.ticket.create');
      Route::post('/ticket/store', [UserTicketController::class, 'ticketStore'])->name('user.ticket.store');
      Route::get('/ticket/view/{id}', [UserTicketController::class, 'ticketView'])->name('user.ticket.view');
      Route::post('/ticket/reply/store', [UserTicketController::class, 'ticketReply'])->name('user.ticket.reply');
      Route::get('/ticket/delete/{id}', [UserTicketController::class, 'ticketDelete'])->name('user.ticket.delete');
      //------------ SETTING ------------
      Route::post('/profile/update', [UserAccountController::class, 'profileUpdate'])->name('user.profile.update');
      Route::get('/addresses', [UserAccountController::class, 'addresses'])->name('user.address');
      //------------ NUEVO CONTENIDO(INICIO)
      Route::post('/addresses/departamento', [UserAccountController::class, 'getAllDepartamentos'])->name('user.departamento');
      Route::get('/addresses/provincia', [UserAccountController::class, 'getProvinciaByIdDepartamento'])->name('user.provincia');
      Route::get('/addresses/distrito', [UserAccountController::class, 'getDistritoByIdProvincia'])->name('user.distrito');
      //------------ NUEVO CONTENIDO(FIN)
      Route::post('/billing/addresses', [UserAccountController::class, 'billingSubmit'])->name('user.billing.submit');
      Route::post('/shipping/addresses', [UserAccountController::class, 'shippingSubmit'])->name('user.shipping.submit');
      //------------ ORDER ------------
      Route::get('/orders', [UserOrderController::class, 'index'])->name('user.order.index');
      Route::get('/order/print/{id}', [UserOrderController::class, 'printOrder'])->name('user.order.print');
      Route::get('/order/invoice/{id}', [UserOrderController::class, 'details'])->name('user.order.invoice');
      Route::get('/order/pdforderpreview/{id}', [UserOrderController::class, 'getGeneratePDFOrderPreview'])->name('user.order.pdforderpreview');
      //------------ WISHLIST ------------
      Route::get('/wishlists', [WishlistController::class, 'index'])->name('user.wishlist.index');
      Route::get('/wishlist/store/{id}', [WishlistController::class, 'store'])->name('user.wishlist.store');
      Route::get('/wishlist/delete/{id}', [WishlistController::class, 'delete'])->name('user.wishlist.delete');
      Route::get('/wishlista/delete/all', [WishlistController::class, 'alldelete'])->name('user.wishlist.delete.all');
    });

    Route::get('auth/{provider}', [SocialLoginController::class, 'redirectToProvider'])->name('social.provider');
    Route::get('auth/{provider}/callback', [SocialLoginController::class, 'handleProviderCallback']);
    // ************************************ USER PANEL ENDS **********************************************

    // ************************************ FRONTEND **********************************************
    Route::get('/', [FrontendController::class, 'index'])->name('front.index');
    Route::get('/extra-index', [FrontendController::class, 'extraIndex'])->name('front.extraindex');
    Route::get('/product/{slug}', [FrontendController::class, 'product'])->name('front.product');
    Route::post('/product/{slug}', [FrontendController::class, 'product'])->name('front.product');
    // ----------- NUEVO CONTENIDO (INICIO)
    Route::post('/departamento', [FrontendController::class, 'getAllDepartamentos'])->name('front.departamento');
    Route::get('/provincia', [FrontendController::class, 'getProvinciaByIdDepartamento'])->name('front.provincia');
    Route::get('/distrito', [FrontendController::class, 'getDistritoByIdProvincia'])->name('front.distrito');
    Route::get('/getammountdispath', [FrontendController::class, 'getAmmountDispathByDistrito'])->name('front.getammountdispath');
    Route::get('/removevarscolors/{idprod}', [FrontendController::class, 'removeVarsColorsByIdProd'])->name('front.removevarscolors');
    Route::get('/updatevarscolors/{idprod}', [FrontendController::class, 'updateVarsColorByIdProd'])->name('front.updatevarscolors');
    Route::post('/getallbrands', [FrontendController::class, 'getAllBrands'])->name('getallbrands');
    Route::post('/applycoupon', [FrontendController::class, 'applycoupon'])->name('front.applycoupon');
    // ----------- NUEVO CONTENIDO (FIN)
    Route::get('/campaign/products', [FrontendController::class, 'compaignProduct'])->name('front.campaign');
    Route::get('/onsaleproducts/products', [FrontendController::class, 'onsaleproducts'])->name('front.onsaleproducts');
    Route::get('/specialoffer/products', [FrontendController::class, 'specialofferProduct'])->name('front.specialoffer');
    Route::get('/getproductsbycategory/products', [FrontendController::class, 'getProductByCategoryName'])->name('front.getproductsbycategory');
    Route::get('/onsaleproducts/getFilterOnSaleProducts', [FrontendController::class, 'getFilterOnSaleProducts'])->name('front.getFilterOnSaleProducts');
    Route::get('/specialofferproducts/getFilterSpecialOfferProducts', [FrontendController::class, 'getFilterSpecialOfferProducts'])->name('front.getFilterSpecialOfferProducts');
    Route::get('/blog', [FrontendController::class, 'blog'])->name('front.blog');
    Route::get('/allcategories', [FrontendController::class, 'allCategories'])->name('front.allcategories');
    Route::get('/blog/{slug}', [FrontendController::class, 'blogDetails'])->name('front.blog.details');
    Route::get('/faq', [FrontendController::class, 'faq'])->name('front.faq');
    Route::get('/faq/{slug}', [FrontendController::class, 'show'])->name('front.faq.details');
    Route::get('/stores', [FrontendController::class, 'stores'])->name('front.stores');
    Route::get('/contact', [FrontendController::class, 'contact'])->name('front.contact');
    Route::post('/contact/submit', [FrontendController::class, 'contactEmail'])->name('front.contact.submit');
    Route::get('/complaintsbook', [FrontendController::class, 'complaintsbook'])->name('front.complaintsbook');
    Route::post('/complaintsbook/departamento', [FrontendController::class, 'getCmptbkAllDepartamentos'])->name('front.complaintsbook.departamento');
    Route::get('/complaintsbook/provincia', [FrontendController::class, 'getCmptbkProvinciaByIdDepartamento'])->name('front.complaintsbook.provincia');
    Route::get('/complaintsbook/distrito', [FrontendController::class, 'getCmptbkDistritoByIdProvincia'])->name('front.complaintsbook.distrito');
    Route::post('/complaintsbook/submit', [FrontendController::class, 'complaintsbookSend'])->name('front.complaintsbook.submit');
    Route::get('/reviews', [FrontendController::class, 'reviews'])->name('front.reviews');
    Route::get('/review/page', [FrontendController::class, 'review_submit'])->name('front.rev.page');
    Route::get('/review/sub', [FrontendController::class, 'slider_o_update'])->name('front.rev.subbmit');
    Route::get('/top-reviews', [FrontendController::class, 'topReviews'])->name('front.top.reviews');
    Route::post('/review/submit', [FrontendController::class, 'reviewSubmit'])->name('front.review.submit');
    Route::post('/subscriber/submit', [FrontendController::class, 'subscribeSubmit'])->name('front.subscriber.submit');
    Route::get('set/currency/{id}', [FrontendController::class, 'currency'])->name('front.currency.setup');
    Route::get('set/language/{id}', [FrontendController::class, 'language'])->name('front.language.setup');
    // ---------- EXTRA INDEX ROUTE ----------//
    Route::get('popular/category/get/{slug}/{type}/{check}', [HomeCustomizeController::class, 'CategoryGet'])->name('front.popular.category');
    Route::get('product/get/type/{type}', [HomeCustomizeController::class, 'productGet'])->name('front.get.product');
    //------------ COMPARE PRODUCT ------------//
    Route::get('compare/product/{id}', [CompareController::class, 'compare'])->name('fornt.compare.product');
    Route::get('compare/remove/{id}', [CompareController::class, 'compareRemove'])->name('front.compare.remove');
    Route::get('compare/products/', [CompareController::class, 'compare_product'])->name('fornt.compare.index');
    //------------ CART ------------
    Route::get('/cart', [CartController::class, 'index'])->name('front.cart');
    Route::get('/front/cart/clear', [CartController::class, 'cartClear'])->name('front.cart.clear');
    Route::get('/header/cart/load', [CartController::class, 'headerCartLoad'])->name('front.header.cart');
    Route::get('/main/cart/load', [CartController::class, 'CartLoad'])->name('cart.get.load');
    Route::post('/cart/submit', [CartController::class, 'store'])->name('front.cart.submit');
    Route::get('product/add/cart', [CartController::class, 'addToCart'])->name('product.addcart');
    Route::get('/product/cart/update/{id}', [CartController::class, 'update'])->name('product.update.single');
    Route::post('/promo/submit', [CartController::class, 'promoStore'])->name('front.promo.submit');
    Route::get('/cart/destroy/{id}', [CartController::class, 'destroy'])->name('front.cart.destroy');
    Route::post('/shipping/submit', [CartController::class, 'shippingStore'])->name('front.shipping.submit');
    Route::post('/shipping/charge/get', [CartController::class, 'shippingCharge'])->name('front.shipping.charge');
    //------------ CATALOG ------------
    Route::get('/catalog', [FrontCatalogController::class, 'index'])->name('front.catalog');
    Route::get('/search/suggest', [FrontCatalogController::class, 'suggestSearch'])->name('front.search.suggest');
    Route::get('/catalog/view/{type}', [FrontCatalogController::class, 'viewType'])->name('front.catalog.view');
    //------------ CATALOGS ENTERPRISE ------------
    Route::get('/journals', [JournalController::class, 'index'])->name('front.journals');
    Route::get('/journals/getCatalogsByAnio', [FrontendController::class, 'getCatalogsByAnio'])->name('front.getCatalogsByAnio');
    //------------ BRANDS ------------
    Route::get('/brands', [FrontBrandController::class, 'index'])->name('front.brands');
    Route::get('/brands/getBrandsByLetter', [FrontendController::class, 'getBrandsByLetter'])->name('front.getBrandsByLetter');
    //------------ CHECKOUT ------------
    Route::get('/checkout/billing/address', [CheckoutController::class, 'ship_address'])->name('front.checkout.billing');
    Route::post('/checkout/billing/store', [CheckoutController::class, 'billingStore'])->name('front.checkout.store');
    Route::get('/checkout/shpping/address', [CheckoutController::class, 'shipping'])->name('front.checkout.shipping');
    Route::post('/checkout/shpping/store', [CheckoutController::class, 'shippingStore'])->name('front.checkout.shipping.store');
    Route::get('/checkout/review/payment', [CheckoutController::class, 'payment'])->name('front.checkout.payment');
    Route::get('/checkout/state/setup/{state_id}', [CheckoutController::class, 'stateSetUp'])->name('front.state.setup');
    Route::post('/checkout-submit', [CheckoutController::class, 'checkout'])->name('front.checkout.submit');
    Route::get('/checkout/success', [CheckoutController::class, 'paymentSuccess'])->name('front.checkout.success');
    Route::get('/checkout/cancle', [CheckoutController::class, 'paymentCancle'])->name('front.checkout.cancle');
    Route::get('/paypal/checkout/redirect', [CheckoutController::class, 'paymentRedirect'])->name('front.checkout.redirect');
    Route::get('/checkout/mollie/notify', [CheckoutController::class, 'mollieRedirect'])->name('front.checkout.mollie.redirect');
    //------------ NUEVO CONTENIDO(INICIO)
    Route::post('/checkoutprocess', [CheckoutController::class, 'checkoutProcess'])->name('front.checkout.process');
    Route::post('/checkout/shpping/address/departamento', [CheckoutController::class, 'getAllDepartamentos'])->name('front.checkout.departamento');
    Route::get('/checkout/shpping/address/provincia', [CheckoutController::class, 'getProvinciaByIdDepartamento'])->name('front.checkout.provincia');
    Route::get('/checkout/shpping/address/distrito', [CheckoutController::class, 'getDistritoByIdProvincia'])->name('front.checkout.distrito');
    Route::get('/checkout/shpping/address/updateamountcart', [CheckoutController::class, 'updateAmountCart'])->name('front.checkout.updateamountcart');
    Route::post('/checkout/pdforderpreview', [CheckoutController::class, 'getGeneratePDFOrderPreview'])->name('front.checkout.pdforderpreview');
    Route::post('/checkout/setdatavoucher', [CheckoutController::class, 'selTypeOfVoucher'])->name('front.checkout.setdatavoucher');
    Route::post('/checkout/datavoucher', [CheckoutController::class, 'sendDataVoucher'])->name('front.checkout.submitdatavoucher');
    //------------ NUEVO CONTENIDO(FIN)

    Route::post('/paytm/notify', [PaytmController::class, 'notify'])->name('front.paytm.notify');
    Route::post('/paytm/submit', [PaytmController::class, 'store'])->name('front.paytm.submit');
    Route::post('/razorpay/notify', [RazorpayController::class, 'notify'])->name('front.razorpay.notify');
    Route::post('/razorpay/submit', [RazorpayController::class, 'store'])->name('front.razorpay.submit');
    Route::post('/flutterwave/notify', [FlutterwaveController::class, 'notify'])->name('front.flutterwave.notify');
    Route::post('/flutterwave/submit', [FlutterwaveController::class, 'store'])->name('front.flutterwave.submit');
    Route::post('/mercadopago/submit', [MercadopagoController::class, 'store'])->name('front.mercadopago.submit');
    Route::post('/authorize/submit', [AuthorizeController::class, 'store'])->name('front.authorize.submit');
    Route::post('/sslcommerz/notify', [SslCommerzController::class, 'notify'])->name('front.sslcommerz.notify');
    Route::post('/sslcommerz/submit', [SslCommerzController::class, 'store'])->name('front.sslcommerz.submit');
    // ----------- TRACK ORDER ----------//
    Route::get('/track/order', [FrontendController::class, 'trackOrder'])->name('front.order.track');
    Route::get('/order/track/submit', [FrontendController::class, 'track'])->name('front.order.track.submit');
    Route::get('/cache/clear', function () {
      Artisan::call('cache:clear');
      Artisan::call('config:clear');
      Artisan::call('route:clear');
      Artisan::call('view:clear');
      return redirect()->route('back.dashboard')->withSuccess(__('Se ha eliminado la memoria caché del sistema.'));
    })->name('front.cache.clear');
    //------------ PAGE ------------
    Route::get('/{slug}', [FrontendController::class, 'page'])->name('front.page');
    // ************************************ FRONTEND ENDS **********************************************
  });
});
// ************************************ GLOBAL LOCALIZATION ENDS **********************************************

Route::get('/website/maintainance', [FrontendController::class, 'maintainance'])->name('front.maintainance');