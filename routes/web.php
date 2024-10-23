<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\dashboard\Analytics;
use App\Http\Controllers\layouts\WithoutMenu;
use App\Http\Controllers\layouts\WithoutNavbar;
use App\Http\Controllers\layouts\Fluid;
use App\Http\Controllers\layouts\Container;
use App\Http\Controllers\layouts\Blank;
use App\Http\Controllers\pages\AccountSettingsAccount;
use App\Http\Controllers\pages\AccountSettingsNotifications;
use App\Http\Controllers\pages\AccountSettingsConnections;
use App\Http\Controllers\pages\MiscError;
use App\Http\Controllers\pages\MiscUnderMaintenance;
use App\Http\Controllers\authentications\LoginBasic;
use App\Http\Controllers\authentications\RegisterBasic;
use App\Http\Controllers\authentications\ForgotPasswordBasic;
use App\Http\Controllers\cards\CardBasic;
use App\Http\Controllers\user_interface\Accordion;
use App\Http\Controllers\user_interface\Alerts;
use App\Http\Controllers\user_interface\Badges;
use App\Http\Controllers\user_interface\Buttons;
use App\Http\Controllers\user_interface\Carousel;
use App\Http\Controllers\user_interface\Collapse;
use App\Http\Controllers\user_interface\Dropdowns;
use App\Http\Controllers\user_interface\Footer;
use App\Http\Controllers\user_interface\ListGroups;
use App\Http\Controllers\user_interface\Modals;
use App\Http\Controllers\user_interface\Navbar;
use App\Http\Controllers\user_interface\Offcanvas;
use App\Http\Controllers\user_interface\PaginationBreadcrumbs;
use App\Http\Controllers\user_interface\Progress;
use App\Http\Controllers\user_interface\Spinners;
use App\Http\Controllers\user_interface\TabsPills;
use App\Http\Controllers\user_interface\Toasts;
use App\Http\Controllers\user_interface\TooltipsPopovers;
use App\Http\Controllers\user_interface\Typography;
use App\Http\Controllers\extended_ui\PerfectScrollbar;
use App\Http\Controllers\extended_ui\TextDivider;
use App\Http\Controllers\icons\MdiIcons;
use App\Http\Controllers\form_elements\BasicInput;
use App\Http\Controllers\form_elements\InputGroups;
use App\Http\Controllers\form_layouts\VerticalForm;
use App\Http\Controllers\form_layouts\HorizontalForm;
use App\Http\Controllers\tables\Basic as TablesBasic;
use App\Http\Controllers\WasteController;
use App\Http\Controllers\DisposalRecordController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\RecyclingCenterController;


use App\Http\Controllers\EquipmentController;

use App\Http\Controllers\MaintenanceController;


use App\Http\Controllers\EventController;

// Main Page Route
Route::get('/', [Analytics::class, 'index'])->name('dashboard-analytics');



// pages
Route::get('/pages/account-settings-account', [AccountSettingsAccount::class, 'index'])->name(
  'pages-account-settings-account'
);
Route::get('/pages/account-settings-notifications', [AccountSettingsNotifications::class, 'index'])->name(
  'pages-account-settings-notifications'
);
Route::get('/pages/account-settings-connections', [AccountSettingsConnections::class, 'index'])->name(
  'pages-account-settings-connections'
);
Route::get('/pages/misc-error', [MiscError::class, 'index'])->name('pages-misc-error');
Route::get('/pages/misc-under-maintenance', [MiscUnderMaintenance::class, 'index'])->name(
  'pages-misc-under-maintenance'
);

// authentication
Route::get('/auth/login-basic', [LoginBasic::class, 'index'])->name('auth-login-basic');
Route::get('/auth/register-basic', [RegisterBasic::class, 'index'])->name('auth-register-basic');
Route::get('/auth/forgot-password-basic', [ForgotPasswordBasic::class, 'index'])->name('auth-reset-password-basic');

// form elements
Route::get('/forms/basic-inputs', [BasicInput::class, 'index'])->name('forms-basic-inputs');
Route::get('/forms/input-groups', [InputGroups::class, 'index'])->name('forms-input-groups');

// form layouts
Route::get('/form/layouts-vertical', [VerticalForm::class, 'index'])->name('form-layouts-vertical');
Route::get('/form/layouts-horizontal', [HorizontalForm::class, 'index'])->name('form-layouts-horizontal');

// tables
Route::get('/tables/basic', [TablesBasic::class, 'index'])->name('tables-basic');

// waste

Route::get('/wastes', [WasteController::class, 'index'])->name('wastes.index');
Route::get('/wastes/create', [WasteController::class, 'create'])->name('wastes.create');
Route::get('/wastes/{id}/edit', [WasteController::class, 'edit'])->name('wastes.edit');
Route::delete('/wastes/{id}', [WasteController::class, 'destroy'])->name('wastes.destroy');
Route::resource('wastes', WasteController::class);

//enregistrement
Route::get('/disposalRecords', [DisposalRecordController::class, 'index'])->name('disposalRecords.index');

Route::get('/disposalRecords/create', [DisposalRecordController::class, 'create'])->name('disposalRecords.create');
Route::get('/disposalRecords/{id}/edit', [DisposalRecordController::class, 'edit'])->name('disposalRecords.edit');
Route::delete('/disposalRecords/{id}', [DisposalRecordController::class, 'destroy'])->name('disposalRecords.destroy');
Route::resource('disposalRecords', DisposalRecordController::class);
Route::resource('disposalRecords', DisposalRecordController::class);

Route::post('/disposal-records/{id}/process', [DisposalRecordController::class, 'destroy'])->name(
  'disposalRecords.process'
);
Route::post('/disposal-records/{id}/process', [DisposalRecordController::class, 'process'])->name(
  'disposalRecords.process'
);


// Categories de centre
Route::resource('categories', CategoryController::class)->names([
    'index' => 'CategorieCentre.index',
    'create' => 'CategorieCentre.create',
    'store' => 'CategorieCentre.store',
    'show' => 'CategorieCentre.show',
    'edit' => 'CategorieCentre.edit',
    'update' => 'CategorieCentre.update',
    'destroy' => 'CategorieCentre.destroy',
]);

// Centre de recyclage
route::resource('recycling_centers', RecyclingCenterController::class)->names([
    'index' => 'CentreRecyclage.index',
    'create' => 'CentreRecyclage.create',
    'store' => 'CentreRecyclage.store',
    'show' => 'CentreRecyclage.show',
    'edit' => 'CentreRecyclage.edit',
    'update' => 'CentreRecyclage.update',
    'destroy' => 'CentreRecyclage.destroy',
]);



//equipement
Route::resource('equipment', EquipmentController::class);
Route::get('/equipment', [EquipmentController::class, 'index'])->name('equipment.index');
Route::get('/equipment/create', [EquipmentController::class, 'create'])->name('equipment.create');
Route::get('/equipment/{id}/edit', [EquipmentController::class, 'edit'])->name('equipment.edit');
Route::delete('/equipment/{id}', [EquipmentController::class, 'destroy'])->name('equipment.destroy');
Route::get('/equipment/{id}', [EquipmentController::class, 'show'])->name('equipment.show');

// Routes pour les maintenances

Route::get('/maintenance', [MaintenanceController::class, 'index'])->name('maintenance.index');
Route::get('/maintenance/create', [MaintenanceController::class, 'create'])->name('maintenance.create');
Route::post('/maintenance', [MaintenanceController::class, 'store'])->name('maintenance.store');
Route::get('/maintenance/{maintenanceId}/edit', [MaintenanceController::class, 'edit'])->name('maintenance.edit');
Route::put('/maintenance/{maintenanceId}', [MaintenanceController::class, 'update'])->name('maintenance.update');
Route::delete('/maintenance/{maintenanceId}', [MaintenanceController::class, 'destroy'])->name('maintenance.destroy');
Route::get('/maintenance/{maintenanceId}', [MaintenanceController::class, 'show'])->name('maintenance.show');



//events
// Liste des événements
Route::get('/events', [EventController::class, 'index'])->name('events.index');
Route::get('/events/create', [EventController::class, 'create'])->name('events.create');
Route::post('/events/create', [EventController::class, 'store'])->name('events.store');
Route::put('/events/{id}/edit', [EventController::class, 'update'])->name('events.update');
Route::get('/events/{id}', [EventController::class, 'edit'])->name('events.edit');
Route::delete('/events/{id}', [EventController::class, 'destroy'])->name('events.destroy');
Route::get('/events/{id}', [EventController::class, 'show'])->name('events.show');

Route::resource('events', EventController::class);

// Route pour retirer une participation
Route::delete('events/{event}/participations/{participation}', [ParticipationController::class, 'destroy'])->name('participations.destroy');

Route::resource('articles', ArticleController::class);
Route::delete('/comments/{id}', [CommentController::class, 'destroy'])->name('comments.destroy');


