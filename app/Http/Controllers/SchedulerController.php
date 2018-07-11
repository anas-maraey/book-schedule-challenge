<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SchedulerController extends Controller
{

    /**
     * returns the form view
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function scheduleForm()
    {
        return view('schedule._form');
    }

    /**
     * @param Request $request
     * @return Schedule data
     */

    public function getSchedule(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'starting_date' => 'required',
            'sessions_per_chapter' => 'required',
            'week_days' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $starting_date = Carbon::parse( $request->get('starting_date'));
        $sessions_for_each_chapter = $request->get('sessions_per_chapter');
        $days_per_week = $request->get('week_days');

        if (! in_array($this->getDayNumberInWeek($starting_date->englishDayOfWeek), $days_per_week)){
            return redirect()->back()
                ->withErrors('Starting date must be one of week days you have selected!!')
                ->withInput();
        }

        // number of sessions to finish the 30 chapters
        $total_no_of_sessions = $sessions_for_each_chapter * 30;

        // number of weeks to finish the 30 chapters
        $num_of_weeks_to_finish = $total_no_of_sessions / count($days_per_week);

        $last_modified_date = $starting_date ;
        for ($weeks_iterator = 0; $weeks_iterator < $num_of_weeks_to_finish; $weeks_iterator++) {
            for ($days_iterator = 0; $days_iterator < count($days_per_week); $days_iterator++) {
                $day_name = $this->getDayName($days_per_week[$days_iterator]);
                $last_modified_date = $starting_date->modify("$day_name" );
                $schedule[] = $last_modified_date->getTimestamp();
            }
        }

        return view('schedule.schedule')->with('schedule', $schedule);
    }


    /**
     * @param $day_number
     * @return Day Name
     */
    public function getDayName($day_number)
    {
        $week_days = ['Saturday', 'Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'];
        return $week_days[$day_number];
    }

    /**
     * @param $day_name
     * @return Day number
     */
    public function getDayNumberInWeek($day_name)
    {
        $week_days = ['Saturday', 'Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'];
        return array_search($day_name, $week_days);
    }
}
