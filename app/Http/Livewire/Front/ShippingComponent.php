<?php

namespace App\Http\Livewire\Front;

use App\Models\Company;
use App\Models\ShipmentOrderNew;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithFileUploads;
use RealRashid\SweetAlert\Facades\Alert;

class ShippingComponent extends Component
{
    use WithFileUploads;
    use LivewireAlert;
    // public $shipment_services_id , $company_id;
    public $company_id,$shipment_name,$shipment_type;
    public $unit,$length=0,$width=0,$height=0,$dimensional_weight;
    public $weightunit,$weight=0,$cweight=0,$net_weight;
    public $clength=0,$cwidth=0,$cheight=0;
    public $package_no,$destination;
    public $name,$email,$code,$phone,$companyname;
    public $vendorname,$vendoremail,$vendorphone,$vendoraddress,$country,$vendorId,$vendor,$file,$details;
    public function rules(){
        return [
            'shipment_name' => 'nullable',
            'shipment_type' => 'nullable',
            'unit' => 'nullable',
            'length' => 'nullable',
            'width' => 'nullable',
            'height' => 'nullable',
            'dimensional_weight' => 'nullable',
            'weightunit' => 'nullable',
            'weight' => 'nullable',
            'package_no' => 'nullable',
            'destination' => 'nullable',
            'details' => 'nullable',
            'name' => 'required',
            'companyname' => 'nullable',
            'code' => 'nullable',
            'phone' => 'required_without:email',
            'email' => 'required_without:phone',

            'country' => 'nullable',
            'vendorname' => 'nullable',
            // 'vendoraddress' => 'nullable',
            'vendorphone' => 'nullable',
            'vendoremail' => 'nullable',
            'file' => 'nullable',

        ];
    }
    public function ValidationAttributes(){
        return [
            'shipment_name' => trans('custom.shipping_way'),
            'shipment_type' => trans('custom.receiving_from_the_supplier'),
            'unit' => trans('custom.input_unit'),
            'length' => trans('custom.length'),
            'width' => trans('custom.width'),
            'height' => trans('custom.height'),
            'dimensional_weight' => trans('custom.dimensional_weight'),
            'weightunit' => trans('custom.weight_unit'),
            'weight' => trans('custom.package_weight'),
            'package_no' => trans('custom.number_of_packages'),
            'destination' => trans('custom.shipment_destination'),
            'details' => trans('custom.details'),
            'name' => trans('custom.your_name'),
            'companyname' => trans('custom.your_comapny'),
            // 'code' => 'required',
            'phone' => trans('custom.tel'),
            'email' => trans('custom.email'),
            'country' => trans('custom.country'),
            'vendorname' => trans('custom.supplier_name'),
            'vendorphone' => trans('custom.supplier_phone'),
            'vendoremail' => trans('custom.supplier_email'),
            'file' => trans('custom.upload_your_files'),
        ];
    }

    public function submit()
    {
        // try{
        $this->validate();
        $ship =ShipmentOrderNew::create([
            "company_id"         => Auth::guard('company')->user()->id ?? null,
            "shipment_name"      => $this->shipment_name ?? '',
            "shipment_type"      => $this->shipment_type ?? '',
            "unit"               => $this->unit ?? '',
            "length"             => $this->length,
            "width"              => $this->width,
            "height"             => $this->height,
            "dimensional_weight" => $this->dimensional_weight,
            "weightunit"         => $this->weightunit ?? '',
            "weight"             => $this->weight,
            "package_no"         => $this->package_no,
            "destination"        => $this->destination,

            "name"               => $this->name,
            "companyname"        => $this->companyname,
            "code"               => $this->code,
            "phone"              => $this->phone,
            "email"              => $this->email,

            'country'            => $this->country,
            'vendorname'         => $this->vendorname,
            'vendorphone'        => $this->vendorphone,
            'vendoremail'        => $this->vendoremail,
            'details'            => $this->details,
        ]);
        if($this->file){
            $ship->update([
                'file'  => $this->file->store('uploads','public'),
            ]);
        }
        $this->alert('success', __('custom.shippingsms'),[
            'position' => 'center',
            'timer' => 3000,
            // 'toast' => true,
        ]);
        // $this->resetForm();
    // }
    // catch(\Exception $e){
    //     return redirect()->back()->with('error',$e->getMessage());
    // }
    }
    public function mount(){
        $this->name = Auth::guard('company')->user()->name ??null;
        $this->companyname = Auth::guard('company')->user()->name ??null;
        $this->code = Auth::guard('company')->user()->cod ??null;
        $this->phone = Auth::guard('company')->user()->phone ??null;
        $this->email = Auth::guard('company')->user()->email ??null;
        // $this->net_weight = $this->cweight > $this->dimensional_weight ? 'الوزرن الفعلى':'الوزن الحجمى';
    }
    public function render()
    {
        $vendors = Company::where('trade_role','seller')->get();
        return view('livewire.front.shipping-component',compact('vendors'));

    }

    public function resetForm(){
        $this->reset();
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function calculateNet()
    {
        if($this->unit =='m'){
            $this->clength = (float)$this->length * 100 ?? null;
            $this->cwidth  = (float)$this->width  * 100 ?? null;
            $this->cheight = (float)$this->height * 100 ?? null;
        }elseif($this->unit =='insh'){
            $this->clength = (float)$this->length * 2.54 ?? null;
            $this->cwidth  = (float)$this->width  * 2.54 ?? null;
            $this->cheight =(float)$this->height * 2.54 ?? null;
        }elseif($this->unit =='yard'){
            $this->clength = (float)$this->length * 91.44 ?? null;
            $this->cwidth  = (float)$this->width  * 91.44 ?? null;
            $this->cheight = (float)$this->height * 91.44 ?? null;
        }else{
            $this->clength = (float)$this->length ?? null;
            $this->cwidth  = (float)$this->width  ?? null;
            $this->cheight = (float)$this->height ?? null;
        }

        if($this->shipment_name == 'air_freight'){
            $this->dimensional_weight = ((float)$this->clength * (float)$this->cwidth * (float)$this->cheight) / 6000  ?? null;
        }elseif($this->shipment_name == 'sea_freight'){
            $this->dimensional_weight = ((float)$this->clength * (float)$this->cwidth * (float)$this->cheight) /1000000 ?? null;
        }else{
            $this->dimensional_weight = '0.00';
        }
    }

    public function calculateWeight()
    {
        if($this->weightunit =='pound'){
            $this->cweight = (float)$this->weight * 0.45359 ?? null;
        }elseif($this->weightunit =='ounce'){
            $this->cweight = (float)$this->weight * 0.0283495 ?? null;
        }elseif($this->weightunit =='g'){
            $this->cweight = (float)$this->weight * 1000 ?? null;
        }else{
            $this->cweight = (float)$this->weight ?? null;
        }
    }
    // public function getVendor(){
    //     if ($this->vendorId !='') {
    //         $this->vendor = Company::where('trade_role','seller')->whereId($this->vendorId)->first();
    //         $this->vendorname  = $this->vendor->name;
    //         $this->vendorphone = $this->vendor->phone;
    //         $this->vendoremail = $this->vendor->email;
    //     }
    // }
}
