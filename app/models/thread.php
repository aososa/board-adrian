<?php

class Thread extends AppModel {

    public $validation = array (
        'title' => array(
            'length' => array('validate_between', 1, 30,),
        ),
    );
        
    /**
    * Get all threads
    * @return array of threads depending on pagination position
    */
    public static function getAll() {
        $threads = array();
        
        $db = DB::conn();
        $rows = $db->rows('SELECT id, title, created FROM thread');
        foreach ($rows as $row) {
            $threads[] = new Thread($row);
        }
        
	return $threads;
    }

    /**
    * Get specific thread information
    * @param int thread id
    */
    public static function get($id) {
        $db = DB::conn();
        $row = $db->row("SELECT * FROM thread WHERE id = ?", array($id));
    
        if(!$row) {
            throw new RecordNotFoundException('no record found');
        }    
    
        return new self($row);        
    }

    /**
    * Get all existing comments for specific thread 
    * returns array of comments depending on the current page for pagination
    */
    public function getComments() {
        $comments = array();
    
        $db = DB::conn();
        $rows = $db->rows('SELECT comment.id, thread_id, users.username, comment.body, comment.created FROM comment, users WHERE (comment.user_id = users.id) AND thread_id = ? ORDER BY created ASC', array($this->id));

        foreach($rows as $row) {
            $comments[] = new Comment($row);
        }

        return $comments;
    }

    /**
    * Inserts new comment to database
    * @param object comment
    */
    public function write(Comment $comment) {
        if(!$comment->validate()) {
            throw new ValidationException('invalid comment.');
        }
        $db = DB::conn();
        $db->query("INSERT INTO comment SET thread_id = ?, user_id = ?, body = ?, created=NOW()", array($this->id,$_SESSION['id'],$comment->body) );
    }

    /**
    * Creates new thread and write initial comment
    * @param object comment
    */
    public function create(Comment $comment) {
        $this->validate();
        $comment->validate();
        if($this->hasError() || $comment->hasError()) {
            throw new ValidationException("invalid thread or comment");
        }

        $db = DB::conn();
        $db->begin();
        
        $params = array('title' => $this->title,);
        $db->insert('thread', $params);

        $this->id = $db->lastInsertId();
        $comment->write($this->id);
        
        $db->commit();
    }

}
?>
