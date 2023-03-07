@extends('layouts.website.master')
@section('title','sea freight')
@section('content')
    <div class="air_freight">
        <div class="container">
            <div class="row">
                <div class="col-6">
                    <h3 class="mb-4 mt-3">Basic Shipping Services</h3>
                    <p>Sea freight is one of the important commercial shipping methods due to the
                        possibility of sending loads of various sizes and weights at reasonable and not
                        high costs. And it is a major pillar in the business of shipping and logistics services.
                        It has developed over time, and the import and dispatch mechanism has
                        become operationally and appropriately prepared for various shipments,
                        companies and professions, and in most countries and ports of the world.
                        International shipping lines are competing with each other in terms of services,
                        availability of stations and destinations, and costs as well. and here emerges the
                        role of the shipping company to be the main organizerand the careful follower of
                        the shipping process from the beginning of thepurchase decision until receipt in
                        the warehouse or the customer’sheadquarters. In this context, Turkey is one of the
                        developed countries and is logistically equipped with many ports and container
                        terminals linking the East and the West.
                        The great industrial renaissance and the escalating economic growth contributed
                        to the provision of an integrated and advanced infrastructure for shipping in Turkey.
                        Turkey suppliers has provided sea freight services within a series of services that
                        provide customers with ease in transporting their shipments from Istanbul and
                        Turkey to most countries of the world.</p>
                    <h3>sea ​​freight systems</h3>
                    <h4>Total freight (one container load)</h4>
                    <p> And it is one of the common, profitable and cost-competitive systems,
                        especially when shipping large quantities in size and weight, as well as
                        the possibility of loading from the warehouse of the supplier or sender
                        and unloading in the warehouse of the recipient in the country of destination.</p>
                    <h4>Partial freight (small combined loads)</h4>
                    <p>It is a system based on collecting customers' goods and shipments in our warehouses and then sending them within one common container. This method is suitable for small and medium shipments that are not urgent, as it saves costs, but increases the time of arrival and receipt.</p>
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
                            <input type="submit" value="Proceed to order">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="inquiries_and_quotes">
                            <h3>Inquiries and quotes</h3>
                            <p>To request assistance, please complete the following information and one of our representatives will contact you</p>
                            <div class="form-group">
                                <label>Email Address</label>
                                <input type="email" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Full Name</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Tel</label>
                                <div class="row">
                                    <div class="col-3">
                                        <input type="number" value="02" class="form-control">
                                    </div>
                                    <div class="col-4">
                                        <input type="number" value="010" class="form-control">
                                    </div>
                                    <div class="col-5">
                                        <input type="number" value="16409305" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>


@stop
