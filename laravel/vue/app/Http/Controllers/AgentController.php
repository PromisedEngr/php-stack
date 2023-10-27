<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AgentController extends Controller
{
    public function index(){
        return view('agent.index');
    }


    public function agent(){
        return view('agent.create_agent');
    }

}
