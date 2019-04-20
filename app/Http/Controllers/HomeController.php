<?php

namespace App\Http\Controllers;

use App\Objects\ApiHandler;
use App\Objects\PdfMaker;
use Illuminate\Http\Request;
use PDF;

/**
 * Class HomeController
 * @package App\Http\Controllers
 */
class HomeController extends Controller
{
    /**
     * @param Request $request
     * @return mixed
     */
    public function index(Request $request)
    {
        $page = $request->get('page');
        $api_handler = new ApiHandler();
        $designs = $api_handler->fetchDesigns();
        $per_page = 25;

        return view('index')
            ->with('designs', array_slice($designs, $page * $per_page, $per_page))
            ->with('page', $page)
            ->with('per_page', $per_page)
            ->with('total', count($designs));
    }

    /**
     * @param Request $request
     */
    public function generatePdf(Request $request)
    {
        $url = base64_decode($request->get('url'));
        $pdf = new PdfMaker();
        $pdf->generate($url);
    }
}
