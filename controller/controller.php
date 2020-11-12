<?php
    require("conexion/conexion.php");
    Class Controller
    {
        private $db;
        public function __construct()
        {
            $this->db = new DataBase();
        }

        //obtienes los datos de un item
        public function get_data_item($id)
        {
            $data = $this->db->get_prod($id);
            $img = $this->db->get_image_prod($id);
            return ['data' => $data, 'image' => $img];
        }

        public function get_items()
        {
            return $this->db->get_view_prod_index();
        } 
    }
?>