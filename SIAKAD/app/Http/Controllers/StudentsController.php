<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StudentsModel;

class StudentsController extends Controller
{
    public function index(){
        $data = StudentsModel::all();
        return view('admin.students.index', compact('data'));
    }

    public function create(){
        return view('admin.students.create');
    }

    
}
