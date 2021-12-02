<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class LessonsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('lessons')->delete();
        DB::table('lessons')->insert([
            'name' => 'Virtual trunking Protocol',
            'description' => 'Descripción laboratorio 1',
            'url' => 'https://www.cisco.com/c/en/us/support/docs/lan-switching/vtp/98154-conf-vlan.html',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('lessons')->insert([
            'name' => 'Switch port Analyzer/ Remote Switch Port Analyzer',
            'description' => 'Descripción laboratorio 2',
            'url' => 'https://www.cisco.com/c/en/us/support/docs/switches/catalyst-6500-series-switches/10570-41.html',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('lessons')->insert([
            'name' => 'First Hop Redundancy Protocols',
            'description' => 'Descripción laboratorio 3',
            'url' => 'https://www.cisco.com/c/en/us/td/docs/ios-xml/ios/ipapp_fhrp/configuration/xe-16/fhp-xe-16-book/fhp-hsrp-mgo.html',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('lessons')->insert([
            'name' => 'Dynamic Multipoint Virtual Private Network',
            'description' => 'Descripción laboratorio 4',
            'url' => 'https://www.cisco.com/c/en/us/td/docs/routers/access/cisco_router_and_security_device_manager/24/software/user/guide/DMVPN.html',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('lessons')->insert([
            'name' => 'Routing Redistribution',
            'description' => 'Descripción laboratorio 5',
            'url' => 'https://www.cisco.com/c/en/us/support/docs/ip/enhanced-interior-gateway-routing-protocol-eigrp/8606-redist.html',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
