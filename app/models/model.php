<?php
require_once "database/config.php";

class Model
{

  protected $db;

  public function __construct()
  {
    $this->db = new PDO(
      "mysql:host=" . MYSQL_HOST . ";charset=utf8",
      MYSQL_USER,
      MYSQL_PASS
    );
    $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $dbName = MYSQL_DB;
    $dbname = "`" . str_replace("`", "``", $dbName) . "`";
    $this->db->query("CREATE DATABASE IF NOT EXISTS $dbname");
    $this->db->query("use $dbname");
    $this->initTables();
  }

  function initTables()
  {
    $query = $this->db->query('SHOW TABLES');
    $tables = $query->fetchAll();
    if (count($tables) == 0) {
      $sql = <<<END
            --
            -- Base de datos: `base de datos tp`
            --
            -- --------------------------------------------------------

            --
            -- Estructura de tabla para la tabla `capitulos`
            --

            CREATE TABLE `capitulos` (
              `id_capitulo` int(45) NOT NULL AUTO_INCREMENT,
              `nombre` varchar(45) NOT NULL,
              `duracion` int(45) NOT NULL,
              `id_serie` int(45) NOT NULL,
              PRIMARY KEY (`id_capitulo`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

            --
            -- Volcado de datos para la tabla `capitulos`
            --

            
            -- --------------------------------------------------------
            
            --
            -- Estructura de tabla para la tabla `series`
            --
            
            CREATE TABLE `series` (
              `id_serie` int(45) NOT NULL AUTO_INCREMENT,
              `titulo` varchar(45) NOT NULL,
              `genero` varchar(200) NOT NULL,
              PRIMARY KEY (id_serie)
              ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
              
              --
              -- Volcado de datos para la tabla `series`
              --
              
              INSERT INTO `series` (`titulo`, `genero`) VALUES
              ('Dragon Ball', 'Animada'),
              ('One Piece', 'Acción'),
              ('Phineas y Ferb', 'Animada'),
              ('Serial Experiments Lain', 'Terror');
              
              -- --------------------------------------------------------
              INSERT INTO `capitulos` (`nombre`, `duracion`, `id_serie`) VALUES
              ('Pilot', 123, 1),
              ('Capítulo 2', 60, 1),
              ('Capítulo 3', 70, 1),
              ('Capítulo 1', 45, 2);
              
            --
            -- Estructura de tabla para la tabla `usuarios`
            --

            CREATE TABLE `usuarios` (
              `id_usuario` int(45) NOT NULL AUTO_INCREMENT,
              `email` varchar(45) NOT NULL,
              `password` varchar(200) NOT NULL,
              PRIMARY KEY (id_usuario)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

            --
            -- Volcado de datos para la tabla `usuarios`
            --

            INSERT INTO `usuarios` (`email`, `password`) VALUES
            ('webadmin', '$2y$10\$N32x3if6uFbjBBGPFzsfwernLtfc2o8SQ.P7cjyssAzbQVylmFGjW');
            --
            -- Índices para tablas volcadas
            --

            --
            -- Indices de la tabla `capitulos`
            --
            ALTER TABLE `capitulos`
              ADD KEY `fk_capitulos_series` (`id_serie`);

            -- Filtros para la tabla `capitulos`
            --
            ALTER TABLE `capitulos`
              ADD CONSTRAINT `fk_capitulos_series` FOREIGN KEY (`id_serie`) REFERENCES `series` (`id_serie`)
              on delete cascade
              on update cascade;
            COMMIT;

            /*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
            /*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
            /*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
            END;
      $this->db->query($sql);
    }
  }
}
