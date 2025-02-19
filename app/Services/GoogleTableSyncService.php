<?php

namespace App\Services;

use Google;

class GoogleTableSyncService
{
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

    public function setWorkSheet(string $fileId)
    {
        try {
            $this->checkAvailability($fileId);

            return 'OK';
        } catch (\Throwable $error) {
            throw new \Exception($error->getMessage());
        }
    }

    /**
     * Проверяем доступность гугл-таблицы
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
            dump($googleExceptionMessage);
            switch ($googleExceptionMessage) {
                case 'The user does not have sufficient permissions for this file.':
                    throw new \Exception('Need editor rights for this table');
                case str_starts_with($googleExceptionMessage, "File not found"):
                    throw new \Exception('The table not found');
                default:
                    throw new \Exception('Unknown error');
            }
        } catch (\Throwable $error) {
            throw new \Exception('Unknown error');
        }
    }
}
