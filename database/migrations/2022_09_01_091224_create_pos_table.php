<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pos', function (Blueprint $table) {
            $table->integer('ter_id');
            $table->integer('pos_id');
            $table->text('name');
            $table->integer('build_no');
            $table->integer('str_id');
            $table->text('str_name');
            $table->text('zip_code')->nullable();
            // $table->text('old_phone')->nullable();
            // $table->text('fax')->nullable();
            // $table->text('contact');
            // $table->integer('LMIDC');
            // $table->integer('handling');
            // $table->integer('cat_id');
            // $table->text('class');
            // $table->integer('status');
            // $table->text('enabled');
            // $table->timestamp('entry_date');
            // $table->integer('dc_id');
            // $table->integer('user_id');
            // $table->date('updated_date');
            // $table->integer('cig');
            // $table->integer('touristic');
            // $table->integer('location')->nullable();
            // $table->integer('steet_path')->nullable();
            // $table->integer('act_month')->nullable();
            // $table->integer('pos_fin_class')->nullable();
            // $table->integer('air_conditioned')->nullable();
            // $table->integer('pos_size')->nullable();
            // $table->integer('cig_pct')->nullable();
            // $table->integer('way')->nullable();
            // $table->integer('closed_day')->nullable();
            // $table->integer('gas_station_ownership')->nullable();
            // $table->integer('service')->nullable();
            // $table->integer('survey_type')->nullable();
            // $table->integer('census_rep_id')->nullable();
            // $table->date('census_visit_date')->nullable();
            // $table->integer('census_visit_seq')->nullable();
            // $table->text('pos_census_code')->nullable();
            // $table->text('pos_owner');
            // $table->text('pos_type');
            // $table->text('pos_place');
            // $table->integer('pos_total_qty')->nullable();
            // $table->text('have_branches')->nullable();
            // $table->text('using_computer')->nullable();
            // $table->text('sales_reports')->nullable();
            // $table->integer('branches_cnt')->nullable();
            // $table->text('custmoer_reports')->nullable();
            // $table->integer('warehouses_cnt')->nullable();
            // $table->integer('warehouses_area')->nullable();
            // $table->text('have_vans')->nullable();
            // $table->integer('van_loads')->nullable();
            // $table->integer('sales_reps')->nullable();
            // $table->integer('pos_start_year')->nullable();
            // $table->integer('mrl_place')->nullable();
            // $table->text('deliver_to_cut')->nullable();
            // $table->text('ready_to_deliver')->nullable();
            // $table->text('have_routes')->nullable();
            // $table->integer('custmoer_cnt')->nullable();
            // $table->integer('delivery_avg')->nullable();
            // $table->integer('ka')->nullable();
            // $table->integer('best_50_prcnt_stock')->nullable();
            // $table->integer('city')->nullable();
            // $table->integer('grp')->nullable();
            // $table->text('merchendising')->nullable();
            // $table->text('display')->nullable();
            // $table->integer('ceiling_height')->nullable();
            // $table->text('signed_pos')->nullable();
            // $table->text('bat_material')->nullable();
            // $table->integer('layer')->nullable();
            // $table->integer('loc_quality')->nullable();
            // $table->integer('size_quality')->nullable();
            // $table->integer('lay_quality')->nullable();
            // $table->integer('new')->nullable();
            // $table->text('quality')->nullable();
            // $table->string('hashtargets')->nullable();
            // $table->text('signs')->nullable();
            // $table->integer('exc')->nullable();
            // $table->text('special')->nullable();
            // $table->text('sign_pos_revised')->nullable();
            // $table->text('lm')->nullable();
            // $table->text('merit')->nullable();
            // $table->text('jumpo')->nullable();
            // $table->text('leff')->nullable();
            // $table->text('lelts')->nullable();
            // $table->integer('balance')->nullable();
            // $table->text('remote')->nullable();
            // $table->integer('acc_id')->nullable();
            // $table->text('action')->nullable();
            // $table->text('trans_flag')->nullable();
            // $table->integer('range')->nullable();
            // $table->integer('tradeseg_layer_id')->nullable();
            // $table->integer('tradeblock_layer_id')->nullable();
            // $table->text('segmented_flag')->nullable();
            // $table->text('expansion_flag')->nullable();
            // $table->text('block')->nullable();
            // $table->integer('creditlimit')->nullable();
            // $table->integer('creditdays')->nullable();
            // $table->integer('creditbalance')->nullable();
            // $table->text('payer_id')->nullable();
            // $table->integer('classes')->nullable();
            // $table->text('formula')->nullable();
            // $table->integer('brackets')->nullable();
            // $table->dateTime('psh_tm_route_assign')->nullable();
            // $table->text('land_mark')->nullable();
            // $table->text('key_acc_type')->nullable();
            // $table->text('kind')->nullable();
            // $table->integer('grp_id')->nullable();
            // $table->text('group_name')->nullable();
            // $table->text('ws_inc_type_desc')->nullable();
            // $table->text('ws_inc_type_name')->nullable();
            // $table->text('new_quality')->nullable();
            // $table->text('pos_code')->nullable();
            // $table->integer('on_route')->nullable();
            // $table->text('quality_test')->nullable();
            // $table->text('new_quality_1')->nullable();
            // $table->text('comments')->nullable();
            // $table->text('ewd')->nullable();
            // $table->text('quality_ka')->nullable();
            // $table->text('map_class')->nullable();
            // $table->text('seg_class')->nullable();
            // $table->text('social_class')->nullable();
            // $table->integer('old_mobile')->nullable();
            // $table->text('mobile')->nullable();
            // $table->text('block_class')->nullable();
            // $table->text('phone')->nullable();
            // $table->text('district')->nullable();
            // $table->text('sub_district')->nullable();
            // $table->text('longitude')->nullable();
            // $table->text('latitude')->nullable();
            // $table->text('seg_class_test')->nullable();
            // $table->integer('isd_flag')->nullable();
            // $table->integer('layer_new')->nullable();
            // $table->text('pos_location')->nullable();
            // $table->text('inc_prog')->nullable();
            // $table->integer('census_2012')->nullable();
            // $table->text('coverd_by_pt')->nullable();
            // $table->text('sales_supervisor_validation')->nullable();
            // $table->text('soc_blok_class')->nullable();
            // $table->text('soc_blok_seg_class')->nullable();
            // $table->text('bse')->nullable();
            // $table->integer('exc_ka')->nullable();
            // $table->text('new_exc')->nullable();
            // $table->integer('branch_code')->nullable();
            // $table->integer('exc_type')->nullable();
            // $table->integer('oor_sp')->nullable();
            // $table->integer('fri_sp_oor')->nullable();
            // $table->integer('sap_ka')->nullable();
            // $table->text('gained_pos')->nullable();
            // $table->integer('pricelist_id')->nullable();
            // $table->integer('bat_id')->nullable();
            // $table->integer('bat_prog')->nullable();
            // $table->date('bat_update_date')->nullable();
            // $table->integer('bat_id_old')->nullable();
            // $table->integer('bat_prog_old')->nullable();
            // $table->text('abdelwahed_tp_pos')->nullable();
            // $table->integer('census_2019')->nullable();
            // $table->text('census_2019_code')->nullable();
            // $table->integer('active_credit_limit')->nullable();
            // $table->integer('actove_credit_period')->nullable();
            // $table->text('comm_reg_no')->nullable();
            // $table->text('vat_reg_no')->nullable();
            // $table->text('national_id')->nullable();
            // $table->text('gov')->nullable();
            // $table->integer('man_cat_id')->nullable();
            // $table->integer('fine_cat_id')->nullable();
            // $table->text('fine_pos_code')->nullable();
            // $table->integer('change_ter_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pos');
    }
};
