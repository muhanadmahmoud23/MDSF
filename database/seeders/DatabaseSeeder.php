<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Branch;
use App\Models\Company;
use App\Models\Scinvoice;
use Illuminate\Database\Seeder;
use Database\Factories\ScinvoiceFactory;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Scinvoice::factory(10)->create();

        Branch::truncate();
        $branches = [
            [
                'branch_code' => 1,
                'branch_appr' => 'CAI',
                'branch_name' => 'CAIRO',
                'to_sla'      => '@To_Sla_Cai',
                'branch_seq'  => 1,
            ], [
                'branch_code' => 2,
                'branch_appr' => 'ALX',
                'branch_name' => 'ALEX',
                'to_sla'      => '@TO_SLA_ALX',
                'branch_seq'  => 2,
            ], [
                'branch_code' => 3,
                'branch_appr' => 'MNS',
                'branch_name' => 'DELTA (B)',
                'to_sla'      => '@to_sla_man',
                'branch_seq'  => 4,
            ], [
                'branch_code' => 4,
                'branch_appr' => 'ISM',
                'branch_name' => 'CANAL',
                'to_sla'      => '@to_sla_ism',
                'branch_seq'  => 5,
            ], [
                'branch_code' => 5,
                'branch_appr' => 'AST',
                'branch_name' => 'MIDDLE EGYPT',
                'to_sla'      => '@to_sla_ast',
                'branch_seq'  => 6,
            ], [
                'branch_code' => 6,
                'branch_appr' => 'TNT',
                'branch_name' => 'DELTA (A)',
                'to_sla'      => '@to_sla_tan',
                'branch_seq'  => 3,
            ], [
                'branch_code' => 7,
                'branch_appr' => 'UPP',
                'branch_name' => 'UPPER EGYPT',
                'to_sla'      => '@to_sla_upp',
                'branch_seq'  => 7,
            ]
        ];

        Branch::insert($branches);

        Company::truncate();
        $company = [
            [
                'company_id'   => 100,
                'company_name' => 'FINE',
                'company_flag' => 1,
                'company_seq'  => 6,
            ],
            [
                'company_id'   => 15,
                'company_name' => 'BAT_GLO',
                'company_flag' => 1,
                'company_seq'  => 5,
            ],
            [
                'company_id'   => 14,
                'company_name' => 'BIC',
                'company_flag' => 1,
                'company_seq'  => 3,
            ],
            [
                'company_id'   => 13,
                'company_name' => 'ITG_loose_tobacoo',
                'company_flag' => 1,
                'company_seq'  => 4,
            ],
            [
                'company_id'   => 12,
                'company_name' => 'JTI',
                'company_flag' => 1,
                'company_seq'  => null,
            ],
            [
                'company_id'   => 11,
                'company_name' => 'Assal',
                'company_flag' => 0,
                'company_seq'  => null,
            ],
            [
                'company_id'   => 10,
                'company_name' => 'Hayat',
                'company_flag' => 0,
                'company_seq'  => null,
            ],
            [
                'company_id'   => 9,
                'company_name' => 'Mazaya',
                'company_flag' => 0,
                'company_seq'  => null,
            ],
            [
                'company_id'   => 8,
                'company_name' => 'ITG',
                'company_flag' => 0,
                'company_seq'  => 2,
            ],
            [
                'company_id'   => 7,
                'company_name' => 'VSPM',
                'company_flag' => 1,
                'company_seq'  => null,
            ],
            [
                'company_id'   => 6,
                'company_name' => 'Water',
                'company_flag' => 1,
                'company_seq'  => null,
            ],
            [
                'company_id'   => 5,
                'company_name' => 'BAT',
                'company_flag' => 1,
                'company_seq'  => 1,
            ],
            [
                'company_id'   => 4,
                'company_name' => 'EASTERN',
                'company_flag' => 1,
                'company_seq'  => null,
            ],
            [
                'company_id'   => 3,
                'company_name' => 'FORUM',
                'company_flag' => 1,
                'company_seq'  => null,
            ],
            [
                'company_id'   => 2,
                'company_name' => 'PM',
                'company_flag' => 1,
                'company_seq'  => null,
            ],
            [
                'company_id'   => 1,
                'company_name' => 'FOOD WS',
                'company_flag' => 1,
                'company_seq'  => null,
            ]
        ];

        Company::insert($company);
    }
}
