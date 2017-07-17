<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\NavBarTemplate;

class NavBarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        NavBarTemplate::truncate();
        DB::table('nav_bar_template')->insert(
            [
                [
                    'order'	                => 2,
                    'show_in_state'	        => 1,
                    'label'                 => 'Personal Info (HSP Application)',
                    'route_name'            => 'frontend.dashboard.info',
                    'route_name_to_active'  => 'frontend.dashboard.info',
                ],
                [
                    'order'	                => 3,
                    'show_in_state'	        => 2,
                    'label'                 => 'High School Admission Test ',
                    'route_name'            => 'frontend.dashboard.hsp-school-admission-test.get',
                    'route_name_to_active'  => 'frontend.dashboard.hsp-school-admission-test.get,frontend.dashboard.hsp-school-admission-test-detail.get',
                ],
                [
                    'order'	                => 4,
                    'show_in_state'	        => 3,
                    'label'                 => 'Student Info',
                    'route_name'            => 'frontend.dashboard.student-info.get',
                    'route_name_to_active'  => 'frontend.dashboard.student-info.get,frontend.dashboard.student-info-detail.get',
                ],
                [
                    'order'	                => 5,
                    'show_in_state'	        => 4,
                    'label'                 => 'Parent Information Meeting',
                    'route_name'            => 'frontend.dashboard.parent-information-meeting.get',
                    'route_name_to_active'  => 'frontend.dashboard.parent-information-meeting.get,frontend.dashboard.parent-information-meeting-detail.get',
                ],
                [
                    'order'	                => 6,
                    'show_in_state'	        => 5,
                    'label'                 => 'ExCITE Camp',
                    'route_name'            => 'frontend.dashboard.excite-camp.get',
                    'route_name_to_active'  => 'frontend.dashboard.excite-camp.get,frontend.dashboard.excite-camp-detail.get',
                ],
                [
                    'order'	                => 15,
                    'show_in_state'	        => 1,
                    'label'                 => 'Payment',
                    'route_name'            => 'frontend.dashboard.payment',
                    'route_name_to_active'  => 'frontend.dashboard.payment',
                ],
                [
                    'order'	                => 16,
                    'show_in_state'	        => 1,
                    'label'                 => 'Upload',
                    'route_name'            => 'frontend.dashboard.upload',
                    'route_name_to_active'  => 'frontend.dashboard.upload',
                ],
            ]
        );
    }
}
