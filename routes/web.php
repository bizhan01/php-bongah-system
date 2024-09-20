<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Auth::routes();

//Route::get('/', 'HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function () {

    Route::get('logout', 'Auth\LoginController@logout');

//    Dashboard
    Route::get('/', [
        'uses' => 'DashboardController@index',
        'as' => 'dashboard'
    ]);

//    profile
    Route::get('/profile', [
        'uses' => 'ProfileController@index',
        'as' => 'profile'
    ]);

    Route::post('/profile/update/{id}', [
        'uses' => 'ProfileController@update',
        'as' => 'profile.update'
    ]);


    //    User
    Route::get('/user', [
        'uses' => 'UsersController@index',
        'as' => 'user'
    ])->middleware('user.module_show');

    Route::get('/user/create', [
        'uses' => 'UsersController@create',
        'as' => 'user.create'
    ])->middleware('user.create');

    Route::post('/user/store', [
        'uses' => 'UsersController@store',
        'as' => 'user.store'
    ])->middleware('user.create');


    Route::get('/user/edit/{id}', [
        'uses' => 'UsersController@edit',
        'as' => 'user.edit'
    ])->middleware('user.edit');

    Route::post('/user/update/{id}', [
        'uses' => 'UsersController@update',
        'as' => 'user.update'
    ])->middleware('user.edit');

    Route::get('/user/show/{id}', [
        'uses' => 'UsersController@show',
        'as' => 'user.show'
    ]);

    Route::get('/user/destroy/{id}', [
        'uses' => 'UsersController@destroy',
        'as' => 'user.destroy'
    ])->middleware('user.delete');

    Route::get('/user/trashed', [
        'uses' => 'UsersController@trashed',
        'as' => 'user.trashed'
    ])->middleware('user.trash_show');

    Route::post('/user/trashed/show', [
        'uses' => 'UsersController@trashedShow',
        'as' => 'user.trashed.show'
    ]);


    Route::get('/user/restore/{id}', [
        'uses' => 'UsersController@restore',
        'as' => 'user.restore'
    ])->middleware('user.restore');

    Route::get('/user/kill/{id}', [
        'uses' => 'UsersController@kill',
        'as' => 'user.kill'
    ])->middleware('user.permanently_delete');

    Route::get('/user/active/search', [
        'uses' => 'UsersController@activeSearch',
        'as' => 'user.active.search'
    ]);

    Route::get('/user/trashed/search', [
        'uses' => 'UsersController@trashedSearch',
        'as' => 'user.trashed.search'
    ]);

    Route::get('/user/active/action', [
        'uses' => 'UsersController@activeAction',
        'as' => 'user.active.action'
    ]);

    Route::get('/user/trashed/action', [
        'uses' => 'UsersController@trashedAction',
        'as' => 'user.trashed.action'
    ]);


    Route::post('users/password', [
        'uses' => 'ProfileController@changePassword',
        'as' => 'users.password'
    ]);

    //    User End

//    Settings

    Route::get('/settings/general', [
        'uses' => 'SettingsController@general_show',
        'as' => 'settings.general'
    ])->middleware('settings.all');

    Route::post('/settings/general/update', [
        'uses' => 'SettingsController@general_update',
        'as' => 'settings.general.update'
    ]);


    Route::get('/settings/system', [
        'uses' => 'SettingsController@system_show',
        'as' => 'settings.system'
    ])->middleware('settings.show');

    Route::post('/settings/system/update', [
        'uses' => 'SettingsController@system_update',
        'as' => 'settings.system.update'
    ]);


//    Role Manage
    Route::get('/role-manage', [
        'uses' => 'RoleManageController@index',
        'as' => 'role-manage'
    ])->middleware('role.module_show');

    Route::get('/role-manage/show/{id}', [
        'uses' => 'RoleManageController@show',
        'as' => 'role-manage.show'
    ])->middleware('role.show');

    Route::get('/role-manage/create', [
        'uses' => 'RoleManageController@create',
        'as' => 'role-manage.create'
    ])->middleware('role.create');

    Route::post('/role-manage/store', [
        'uses' => 'RoleManageController@store',
        'as' => 'role-manage.store'
    ])->middleware('role.create');


    Route::get('/role-manage/edit/{id}', [
        'uses' => 'RoleManageController@edit',
        'as' => 'role-manage.edit'
    ])->middleware('role.edit');
    Route::post('/role-manage/update/{id}', [
        'uses' => 'RoleManageController@update',
        'as' => 'role-manage.update'
    ])->middleware('role.edit');


    Route::get('/role-manage/destroy/{id}', [
        'uses' => 'RoleManageController@destroy',
        'as' => 'role-manage.destroy'
    ])->middleware('role.delete');

    Route::get('/role-manage/pdf/{id}', [
        'uses' => 'RoleManageController@pdf',
        'as' => 'role-manage.pdf'
    ])->middleware('role.pdf');


    Route::get('/role-manage/trashed', [
        'uses' => 'RoleManageController@trashed',
        'as' => 'role-manage.trashed'
    ])->middleware('role.trash_show');


    Route::get('/role-manage/restore/{id}', [
        'uses' => 'RoleManageController@restore',
        'as' => 'role-manage.restore'
    ])->middleware('role.restore');


    Route::get('/role-manage/kill/{id}', [
        'uses' => 'RoleManageController@kill',
        'as' => 'role-manage.kill'
    ])->middleware('role.permanently_delete');

    Route::get('/role-manage/active/search', [
        'uses' => 'RoleManageController@activeSearch',
        'as' => 'role-manage.active.search'
    ]);

    Route::get('/role-manage/trashed/search', [
        'uses' => 'RoleManageController@trashedSearch',
        'as' => 'role-manage.trashed.search'
    ]);

    Route::get('/role-manage/active/action', [
        'uses' => 'RoleManageController@activeAction',
        'as' => 'role-manage.active.action'
    ])->middleware('role.delete');

    Route::get('/role-manage/trashed/action', [
        'uses' => 'RoleManageController@trashedAction',
        'as' => 'role-manage.trashed.action'
    ]);

    //    role-manage End


//    Branch Manage
    Route::get('/branch', [
        'uses' => 'BranchController@index',
        'as' => 'branch'
    ])->middleware('branch.module_show');

    Route::get('/branch/show/{id}', [
        'uses' => 'BranchController@show',
        'as' => 'branch.show'
    ])->middleware('branch.show');

    Route::get('/branch/create', [
        'uses' => 'BranchController@create',
        'as' => 'branch.create'
    ])->middleware('branch.create');

    Route::post('/branch/store', [
        'uses' => 'BranchController@store',
        'as' => 'branch.store'
    ])->middleware('branch.create');


    Route::get('/branch/edit/{id}', [
        'uses' => 'BranchController@edit',
        'as' => 'branch.edit'
    ])->middleware('branch.edit');
    Route::post('/branch/update/{id}', [
        'uses' => 'BranchController@update',
        'as' => 'branch.update'
    ])->middleware('branch.edit');


    Route::get('/branch/destroy/{id}', [
        'uses' => 'BranchController@destroy',
        'as' => 'branch.destroy'
    ])->middleware('branch.delete');

    Route::get('/branch/pdf/{id}', [
        'uses' => 'BranchController@pdf',
        'as' => 'branch.pdf'
    ])->middleware('branch.pdf');


    Route::get('/branch/trashed', [
        'uses' => 'BranchController@trashed',
        'as' => 'branch.trashed'
    ])->middleware('branch.trash_show');


    Route::get('/branch/restore/{id}', [
        'uses' => 'BranchController@restore',
        'as' => 'branch.restore'
    ])->middleware('branch.restore');


    Route::get('/branch/kill/{id}', [
        'uses' => 'BranchController@kill',
        'as' => 'branch.kill'
    ])->middleware('branch.permanently_delete');

    Route::get('/branch/active/search', [
        'uses' => 'BranchController@activeSearch',
        'as' => 'branch.active.search'
    ]);

    Route::get('/branch/trashed/search', [
        'uses' => 'BranchController@trashedSearch',
        'as' => 'branch.trashed.search'
    ]);

    Route::get('/branch/active/action', [
        'uses' => 'BranchController@activeAction',
        'as' => 'branch.active.action'
    ])->middleware('branch.delete');

    Route::get('/branch/trashed/action', [
        'uses' => 'BranchController@trashedAction',
        'as' => 'branch.trashed.action'
    ]);
    //    Branch Manage End


//  Product Manage
    Route::get('/product', [
        'uses' => 'ProductController@index',
        'as' => 'product'
    ])->middleware('product.all');

    Route::get('/product/show/{id}', [
        'uses' => 'ProductController@show',
        'as' => 'product.show'
    ])->middleware('product.show');

    Route::get('/product/create', [
        'uses' => 'ProductController@create',
        'as' => 'product.create'
    ])->middleware('product.create');

    Route::post('/product/store', [
        'uses' => 'ProductController@store',
        'as' => 'product.store'
    ])->middleware('product.create');


    Route::get('/product/edit/{id}', [
        'uses' => 'ProductController@edit',
        'as' => 'product.edit'
    ])->middleware('product.edit');
    Route::post('/product/update/{id}', [
        'uses' => 'ProductController@update',
        'as' => 'product.update'
    ])->middleware('product.edit');


    Route::get('/product/destroy/{id}', [
        'uses' => 'ProductController@destroy',
        'as' => 'product.destroy'
    ])->middleware('product.delete');

    Route::get('/product/pdf/{id}', [
        'uses' => 'ProductController@pdf',
        'as' => 'product.pdf'
    ])->middleware('product.pdf');


    Route::get('/product/trashed', [
        'uses' => 'ProductController@trashed',
        'as' => 'product.trashed'
    ])->middleware('product.trash_show');


    Route::get('/product/restore/{id}', [
        'uses' => 'ProductController@restore',
        'as' => 'product.restore'
    ])->middleware('product.restore');


    Route::get('/product/kill/{id}', [
        'uses' => 'ProductController@kill',
        'as' => 'product.kill'
    ])->middleware('product.permanently_delete');

    Route::get('/product/active/search', [
        'uses' => 'ProductController@activeSearch',
        'as' => 'product.active.search'
    ]);

    Route::get('/product/trashed/search', [
        'uses' => 'ProductController@trashedSearch',
        'as' => 'product.trashed.search'
    ]);

    Route::get('/product/active/action', [
        'uses' => 'ProductController@activeAction',
        'as' => 'product.active.action'
    ])->middleware('product.delete');

    Route::get('/product/trashed/action', [
        'uses' => 'ProductController@trashedAction',
        'as' => 'product.trashed.action'
    ]);
//    Product Manage End


//    Customer Manage
    Route::get('/customer', [
        'uses' => 'CustomerController@index',
        'as' => 'customer'
    ])->middleware('customer.all');

    Route::get('/customer/show/{id}', [
        'uses' => 'CustomerController@show',
        'as' => 'customer.show'
    ])->middleware('customer.show');

    Route::get('/customer/create', [
        'uses' => 'CustomerController@create',
        'as' => 'customer.create'
    ])->middleware('customer.create');

    Route::post('/customer/store', [
        'uses' => 'CustomerController@store',
        'as' => 'customer.store'
    ])->middleware('customer.create');


    Route::get('/customer/edit/{id}', [
        'uses' => 'CustomerController@edit',
        'as' => 'customer.edit'
    ])->middleware('customer.edit');
    Route::post('/customer/update/{id}', [
        'uses' => 'CustomerController@update',
        'as' => 'customer.update'
    ])->middleware('customer.edit');


    Route::get('/customer/destroy/{id}', [
        'uses' => 'CustomerController@destroy',
        'as' => 'customer.destroy'
    ])->middleware('customer.delete');

    Route::get('/customer/pdf/{id}', [
        'uses' => 'CustomerController@pdf',
        'as' => 'customer.pdf'
    ])->middleware('customer.pdf');


    Route::get('/customer/trashed', [
        'uses' => 'CustomerController@trashed',
        'as' => 'customer.trashed'
    ])->middleware('customer.trash_show');


    Route::get('/customer/restore/{id}', [
        'uses' => 'CustomerController@restore',
        'as' => 'customer.restore'
    ])->middleware('customer.restore');


    Route::get('/customer/kill/{id}', [
        'uses' => 'CustomerController@kill',
        'as' => 'customer.kill'
    ])->middleware('customer.permanently_delete');

    Route::get('/customer/active/search', [
        'uses' => 'CustomerController@activeSearch',
        'as' => 'customer.active.search'
    ]);

    Route::get('/customer/trashed/search', [
        'uses' => 'CustomerController@trashedSearch',
        'as' => 'customer.trashed.search'
    ]);

    Route::get('/customer/active/action', [
        'uses' => 'CustomerController@activeAction',
        'as' => 'customer.active.action'
    ])->middleware('customer.delete');

    Route::get('/customer/trashed/action', [
        'uses' => 'CustomerController@trashedAction',
        'as' => 'customer.trashed.action'
    ]);
    //    Customer Manage End


//    Vendor Manage
    Route::get('/vendor', [
        'uses' => 'VendorController@index',
        'as' => 'vendor'
    ])->middleware('vendor.all');

    Route::get('/vendor/show/{id}', [
        'uses' => 'VendorController@show',
        'as' => 'vendor.show'
    ])->middleware('vendor.show');

    Route::get('/vendor/create', [
        'uses' => 'VendorController@create',
        'as' => 'vendor.create'
    ])->middleware('vendor.create');

    Route::post('/vendor/store', [
        'uses' => 'VendorController@store',
        'as' => 'vendor.store'
    ])->middleware('vendor.create');


    Route::get('/vendor/edit/{id}', [
        'uses' => 'VendorController@edit',
        'as' => 'vendor.edit'
    ])->middleware('vendor.edit');
    Route::post('/vendor/update/{id}', [
        'uses' => 'VendorController@update',
        'as' => 'vendor.update'
    ])->middleware('vendor.edit');


    Route::get('/vendor/destroy/{id}', [
        'uses' => 'VendorController@destroy',
        'as' => 'vendor.destroy'
    ])->middleware('vendor.delete');

    Route::get('/vendor/pdf/{id}', [
        'uses' => 'VendorController@pdf',
        'as' => 'vendor.pdf'
    ])->middleware('vendor.pdf');


    Route::get('/vendor/trashed', [
        'uses' => 'VendorController@trashed',
        'as' => 'vendor.trashed'
    ])->middleware('vendor.trash_show');


    Route::get('/vendor/restore/{id}', [
        'uses' => 'VendorController@restore',
        'as' => 'vendor.restore'
    ])->middleware('vendor.restore');


    Route::get('/vendor/kill/{id}', [
        'uses' => 'VendorController@kill',
        'as' => 'vendor.kill'
    ])->middleware('vendor.permanently_delete');

    Route::get('/vendor/active/search', [
        'uses' => 'VendorController@activeSearch',
        'as' => 'vendor.active.search'
    ]);

    Route::get('/vendor/trashed/search', [
        'uses' => 'VendorController@trashedSearch',
        'as' => 'vendor.trashed.search'
    ]);

    Route::get('/vendor/active/action', [
        'uses' => 'VendorController@activeAction',
        'as' => 'vendor.active.action'
    ])->middleware('vendor.delete');

    Route::get('/vendor/trashed/action', [
        'uses' => 'VendorController@trashedAction',
        'as' => 'vendor.trashed.action'
    ]);
    //    Vendor Manage End

//   Employee Manage
    Route::get('/employee', [
        'uses' => 'EmployeeController@index',
        'as' => 'employee'
    ])->middleware('employee.all');

    Route::get('/employee/show/{id}', [
        'uses' => 'EmployeeController@show',
        'as' => 'employee.show'
    ])->middleware('employee.show');

    Route::get('/employee/create', [
        'uses' => 'EmployeeController@create',
        'as' => 'employee.create'
    ])->middleware('employee.create');

    Route::post('/employee/store', [
        'uses' => 'EmployeeController@store',
        'as' => 'employee.store'
    ])->middleware('employee.create');


    Route::get('/employee/edit/{id}', [
        'uses' => 'EmployeeController@edit',
        'as' => 'employee.edit'
    ])->middleware('employee.edit');
    Route::post('/employee/update/{id}', [
        'uses' => 'EmployeeController@update',
        'as' => 'employee.update'
    ])->middleware('employee.edit');


    Route::get('/employee/destroy/{id}', [
        'uses' => 'EmployeeController@destroy',
        'as' => 'employee.destroy'
    ])->middleware('employee.delete');

    Route::get('/employee/pdf/{id}', [
        'uses' => 'EmployeeController@pdf',
        'as' => 'employee.pdf'
    ])->middleware('employee.pdf');


    Route::get('/employee/trashed', [
        'uses' => 'EmployeeController@trashed',
        'as' => 'employee.trashed'
    ])->middleware('employee.trash_show');


    Route::get('/employee/restore/{id}', [
        'uses' => 'EmployeeController@restore',
        'as' => 'employee.restore'
    ])->middleware('employee.restore');


    Route::get('/employee/kill/{id}', [
        'uses' => 'EmployeeController@kill',
        'as' => 'employee.kill'
    ])->middleware('employee.permanently_delete');

    Route::get('/employee/active/search', [
        'uses' => 'EmployeeController@activeSearch',
        'as' => 'employee.active.search'
    ]);

    Route::get('/employee/trashed/search', [
        'uses' => 'EmployeeController@trashedSearch',
        'as' => 'employee.trashed.search'
    ]);

    Route::get('/employee/active/action', [
        'uses' => 'EmployeeController@activeAction',
        'as' => 'employee.active.action'
    ])->middleware('employee.delete');

    Route::get('/employee/trashed/action', [
        'uses' => 'EmployeeController@trashedAction',
        'as' => 'employee.trashed.action'
    ]);
    //    Employee Manage End


//   Selles Manage
    Route::get('/sell', [
        'uses' => 'SellController@index',
        'as' => 'sell'
    ])->middleware('sell.all');

    Route::get('/sell/show/{id}', [
        'uses' => 'SellController@show',
        'as' => 'sell.show'
    ])->middleware('sell.show');

    Route::get('/sell/create', [
        'uses' => 'SellController@create',
        'as' => 'sell.create'
    ])->middleware('sell.create');

    Route::post('/sell/store', [
        'uses' => 'SellController@store',
        'as' => 'sell.store'
    ])->middleware('sell.create');


    Route::get('/sell/edit/{id}', [
        'uses' => 'SellController@edit',
        'as' => 'sell.edit'
    ])->middleware('sell.edit');
    Route::post('/sell/update/{id}', [
        'uses' => 'SellController@update',
        'as' => 'sell.update'
    ])->middleware('sell.edit');


    Route::get('/sell/destroy/{id}', [
        'uses' => 'SellController@destroy',
        'as' => 'sell.destroy'
    ])->middleware('sell.delete');

    Route::get('/sell/pdf/{id}', [
        'uses' => 'SellController@pdf',
        'as' => 'sell.pdf'
    ])->middleware('sell.pdf');


    Route::get('/sell/trashed', [
        'uses' => 'SellController@trashed',
        'as' => 'sell.trashed'
    ])->middleware('sell.trash_show');


    Route::get('/sell/restore/{id}', [
        'uses' => 'SellController@restore',
        'as' => 'sell.restore'
    ])->middleware('sell.restore');


    Route::get('/sell/kill/{id}', [
        'uses' => 'SellController@kill',
        'as' => 'sell.kill'
    ])->middleware('sell.permanently_delete');

    Route::get('/sell/active/search', [
        'uses' => 'SellController@activeSearch',
        'as' => 'sell.active.search'
    ]);

    Route::get('/sell/trashed/search', [
        'uses' => 'SellController@trashedSearch',
        'as' => 'sell.trashed.search'
    ]);

    Route::get('/sell/active/action', [
        'uses' => 'SellController@activeAction',
        'as' => 'sell.active.action'
    ])->middleware('sell.delete');

    Route::get('/sell/trashed/action', [
        'uses' => 'SellController@trashedAction',
        'as' => 'sell.trashed.action'
    ]);


    // ajax call
    Route::post('sell/branch/change', [
        'uses' => 'SellController@change_branch_get_unsold_product',
        'as' => 'sell.branch.change'
    ]);

    //    Sells Manage End


    // Purchase Requisition Start
    Route::get('/purchase_requisition', [
        'uses' => 'PurchaseRequisitionController@index',
        'as' => 'purchase_requisition'
    ])->middleware('purchase_requisition.all');

    Route::get('/purchase_requisition/show/{id}', [
        'uses' => 'PurchaseRequisitionController@show',
        'as' => 'purchase_requisition.show'
    ])->middleware('purchase_requisition.show');

    Route::get('/purchase_requisition/create', [
        'uses' => 'PurchaseRequisitionController@create',
        'as' => 'purchase_requisition.create'
    ])->middleware('purchase_requisition.create');

    Route::post('/purchase_requisition/store', [
        'uses' => 'PurchaseRequisitionController@store',
        'as' => 'purchase_requisition.store'
    ])->middleware('purchase_requisition.create');


    Route::get('/purchase_requisition/edit/{id}', [
        'uses' => 'PurchaseRequisitionController@edit',
        'as' => 'purchase_requisition.edit'
    ])->middleware('purchase_requisition.edit');
    Route::post('/purchase_requisition/update/{id}', [
        'uses' => 'PurchaseRequisitionController@update',
        'as' => 'purchase_requisition.update'
    ])->middleware('purchase_requisition.edit');


    Route::get('/purchase_requisition/destroy/{id}', [
        'uses' => 'PurchaseRequisitionController@destroy',
        'as' => 'purchase_requisition.destroy'
    ])->middleware('purchase_requisition.delete');

    Route::get('/purchase_requisition/pdf/{id}', [
        'uses' => 'PurchaseRequisitionController@pdf',
        'as' => 'purchase_requisition.pdf'
    ])->middleware('purchase_requisition.pdf');


    Route::get('/purchase_requisition/trashed', [
        'uses' => 'PurchaseRequisitionController@trashed',
        'as' => 'purchase_requisition.trashed'
    ])->middleware('purchase_requisition.trash_show');


    Route::get('/purchase_requisition/restore/{id}', [
        'uses' => 'PurchaseRequisitionController@restore',
        'as' => 'purchase_requisition.restore'
    ])->middleware('purchase_requisition.restore');


    Route::get('/purchase_requisition/kill/{id}', [
        'uses' => 'PurchaseRequisitionController@kill',
        'as' => 'purchase_requisition.kill'
    ])->middleware('purchase_requisition.permanently_delete');

    Route::get('/purchase_requisition/active/search', [
        'uses' => 'PurchaseRequisitionController@activeSearch',
        'as' => 'purchase_requisition.active.search'
    ]);

    Route::get('/purchase_requisition/trashed/search', [
        'uses' => 'PurchaseRequisitionController@trashedSearch',
        'as' => 'purchase_requisition.trashed.search'
    ]);

    Route::get('/purchase_requisition/active/action', [
        'uses' => 'PurchaseRequisitionController@activeAction',
        'as' => 'purchase_requisition.active.action'
    ])->middleware('purchase_requisition.delete');

    Route::get('/purchase_requisition/trashed/action', [
        'uses' => 'PurchaseRequisitionController@trashedAction',
        'as' => 'purchase_requisition.trashed.action'
    ]);

    // Purchase Requisition End


    // Requisition Confirmed Start
    Route::get('/requisition_confirmed', [
        'uses' => 'RequisitionConfirmedController@index',
        'as' => 'requisition_confirmed'
    ])->middleware('purchase_rqn_confirm.all');

    Route::get('/requisition_confirmed/show/{id}', [
        'uses' => 'RequisitionConfirmedController@show',
        'as' => 'requisition_confirmed.show'
    ])->middleware('purchase_rqn_confirm.show');

    Route::get('/requisition_confirmed/create', [
        'uses' => 'RequisitionConfirmedController@create',
        'as' => 'requisition_confirmed.create'
    ])->middleware('purchase_rqn_confirm.create');

    Route::post('/requisition_confirmed/store', [
        'uses' => 'RequisitionConfirmedController@store',
        'as' => 'requisition_confirmed.store'
    ])->middleware('purchase_rqn_confirm.create');


    Route::get('/requisition_confirmed/edit/{id}', [
        'uses' => 'RequisitionConfirmedController@edit',
        'as' => 'requisition_confirmed.edit'
    ])->middleware('purchase_rqn_confirm.edit');
    Route::post('/requisition_confirmed/update/{id}', [
        'uses' => 'RequisitionConfirmedController@update',
        'as' => 'requisition_confirmed.update'
    ])->middleware('purchase_rqn_confirm.edit');


    Route::get('/requisition_confirmed/destroy/{id}', [
        'uses' => 'RequisitionConfirmedController@destroy',
        'as' => 'requisition_confirmed.destroy'
    ])->middleware('purchase_rqn_confirm.delete');

    Route::get('/requisition_confirmed/pdf/{id}', [
        'uses' => 'RequisitionConfirmedController@pdf',
        'as' => 'requisition_confirmed.pdf'
    ])->middleware('purchase_rqn_confirm.pdf');


    Route::get('/requisition_confirmed/trashed', [
        'uses' => 'RequisitionConfirmedController@trashed',
        'as' => 'requisition_confirmed.trashed'
    ])->middleware('purchase_rqn_confirm.trash_show');


    Route::get('/requisition_confirmed/restore/{id}', [
        'uses' => 'RequisitionConfirmedController@restore',
        'as' => 'requisition_confirmed.restore'
    ])->middleware('purchase_rqn_confirm.restore');


    Route::get('/requisition_confirmed/kill/{id}', [
        'uses' => 'RequisitionConfirmedController@kill',
        'as' => 'requisition_confirmed.kill'
    ])->middleware('purchase_rqn_confirm.permanently_delete');

    Route::get('/requisition_confirmed/active/search', [
        'uses' => 'RequisitionConfirmedController@activeSearch',
        'as' => 'requisition_confirmed.active.search'
    ]);

    Route::get('/requisition_confirmed/trashed/search', [
        'uses' => 'RequisitionConfirmedController@trashedSearch',
        'as' => 'requisition_confirmed.trashed.search'
    ]);

    Route::get('/requisition_confirmed/active/action', [
        'uses' => 'RequisitionConfirmedController@activeAction',
        'as' => 'requisition_confirmed.active.action'
    ])->middleware('purchase_rqn_confirm.delete');

    Route::get('/requisition_confirmed/trashed/action', [
        'uses' => 'RequisitionConfirmedController@trashedAction',
        'as' => 'requisition_confirmed.trashed.action'
    ]);

    // Requisition Confirmed  End


    // Purchase order Start
    Route::get('/purchase_order', [
        'uses' => 'PurchaseOrderController@index',
        'as' => 'purchase_order'
    ])->middleware('purchase_order.all');

    Route::get('/purchase_order/show/{id}', [
        'uses' => 'PurchaseOrderController@show',
        'as' => 'purchase_order.show'
    ])->middleware('purchase_order.show');

    Route::get('/purchase_order/create', [
        'uses' => 'PurchaseOrderController@create',
        'as' => 'purchase_order.create'
    ])->middleware('purchase_order.create');

    Route::post('/purchase_order/store', [
        'uses' => 'PurchaseOrderController@store',
        'as' => 'purchase_order.store'
    ])->middleware('purchase_order.create');


    Route::get('/purchase_order/edit/{id}', [
        'uses' => 'PurchaseOrderController@edit',
        'as' => 'purchase_order.edit'
    ])->middleware('purchase_order.edit');
    Route::post('/purchase_order/update/{id}', [
        'uses' => 'PurchaseOrderController@update',
        'as' => 'purchase_order.update'
    ])->middleware('purchase_order.edit');


    Route::get('/purchase_order/destroy/{id}', [
        'uses' => 'PurchaseOrderController@destroy',
        'as' => 'purchase_order.destroy'
    ])->middleware('purchase_order.delete');

    Route::get('/purchase_order/pdf/{id}', [
        'uses' => 'PurchaseOrderController@pdf',
        'as' => 'purchase_order.pdf'
    ])->middleware('purchase_order.pdf');


    Route::get('/purchase_order/trashed', [
        'uses' => 'PurchaseOrderController@trashed',
        'as' => 'purchase_order.trashed'
    ])->middleware('purchase_order.trash_show');


    Route::get('/purchase_order/restore/{id}', [
        'uses' => 'PurchaseOrderController@restore',
        'as' => 'purchase_order.restore'
    ])->middleware('purchase_order.restore');


    Route::get('/purchase_order/kill/{id}', [
        'uses' => 'PurchaseOrderController@kill',
        'as' => 'purchase_order.kill'
    ])->middleware('purchase_order.permanently_delete');

    Route::get('/purchase_order/active/search', [
        'uses' => 'PurchaseOrderController@activeSearch',
        'as' => 'purchase_order.active.search'
    ]);

    Route::get('/purchase_order/trashed/search', [
        'uses' => 'PurchaseOrderController@trashedSearch',
        'as' => 'purchase_order.trashed.search'
    ]);

    Route::get('/purchase_order/active/action', [
        'uses' => 'PurchaseOrderController@activeAction',
        'as' => 'purchase_order.active.action'
    ])->middleware('purchase_order.delete');

    Route::get('/purchase_order/trashed/action', [
        'uses' => 'PurchaseOrderController@trashedAction',
        'as' => 'purchase_order.trashed.action'
    ]);

    // ajax call
    Route::post('purchase_order/branch/change', [
        'uses' => 'PurchaseOrderController@get_requisition_by_branch',
        'as' => 'purchase_order.branch.change'
    ]);

    // ajax call
    Route::post('purchase_order/requisition_id/change', [
        'uses' => 'PurchaseOrderController@get_requisition_items_by_requistion_id',
        'as' => 'purchase_order.requisition_id.change'
    ]);

    // ajax call
    Route::post('purchase_order/requisition_id', [
        'uses' => 'PurchaseOrderController@get_order_items_by_requistion_id',
        'as' => 'purchase_order.requisition_id'
    ]);


    // Purchase order End


    //   Schedule  Manage
    Route::get('/schedule_manage/{selles_id}', [
        'uses' => 'ScheduleReceivableController@index',
        'as' => 'schedule_manage'
    ])->middleware('branch.module_show');

    // Add Receivable  Schedule Start

    Route::get('/receivable_schedule/create/{selles_id}', [
        'uses' => 'ScheduleReceivableController@create',
        'as' => 'receivable_schedule.create'
    ])->middleware('branch.module_show');


    Route::post('/receivable_schedule/store/{selles_id}', [
        'uses' => 'ScheduleReceivableController@store',
        'as' => 'receivable_schedule.store'
    ])->middleware('branch.module_show');


    Route::get('/receivable_schedule/edit/{id}/{sells_id}', [
        'uses' => 'ScheduleReceivableController@edit',
        'as' => 'receivable_schedule.edit'
    ])->middleware('branch.module_show');

    Route::post('/receivable_schedule/update/{id}/{sells_id}', [
        'uses' => 'ScheduleReceivableController@update',
        'as' => 'receivable_schedule.update'
    ])->middleware('branch.module_show');

    Route::get('/receivable_schedule/destroy/{id}', [
        'uses' => 'ScheduleReceivableController@destroy',
        'as' => 'receivable_schedule.destroy'
    ])->middleware('branch.module_show');
    // Add Receivable  Schedule End


    // Add Actual Payment Start
    Route::get('/actual_payment/create/{selles_id}', [
        'uses' => 'ActualReceivedController@create',
        'as' => 'actual_payment.create'
    ])->middleware('branch.module_show');


    Route::post('/actual_payment/store/{selles_id}', [
        'uses' => 'ActualReceivedController@store',
        'as' => 'actual_payment.store'
    ])->middleware('branch.module_show');


    Route::get('/actual_payment/edit/{id}/{sells_id}', [
        'uses' => 'ActualReceivedController@edit',
        'as' => 'actual_payment.edit'
    ])->middleware('branch.module_show');

    Route::post('/actual_payment/update/{id}/{sells_id}', [
        'uses' => 'ActualReceivedController@update',
        'as' => 'actual_payment.update'
    ])->middleware('branch.module_show');

    Route::get('/actual_payment/destroy/{id}', [
        'uses' => 'ActualReceivedController@destroy',
        'as' => 'actual_payment.destroy'
    ])->middleware('branch.module_show');

    // Add Actual Payment Start End

    //  Schedule Management  End


//    Ledger  Start

//   Type Start
    Route::get('/ledger/type', [
        'uses' => 'IncomeExpenseTypeController@index',
        'as' => 'income_expense_type'
    ])->middleware('income_expense_type.all');

    Route::get('/ledger/type/show/{id}', [
        'uses' => 'IncomeExpenseTypeController@show',
        'as' => 'income_expense_type.show'
    ])->middleware('income_expense_type.show');

    Route::get('/ledger/type/create', [
        'uses' => 'IncomeExpenseTypeController@create',
        'as' => 'income_expense_type.create'
    ])->middleware('income_expense_type.create');

    Route::post('/ledger/type/store', [
        'uses' => 'IncomeExpenseTypeController@store',
        'as' => 'income_expense_type.store'
    ])->middleware('income_expense_type.create');


    Route::get('/ledger/type/edit/{id}', [
        'uses' => 'IncomeExpenseTypeController@edit',
        'as' => 'income_expense_type.edit'
    ])->middleware('income_expense_type.edit');
    Route::post('/ledger/type/update/{id}', [
        'uses' => 'IncomeExpenseTypeController@update',
        'as' => 'income_expense_type.update'
    ])->middleware('income_expense_type.edit');


    Route::get('/ledger/type/destroy/{id}', [
        'uses' => 'IncomeExpenseTypeController@destroy',
        'as' => 'income_expense_type.destroy'
    ])->middleware('income_expense_type.delete');

    Route::get('/ledger/type/pdf/{id}', [
        'uses' => 'IncomeExpenseTypeController@pdf',
        'as' => 'income_expense_type.pdf'
    ])->middleware('income_expense_type.pdf');


    Route::get('/ledger/type/trashed', [
        'uses' => 'IncomeExpenseTypeController@trashed',
        'as' => 'income_expense_type.trashed'
    ])->middleware('income_expense_type.trash_show');


    Route::get('/ledger/type/restore/{id}', [
        'uses' => 'IncomeExpenseTypeController@restore',
        'as' => 'income_expense_type.restore'
    ])->middleware('income_expense_type.restore');


    Route::get('/ledger/type/kill/{id}', [
        'uses' => 'IncomeExpenseTypeController@kill',
        'as' => 'income_expense_type.kill'
    ])->middleware('income_expense_type.permanently_delete');

    Route::get('/ledger/type/active/search', [
        'uses' => 'IncomeExpenseTypeController@activeSearch',
        'as' => 'income_expense_type.active.search'
    ]);

    Route::get('/ledger/type/trashed/search', [
        'uses' => 'IncomeExpenseTypeController@trashedSearch',
        'as' => 'income_expense_type.trashed.search'
    ]);

    Route::get('/ledger/type/active/action', [
        'uses' => 'IncomeExpenseTypeController@activeAction',
        'as' => 'income_expense_type.active.action'
    ])->middleware('income_expense_type.delete');

    Route::get('/ledger/type/trashed/action', [
        'uses' => 'IncomeExpenseTypeController@trashedAction',
        'as' => 'income_expense_type.trashed.action'
    ]);

    // Type End


//   Group Start
    Route::get('/ledger/group', [
        'uses' => 'IncomeExpenseGroupController@index',
        'as' => 'income_expense_group'
    ])->middleware('income_expense_group.all');

    Route::get('/ledger/group/show/{id}', [
        'uses' => 'IncomeExpenseGroupController@show',
        'as' => 'income_expense_group.show'
    ])->middleware('income_expense_group.show');

    Route::get('/ledger/group/create', [
        'uses' => 'IncomeExpenseGroupController@create',
        'as' => 'income_expense_group.create'
    ])->middleware('income_expense_group.create');

    Route::post('/ledger/group/store', [
        'uses' => 'IncomeExpenseGroupController@store',
        'as' => 'income_expense_group.store'
    ])->middleware('income_expense_group.create');


    Route::get('/ledger/group/edit/{id}', [
        'uses' => 'IncomeExpenseGroupController@edit',
        'as' => 'income_expense_group.edit'
    ])->middleware('income_expense_group.edit');
    Route::post('/ledger/group/update/{id}', [
        'uses' => 'IncomeExpenseGroupController@update',
        'as' => 'income_expense_group.update'
    ])->middleware('income_expense_group.edit');


    Route::get('/ledger/group/destroy/{id}', [
        'uses' => 'IncomeExpenseGroupController@destroy',
        'as' => 'income_expense_group.destroy'
    ])->middleware('income_expense_group.delete');

    Route::get('/ledger/group/pdf/{id}', [
        'uses' => 'IncomeExpenseGroupController@pdf',
        'as' => 'income_expense_group.pdf'
    ])->middleware('income_expense_group.pdf');


    Route::get('/ledger/group/trashed', [
        'uses' => 'IncomeExpenseGroupController@trashed',
        'as' => 'income_expense_group.trashed'
    ])->middleware('income_expense_group.trash_show');


    Route::get('/ledger/group/restore/{id}', [
        'uses' => 'IncomeExpenseGroupController@restore',
        'as' => 'income_expense_group.restore'
    ])->middleware('income_expense_group.restore');


    Route::get('/ledger/group/kill/{id}', [
        'uses' => 'IncomeExpenseGroupController@kill',
        'as' => 'income_expense_group.kill'
    ])->middleware('income_expense_group.permanently_delete');

    Route::get('/ledger/group/active/search', [
        'uses' => 'IncomeExpenseGroupController@activeSearch',
        'as' => 'income_expense_group.active.search'
    ]);

    Route::get('/ledger/group/trashed/search', [
        'uses' => 'IncomeExpenseGroupController@trashedSearch',
        'as' => 'income_expense_group.trashed.search'
    ]);

    Route::get('/ledger/group/active/action', [
        'uses' => 'IncomeExpenseGroupController@activeAction',
        'as' => 'income_expense_group.active.action'
    ])->middleware('income_expense_group.delete');

    Route::get('/ledger/group/trashed/action', [
        'uses' => 'IncomeExpenseGroupController@trashedAction',
        'as' => 'income_expense_group.trashed.action'
    ]);

    // Group End


//    ledger - name Start
    Route::get('/ledger/name', [
        'uses' => 'IncomeExpenseHeadController@index',
        'as' => 'income_expense_head'
    ])->middleware('income_expense_head.all');

    Route::get('/ledger/name/show/{id}', [
        'uses' => 'IncomeExpenseHeadController@show',
        'as' => 'income_expense_head.show'
    ])->middleware('income_expense_head.show');

    Route::get('/ledger/name/create', [
        'uses' => 'IncomeExpenseHeadController@create',
        'as' => 'income_expense_head.create'
    ])->middleware('income_expense_head.create');

    Route::post('/ledger/name/store', [
        'uses' => 'IncomeExpenseHeadController@store',
        'as' => 'income_expense_head.store'
    ])->middleware('income_expense_head.create');


    Route::get('/ledger/name/edit/{id}', [
        'uses' => 'IncomeExpenseHeadController@edit',
        'as' => 'income_expense_head.edit'
    ])->middleware('income_expense_head.edit');
    Route::post('/ledger/name/update/{id}', [
        'uses' => 'IncomeExpenseHeadController@update',
        'as' => 'income_expense_head.update'
    ])->middleware('income_expense_head.edit');


    Route::get('/ledger/name/destroy/{id}', [
        'uses' => 'IncomeExpenseHeadController@destroy',
        'as' => 'income_expense_head.destroy'
    ])->middleware('income_expense_head.delete');

    Route::get('/ledger/name/pdf/{id}', [
        'uses' => 'IncomeExpenseHeadController@pdf',
        'as' => 'income_expense_head.pdf'
    ])->middleware('income_expense_head.pdf');


    Route::get('/ledger/name/trashed', [
        'uses' => 'IncomeExpenseHeadController@trashed',
        'as' => 'income_expense_head.trashed'
    ])->middleware('income_expense_head.trash_show');


    Route::get('/ledger/name/restore/{id}', [
        'uses' => 'IncomeExpenseHeadController@restore',
        'as' => 'income_expense_head.restore'
    ])->middleware('income_expense_head.restore');


    Route::get('/ledger/name/kill/{id}', [
        'uses' => 'IncomeExpenseHeadController@kill',
        'as' => 'income_expense_head.kill'
    ])->middleware('income_expense_head.permanently_delete');

    Route::get('/ledger/name/active/search', [
        'uses' => 'IncomeExpenseHeadController@activeSearch',
        'as' => 'income_expense_head.active.search'
    ]);

    Route::get('/ledger/name/trashed/search', [
        'uses' => 'IncomeExpenseHeadController@trashedSearch',
        'as' => 'income_expense_head.trashed.search'
    ]);

    Route::get('/ledger/name/active/action', [
        'uses' => 'IncomeExpenseHeadController@activeAction',
        'as' => 'income_expense_head.active.action'
    ])->middleware('income_expense_head.delete');

    Route::get('/ledger/name/trashed/action', [
        'uses' => 'IncomeExpenseHeadController@trashedAction',
        'as' => 'income_expense_head.trashed.action'
    ]);

    // ledger name End


    //    Ledger  End


//    Bank Cash Start
    Route::get('/bank-cash', [
        'uses' => 'BankCashController@index',
        'as' => 'bank_cash'
    ])->middleware('bank_cash.all');

    Route::get('/bank-cash/show/{id}', [
        'uses' => 'BankCashController@show',
        'as' => 'bank_cash.show'
    ])->middleware('bank_cash.show');

    Route::get('/bank-cash/create', [
        'uses' => 'BankCashController@create',
        'as' => 'bank_cash.create'
    ])->middleware('bank_cash.create');

    Route::post('/bank-cash/store', [
        'uses' => 'BankCashController@store',
        'as' => 'bank_cash.store'
    ])->middleware('bank_cash.create');


    Route::get('/bank-cash/edit/{id}', [
        'uses' => 'BankCashController@edit',
        'as' => 'bank_cash.edit'
    ])->middleware('bank_cash.edit');

    Route::post('/bank-cash/update/{id}', [
        'uses' => 'BankCashController@update',
        'as' => 'bank_cash.update'
    ])->middleware('bank_cash.edit');


    Route::get('/bank-cash/destroy/{id}', [
        'uses' => 'BankCashController@destroy',
        'as' => 'bank_cash.destroy'
    ])->middleware('bank_cash.delete');

    Route::get('/bank-cash/pdf/{id}', [
        'uses' => 'BankCashController@pdf',
        'as' => 'bank_cash.pdf'
    ])->middleware('bank_cash.pdf');


    Route::get('/bank-cash/trashed', [
        'uses' => 'BankCashController@trashed',
        'as' => 'bank_cash.trashed'
    ])->middleware('bank_cash.trash_show');


    Route::get('/bank-cash/restore/{id}', [
        'uses' => 'BankCashController@restore',
        'as' => 'bank_cash.restore'
    ])->middleware('bank_cash.restore');


    Route::get('/bank-cash/kill/{id}', [
        'uses' => 'BankCashController@kill',
        'as' => 'bank_cash.kill'
    ])->middleware('bank_cash.permanently_delete');

    Route::get('/bank-cash/active/search', [
        'uses' => 'BankCashController@activeSearch',
        'as' => 'bank_cash.active.search'
    ]);

    Route::get('/bank-cash/trashed/search', [
        'uses' => 'BankCashController@trashedSearch',
        'as' => 'bank_cash.trashed.search'
    ]);

    Route::get('/bank-cash/active/action', [
        'uses' => 'BankCashController@activeAction',
        'as' => 'bank_cash.active.action'
    ])->middleware('bank_cash.delete');

    Route::get('/bank-cash/trashed/action', [
        'uses' => 'BankCashController@trashedAction',
        'as' => 'bank_cash.trashed.action'
    ]);

    // Bank Cash End


//    initial_income_expense_head_balance Start
    Route::get('/initial-ledger-balance', [
        'uses' => 'InitialIncomeExpenseHeadBalanceController@index',
        'as' => 'initial_income_expense_head_balance'
    ])->middleware('initial_income_expense_head_balance.all');

    Route::get('/initial-ledger-balance/show/{id}', [
        'uses' => 'InitialIncomeExpenseHeadBalanceController@show',
        'as' => 'initial_income_expense_head_balance.show'
    ])->middleware('initial_income_expense_head_balance.show');

    Route::get('/initial-ledger-balance/create', [
        'uses' => 'InitialIncomeExpenseHeadBalanceController@create',
        'as' => 'initial_income_expense_head_balance.create'
    ])->middleware('initial_income_expense_head_balance.create');

    Route::post('/initial-income-expense-head-balance/store', [
        'uses' => 'InitialIncomeExpenseHeadBalanceController@store',
        'as' => 'initial_income_expense_head_balance.store'
    ])->middleware('initial_income_expense_head_balance.create');


    Route::get('/initial-ledger-balance/edit/{id}', [
        'uses' => 'InitialIncomeExpenseHeadBalanceController@edit',
        'as' => 'initial_income_expense_head_balance.edit'
    ])->middleware('initial_income_expense_head_balance.edit');

    Route::post('/initial-ledger-balance/update/{id}', [
        'uses' => 'InitialIncomeExpenseHeadBalanceController@update',
        'as' => 'initial_income_expense_head_balance.update'
    ])->middleware('initial_income_expense_head_balance.edit');


    Route::get('/initial-ledger-balance/destroy/{id}', [
        'uses' => 'InitialIncomeExpenseHeadBalanceController@destroy',
        'as' => 'initial_income_expense_head_balance.destroy'
    ])->middleware('initial_income_expense_head_balance.delete');

    Route::get('/initial-ledger-balance/pdf/{id}', [
        'uses' => 'InitialIncomeExpenseHeadBalanceController@pdf',
        'as' => 'initial_income_expense_head_balance.pdf'
    ])->middleware('initial_income_expense_head_balance.pdf');


    Route::get('/initial-ledger-balance/trashed', [
        'uses' => 'InitialIncomeExpenseHeadBalanceController@trashed',
        'as' => 'initial_income_expense_head_balance.trashed'
    ])->middleware('initial_income_expense_head_balance.trash_show');


    Route::get('/initial-income-expense-head-balance/restore/{id}', [
        'uses' => 'InitialIncomeExpenseHeadBalanceController@restore',
        'as' => 'initial_income_expense_head_balance.restore'
    ])->middleware('initial_income_expense_head_balance.restore');


    Route::get('/initial-income-expense-head-balance/kill/{id}', [
        'uses' => 'InitialIncomeExpenseHeadBalanceController@kill',
        'as' => 'initial_income_expense_head_balance.kill'
    ])->middleware('initial_income_expense_head_balance.permanently_delete');

    Route::get('/initial-income-expense-head-balance/active/search', [
        'uses' => 'InitialIncomeExpenseHeadBalanceController@activeSearch',
        'as' => 'initial_income_expense_head_balance.active.search'
    ]);

    Route::get('/initial-income-expense-head-balance/trashed/search', [
        'uses' => 'InitialIncomeExpenseHeadBalanceController@trashedSearch',
        'as' => 'initial_income_expense_head_balance.trashed.search'
    ]);

    Route::get('/initial-income-expense-head-balance/active/action', [
        'uses' => 'InitialIncomeExpenseHeadBalanceController@activeAction',
        'as' => 'initial_income_expense_head_balance.active.action'
    ])->middleware('initial_income_expense_head_balance.delete');

    Route::get('/initial-income-expense-head-balance/trashed/action', [
        'uses' => 'InitialIncomeExpenseHeadBalanceController@trashedAction',
        'as' => 'initial_income_expense_head_balance.trashed.action'
    ]);

    // initial_income_expense_head_balance End


//    initial_bank_cash_balance Start
    Route::get('/initial-bank-cash-balance', [
        'uses' => 'InitialBankCashBalanceController@index',
        'as' => 'initial_bank_cash_balance'
    ])->middleware('initial_bank_cash_balance.all');

    Route::get('/initial-bank-cash-balance/show/{id}', [
        'uses' => 'InitialBankCashBalanceController@show',
        'as' => 'initial_bank_cash_balance.show'
    ])->middleware('initial_bank_cash_balance.show');

    Route::get('/initial-bank-cash-balance/create', [
        'uses' => 'InitialBankCashBalanceController@create',
        'as' => 'initial_bank_cash_balance.create'
    ])->middleware('initial_bank_cash_balance.create');

    Route::post('/initial-bank-cash-balance/store', [
        'uses' => 'InitialBankCashBalanceController@store',
        'as' => 'initial_bank_cash_balance.store'
    ])->middleware('initial_bank_cash_balance.create');


    Route::get('/initial-bank-cash-balance/edit/{id}', [
        'uses' => 'InitialBankCashBalanceController@edit',
        'as' => 'initial_bank_cash_balance.edit'
    ])->middleware('initial_bank_cash_balance.edit');

    Route::post('/initial-bank-cash-balance/update/{id}', [
        'uses' => 'InitialBankCashBalanceController@update',
        'as' => 'initial_bank_cash_balance.update'
    ])->middleware('initial_bank_cash_balance.edit');


    Route::get('/initial-bank-cash-balance/destroy/{id}', [
        'uses' => 'InitialBankCashBalanceController@destroy',
        'as' => 'initial_bank_cash_balance.destroy'
    ])->middleware('initial_bank_cash_balance.delete');

    Route::get('/initial-bank-cash-balance/pdf/{id}', [
        'uses' => 'InitialBankCashBalanceController@pdf',
        'as' => 'initial_bank_cash_balance.pdf'
    ])->middleware('initial_bank_cash_balance.pdf');


    Route::get('/initial-bank-cash-balance/trashed', [
        'uses' => 'InitialBankCashBalanceController@trashed',
        'as' => 'initial_bank_cash_balance.trashed'
    ])->middleware('initial_bank_cash_balance.trash_show');


    Route::get('/initial-bank-cash-balance/restore/{id}', [
        'uses' => 'InitialBankCashBalanceController@restore',
        'as' => 'initial_bank_cash_balance.restore'
    ])->middleware('initial_bank_cash_balance.restore');


    Route::get('/initial-bank-cash-balance/kill/{id}', [
        'uses' => 'InitialBankCashBalanceController@kill',
        'as' => 'initial_bank_cash_balance.kill'
    ])->middleware('initial_bank_cash_balance.permanently_delete');

    Route::get('/initial-bank-cash-balance/active/search', [
        'uses' => 'InitialBankCashBalanceController@activeSearch',
        'as' => 'initial_bank_cash_balance.active.search'
    ]);

    Route::get('/initial-bank-cash-balance/trashed/search', [
        'uses' => 'InitialBankCashBalanceController@trashedSearch',
        'as' => 'initial_bank_cash_balance.trashed.search'
    ]);

    Route::get('/initial-bank-cash-balance/active/action', [
        'uses' => 'InitialBankCashBalanceController@activeAction',
        'as' => 'initial_bank_cash_balance.active.action'
    ])->middleware('initial_bank_cash_balance.delete');

    Route::get('/initial-bank-cash-balance/trashed/action', [
        'uses' => 'InitialBankCashBalanceController@trashedAction',
        'as' => 'initial_bank_cash_balance.trashed.action'
    ]);

    // initial_bank_cash_balance End


    //  DrVoucher Start
    Route::get('/dr-voucher', [
        'uses' => 'DrVoucherController@index',
        'as' => 'dr_voucher'
    ])->middleware('dr_voucher.all');

    Route::get('/dr-voucher/show/{id}', [
        'uses' => 'DrVoucherController@show',
        'as' => 'dr_voucher.show'
    ])->middleware('dr_voucher.show');

    Route::get('/dr-voucher/create', [
        'uses' => 'DrVoucherController@create',
        'as' => 'dr_voucher.create'
    ])->middleware('dr_voucher.create');

    Route::post('/dr-voucher/store', [
        'uses' => 'DrVoucherController@store',
        'as' => 'dr_voucher.store'
    ])->middleware('dr_voucher.create');


    Route::get('/dr-voucher/edit/{id}', [
        'uses' => 'DrVoucherController@edit',
        'as' => 'dr_voucher.edit'
    ])->middleware('dr_voucher.edit');

    Route::post('/dr-voucher/update/{id}', [
        'uses' => 'DrVoucherController@update',
        'as' => 'dr_voucher.update'
    ])->middleware('dr_voucher.edit');


    Route::get('/dr-voucher/destroy/{id}', [
        'uses' => 'DrVoucherController@destroy',
        'as' => 'dr_voucher.destroy'
    ])->middleware('dr_voucher.delete');

    Route::get('/dr-voucher/pdf/{id}', [
        'uses' => 'DrVoucherController@pdf',
        'as' => 'dr_voucher.pdf'
    ])->middleware('dr_voucher.pdf');


    Route::get('/dr-voucher/trashed', [
        'uses' => 'DrVoucherController@trashed',
        'as' => 'dr_voucher.trashed'
    ])->middleware('dr_voucher.trash_show');


    Route::get('/dr-voucher/restore/{id}', [
        'uses' => 'DrVoucherController@restore',
        'as' => 'dr_voucher.restore'
    ])->middleware('dr_voucher.restore');


    Route::get('/dr-voucher/kill/{id}', [
        'uses' => 'DrVoucherController@kill',
        'as' => 'dr_voucher.kill'
    ])->middleware('dr_voucher.permanently_delete');

    Route::get('/dr-voucher/active/search', [
        'uses' => 'DrVoucherController@activeSearch',
        'as' => 'dr_voucher.active.search'
    ]);

    Route::get('/dr-voucher/trashed/search', [
        'uses' => 'DrVoucherController@trashedSearch',
        'as' => 'dr_voucher.trashed.search'
    ]);

    Route::get('/dr-voucher/active/action', [
        'uses' => 'DrVoucherController@activeAction',
        'as' => 'dr_voucher.active.action'
    ])->middleware('dr_voucher.delete');

    Route::get('/dr-voucher/trashed/action', [
        'uses' => 'DrVoucherController@trashedAction',
        'as' => 'dr_voucher.trashed.action'
    ]);

    // DrVoucher End


    //  cr_voucher Start
    Route::get('/cr-voucher', [
        'uses' => 'CrVoucherController@index',
        'as' => 'cr_voucher'
    ])->middleware('cr_voucher.all');

    Route::get('/cr-voucher/show/{id}', [
        'uses' => 'CrVoucherController@show',
        'as' => 'cr_voucher.show'
    ])->middleware('cr_voucher.show');

    Route::get('/cr-voucher/create', [
        'uses' => 'CrVoucherController@create',
        'as' => 'cr_voucher.create'
    ])->middleware('cr_voucher.create');

    Route::post('/cr-voucher/store', [
        'uses' => 'CrVoucherController@store',
        'as' => 'cr_voucher.store'
    ])->middleware('cr_voucher.create');


    Route::get('/cr-voucher/edit/{id}', [
        'uses' => 'CrVoucherController@edit',
        'as' => 'cr_voucher.edit'
    ])->middleware('cr_voucher.edit');

    Route::post('/cr-voucher/update/{id}', [
        'uses' => 'CrVoucherController@update',
        'as' => 'cr_voucher.update'
    ])->middleware('cr_voucher.edit');


    Route::get('/cr-voucher/destroy/{id}', [
        'uses' => 'CrVoucherController@destroy',
        'as' => 'cr_voucher.destroy'
    ])->middleware('cr_voucher.delete');

    Route::get('/cr-voucher/pdf/{id}', [
        'uses' => 'CrVoucherController@pdf',
        'as' => 'cr_voucher.pdf'
    ])->middleware('cr_voucher.pdf');


    Route::get('/cr-voucher/trashed', [
        'uses' => 'CrVoucherController@trashed',
        'as' => 'cr_voucher.trashed'
    ])->middleware('cr_voucher.trash_show');


    Route::get('/cr-voucher/restore/{id}', [
        'uses' => 'CrVoucherController@restore',
        'as' => 'cr_voucher.restore'
    ])->middleware('cr_voucher.restore');


    Route::get('/cr-voucher/kill/{id}', [
        'uses' => 'CrVoucherController@kill',
        'as' => 'cr_voucher.kill'
    ])->middleware('cr_voucher.permanently_delete');

    Route::get('/cr-voucher/active/search', [
        'uses' => 'CrVoucherController@activeSearch',
        'as' => 'cr_voucher.active.search'
    ]);

    Route::get('/cr-voucher/trashed/search', [
        'uses' => 'CrVoucherController@trashedSearch',
        'as' => 'cr_voucher.trashed.search'
    ]);

    Route::get('/cr-voucher/active/action', [
        'uses' => 'CrVoucherController@activeAction',
        'as' => 'cr_voucher.active.action'
    ])->middleware('cr_voucher.delete');

    Route::get('/cr-voucher/trashed/action', [
        'uses' => 'CrVoucherController@trashedAction',
        'as' => 'cr_voucher.trashed.action'
    ]);

    // cr_voucher End


    //  jnl_voucher Start
    Route::get('/journal-voucher', [
        'uses' => 'JournalVoucherController@index',
        'as' => 'jnl_voucher'
    ])->middleware('jnl_voucher.all');

    Route::get('/journal-voucher/show/{id}', [
        'uses' => 'JournalVoucherController@show',
        'as' => 'jnl_voucher.show'
    ])->middleware('jnl_voucher.show');

    Route::get('/journal-voucher/create', [
        'uses' => 'JournalVoucherController@create',
        'as' => 'jnl_voucher.create'
    ])->middleware('jnl_voucher.create');

    Route::post('/journal-voucher/store', [
        'uses' => 'JournalVoucherController@store',
        'as' => 'jnl_voucher.store'
    ])->middleware('jnl_voucher.create');


    Route::get('/journal-voucher/edit/{id}', [
        'uses' => 'JournalVoucherController@edit',
        'as' => 'jnl_voucher.edit'
    ])->middleware('jnl_voucher.edit');

    Route::post('/journal-voucher/update/{id}', [
        'uses' => 'JournalVoucherController@update',
        'as' => 'jnl_voucher.update'
    ])->middleware('jnl_voucher.edit');


    Route::get('/journal-voucher/destroy/{id}', [
        'uses' => 'JournalVoucherController@destroy',
        'as' => 'jnl_voucher.destroy'
    ])->middleware('jnl_voucher.delete');

    Route::get('/journal-voucher/pdf/{id}', [
        'uses' => 'JournalVoucherController@pdf',
        'as' => 'jnl_voucher.pdf'
    ])->middleware('jnl_voucher.pdf');


    Route::get('/journal-voucher/trashed', [
        'uses' => 'JournalVoucherController@trashed',
        'as' => 'jnl_voucher.trashed'
    ])->middleware('jnl_voucher.trash_show');


    Route::get('/journal-voucher/restore/{id}', [
        'uses' => 'JournalVoucherController@restore',
        'as' => 'jnl_voucher.restore'
    ])->middleware('jnl_voucher.restore');


    Route::get('/journal-voucher/kill/{id}', [
        'uses' => 'JournalVoucherController@kill',
        'as' => 'jnl_voucher.kill'
    ])->middleware('jnl_voucher.permanently_delete');

    Route::get('/journal-voucher/active/search', [
        'uses' => 'JournalVoucherController@activeSearch',
        'as' => 'jnl_voucher.active.search'
    ]);

    Route::get('/journal-voucher/trashed/search', [
        'uses' => 'JournalVoucherController@trashedSearch',
        'as' => 'jnl_voucher.trashed.search'
    ]);

    Route::get('/journal-voucher/active/action', [
        'uses' => 'JournalVoucherController@activeAction',
        'as' => 'jnl_voucher.active.action'
    ])->middleware('jnl_voucher.delete');

    Route::get('/journal-voucher/trashed/action', [
        'uses' => 'JournalVoucherController@trashedAction',
        'as' => 'jnl_voucher.trashed.action'
    ]);

    // jnl_voucher End


    //  contra_voucher Start
    Route::get('/contra-voucher', [
        'uses' => 'ContraVoucherController@index',
        'as' => 'contra_voucher'
    ])->middleware('contra_voucher.all');

    Route::get('/contra-voucher/show/{id}', [
        'uses' => 'ContraVoucherController@show',
        'as' => 'contra_voucher.show'
    ])->middleware('contra_voucher.show');

    Route::get('/contra-voucher/create', [
        'uses' => 'ContraVoucherController@create',
        'as' => 'contra_voucher.create'
    ])->middleware('contra_voucher.create');

    Route::post('/contra-voucher/store', [
        'uses' => 'ContraVoucherController@store',
        'as' => 'contra_voucher.store'
    ])->middleware('contra_voucher.create');


    Route::get('/contra-voucher/edit/{id}', [
        'uses' => 'ContraVoucherController@edit',
        'as' => 'contra_voucher.edit'
    ])->middleware('contra_voucher.edit');

    Route::post('/contra-voucher/update/{id}', [
        'uses' => 'ContraVoucherController@update',
        'as' => 'contra_voucher.update'
    ])->middleware('contra_voucher.edit');


    Route::get('/contra-voucher/destroy/{id}', [
        'uses' => 'ContraVoucherController@destroy',
        'as' => 'contra_voucher.destroy'
    ])->middleware('contra_voucher.delete');

    Route::get('/contra-voucher/pdf/{id}', [
        'uses' => 'ContraVoucherController@pdf',
        'as' => 'contra_voucher.pdf'
    ])->middleware('contra_voucher.pdf');


    Route::get('/contra-voucher/trashed', [
        'uses' => 'ContraVoucherController@trashed',
        'as' => 'contra_voucher.trashed'
    ])->middleware('contra_voucher.trash_show');


    Route::get('/contra-voucher/restore/{id}', [
        'uses' => 'ContraVoucherController@restore',
        'as' => 'contra_voucher.restore'
    ])->middleware('contra_voucher.restore');


    Route::get('/contra-voucher/kill/{id}', [
        'uses' => 'ContraVoucherController@kill',
        'as' => 'contra_voucher.kill'
    ])->middleware('contra_voucher.permanently_delete');

    Route::get('/contra-voucher/active/search', [
        'uses' => 'ContraVoucherController@activeSearch',
        'as' => 'contra_voucher.active.search'
    ]);

    Route::get('/contra-voucher/trashed/search', [
        'uses' => 'ContraVoucherController@trashedSearch',
        'as' => 'contra_voucher.trashed.search'
    ]);

    Route::get('/contra-voucher/active/action', [
        'uses' => 'ContraVoucherController@activeAction',
        'as' => 'contra_voucher.active.action'
    ])->middleware('contra_voucher.delete');

    Route::get('/contra-voucher/trashed/action', [
        'uses' => 'ContraVoucherController@trashedAction',
        'as' => 'contra_voucher.trashed.action'
    ]);

    // contra_voucher End


//    Accounts Report Start

//    ledger

    Route::get('/reports/accounts/ledger', [
        'uses' => 'AccountsReportController@ledger_index',
        'as' => 'reports.accounts.ledger'
    ])->middleware('report.ledger.all');


    Route::post('/reports/accounts/ledger/branch-wise/report', [
        'uses' => 'AccountsReportController@ledger_branch_wise_report',
        'as' => 'reports_accounts_ledger.branch_wise.report'
    ])->middleware('report.ledger.all');

    Route::post('/reports/accounts/ledger/income-expense-head-wise/report', [
        'uses' => 'AccountsReportController@ledger_income_expense_head_wise_report',
        'as' => 'reports_accounts_ledger.income_expense_head_wise.report'
    ])->middleware('report.ledger.all');

    Route::post('/reports/accounts/ledger/bank-cash-wise/report', [
        'uses' => 'AccountsReportController@ledger_bank_cash_wise_report',
        'as' => 'reports_accounts_ledger.bank_cash_wise.report'
    ])->middleware('report.ledger.all');


//    Trial Balance
    Route::get('/reports/accounts/trial-balance', [
        'uses' => 'Reports\Accounts\TrialBalanceController@index',
        'as' => 'reports.accounts.trial_balance'
    ])->middleware('report.TrialBalance.all');

    Route::post('/reports/accounts/trial-balance/report', [
        'uses' => 'Reports\Accounts\TrialBalanceController@branch_wise',
        'as' => 'reports.accounts.trial_balance.branch_wise.report'
    ])->middleware('report.TrialBalance.all');

    //    Cost Of Revenue Manage
    Route::get('/reports/accounts/cost-of-revenue', [
        'uses' => 'Reports\Accounts\CostOfRevenueController@index',
        'as' => 'reports.accounts.cost_of_revenue'
    ])->middleware('report.CostOfRevenue.all');

    Route::post('/reports/accounts/cost-of-revenue/report', [
        'uses' => 'Reports\Accounts\CostOfRevenueController@branch_wise',
        'as' => 'reports.accounts.cost_of_revenue.report'
    ])->middleware('report.CostOfRevenue.all');


//    Profit & Loss Account
    Route::get('/reports/accounts/profit-or-loss-account', [
        'uses' => 'Reports\Accounts\ProfitAndLossAccountController@index',
        'as' => 'reports.accounts.profit_or_loss_account'
    ])->middleware('report.ProfitOrLossAccount.all');

    Route::post('/reports/accounts/profit-or-loss-account/report', [
        'uses' => 'Reports\Accounts\ProfitAndLossAccountController@branch_wise',
        'as' => 'reports.accounts.profit_or_loss_account.report'
    ])->middleware('report.ProfitOrLossAccount.all');

    //    Retained Earnings
    Route::get('/reports/accounts/retained-earnings', [
        'uses' => 'Reports\Accounts\RetainedEarningsController@index',
        'as' => 'reports.accounts.retained_earnings'
    ])->middleware('report.RetainedEarning.all');

    Route::post('/reports/accounts/retained-earnings/report', [
        'uses' => 'Reports\Accounts\RetainedEarningsController@branch_wise',
        'as' => 'reports.accounts.retained_earnings.report'
    ])->middleware('report.RetainedEarning.all');


    //    Fixed Asset Schedule
    Route::get('/reports/accounts/fixed-asset-schedule', [
        'uses' => 'Reports\Accounts\FixedAssetScheduleController@index',
        'as' => 'reports.accounts.fixed_asset_schedule'
    ])->middleware('report.FixedAssetsSchedule.all');

    Route::post('/reports/accounts/fixed-asset-schedule/report', [
        'uses' => 'Reports\Accounts\FixedAssetScheduleController@branch_wise',
        'as' => 'reports.accounts.fixed_asset_schedule.report'
    ])->middleware('report.FixedAssetsSchedule.all');


    //  Balance sheet
    Route::get('/reports/accounts/balance-sheet', [
        'uses' => 'Reports\Accounts\BalanceSheetController@index',
        'as' => 'reports.accounts.balance_sheet'
    ])->middleware('report.StatementOfFinancialPosition.all');

    Route::post('/reports/accounts/balance-sheet/report', [
        'uses' => 'Reports\Accounts\BalanceSheetController@branch_wise',
        'as' => 'reports.accounts.balance_sheet.report'
    ])->middleware('report.StatementOfFinancialPosition.all');


    //  Cash Flow
    Route::get('/reports/accounts/cash-flow', [
        'uses' => 'Reports\Accounts\CashFlowController@index',
        'as' => 'reports.accounts.cash_flow'
    ]);

    Route::post('/reports/accounts/cash-flow/report', [
        'uses' => 'Reports\Accounts\CashFlowController@branch_wise',
        'as' => 'reports.accounts.cash_flow.report'
    ]);


    //  Receive Payment
    Route::get('/reports/accounts/receive-payment', [
        'uses' => 'Reports\Accounts\ReceivePaymentController@index',
        'as' => 'reports.accounts.receive_payment'
    ])->middleware('report.ReceiveAndPayment.all');

    Route::post('/reports/accounts/receive-payment/report', [
        'uses' => 'Reports\Accounts\ReceivePaymentController@branch_wise',
        'as' => 'reports.accounts.receive_payment.report'
    ])->middleware('report.ReceiveAndPayment.all');


    //  Notes start
    Route::get('/reports/accounts/notes', [
        'uses' => 'Reports\Accounts\NotesController@index',
        'as' => 'reports.accounts.notes'
    ])->middleware('report.Notes.all');

    Route::post('/reports/accounts/notes/type_wise/report', [
        'uses' => 'Reports\Accounts\NotesController@type_wise',
        'as' => 'reports.accounts.notes.type_wise.report'
    ])->middleware('report.Notes.all');

    Route::post('/reports/accounts/notes/group_wise/report', [
        'uses' => 'Reports\Accounts\NotesController@group_wise',
        'as' => 'reports.accounts.notes.group_wise.report'
    ])->middleware('report.Notes.all');


//    Notes End

//    Accounts Report End


//    General Report Start

//    Branch Start

    Route::get('/reports/general/branch', [
        'uses' => 'Reports\General\GeneralReportController@branch',
        'as' => 'reports.general.branch'
    ])->middleware('report.general_report.branch.all');

    Route::post('/reports/general/branch/report', [
        'uses' => 'Reports\General\GeneralReportController@branch_report',
        'as' => 'reports.general.branch.report'
    ]);


//    Branch End


//    Ledger Start

    Route::get('/reports/general/ledger', [
        'uses' => 'Reports\General\GeneralReportController@ledger_type',
        'as' => 'reports.general.ledger.type'
    ])->middleware('report.general_report.ledger.all');

    Route::post('/reports/general/ledger/type/report', [
        'uses' => 'Reports\General\GeneralReportController@ledger_type_report',
        'as' => 'reports.general.ledger.type.report'
    ]);


    Route::post('/reports/general/ledger/group/report', [
        'uses' => 'Reports\General\GeneralReportController@ledger_group_report',
        'as' => 'reports.general.ledger.group.report'
    ]);

    Route::post('/reports/general/ledger/name/report', [
        'uses' => 'Reports\General\GeneralReportController@ledger_name_report',
        'as' => 'reports.general.ledger.name.report'
    ]);


//    Ledger End

//    Bank Cash Start
    Route::get('/reports/general/bank-cash', [
        'uses' => 'Reports\General\GeneralReportController@bank_cash',
        'as' => 'reports.general.bank_cash'
    ])->middleware('report.general_report.BankCash.all');

    Route::post('/reports/general/ledger/bank-cash/report', [
        'uses' => 'Reports\General\GeneralReportController@bank_cash_report',
        'as' => 'reports.general.bank_cash.report'
    ]);
    //    Bank Cash End


    //    Voucher start
    Route::get('/reports/general/voucher', [
        'uses' => 'Reports\General\GeneralReportController@voucher',
        'as' => 'reports.general.voucher'
    ])->middleware('report.general_report.Voucher.all');


    Route::post('/reports/general/voucher/report', [
        'uses' => 'Reports\General\GeneralReportController@voucher_report',
        'as' => 'reports.general.voucher.report'
    ]);
    //    Voucher start

//    General Report End

    // Sells Report Start

    Route::get('report/sells/party-ledger', [
        'uses' => 'Reports\Sells\SellsReportController@index',
        'as' => 'report.sells.party_ledger'
    ])->middleware('sells_report.all');

    Route::post('report/sells/party-ledger/change-customer-get-sell', [
        'uses' => 'Reports\Sells\SellsReportController@change_customer_get_sell',
        'as' => 'report.sells.party_ledger.change_customer_get_sell',
    ])->middleware('sells_report.all');

    Route::post('report/sells/party-ledger/customer_wise', [
        'uses' => 'Reports\Sells\SellsReportController@customer_wise',
        'as' => 'report.sells.party_ledger.customer_wise'
    ])->middleware('sells_report.all');

    Route::post('report/sells/party-ledger/summary_wise', [
        'uses' => 'Reports\Sells\SellsReportController@summary_wise',
        'as' => 'report.sells.party_ledger.summary_wise'
    ])->middleware('sells_report.all');

    Route::post('report/sells/party-ledger/seller_name_wise', [
        'uses' => 'Reports\Sells\SellsReportController@seller_name_wise',
        'as' => 'report.sells.party_ledger.seller_name_wise'
    ])->middleware('sells_report.all');


    // Sells Report End

    Route::get('report/purchase', [
        'uses' => 'Reports\Purchase\PurchaseReportController@index',
        'as' => 'report.purchase'
    ])->middleware('purchase_report.all');

    Route::post('report/purchase/requisition', [
        'uses' => 'Reports\Purchase\PurchaseReportController@requisition',
        'as' => 'report.purchase.requisition'
    ])->middleware('purchase_report.all');
    Route::post('report/purchase/requisition-id', [
        'uses' => 'Reports\Purchase\PurchaseReportController@requisition_id',
        'as' => 'report.purchase.requisition_id'
    ])->middleware('purchase_report.all');

    Route::post('report/purchase/order', [
        'uses' => 'Reports\Purchase\PurchaseReportController@order',
        'as' => 'report.purchase.order'
    ])->middleware('purchase_report.all');
    Route::post('report/purchase/order-id', [
        'uses' => 'Reports\Purchase\PurchaseReportController@order_id',
        'as' => 'report.purchase.order_id'
    ])->middleware('purchase_report.all');






});


Route::get('/test', function () {

    echo "test project";

});

// Persian Date

