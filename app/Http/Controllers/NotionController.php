<?php

namespace App\Http\Controllers;

use FiveamCode\LaravelNotionApi\Notion;
use FiveamCode\LaravelNotionApi\Query\Filters\Filter;
use FiveamCode\LaravelNotionApi\Query\Filters\FilterBag;
use FiveamCode\LaravelNotionApi\Query\Filters\Operators;
use Illuminate\Http\Request;

class NotionController extends Controller
{
    protected $notionClient;
    public function __construct()
    {
        $this->notionClient = new Notion('secret_K2hmJUXXFROQeGZz0HYWojAuy1mrySKc4GXdVmLHQ4V');
    }

    public function index(Request $request)
    {
         $todayOnly = filter_var($request->get('today_only'), FILTER_VALIDATE_BOOLEAN);
         $today = date('Y-m-d');
         $databaseId = '07b5a0a6a71d46be8dbbce3a71e35395';
         if ($todayOnly) {
             $filter = Filter::rawFilter('Round 1', [
                 'date' => [
                     'equals' => $today
                 ]
             ]);
         } else {
                $filter = new FilterBag(Operators::OR);
                $filter->addFilter(Filter::rawFilter('Round 1', [
                    'date' => [
                            'equals' => $today
                        ]
                    ])
                )->addFilter(Filter::rawFilter('Round 2', [
                    'date' => [
                            'equals' => $today
                        ]
                    ])
                )->addFilter(Filter::rawFilter('Round 3', [
                    'date' => [
                            'equals' => $today
                        ]
                    ])
                )->addFilter(Filter::rawFilter('Round 4', [
                    'date' => [
                            'equals' => $today
                        ]
                    ])
                )->addFilter(Filter::rawFilter('Round 5', [
                    'date' => [
                            'equals' => $today
                        ]
                    ])
                )->addFilter(Filter::rawFilter('Round 6', [
                    'date' => [
                            'equals' => $today
                        ]
                    ])
                );

         }

         return $this->notionClient
             ->database($databaseId)
             ->filterBy($filter)
             ->query()
             ->asCollection();
    }
}