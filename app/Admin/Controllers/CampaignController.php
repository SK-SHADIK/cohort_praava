<?php

namespace App\Admin\Controllers;

use App\Models\Campaign;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;


class CampaignController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Campaign';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Campaign());

        $grid->column('id', __('Id'));
        $grid->column('campaign_name', __('Campaign_Name'));
        $grid->column('campaign_date', __('Campaign_Date'));
        $grid->cohortfk()->name('Cohort_Name');
        $grid->column('email_body', __('Email_Body'));
        $grid->column('text_body', __('Text_Tody'));
        $grid->column('cd', __('Cd'));

        $grid->model()->orderBy('id', 'desc');


        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(Campaign::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('campaign_id', __('Campaign id'));
        $show->field('campaign_name', __('Campaign name'));
        $show->field('campaign_date', __('Campaign date'));
        $show->cohortfk('Cohort_Name')->as(function ($content) {
            return $content->name;
        });
        $show->field('email_body', __('Email body'));
        $show->field('text_body', __('Text body'));
        $show->field('cb', __('Cb'));
        $show->field('cd', __('Cd'));
        $show->field('ub', __('Ub'));
        $show->field('ud', __('Ud'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Campaign());

        $campaignId = Str::uuid();
        $form->text('campaign_id', __('Campaign id'))->readonly()->default($campaignId);
        $form->text('campaign_name', __('Campaign name'))->rules('required');
        $form->datetime('campaign_date', __('Campaign date'))->default(date('Y-m-d H:i:s'))->rules('required');
        $cohorts = \App\Models\Cohort::where('is_active', true)->get();
        $options = [];
        $sendEmailfalg=[];
        $sendTextfalg=[];
        foreach ($cohorts as $cohort) {
            $options[$cohort->id] = $cohort->name;
            if ($cohort->send_email) {
                $sendEmailfalg[]=$cohort->id;
            }
            if ($cohort->send_text) {
                $sendTextfalg[]=$cohort->id;
            }
        }
        
        $form->select('cohort_id', __('Cohort_Name'))->options($options)
        ->when('in', $sendEmailfalg, function (Form $form) {
        
                $form->textarea('email_body', __('Email body'))->rules('required');
            
            })->when('in', $sendTextfalg, function (Form $form) {
        
                $form->textarea('text_body', __('Text body'))->rules('required');
            
            })->rules('required');
        
        
        $form->text('cb', __('Cb'))->readonly()->value(auth()->user()->name);
        $form->text('ub', __('Ub'))->readonly()->value(auth()->user()->name);
        
        
                
        return $form;
    }
}
