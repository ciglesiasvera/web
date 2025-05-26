<?php
// Hacemos que el navegador entienda que estamos enviando JSON
header('Content-Type: application/json');

// Creamos una lista de proyectos como si fuera una mini base de datos
$proyectos = [
    [
        "nombre" => "Calculadora Web",
        "imagen" => "../../assets/imgs/semanas/semana10/proyecto1.png",
        "descripcion" => "Una calculadora simple hecha en JavaScript.",
        "url_github" => "https://github.com/usuario/calculadora",
        "url_produccion" => "https://usuario.github.io/calculadora"
    ],
    [
        "nombre" => "Blog Personal",
        "imagen" => "../../assets/imgs/semanas/semana10/proyecto2.png",
        "descripcion" => "Un blog hecho con HTML, CSS y PHP.",
        "url_github" => "https://github.com/usuario/blog",
        "url_produccion" => ""
    ]
];

// Convertimos el arreglo a formato JSON y lo devolvemos
echo json_encode($proyectos);
?>
