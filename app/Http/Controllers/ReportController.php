<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use View;
use Route;

use Carbon\Carbon;
use App\Account;
use App\User;
use App\Event;
use App\Resource;
use App\Group;
use App\RentResource;

class ReportController extends Controller
{
    public function newusers(Request $request)
    {
        $report = (object) $this->report;

        $data = $request->all();
        
        $report->title = "New members";
        $report->description = "";

        if (array_key_exists('startDate', $data) && array_key_exists('endDate', $data)){
            $start = $data['startDate'];
            $end = $data['endDate'];
            $graphInterval = strtolower($data['graphInterval']);

            $report->data = [
                'url' => url('reports/newusers.tsv', [Carbon::parse($start)->toDateString(), Carbon::parse($end)->toDateString(), $graphInterval]),
                'x' => 'date',
                'y' => 'members'
            ];

        }

        $fields = [
            // 'username' => (object)['type' => 'text', 'autocomplete' => 'users.json', 'description' => 'Hello world'],
            'startDate' => (object)['type' => 'date', 'description' => 'What date do you want to begin monitoring new members?'],
            'endDate' => (object)['type' => 'date', 'description' => 'What date do you want to end monitoring new members?'],
            'graphInterval' => (object)['type' => 'graph', 'description' => 'Do you want to see the graph entries per day, week, or month?'],
        ];

    	return View::make('reports.show', ['report' => $report, 'fields' => $fields, 'data' => $data]);
    }

    public function newusers_data($start, $end, $graph_interval){
        $start = Carbon::parse($start);
        $end = Carbon::parse($end);

        
        print "date\tmembers\r\n";

        for ($currentTime = $start; $currentTime <= $end; $this->advance($start, $graph_interval)){
            $endTime = $currentTime->copy();
            $this->advance($endTime, $graph_interval);
            $users = User::where('created_at', '>=', $currentTime)->where('created_at', '<', $endTime)->get();
            print $this->label($currentTime, $graph_interval) . "\t" . count($users) . "\r\n";
        }
    }

    private function advance($carbon, $graph_interval){
        switch($graph_interval){
            case 'day':
            $carbon->addDay();
            break;
            case 'week';
            $carbon->addWeek();
            break;
            case 'month';
            $carbon->addMonth();
            break;
        }
    }

    private function label($carbon, $graph_interval){
        switch($graph_interval){
            case 'day':
            return date('Y-m-d', $carbon->timestamp);
            break;
            case 'week';
            return date('Y-m-d', $carbon->timestamp);
            break;
            case 'month';
            return date('F Y', $carbon->timestamp);
            break;
        }
        
    }

    public function inactive_members(Request $request)
    {
        // redirect to list of accounts that are inactive
    	return view('accounts.inactive', ['accounts' => Account::where('status', 'Inactive')->get(), 'inactive' => true]);
    }


    public function user_activity_of_group(Request $request)
    {
        $report = (object) $this->report;

        $data = $request->all();
        
        $report->title = "Activity of users in a group";
        $report->description = "";

        if (array_key_exists('startDate', $data) && array_key_exists('endDate', $data) && array_key_exists('group', $data)){
            $start = $data['startDate'];
            $end = $data['endDate'];

            $group = $data['group'];
            $group_id = Group::where('name', $group)->first()->id;

            $report->data = [
                'url' => url('reports/user_activity_of_group.tsv', [Carbon::parse($start)->toDateString(), Carbon::parse($end)->toDateString(), $group_id]),
                'x' => 'user',
                'y' => 'activity'
            ];

        }

        $fields = [
            'group' => (object)['type' => 'text', 'autocomplete' => 'groups.json', 'description' => 'What group do you want to monitor?'],
            'startDate' => (object)['type' => 'date', 'description' => 'What date do you want to begin monitoring user activity?'],
            'endDate' => (object)['type' => 'date', 'description' => 'What date do you want to end monitoring user activity?']
        ];


    	return View::make('reports.show', ['report' => $report, 'fields' => $fields, 'data' => $data]);
    }

    public function user_activity_of_group_data($start, $end, $group_id)
    {
        $start = Carbon::parse($start);
        $end = Carbon::parse($end);

        print "user" . "\t";
        print "activity" . "\t";
        print "\r\n";


        $group = Group::find($group_id);

        
        $accounts = $group->accounts;

        $users = array();
        foreach ($accounts as $account){
            $users = array_merge($users, $account->users->toArray());
        }

        foreach ($users as $user){
            $activity = RentResource::where('start_time', '>=', $start)
                                    ->where('end_time', '<=', $end)
                                    ->where('user_id', $user['id'])
                                    ->get();

            print $user['name'] . "\t" . count($activity) . "\r\n";
        }
    }


    public function club_share_transfers(Request $request)
    {

    	return redirect()->action('AccountController@report_listings');
    }


    public function facility_usage(Request $request)
    {
        $report = (object) $this->report;

        $data = $request->all();
        
        $report->title = "Frequency of facility usage by type";
        $report->description = "";


        if (array_key_exists('startDate', $data) && array_key_exists('endDate', $data) && array_key_exists('facilityType', $data)){
            $start = $data['startDate'];
            $end = $data['endDate'];

            $facilityType = $data['facilityType'];

            $report->data = [
                'url' => url('reports/facility_usage.tsv', ['start' => Carbon::parse($start)->toDateString(), 'end' => Carbon::parse($end)->toDateString(), 'facilityType' => $facilityType]),
                'x' => 'facility',
                'y' => 'usage'
            ];

        }

        $fields = [
            'facilityType' => (object)['type' => 'text', 'description' => 'What types of facility do you wish to monitor (e.g. golf, sports)? Note that this field is optional. If you leave this blank, it will search for facilities with unspecified type only.', 'autocomplete' => 'resource_types.json'],
            'startDate' => (object)['type' => 'date', 'description' => 'What date do you want to begin monitoring facility usage?'],
            'endDate' => (object)['type' => 'date', 'description' => 'What date do you want to end monitoring facility usage?']
        ];

    	return View::make('reports.show', ['report' => $report, 'fields' => $fields, 'data' => $data]);
    }

    public function facility_usage_data($start, $end, $facility_type = '')
    {
        $start = Carbon::parse($start);
        $end = Carbon::parse($end);

        print "facility" . "\t";
        print "usage"    . "\t";
        print "\r\n";

        $facilities = Resource::where('type', $facility_type)->get();

        foreach ($facilities as $facility){
            $activity = RentResource::where('start_time', '>=', $start)
                                    ->where('start_time', '<', $end)
                                    ->where('resource_id', $facility->id)
                                    ->get();

            print $facility->name . "\t" . count($activity) . "\r\n";
        }
    }


    public function user_activity_within_event(Request $request)
    {
        $report = (object) $this->report;

        $data = $request->all();
        
        $report->title = "User activity during an event";
        $report->description = "";


        if (array_key_exists('user', $data) && array_key_exists('event', $data) && array_key_exists('facilityType', $data)){
            $user = User::where('name', $data['user'])->first()->id;
            $event = Event::where('name', $data['event'])->first()->id;

            $facilityType = $data['facilityType'];

            $graphInterval = strtolower($data['graphInterval']);

            $report->data = [
                'url' => url('reports/user_activity_within_event.tsv', ['user' => $user, 'event' => $event, $graphInterval, 'facilityType' => $facilityType]),
                'x' => 'day',
                'y' => 'activity'
            ];

        }

        $fields = [
            'user' => (object)['type' => 'text', 'autocomplete' => 'users.json', 'description' => 'This activity of the user specified in this field will be presented in the report.'],
            'event' => (object)['type' => 'text', 'autocomplete' => 'events.json', 'description' => 'This is name of the event you wish to see a correlation to.'],
            'facilityType' => (object)['type' => 'text', 'autocomplete' => 'resource_types.json', 'description' => 'The activity is based on faciltiies. What types of facility do you wish to monitor (e.g. golf, sports)? Note that this field is optional. If you leave this blank, it will search for facilities with unspecified type only.'],
            'graphInterval' => (object)['type' => 'graph', 'description' => 'Do you want to see the graph entries per day, week, or month?'],
        ];

    	return View::make('reports.show', ['report' => $report, 'fields' => $fields, 'data' => $data]);
    }

    public function user_activity_within_event_data($user, $event, $graph_interval, $facility_type = '')
    {
        print "day"         . "\t";
        print "activity"    . "\t";
        print "\r\n";

        $user = User::find($user);
        $event = Event::find($event);

        $start = Carbon::parse($event->start_date);
        $end = Carbon::parse($event->end_date);

        $validResources = Resource::where('type', $facility_type)->get()->map(function ($item, $key){
            return $item->id;
        });

        for ($currentTime = $start; $currentTime <= $end; $this->advance($currentTime, $graph_interval)){
            $endTime = $currentTime->copy();
            $this->advance($endTime, $graph_interval);
            $activity = RentResource::where('start_time', '>=', $currentTime)
                                    ->where('start_time', '<', $endTime)
                                    ->where('user_id', $user->id)
                                    ->whereIn('resource_id', $validResources)
                                    ->get();
            print $this->label($currentTime, $graph_interval) . "\t" . count($activity) . "\r\n";
        }
    }

    public function graph_options(){
        return json_encode(['day', 'week', 'month']);
    }

    public function __construct()
    {
        $this->report = (object) array();
    }
}
