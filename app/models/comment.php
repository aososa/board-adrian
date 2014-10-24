<?php
class Comment extends AppModel
{
    public $validation = array( 
        'username' => array(
            'length' => array('validate_between', 1, 16,),
        ),
        
        'body' => array(
            'length' => array('validate_between', 1, 200,),
        ),
    ); 

    /**
    * Get all existing comments for specific thread 
    * returns array of comments depending on the current page for pagination
    */
    public function getAll($thread_id) {
        $comments = array();
        $query = "SELECT comment.id, thread_id, users.username, comment.body, comment.created FROM comment, users WHERE (comment.user_id = users.id) AND thread_id = ? ORDER BY created ASC";

        $db = DB::conn();
        $rows = $db->rows($query, array($this->id));

        foreach($rows as $row) {
            $comments[] = new Comment($row);
        }

        return $comments;
    }

    /**
    * Inserts new comment to database
    * @param object comment
    */
    public function write($thread_id) {
        if(!$this->validate()) {
            throw new ValidationException('invalid comment.');
        }
        $query = "INSERT INTO comment SET thread_id = ?, user_id = ?, body = ?, created=NOW()";

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
