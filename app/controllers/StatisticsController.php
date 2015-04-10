<?php

class StatisticsController extends BaseController {
	/**
	 * Displays an overview of the stats.
	 */
	public function showStatisticsIndexPage()
	{
		return View::make('statistics.index');
	}

	/**
	 * Displays stats history view.
	 */
	public function showStatisticsHistoryPage()
	{
		return View::make('statistics.history');
	}

	/**
	 * Displays an overview of the stats.
	 * @param $token the PM token
	 */
	public function showStatisticsPMPage($token)
	{
		return View::make('statistics.pm')->with('token', $token);
	}
}
