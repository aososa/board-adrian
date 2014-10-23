<?php
class ThreadController extends AppController {

    public function __construct($name)
    {
        parent::__construct($name);
        if(is_logged_in() === false) {
            redirect($controller = 'user');
        }
    }

    public function index() {

        $current_page = Pagination::setPage(Param::get('page'));
        $threads = Thread::getAll($current_page);
        $page_links = Pagination::createPageLinks($current_page, Thread::countThreads());

        $this->set(get_defined_vars());
    }

    public function view() {
        $thread = Thread::get(Param::get('thread_id'));

        $current_page = Pagination::setPage(Param::get('page'));
        $comments = $thread->getComments($current_page);
        Pagination::$pagination_for = 'comment';
        $page_links = Pagination::createPageLinks($current_page, Thread::countComments($thread->id));

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
