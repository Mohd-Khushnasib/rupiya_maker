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
// Route::get('/admin-dashboard', function () { // Dashboard
//     return view('Admin.index');
// });

Route::get('/admin-dashboard', function () { 
    return view('Admin.index'); // Pehle sirf page load hoga
});




// Route::post('/fetch_feeds', function (Request $request) {
//     $adminSession = collect(session()->get('admin_login'))->first();
//     if (!$adminSession) {
//         return response()->json(['status' => 0, 'message' => 'Session Expired'], 401);
//     }

//     $admin_id = $adminSession->id;
//     $admin_role = $adminSession->role;

//     $query = DB::table('tbl_feed')
//         ->join('admin', 'tbl_feed.admin_id', '=', 'admin.id')
//         ->leftJoin('tbl_feed_comment', 'tbl_feed.id', '=', 'tbl_feed_comment.feed_id')
//         ->leftJoin('admin as commenter', 'tbl_feed_comment.admin_id', '=', 'commenter.id')
//         ->select(
//             'tbl_feed.id',
//             'tbl_feed.admin_id',
//             'tbl_feed.message',
//             'tbl_feed.image',
//             'tbl_feed.permition',
//             'tbl_feed.date',
//             'tbl_feed.pinned',
//             'admin.name as creator_name',
//             'admin.role as creator_role',
//             DB::raw("GROUP_CONCAT(tbl_feed_comment.comment ORDER BY tbl_feed_comment.id SEPARATOR '||') as comments"),
//             DB::raw("GROUP_CONCAT(commenter.name ORDER BY tbl_feed_comment.id SEPARATOR '||') as commenter_names")
//         )
//         ->groupBy('tbl_feed.id', 'tbl_feed.admin_id', 'tbl_feed.message', 'tbl_feed.image', 'tbl_feed.permition', 'tbl_feed.date', 'tbl_feed.pinned', 'admin.name', 'admin.role')
//         ->orderByRaw("CASE WHEN tbl_feed.pinned = 1 THEN 0 ELSE 1 END")
//         ->orderBy('tbl_feed.id', 'desc');

//     if (!in_array($admin_role, ['Admin', 'HR'])) {
//         $query->where('tbl_feed.admin_id', $admin_id)
//               ->whereRaw("FIND_IN_SET(?, tbl_feed.permition)", [$admin_role]);
//     }    
//     $feeds = $query->get();
//     return response()->json(['status' => 1, 'data' => $feeds]);
// });


// Route::post('/fetch_feeds', function (Request $request) {
//     $adminSession = collect(session()->get('admin_login'))->first();
//     if (!$adminSession) {
//         return response()->json(['status' => 0, 'message' => 'Session Expired'], 401);
//     }
//     $admin_id = $adminSession->id;
//     $admin_role = $adminSession->role;
    
//     $query = DB::table('tbl_feed')
//         ->join('admin', 'tbl_feed.admin_id', '=', 'admin.id')
//         ->leftJoin('tbl_feed_comment', 'tbl_feed.id', '=', 'tbl_feed_comment.feed_id')
//         ->leftJoin('admin as commenter', 'tbl_feed_comment.admin_id', '=', 'commenter.id')
//         ->select(
//             'tbl_feed.id',
//             'tbl_feed.admin_id',
//             'tbl_feed.message',
//             'tbl_feed.image',
//             'tbl_feed.permition',
//             'tbl_feed.date', // ✅ Feed Post Date
//             'tbl_feed.pinned',
//             'admin.name as creator_name',
//             'admin.role as creator_role',
//             DB::raw("GROUP_CONCAT(tbl_feed_comment.comment ORDER BY tbl_feed_comment.id SEPARATOR '||') as comments"),
//             DB::raw("GROUP_CONCAT(tbl_feed_comment.date ORDER BY tbl_feed_comment.id SEPARATOR '||') as comment_dates"), // ✅ Comment Date Added
//             DB::raw("GROUP_CONCAT(commenter.name ORDER BY tbl_feed_comment.id SEPARATOR '||') as commenter_names")
//         )
//         ->groupBy('tbl_feed.id', 'tbl_feed.admin_id', 'tbl_feed.message', 'tbl_feed.image', 'tbl_feed.permition', 'tbl_feed.date', 'tbl_feed.pinned', 'admin.name', 'admin.role')
//         ->orderByRaw("CASE WHEN tbl_feed.pinned = 1 THEN 0 ELSE 1 END")
//         ->orderBy('tbl_feed.id', 'desc');

//     if (!in_array($admin_role, ['Admin', 'HR'])) {
//         $isAdminOrHR = DB::table('admin')->where('id', $admin_id)->whereIn('role', ['Admin', 'HR'])->exists();

//         if (!$isAdminOrHR) {
//             $query->whereRaw("FIND_IN_SET(?, tbl_feed.permition)", [$admin_role]);
//         }
//     }

//     $feeds = $query->get();
//     return response()->json(['status' => 1, 'data' => $feeds]);
// });

Route::post('/fetch_feeds', function (Request $request) {
    $adminSession = collect(session()->get('admin_login'))->first();
    if (!$adminSession) {
        return response()->json(['status' => 0, 'message' => 'Session Expired'], 401);
    }
    $admin_id = $adminSession->id;
    $admin_role = $adminSession->role;
    
    $query = DB::table('tbl_feed')
        ->join('admin', 'tbl_feed.admin_id', '=', 'admin.id')
        ->leftJoin('tbl_feed_comment', 'tbl_feed.id', '=', 'tbl_feed_comment.feed_id')
        ->leftJoin('admin as commenter', 'tbl_feed_comment.admin_id', '=', 'commenter.id')
        ->select(
            'tbl_feed.id',
            'tbl_feed.admin_id',
            'tbl_feed.message',
            'tbl_feed.image',
            'tbl_feed.permition',
            'tbl_feed.date', // ✅ Feed Post Date
            'tbl_feed.pinned',
            'admin.name as creator_name',
            'admin.role as creator_role',
            DB::raw("GROUP_CONCAT(tbl_feed_comment.comment ORDER BY tbl_feed_comment.id SEPARATOR '||') as comments"),
            DB::raw("GROUP_CONCAT(tbl_feed_comment.date ORDER BY tbl_feed_comment.id SEPARATOR '||') as comment_dates"), // ✅ Comment Date Added
            DB::raw("GROUP_CONCAT(commenter.name ORDER BY tbl_feed_comment.id SEPARATOR '||') as commenter_names"),
            DB::raw("COUNT(tbl_feed_comment.id) as total_comments") // ✅ Total Comments Count
        )
        ->groupBy('tbl_feed.id', 'tbl_feed.admin_id', 'tbl_feed.message', 'tbl_feed.image', 'tbl_feed.permition', 'tbl_feed.date', 'tbl_feed.pinned', 'admin.name', 'admin.role')
        ->orderByRaw("CASE WHEN tbl_feed.pinned = 1 THEN 0 ELSE 1 END")
        ->orderBy('tbl_feed.id', 'desc');

    if (!in_array($admin_role, ['Admin', 'HR'])) {
        $isAdminOrHR = DB::table('admin')->where('id', $admin_id)->whereIn('role', ['Admin', 'HR'])->exists();

        if (!$isAdminOrHR) {
            $query->whereRaw("FIND_IN_SET(?, tbl_feed.permition)", [$admin_role]);
        }
    }

    $feeds = $query->get();
    return response()->json(['status' => 1, 'data' => $feeds]);
});







#### Feed Here #### 
Route::post("/admin-feed", [AdminController::class, 'add_feed']);
// Feed Pinned Here 
Route::post("/update_feed_status", [AdminController::class, 'updateFeedStatus']);
// Feed Add Comment 
Route::post('/submit_comment', [AdminController::class, 'storeComment']);



// Admin Dashboard Show Here 
// Route::get('/admin-dashboard', function () { 
//     $adminSession = collect(session()->get('admin_login'))->first(); // Pehla record extract karna
//     if (!$adminSession) {
//         return redirect('/login')->with('error', 'Please login first.');
//     }
//     $admin_id = $adminSession->id;
//     $admin_role = $adminSession->role;
//     // Fetch feed data
//     $query = DB::table('tbl_feed')
//         ->join('admin', 'tbl_feed.admin_id', '=', 'admin.id')
//         ->select('tbl_feed.*', 'admin.name', 'admin.role');
//     // Agar role "Admin" ya "HR" nahi hai, to permission check kare
//     if (!in_array($admin_role, ['Admin', 'HR'])) {
//         $query->whereRaw("FIND_IN_SET(?, tbl_feed.permition)", [$admin_role]);
//     }
//     $feeds = $query->get();
//     return view('Admin.index', compact('feeds'));
// });

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

// export_to_excel_plodlead
Route::get('/export_to_excel_plodlead', [AdminController::class, 'ExcelExportPlOdLead']);
// export_to_excel_plodlogin
Route::get('/export_to_excel_plodlogin', [AdminController::class, 'ExcelExportPlOdLogin']);


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
#### Manage Datacode Here ####
Route::get('/admin-datacode', [AdminController::class, 'datacode']);
Route::post('/add_datacode', [AdminController::class, 'add_datacode']);
Route::post('/update_datacode', [AdminController::class, 'update_datacode']);
Route::post('/delete_datacode', [AdminController::class, 'delete_datacode']);
#### Manage Product Wise Important Question Here #### 
Route::get('/admin-imp-question', [AdminController::class, 'imp_question']);
Route::post('/add_imp_question', [AdminController::class, 'add_imp_question']);
Route::post('/update_imp_question', [AdminController::class, 'update_imp_question']);
Route::post('/delete_imp_question', [AdminController::class, 'delete_imp_question']);
#### Manage Channel Name Here ####
Route::get('/admin-channel_name', [AdminController::class, 'channel_name']);
Route::post('/add_channel_name', [AdminController::class, 'add_channel_name']);
Route::post('/update_channel_name', [AdminController::class, 'update_channel_name']);
Route::post('/delete_channel_name', [AdminController::class, 'delete_channel_name']);
#### Manage Warning Here ####
Route::get('/admin-warning_type', [AdminController::class, 'warning_type']);
Route::post('/add_warning_type', [AdminController::class, 'add_warning_type']);
Route::post('/update_warning_type', [AdminController::class, 'update_warning_type']);
Route::post('/delete_warning_type', [AdminController::class, 'delete_warning_type']);


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

// generate_reassignment_request Here 
Route::post('/generate_reassignment_request', [AdminController::class, 'GenerateReassignmentRequest']);
// assign-to-me
Route::post('/assign-to-me', [AdminController::class, 'AssignToMe']);
Route::post('/accept-reject-request', [AdminController::class, 'AcceptRejectRequest']);

##################################################### PL OD LEADS #######################################################
### show_pl_od_leads ###
Route::get('/show_pl_od_leads', [AdminController::class, 'show_Pl_Od_Lead']);
Route::post('/show_Pl_Od_LeadAPI', [AdminController::class, 'show_Pl_Od_LeadAPI']);

### show_pl_od_login ###
Route::get('/show_pl_od_login', [AdminController::class, 'show_Pl_Od_Login']);
Route::post('/show_Pl_Od_loginapi', [AdminController::class, 'show_Pl_Od_LoginAPI']);

### show_home_loan_leads ###
Route::get('/show_home_loan_leads', [AdminController::class, 'show_Home_Loan_Lead']);
Route::post('/show_Home_Loan_LeadAPI', [AdminController::class, 'show_Home_Loan_LeadAPI']);

### show_home_loan_login ###
Route::get('/show_home_loan_login', [AdminController::class, 'show_Home_Loan_Login']);
Route::post('/show_Home_Loan_loginapi', [AdminController::class, 'show_Home_Loan_LoginAPI']);



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
// Delete Obligation From History 
Route::post('/delete_obligation', [AdminController::class, 'deleteObligation']);
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


####################   Warning Start Here  #######################
Route::get('/admin-warning',[AdminController::class, 'warning']);
Route::post('/add_warning', [AdminController::class, 'addWarning']);
Route::get('/get-warning-status', [AdminController::class, 'getWarningStatus']);  // Warning Status 
Route::get('/get-warning-history', [AdminController::class, 'getWarningHistory']);    // Warning History 
Route::get('/get-warning-comments', [AdminController::class, 'getWarningComments']);     // Warning Comments 
Route::post('/add_warning_comment', [AdminController::class, 'addWarningComment']);     // addWarningComment
Route::post('/update_warning', [AdminController::class, 'updateWarning']);             // updateWarning
Route::post('/update-warning-status', [AdminController::class, 'updateWarningStatus']);  // updateWarningStatus
Route::post('/delete_warning', [AdminController::class, 'deleteWarning']);  // updateWarningStatus


// issuedtotalwaning 
Route::post('/issuedtotalwaning', [AdminController::class, 'issuedTotalWarning']);



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

// emi calculator 
Route::get('/admin-calculator',function(){
    return view('Admin.pages.calculator');
});
// emi_status change 
Route::get('/emi-status',function(){
    $data['emi'] = DB::table("tbl_emi")->first();
    return view('Admin.pages.emi_status',$data);
});
// emi share link
Route::get('/emi_link/{status}', function ($status) {
    $data['emi_link'] = DB::table("tbl_emi")->where('status', '=', $status)->first();
    return view('Admin.pages.emi_link', $data);
});


// Excel Upload Here 
Route::get('/excel',function(){
    return view('Admin.pages.excel');
});
Route::post('/import_excel', [AdminController::class, 'importExcel']);

####################### Comapny Category Excel File Upload Start Here ############################
Route::get('/admin-company-category', [AdminController::class, 'companyCategory']);
Route::post('/add_company_category', [AdminController::class, 'addCompanyCategory']);
Route::post('/show_company_category', [AdminController::class, 'showCompanyCategory']);
Route::post('/delete_company_category', [AdminController::class, 'deleteCompanyCategory']);
Route::post('/update_company_category', [AdminController::class, 'updateCompanyCategory']);