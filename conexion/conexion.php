<?php

    //antes de insertar un dato, limpias el dato usando clean
    Class DataBase
    {
        private $con;
        private $name = "compumundo";
        private $host = "localhost";
        private $pass = "";
        private $user = "root";

        public function __construct()
        {
            $this->connect();
        }

        private function connect()
        {
            $this->con = mysqli_connect($this->host, $this->user, $this->pass, $this->name);
            if(mysqli_connect_error())
            {
                die("Error al conectar en la base de datos : " . mysqli_connect_errno() ." como ". mysqli_connect_error());
                
            }
        }
        //lmpiar var para insertarla
        public function clean($var)
        {
            return mysqli_real_escape_string($this->con, $var);
        }

        //insercion de datos
        public function insert_prod($nombre, $descripcion,  $caracteristicas, $precio, $tipo)
        {
            $sql = "INSERT INTO producto(nom_prod, desc_prod, carac_prod, precio_prod, tipo_prod)
                        VALUES('$nombre', '$descripcion','$caracteristicas',$precio, '$tipo')";
            $res = mysqli_query($this->con, $sql) or die("error al insertar");
            return $res == 1;
        }

        //obtiene los datos de un producto a partir de su id
        public function get_prod($id)
        {
            $sql = "SELECT * from producto WHERE id_prod = $id";
            $res = mysqli_query($this->con, $sql) or die("error de consulta");
            $file = $res->fetch_assoc();

            return $file;
        }

        //obtiene una coleccion de imagenes a partir de el id del producto
        public function get_image_prod($id)
        {
            $sql = "SELECT img FROM imagen WHERE fk_prod = $id";
            $res = mysqli_query($this->con, $sql);

            return $res;
        }

        //obtiene los datos (nombre, imagen, precio) de los primeros 20 productos ordenados por fecha
        public function get_view_prod_index()
        {
            $sql = "SELECT * FROM prod_portal";
            $res = mysqli_query($this->con, $sql);
            return $res;
        }
    }

?>