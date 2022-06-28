<?php

namespace App\Http\Controllers;

use App\Adapters\XMLFileAdapter;
use App\Services\ImportService;
use Illuminate\Http\Request;

class DataController extends Controller
{
    public function __construct()
    {

    }

    public function index()
    {
        return view('pages.data');
    }

    public function import(Request $request, ImportService $service)
    {
        $imported = $service->startImport(XMLFileAdapter::getXMLObjectFromFile($request->file));

        return view('pages.data', compact('imported'));
    }

    public function export(Request $request)
    {
        XMLFileAdapter::createXML();

        $path_to_xml = config('app.url') . '/storage/files/export.xml';

        return view('pages.data', compact('path_to_xml'));
    }
}
