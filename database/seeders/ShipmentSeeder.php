<?php

namespace Database\Seeders;

use App\Models\ShipmentServices;
use Illuminate\Database\Seeder;

class ShipmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $shipment_serv = [
            ['id' => 1,'name' => 'Partial-shipping','detail' => 'From Turkey to the world, provides
partial shipping and
consolidation of shipments to reduce costs','image' => 'partial-shipping.png','basic_shipping_service' => 'Sea freight is one of the important commercial shipping methods due to the
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
Turkey to most countries of the world.'],
            ['id' => 2,'name' => 'Sea-Freight','detail' => 'Through Turkish ports, Turkey Supplier
provides sea container shipping
services to most countries of the world','image' => 'sean-freight.png','basic_shipping_service' => 'Sea freight is one of the important commercial shipping methods due to the
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
Turkey to most countries of the world.'],
            ['id' => 3,'name' => 'Air-Freight','detail' => 'From Turkey to the World Turkey Supplier
provides the necessary supply
for your business via air freight','image' => 'air-freight.png','basic_shipping_service' => 'The air freight system in Turkey is one of the advanced and important shipping systems
that provide the customer with effective options for importing from Turkey.
And the importance of air freight in Turkey emerges not only from shortening the arrival
time, but also from the fact that the service is effective for different quantities and sizes
and at competitive and relatively appropriate costs than other countries in the world.
Turkey       s airports have been equipped with modern cargo systems and advanced
technologies that have greatly helped in the growth of this sector in recent years.
    Turkey suppliers in Turkey, as one of the shipping companies in Istanbul, specialized in
air freight operations, and through its experience it was a companion to its customers,
contributing to facilitating the movement of cargo and goods between Turkey and their countries'],
        ];

        foreach ($shipment_serv as $serv){
            $shipment = ShipmentServices::create($serv);
        }
    }
}
