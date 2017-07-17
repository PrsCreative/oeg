<?php

namespace App\Repositories\Storage;

use App\Models\HighSchoolExchangeExciteCampLocation;
use App\Models\HighSchoolExchangeParentInformationMeetingLocation;
use App\Repositories\Interfaces\HSPGlobalRepositoryInterface;
use App\Models\HighSchoolExchangeApplication;
use App\Models\HighSchoolExchangeAdmissionTestLocation;
use Illuminate\Support\Facades\DB;

class HSPGlobalRepository implements HSPGlobalRepositoryInterface
{

    public function studentChangeAdmissionTestLocationLogic($userId, $newAdmissionTestLocationId) {

        $oldAdmissionTestLocationId = HighSchoolExchangeApplication::where('user_id', $userId)->get()->toArray()[0]['admission_test_location_id'];

        if (!empty($oldAdmissionTestLocationId)) {
            // Decrement
            $query = HighSchoolExchangeAdmissionTestLocation::findOrFail($oldAdmissionTestLocationId);
            $query->update(['used' => $query->used-1]);
        }

        // Increment
        $query = HighSchoolExchangeAdmissionTestLocation::findOrFail($newAdmissionTestLocationId);
        $query->update(['used' => $query->used+1]);
    }

    public function studentChangePIMLocationLogic($oldPIMLocation, $oldAmount, $newPIMLocation, $newAmount)
    {
        if (!empty($oldPIMLocation)) {
            // Decrement
            $query = HighSchoolExchangeParentInformationMeetingLocation::findOrFail($oldPIMLocation);
            $query->update(['used' => ($query->used - $oldAmount)]);
        }

        // Increment
        $query = HighSchoolExchangeParentInformationMeetingLocation::findOrFail($newPIMLocation);
        $query->update(['used' => ($query->used + $newAmount)]);
    }
    
    public function studentChangeExCITECampLocationLogic($oldExCiteCampId, $newExCiteCampId)
    {
        if (!empty($oldExCiteCampId)) {
            // Decrement
            $query = HighSchoolExchangeExciteCampLocation::findOrFail($oldExCiteCampId);
            $query->update(['used' => ($query->used - 1)]);
        }

        // Increment
        $query = HighSchoolExchangeExciteCampLocation::findOrFail($newExCiteCampId);
        $query->update(['used' => ($query->used + 1)]);
    }

    public function changeStateHSPtoExciteCamp($id)
    {
        // Find HSP App by User ID
        $query = HighSchoolExchangeApplication::query();
        $query = $query->where('user_id', $id)->where('status_application', 'approved');
        $hspDetail = $query->first();

        if ($hspDetail->state < 5) {
            $query->update(['state' => 5]);
        }
    }

    public function changeStateHSPtoStudentInfo($userId, $studentResultFromExcel)
    {
        $studentResultFromExcel = collect($studentResultFromExcel);

        // Query for check change state
        $query = HighSchoolExchangeApplication::query();
        $query = $query->where('user_id', $userId)->where('status_application', 'approved');
        $hspDetail = $query->first();

        // Update
        $query->update([
            'admission_test_status' => $studentResultFromExcel->get('statuspassfail'),
            'admission_test_score'  => $studentResultFromExcel->get('score'),
            'admission_test_remark' => $studentResultFromExcel->get('remark'),
            'state'                 => ($studentResultFromExcel->get('statuspassfail') == 'pass' && $hspDetail['state'] < 3 ? 3 : $hspDetail['state'])
        ]);
    }
}