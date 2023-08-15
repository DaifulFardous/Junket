<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TourPlan;

class TourController extends Controller
{
    public function index(){
        $runningplans = TourPlan::all();
      return view('frontend.tourPlans.tours',compact('runningplans'));
    }
    public function upcomming(){
        return view('frontend.tourPlans.upcomming');
    }
}