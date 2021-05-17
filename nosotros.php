<?php 
require 'includes/funciones.php';
inlcuirTemplate("header"); 
?>
    <main class="contenedor seccion nosotros">
        <h1>Conoce Más Sobre Nosotros</h1>
        <blockquote class="derecha">20 años de Experiencia</blockquote>
        <div class="nosotrosCon">
            <picture>
                <source srcset="build/img/nosotros.webp" type="image/webp">
                <source srcset="build/img/nosotros.jpg" type="image/jpeg">
                <img src="build/img/nosotros.jpg" alt="Imagen Nosotros" loading="lazy">
            </picture>    
            <div class="contenido-nosotros">
                <p class="justify">Nuestro bufete jurídico es reconocido por muchos tribunales por brindar un trabajo de excelente calidad y cumplir con brindar un servicio de la más alta expectativa.</p>
                <p class="justify">Nosotros atendemos cualquier tipo de asunto civil y judicial que se nos presente al momento.</p>
                <p class="justify">Y recuerda, si tienes un problema, siempre hay una solución legal al alcance de tu mano!</p>
            </div>
        </div>
    </main>

<?php inlcuirTemplate("footer");   ?>