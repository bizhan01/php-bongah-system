<?php

namespace App\Http\Controllers;

use App\Setting;
use Hamcrest\Core\Set;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use App\Http\Controllers\RoleManageController;

class SettingsController extends Controller
{

    public function general_show()
    {

        $system_settings_info = Setting::where('settings_name', 'General Settings')->get()->first();

        $data = json_decode($system_settings_info->content, true);

        return view('admin.settings.general')->with('settings', $data);

    }

    public function general_update(Request $request)
    {
        $request->validate([
            'company_name' => 'required',
            'company_logo' => 'image'
        ]);

        $setting_general = Setting::where('settings_name', 'General Settings')->get()->first();

        $setting_general_data = json_decode($setting_general->content, true);

        $company_new_logo = $setting_general_data['company_logo'];
        if ($request->hasFile('company_logo')) {

            if (!empty($setting_general->company_logo) and $setting_general->company_logo != 'upload/company-logo/e.png') {
                unlink($setting_general->company_logo); // Delete previous image file
            }
            $company_logo = $request->company_logo;
            $temporaryName = time() . $company_logo->getClientOriginalName();
            $company_logo->move("upload/company-logo", $temporaryName);
            $company_new_logo = 'upload/company-logo/' . $temporaryName;
        }

        $data = array(
            'company_name' => $request->company_name,
            'contract_person' => $request->contract_person,
            'email' => $request->email,
            'phone' => $request->phone,
            'address_1' => $request->address_1,
            'address_2' => $request->address_2,
            'city' => $request->city,
            'state' => $request->state,
            'zip_code' => $request->zip_code,
            'company_logo' => $company_new_logo,
        );

        $json_data = json_encode($data);
        $setting_general->content = $json_data;
        $setting_general->save();

        Session::flash('success', 'Successfully Update');

        return redirect()->back();

    }


//    settings/system
    public function system_show()
    {

        $system_settings_info = Setting::where('settings_name', 'System Settings')->get()->first();

        $data = json_decode($system_settings_info->content, true);

        return view('admin.settings.system')->with('settings', $data);
    }

    public function system_update(Request $request)
    {
        $setting_system = Setting::where('settings_name', 'System Settings')->get()->first();

        $data = array(
            'date_format' => $request->date_format,
            'timezone' => $request->timezone,
            'currency_code' => $request->currency_code,
            'currency_symbol' => $request->currency_symbol,
            'is_code' => $request->is_code,
            'currency_position' => $request->currency_position,
            'fixed_asset_schedule_starting_date' => date('Y-m-d', strtotime($request->fixed_asset_schedule_starting_date))
        );

        $json_data = json_encode($data);

        $setting_system->content = $json_data;
        $setting_system->save();

        Session::flash('success', 'Successfully Update');
        return redirect()->back();

    }

}
