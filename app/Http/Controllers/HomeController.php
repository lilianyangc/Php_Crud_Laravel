<?php

namespace App\Http\Controllers;



class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //creates an exemption on about and export pages for the guest
       $this->middleware('auth', [ 'except' => 'about' ],[ 'except' => 'export' ]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function add(){
        return view("pages.add");
    }

    public function modify(){
        return view("pages.modify");
    }

    public function import(){
        return view("pages.import");
    }

    public function about(){
        return view("pages.about");
    }

    public function export(){
        return view("pages.export");
    }


}
