<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

// use App\Http\Controllers\ApiController;
Route::get('/', function () {
    return view('Admin.index');
});

############# Admin Login Start Here  ###############
Route::get('/login', function () {
    return view('Auth.login');
});
Route::post("/admin-login", [AdminController::class, 'admin_login']);
Route::get('/admin-dashboard', function () { // Dashboard
    return view('Admin.index');
});
Route::get("/admin-logout", [AdminController::class, 'admin_logout']); // logout
Route::get('/admin-changepassword', function () { // Change Password
    return view('Admin.pages.changepassword');
});
Route::post('/changepassword/admin', [AdminController::class, 'changepasswordset']);
Route::get('/admin-profile', function () {
    return view('Admin.pages.profile');
});
Route::post('/profile/admin', [AdminController::class, 'updateprofile']);


#### Manage Slider Here ####
Route::get('/admin-slider', [AdminController::class, 'slider']);
Route::post('/add_slider', [AdminController::class, 'add_slider']);
Route::post('/update_slider', [AdminController::class, 'update_slider']);
Route::post('/delete_slider', [AdminController::class, 'delete_slider']);
Route::post('/switch_status_update/{tableName}', [AdminController::class, 'switch_status_update']);  // Switch Status

#### Manage User Here ####
Route::get('/admin-user', [AdminController::class, 'show_user']);
Route::post('/delete_user', [AdminController::class, 'delete_user']);


######### Onchange Role To Team ###########
Route::post('/TeamDropdown', [AdminController::class, 'TeamDropdown']);
######### Onchange Team To SuperManager ###########
Route::post('/SuperManagerDropdown', [AdminController::class, 'SuperManagerDropdown']);
######### Onchange SuperManager To Manager ###########
Route::post('/ManagerDropdown', [AdminController::class, 'ManagerDropdown']);
######### Onchange Manager To TeamLeader ###########
Route::post('/TeamLeaderDropdown', [AdminController::class, 'TeamLeaderDropdown']);
######### Onchange TeamLeader To Agent ###########
Route::post('/AgentDropdown', [AdminController::class, 'AgentDropdown']);




####################   Account Setting Start Here  #######################
// Admin me Crud Fields Start Here  
Route::get('/Settings', [AdminController::class, 'Settings']);
#### Manage Product Here ####
Route::get('/admin-product', [AdminController::class, 'product']);
Route::post('/add_product', [AdminController::class, 'add_product']);
Route::post('/update_product', [AdminController::class, 'update_product']);
Route::post('/delete_product', [AdminController::class, 'delete_product']);
#### Manage Campaign Here ####
Route::get('/admin-campaign', [AdminController::class, 'campaign']);
Route::post('/add_campaign', [AdminController::class, 'add_campaign']);
Route::post('/update_campaign', [AdminController::class, 'update_campaign']);
Route::post('/delete_campaign', [AdminController::class, 'delete_campaign']);
#### Manage Bank Here ####
Route::get('/admin-bank', [AdminController::class, 'bank']);
Route::post('/add_bank', [AdminController::class, 'add_bank']);
Route::post('/update_bank', [AdminController::class, 'update_bank']);
Route::post('/delete_bank', [AdminController::class, 'delete_bank']);
#### Manage Product Need Here ####
Route::get('/admin-product-need', [AdminController::class, 'product_need']);
Route::post('/add_product_need', [AdminController::class, 'add_product_need']);
Route::post('/update_product_need', [AdminController::class, 'update_product_need']);
Route::post('/delete_product_need', [AdminController::class, 'delete_product_need']);
#### Manage Casetype Here ####
Route::get('/admin-casetype', [AdminController::class, 'casetype']);
Route::post('/add_casetype', [AdminController::class, 'add_casetype']);
Route::post('/update_casetype', [AdminController::class, 'update_casetype']);
Route::post('/delete_casetype', [AdminController::class, 'delete_casetype']);

#### lead_form ####
Route::get('/admin-lead-form', [AdminController::class, 'lead_form']);
### Add lead show Here ###
Route::get('/admin-leads', [AdminController::class, 'leads']);
// Add lead here 
Route::post('/add_leads', [AdminController::class, 'addLeads']);
Route::post('/delete_lead', [AdminController::class, 'DeleteLead']);
Route::post('/multiple_delete_lead', [AdminController::class, 'MultipleDeleteLead']);
### Check Lead ### 
Route::post('/check_lead', [AdminController::class, 'checkLead']);

##################################################### PL OD LEADS #######################################################
### show_pl_od_leads ###
Route::get('/show_pl_od_leads', [AdminController::class, 'show_Pl_Od_Lead']);

### show_pl_od_login ###
Route::get('/show_pl_od_login', [AdminController::class, 'show_Pl_Od_Login']);

Route::post('/update-obligation', [AdminController::class, 'updateobligation']);  // obligation 

### User Profile ### 
Route::get('/user_profile/{id?}', [AdminController::class, 'user_profile']);
// update about section
Route::post('/updateAboutsection', [AdminController::class, 'update_aboutsection']);
// update process section
Route::post('/updateProcess', [AdminController::class, 'update_process']);
// update about section
Route::post('/updateoperationsection', [AdminController::class, 'updateOperationSection']);
// update Attachment
Route::post('/updateAttachment', [AdminController::class, 'update_attachment']);
// changeleadstatus
Route::post('/changeleadstatus', [AdminController::class, 'changeLeadStatus']);
// changeloginstatus
Route::post('/changeloginstatus', [AdminController::class, 'changeLoginStatus']);

// updatelostleadstatus
Route::post('/updatelostleadstatus', [AdminController::class, 'changeLostLeadStatus']);
// Zip Downloaded here all files 
Route::get('/download-zip/{id?}', [AdminController::class, 'downloadZip'])->name('download.zip');
// Attachments Show Here 
Route::get('/fetch-data', [AdminController::class, 'getLeadData']);
// Delete Attachment Single File
Route::post('/delete_attachment_single_file', [AdminController::class, 'delete_attachment_single_file']);
// Update Login Form Section
Route::post('/updateLoginForm', [AdminController::class, 'update_loginform']);

// user profile link 
Route::get('/user_link/{id}', [AdminController::class, 'showUserProfile']);
// Update Login Form Section Link Share
Route::post('/updateLoginFormLink', [AdminController::class, 'update_loginformlink']);
Route::get('/thankyou', function () {
    return view('Admin.pages.thankyou');
});

// obligation onchange company type to company name
Route::post('/fetch-company-category', [AdminController::class, 'fetchCompanyCategory']);
// Update Obligation Section
Route::post('/updateObligationsection', [AdminController::class, 'update_obligationsection']);
// Update Checkbox Imp Question Section
Route::post('/update-imp-question', [AdminController::class, 'updateImpQuestion']);

// copyThisLead
Route::post('/copy-this-lead', [AdminController::class, 'copyThisLead']);

// updateFileSenttoLogin
Route::post('/update-file-sentto-login', [AdminController::class, 'updateFileSenttoLogin']);
Route::get('/get-admin-users', [AdminController::class, 'getAdminUsers']);

// filter leads
Route::post('/filter_leads', [AdminController::class, 'filterLeads']);
// Add Remark From User Profile
Route::post('/add_remark', [AdminController::class, 'addRemark']);
####################   Task Start Here  #######################
Route::get('/admin-task',[AdminController::class, 'task']);
Route::post('/add_task', [AdminController::class, 'addTask']);
Route::post('/update_task', [AdminController::class, 'updateTask']);

####################   Ticket Start Here  #######################
Route::get('/admin-ticket',[AdminController::class, 'ticket']);
Route::post('/add_ticket', [AdminController::class, 'addTicket']);
Route::get('/get-ticket-status', [AdminController::class, 'getTicketStatus']);  // Ticket Status 
Route::get('/get-ticket-history', [AdminController::class, 'getTicketHistory']);    // Ticket History 
Route::get('/get-ticket-comments', [AdminController::class, 'getTicketComments']);     // Ticket Comments 
Route::post('/add_ticket_comment', [AdminController::class, 'addTicketComment']);     // addTicketComment
Route::post('/update_ticket', [AdminController::class, 'updateTicket']);             // updateTicket
Route::post('/update-ticket-status', [AdminController::class, 'updateTicketStatus']);  // updateTicketStatus

// Add Comment 
Route::post('/add_comment', [AdminController::class, 'addComment']);
// web.php
Route::get('/get-task-comments', [AdminController::class, 'getTaskComments']);
// Task Status
Route::get('/get-task-status', [AdminController::class, 'getTaskStatus']);
// update Task Status
Route::post('/update-task-status', [AdminController::class, 'updateTaskStatus']);
// get task history
Route::get('/get-task-history', [AdminController::class, 'getTaskHistory']);
// lead-login-status
Route::post('/lead-login-status', [AdminController::class, 'LeadLoginStatus']);

// Exist 
Route::post('/check_mobile_existence', [AdminController::class, 'checkMobileExistence']);


