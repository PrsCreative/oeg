@extends('frontend.users.dashboard_template')

@section('content')
    <div class="row">
        <p class="font-grey font-size-detail wordwrap-width-full">
            • เมื่อกรอกข้อมูลในหน้า Student Info เรียบร้อยแล้ว ให้สำรองที่นั่งเพื่อรับฟังข้อมูลโครงการฯ ในหน้า Parent Information Meeting (การบรรยายนี้ไม่มีค่าใช้จ่ายใด ๆ เพิ่มเติม)<br>
            • ต้องการข้อมูลเพิ่มเติม กรุณาติดต่อโออีจี สำนักงานใหญ่ กรุงเทพฯแผนก High School Exchange ที่ 02-2633666 กด 4 / โออีจี นำนักงานเชียงใหม่ 09 9242 2002ในเวลาทำการ<br>
        </p>
        <br>
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
                       <div class="col-md-4">Name</div>
                       <div class="col-md-8">
                         {{ empty(trim($studentProfile->getUserPersonalInfo['firstname'].' '.$studentProfile->getUserPersonalInfo['lastname']))
                       ? "-" : $studentProfile->getUserPersonalInfo['firstname'].' '.$studentProfile->getUserPersonalInfo['lastname']}}</div>
                   </div>
               </div>
               <div class="sub-info padding-bottom  padding-top">
                   <div class="col-md-1  nopadding"></div>
                   <div class="col-md-11 nopadding">
                       <div class="col-md-4">Nick Name</div>
                       <div class="col-md-8">{{empty($studentProfile->getUserPersonalInfo['nickname']) ? "-" : $studentProfile->getUserPersonalInfo['nickname']}}</div>
                   </div>
               </div>
               <div class="sub-info padding-bottom  padding-top">
                   <div class="col-md-1  nopadding"></div>
                   <div class="col-md-11 nopadding">
                       <div class="col-md-4">Name English</div>
                       <div class="col-md-8">
                           {{ ucfirst($studentProfile->getUserPersonalInfo['title']) }} {{ empty(trim($studentProfile->getUserPersonalInfo['firstname_en'].' '.$studentProfile->getUserPersonalInfo['lastname_en']))
                       ? "-" : $studentProfile->getUserPersonalInfo['firstname_en'].' '.$studentProfile->getUserPersonalInfo['lastname_en']}}</div>
                   </div>
               </div>
               <div class="sub-info padding-bottom  padding-top">
                   <div class="col-md-1  nopadding"></div>
                   <div class="col-md-11 nopadding">
                       <div class="col-md-4">Nick Name English</div>
                       <div class="col-md-8">{{empty($studentProfile->getUserPersonalInfo['nickname_en']) ? "-" : $studentProfile->getUserPersonalInfo['nickname_en']}}</div>
                   </div>
               </div>

               <div class="sub-info padding-bottom  padding-top">
                    <div class="col-md-1  nopadding"></div>
                    <div class="col-md-11 nopadding">
                        <div class="col-md-4">โทรศัพท์บ้าน</div>
                        <div class="col-md-8">{{empty($studentProfile->getUserPersonalInfo['phone_home']) ? "-" : $studentProfile->getUserPersonalInfo['phone_home']}}</div>
                    </div>
               </div>

               <div class="sub-info padding-bottom padding-top">
                    <div class="col-md-1  nopadding"></div>
                    <div class="col-md-11 nopadding">
                        <div class="col-md-4">เบอร์ติดต่อ (นักเรียน)</div>
                        <div class="col-md-8">{{ empty($studentProfile->getUserPersonalInfo['phone']) ? "-" : $studentProfile->getUserPersonalInfo['phone'] }}</div>
                    </div>
               </div>
               <div class="sub-info padding-bottom padding-top">
                   <div class="col-md-1  nopadding"></div>
                   <div class="col-md-11 nopadding">
                       <div class="col-md-4">สัญชาติ</div>
                       <div class="col-md-8">{{ empty($studentProfile->getUserPersonalInfo['nationality']) ? "-" : $studentProfile->getUserPersonalInfo['nationality'] }}</div>
                   </div>
               </div>
               <div class="sub-info padding-bottom padding-top">
                   <div class="col-md-1  nopadding"></div>
                   <div class="col-md-11 nopadding">
                       <div class="col-md-4">จังหวัดที่เกิด</div>
                       <div class="col-md-8">{{ empty($studentProfile->getUserPersonalInfo['province_born']) ? "-" : $studentProfile->getUserPersonalInfo['province_born'] }}</div>
                   </div>
               </div>
               <div class="sub-info padding-bottom padding-top">
                   <div class="col-md-1  nopadding"></div>
                   <div class="col-md-11 nopadding">
                       <div class="col-md-4">ประเทศที่เกิด</div>
                       <div class="col-md-8">{{ empty($studentProfile->getUserPersonalInfo['country_born']) ? "-" : $studentProfile->getUserPersonalInfo['country_born'] }}</div>
                   </div>
               </div>
           </div>
           <div class="clear"></div>
        </div>

        <div class="col-md-12">
           <div class="info-header border-bottom padding-bottom padding-top font-blue">
                <div class="col-md-10 headder-title nopadding">
                    <div class="col-md-1"><i class="fa fa-home fa-lg" aria-hidden="true"></i></div> <div class="col-md-11">Address</div>
                </div>
                <div class="col-md-2 headder-edit text-r nopadding font-size-detail">{{-- <a href="#">Edit</a> --}}</div>
                <div class="clear"></div>
           </div>
           <div class="info-detail font-size-detail">

               <div class="sub-info padding-bottom  padding-top">
                   <div class="col-md-1  nopadding"></div>
                   <div class="col-md-11 nopadding">
                       <div class="col-md-4">ที่อยู่ปัจจุบัน</div>
                       <div class="col-md-8">{{ empty($studentProfile->getContactInfo['address_parent']) ? "-" : $studentProfile->getContactInfo['address_parent'] }}</div>
                   </div>
               </div>
               <div class="sub-info padding-bottom  padding-top">
                   <div class="col-md-1  nopadding"></div>
                   <div class="col-md-11 nopadding">
                       <div class="col-md-4">จังหวัด</div>
                       <div class="col-md-8">{{ empty($studentProfile->getContactInfo['address_province']) ? "-" : $studentProfile->getContactInfo['address_province'] }}</div>
                   </div>
               </div>
               <div class="sub-info padding-bottom  padding-top">
                    <div class="col-md-1  nopadding"></div>
                    <div class="col-md-11 nopadding">
                        <div class="col-md-4">รหัสไปรษณีย์</div>
                        <div class="col-md-8">{{ empty($studentProfile->getContactInfo['address_postcode']) ? "-" : $studentProfile->getContactInfo['address_postcode'] }}</div>
                    </div>
               </div>

               <div class="sub-info padding-bottom  padding-top">
                   <div class="col-md-1  nopadding"></div>
                   <div class="col-md-11 nopadding">
                       <div class="col-md-4">ที่อยู่ในการจัดส่งข้อมูลแตกต่างจากที่อยู่ข้างต้น</div>
                       <div class="col-md-8">{{ empty($studentProfile->getContactInfo['address_order_checkbox']) ? "-" : $studentProfile->getContactInfo['address_order'] }}</div>
                   </div>
               </div>
               @if( !empty($studentProfile->getContactInfo['address_order_checkbox']) )
                   <div class="sub-info padding-bottom  padding-top">
                       <div class="col-md-1  nopadding"></div>
                       <div class="col-md-11 nopadding">
                           <div class="col-md-4">จังหวัด</div>
                           <div class="col-md-8">{{ empty($studentProfile->getContactInfo['address_province']) ? "-" : $studentProfile->getContactInfo['address_province'] }}</div>
                       </div>
                   </div>
                   <div class="sub-info padding-bottom  padding-top">
                       <div class="col-md-1  nopadding"></div>
                       <div class="col-md-11 nopadding">
                           <div class="col-md-4">รหัสไปรษณีย์</div>
                           <div class="col-md-8">{{ empty($studentProfile->getContactInfo['address_postcode']) ? "-" : $studentProfile->getContactInfo['address_postcode'] }}</div>
                       </div>
                   </div>
               @endif

               <div class="sub-info padding-bottom padding-top">
                    <div class="col-md-1  nopadding"></div>
                    <div class="col-md-11 nopadding">
                        <div class="col-md-4">Facebook ID</div>
                        <div class="col-md-8">{{ empty($studentProfile->getUserPersonalInfo['facebook']) ? "-" : $studentProfile->getUserPersonalInfo['facebook'] }}</div>
                    </div>
               </div>
               <div class="sub-info padding-bottom padding-top">
                   <div class="col-md-1  nopadding"></div>
                   <div class="col-md-11 nopadding">
                       <div class="col-md-4">Line ID</div>
                       <div class="col-md-8">{{ empty($studentProfile->getUserPersonalInfo['line_id']) ? "-" : $studentProfile->getUserPersonalInfo['line_id'] }}</div>
                   </div>
               </div>
               
           </div>
        <div class="clear"></div>
        </div>

        <div class="col-md-12">
           <div class="info-header border-bottom padding-bottom padding-top font-blue">
                <div class="col-md-10 headder-title nopadding">
                    <div class="col-md-1"><i class="fa fa-users fa-lg" aria-hidden="true"></i></div> <div class="col-md-11">Emergency Contact</div>
                </div>
                <div class="col-md-2 headder-edit text-r nopadding font-size-detail">{{-- <a href="#">Edit</a> --}}</div>
                <div class="clear"></div>
           </div>
           <div class="info-detail font-size-detail">

               <div class="sub-info padding-bottom  padding-top">
                   <div class="col-md-1  nopadding"></div>
                   <div class="col-md-11 nopadding">
                       <div class="col-md-4">ความสัมพันธ์</div>
                       <div class="col-md-8">{{ empty($studentProfile->getContactInfo['emergency_contact_relationship']) ? "-" : $studentProfile->getContactInfo['emergency_contact_relationship'] }}</div>
                   </div>
               </div>
               <div class="sub-info padding-bottom  padding-top">
                   <div class="col-md-1  nopadding"></div>
                   <div class="col-md-11 nopadding">
                       <div class="col-md-4">ชื่อ-นามสกุล (ไทย)</div>
                       <div class="col-md-8">{{ empty(trim($studentProfile->getContactInfo['emergency_contact_name'].' '.$studentProfile->getContactInfo['emergency_contact_surname']))
                                ? "-" : $studentProfile->getContactInfo['emergency_contact_name'].' '.$studentProfile->getContactInfo['emergency_contact_surname']}}</div>
                   </div>
               </div>
               <div class="sub-info padding-bottom  padding-top">
                    <div class="col-md-1  nopadding"></div>
                    <div class="col-md-11 nopadding">
                        <div class="col-md-4">เบอร์ติดต่อ</div>
                        <div class="col-md-8">{{ empty($studentProfile->getContactInfo['emergency_phone']) ? "-" : $studentProfile->getContactInfo['emergency_phone'] }}</div>
                    </div>
               </div>
               <div class="sub-info padding-bottom padding-top">
                    <div class="col-md-1  nopadding"></div>
                    <div class="col-md-11 nopadding">
                        <div class="col-md-4">Email</div>
                        <div class="col-md-8">{{ empty($studentProfile->getContactInfo['emergency_email']) ? "-" : $studentProfile->getContactInfo['emergency_email'] }}</div>
                    </div>
               </div>

               <h2 class="font-size-title">
                   บิดา
               </h2>
               <div class="sub-info padding-bottom padding-top">
                   <div class="col-md-1  nopadding"></div>
                   <div class="col-md-11 nopadding">
                       <div class="col-md-4">ชื่อ-นามสกุล (ไทย)</div>
                       <div class="col-md-8">{{ empty(trim($studentProfile->getContactInfo['dad_firstname'].' '.$studentProfile->getContactInfo['dad_lastname']))
                                ? "-" : $studentProfile->getContactInfo['dad_firstname'].' '.$studentProfile->getContactInfo['dad_lastname']}}</div>
                   </div>
               </div>
               <div class="sub-info padding-bottom padding-top">
                   <div class="col-md-1  nopadding"></div>
                   <div class="col-md-11 nopadding">
                       <div class="col-md-4">อายุ</div>
                       <div class="col-md-8">{{ empty($studentProfile->getContactInfo['dad_age']) ? "-" : $studentProfile->getContactInfo['dad_age'] }}</div>
                   </div>
               </div>
               <div class="sub-info padding-bottom padding-top">
                   <div class="col-md-1  nopadding"></div>
                   <div class="col-md-11 nopadding">
                       <div class="col-md-4">เบอร์ติดต่อ</div>
                       <div class="col-md-8">{{ empty($studentProfile->getContactInfo['dad_phone']) ? "-" : $studentProfile->getContactInfo['dad_phone'] }}</div>
                   </div>
               </div>
               <div class="sub-info padding-bottom padding-top">
                   <div class="col-md-1  nopadding"></div>
                   <div class="col-md-11 nopadding">
                       <div class="col-md-4">Email</div>
                       <div class="col-md-8">{{ empty($studentProfile->getContactInfo['dad_email']) ? "-" : $studentProfile->getContactInfo['dad_email'] }}</div>
                   </div>
               </div>
               <div class="sub-info padding-bottom padding-top">
                   <div class="col-md-1  nopadding"></div>
                   <div class="col-md-11 nopadding">
                       <div class="col-md-4">อาชีพ</div>
                       <div class="col-md-8">{{ empty($studentProfile->getContactInfo['dad_job']) ? "-" : $studentProfile->getContactInfo['dad_job'] }}</div>
                   </div>
               </div>
               <div class="sub-info padding-bottom padding-top">
                   <div class="col-md-1  nopadding"></div>
                   <div class="col-md-11 nopadding">
                       <div class="col-md-4">ตำแหน่ง</div>
                       <div class="col-md-8">{{ empty($studentProfile->getContactInfo['dad_position']) ? "-" : $studentProfile->getContactInfo['dad_position'] }}</div>
                   </div>
               </div>
               <div class="sub-info padding-bottom padding-top">
                   <div class="col-md-1  nopadding"></div>
                   <div class="col-md-11 nopadding">
                       <div class="col-md-4">สถานที่ทำงาน</div>
                       <div class="col-md-8">{{ empty($studentProfile->getContactInfo['dad_office']) ? "-" : $studentProfile->getContactInfo['dad_office'] }}</div>
                   </div>
               </div>

               <h2 class="font-size-title">
                   มารดา
               </h2>
               <div class="sub-info padding-bottom padding-top">
                   <div class="col-md-1  nopadding"></div>
                   <div class="col-md-11 nopadding">
                       <div class="col-md-4">ชื่อ-นามสกุล (ไทย)</div>
                       <div class="col-md-8">{{ empty(trim($studentProfile->getContactInfo['mom_firstname'].' '.$studentProfile->getContactInfo['mom_firstname']))
                                ? "-" : $studentProfile->getContactInfo['mom_firstname'].' '.$studentProfile->getContactInfo['mom_firstname']}}</div>
                   </div>
               </div>
               <div class="sub-info padding-bottom padding-top">
                   <div class="col-md-1  nopadding"></div>
                   <div class="col-md-11 nopadding">
                       <div class="col-md-4">อายุ</div>
                       <div class="col-md-8">{{ empty($studentProfile->getContactInfo['mom_age']) ? "-" : $studentProfile->getContactInfo['mom_age'] }}</div>
                   </div>
               </div>
               <div class="sub-info padding-bottom padding-top">
                   <div class="col-md-1  nopadding"></div>
                   <div class="col-md-11 nopadding">
                       <div class="col-md-4">เบอร์ติดต่อ</div>
                       <div class="col-md-8">{{ empty($studentProfile->getContactInfo['mom_phone']) ? "-" : $studentProfile->getContactInfo['mom_phone'] }}</div>
                   </div>
               </div>
               <div class="sub-info padding-bottom padding-top">
                   <div class="col-md-1  nopadding"></div>
                   <div class="col-md-11 nopadding">
                       <div class="col-md-4">Email</div>
                       <div class="col-md-8">{{ empty($studentProfile->getContactInfo['mom_email']) ? "-" : $studentProfile->getContactInfo['mom_email'] }}</div>
                   </div>
               </div>
               <div class="sub-info padding-bottom padding-top">
                   <div class="col-md-1  nopadding"></div>
                   <div class="col-md-11 nopadding">
                       <div class="col-md-4">อาชีพ</div>
                       <div class="col-md-8">{{ empty($studentProfile->getContactInfo['mom_job']) ? "-" : $studentProfile->getContactInfo['mom_job'] }}</div>
                   </div>
               </div>
               <div class="sub-info padding-bottom padding-top">
                   <div class="col-md-1  nopadding"></div>
                   <div class="col-md-11 nopadding">
                       <div class="col-md-4">ตำแหน่ง</div>
                       <div class="col-md-8">{{ empty($studentProfile->getContactInfo['mom_position']) ? "-" : $studentProfile->getContactInfo['mom_position'] }}</div>
                   </div>
               </div>
               <div class="sub-info padding-bottom padding-top">
                   <div class="col-md-1  nopadding"></div>
                   <div class="col-md-11 nopadding">
                       <div class="col-md-4">สถานที่ทำงาน</div>
                       <div class="col-md-8">{{ empty($studentProfile->getContactInfo['mom_office']) ? "-" : $studentProfile->getContactInfo['mom_office'] }}</div>
                   </div>
               </div>
               
           </div>
           <div class="clear"></div>
        </div>

        <div class="col-md-12">
            <div class="info-header border-bottom padding-bottom padding-top font-blue">
                <div class="col-md-10 headder-title nopadding">
                    <div class="col-md-1"><i class="fa fa-graduation-cap fa-lg" aria-hidden="true"></i></div> <div class="col-md-11">Education Info</div>
                </div>
                <div class="col-md-2 headder-edit text-r nopadding font-size-detail">{{-- <a href="#">Edit</a> --}}</div>
                <div class="clear"></div>
            </div>
            <div class="info-detail font-size-detail">

                <div class="sub-info padding-bottom  padding-top">
                    <div class="col-md-1  nopadding"></div>
                    <div class="col-md-11 nopadding">
                        <div class="col-md-4">กำลังศึกษาอยู่ ชั้นมัธยมศึกษาปีที่</div>
                        <div class="col-md-8">{{ empty($studentProfile->getEducationInfo['high_school_level']) ? "-" : $studentProfile->getEducationInfo['high_school_level'] }}</div>
                    </div>
                </div>
                <div class="sub-info padding-bottom  padding-top">
                    <div class="col-md-1  nopadding"></div>
                    <div class="col-md-11 nopadding">
                        <div class="col-md-4">แผนการเรียน</div>
                        <div class="col-md-8">{{ empty($studentProfile->getEducationInfo['study_program']) ? "-" : $studentProfile->getEducationInfo['study_program'] }}</div>
                    </div>
                </div>
                <div class="sub-info padding-bottom  padding-top">
                    <div class="col-md-1  nopadding"></div>
                    <div class="col-md-11 nopadding">
                        <div class="col-md-4">โรงเรียน</div>
                        <div class="col-md-8">{{ empty($studentProfile->getEducationInfo['school_name']) ? "-" : $studentProfile->getEducationInfo['school_name'] }}</div>
                    </div>
                </div>
                <div class="sub-info padding-bottom  padding-top">
                    <div class="col-md-1  nopadding"></div>
                    <div class="col-md-11 nopadding">
                        <div class="col-md-4">จังหวัด</div>
                        <div class="col-md-8">{{ empty($studentProfile->getEducationInfo['province']) ? "-" : $studentProfile->getEducationInfo['province'] }}</div>
                    </div>
                </div>
                <div class="sub-info padding-bottom  padding-top">
                    <div class="col-md-1  nopadding"></div>
                    <div class="col-md-11 nopadding">
                        <div class="col-md-4">GPA ปีล่าสุด</div>
                        <div class="col-md-8">{{ empty($studentProfile->getEducationInfo['gpa']) ? "-" : $studentProfile->getEducationInfo['gpa'] }}</div>
                    </div>
                </div>

            </div>
            <div class="clear"></div>
        </div>

        <div class="col-md-12">
            <div class="info-header border-bottom padding-bottom padding-top font-blue">
                <div class="col-md-10 headder-title nopadding">
                    <div class="col-md-1"><i class="fa fa-pencil fa-lg" aria-hidden="true"></i></div> <div class="col-md-11">Survey</div>
                </div>
                <div class="col-md-2 headder-edit text-r nopadding font-size-detail">{{-- <a href="#">Edit</a> --}}</div>
                <div class="clear"></div>
            </div>
            <div class="info-detail font-size-detail">

                <div class="sub-info padding-bottom  padding-top">
                    <div class="col-md-1  nopadding"></div>
                    <div class="col-md-11 nopadding">
                        <div class="col-md-6">นักเรียนเคยได้รับวีซ่านักเรียนประเทศสหรัฐอเมริกา (วีซ่าประเภท J1 หรือ F1)</div>
                        <div class="col-md-6">{{ Field::getHasLabel(empty($studentProfile->getUserPersonalInfo['has_american_visa']) ? "-" : $studentProfile->getUserPersonalInfo['has_american_visa']) }}</div>
                    </div>
                </div>

                <div class="sub-info padding-bottom  padding-top">
                    <div class="col-md-1  nopadding"></div>
                    <div class="col-md-11 nopadding">
                        <div class="col-md-6">เคยเข้าร่วมโครงการนักเรียนแลกเปลี่ยนฯ หรือโครงการอื่นๆ ระหว่างประเทศหรือไม่</div>
                        <div class="col-md-6">{{ empty($studentProfile->getOtherInfo['has_join']) ? "-" : $studentProfile->getOtherInfo['has_join'] }}</div>
                    </div>
                </div>

                <div class="sub-info padding-bottom  padding-top">
                    <div class="col-md-1  nopadding"></div>
                    <div class="col-md-11 nopadding">
                        <div class="col-md-6">มีญาติที่อาศัยอยู่ต่างประเทศไหม</div>
                        <div class="col-md-6">{{ empty($studentProfile->getOtherInfo['has_parent']) ? "-" : $studentProfile->getOtherInfo['has_parent'] }}</div>
                    </div>
                </div>

                <div class="sub-info padding-bottom  padding-top">
                    <div class="col-md-1  nopadding"></div>
                    <div class="col-md-11 nopadding">
                        <div class="col-md-6">ประสบการณ์ไปต่างประเทศ</div>
                        <div class="col-md-6">{{ empty($studentProfile->getOtherInfo['has_experience']) ? "-" : $studentProfile->getOtherInfo['has_experience'] }}</div>
                    </div>
                </div>

                <div class="sub-info padding-bottom  padding-top">
                    <div class="col-md-1  nopadding"></div>
                    <div class="col-md-11 nopadding">
                        <div class="col-md-6">เดินทางกับ</div>
                        <div class="col-md-6">{{ empty($studentProfile->getOtherInfo['has_experience_with']) ? "-" : $studentProfile->getOtherInfo['has_experience_with'] }}</div>
                    </div>
                </div>

                <div class="sub-info padding-bottom  padding-top">
                    <div class="col-md-1  nopadding"></div>
                    <div class="col-md-11 nopadding">
                        <div class="col-md-6">ระยะเวลา</div>
                        <div class="col-md-6">{{ empty($studentProfile->getOtherInfo['has_experience_time']) ? "-" : $studentProfile->getOtherInfo['has_experience_time'] }}</div>
                    </div>
                </div>

                <div class="sub-info padding-bottom  padding-top">
                    <div class="col-md-1  nopadding"></div>
                    <div class="col-md-11 nopadding">
                        <div class="col-md-6">รู้สึกอย่างไร หากได้อยู่กับ Host Family เป็นคนสีผิว (เช่นผิวขาว/ผิวเหลือง/ผิวดำ)</div>
                        <div class="col-md-6">{{ Field::getLevelLabel(empty($studentProfile->getOtherInfo['feel_to_black_human']) ? "-" : $studentProfile->getOtherInfo['feel_to_black_human']) }}</div>
                    </div>
                </div>

                <div class="sub-info padding-bottom  padding-top">
                    <div class="col-md-1  nopadding"></div>
                    <div class="col-md-11 nopadding">
                        <div class="col-md-6">รู้สึกอย่างไรหากต้องอยู่ร่วมห้องกับคนอื่นในบ้าน</div>
                        <div class="col-md-6">{{ Field::getLevelLabel(empty($studentProfile->getOtherInfo['feel_to_other_friend']) ? "-" : $studentProfile->getOtherInfo['feel_to_other_friend']) }}</div>
                    </div>
                </div>

                <div class="sub-info padding-bottom  padding-top">
                    <div class="col-md-1  nopadding"></div>
                    <div class="col-md-11 nopadding">
                        <div class="col-md-6">โรคประจำตัว</div>
                        <div class="col-md-6">{{ empty($studentProfile->getOtherInfo['personal_medical']) ? "-" : $studentProfile->getOtherInfo['personal_medical'] }}</div>
                    </div>
                </div>

                <div class="sub-info padding-bottom  padding-top">
                    <div class="col-md-1  nopadding"></div>
                    <div class="col-md-11 nopadding">
                        <div class="col-md-6">โรคภูมิแพ้</div>
                        <div class="col-md-6">{{ empty($studentProfile->getOtherInfo['personal_medical_phoom']) ? "-" : $studentProfile->getOtherInfo['personal_medical_phoom'] }}</div>
                    </div>
                </div>

                <div class="sub-info padding-bottom  padding-top">
                    <div class="col-md-1  nopadding"></div>
                    <div class="col-md-11 nopadding">
                        <div class="col-md-6">แพ้ยา</div>
                        <div class="col-md-6">{{ empty($studentProfile->getOtherInfo['personal_medical_drug']) ? "-" : $studentProfile->getOtherInfo['personal_medical_drug'] }}</div>
                    </div>
                </div>

                <div class="sub-info padding-bottom  padding-top">
                    <div class="col-md-1  nopadding"></div>
                    <div class="col-md-11 nopadding">
                        <div class="col-md-6">แพ้สัตว์</div>
                        <div class="col-md-6">{{ empty($studentProfile->getOtherInfo['personal_medical_animal']) ? "-" : $studentProfile->getOtherInfo['personal_medical_animal'] }}</div>
                    </div>
                </div>

                <div class="sub-info padding-bottom  padding-top">
                    <div class="col-md-1  nopadding"></div>
                    <div class="col-md-11 nopadding">
                        <div class="col-md-6">แพ้อาหาร</div>
                        <div class="col-md-6">{{ empty($studentProfile->getOtherInfo['personal_medical_food']) ? "-" : $studentProfile->getOtherInfo['personal_medical_food'] }}</div>
                    </div>
                </div>

                <div class="sub-info padding-bottom  padding-top">
                    <div class="col-md-1  nopadding"></div>
                    <div class="col-md-11 nopadding">
                        <div class="col-md-6">อนาคตอยากเป็นอะไร</div>
                        <div class="col-md-6">{{ empty($studentProfile->getOtherInfo['to_be_future']) ? "-" : $studentProfile->getOtherInfo['to_be_future'] }}</div>
                    </div>
                </div>

                <div class="sub-info padding-bottom  padding-top">
                    <div class="col-md-1  nopadding"></div>
                    <div class="col-md-11 nopadding">
                        <div class="col-md-6">เพราะ</div>
                        <div class="col-md-6">{{ empty($studentProfile->getOtherInfo['to_be_future_desc']) ? "-" : $studentProfile->getOtherInfo['to_be_future_desc'] }}</div>
                    </div>
                </div>

                <div class="sub-info padding-bottom  padding-top">
                    <div class="col-md-1  nopadding"></div>
                    <div class="col-md-11 nopadding">
                        <div class="col-md-6">หากต้องกลับมาซ้ำชั้นเรียน</div>
                        <div class="col-md-6">{{ empty($studentProfile->getOtherInfo['re_learn']) ? "-" : $studentProfile->getOtherInfo['re_learn'] }}</div>
                    </div>
                </div>

                <div class="sub-info padding-bottom  padding-top">
                    <div class="col-md-1  nopadding"></div>
                    <div class="col-md-11 nopadding">
                        <div class="col-md-6">คิดว่าตัวเองมีจุดเด่น/ข้อดีอะไรบ้าง</div>
                        <div class="col-md-6">{{ empty($studentProfile->getOtherInfo['advantage']) ? "-" : $studentProfile->getOtherInfo['advantage'] }}</div>
                    </div>
                </div>

                <div class="sub-info padding-bottom  padding-top">
                    <div class="col-md-1  nopadding"></div>
                    <div class="col-md-11 nopadding">
                        <div class="col-md-6">คิดว่าตัวเองมีจุดด้อย/ข้อเสียอะไรบ้าง</div>
                        <div class="col-md-6">{{ empty($studentProfile->getOtherInfo['disadvantage']) ? "-" : $studentProfile->getOtherInfo['disadvantage'] }}</div>
                    </div>
                </div>

                <div class="sub-info padding-bottom  padding-top">
                    <div class="col-md-1  nopadding"></div>
                    <div class="col-md-11 nopadding">
                        <div class="col-md-6">งานอดิเรก</div>
                        <div class="col-md-6">{{ empty($studentProfile->getOtherInfo['hobbies']) ? "-" : $studentProfile->getOtherInfo['hobbies'] }}</div>
                    </div>
                </div>

                <div class="sub-info padding-bottom  padding-top">
                    <div class="col-md-1  nopadding"></div>
                    <div class="col-md-11 nopadding">
                        <div class="col-md-6">ความสามารถพิเศษ/รางวัลที่ได้รับ</div>
                        <div class="col-md-6">{{ empty($studentProfile->getOtherInfo['talent']) ? "-" : $studentProfile->getOtherInfo['talent'] }}</div>
                    </div>
                </div>

                <div class="sub-info padding-bottom  padding-top">
                    <div class="col-md-1  nopadding"></div>
                    <div class="col-md-11 nopadding">
                        <div class="col-md-6">เล่นกีฬาอะไร</div>
                        <div class="col-md-6">{{ empty($studentProfile->getOtherInfo['sport']) ? "-" : $studentProfile->getOtherInfo['sport'] }}</div>
                    </div>
                </div>

                <div class="sub-info padding-bottom  padding-top">
                    <div class="col-md-1  nopadding"></div>
                    <div class="col-md-11 nopadding">
                        <div class="col-md-6">นักกีฬาของโรงเรียน</div>
                        <div class="col-md-6">{{ empty($studentProfile->getOtherInfo['has_sport_man']) ? "-" : $studentProfile->getOtherInfo['has_sport_man'] }}</div>
                    </div>
                </div>

                <div class="sub-info padding-bottom  padding-top">
                    <div class="col-md-1  nopadding"></div>
                    <div class="col-md-11 nopadding">
                        <div class="col-md-6">เล่นดนตรีอะไรบ้าง</div>
                        <div class="col-md-6">{{ empty($studentProfile->getOtherInfo['music']) ? "-" : $studentProfile->getOtherInfo['music'] }}</div>
                    </div>
                </div>

                <div class="sub-info padding-bottom  padding-top">
                    <div class="col-md-1  nopadding"></div>
                    <div class="col-md-11 nopadding">
                        <div class="col-md-6">ใช้คอมพิวเตอร์เฉลี่ยกี่วัน/สัปดาห์</div>
                        <div class="col-md-6">{{ empty($studentProfile->getOtherInfo['use_computer']) ? "-" : $studentProfile->getOtherInfo['use_computer'] }}</div>
                    </div>
                </div>

                <div class="sub-info padding-bottom  padding-top">
                    <div class="col-md-1  nopadding"></div>
                    <div class="col-md-11 nopadding">
                        <div class="col-md-6">ใช้คอมพิวเตอร์ทำอะไรบ้าง</div>
                        <div class="col-md-6">{{ empty($studentProfile->getOtherInfo['use_computer_for']) ? "-" : $studentProfile->getOtherInfo['use_computer_for'] }}</div>
                    </div>
                </div>

                <div class="sub-info padding-bottom  padding-top">
                    <div class="col-md-1  nopadding"></div>
                    <div class="col-md-11 nopadding">
                        <div class="col-md-6">สื่อสังคมออนไลน์ (social Media) ที่ใช้บ่อยที่สุด</div>
                        <div class="col-md-6">{{ empty($studentProfile->getOtherInfo['use_computer_for']) ? "-" : $studentProfile->getOtherInfo['social_media1'] }}</div>
                        <div class="col-md-offset-6 col-md-6">{{ empty($studentProfile->getOtherInfo['use_computer_for']) ? "-" : $studentProfile->getOtherInfo['social_media2'] }}</div>
                        <div class="col-md-offset-6 col-md-6">{{ empty($studentProfile->getOtherInfo['use_computer_for']) ? "-" : $studentProfile->getOtherInfo['social_media3'] }}</div>
                    </div>
                </div>

                <div class="sub-info padding-bottom  padding-top">
                    <div class="col-md-1  nopadding"></div>
                    <div class="col-md-11 nopadding">
                        <div class="col-md-6">หากถูกกำหนดการเข้าถึง Internet / Social Network จะมีผลต่อชีวิตประจำวันมาก-น้อยเพียงไร</div>
                        <div class="col-md-6">{{ Field::getLevelLabel(empty($studentProfile->getOtherInfo['feel_to_block_internet']) ? "-" : $studentProfile->getOtherInfo['feel_to_block_internet']) }}</div>
                    </div>
                </div>

            </div>
            <div class="clear"></div>
        </div>

        <div class="clear"></div>
    </div>
    <div class="clear"></div>
@endsection