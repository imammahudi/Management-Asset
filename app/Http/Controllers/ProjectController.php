<?php
namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\Accessory;
use App\Models\Company;
use App\Models\User;
use Auth;
use Carbon\Carbon;
use Config;
use DB;
use Gate;
use Input;
use Lang;
use Redirect;
use Illuminate\Http\Request;
use Slack;
use Str;
use View;
use Image;
use App\Http\Requests\ImageUploadRequest;
use SebastianBergmann\CodeCoverage\Report\Xml\Project;

/** This controller handles all actions related to Accessories for
 * the Snipe-IT Asset Management application.
 *
 * @version    v1.0
 */
class ProjectController extends Controller
{

    /**
    * Returns a view that invokes the ajax tables which actually contains
    * the content for the accessories listing, which is generated in getDatatable.
    *
    * @author [A. Gianotto] [<snipe@snipe.net>]
    * @see AccessoriesController::getDatatable() method that generates the JSON response
    * @since [v1.0]
    * @return View
    */
    public function index(Request $request)
    {
        $this->authorize('index', Project::class);
        return view('projek/index');
    }


  /**
   * Returns a view with a form to create a new Project.
   *
   * @author [A. Gianotto] [<snipe@snipe.net>]
   * @return View
   */
    public function create(Request $request)
    {
        $this->authorize('create', Project::class);
        $category_type = 'projek';
        return view('accessories/edit')->with('category_type', $category_type)
          ->with('item', new Accessory);
    }


  /**
   * Validate and save new Accessory from form post
   *
   * @author [A. Gianotto] [<snipe@snipe.net>]
   * @return Redirect
   */
    public function store(ImageUploadRequest $request)
    {
        $this->authorize(Project::class);
        // create a new model instance
        $project = new Accessory();

        // Update the accessory data
        $project->name                    = request('name');
        $project->category_id             = request('category_id');
        $project->location_id             = request('location_id');
        $project->min_amt                 = request('min_amt');
        $project->company_id              = Company::getIdForCurrentUser(request('company_id'));
        $project->order_number            = request('order_number');
        $project->manufacturer_id         = request('manufacturer_id');
        $project->model_number            = request('model_number');
        $project->purchase_date           = request('purchase_date');
        $project->purchase_cost           = Helper::ParseFloat(request('purchase_cost'));
        $project->qty                     = request('qty');
        $project->user_id                 = Auth::user()->id;
        $project->supplier_id             = request('supplier_id');
        $project = $request->handleImages($project,600, public_path().'/uploads/accessories');


        // Was the accessory created?
        if ($project->save()) {
            // Redirect to the new accessory  page
            return redirect()->route('accessories.index')->with('success', trans('admin/accessories/message.create.success'));
        }
        return redirect()->back()->withInput()->withErrors($project->getErrors());
    }

  /**
   * Return view for the Accessory update form, prepopulated with existing data
   *
   * @author [A. Gianotto] [<snipe@snipe.net>]
   * @param  int  $accessoryId
   * @return View
   */
    public function edit(Request $request, $projectId = null)
    {

        if ($item = Accessory::find($projectId)) {
            $this->authorize($item);
            $category_type = 'project';
            return view('project/edit', compact('item'))->with('category_type', $category_type);
        }

        return redirect()->route('project.index')->with('error', trans('admin/accessories/message.does_not_exist'));

    }


  /**
   * Save edited Accessory from form post
   *
   * @author [A. Gianotto] [<snipe@snipe.net>]
   * @param  int  $accessoryId
   * @return Redirect
   */
    public function update(ImageUploadRequest $request, $accessoryId = null)
    {
        if (is_null($project = Project::find($projectId))) {
            return redirect()->route('project.index')->with('error', trans('admin/accessories/message.does_not_exist'));
        }

        $this->authorize($project);

        // Update the accessory data
        $project->name                    = request('name');
        $project->category_id             = request('category_id');
        $project->location_id             = request('location_id');
        $project->min_amt                 = request('min_amt');
        $project->company_id              = Company::getIdForCurrentUser(request('company_id'));
        $project->order_number            = request('order_number');
        $project->manufacturer_id         = request('manufacturer_id');
        $project->model_number            = request('model_number');
        $project->purchase_date           = request('purchase_date');
        $project->purchase_cost           = Helper::ParseFloat(request('purchase_cost'));
        $project->qty                     = request('qty');
        $project->user_id                 = Auth::user()->id;
        $project->supplier_id             = request('supplier_id');
        $project = $request->handleImages($project,600, public_path().'/uploads/accessories');

        // Was the accessory updated?
        if ($project->save()) {
            return redirect()->route('project.index')->with('success', trans('admin/accessories/message.update.success'));
        }
        return redirect()->back()->withInput()->withErrors($accessory->getErrors());
    }

  /**
   * Delete the given accessory.
   *
   * @author [A. Gianotto] [<snipe@snipe.net>]
   * @param  int  $accessoryId
   * @return Redirect
   */
    public function destroy(Request $request, $accessoryId)
    {
        if (is_null($accessory = Accessory::find($accessoryId))) {
            return redirect()->route('accessories.index')->with('error', trans('admin/accessories/message.not_found'));
        }

        $this->authorize($accessory);


        if ($accessory->hasUsers() > 0) {
             return redirect()->route('accessories.index')->with('error', trans('admin/accessories/message.assoc_users', array('count'=> $accessory->hasUsers())));
        }
        $accessory->delete();
        return redirect()->route('accessories.index')->with('success', trans('admin/accessories/message.delete.success'));
    }



  /**
  * Returns a view that invokes the ajax table which  contains
  * the content for the accessory detail view, which is generated in getDataView.
  *
  * @author [A. Gianotto] [<snipe@snipe.net>]
  * @param  int  $accessoryID
  * @see AccessoriesController::getDataView() method that generates the JSON response
  * @since [v1.0]
  * @return View
  */
    public function show(Request $request, $accessoryID = null)
    {
        $accessory = Accessory::find($accessoryID);
        $this->authorize('view', $accessory);
        if (isset($accessory->id)) {
            return view('accessories/view', compact('accessory'));
        }
        return redirect()->route('accessories.index')->with('error', trans('admin/accessories/message.does_not_exist', compact('id')));
    }

  /**
   * Return the form to checkout an Accessory to a user.
   *
   * @author [A. Gianotto] [<snipe@snipe.net>]
   * @param  int  $accessoryId
   * @return View
   */
    public function getCheckout(Request $request, $accessoryId)
    {
        // Check if the accessory exists
        if (is_null($accessory = Accessory::find($accessoryId))) {
            // Redirect to the accessory management page with error
            return redirect()->route('accessories.index')->with('error', trans('admin/accessories/message.not_found'));
        }

        if ($accessory->category) {

            $this->authorize('checkout', $accessory);

            // Get the dropdown of users and then pass it to the checkout view
            return view('accessories/checkout', compact('accessory'));
        }

        return redirect()->back()->with('error', 'The category type for this accessory is not valid. Edit the accessory and select a valid accessory category.');



    }

  /**
   * Save the Accessory checkout information.
   *
   * If Slack is enabled and/or asset acceptance is enabled, it will also
   * trigger a Slack message and send an email.
   *
   * @author [A. Gianotto] [<snipe@snipe.net>]
   * @param  int  $accessoryId
   * @return Redirect
   */
    public function postCheckout(Request $request, $accessoryId)
    {
      // Check if the accessory exists
        if (is_null($accessory = Accessory::find($accessoryId))) {
            // Redirect to the accessory management page with error
            return redirect()->route('accessories.index')->with('error', trans('admin/accessories/message.user_not_found'));
        }

        $this->authorize('checkout', $accessory);

        if (!$user = User::find(Input::get('assigned_to'))) {
            return redirect()->route('checkout/accessory', $accessory->id)->with('error', trans('admin/accessories/message.checkout.user_does_not_exist'));
        }

      // Update the accessory data
        $accessory->assigned_to = e(Input::get('assigned_to'));

        $accessory->users()->attach($accessory->id, [
            'accessory_id' => $accessory->id,
            'created_at' => Carbon::now(),
            'user_id' => Auth::id(),
            'assigned_to' => $request->get('assigned_to')
        ]);

        $logaction = $accessory->logCheckout(e(Input::get('note')), $user);

        DB::table('accessories_users')->where('assigned_to', '=', $accessory->assigned_to)->where('accessory_id', '=', $accessory->id)->first();

        $data['log_id'] = $logaction->id;
        $data['eula'] = $accessory->getEula();
        $data['first_name'] = $user->first_name;
        $data['item_name'] = $accessory->name;
        $data['checkout_date'] = $logaction->created_at;
        $data['item_tag'] = '';
        $data['expected_checkin'] = '';
        $data['note'] = $logaction->note;
        $data['require_acceptance'] = $accessory->requireAcceptance();

      // Redirect to the new accessory page
        return redirect()->route('project.index')->with('success', trans('admin/accessories/message.checkout.success'));
    }


    /**
     * Check the accessory back into inventory
     *
     * @author [A. Gianotto] [<snipe@snipe.net>]
     * @param Request $request
     * @param integer $accessoryUserId
     * @param string $backto
     * @return View
     * @internal param int $accessoryId
     */
    public function getCheckin(Request $request, $accessoryUserId = null, $backto = null)
    {
        // Check if the accessory exists
        if (is_null($accessory_user = DB::table('accessories_users')->find($accessoryUserId))) {
            // Redirect to the accessory management page with error
            return redirect()->route('accessories.index')->with('error', trans('admin/accessories/message.not_found'));
        }

        $accessory = Accessory::find($accessory_user->accessory_id);
        $this->authorize('checkin', $accessory);
        return view('accessories/checkin', compact('accessory'))->with('backto', $backto);
    }


    /**
     * Check in the item so that it can be checked out again to someone else
     *
     * @uses Accessory::checkin_email() to determine if an email can and should be sent
     * @author [A. Gianotto] [<snipe@snipe.net>]
     * @param Request $request
     * @param integer $accessoryUserId
     * @param string $backto
     * @return Redirect
     * @internal param int $accessoryId
     */
    public function postCheckin(Request $request, $accessoryUserId = null, $backto = null)
    {
      // Check if the accessory exists
        if (is_null($accessory_user = DB::table('accessories_users')->find($accessoryUserId))) {
            // Redirect to the accessory management page with error
            return redirect()->route('accessories.index')->with('error', trans('admin/accessories/message.does_not_exist'));
        }

        $accessory = Accessory::find($accessory_user->accessory_id);

        $this->authorize('checkin', $accessory);

        $return_to = e($accessory_user->assigned_to);
        $logaction = $accessory->logCheckin(User::find($return_to), e(Input::get('note')));

        // Was the accessory updated?
        if (DB::table('accessories_users')->where('id', '=', $accessory_user->id)->delete()) {
            if (!is_null($accessory_user->assigned_to)) {
                $user = User::find($accessory_user->assigned_to);
            }

            $data['log_id'] = $logaction->id;
            $data['first_name'] = e($user->first_name);
            $data['last_name'] = e($user->last_name);
            $data['item_name'] = e($accessory->name);
            $data['checkin_date'] = e($logaction->created_at);
            $data['item_tag'] = '';
            $data['note'] = e($logaction->note);

            if ($backto=='user') {
                return redirect()->route("users.show", $return_to)->with('success', trans('admin/accessories/message.checkin.success'));
            }
            return redirect()->route("accessories.show", $accessory->id)->with('success', trans('admin/accessories/message.checkin.success'));
        }
        // Redirect to the accessory management page with error
        return redirect()->route('accessories.index')->with('error', trans('admin/accessories/message.checkin.error'));
    }


}
