<?php

use Larabook\Statuses\LeaveCommentOnStatusCommand;
use Laracasts\Commander\CommanderTrait;

class CommentsController extends BaseController {

	use CommanderTrait;

	/**
	 * Leave new comment
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = array_add(Input::all(), 'user_id', Auth::id());

		$this->execute(LeaveCommentOnStatusCommand::class, $input);

		return Redirect::back();
	}


}