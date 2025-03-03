<?php

namespace App\Services;

use Google;
use Illuminate\Support\Facades\Cache;

class GoogleTableSyncService
{
    const FILE_ID_CACHE_KEY = 'google_table_sync_file_id';

    private Google\Service\Sheets $sheetService;

    private Google\Service\Drive $driveService;

    public function __construct()
    {
        $client = new Google\Client();
        $client->setAuthConfig(config('services.google.service_acc_key'));
        $client->setScopes(Google\Service\Drive::DRIVE);

        $this->sheetService = new Google\Service\Sheets($client);
        $this->driveService = new Google\Service\Drive($client);
    }

    public function getValues()
    {
        return $this->sheetService->spreadsheets->get("1OBcxuiLIXI8o9QrntSaDqbxY-2q_i_tXVuJ8QiuPX58");
    }

    public function setSheet(string $docUrl)
    {
        try {
            $fileId = $this->extractGoogleSheetId($docUrl);
            $this->checkAvailability($fileId);

            Cache::set('google_table_sync_file_id', $docUrl);
        } catch (\Throwable $error) {
            throw new \Exception($error->getMessage());
        }
    }

    public static function getSheet()
    {
        return Cache::get('google_table_sync_file_id');
    }

    private function extractGoogleSheetId(string $url): string
    {
        preg_match('/\/d\/([^\/]+)/', $url, $matches);
        return $matches[1] ?? '';
    }

    /**
     * Проверка доступности гугл-таблицы
     *
     * @param string $fileId
     * @return void
     */
    private function checkAvailability(string $fileId): void
    {
        try {
            $this->driveService->permissions->listPermissions($fileId);
        } catch (Google\Service\Exception $googleException) {
            $googleExceptionMessage = current($googleException->getErrors())['message'] ?? 'unknown error';
            switch ($googleExceptionMessage) {
                case 'The user does not have sufficient permissions for this file.':
                    throw new \Exception('Need editor rights for this table');
                case str_starts_with($googleExceptionMessage, "File not found"):
                    throw new \Exception('The table not found');
                case 'Required':
                    throw new \Exception('Broken url');
                default:
                    throw new \Exception('Unknown error');
            }
        } catch (\Throwable $error) {
            throw new \Exception('Unknown error');
        }
    }
}
