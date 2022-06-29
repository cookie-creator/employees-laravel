<?php

namespace App\Adapters;

use App\Models\Department;
use App\Models\Employee;
use App\Models\SalaryTypes;
use Illuminate\Support\Facades\Storage;

class XMLFileAdapter
{
    public static function getXMLObjectFromFile($file)
    {
        return simplexml_load_string(file_get_contents($file), "SimpleXMLElement", LIBXML_NOCDATA);
    }

    public static function getXMLObjectFromStorage()
    {
        $rs = Storage::disk('local')->get('public/files/export.xml');
        $xml = simplexml_load_string($rs, "SimpleXMLElement", LIBXML_NOCDATA);
        return $xml;
    }
}
