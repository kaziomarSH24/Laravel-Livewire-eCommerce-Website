<?php

namespace App\Http\Livewire\Admin;

use App\Models\Setting;
use Livewire\Component;

class AdminSettingComponent extends Component
{

    public $email;
    public $phone1;
    public $phone2;
    public $address;
    public $map;
    public $twitter;
    public $facebook;
    public $pinterest;
    public $instagram;
    public $youtube;

    public function mount()
    {
        $setting = Setting::find(1);
        if($setting){
            $this->email =  $setting->email;
            $this->phone1    =  $setting->phone1;
            $this->phone2    =  $setting->phone2;
            $this->address    =  $setting->address;
            $this->map    =  $setting->map;
            $this->twitter    =  $setting->twitter;
            $this->facebook    =  $setting->facebook;
            $this->pinterest    =  $setting->pinterest;
            $this->instagram    =  $setting->instagram;
            $this->youtube    =  $setting->youtube;
        }
    }

    public function updated($fields)
    {
        $this->validateOnly($fields,[
            'email' => 'required|email',
             'phone1' => 'required|numeric',
             'phone2' => 'required|numeric',
             'address' => 'required',
             'map' => 'required',
             'twitter' => 'required',
             'facebook' => 'required',
             'pinterest' => 'required',
             'instagram' => 'required',
             'youtube' => 'required',
        ]);
    }

    public function saveSetting()
    {
        $this->validate([
             'email' => 'required|email',
             'phone1' => 'required|numeric',
             'phone2' => 'required|numeric',
             'address' => 'required',
             'map' => 'required',
             'twitter' => 'required',
             'facebook' => 'required',
             'pinterest' => 'required',
             'instagram' => 'required',
             'youtube' => 'required',
        ]);
        $setting = Setting::find(1);
        if(!$setting){
            $setting = new Setting();
             $setting->email = $this->email;
             $setting->phone1 = $this->phone1;
             $setting->phone2 = $this->phone2;
             $setting->address = $this->address;
             $setting->map = $this->map;
             $setting->twitter = $this->twitter;
             $setting->facebook = $this->facebook;
             $setting->pinterest = $this->pinterest;
             $setting->instagram = $this->instagram;
             $setting->youtube = $this->youtube;
             $setting->save();
             $this->dispatchBrowserEvent('toastr',['type' => 'Success','message' => 'Settings has been added successfully!']);
        }else{
            $setting->email = $this->email;
             $setting->phone1 = $this->phone1;
             $setting->phone2 = $this->phone2;
             $setting->address = $this->address;
             $setting->map = $this->map;
             $setting->twitter = $this->twitter;
             $setting->facebook = $this->facebook;
             $setting->pinterest = $this->pinterest;
             $setting->instagram = $this->instagram;
             $setting->youtube = $this->youtube;
             $setting->save();
             $this->dispatchBrowserEvent('toastr',['type' => 'Success','message' => 'Settings has been updated successfully!']);
        }
    }

    public function render()
    {
        return view('livewire.admin.admin-setting-component')->layout('layouts.base');
    }
}
