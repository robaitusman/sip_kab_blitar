<?php
namespace App\Http\Controllers;

use App\Helpers\Uploader;
use App\Http\Controllers\Controller;
use App\Models\FileIntegrityRecord;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
class FileUploaderController extends Controller
{
	/**
     * Handle the file upload
	 * Support multitple file upload
	 * @method string upload
	 * @param string $fieldName
     * @return \Illuminate\Http\Response
     */
	function upload(Request $request, $fieldName = null)
	{
		$uploader = new Uploader($fieldName);
		$errors = $uploader->validate($request);
		if(!empty($errors)){
			$this->logSecurity($request, $fieldName, 'upload_failed_validation', $errors);
			return $this->reject($errors, 400);
		}

		$uploader->upload($request);
		if (!empty($uploader->errors)) {
			$this->logSecurity($request, $fieldName, 'upload_failed_security', $uploader->errors);
			return $this->reject($uploader->errors, 400);
		}
		$this->storeIntegrityHashes($uploader->uploadedFiles);
		$this->logSecurity($request, $fieldName, 'upload_success', $uploader->uploadedFiles);
		return $uploader->uploadedFiles;
	}

	/**
     * Handle the file upload
	 * Support multitple file upload
	 * @method string upload
	 * @param string $fieldName
     * @return \Illuminate\Http\Response
     */
	function s3upload(Request $request, $fieldName = null)
	{
		$uploader = new Uploader($fieldName);
		$errors = $uploader->validate($request);
		if(!empty($errors)){
			$this->logSecurity($request, $fieldName, 's3upload_failed_validation', $errors);
			return $this->reject($errors, 400);
		}
		$uploader->s3upload($request);
		if (!empty($uploader->errors)) {
			$this->logSecurity($request, $fieldName, 's3upload_failed_security', $uploader->errors);
			return $this->reject($uploader->errors, 400);
		}
		$this->storeIntegrityHashes($uploader->uploadedFiles);
		$this->logSecurity($request, $fieldName, 's3upload_success', $uploader->uploadedFiles);
		return $uploader->uploadedFiles;
	}

	
	/**
     * remove uploaded file from temp directory
	 * @method string upload
	 * @param string $fieldName
     * @return \Illuminate\Http\Response
     */
	function remove_temp_file(Request $request)
	{
		if($request->temp_file){
			$file = $request->temp_file;
			$filename = basename($file);
			$tempDir = config("upload.tempDir");
			$fullName = public_path("$tempDir/$filename");
			if(File::exists($fullName)){
				File::delete($fullName);
				$this->logSecurity($request, null, 'remove_temp_success', [$file]);
				return $this->respond("File deleted");
			}
		}
		$this->logSecurity($request, null, 'remove_temp_invalid', [$request->temp_file ?? '']);
		return $this->reject("Invalid temp file", 400);
	}

	private function logSecurity(Request $request, ?string $fieldName, string $action, array $details = []): void
	{
		$user = auth()->user();
		Log::channel('security')->info('upload_activity', [
			'action' => $action,
			'field' => $fieldName,
			'user_id' => $user?->id,
			'username' => $user?->username,
			'ip' => $request->ip(),
			'user_agent' => $request->header('User-Agent'),
			'files' => $details,
		]);
	}

	/**
	 * Simpan hash SHA256 untuk file yang diupload ke tabel file_integrity_records
	 */
	private function storeIntegrityHashes(array $files): void
	{
		foreach ($files as $file) {
			$path = public_path($file);
			if (!File::exists($path)) {
				continue;
			}
			$hash = hash_file('sha256', $path);
			FileIntegrityRecord::updateOrCreate(
				['path' => $file],
				['sha256_hash' => $hash, 'last_scanned_at' => now()]
			);
		}
	}
}
