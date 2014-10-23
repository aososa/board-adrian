<?php
class Pagination
{
    const MAX_ROWS = 5;
    const PAGINATION_LIMIT = 4;
    const FIRST_PAGE = 1;

    public static $pagination_for;
    
    // Initialize current_page on the start.
    public static $current_page = 1;

    /**
     * Set last page of threads
     * @param $total_rows
     * @return int
     */
    public static function setLastPage($total_rows)
    {
        
        if ($total_rows <= self::MAX_ROWS) {
            return 1;
        }
        
        return ceil($total_rows/self::MAX_ROWS);
    }

    public static function setPage($page)
    {
        // Get pagenum from URL vars if it is present, else it is = 1
        if ($page > 1) {
            return self::$current_page = preg_replace('#[^0-9]#', '', $page);
        }

        return self::$current_page;
    }

    /**
     * Generate page links
     * @param $page $total_rows
     * @return string
     */
    public static function createPageLinks($page, $total_rows)
    {
        $last = self::setLastPage($total_rows);

        $page_links = '';
        $current_page = self::$current_page;
        $previous = $current_page - 1;
        $next = $current_page + 1;
        $left_pagenum = $current_page - self::PAGINATION_LIMIT;
        $right_pagenum = $current_page + self::PAGINATION_LIMIT;

        // Links will be generated if there are more than 1 page.
        if ($last != 1) {

            $page_links .= self::createPreviousLink($current_page, $previous);
            
            for ($i = $left_pagenum; $i < $current_page; $i++) {
                $page_links .= self::createLeftLinks($i);
            }            
            
            $page_links .= '' . $current_page . ' &nbsp; ';
            
            for ($i = $next; $i <= $last; $i++) {
                $page_links .= self::createRightLinks($i,$right_pagenum);
            }
            
            $page_links .= self::createNextLink($current_page, $last, $next);
        }

        return $page_links;
    }

    public static function createPreviousLink($page_num, $previous)
    {
        if($page_num > 1)
        {
            switch (self::$pagination_for) {
            case 'comment':
                return "<a class='btn btn-small' href='?thread_id=" . Param::get('thread_id') . "&page={$previous}'>Previous</a> &nbsp; &nbsp;";
            case 'search':
                return "<a class='btn btn-small' href='?keyword=" . Param::get('keyword') . "&search_by=" . Param::get('search_by') . "&page={$previous}'>Previous</a> &nbsp; &nbsp;";
            case 'my_threads':
                return "<a class='btn btn-small' href='?user_id=" . Param::get('user_id') . "&page={$previous}'>Previous</a> &nbsp; &nbsp;";
            default:
                return "<a class='btn btn-small' href='?sort_by=" . Param::get('sort_by') . "&sort_order=" . Param::get('sort_order') . "&page={$previous}'>Previous</a> &nbsp; &nbsp;";
            }
        } else
            return null;
    }

    public static function createLeftLinks($page_num)
    {  
        if($page_num > 0)
        {
            switch (self::$pagination_for) {
            case 'comment':
                return "<a class='btn btn-small' href='?thread_id=" . Param::get('thread_id') . "&page={$page_num}'>{$page_num}</a> &nbsp; &nbsp;";
            case 'search':
                return "<a class='btn btn-small' href='?keyword=" . Param::get('keyword') . "&search_by=" . Param::get('search_by') . "&page={$page_num}'>{$page_num}</a> &nbsp; &nbsp;";
            case 'my_threads':
                return "<a class='btn btn-small' href='?user_id=" . Param::get('user_id') . "&page={$page_num}'>{$page_num}</a> &nbsp; &nbsp;";
            default:
                return "<a class='btn btn-small' href='?sort_by=" . Param::get('sort_by') . "&sort_order=" . Param::get('sort_order') . "&page={$page_num}'>{$page_num}</a> &nbsp; &nbsp;";
            }
        } else
            return null;
    }

    public static function createRightLinks($page_num, $right_pagenum)
    {
        if($page_num <= $right_pagenum)
        {
            switch (self::$pagination_for) {
            case 'comment':
                return "<a class='btn btn-small' href='?thread_id=" . Param::get('thread_id') . "&page={$page_num}'>{$page_num}</a> &nbsp; &nbsp;";
            case 'search':
                return "<a class='btn btn-small' href='?keyword=" . Param::get('keyword') . "&search_by=" . Param::get('search_by') . "&page={$page_num}'>{$page_num}</a> &nbsp; &nbsp;";
            case 'my_threads':
                return "<a class='btn btn-small' href='?user_id=" . Param::get('user_id') . "&page={$page_num}'>{$page_num}</a> &nbsp; &nbsp;";
            default:
                return "<a class='btn btn-small' href='?sort_by=" . Param::get('sort_by') . "&sort_order=" . Param::get('sort_order') . "&page={$page_num}'>{$page_num}</a> &nbsp; &nbsp;";
            }
        } else
            return null;
    }

    public static function createNextLink($page_num, $last, $next)
    {
        if($page_num != $last)
        {
            switch (self::$pagination_for) {
            case 'comment':
                return "&nbsp; &nbsp; <a class='btn btn-small' href='?thread_id=" . Param::get('thread_id') . "&page={$next}'>Next</a>";
            case 'search':
                return "&nbsp; &nbsp; <a class='btn btn-small' href='?keyword=" . Param::get('keyword') . "&search_by=" . Param::get('search_by') . "&page={$next}'>Next</a>";
            case 'my_threads':
                return "&nbsp; &nbsp; <a class='btn btn-small' href='?user_id=" . Param::get('user_id') . "&page={$next}'>Next</a>";
            default:
                return "<a class='btn btn-small' href='?sort_by=" . Param::get('sort_by') . "&sort_order=" . Param::get('sort_order') . "&page={$next}'>Next</a>";
            }
        } else
            return null;
    }
}
