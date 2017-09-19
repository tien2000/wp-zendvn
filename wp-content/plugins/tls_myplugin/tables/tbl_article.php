<?php
if(!class_exists('WP_List_Table')){
    require_once ABSPATH . 'wp-admin/includes/class-wp-list-table.php';
}

class Article_Table extends WP_List_Table{
    public function __construct() {
       // echo '<br>' . __METHOD__;
       $args = array(
                    'plural' => 'article',       // class CSS article
                    'singular' => 'article',     // tbody data-wp-lists="list:article"
                    'ajax' => false,
                    'screen' => null,
                );
       parent::__construct($args);
    }
    
    public function prepare_items() {
        $hidden = array('content');
        $sortTable = array();
        
        $this->_column_headers = array($this->get_columns(), $hidden, $sortTable);
        $this->items = $this->table_data();
    }
    
    public function get_columns() {
        $columns = array(
            'cb'        => '<input type="checkbox" />',
            'title'     => 'Title',
            'picture'   => 'Picture',
            'content'   => 'Content',
            'author_id' => 'Author',
            'status'    => 'Status',
            'id'        => 'ID',
        );
        return $columns;
    }
    
    //=============== HÀM LẤY DỮ LIỆU TRONG BẢNG ARTICLE =====================//
    private function table_data(){
        $data = array();
        $data[] = array(
            'id'        => 1,
            'title'     => 'Hàn Quốc vô địch, Thái Lan trắng tay tại ASIAD 17',
            'picture'   => 'picture001.png',
            'content'   => 'Content - Hàn Quốc vô địch, Thái Lan trắng tay tại ASIAD 17',
            'author_id' => 1,
            'status'    => 0,
        );
        $data[] = array(
            'id'        => 2,
            'title'     => 'Messi Hàn Quốc dẫn đầu bộ tứ siêu đẳng đối đầu U19 Việt Nam',
            'picture'   => 'picture002.png',
            'content'   => 'Content - Messi Hàn Quốc dẫn đầu bộ tứ siêu đẳng đối đầu U19 Việt Nam',
            'author_id' => 1,
            'status'    => 1,
        );
        
        return $data;
    }
    
    public function column_default( $item, $column_name ) {
        
        return $item[$column_name];
    }
    
    
    //====================== HÀM THAY ĐỔI DỮ LIỆU HIỂN THỊ TRONG BẢNG =================// 
    public function column_title($item){
        $title = '<strong><a href="#">' . $item['title'] . '</a></strong>';
        return $title;
    }
    
    public function column_cb($item){
        $singular = $this->_args['singular'];
        $cb = '<input type="checkbox" name="'.$singular.'[]" value="'.$item['id'].'"/>';
        return $cb;
    }
    
}