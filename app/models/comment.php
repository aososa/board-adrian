<?php
class Comment extends AppModel
{
    const USER_MIN_LENGTH = 1;
    const USER_MAX_LENGTH = 16;
    const BODY_MIN_LENGTH = 1;
    const BODY_MAX_LENGTH = 200;
    public $validation = array( 
        'username' => array(
            'length' => array('validate_between', self::USER_MIN_LENGTH, self::USER_MAX_LENGTH,),
        ),
        
        'body' => array(
            'length' => array('validate_between', self::BODY_MIN_LENGTH, self::BODY_MAX_LENGTH,),
        ),
    ); 

    /**
    * Get all existing comments for specific thread 
    * @param int thread_id = thread id to show comments from
    * returns array of comments depending on the current page for pagination
    */
    public static function getAll($thread_id) 
    {
        $comments = array();
        $query = "SELECT comment.id, thread_id, users.username, comment.body, comment.created FROM comment, users WHERE (comment.user_id = users.id) AND thread_id = ? ORDER BY created ASC";

        $db = DB::conn();
        $rows = $db->rows($query, array($thread_id));

        foreach($rows as $row) {
            $comments[] = new Comment($row);
        }

        return $comments;
    }

    /**
    * Inserts new comment to database
    * @param object comment
    */
    public function write($thread_id) 
    {
        if(!$this->validate()) {
            throw new ValidationException('invalid comment.');
        }

        $db = DB::conn();
        $params = array(
            "thread_id" => $thread_id,
            "user_id" => $_SESSION['id'],
            "body" => $this->body,
            "created" => date('Y-m-d H:i:s')
        );

        $db->insert('comment', $params);
    }
}
