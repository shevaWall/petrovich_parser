<?php

namespace App\Http\Controllers;

use App\Models\ParserInformation;

class ParserInformationController extends Controller
{
    public static function getParserStatus($modelName)
    {
        $parserInformation = ParserInformation::firstOrCreate(
            ['model_name' => $modelName],
            ['status' => 0]
        );

        $parserInformation->save();

        return $parserInformation->status;
    }

    public static function setParserStatus($modelName, bool $value){
        $parserInformation = ParserInformation::firstWhere('model_name', $modelName);
        $parserInformation->status = $value;
        $parserInformation->save();
    }
}
