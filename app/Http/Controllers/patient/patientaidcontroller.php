<?php

namespace App\Http\Controllers\patient;

use Carbon\Carbon;
use App\Models\financialaid;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class patientaidcontroller extends Controller
{

    public function showEligibleAids()
    {
        $patient = Auth::guard('patient')->user();

        // Load and parse the JSON file
        $path = storage_path('app/data/finaicialaid.json');
        // dd($path);
        if (!file_exists($path)) {
            return back()->withErrors(['Financial aid data is not available at the moment.']);
        }

        $json = file_get_contents($path);
        // dd($json);
        $aids = json_decode($json);

        // Ensure it's a valid array
        if (!is_array($aids)) {
            return back()->withErrors(['Financial aid data format is invalid.']);
        }

        $eligibleAids = [];

        foreach ($aids as $aid) {
            $criteria = $aid->eligibility_criteria ?? null;
            if (!$criteria)
                continue;

            $matched = 0;
            $total = 5;

            // dd($patient->yearly_income <= $criteria->income_below);

            if (isset($criteria->income_below) && $patient->yearly_income <= $criteria->income_below) {
                $matched++;
            }

            if (isset($criteria->cancer_type)) {
                $patientCancerType = strtolower($patient->cancer_type);
                $criteriaCancerTypes = array_map('strtolower', (array) $criteria->cancer_type);

                if (in_array($patientCancerType, $criteriaCancerTypes)) {
                    $matched++;
                }
            }

            if (isset($criteria->insurance_status)) {
                $patientInsuranceStatus = strtolower($patient->insurance_status);
                $criteriaInsuranceStatuses = array_map('strtolower', (array) $criteria->insurance_status);

                if (in_array($patientInsuranceStatus, $criteriaInsuranceStatuses)) {
                    $matched++;
                }
            }

            if (isset($criteria->treatment_stage)) {
                $patientStagesRaw = $patient->treatment_stage;

                if (is_string($patientStagesRaw)) {
                    $decoded = json_decode($patientStagesRaw, true);
                    $patientStages = is_array($decoded) ? $decoded : [];
                } elseif (is_array($patientStagesRaw)) {
                    $patientStages = $patientStagesRaw;
                } else {
                    $patientStages = [];
                }

                $patientStages = array_map('strtolower', $patientStages);
                $criteriaStages = array_map('strtolower', (array) $criteria->treatment_stage);

                if (count(array_intersect($patientStages, $criteriaStages)) > 0) {
                    $matched++;
                }
            }




            if (isset($criteria->age_limit) && $patient->dateofbirth) {
                $age = Carbon::parse($patient->dateofbirth)->age;
                if ($age <= $criteria->age_limit) {
                    $matched++;
                }
            }

            $matchScore = round(($matched / $total) * 80); // Max 80%

            if ($matchScore > 0) {
                $aid->match_score = $matchScore;
                $eligibleAids[] = $aid;
            }
        }
        // dd($eligibleAids);

        return view('patient.p_eligible_aids', compact('eligibleAids'));

    }

}