<?php

namespace App\Services;

use Google\Client;
use Google\Service\Sheets;

class GoogleSheetsService
{
    private $client;
    private $service;

    public function __construct()
    {
        if (!file_exists(env('GOOGLE_APPLICATION_CREDENTIALS'))) {
            throw new \Exception('Google Application Credentials file not found: ' . env('GOOGLE_APPLICATION_CREDENTIALS'));
        }

        $this->client = new Client();
        $this->client->setApplicationName('Laravel Google Sheets Integration');
        $this->client->setScopes([Sheets::SPREADSHEETS]);
        $this->client->setAuthConfig(env('GOOGLE_APPLICATION_CREDENTIALS'));

        $this->service = new Sheets($this->client);
    }

    public function appendDataToSheet($spreadsheetId, $range, $values)
    {
        try {
            $body = new Sheets\ValueRange(['values' => $values]);
            $params = ['valueInputOption' => 'RAW'];

            \Log::info('Appending data to Google Sheets.', ['spreadsheetId' => $spreadsheetId, 'range' => $range, 'values' => $values]);
            return $this->service->spreadsheets_values->append($spreadsheetId, $range, $body, $params);
        } catch (\Exception $e) {
            \Log::error('Google Sheets API Append Error: ' . $e->getMessage());
            throw $e;
        }
    }

    public function getSheetData($spreadsheetId, $range)
    {
        try {
            \Log::info('Fetching data from Google Sheets.', ['spreadsheetId' => $spreadsheetId, 'range' => $range]);
            return $this->service->spreadsheets_values->get($spreadsheetId, $range);
        } catch (\Exception $e) {
            \Log::error('Google Sheets API Get Error: ' . $e->getMessage());
            throw $e;
        }
    }

    public function updateRowInSheet($spreadsheetId, $range, $values)
    {
        try {
            $body = new Sheets\ValueRange(['values' => $values]);
            $params = ['valueInputOption' => 'RAW'];

            \Log::info('Updating row in Google Sheets.', ['spreadsheetId' => $spreadsheetId, 'range' => $range, 'values' => $values]);
            return $this->service->spreadsheets_values->update($spreadsheetId, $range, $body, $params);
        } catch (\Exception $e) {
            \Log::error('Google Sheets API Update Error: ' . $e->getMessage());
            throw $e;
        }
    }

    public function clearRowInSheet($spreadsheetId, $range)
    {
        try {
            \Log::info('Clearing row in Google Sheets.', ['spreadsheetId' => $spreadsheetId, 'range' => $range]);
            $this->service->spreadsheets_values->clear($spreadsheetId, $range, new Sheets\ClearValuesRequest());
        } catch (\Exception $e) {
            \Log::error('Google Sheets API Clear Error: ' . $e->getMessage());
            throw $e;
        }
    }
}