<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Microsoft\Graph\Graph;
use Microsoft\Graph\Model;

class OutlookController extends Controller
{
	public function mail() 
	{
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}

		$tokenCache = new \App\TokenStore\TokenCache;

		// echo 'Token: '.$tokenCache->getAccessToken();
		
		$graph = new Graph();
		$graph->setAccessToken($tokenCache->getAccessToken());

		$user = $graph->createRequest('GET', '/me')
		->setReturnType(Model\User::class)
		->execute();

		// echo 'User: '.$user->getDisplayName();
		
		// echo 'User: '.$user->getDisplayName().'<br/>';

		$messageQueryParams = array (
			// Only return Subject, ReceivedDateTime, and From fields
			"\$select" => "subject,receivedDateTime,from",
			// Sort by ReceivedDateTime, newest first
			"\$orderby" => "receivedDateTime DESC",
			// Return at most 10 results
			"\$top" => "10"
		);

		$getMessagesUrl = '/me/mailfolders/inbox/messages?'.http_build_query($messageQueryParams);
		$messages = $graph->createRequest('GET', $getMessagesUrl)
		->setReturnType(Model\Message::class)
		->execute();

		// foreach($messages as $msg) {
		// 	echo 'Message: '.$msg->getSubject().'<br/>';
		// }
		
		return view('mail', array(
			'username' => $user->getDisplayName(),
			'messages' => $messages
		));
	}

	public function calendar() 
	{
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}

		$tokenCache = new \App\TokenStore\TokenCache;

		$graph = new Graph();
		$graph->setAccessToken($tokenCache->getAccessToken());

		$user = $graph->createRequest('GET', '/me')
		->setReturnType(Model\User::class)
		->execute();

		$eventsQueryParams = array (
			// // Only return Subject, Start, and End fields
			"\$select" => "subject,start,end",
			// Sort by Start, oldest first
			"\$orderby" => "Start/DateTime"
			// Return at most 10 results
			// "\$top" => "10"
		);

		$getEventsUrl = '/me/events?'.http_build_query($eventsQueryParams);
		$events = $graph->createRequest('GET', $getEventsUrl)
		->setReturnType(Model\Event::class)
		->execute();

		$calendar = $this->events($events);
		// dd($calendar);

		return view('calendar', compact('calendar'));
	}

	public function contacts() 
	{
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}

		$tokenCache = new \App\TokenStore\TokenCache;

		$graph = new Graph();
		$graph->setAccessToken($tokenCache->getAccessToken());

		$user = $graph->createRequest('GET', '/me')
		->setReturnType(Model\User::class)
		->execute();

		$contactsQueryParams = array (
			// // Only return givenName, surname, and emailAddresses fields
			"\$select" => "givenName,surname,emailAddresses",
			// Sort by given name
			"\$orderby" => "givenName ASC",
			// Return at most 10 results
			"\$top" => "10"
		);

		$getContactsUrl = '/me/contacts?'.http_build_query($contactsQueryParams);
		$contacts = $graph->createRequest('GET', $getContactsUrl)
		->setReturnType(Model\Contact::class)
		->execute();

		return view('contacts', array(
			'username' => $user->getDisplayName(),
			'contacts' => $contacts
		));
	}

	public function events($events_outlook)
	{
		$events = [];

		foreach ($events_outlook as $value) {
			$events[] = \Calendar::event(
				$value->getSubject(), //event title
				false, //full day event?
				$value->getStart()->getDateTime(), //start time (you can also use Carbon instead of DateTime)
				$value->getEnd()->getDateTime(), //end time (you can also use Carbon instead of DateTime)
				$value->getId() //optionally, you can specify an event ID
			);
		}

		$calendar = \Calendar::addEvents($events) //add an array with addEvents
			->setOptions([ //set fullcalendar options
				'firstDay' => 1
			]);

		return $calendar;
	}
}
