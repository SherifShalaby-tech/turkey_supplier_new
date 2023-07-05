<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
 */
    Route::post('/products/upload_image', [\App\Http\Controllers\Admin\ProductController::class,'upload_image']);

/*auth middleware api passport token*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//--------------------------- Reset Password  ---------------------------

Route::group([
    'prefix' => 'password',
], function () {
    Route::post('create', 'PasswordResetController@create');
    Route::post('reset', 'PasswordResetController@reset');
});

Route::middleware(['auth:api', 'Is_Active'])->group(function () {

    //-------------------------- Clear Cache ---------------------------

    Route::get("Clear_Cache", "SettingsController@Clear_Cache");

    Route::get("getCurrentUserInfo", "UserController@getUserInfo");

    //-------------------------- Reports ---------------------------

    Route::get("report/client", "ReportController@Client_Report");
    Route::get("report/client/{id}", "ReportController@Client_Report_detail");
    Route::get("report/client_Sales", "ReportController@Sales_Client");
    Route::get("report/client_payments", "ReportController@Payments_Client");
    Route::get("report/client_quotations", "ReportController@Quotations_Client");
    Route::get("report/client_returns", "ReportController@Returns_Client");
    Route::get("report/client_Top_Clients", "ReportController@TopCustomers");
    Route::get("report/TopProducts_year", "ReportController@Top_Products_Year");
    Route::get("report/TopProducts_Month", "ReportController@TopProducts_Month");
    Route::get("report/provider", "ReportController@Providers_Report");
    Route::get("report/provider/{id}", "ReportController@Provider_Report_detail");
    Route::get("report/provider_purchases", "ReportController@Purchases_Provider");
    Route::get("report/provider_payments", "ReportController@Payments_Provider");
    Route::get("report/provider_returns", "ReportController@Returns_Provider");
    Route::get("report/ToProviders", "ReportController@ToProviders");
    Route::get("report/Sales", "ReportController@Report_Sales");
    Route::get("report/Purchases", "ReportController@Report_Purchases");
    Route::get("report/Get_last_Sales", "ReportController@Get_last_Sales");
    Route::get("report/stock_alert", "ReportController@Products_Alert");
    Route::get("report/Payment_chart", "ReportController@Payment_chart");
    Route::get("report/Warehouse_Report", "ReportController@Warehouse_Report");
    Route::get("report/Sales_Warehouse", "ReportController@Sales_Warehouse");
    Route::get("report/Quotations_Warehouse", "ReportController@Quotations_Warehouse");
    Route::get("report/Returns_Sale_Warehouse", "ReportController@Returns_Sale_Warehouse");
    Route::get("report/Returns_Purchase_Warehouse", "ReportController@Returns_Purchase_Warehouse");
    Route::get("report/Expenses_Warehouse", "ReportController@Expenses_Warehouse");
    Route::get("report/Warhouse_Count_Stock", "ReportController@Warhouse_Count_Stock");
    Route::get("report/Warhouse_Value_Stock", "ReportController@Warhouse_Value_Stock");
    Route::get("report/report_today", "ReportController@report_today");
    Route::get("report/count_quantity_alert", "ReportController@count_quantity_alert");
    Route::get("report/ProfitAndLoss", "ReportController@ProfitAndLoss");
    Route::get("chart/SalesPurchasesChart", "ReportController@SalesPurchasesChart");
    Route::get("chart/report_with_echart", "ReportController@report_with_echart");
    Route::get("report/report_dashboard", "ReportController@report_dashboard");



    //------------------------------- CLIENTS --------------------------\\
    //------------------------------------------------------------------\\

    Route::resource('clients', 'ClientController');
    Route::get('clients/export/Excel', 'ClientController@exportExcel');
    Route::post('clients/import/csv', 'ClientController@import_clients');
    Route::get('Get_Clients_Without_Paginate', 'ClientController@Get_Clients_Without_Paginate');
    Route::post('clients/delete/by_selection', 'ClientController@delete_by_selection');

    //------------------------------- HRM --------------------------\\


    //------------------------------Employee------------------------------------\\

    Route::resource('employees', 'hrm\EmployeesController');
    Route::get('employees/export/Excel', 'hrm\EmployeesController@exportExcel');
    Route::post('employees/import/csv', 'hrm\EmployeesController@import_employees');
    Route::get('Get_employees_Without_Paginate', 'hrm\EmployeesController@Get_employees_Without_Paginate');
    Route::post('employees/delete/by_selection', 'hrm\EmployeesController@delete_by_selection');
    Route::get("Get_employees_by_department", "hrm\EmployeesController@Get_employees_by_department");
    Route::put("update_social_profile/{id}", "hrm\EmployeesController@update_social_profile");
    Route::get("get_experiences_by_employee", "hrm\EmployeesController@get_experiences_by_employee");
    Route::get("get_accounts_by_employee", "hrm\EmployeesController@get_accounts_by_employee");


    //------------------------------- Employee Experience ----------------\\
    //--------------------------------------------------------------------\\

    Route::resource('work_experience', 'hrm\EmployeeExperienceController');


    //------------------------------- Employee Accounts bank ----------------\\
    //--------------------------------------------------------------------\\

    Route::resource('employee_account', 'hrm\EmployeeAccountController');


    //------------------------------- company --------------------------\\
    //--------------------------------------------------------------------\\
/*    Route::resource('company', 'hrm\CompanyController');
    Route::get("Get_all_Company", "hrm\CompanyController@Get_all_Company");
    Route::post("company/delete/by_selection", "hrm\CompanyController@delete_by_selection");*/


    //------------------------------- departments --------------------------\\
    //--------------------------------------------------------------------\\
    Route::resource('departments', 'hrm\DepartmentsController');
    Route::get("Get_all_departments", "hrm\DepartmentsController@Get_all_Departments");
    Route::get("Get_departments_by_company", "hrm\DepartmentsController@Get_departments_by_company")->name('Get_departments_by_company');
    Route::post("departments/delete/by_selection", "hrm\DepartmentsController@delete_by_selection");

    //------------------------------- designations --------------------------\\
    //--------------------------------------------------------------------\\
    Route::resource('designations', 'hrm\DesignationsController');
    Route::get("get_designations_by_department", "hrm\DesignationsController@Get_designations_by_department");
    Route::post("designations/delete/by_selection", "hrm\DesignationsController@delete_by_selection");

    //------------------------------- office_shift ------------------\\
    //----------------------------------------------------------------\\

    Route::resource('office_shift', 'hrm\OfficeShiftController');
    Route::post("office_shift/delete/by_selection", "hrm\OfficeShiftController@delete_by_selection");

    //------------------------------- Attendances ------------------------\\
    //--------------------------------------------------------------------\\
    Route::resource('attendances', 'hrm\AttendancesController');
    Route::get("daily_attendance", "hrm\AttendancesController@daily_attendance")->name('daily_attendance');
    Route::post('attendance_by_employee/{id}', 'hrm\EmployeeSessionController@attendance_by_employee')->name('attendance_by_employee.post');
    Route::post("attendances/delete/by_selection", "hrm\AttendancesController@delete_by_selection");



    //------------------------------- Request leave  -----------------------\\
    //----------------------------------------------------------------\\

    Route::resource('leave', 'hrm\LeaveController');
    Route::resource('leave_type', 'hrm\LeaveTypeController');
    Route::post("leave/delete/by_selection", "hrm\LeaveController@delete_by_selection");
    Route::post("leave_type/delete/by_selection", "hrm\LeaveTypeController@delete_by_selection");


    //------------------------------- holiday ----------------------\\
    //----------------------------------------------------------------\\

    Route::resource('holiday', 'hrm\HolidayController');
    Route::post("holiday/delete/by_selection", "hrm\HolidayController@delete_by_selection");

    //------------------------------- core --------------------------\\
    //--------------------------------------------------------------------\\

    Route::prefix('core')->group(function () {

        Route::get("Get_departments_by_company", "hrm\CoreController@Get_departments_by_company");
        Route::get("get_designations_by_department", "hrm\CoreController@Get_designations_by_department");
        Route::get("Get_office_shift_by_company", "hrm\CoreController@Get_office_shift_by_company");
        Route::get("Get_employees_by_company", "hrm\CoreController@Get_employees_by_company");
    });



    //------------------------------- ORDERS --------------------------\\
    //------------------------------------------------------------------\\

    Route::get('orders', 'OrderController@index');

    Route::resource('orders', 'OrderController');
    Route::get('orders/export/Excel', 'OrderController@exportExcel');
    Route::post('orders/import/csv', 'OrderController@import_orders');
    Route::get('Get_Orders_Without_Paginate', 'OrderController@Get_Orders_Without_Paginate');
    Route::post('orders/delete/by_selection', 'OrderController@delete_by_selection');
    Route::get('orders/Detail/{id}', 'OrderController@Get_Order_Details');

    Route::post('orders/assign', 'OrderController@assignOrder');

    Route::post('orders/finish', 'OrderController@finishOrder');

    Route::get('Orders/Get_element/barcode', 'OrderController@Get_element_barcode');



    //------------------------------- PRODUCTS --------------------------\\
    //------------------------------------------------------------------\\

    Route::resource('Products', 'ProductsController');
    Route::get('Products/export/Excel', 'ProductsController@export_Excel');
    Route::post('Products/import/csv', 'ProductsController@import_products');
    Route::get('Products/Warehouse/{id}', 'ProductsController@Products_by_Warehouse');
    Route::get('Products/Detail/{id}', 'ProductsController@Get_Products_Details');
    Route::get('Products/Stock/Alerts', 'ProductsController@Products_Alert');
    Route::get('Products/Get_element/barcode', 'ProductsController@Get_element_barcode');
    Route::post('Products/delete/by_selection', 'ProductsController@delete_by_selection');

    //------------------------------- PURCHASES --------------------------\\
    //------------------------------------------------------------------\\

    Route::resource('purchases', 'PurchasesController');
    Route::get('purchases/Payments/{id}', 'PurchasesController@Get_Payments');
    Route::post('purchases/send/email', 'PurchasesController@Send_Email');
    Route::post('purchases/send/sms', 'PurchasesController@Send_SMS');
    Route::get('purchases/export/Excel', 'PurchasesController@exportExcel');
    Route::post('purchases/delete/by_selection', 'PurchasesController@delete_by_selection');

    //-------------------------------  Sales --------------------------\\
    //------------------------------------------------------------------\\

    Route::resource('sales', 'SalesController');
    Route::get('sales/Change_to_Sale/{id}', 'SalesController@Elemens_Change_To_Sale');
    Route::get('sales/payments/{id}', 'SalesController@Payments_Sale');
    Route::post('sales/send/email', 'SalesController@Send_Email');
    Route::post('sales/send/sms', 'SalesController@Send_SMS');
    Route::get('sales/export/Excel', 'SalesController@exportExcel');
    Route::post('sales/delete/by_selection', 'SalesController@delete_by_selection');


    //------------------------------- Purchases Return --------------------------\\
    //------------------------------------------------------------------\\

    Route::resource('returns/purchase', 'PurchasesReturnController');
    Route::post('returns/purchase/send/email', 'PurchasesReturnController@Send_Email');
    Route::post('returns/purchase/send/sms', 'PurchasesReturnController@Send_SMS');
    Route::get('returns/purchase/export/Excel', 'PurchasesReturnController@exportExcel');
    Route::get('returns/purchase/payment/{id}', 'PurchasesReturnController@Payment_Returns');
    Route::post('returns/purchase/delete/by_selection', 'PurchasesReturnController@delete_by_selection');


    //------------------------------- HRM --------------------------\\


    //------------------------------Employee------------------------------------\\

    Route::resource('employees', 'hrm\EmployeesController');
    Route::get('employees/export/Excel', 'hrm\EmployeesController@exportExcel');
    Route::post('employees/import/csv', 'hrm\EmployeesController@import_employees');
    Route::get('Get_employees_Without_Paginate', 'hrm\EmployeesController@Get_employees_Without_Paginate');
    Route::post('employees/delete/by_selection', 'hrm\EmployeesController@delete_by_selection');
    Route::get("Get_employees_by_department", "hrm\EmployeesController@Get_employees_by_department");
    Route::put("update_social_profile/{id}", "hrm\EmployeesController@update_social_profile");
    Route::get("get_experiences_by_employee", "hrm\EmployeesController@get_experiences_by_employee");
    Route::get("get_accounts_by_employee", "hrm\EmployeesController@get_accounts_by_employee");


    //------------------------------- Employee Experience ----------------\\
    //--------------------------------------------------------------------\\

    Route::resource('work_experience', 'hrm\EmployeeExperienceController');


    //------------------------------- Employee Accounts bank ----------------\\
    //--------------------------------------------------------------------\\

    Route::resource('employee_account', 'hrm\EmployeeAccountController');


    //------------------------------- company --------------------------\\
    //--------------------------------------------------------------------\\
/*    Route::resource('company', 'hrm\CompanyController');
    Route::get("Get_all_Company", "hrm\CompanyController@Get_all_Company");
    Route::post("company/delete/by_selection", "hrm\CompanyController@delete_by_selection");*/


    //------------------------------- departments --------------------------\\
    //--------------------------------------------------------------------\\
    Route::resource('departments', 'hrm\DepartmentsController');
    Route::get("Get_all_departments", "hrm\DepartmentsController@Get_all_Departments");
    Route::get("Get_departments_by_company", "hrm\DepartmentsController@Get_departments_by_company")->name('Get_departments_by_company');
    Route::post("departments/delete/by_selection", "hrm\DepartmentsController@delete_by_selection");

    //------------------------------- designations --------------------------\\
    //--------------------------------------------------------------------\\
    Route::resource('designations', 'hrm\DesignationsController');
    Route::get("get_designations_by_department", "hrm\DesignationsController@Get_designations_by_department");
    Route::post("designations/delete/by_selection", "hrm\DesignationsController@delete_by_selection");

    //------------------------------- office_shift ------------------\\
    //----------------------------------------------------------------\\

    Route::resource('office_shift', 'hrm\OfficeShiftController');
    Route::post("office_shift/delete/by_selection", "hrm\OfficeShiftController@delete_by_selection");

    //------------------------------- Attendances ------------------------\\
    //--------------------------------------------------------------------\\
    Route::resource('attendances', 'hrm\AttendancesController');
    Route::get("daily_attendance", "hrm\AttendancesController@daily_attendance")->name('daily_attendance');
    Route::post('attendance_by_employee/{id}', 'hrm\EmployeeSessionController@attendance_by_employee')->name('attendance_by_employee.post');
    Route::post("attendances/delete/by_selection", "hrm\AttendancesController@delete_by_selection");



    //------------------------------- Request leave  -----------------------\\
    //----------------------------------------------------------------\\

    Route::resource('leave', 'hrm\LeaveController');
    Route::resource('leave_type', 'hrm\LeaveTypeController');
    Route::post("leave/delete/by_selection", "hrm\LeaveController@delete_by_selection");
    Route::post("leave_type/delete/by_selection", "hrm\LeaveTypeController@delete_by_selection");


    //------------------------------- holiday ----------------------\\
    //----------------------------------------------------------------\\

    Route::resource('holiday', 'hrm\HolidayController');
    Route::post("holiday/delete/by_selection", "hrm\HolidayController@delete_by_selection");

    //------------------------------- core --------------------------\\
    //--------------------------------------------------------------------\\

    Route::prefix('core')->group(function () {

        Route::get("Get_departments_by_company", "hrm\CoreController@Get_departments_by_company");
        Route::get("get_designations_by_department", "hrm\CoreController@Get_designations_by_department");
        Route::get("Get_office_shift_by_company", "hrm\CoreController@Get_office_shift_by_company");
        Route::get("Get_employees_by_company", "hrm\CoreController@Get_employees_by_company");
    });






    //------------------------------- Expenses --------------------------\\
    //------------------------------------------------------------------\\

    Route::resource('expenses', 'ExpensesController');
    Route::get('expenses/export/Excel', 'ExpensesController@exportExcel');
    Route::post('expenses/delete/by_selection', 'ExpensesController@delete_by_selection');


    //------------------------------- Expenses Category--------------------------\\
    //------------------------------------------------------------------\\

    Route::resource('expensescategory', 'CategoryExpenseController');
    Route::post('expensescategory/delete/by_selection', 'CategoryExpenseController@delete_by_selection');



    //------------------------------- Users --------------------------\\
    //------------------------------------------------------------------\\

    Route::get('GetUserAuth', 'UserController@GetUserAuth');
    Route::get("/GetPermissions", "UserController@GetPermissions");
    Route::resource('users', 'UserController');
    Route::put('users/Activated/{id}', 'UserController@IsActivated');
    Route::get('users/export/Excel', 'UserController@exportExcel');
    Route::POST('users/getbranch', 'UserController@getBranches');
    Route::get('users/Get_Info/Profile', 'UserController@GetInfoProfile');
    Route::put('updateProfile/{id}', 'UserController@updateProfile');

    //------------------------------- companies --------------------------\\
    //------------------------------------------------------------------\\

/*    Route::resource('companies', 'CompanyController');
    Route::put('companies/Activated/{id}', 'CompanyController@IsActivated');
    Route::get('companies/export/Excel', 'CompanyController@exportExcel');
    Route::POST('companies/getbranch', 'CompanyController@getBranches');
    Route::get('companies/Get_Info/Profile', 'CompanyController@GetInfoProfile');*/

    //------------------------------- Category --------------------------\\
    //------------------------------------------------------------------\\

//    Route::resource('categories', 'CategorieController');
    Route::post('categories/delete/by_selection', 'CategorieController@delete_by_selection');

    //------------------------------- complains --------------------------\\
    //------------------------------------------------------------------\\

    Route::resource('complains', 'ComplainsController');
    Route::post('complains/delete/by_selection', 'ComplainsController@delete_by_selection');

    //------------------------------- support_chats --------------------------\\
    //------------------------------------------------------------------\\

    Route::resource('support_chats', 'SupportChatController');
    Route::post('support_chats/delete/by_selection', 'SupportChatController@delete_by_selection');

    //------------------------------- SubCategory --------------------------\\
    //------------------------------------------------------------------\\

    Route::resource('subcategories', 'SubCategoryController');
    Route::post('subcategories/delete/by_selection', 'SubCategoryController@delete_by_selection');


    //------------------------------- shipment_services --------------------------\\
    //------------------------------------------------------------------\\

    Route::resource('shipment_services', 'ShipmentServicesController');
    Route::post('shipment_services/delete/by_selection', 'ShipmentServicesController@delete_by_selection');

    //------------------------------- subscribes --------------------------\\
    //------------------------------------------------------------------\\

    Route::resource('subscribes', 'SubscribeController');
    Route::post('subscribes/delete/by_selection', 'SubscribeController@delete_by_selection');

    //------------------------------- Units --------------------------\\
    //------------------------------------------------------------------\\

    Route::resource('units', 'UnitsController');
    Route::get('Get_Units_SubBase', 'UnitsController@Get_Units_SubBase');
    Route::get('Get_sales_units', 'UnitsController@Get_sales_units');

    // -------------------------- packages --------------------\\

    Route::resource('packages', 'PackagesController');

    //------------------------------- Languages --------------------------\\
    //------------------------------------------------------------------\\

    Route::resource('languages', 'LanguagesController');
    Route::post('languages/delete/by_selection', 'LanguagesController@delete_by_selection');

    //------------------------------- Brands--------------------------\\
    //------------------------------------------------------------------\\
    Route::resource('brands', 'BrandsController');
    Route::post('brands/delete/by_selection', 'BrandsController@delete_by_selection');

    //------------------------------- Ads--------------------------\\
    //------------------------------------------------------------------\\
    Route::resource('ads', 'AdsController');
    Route::post('ads/delete/by_selection', 'AdsController@delete_by_selection');

    //------------------------------- Trade Show--------------------------\\
    //------------------------------------------------------------------\\
    Route::resource('trade_show', 'TradeShowController');
    Route::post('trade_show/delete/by_selection', 'TradeShowController@delete_by_selection');

    //------------------------------- translation_services--------------------------\\
    //------------------------------------------------------------------\\  meditations
    Route::resource('translation_services', 'TranslationServicesController');
    Route::post('translation_services/delete/by_selection', 'TranslationServicesController@delete_by_selection');

    //------------------------------- meditations--------------------------\\
    //------------------------------------------------------------------\\
    Route::resource('meditations', 'MeditationController');
    Route::post('meditations/delete/by_selection', 'MeditationController@delete_by_selection');

    //------------------------------- Shipment Orders--------------------------\\
    //------------------------------------------------------------------\\
    Route::resource('shipment_orders', 'ShipmentOrdersController');
    Route::post('shipment_orders/delete/by_selection', 'ShipmentOrdersController@delete_by_selection');


    //------------------------------- Currencies --------------------------\\
    //------------------------------------------------------------------\\

    Route::resource('currencies', 'CurrencyController');
    Route::get('Get_Currencies/All', 'CurrencyController@Get_Currencies');
    Route::post('currencies/delete/by_selection', 'CurrencyController@delete_by_selection');



    //------------------------------- Permission Groups user -----------\\
    //------------------------------------------------------------------\\

    Route::resource('roles', 'PermissionsController');
    Route::get('roles/check/Create_page', 'PermissionsController@Check_Create_Page');
    Route::get('getRoleswithoutpaginate', 'PermissionsController@getRoleswithoutpaginate');
    Route::post('roles/delete/by_selection', 'PermissionsController@delete_by_selection');

    //------------------------------- Providers --------------------------\\
    //--------------------------------------------------------------------\\

    Route::resource('providers', 'ProvidersController');
    Route::get('providers/export/Excel', 'ProvidersController@exportExcel');
    Route::post('providers/import/csv', 'ProvidersController@import_providers');
    Route::post('providers/delete/by_selection', 'ProvidersController@delete_by_selection');


    //------------------------------- Settings ------------------------\\
    //------------------------------------------------------------------\\
    Route::resource('settings', 'SettingsController');

    Route::put('pos_settings/{id}', 'SettingsController@update_pos_settings');
    Route::get('get_pos_Settings', 'SettingsController@get_pos_Settings');

    Route::put('SMTP/{id}', 'SettingsController@updateSMTP');
    Route::post('SMTP', 'SettingsController@CreateSMTP');
    Route::get('getSettings', 'SettingsController@getSettings');
    Route::get('getSMTP', 'SettingsController@getSMTP');
    Route::get('get_sms_config', 'SettingsController@get_sms_config');


    Route::post('payment_gateway', 'SettingsController@Update_payment_gateway');
    Route::post('sms_config', 'SettingsController@sms_config');
    Route::get('Get_payment_gateway', 'SettingsController@Get_payment_gateway');

    //------------------------------- Company Settings ------------------------\\
    //------------------------------------------------------------------\\
    Route::resource('company_settings', 'CompanySettingsController');
    Route::get('getCompanySettings', 'CompanySettingsController@getSettings');


    //------------------------------- Backup --------------------------\\
    //------------------------------------------------------------------\\

    Route::get("GetBackup", "ReportController@GetBackup");
    Route::get("GenerateBackup", "ReportController@GenerateBackup");
    Route::delete("DeleteBackup/{name}", "ReportController@DeleteBackup");
});

//-------------------------------  Print & PDF ------------------------\\
//------------------------------------------------------------------\\

Route::get('Sale_PDF/{id}', 'SalesController@Sale_PDF');
Route::get('Quote_PDF/{id}', 'QuotationsController@Quotation_pdf');
Route::get('Purchase_PDF/{id}', 'PurchasesController@Purchase_pdf');
Route::get('Return_sale_PDF/{id}', 'SalesReturnController@Return_pdf');
Route::get('Return_Purchase_PDF/{id}', 'PurchasesReturnController@Return_pdf');
Route::get('Payment_Purchase_PDF/{id}', 'PaymentPurchasesController@Payment_purchase_pdf');
Route::get('payment_Return_sale_PDF/{id}', 'PaymentSaleReturnsController@payment_return');
Route::get('payment_Return_Purchase_PDF/{id}', 'PaymentPurchaseReturnsController@payment_return');
Route::get('payment_Sale_PDF/{id}', 'PaymentSalesController@payment_sale');
Route::get('Sales/Print_Invoice/{id}', 'SalesController@Print_Invoice_POS');
Route::post('changeStatus/{id}', 'SalesController@changeStatus');

Route::get('Products/filter/{id}/{input}', 'ProductsController@Filter_Products');



    //------------------------------- Payments  Sales --------------------------\\
    //------------------------------------------------------------------\\

    Route::resource('payment/sale', 'PaymentSalesController');
    Route::get('payment/sale/Number/Order', 'PaymentSalesController@getNumberOrder');
    Route::get('payment/sale/export/Excel', 'PaymentSalesController@exportExcel');
    Route::post('payment/sale/send/email', 'PaymentSalesController@SendEmail');
    Route::post('payment/sale/send/sms', 'PaymentSalesController@Send_SMS');

//Notifications
Route::get('get_notifications', 'NotificationController@getNotifications');
Route::get('get_unread_notifications', 'NotificationController@getUnreadNotifications');
Route::put('read_notification', 'NotificationController@readNotification');
