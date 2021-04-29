<?php
/**
 * set_var.php sets the variables for the construction of a page based on the URL
 * 
 * @author Robin VanGilder <poliosis@gmail.com>
 * @version 1.0 2021/04/29
 * @link http://www.rtvgilder.com/ 
 * @license https://www.apache.org/licenses/LICENSE-2.0
 * @todo none
 */

function set_var(){
    global $page_title, $main_headline, $header_image, $query, $page_type;
    switch(THIS_PAGE){
        case 'index.php' :
            $page_title = "Robin VanGilder - Seattle Web Designer & Developer";
            $main_headline = "Robin VanGilder: Web Design & Development";
            $header_image = 'header_sunset.png';
            $query = "SELECT * FROM posts WHERE category_id = '1'";
            $page_type = 'topic';
        break;
        case 'about.php' :
            $page_title = "About Robin VanGilder";
            $main_headline = "About Me";
            $header_image = 'header_author.png';
            $query = "SELECT * FROM posts WHERE category_id = '6'";
            $page_type = 'topic';
        break;
        case 'resume.php' :
            $page_title = "Resume";
            $main_headline = "My Current Resume";
            $header_image = 'header_author.png';
            $query = "SELECT * FROM posts WHERE category_id = '2'";
            $page_type = 'topic';
        break;
        case 'portfolio.php' :
            $page_title = "Portfolio";
            $main_headline = "My Portfolio";
            $header_image = 'header_keyboard.png';
            $query = "SELECT * FROM posts WHERE category_id = '3'";
            $page_type = 'list';
        break;
        case 'post_view.php' :
            $page_title = '';
            $main_headline = '';
            $header_image = '';
            $query = '';
            $page_type = 'article';
        break;
        case 'login.php' :
            $page_title = 'Super Secret Login Page';
            $main_headline = 'SUPER SECRET LOGIN PAGE!!';
            $header_image = 'header_keyboard.png';
            $query = '';
            $page_type = '';
        break;
        case 'cms.php' :
            $page_title = 'Content Management System';
            $main_headline = 'Content Management System';
            $header_image = 'header_gravy.png';
            $query = "SELECT * FROM posts";
            $page_type = 'backend';
        break;
        case 'add_content.php' :
            $page_title = '';
            $main_headline = '';
            $header_image = '';
            $query = '';
            $page_type = '';
        break;
        case 'add_content.php' :
            $page_title = '';
            $main_headline = '';
            $header_image = '';
            $query = '';
            $page_type = '';
        break;
    
    
    } // End switch
}