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


Route::group(['namespace' => 'Frontend'], function () {

    Route::get('/', [
        'as'  => 'frontend.home',
        'uses' => 'UserController@getLoginPage'
    ]);

    Route::get('/login', [
        'as'  => 'frontend.user.login.get',
        'uses' => 'UserController@getLoginPage'
    ]);

    Route::post('/login', [
        'as'  => 'frontend.user.login.post',
        'uses' => 'UserController@postLogin'
    ]);

    Route::get('/logout', [
        'as'  => 'frontend.user.logout.get',
        'uses' => 'UserController@getLogout'
    ]);

    /*
     * Route For Guest Only
     */

    Route::group(['middleware' => 'guest'], function () {

        Route::get('/signup/staff-only', [
            'as'  => 'frontend.user.signup.get',
            'uses' => 'UserController@getSignUpPage'
        ]);

        Route::post('/signup/staff-only', [
            'as'  => 'frontend.user.signup.post',
            'uses' => 'UserController@postSignUp'
        ]);

        Route::get('/forget_password', [
            'as'  => 'frontend.user.forget-password.get',
            'uses' => 'UserController@getForgetPasswordPage'
        ]);

        Route::post('/forget_password', [
            'as'  => 'frontend.user.forget-password.post',
            'uses' => 'UserController@postForgetPassword'
        ]);

        Route::get('/reset_password', [
            'as'  => 'frontend.user.reset-password.get',
            'uses' => 'UserController@getResetPasswordPage'
        ]);

        Route::post('/reset_password', [
            'as'  => 'frontend.user.reset-password.post',
            'uses' => 'UserController@postResetPassword'
        ]);

    });

    Route::get('/thankyou', [
        'as'  => 'frontend.user.signup-thakyou.get',
        'uses' => 'UserController@getThankyou'
    ]);

    /*
     * Frontend Auth Only
     */
    Route::group(['middleware' => 'auth.frontend'], function () {

        /*
         * Dashboard
         */

        Route::group(['prefix' => 'dashboard'], function () {

            Route::get('/', [
                'as' => 'frontend.dashboard',
                'uses' => 'DashboardController@index'
            ]);

            Route::group(['middleware' => 'auth.student'], function () {

                //personal info
                Route::get('/info', [
                    'as' => 'frontend.dashboard.info',
                    'uses' => 'DashboardController@getInfoPage'
                ]);

                //upload
                Route::get('/upload', [
                    'as' => 'frontend.dashboard.upload',
                    'uses' => 'DashboardController@getUploadPage'
                ]);
                Route::post('/upload', [
                    'as' => 'frontend.dashboard.upload.post',
                    'uses' => 'DashboardController@uploadPDF'
                ]);

                //payment
                Route::get('/payment', [
                    'as' => 'frontend.dashboard.payment',
                    'uses' => 'DashboardController@getPaymentPage'
                ]);

                //book hsp location
                Route::get('/hsp_school_admission_test', [
                    'as' => 'frontend.dashboard.hsp-school-admission-test.get',
                    'uses' => 'DashboardController@getHspAdmissionTestPage'
                ]);
                Route::get('/hsp_school_admission_test_detail', [
                    'as' => 'frontend.dashboard.hsp-school-admission-test-detail.get',
                    'uses' => 'DashboardController@getHspAdmissionTestDetailPage'
                ]);
                Route::post('/hsp_school_admission_test_book', [
                    'as' => 'frontend.dashboard.hsp-school-admission-test-book.post',
                    'uses' => 'DashboardController@bookHspAdmissionTest'
                ]);

                //parent information
                Route::get('/parent_information_meeting', [
                    'as' => 'frontend.dashboard.parent-information-meeting.get',
                    'uses' => 'DashboardController@getParentInformationMeetingPage'
                ]);
                Route::get('/parent_information_meeting_detail', [
                    'as' => 'frontend.dashboard.parent-information-meeting-detail.get',
                    'uses' => 'DashboardController@getParentInformationMeetingDetailPage'
                ]);
                Route::post('/parent_information_meeting_book', [
                    'as' => 'frontend.dashboard.parent-information-meeting-book.post',
                    'uses' => 'DashboardController@bookParentInformationMeeting'
                ]);

                //excite camp
                Route::get('/excite_camp', [
                    'as' => 'frontend.dashboard.excite-camp.get',
                    'uses' => 'DashboardController@getExciteCampPage'
                ]);
                Route::get('/excite_camp_detail', [
                    'as' => 'frontend.dashboard.excite-camp-detail.get',
                    'uses' => 'DashboardController@getExciteCampDetailPage'
                ]);
                Route::post('/excite_camp_book', [
                    'as' => 'frontend.dashboard.excite-camp-book.post',
                    'uses' => 'DashboardController@bookExciteCamp'
                ]);

                //student info
                Route::get('/student_info', [
                    'as' => 'frontend.dashboard.student-info.get',
                    'uses' => 'DashboardController@getStudentInfoPage'
                ]);
                Route::get('/student_info_detail', [
                    'as' => 'frontend.dashboard.student-info-detail.get',
                    'uses' => 'DashboardController@getStudentInfoDetailPage'
                ]);
                Route::post('/student_info_save', [
                    'as' => 'frontend.dashboard.student-info.post',
                    'uses' => 'DashboardController@saveStudentInfo'
                ]);

            });

        });

        Route::group(['middleware' => 'auth.student'], function () {

            Route::get('/apply_application', [
                'as'   => 'frontend.dashboard.apply_application',
                'uses' => 'DashboardController@getApplyApplicationPage'
            ]);

            Route::post('/apply_application',[
                'as'    => 'frontend.dashboard.apply_application.post',
                'uses'  => 'ApplicationController@postApplyApplication'
            ]);

        });

    });
});

/*
 * Backoffice Controller
 */
Route::group(['prefix' => 'backoffice', 'namespace' => 'Backoffice'], function (){

    /*
     * Backoffice Login
     */
    Route::group(['prefix' => 'login'], function () {

        Route::get('/', [
            'as'  => 'backoffice.login.get',
            'uses' => 'LoginController@getLogin'
        ]);

        Route::post('/', [
            'as'  => 'backoffice.login.post',
            'uses' => 'LoginController@postLogin'
        ]);
    });


    Route::group(['middleware' => 'auth.backoffice'], function () {

        /*
         * Logout
         */
        Route::get('/logout', [
            'as'  => 'backoffice.logout.get',
            'uses' => 'LoginController@getLogout'
        ]);

        /*
         * Dashboard
         */
        Route::get('/dashboard', [
            'as'  => 'backoffice.dashboard.get',
            'uses' => 'LoginController@getDashboard'
        ]);

        /*
         * User Account
         */
        Route::group(['prefix' => 'user'], function () {
            Route::get('/', [
                'as'  => 'backoffice.user.list.get',
                'uses' => 'UserController@getUserList'
            ]);

            Route::get('/change-password/{id}', [
                'as'  => 'backoffice.user.change-password.get',
                'uses' => 'UserController@getChangePassword'
            ]);

            Route::post('/change-password/{id}', [
                'as'  => 'backoffice.user.change-password.post',
                'uses' => 'UserController@postChangePassword'
            ]);
        });

        /*
         * High School Exchange
         */
        Route::group(['prefix' => 'hsp', 'namespace' => 'HSP'], function () {

            /*
             * Year
             */
            Route::group(['prefix' => 'year'], function () {
                Route::get('/', [
                    'as'  => 'backoffice.hsp.year.get',
                    'uses' => 'YearController@getYearList'
                ]);

                Route::get('/create', [
                    'as'  => 'backoffice.hsp.year.create.get',
                    'uses' => 'YearController@getCreateYear'
                ]);

                Route::post('/create', [
                    'as'  => 'backoffice.hsp.year.create.post',
                    'uses' => 'YearController@postCreateYear'
                ]);

                Route::get('/edit/{id}', [
                    'as'  => 'backoffice.hsp.year.edit.get',
                    'uses' => 'YearController@getEditYear'
                ]);

                Route::post('/edit/{id}', [
                    'as'  => 'backoffice.hsp.year.edit.post',
                    'uses' => 'YearController@postEditYear'
                ]);

                Route::get('/delete/{id}', [
                    'as'  => 'backoffice.hsp.year.delete.get',
                    'uses' => 'YearController@getDeleteYear'
                ]);
            });

            /*
             * Admission Test
             */
            Route::group(['prefix' => 'admission-test'], function () {

                /*
                 * Location
                 */
                Route::group(['prefix' => 'location'], function () {
                    Route::get('/', [
                        'as'  => 'backoffice.hsp.admission-test.get',
                        'uses' => 'AdmissionTestController@getAdmissionTestList'
                    ]);

                    Route::get('/create', [
                        'as'  => 'backoffice.hsp.admission-test.create.get',
                        'uses' => 'AdmissionTestController@getCreateAdmissionTest'
                    ]);

                    Route::post('/create', [
                        'as'  => 'backoffice.hsp.admission-test.create.post',
                        'uses' => 'AdmissionTestController@postCreateAdmissionTest'
                    ]);

                    Route::get('/edit/{id}', [
                        'as'  => 'backoffice.hsp.admission-test.edit.get',
                        'uses' => 'AdmissionTestController@getEditAdmissionTest'
                    ]);

                    Route::post('/edit/{id}', [
                        'as'  => 'backoffice.hsp.admission-test.edit.post',
                        'uses' => 'AdmissionTestController@postEditAdmissionTest'
                    ]);

                    Route::get('/delete/{id}', [
                        'as' => 'backoffice.hsp.admission-test.delete.get',
                        'uses'  => 'AdmissionTestController@getDeleteAdmissionTest'
                    ]);

                    Route::get('/export/excel/{id}', [
                        'as'  => 'backoffice.hsp.admission-test-export-excel.get',
                        'uses' => 'AdmissionTestController@getExportAdmissionTestExcel'
                    ]);
                });

                /*
                 * Test Result
                 */
                Route::group(['prefix' => 'test-result'], function () {
                    Route::get('/import', [
                        'as'  => 'backoffice.hsp.admission-test.result.import.get',
                        'uses' => 'AdmissionTestController@getImportAdmissionTestResult'
                    ]);

                    Route::post('/import', [
                        'as'  => 'backoffice.hsp.admission-test.result.import.post',
                        'uses' => 'AdmissionTestController@postImportAdmissionTestResult'
                    ]);
                });
            });

            /*
             * Student
             */
            Route::group(['prefix' => 'student'], function () {
                Route::get('/', [
                    'as'  => 'backoffice.hsp.student.get',
                    'uses' => 'StudentController@getStudentList'
                ]);

                Route::get('/profile/{id}', [
                    'as'  => 'backoffice.hsp.student-profile.get',
                    'uses' => 'StudentController@getStudentProfile'
                ]);

                Route::get('/profile/{id}/upload/{documentType}', [
                    'as'  => 'backoffice.hsp.student-upload-document.get',
                    'uses' => 'StudentController@getUploadDocument'
                ]);

                Route::post('/profile/{id}/upload/{documentType}', [
                    'as'  => 'backoffice.hsp.student-upload-document.post',
                    'uses' => 'StudentController@postUploadDocument'
                ]);
                
                Route::get('/export/excel', [
                    'as'  => 'backoffice.hsp.student-export-excel.get',
                    'uses' => 'StudentController@getExportStudentExcel'
                ]);

                Route::get('/edit/{id}', [
                    'as'  => 'backoffice.hsp.student.edit.get',
                    'uses' => 'StudentController@getEditStudentProfile'
                ]);

                Route::post('/edit/{id}/personal', [
                    'as'  => 'backoffice.hsp.student.edit-personal.post',
                    'uses' => 'StudentController@postEditPersonal'
                ]);

                Route::post('/edit/{id}/education', [
                    'as'  => 'backoffice.hsp.student.edit-education.post',
                    'uses' => 'StudentController@postEditEducation'
                ]);

                Route::post('/edit/{id}/contact', [
                    'as'  => 'backoffice.hsp.student.edit-contact.post',
                    'uses' => 'StudentController@postEditContact'
                ]);

                Route::post('/edit/{id}/applicant', [
                    'as'  => 'backoffice.hsp.student.edit-applicant.post',
                    'uses' => 'StudentController@postEditApplicant'
                ]);

                Route::post('/edit/{id}/admission-test', [
                    'as'  => 'backoffice.hsp.student.edit-admission-test.post',
                    'uses' => 'StudentController@postEditAdmissionTest'
                ]);

                Route::post('/edit/{id}/pim', [
                    'as'  => 'backoffice.hsp.student.edit-pim.post',
                    'uses' => 'StudentController@postEditPIM'
                ]);

                Route::post('/edit/{id}/excite-camp', [
                    'as'  => 'backoffice.hsp.student.edit-excite-camp.post',
                    'uses' => 'StudentController@postEditExCITECamp'
                ]);

                Route::post('/edit/{id}/student-info', [
                    'as'  => 'backoffice.hsp.student.edit-student.post',
                    'uses' => 'StudentController@postEditStudentInfo'
                ]);

                Route::get('/delete/{id}', [
                    'as' => 'backoffice.hsp.student.delete.get',
                    'uses'  => 'StudentController@getDeleteStudentProfile'
                ]);
            });

            /*
             * Parent Information Meeting
             */
            Route::group(['prefix' => 'parent-information'], function () {

                /*
                 * Location
                 */
                Route::group(['prefix' => 'location'], function () {
                    Route::get('/', [
                        'as'  => 'backoffice.hsp.pim.location.list.get',
                        'uses' => 'ParentInformationController@getParentInformationLocationList'
                    ]);

                    Route::get('/create', [
                        'as'  => 'backoffice.hsp.pim.location.create.get',
                        'uses' => 'ParentInformationController@getCreateParentInformationLocation'
                    ]);

                    Route::post('/create', [
                        'as'  => 'backoffice.hsp.pim.location.create.post',
                        'uses' => 'ParentInformationController@postCreateParentInformationLocation'
                    ]);

                    Route::get('/edit/{id}', [
                        'as'  => 'backoffice.hsp.pim.location.edit.get',
                        'uses' => 'ParentInformationController@getEditParentInformationLocation'
                    ]);

                    Route::post('/edit/{id}', [
                        'as'  => 'backoffice.hsp.pim.location.edit.post',
                        'uses' => 'ParentInformationController@postEditParentInformationLocation'
                    ]);

                    Route::get('/delete/{id}', [
                        'as' => 'backoffice.hsp.pim.location.delete.get',
                        'uses'  => 'ParentInformationController@getDeleteParentInformationLocation'
                    ]);

                    Route::get('/export/excel/{id}', [
                        'as'  => 'backoffice.hsp.pim-export-excel.get',
                        'uses' => 'ParentInformationController@getExportParentInformationLocationExcel'
                    ]);
                });

                /*
                 * Test Result
                */
                Route::group(['prefix' => 'test-result'], function () {
                    Route::get('/import', [
                        'as'  => 'backoffice.hsp.pim.result.import.get',
                        'uses' => 'ParentInformationController@getImportParentInformationLocationResult'
                    ]);

                    Route::post('/import', [
                        'as'  => 'backoffice.hsp.pim.result.import.post',
                        'uses' => 'ParentInformationController@postImportParentInformationLocationResult'
                    ]);
                });
            });

            /*
             * ExCITE Camp
             */
            Route::group(['prefix' => 'excite-camp'], function () {

                /*
                 * Location
                 */
                Route::group(['prefix' => 'location'], function () {
                    Route::get('/', [
                        'as'  => 'backoffice.hsp.excite-camp.location.list.get',
                        'uses' => 'ExCITECampController@getExCITECampLocationList'
                    ]);

                    Route::get('/create', [
                        'as'  => 'backoffice.hsp.excite-camp.location.create.get',
                        'uses' => 'ExCITECampController@getCreateExCITECampLocation'
                    ]);

                    Route::post('/create', [
                        'as'  => 'backoffice.hsp.excite-camp.location.create.post',
                        'uses' => 'ExCITECampController@postCreateExCITECampLocation'
                    ]);

                    Route::get('/edit/{id}', [
                        'as'  => 'backoffice.hsp.excite-camp.location.edit.get',
                        'uses' => 'ExCITECampController@getEditExCITECampLocation'
                    ]);

                    Route::post('/edit/{id}', [
                        'as'  => 'backoffice.hsp.excite-camp.location.edit.post',
                        'uses' => 'ExCITECampController@postEditExCITECampLocation'
                    ]);

                    Route::get('/delete/{id}', [
                        'as' => 'backoffice.hsp.excite-camp.location.delete.get',
                        'uses'  => 'ExCITECampController@getDeleteExCITECampLocation'
                    ]);

                    Route::get('/export/excel/{id}', [
                        'as'  => 'backoffice.hsp.excite-camp-export-excel.get',
                        'uses' => 'ExCITECampController@getExportExCITECampLocationExcel'
                    ]);
                });

                /*
                * Test Result
                */
                Route::group(['prefix' => 'test-result'], function () {
                    Route::get('/import', [
                        'as'  => 'backoffice.hsp.excite-camp.result.import.get',
                        'uses' => 'ExCITECampController@getImportExCITECampLocationResult'
                    ]);

                    Route::post('/import', [
                        'as'  => 'backoffice.hsp.excite-camp.result.import.post',
                        'uses' => 'ExCITECampController@postImportExCITECampLocationResult'
                    ]);
                });
            });

            /*
             * Promotion
             */
            Route::group(['prefix' => 'promotion'], function () {
                Route::get('/', [
                    'as'  => 'backoffice.hsp.promotion.get',
                    'uses' => 'PromotionController@getPromotionList'
                ]);

                Route::get('/create', [
                    'as'  => 'backoffice.hsp.promotion.create.get',
                    'uses' => 'PromotionController@getCreatePromotion'
                ]);

                Route::post('/create', [
                    'as'  => 'backoffice.hsp.promotion.create.post',
                    'uses' => 'PromotionController@postCreatePromotion'
                ]);

                Route::get('/edit/{id}', [
                    'as'  => 'backoffice.hsp.promotion.edit.get',
                    'uses' => 'PromotionController@getEditPromotion'
                ]);

                Route::post('/edit/{id}', [
                    'as'  => 'backoffice.hsp.promotion.edit.post',
                    'uses' => 'PromotionController@postEditPromotion'
                ]);

                Route::get('/delete/{id}', [
                    'as'  => 'backoffice.hsp.promotion.delete.get',
                    'uses' => 'PromotionController@getDeletePromotion'
                ]);
            });

            /*
            * Country Document
            */
            Route::group(['prefix' => 'country-document'], function () {

                /*
                 * Location
                 */
                Route::group(['prefix' => 'location'], function () {
                    Route::get('/', [
                        'as'  => 'backoffice.hsp.country-document.location.list.get',
                        'uses' => 'CountryDocumentController@getCountryDocumentList'
                    ]);

                    Route::get('/edit/{id}', [
                        'as'  => 'backoffice.hsp.country-document.location.edit.get',
                        'uses' => 'CountryDocumentController@getEditCountryDocument'
                    ]);

                    Route::post('/edit/{id}', [
                        'as'  => 'backoffice.hsp.country-document.location.edit.post',
                        'uses' => 'CountryDocumentController@postEditCountryDocument'
                    ]);
                });
            });
        });
    });
});
