<?php

namespace App\Http\Controllers;

use App\Objects\DesignsApiGetter;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {

        $page = $request->get('page');
        $designs_getter = new DesignsApiGetter();
        $designs = $designs_getter->getDesigns();
        $per_page = 25;

        return view('index')
            ->with('designs', array_slice($designs, $page*$per_page, $per_page))
            ->with('page', $page)
            ->with('per_page', $per_page)
            ->with('total', count($designs));
    }
}
