<?php

namespace App\Http\Controllers\Admin\ACL;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use App\Models\Profile;
use Illuminate\Http\Request;

class PlanProfileController extends Controller
{
    private $plan, $profile;

    public function __construct(Plan $plan, Profile $profile)
    {
        $this->plan = $plan;
        $this->profile = $profile;
    }

    public function profiles($idPlan)
    {
        if (!$plan = $this->plan->find($idPlan))
            return redirect()->back();

        $profiles = $plan->profiles()->paginate();

        return view('admin.pages.plans.profiles.profiles', [
            'plan' => $plan,
            'profiles' => $profiles,
        ]);
    }
    public function profilesAvailable(Request $request, $idPlan)
    {
        if (!$plan = $this->plan->find($idPlan))
            return redirect()->back();

        $filters = $request->except('_token');
       
        $profiles = $plan->profileAvailable($request->filter);

        return view('admin.pages.plans.profiles.available', [
            'plan' => $plan,
            'profiles' => $profiles,
            'filters' => $filters,
        ]);

    }
    public function attachProfilesPlan(Request $request,$idPlan)
    {
        if (!$plan = $this->plan->find($idPlan))
            return redirect()->back();

        if (!$request->profiles || count($request->profiles) === 0)
            return redirect()
                    ->back()
                    ->with('warning', 'Precisa escolher pelo menos um plano');

        $plan->profiles()->attach($request->profiles);

        return redirect()->route('plans.profiles', $plan->id);
    }
    public function detachProfilePlan($idPlan, $idPermission)
    {
        $plan = $this->plan->find($idPlan);
        $profile = $this->profile->find($idPermission);

        if (!$plan || !$profile)
            return redirect()->back();

        $plan->profiles()->detach($profile);

        return redirect()->back();
    }

    public function plans($idPermission)
    {
        if (!$profile = $this->profile->find($idPermission))
            return redirect()->back();

        $plans = $profile->plans()->paginate();

        return view('admin.pages.profiles.plans.plans', [
            'profile' => $profile,
            'plans' => $plans,
        ]);
    }
}
