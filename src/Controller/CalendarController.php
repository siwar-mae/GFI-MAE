<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class CalendarController extends AbstractController
{
    public function calendarEvents(Request $request)
    {
        $eventList = EventList::get(['event_name','event_start']);
        return response()->json(["My events" => $eventList]);
    }
}