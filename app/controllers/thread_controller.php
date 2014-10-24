<?php
class ThreadController extends AppController 
{
    const MAX_ROWS_PER_PAGE = 3;
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
    public function index() 
    {
        $current_page = max(Param::get('page'), SimplePagination::MIN_PAGE_NUM);
        $pagination = new SimplePagination($current_page,self::MAX_ROWS_PER_PAGE);
        $threads = Thread::getAll();
        $remaining_threads = array_slice($threads, $pagination->start_index + SimplePagination::MIN_PAGE_NUM);
        $pagination->checkLastPage($remaining_threads);

        $page_links = createPaginationLinks(count($threads), $current_page, $pagination->count);

        $threads = array_slice($threads, $pagination->start_index, $pagination->count);

        $this->set(get_defined_vars());
    }

    /**
    * Create new thread with corresponding initial comment
    */
    public function create() 
    {
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
