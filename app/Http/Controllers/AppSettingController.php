<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AppSetting;
use Brian2694\Toastr\Facades\Toastr;

class AppSettingController extends Controller
{
    /**
     * Show the form for editing the settings.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $settings = AppSetting::firstOrCreate([]);
        return view('admin.settings.edit', compact('settings'));
    }

    /**
     * Update the settings in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $settings = AppSetting::firstOrCreate([]);

        $request->validate([
            'brand_name' => 'required|string|max:255',
            'navbar_color' => 'required|string|max:7',
            'header_color' => 'required|string|max:7',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'social_youtube' => 'nullable|url|max:255',
            'social_facebook' => 'nullable|url|max:255',
            'social_community' => 'nullable|url|max:255',
            'social_messenger' => 'nullable|url|max:255',
            'booking_money' => 'required|integer|min:0',
            'service_charge' => 'required|integer|min:0',
            'payout_method' => 'required|in:bkash_nagad,bank,cellfin,myprime,nexuspay',
            'balance_view' => 'required|in:hold,open',
            'advertise_enabled' => 'nullable|boolean',
            'advertise_default_point' => 'required|integer|min:0',
            'advertise_default_status' => 'required|in:active,inactive',
        ]);

        $settings->brand_name = $request->brand_name;
        $settings->navbar_color = $request->navbar_color;
        $settings->header_color = $request->header_color;
        $settings->social_youtube = $request->social_youtube;
        $settings->social_facebook = $request->social_facebook;
        $settings->social_community = $request->social_community;
        $settings->social_messenger = $request->social_messenger;
        $settings->booking_money = $request->booking_money;
        $settings->service_charge = $request->service_charge;
        $settings->payout_method = $request->payout_method;
        $settings->balance_view = $request->balance_view;
        $settings->advertise_enabled = $request->boolean('advertise_enabled');
        $settings->advertise_default_point = $request->advertise_default_point;
        $settings->advertise_default_status = $request->advertise_default_status;

        if ($request->hasFile('logo')) {
            $image = $request->file('logo');
            $imageName = 'logo_' . time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('uploads/branding');

            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }

            if ($settings->logo) {
                $oldLogoPath = public_path($settings->logo);
                if (file_exists($oldLogoPath)) {
                    @unlink($oldLogoPath);
                }
            }

            $image->move($destinationPath, $imageName);
            $settings->logo = 'uploads/branding/' . $imageName;
        }

        $settings->save();

        Toastr::success('Application Settings Updated Successfully!', '', ["progressbar" => true]);
        return redirect()->back();
    }
}
