<?php 
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Users;
use App\Http\Requests\UsersAccountEditRequest;
use App\Rules\StrongPassword;
use App\Services\PasswordSecurityService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Exception;
/**
 * Account Page Controller
 * @category  Controller
 */
class AccountController extends Controller{
	
	protected PasswordSecurityService $passwordSecurityService;

	public function __construct(PasswordSecurityService $passwordSecurityService)
	{
		$this->passwordSecurityService = $passwordSecurityService;
	}
	

	/**
     * Select user account data
     * @return \Illuminate\View\View
     */
	function index(){
		$rec_id = Auth::id();
		$query = Users::query();
		$record = $query->find($rec_id, Users::accountviewFields());
		if(!$record){
			return $this->reject("No record found", 404);
		}
		return $this->renderView("pages.account.view", ["data" => $record, "rec_id" => $rec_id]);
	}
	

	/**
     * Update user account data
     * @return \Illuminate\View\View;
     */
	function edit(UsersAccountEditRequest $request){
		$rec_id = Auth::id();
		$query = Users::query();
		$user = $query->findOrFail($rec_id, Users::accounteditFields());
		if ($request->isMethod('post')) {
			$modeldata = $this->normalizeFormData($request->validated());
		
		if( array_key_exists("photo", $modeldata) ){
			//move uploaded file from temp directory to destination directory
			$fileInfo = $this->moveUploadedFiles($modeldata['photo'], "photo");
			$modeldata['photo'] = $fileInfo['filepath'];
		}
			$user->update($modeldata);
			return $this->redirect("account", "Record updated successfully");
		}
		return $this->renderView("pages.account.edit", ["data" => $user, "rec_id" => $rec_id]);
	}
	

	/**
     * Change user account password
     * @return \Illuminate\Http\Response
     */
	public function changepassword(Request $request)
	{
		$request->validate([
			'oldpassword' => ['required'],
			'newpassword' => ['required', new StrongPassword()],
			'confirmpassword' => ['same:newpassword'],
		]);
		$userid = auth()->id();
		$user = Users::find($userid);
		$oldPasswordText = $request->oldpassword;
		$oldPasswordHash = $user->password;
		if(!Hash::check($oldPasswordText, $oldPasswordHash)){
			return back()->withErrors(["Current password is incorrect"]);
		}
		if ($this->passwordSecurityService->hasBeenUsedBefore($user, $request->newpassword)) {
			return back()->withErrors(["Password pernah digunakan sebelumnya."]);
		}
		$this->passwordSecurityService->recordPasswordChange($user, $request->newpassword);
		return $this->redirect("/account", "Password change completed");
	}
}
