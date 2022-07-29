<?php

namespace App\Http\Controllers;

use App\Http\Resources\MasterClassResource;
use App\Http\Resources\TimetableResource;
use Illuminate\Http\Request;
use App\Http\Resources\MasterClassCollection;
use App\Http\Resources\TimetableCollection;
use App\Models\Master_class;
use App\Models\Timetable;

class ApiController extends Controller
{
    public function list(){
        return new MasterClassCollection(Master_class::all());
    }

    public function detail($id){
        return new MasterClassResource(Master_class::findOrFail($id));
    }
}
