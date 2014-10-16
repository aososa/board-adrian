<?php
class ThreadController extends AppController {

	public function index() {
		$threads = Thread::getAll();
		$this->set(get_defined_vars());
	}

	public function view() {
		$thread = Thread::get(Param::get('thread_id'));
		$comments = $thread->getComments();
		$this->set(get_defined_vars());
	}

}
?>
