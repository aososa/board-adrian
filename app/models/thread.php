<?php

class Thread extends AppModel 
{
    const TITLE_MIN_LENGTH = 1;
    const TITLE_MAX_LENGTH = 30;

    public $validation = array (
        'title' => array(
            'length' => array('validate_between', self::TITLE_MIN_LENGTH, self::TITLE_MAX_LENGTH,),
        ),
    );
        
    /**
    * Get all threads
    * @return array of threads depending on pagination position
    */
    public static function getAll() 
    {
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
    public static function get($id) 
    {
        $db = DB::conn();
        $row = $db->row("SELECT * FROM thread WHERE id = ?", array($id));
    
        if(!$row) {
            throw new NotFoundException('no record found');
        }    
    
        return new self($row);        
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

        try {
            $db = DB::conn();
            $db->begin();
        
            $params = array('title' => $this->title);
            $db->insert('thread', $params);

            $this->id = $db->lastInsertId();
            $comment->write($this->id);
        
            $db->commit();
        } catch (Exception $e) {
            $db->rollback();
        }
    }

}
?>
