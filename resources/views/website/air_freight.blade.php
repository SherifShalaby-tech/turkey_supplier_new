@extends('layouts.website.master')
@section('title','air freight')
@section('content')
    <div class="air_freight">
        <div class="container">
            <div class="row">
                <div class="col-6">
                    <h3 class="mb-4 mt-3">Basic Shipping Services</h3>
                    <p>The air freight system in Turkey is one of the advanced and important shipping systems
                        that provide the customer with effective options for importing from Turkey.
                        And the importance of air freight in Turkey emerges not only from shortening the arrival
                        time, but also from the fact that the service is effective for different quantities and sizes
                        and at competitive and relatively appropriate costs than other countries in the world.
                        Turkey's airports have been equipped with modern cargo systems and advanced
                        technologies that have greatly helped in the growth of this sector in recent years.
                        Turkey suppliers in Turkey, as one of the shipping companies in Istanbul, specialized in
                        air freight operations, and through its experience it was a companion to its customers,
                        contributing to facilitating the movement of cargo and goods between Turkey and their countries</p>
                </div>
                <div class="col-6 mt-5">
                    <img class="img-thumbnail" src="{{asset('website/imgs/shipping/air_freight.png')}}" width="70%">
                </div>
            </div>
        </div>
    </div>
    <div class="air_freight_form text-center">
        <div class="container">
            <form>
                <div class="row">
                    <div class="col-6">
                        <div class="shipment_order">
                            <h3>Shipment order</h3>
                            <p>To request a shipment order, please enter the dimensions of the shipment to be shipped via Turkey Supplier</p>
                            <h4>Dimensions</h4>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-4">
                                        <label>Long</label>
                                    </div>
                                    <div class="col-4">
                                        <label>M</label>
                                        <select class="form-control"></select>
                                    </div>
                                    <div class="col-4">
                                        <label>C</label>
                                        <select class="form-control"></select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-4">
                                        <label>High</label>
                                    </div>
                                    <div class="col-4">
                                        <label>M</label>
                                        <select class="form-control"></select>
                                    </div>
                                    <div class="col-4">
                                        <label>C</label>
                                        <select class="form-control"></select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-4">
                                        <label>Wide</label>
                                    </div>
                                    <div class="col-4">
                                        <label>M</label>
                                        <select class="form-control"></select>
                                    </div>
                                    <div class="col-4">
                                        <label>C</label>
                                        <select class="form-control"></select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group text-left">
                                <label>Shipment type</label>
                                <select class="form-control">
                                    <option>Food & Beveaige</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="inquiries_and_quotes">
                            <h3>Inquiries and quotes</h3>
                            <p>To request assistance, please complete the following information and one of our representatives will contact you</p>
                            <div class="form-group">
                                <label>Email Address</label>
                                <input name="email" type="email" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Full Name</label>
                                <input name="full_name" type="text" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Tel</label>
                                <div class="row">
                                    <div class="col-3">
                                        <input name="phone1" type="number" value="02" class="form-control">
                                    </div>
                                    <div class="col-4">
                                        <input name="phone2" type="number" value="010" class="form-control">
                                    </div>
                                    <div class="col-5">
                                        <input name="phone3" type="number" value="16409305" class="form-control">
                                    </div>
                                    <input type="submit" value="Proceed to order">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>


@stop
