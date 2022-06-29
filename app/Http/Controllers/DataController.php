<?php

namespace App\Http\Controllers;

use App\Adapters\XMLFileAdapter;
use App\Services\ImportService;
use App\Services\XMLservice;
use Illuminate\Http\Request;

class DataController extends Controller
{
    public function index()
    {
        return view('pages.data');
    }

    public function import(Request $request, ImportService $service)
    {
        $imported = $service->startImport(XMLFileAdapter::getXMLObjectFromFile($request->file));

        return view('pages.data', compact('imported'));
    }

    public function export(Request $request, XMLservice $xmlService)
    {
        $xmlService->createXML();

        $path_to_xml = $xmlService->getPathToXmlFile();

        return view('pages.data', compact('path_to_xml'));
    }
}
