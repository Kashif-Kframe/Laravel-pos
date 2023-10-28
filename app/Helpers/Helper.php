<?php

namespace App\Helpers;

use App\Mail\CompanyEmail;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;

class Helper
{
    const SUCCESS_CODE = 200;
    const ERROR_CODE = 500;
    const UNAUTH_CODE = 401;

    public static function apiResponse($data = [], string $message = "", bool $status = true, int $code = self::SUCCESS_CODE): JsonResponse
    {
        $response = [
            'status' => $status,
            'message' => $message,
        ];

        if (!empty($data)) {
            $response['data'] = $data;
        }

        return response()->json($response, $code);

    }

    /**
     * @param $request
     * @param $oldFilePath
     * @param $fileName
     * @param $file_path
     * @return string
     */
    public static function uploadFile($request, $oldFilePath = '', $fileName = 'logo', $file_path = 'logo'): string
    {
        if ($request->hasFile($fileName)) {
            self::deleteFile($oldFilePath);

            $image = $request->{$fileName};
            $filenameWithExt = str_replace(' ', '-', $image->getClientOriginalName());
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $image->getClientOriginalExtension();
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;
            self::createDir(storage_path('app/public/' . $file_path));
            $image->storeAs('public/' . $file_path, $fileNameToStore);
            return $file_path . '/' . $fileNameToStore;
        }

        return $oldFilePath;
    }

    /**
     * @param $file
     * @return bool
     */
    public static function deleteFile($file): bool
    {
        if (File::exists(storage_path('app/public/' . $file))) {
            File::delete(storage_path('app/public/' . $file));
        }
        return true;
    }

    /**
     * @param $path
     * @return void
     */
    private static function createDir($path)
    {
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }
    }

    public static function activeMenu($routes, $class = 'active-menu')
    {
        if (in_array(request()->route()->getName(), $routes)) {
            return $class;
        }
        return '';
    }

    /**
     * @param $company
     * @return void
     */
    public static function sendEmail($company)
    {
        try {
            Mail::to($company->email)->send(new CompanyEmail($company));
        } catch (\Exception $e) {
            report($e);
        }
    }

}
