@extends('frontend.users.dashboard_template')

@section('content')
    <div class="row">
        <div class="col-md-12">
           <div class="info-header border-bottom padding-bottom font-blue">
                <div class="col-md-10 headder-title nopadding">
                    <div class="col-md-1"><i class="fa fa-file-text-o" aria-hidden="true"></i></div> <div class="col-md-11">PERSONAL INFO</div>
                </div>
                <div class="col-md-2 headder-edit text-r nopadding font-size-detail">{{-- <a href="#">Edit</a> --}}</div>
                <div class="clear"></div>
           </div>
           <div class="info-detail padding-bottom font-size-detail">

               <div class="sub-info padding-bottom  padding-top">
                   <div class="col-md-1  nopadding"></div>
                   <div class="col-md-11 nopadding">
                       <div class="col-md-4">Expect Country</div>
                       <div class="col-md-8">
                           {{ !empty($user->getHspAppInfo['country_to_apply_1']) ? '1.'.$user->getHspAppInfo['country_to_apply_1'] : '' }}
                           {{ !empty($user->getHspAppInfo['country_to_apply_2']) ? ', 2.'.$user->getHspAppInfo['country_to_apply_2'] : '' }}
                       </div>
                   </div>
               </div>
               <div class="sub-info padding-bottom  padding-top">
                   <div class="col-md-1  nopadding"></div>
                   <div class="col-md-11 nopadding">
                       <div class="col-md-4">Name</div>
                       <div class="col-md-8">{{ empty(trim($user->getUserPersonalInfo['firstname'].' '.$user->getUserPersonalInfo['lastname']))
                       ? "-" : $user->getUserPersonalInfo['firstname'].' '.$user->getUserPersonalInfo['lastname']}}</div>
                   </div>
               </div>
               <div class="sub-info padding-bottom  padding-top">
                   <div class="col-md-1  nopadding"></div>
                   <div class="col-md-11 nopadding">
                       <div class="col-md-4">Nick Name</div>
                       <div class="col-md-8">{{empty($user->getUserPersonalInfo['nickname']) ? "-" : $user->getUserPersonalInfo['nickname']}}</div>
                   </div>
               </div>
               <div class="sub-info padding-bottom  padding-top">
                    <div class="col-md-1  nopadding"></div>
                    <div class="col-md-11 nopadding">
                        <div class="col-md-4">National ID</div>
                        <div class="col-md-8">{{Auth::user()->username}}</div>
                    </div>
               </div>
               <div class="sub-info padding-bottom padding-top">
                    <div class="col-md-1  nopadding"></div>
                    <div class="col-md-11 nopadding">
                        <div class="col-md-4">Birthday</div>
                        <div class="col-md-8">{{ empty($user->getUserPersonalInfo['date_of_birth']) ? "-" : $user->getUserPersonalInfo['date_of_birth'] }}</div>
                    </div>
               </div>
               <div class="sub-info padding-bottom padding-top">
                   <div class="col-md-1  nopadding"></div>
                   <div class="col-md-11 nopadding">
                       <div class="col-md-4">Nationality</div>
                       <div class="col-md-8">{{ empty($user->getUserPersonalInfo['nationality']) ? "-" : $user->getUserPersonalInfo['nationality'] }}</div>
                   </div>
               </div>
               <div class="sub-info padding-bottom padding-top">
                   <div class="col-md-1  nopadding"></div>
                   <div class="col-md-11 nopadding">
                       <div class="col-md-4">Phone</div>
                       <div class="col-md-8">{{ empty($user->getUserPersonalInfo['phone']) ? "-" : $user->getUserPersonalInfo['phone'] }}</div>
                   </div>
               </div>
               <div class="sub-info padding-bottom padding-top">
                   <div class="col-md-1  nopadding"></div>
                   <div class="col-md-11 nopadding">
                       <div class="col-md-4">Email</div>
                       <div class="col-md-8">{{ empty($user->getUserPersonalInfo['email']) ? "-" : $user->getUserPersonalInfo['email'] }}</div>
                   </div>
               </div>
               <div class="sub-info padding-bottom padding-top">
                   <div class="col-md-1  nopadding"></div>
                   <div class="col-md-11 nopadding">
                       <div class="col-md-4">Line ID</div>
                       <div class="col-md-8">{{ empty($user->getUserPersonalInfo['line_id']) ? "-" : $user->getUserPersonalInfo['line_id'] }}</div>
                   </div>
               </div>
               <div class="sub-info padding-bottom padding-top">
                   <div class="col-md-1  nopadding"></div>
                   <div class="col-md-11 nopadding">
                       <div class="col-md-4">Medical Problems</div>
                       <div class="col-md-8">{{ empty($user->getUserPersonalInfo['personal_sickness']) ? "No" : $user->getUserPersonalInfo['personal_sickness'] }}</div>
                   </div>
               </div>
               <div class="sub-info padding-bottom padding-top">
                   <div class="col-md-1  nopadding"></div>
                   <div class="col-md-11 nopadding">
                       <div class="col-md-4">เคยได้รับวีซ่านักเรียนประเทศสหรัฐอเมริกา ( J-1 หรือ F-1 )</div>
                       <div class="col-md-8">{{ $user->getUserPersonalInfo['has_american_visa'] ? "Yes" : "No" }}</div>
                   </div>
               </div>

           </div>
           <div class="clear"></div>
        </div>

        <div class="col-md-12">
           <div class="info-header border-bottom padding-bottom padding-top font-blue">
                <div class="col-md-10 headder-title nopadding">
                    <div class="col-md-1"><i class="fa fa-graduation-cap" aria-hidden="true"></i></div> <div class="col-md-11">EDUCATION INFO</div>
                </div>
                <div class="col-md-2 headder-edit text-r nopadding font-size-detail">{{-- <a href="#">Edit</a> --}}</div>
                <div class="clear"></div>
           </div>
           <div class="info-detail font-size-detail">

               <div class="sub-info padding-bottom  padding-top">
                   <div class="col-md-1  nopadding"></div>
                   <div class="col-md-11 nopadding">
                       <div class="col-md-4">High School Level</div>
                       <div class="col-md-8">{{ empty($user->getEducationInfo['high_school_level']) ? "-" : $user->getEducationInfo['high_school_level'] }}</div>
                   </div>
               </div>
               <div class="sub-info padding-bottom  padding-top">
                   <div class="col-md-1  nopadding"></div>
                   <div class="col-md-11 nopadding">
                       <div class="col-md-4">Study Program</div>
                       <div class="col-md-8">{{ empty($user->getEducationInfo['study_program']) ? "-" : $user->getEducationInfo['study_program'] }}</div>
                   </div>
               </div>
               <div class="sub-info padding-bottom  padding-top">
                    <div class="col-md-1  nopadding"></div>
                    <div class="col-md-11 nopadding">
                        <div class="col-md-4">School Name</div>
                        <div class="col-md-8">{{ empty($user->getEducationInfo['school_name']) ? "-" : $user->getEducationInfo['school_name'] }}</div>
                    </div>
               </div>
               <div class="sub-info padding-bottom  padding-top">
                   <div class="col-md-1  nopadding"></div>
                   <div class="col-md-11 nopadding">
                       <div class="col-md-4">Province</div>
                       <div class="col-md-8">{{ empty($user->getEducationInfo['province']) ? "-" : $user->getEducationInfo['province'] }}</div>
                   </div>
               </div>
               <div class="sub-info padding-bottom padding-top">
                    <div class="col-md-1  nopadding"></div>
                    <div class="col-md-11 nopadding">
                        <div class="col-md-4">GPA</div>
                        <div class="col-md-8">{{ empty($user->getEducationInfo['gpa']) ? "-" : $user->getEducationInfo['gpa'] }}</div>
                    </div>
               </div>
               
           </div>
        <div class="clear"></div>
        </div>

        <div class="col-md-12">
           <div class="info-header border-bottom padding-bottom padding-top font-blue">
                <div class="col-md-10 headder-title nopadding">
                    <div class="col-md-1"><i class="fa fa-envelope-o" aria-hidden="true"></i></div> <div class="col-md-11">CONTACT INFO</div>
                </div>
                <div class="col-md-2 headder-edit text-r nopadding font-size-detail">{{-- <a href="#">Edit</a> --}}</div>
                <div class="clear"></div>
           </div>
           <div class="info-detail font-size-detail">

               <div class="sub-info padding-bottom  padding-top">
                   <div class="col-md-1  nopadding"></div>
                   <div class="col-md-11 nopadding">
                       <div class="col-md-4">Relationship</div>
                       <div class="col-md-8">{{ empty($user->getContactInfo['emergency_contact_relationship']) ? "-" : $user->getContactInfo['emergency_contact_relationship'] }}</div>
                   </div>
               </div>
               <div class="sub-info padding-bottom  padding-top">
                   <div class="col-md-1  nopadding"></div>
                   <div class="col-md-11 nopadding">
                       <div class="col-md-4">Emergency Contact</div>
                       <div class="col-md-8">{{ empty(trim($user->getContactInfo['emergency_contact_name'].' '.$user->getContactInfo['emergency_contact_surname']))
                                ? "-" : $user->getContactInfo['emergency_contact_name'].' '.$user->getContactInfo['emergency_contact_surname']}}</div>
                   </div>
               </div>
               <div class="sub-info padding-bottom  padding-top">
                    <div class="col-md-1  nopadding"></div>
                    <div class="col-md-11 nopadding">
                        <div class="col-md-4">Phone Number</div>
                        <div class="col-md-8">{{ empty($user->getContactInfo['emergency_phone']) ? "-" : $user->getContactInfo['emergency_phone'] }}</div>
                    </div>
               </div>
               <div class="sub-info padding-bottom padding-top">
                    <div class="col-md-1  nopadding"></div>
                    <div class="col-md-11 nopadding">
                        <div class="col-md-4">Email</div>
                        <div class="col-md-8">{{ empty($user->getContactInfo['emergency_email']) ? "-" : $user->getContactInfo['emergency_email'] }}</div>
                    </div>
               </div>
               
           </div>
           <div class="clear"></div>
        </div>

        <div class="col-md-12">
            <div class="info-header border-bottom padding-bottom padding-top font-blue">
                <div class="col-md-10 headder-title nopadding">
                    <div class="col-md-1"><i class="fa fa-ellipsis-h" aria-hidden="true"></i></div> <div class="col-md-11">OTHER</div>
                </div>
                <div class="col-md-2 headder-edit text-r nopadding font-size-detail">{{-- <a href="#">Edit</a> --}}</div>
                <div class="clear"></div>
            </div>
            <div class="info-detail font-size-detail">

                <div class="sub-info padding-bottom  padding-top">
                    <div class="col-md-1  nopadding"></div>
                    <div class="col-md-11 nopadding">
                        <div class="col-md-4">Teacher Name</div>
                        <div class="col-md-8">{{ empty($user->getOtherInfo['teacher_name']) ? "-" : $user->getOtherInfo['teacher_name'] }}</div>
                    </div>
                </div>
                <div class="sub-info padding-bottom  padding-top">
                    <div class="col-md-1  nopadding"></div>
                    <div class="col-md-11 nopadding">
                        <div class="col-md-4">Promotion Code</div>
                        <div class="col-md-8">{{ empty($user->getOtherInfo['promotion_code']) ? "-" : $user->getOtherInfo['promotion_code'] }}</div>
                    </div>
                </div>

                <div class="sub-info padding-bottom  padding-top">
                    <div class="col-md-1  nopadding"></div>
                    <div class="col-md-11 nopadding">
                        <div class="col-md-4">Source of Apply</div>
                        <div class="col-md-8">{{ $user_source_of_apply }}</div>
                    </div>
                </div>

            </div>
            <div class="clear"></div>
        </div>

        {{-- <div class="col-md-12">
           <div class="info-header border-bottom padding-bottom padding-top font-blue">
                <div class="col-md-10 headder-title nopadding">
                    <div class="col-md-1"><i class="fa fa-key" aria-hidden="true"></i></div> <div class="col-md-11">CHANGE PASSWORD</div>
                </div>
                <div class="clear"></div>
           </div>
           <div class="clear"></div>
        </div> --}}

        <div class="clear"></div>
    </div>
    <div class="clear"></div>
@endsection