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

	public function write() {
		$thread = Thread::get(Param::get('thread_id'));
		$comment = new Comment;
		$page = Param::get('page_next', 'write');

		switch ($page) {
			case 'write':
			break;

			case 'write_end':
			   $comment->username = Param::get('username');
			   $comment->body = Param::get('body');
			   try {
			      $thread->write($comment);
			   } catch (ValidationException $e) {
			      $page = 'write';
			   }
			   break;
			
			default:
			   throw new NotFoundException("{$page} is not found");
			   break;
		}
		
		$this->set(get_defined_vars());
		$this->render($page);
	}

}
?>
