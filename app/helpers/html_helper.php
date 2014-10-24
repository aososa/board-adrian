<?php

function outputText($string)
{
    if (!isset($string)) return;
    echo htmlspecialchars($string, ENT_QUOTES);
}

function readable_text($s)                    
{
    $s = htmlspecialchars($s, ENT_QUOTES);
    $s = nl2br($s);
    return $s;                    
}

function createPaginationLinks($total_rows, $current_page, $max_rows, $extra_params = null) 
{
    $total_pages = SimplePagination::MIN_PAGE_NUM;
    if ($total_rows > $max_rows) {
        $total_pages = ceil($total_rows / $max_rows);
    }

    $page_counter = SimplePagination::MIN_PAGE_NUM;
    $page_links = "";
    while ($page_counter <= $total_pages) {
        if($page_counter == $current_page) {
            $page_links .= " <b>$current_page</b> ";
        } else {
            $page_links .= "<a class='btn btn-small' href='?page={$page_counter}&{$extra_params}'>{$page_counter}</a>";
        }
        $page_counter++;
    }
    return $page_links;
} 
