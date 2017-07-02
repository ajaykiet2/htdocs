<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
*/

#================================================================#
# Website routes start                                           #
$route['default_controller'] = 'website';						 #
$route['about'] = 'website';                                     #
$route['faq'] = 'website/faq';                                   #
$route['faq/(:num)'] = 'website/faq';                            #
$route['guidelines'] = 'website/guidelines';                            #
$route['courses'] = 'website/course';                            #
$route['courses/page'] = 'website/course';                       #
$route['courses/page/(:num)'] = 'website/course';                #
$route['gallery'] = 'website/gallery';                           #
$route['gallery/page'] = 'website/gallery';                      #
$route['gallery/(:num)'] = 'website/galleryDetail';              #
$route['gallery/page/(:num)'] = 'website/gallery';               #
$route['mocktest'] = 'website/mocktest';                         #
$route['accreditation'] = 'website/accreditationDetail';         #
$route['accreditation/(:num)'] = 'website/accreditationDetail';  #
$route['accreditations'] = 'website/accreditations';             #
$route['accreditations/(:num)'] = 'website/accreditations';      #
$route['contact'] = 'website/contact';                           #
#================================================================#

$route['login'] = 'login';
$route['login/forgot'] = 'login/forgotPassword';
$route['login/resetPassword'] = 'login/resetPassword';

#=======================================================================================#
# Admin routes start                                                                    #
$route['admin'] = 'admin/portal/company';                                               #
//--------------------------------------------------------------------------------------#
$route['admin/company'] = 'admin/portal/company';                                       #
$route['admin/company/detail/(:any)'] = 'admin/portal/companyDetail';                   #
$route['admin/ajax/populateCompanies'] = 'admin/ajax/populateCompanies';                #
$route['admin/ajax/companyAction'] = 'admin/ajax/companyAction';                        #
//--------------------------------------------------------------------------------------#
$route['admin/department'] = 'admin/portal/department';                                 #
$route['admin/ajax/populateDepartments'] = 'admin/ajax/populateDepartments';            #
$route['admin/ajax/departmentAction'] = 'admin/ajax/departmentAction';                  #
//--------------------------------------------------------------------------------------#
$route['admin/employee'] = 'admin/portal/employee';                                     #
$route['admin/employee/(:any)'] = 'admin/portal/employeeDetail';                        #
$route['admin/ajax/populateEmployees'] = 'admin/ajax/populateEmployees';                #
$route['admin/ajax/employeeAction'] = 'admin/ajax/employeeAction';                      #
//--------------------------------------------------------------------------------------#
$route['admin/courses'] = 'admin/portal/course';                                        #
$route['admin/courses/(:num)'] = 'admin/portal/course';                                 #
$route['admin/courses/detail/(:any)'] = 'admin/portal/courseDetail';                    #
$route['admin/ajax/courseAction'] = 'admin/ajax/courseAction';                          #
//--------------------------------------------------------------------------------------#
$route['admin/courses/(:any)/chepter/(:any)'] = 'admin/portal/chepterDetail';           #
$route['admin/ajax/slideAction'] = 'admin/ajax/slideAction';                            #
//--------------------------------------------------------------------------------------#
$route['admin/courses/(:any)/chepter/(:any)/slide/new'] = 'admin/portal/slide';         #
$route['admin/courses/(:any)/chepter/(:any)/slide/view/(:any)'] = 'admin/portal/slide'; #
$route['admin/courses/(:any)/chepter/(:any)/slide/edit/(:any)'] = 'admin/portal/slide'; #
//--------------------------------------------------------------------------------------#
$route['admin/configurations'] = 'admin/portal/configurations';                         #
$route['admin/configurations/gallery'] = 'admin/portal/configurations';                 #    
$route['admin/configurations/gallery/new'] = 'admin/portal/gallery';                    #    
$route['admin/configurations/gallery/edit/(:any)'] = 'admin/portal/gallery';            #        
$route['admin/configurations/faq'] = 'admin/portal/configurations/';                    #             
$route['admin/configurations/accreditation'] = 'admin/portal/configurations';	        #
$route['admin/configurations/mocktest'] = 'admin/portal/configurations';                #
$route['admin/configurations/guidelines'] = 'admin/portal/configurations';              #
                                                                                        #
$route['admin/assessment'] = 'admin/portal/assessment';                                 #
$route['admin/assessment/detail'] = 'admin/portal/assessmentDetail';                    #
$route['admin/ajax/assessmentAction'] = 'admin/ajax/assessmentAction'; 

$route['admin/ajax/guidelineAction'] = 'admin/ajax/guidelineAction';
$route['admin/ajax/galleryAction'] = 'admin/ajax/galleryAction';
$route['admin/configurations/guidelines/new'] = 'admin/portal/guideline';
$route['admin/configurations/guidelines/edit/(:any)'] = 'admin/portal/guideline';
$route['admin/configurations/guidelines/view/(:any)'] = 'admin/portal/guideline';
																						#
$route['admin/upload/chepterQuestion'] = 'admin/upload/chepterQuestion';                #
$route['admin/upload/assessmentQuestion'] = 'admin/upload/assessmentQuestion';          #
$route['admin/upload/image'] = 'admin/upload/uploadImage';                              #
                                                                                        #
                                                                                        #
                                                                                        #
                                                                                        #
$route['admin/reports'] = 'admin/portal/reports';                                       #		
$route['admin/reports/exportCandidate'] = 'admin/reporting/exportCandidate';    		#
$route['admin/ajax/populateReport'] = 'admin/ajax/populateReport';	                    #
// $route['admin/upload/image'] = 'admin/upload/slideImage';                            #
                                                                                        #
$route['admin/logout'] = 'login/logout';                                                #
#=======================================================================================#

#===================================================================================#
# Employee routes start                                  							#
$route['employee'] = 'employee/portal';                  							#
$route['employee/dashboard'] = 'employee/portal';        						    #			
$route['employee/glossary'] = 'employee/portal/glossary';							#
$route['employee/account'] = 'employee/portal/account';  							#

$route['employee/guidelines'] = 'employee/portal/guidelines';			  							#
$route['employee/faq'] = 'employee/portal/faq';			  							#
$route['employee/faq/(:num)'] = 'employee/portal/faq';								#

$route['employee/course/stop'] = 'employee/portal/stopCourse'; 	  					#
$route['employee/course/start'] = 'employee/portal/startCourse'; 	  				#
$route['employee/course/(:any)'] = 'employee/portal/courseDetail';					#

$route['employee/chepter/(:any)/(:any)'] = 'employee/portal/chepterDetail';			#

$route['employee/assessment/submit'] = 'employee/portal/submitAssessment';			#
$route['employee/assessment/(:any)'] = 'employee/portal/assessment';				#
$route['employee/assessment/start/(:any)'] = 'employee/portal/assessmentStart';		#
  					
																					#
																					#
$route['employee/logout'] = 'login/logout';              							#
#===================================================================================#

#
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
