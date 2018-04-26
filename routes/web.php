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

Route::get('/', 'Auth\LoginController@showLoginForm');

//Auth::routes();

// Authentication Routes...
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// Registration Routes...
//Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
//Route::post('register', 'Auth\RegisterController@register');

// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');


Route::group([ 'middleware' => ['isAuthorized'] ] , function (){ 



	Route::get('/dashboard', 'DashboardController@index');
	Route::get('/sales/getSalesByYear', 'DashboardController@getSalesByYear');

	Route::get('/users', 'UserController@users');
	Route::get('/user', 'UserController@getUser');
	Route::get('/users/profile', 'UserController@userProfile');
	Route::post('/users/updateEmail', 'UserController@updateEmail');
	Route::post('/users/changePassword', 'UserController@changePassword');
	Route::post('/users/updateBasicInfo', 'UserController@updateBasicInfo');
	Route::post('/users/changeProfiePicture', 'UserController@changeProfiePicture');
	Route::post('/users/updateAgentRank', 'UserController@updateAgentRank');

	Route::get('/users/agent', 'UserController@agents');
	Route::get('/users/agent/add', 'UserController@addAgentShowForm');
	Route::post('/users/agent/add', 'UserController@addAgent');
	Route::get('/users/agent/search', 'UserController@searchAgent');
	Route::get('/users/update', 'UserController@updateUser');
	Route::post('/users/agent/approve', 'UserController@approve');
	Route::post('/users/agent/disapprove', 'UserController@disapprove');
	Route::get('/users/agent/ranks', 'UserController@agentRanks');
	Route::post('/users/agent/rank/update', 'UserController@updateAgentRankType');
	Route::get('/users/agent/rank', 'UserController@getAgentRank');
	Route::post('/users/updateAgentRecruiter', 'UserController@updateAgentRecruiter');

	Route::post('/users/account/validate', 'UserController@validateAccount');
	Route::post('/users/additinalinfo/validate', 'UserController@validateAdditionalInfo');

	Route::get('verifyrights', 'UserController@verifyrights');
	Route::post('users/setToNotActive', 'UserController@setToNotActive');
	Route::post('users/setToActive', 'UserController@setToActive');

	Route::get('/users/staff', 'UserController@staffs')->middleware('isAdminSuperAdmin');
	Route::get('/users/staff/add', 'UserController@addStaffShowForm')->middleware('isAdminSuperAdmin');
	Route::post('/users/staff/add', 'UserController@addStaff')->middleware('isAdminSuperAdmin');

	Route::get('/users/admin', 'UserController@admins')->middleware('isSuperAdmin');
	Route::get('/users/admin/add', 'UserController@addAdminShowForm')->middleware('isSuperAdmin');
	Route::post('/users/admin/add', 'UserController@addAdmin')->middleware('isSuperAdmin');



	Route::get('/sales', 'SalesController@sales');
	Route::get('/sales/add', 'SalesController@addSalesShowForm');
	Route::post('/sales/add', 'SalesController@addSales');
	Route::post('/sales/validateContractInfo', 'SalesController@validateContractInfo');
	Route::post('/sales/validateClientInfo', 'SalesController@validateClientInfo');
	Route::get('sales/approved', 'SalesController@approvedSales');
	Route::get('sales/pending', 'SalesController@pendingSales');
	Route::get('sales/cancelled', 'SalesController@cancelledSales');
	Route::post('sales/approve', 'SalesController@approveSales');
	Route::post('sales/cancel', 'SalesController@cancelSales');
	Route::post('sales/uncancel', 'SalesController@uncancelSales');
	Route::get('sales/details', 'SalesController@viewSales');
	Route::get('sales/update', 'SalesController@updateSalesShowForm');
	Route::post('sales/updateSalesProject', 'SalesController@updateSalesProject');
	Route::post('sales/updateSalesContract', 'SalesController@updateSalesContract');
	Route::post('sales/updateSalesAgent', 'SalesController@updateSalesAgent');
	Route::post('sales/updateSalesClient', 'SalesController@updateSalesClient');
	Route::post('sales/updateSales', 'SalesController@updateSales');



	Route::get('events/calendar', 'EventController@eventsCalendar');
	Route::get('events', 'EventController@events');
	Route::get('event', 'EventController@getEvent');
	Route::post('events/add', 'EventController@addEvent');
	Route::post('event/update', 'EventController@updateEvent');
	Route::post('event/cancel', 'EventController@cancelEvent');
	Route::post('event/resume', 'EventController@resumeEvent');
	Route::get('events/fetch', 'EventController@refetchEventsToCalendar');



	Route::get('notifications', 'NotificationController@notifications');
	Route::get('notification', 'NotificationController@notification');
	Route::get('notification/item', 'NotificationController@notificationItem');


	Route::get('/developers', 'DeveloperController@developers');
	Route::get('/developers/add', 'DeveloperController@addDeveloperShowForm');
	Route::post('/developer/add/validate/basicinformation', 'DeveloperController@validateBasicInformation');
	Route::post('/developers/add', 'DeveloperController@addDeveloper');
	Route::get('/developer/profile', 'DeveloperController@developerProfile');
	Route::post('/developer/SetToNotActive', 'DeveloperController@SetToNotActive');
	Route::post('/developer/SetToActive', 'DeveloperController@SetToActive');
	Route::get('/developer/update', 'DeveloperController@updateDeveloperShowForm');
	Route::post('/developers/updateDeveloperInformation', 'DeveloperController@updateDeveloperInformation');
	Route::post('/developers/updateDeveloperProfile', 'DeveloperController@updateDeveloperProfile');
	Route::post('/developers/updateDeveloperLogo', 'DeveloperController@updateDeveloperLogo');

	Route::get('/projects', 'ProjectController@projects');
	Route::get('/projects/grid', 'ProjectController@projectsGrid');
	Route::get('/projects/search', 'ProjectController@searchProject');
	Route::get('/projects/add', 'ProjectController@addProjectShowForm');
	Route::post('/projects/add', 'ProjectController@addProject');
	Route::post('/projects/add/validate/basicinformation', 'ProjectController@validateBasicInformation');
	Route::post('/projects/validate/projectDetails', 'ProjectController@validateProjectDetails');
	Route::get('/project/info', 'ProjectController@viewProject');
	Route::post('/projects/SetToNotActive', 'ProjectController@SetToNotActive');
	Route::post('/projects/SetToActive', 'ProjectController@SetToActive');
	Route::get('/project/update', 'ProjectController@updateProjectShowForm');
	Route::post('/project/updateProjectInformation', 'ProjectController@updateProjectInformation');
	Route::post('/project/updateProjectDeveloper', 'ProjectController@updateProjectDeveloper');
	Route::post('/project/updateProjectCategory', 'ProjectController@updateProjectCategory');
	Route::post('/project/updateProjectDescription', 'ProjectController@updateProjectDescription');
	Route::post('/project/updateProjectFeaturedPhoto', 'ProjectController@updateProjectFeaturedPhoto');
	Route::post('/project/updateProjectAdditionalPhotos', 'ProjectController@updateProjectAdditionalPhotos');
	Route::post('/project/deleteProjectAdditionalPhoto', 'ProjectController@deleteProjectAdditionalPhoto');
	Route::get('/project/viewProjectPhoto', 'ProjectController@viewProjectPhoto');
	

	
	Route::get('/reports', 'ReportController@reports');
	Route::get('/reports/filters', 'ReportController@filters');
	Route::get('/reports/generate', 'ReportController@generate');

	Route::get('/reports/agents', 'ReportController@agents');
	Route::get('/reports/agents/filters', 'ReportController@agentsFilters');


	Route::get('/reports/developers', 'ReportController@developers');
	Route::get('/reports/projects', 'ReportController@projects');


	Route::get('/agent/names', 'UserController@getAgentNames');








	Route::post('users/import', 'ExcelController@importUserExcel');

	Route::post('users/export/all', 'ExcelController@exportAllUsersToExcel');
	Route::post('users/export/all/active', 'ExcelController@exportAllActiveUsersToExcel');
	Route::post('users/export/all/notactive', 'ExcelController@exportAllNotActiveUsersToExcel');

	Route::post('users/export/agents', 'ExcelController@exportAllAgentsToExcel');
	Route::post('users/export/agents/active', 'ExcelController@exportAllActiveAgentsToExcel');
	Route::post('users/export/agents/notactive', 'ExcelController@exportAllNotActiveAgentsToExcel');

	Route::post('users/export/staffs', 'ExcelController@exportAllStaffsToExcel');
	Route::post('users/export/staffs/active', 'ExcelController@exportAllActiveStaffsToExcel');
	Route::post('users/export/staffs/notactive', 'ExcelController@exportAllNotActiveStaffsToExcel');


	Route::get('/notifications/markAsRead', function(){
		auth()->user()->unreadNotifications->markAsRead();
	});



 	Route::get('/treeview', 'AgentController@treeview');


});






Route::group([ 'middleware' => ['isAgent'] ] , function (){ 

	Route::get('/home', 'AgentController@index');
	Route::get('/profile', 'AgentController@profile');
	Route::get('/profile/update', 'AgentController@updateProfile');
	Route::get('/{id}/profile', 'AgentController@down_profile');
	Route::get('/mysales', 'AgentController@sales');
	Route::get('/agent/downlines', 'AgentController@getDownlines');
	Route::get('/developers/projects', 'AgentController@projects');
	Route::get('/developers/projects/search', 'AgentController@searchProject');
	Route::get('/developers/projects/filter', 'AgentController@filterProject');
	Route::post('/agent/profile/changeprofilepicture', 'AgentController@changeProfilePicture');
	Route::post('/agent/profile/chanegpassword', 'AgentController@changePassword');

	Route::get('/project/{id}/info', 'AgentController@viewProject');
	Route::get('/mysales/info', 'AgentController@salesInfo');
	Route::get('/agent/events', 'AgentController@events');
	Route::get('/agent/event', 'AgentController@getEvent');


});


/*


Route::group([ 'middleware' => ['isAdmin'] ] , function (){ 

// admin routes

	    Route::get('dashboard', 'UserController@index')->name('dashboard');
	    Route::get('home', 'UserController@index');


		Route::get('users', 'UserController@getAllUsers')->name('users');
		Route::get('user', 'UserController@getUser');
		Route::get('filter', 'UserController@filter');
		Route::get('search', 'UserController@search');
		Route::get('verifyrights', 'UserController@verifyrights');


		Route::get('agent/ranks', 'UserController@agentRanks');
		Route::get('agent/rank', 'UserController@getAgentRank');
		Route::post('agent/rank/update', 'UserController@updateAgentRank');
		Route::get('agents/fullname', 'UserController@getAllAgentsFullname');
		Route::get('agent/search', 'UserController@searchAgent');
		Route::get('developer/search', 'UserController@searchDeveloper');
		Route::get('project/search', 'UserController@searchProject');
		Route::get('developer/getDeveloperById', 'UserController@getDeveloperById');
		Route::get('project/getProjectById', 'UserController@getProjectById');


		Route::post('users/info', 'UserController@updateUserInformation');
		Route::post('user/account', 'UserController@updateUserAccount');
		Route::post('user/changepassword', 'UserController@changePassword');
		Route::post('user/changeprofilepicture', 'UserController@changeprofilepicture');
		Route::post('users/import', 'ExcelController@importUserExcel');




		Route::post('users/export/all', 'ExcelController@exportAllUsersToExcel');
		Route::post('users/export/all/active', 'ExcelController@exportAllActiveUsersToExcel');
		Route::post('users/export/all/notactive', 'ExcelController@exportAllNotActiveUsersToExcel');

		Route::post('users/export/agents', 'ExcelController@exportAllAgentsToExcel');
		Route::post('users/export/agents/active', 'ExcelController@exportAllActiveAgentsToExcel');
		Route::post('users/export/agents/notactive', 'ExcelController@exportAllNotActiveAgentsToExcel');

		Route::post('users/export/staffs', 'ExcelController@exportAllStaffsToExcel');
		Route::post('users/export/staffs/active', 'ExcelController@exportAllActiveStaffsToExcel');
		Route::post('users/export/staffs/notactive', 'ExcelController@exportAllNotActiveStaffsToExcel');


		Route::post('users/setToNotActive', 'UserController@setToNotActive');
		Route::post('users/setToActive', 'UserController@setToActive');
		Route::get('profile/admin', 'UserController@profile')->name('profile');
		Route::get('user/profile', 'UserController@userProfile');



		Route::get('developers/projects', 'ProjectController@projects');
		Route::get('developers/projects/add', 'ProjectController@showProjectForm');
		Route::post('developers/projects/add', 'ProjectController@addProject');
		Route::post('developer/project/SetToNotActive', 'ProjectController@SetToNotActive');
		Route::post('developer/project/SetToActive', 'ProjectController@SetToActive');
		Route::get('developer/project', 'ProjectController@viewProject');
		Route::post('developer/project', 'ProjectController@viewProject');
		Route::get('developer/project/update', 'ProjectController@showUpdateProjectForm');
		Route::post('developer/project/update', 'ProjectController@updateProject');
		Route::get('developers/projects/search', 'ProjectController@searchProject');
		Route::get('developers/project/types', 'ProjectController@projectTypes');
		Route::post('developers/projects/types/add', 'ProjectController@addProjectType');
		Route::post('developers/projects/type/update', 'ProjectController@updateProjectType');
		Route::post('developers/projects/type/delete', 'ProjectController@deleteProjectType');
		Route::post('developers/projects/type/undelete', 'ProjectController@undeleteProjectType');


		Route::get('developers', 'DeveloperController@developers');
		Route::post('developers', 'DeveloperController@addDevelopers');
		Route::get('developer', 'DeveloperController@getDeveloper');
		Route::get('developer/profile', 'DeveloperController@developerProfile');
		Route::post('developer/update', 'DeveloperController@updateDeveloper');
		Route::post('developer/SetToNotActive', 'DeveloperController@SetToNotActiveDeveloper');
		Route::post('developer/SetToActive', 'DeveloperController@SetToActiveDeveloper');


		Route::get('events', 'EventController@events');
		Route::get('event', 'EventController@getEvent');
		Route::post('events/add', 'EventController@addEvent');
		Route::post('event/update', 'EventController@updateEvent');
		Route::post('event/cancel', 'EventController@cancelEvent');
		Route::post('event/resume', 'EventController@resumeEvent');
		Route::get('events/fetch', 'EventController@refetchEventsToCalendar');


		Route::get('sales', 'SalesController@sales');
		Route::get('sales/add', 'SalesController@addSalesForm');
		Route::post('sales/add', 'SalesController@addSales');
		Route::get('sales/update', 'SalesController@updateSalesForm');
		Route::post('sales/update', 'SalesController@updateSales');
		Route::post('sales/cancel', 'SalesController@cancelSales');
		Route::post('sales/uncancel', 'SalesController@uncancelSales');
		Route::get('sales/details', 'SalesController@viewSales');
		Route::get('sales/approved', 'SalesController@approvedSales');
		Route::get('sales/pending', 'SalesController@pendingSales');
		Route::get('sales/cancelled', 'SalesController@cancelledSales');
		Route::post('sales/approve', 'SalesController@approveSales');


		Route::get('clients', 'ClientController@clients');
		Route::get('client', 'ClientController@getClient');
		Route::post('client/update', 'ClientController@updateClient');


		Route::get('/', 'UserController@index');

});


Route::group([ 'middleware' => ['isAgent'] ] , function (){ 

	Route::get('/home', 'AgentController@index');
	Route::get('/profile', 'AgentController@profile');
	Route::get('/{id}/profile', 'AgentController@downlineProfile');
	Route::get('/projects', 'AgentController@projects');
	Route::get('/projects/{id}/details', 'AgentController@project');

});
*/
