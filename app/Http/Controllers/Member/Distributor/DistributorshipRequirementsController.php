<?php

namespace App\Http\Controllers\Member\Distributor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DistributorshipTier;

class DistributorshipRequirementsController extends Controller
{
    /**
     * Display the distributorship requirements and tiers.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tiers = DistributorshipTier::where('is_active', true)
                    ->orderBy('tier_level', 'asc')
                    ->get();
                    
        return view('Member.Distributor.requirements', compact('tiers'));
    }
}
?>