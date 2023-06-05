<?php

namespace App\Admin\Controllers;

use App\Models\OneTimeCampaign;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\CampaignPatientDetails;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;

class OneTimeCampaignController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'One Time Campaign';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new OneTimeCampaign());

        $grid->column('id', __('Id'))->sortable();
        $grid->column('campaign_name', __('Campaign name'));
        $grid->column('active_date_time', __('Active date time'))->sortable();
        $grid->column('status', __('Status'))->display(function ($value) {
            return $value ? '<span style="color: green; font-weight:900; ">Active</span>' :
            '<span style="color: red; font-weight:900; ">Not Active</span>';
        });
        $grid->column('email_body', __('Email body'));
        $grid->column('sms_body', __('Sms body'));
        $grid->column('cd', __('Cd'))->sortable();

        $grid->model()->orderBy('id', 'desc');

        $grid->filter(function ($filter) {
            $filter->like('campaign_name', __('Campaign Name'));
        });

        $grid->filter(function ($filter) {
            $filter->like('active_date_time', __('Active Date Time'));
        });

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
        $show = new Show(OneTimeCampaign::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('campaign_id', __('Campaign id'));
        $show->field('campaign_name', __('Campaign name'));
        $show->field('active_date_time', __('Active date time'));
        $show->field('status', __('Status'));
        $show->field('email_body', __('Email body'));
        $show->field('sms_body', __('Sms body'));
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
        $form = new Form(new OneTimeCampaign());

        $campaignId = Str::uuid();
        $form->text('campaign_id', __('Campaign Id'))->readonly()->default($campaignId);
        $form->text('campaign_name', __('Campaign Name'))->rules('required');
        $form->datetime('active_date_time', __('Active date time'))->default(date('Y-m-d h:i A'))
     ->format('YYYY-MM-DD hh:mm A')
     ->rules('required');
        $form->switch('status', __('Status'))->default(0);

        $form->html('<br>');

        $form->radio('send_email','Send Email')
        ->options([
            1 =>'Yes',
            2 =>'No',
        ])->when(1, function ($form) {
            $form->textarea('email_body', __('Email Body'))->rules('required');
        })->when(1, function ($form) {
            $form->hidden();
        })->default(1);

        $form->html('<br>');

        $form->radio('send_sms','Send SMS')
        ->options([
            1 =>'Yes',
            2 =>'No',
        ])->when(1, function ($form) {
            $form->textarea('sms_body', __('SMS Body'))->rules('required');
        })->when(1, function ($form) {
            $form->hidden();
        })->default(1);        
        
        $form->hidden('cb', __('Cb'))->value(auth()->user()->name);
        $form->hidden('ub', __('Ub'))->value(auth()->user()->name);

        $form->html('<h4 class="alert alert-danger">The Excle file must be use 3 column <br> First column must be the <strong>Patient Name</strong><br>Second column must be the <strong>Mobile Number</strong><br>Third column must be the <strong>Email</strong><br>Must use the title in first row in your excle file</h4>'); 

        $form->file('file_upload', __('Upload CSV File'));

        $form->saving(function (Form $form) {
            $form->ignore('send_email');
            $form->ignore('send_sms');
            $file = $form->file_upload;
        
            if ($file instanceof UploadedFile) {
                $data = Excel::toArray([], $file);
        
                $campaign = OneTimeCampaign::create([                    
                    'campaign_id' => $form->campaign_id,
                    'campaign_name' => $form->campaign_name,
                    'active_date_time' => $form->active_date_time,
                    'status' => $form->status,
                    'email_body' => $form->email_body,
                    'sms_body' => $form->sms_body,
                ]);
        
                $isFirstRow = true; 
                foreach ($data[0] as $row) {
                    if ($isFirstRow) {
                        $isFirstRow = false;
                        continue;
                    }
                
                    $patientDetails = new CampaignPatientDetails();
                    $patientDetails->one_time_campaign_id = $campaign->id;
                    
                    if ($row[0] == null || $row[1] == null || $row[2] == null) {
                        $form->html('<h4 class="alert alert-danger">Please Make A Valid Input In CSV');     
                    }
                    
                    $patientDetails->patientname = $row[0];
                    $patientDetails->mobileno = $row[1];
                    $patientDetails->email = $row[2];
                    $patientDetails->save();
                }

            }
            return Redirect::to('/admin/one-time-campaign');
        });        

        return $form;
    }
}
