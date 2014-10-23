<?php
class ThreadController extends AppController {

    /**
    * Checks if there is an account currently logged in since all actions under the thread controller require user authentication
    */
    public function __construct($name)
    {
        parent::__construct($name);
        if(is_logged_in() === false) {
            redirect($controller = 'user');
        }
    }

    /**
    * Displays all threads
    */
    public function index() {
        $current_page = max(Param::get('page'), 1);
        $pagination = new SimplePagination($current_page,3);
        #$threads_all = Thread::getAll($current_page,null, $pagination);
        $threads = Thread::getAll();
	$remaining_threads = array_slice($threads, $pagination->start_index);
        $pagination->checkLastPage($remaining_threads);

        $page_links = createPaginationLinks(count($threads), $pagination->count);

        $threads = array_slice($threads, $pagination->start_index - 1, $pagination->count);

        $this->set(get_defined_vars());
    }

    /**
    * View specific thread and display all comments
    */
    public function view() {
        $thread = Thread::get(Param::get('thread_id'));

        $current_page = max(Param::get('page'), 1);
        $pagination = new SimplePagination($current_page,3);
        $comments = $thread->getComments($current_page);
        $remaining_comments = array_slice($comments, $pagination->start_index);
        $pagination->checkLastPage($remaining_comments);
   
        $page_links = createPaginationLinks(count($comments), $pagination->count, 'thread_id='. $thread->id);

        $comments = array_slice($comments, $pagination->start_index - 1, $pagination->count);

        $this->set(get_defined_vars());
    }

    /**
    * Append new comment to existing thread
    */
    public function write() {
        $thread = Thread::get(Param::get('thread_id'));
        $comment = new Comment;
        $page = Param::get('page_next', 'write');

        switch ($page) {
        case 'write':
            break;
        case 'write_end':
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

    /**
    * Create new thread with corresponding initial comment
    */
    public function create() {
        $thread = new Thread;
        $comment = new Comment;
        $page = Param::get('page_next','create');
    
        switch($page) {
        case 'create':
            break;
        case 'create_end':
            $thread->title = Param::get('title');
            $comment->body = Param::get('body');
            try {
               $thread->create($comment);
            } catch(ValidationException $e) {
               $page = 'create';
            }
            break;
        }
        
        $this->set(get_defined_vars());
        $this->render($page);
    }

}
?>   
