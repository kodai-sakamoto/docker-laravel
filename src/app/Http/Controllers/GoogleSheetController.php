<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\GoogleSheetsService;

class GoogleSheetController extends Controller
{
    private $googleSheetsService;

    public function __construct(GoogleSheetsService $googleSheetsService)
    {
        $this->googleSheetsService = $googleSheetsService;
    }

    public function index()
    {
        return view('googleSheet');
    }

    public function appendData()
    {
        $spreadsheetId = env('GOOGLE_SPREADSHEET_ID');
        $range = 'シート1!A1'; // 書き込むセル範囲を指定
        $values = [
            ['Test ID', 'Test Data Validation ID', 'Aquarium ID', 'PH', 'Salt', 'DO', 'Water Temp', 'Outside Temp', 'Inside Temp', 'Detail', 'Created At', 'Updated At', 'Deleted At']
        ];

        try {
            $this->googleSheetsService->appendDataToSheet($spreadsheetId, $range, $values);
            return response()->json(['message' => 'Data appended successfully.']);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}