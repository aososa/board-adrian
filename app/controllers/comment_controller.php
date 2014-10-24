<?php
class CommentController extends AppController {


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

        $page_links = createPaginationLinks(count($comments), $current_page, $pagination->count, 'thread_id='. $thread->id);

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
}
?>
