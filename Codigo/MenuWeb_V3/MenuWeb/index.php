<!DOCTYPE html>
<html lang="en">


<?php
        require 'includes/config/database.php';
        $db= conectarDB();
        $errores = [];
        
        $query = "SELECT * FROM propiedades";
        $resultadoConsulta = mysqli_query($db, $query);
        
        $resultado = $_GET['resultado'] ?? null;
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['idpropiedades'];
            $id = filter_var($id, FILTER_VALIDATE_INT);
            if($id) {
                $query = "SELECT imagen FROM propiedades WHERE idpropiedades = ${id}";
                $resultado = mysqli_query($db, $query);
                $propiedad = mysqli_fetch_assoc($resultado);
               // unlink('/' . $propiedad['imagen']);
                $query = "DELETE FROM propiedades WHERE idpropiedades= ${id}";
                $resultado = mysqli_query($db, $query);
                
            }
        }
?>



<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        Las Delicias de Alisson
    </title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Crete+Round&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cuprum&family=Rampart+One&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/estilo.css">
    
</head>

<body>
    <!-- MOBILE NAV -->
    <div class="mb-nav">
        <div class="mb-move-item"></div>
        <div class="mb-nav-item active">
            <a href="#home">
                <i class="bx bxs-home"></i>
            </a>
        </div>
        <div class="mb-nav-item">
            <a href="#about">
                <i class='bx bxs-wink-smile'></i>
            </a>
        </div>
        <div class="mb-nav-item">
            <a href="#food-menu-section">
                <i class='bx bxs-food-menu'></i>
            </a>
        </div>
        <div class="mb-nav-item">
            <a href="#testimonial">
                <i class='bx bxs-comment-detail'></i>
            </a>
        </div>
    </div>
    <!-- END MOBILE NAV -->
    <!-- BACK TO TOP BTN -->
    <a href="#home" class="back-to-top">
        <i class="bx bxs-to-top"></i>
    </a>
    <!-- END BACK TO TOP BTN -->
    <!-- TOP NAVIGATION -->
    <div class="nav">
        <div class="menu-wrap">
            <a href="index.html" class="logo">
                <img src="images/logo(1)_opt.png" alt="">
            </a>
            <div class="menu h-xs">
                <a href="#home">
                    <div class="menu-item active">
                        Inicio
                    </div>
                </a>
                <a href="#about">
                    <div class="menu-item">
                        Nosotros
                    </div>
                </a>
                <a href="#menu">
                    <div class="menu-item">
                        Menu
                    </div>
                </a>
                <a href="#testimonial">
                    <div class="menu-item">
                        Contacto
                    </div>
                </a>
                <a href="/login/login.html">
                    <div class="menu-item">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user" width="28" height="28" viewBox="0 0 24 24" stroke-width="2" stroke="#ffbf00" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <circle cx="12" cy="7" r="4" />
                            <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                        </svg>
                    </div>
                </a>
            </div>
            <div class="right-menu">
                <div class="cart-btn">
                    <i class='bx bx-cart-alt'></i>
                </div>
            </div>
        </div>
    </div>
    <!-- END TOP NAVIGATION -->
    <!-- SECTION HOME -->
    <section id="home" class="fullheight align-items-center bg-img bg-img-fixed">
        <div class="container">

            <div class="slogan">
                <h1 class="left-to-right play-on-scroll">
                    BIENVENIDO
                </h1>
                <h6 class="left-to-right play-on-scroll">
                    Las Delicias de Alisson
                </h6>

                <h5 class="left-to-right play-on-scroll delay-2">Comida hecha como en casa <img src="https://img.icons8.com/dotty/50/ffffff/rice-bowl.png" /></h5>

                <div class="left-to-right play-on-scroll delay-4">
                    <button>
                                Ordenar ahora
                        </button>
                </div>
            </div>

        </div>
    </section>
    <!-- END SECTION HOME -->
    <!-- SECION ABOUT -->
    <section class="about-fullheight align-items-center" id="about">
        <div class="container">
            <div class="row">
                <div class="col-7 h-xs">
                    <img src="images/platos.png" alt="" class="fullwidth left-to-right play-on-scroll">
                </div>
                <div class="col-5 col-xs-12 align-items-center">
                    <div class="about-slogan right-to-left play-on-scroll">
                        <h3><span class="oft">Ofrecemos Desayunos, Almuerzos y Platos a la Carta</span></h3>
                        </p>
                        <h3>
                            Hora de Atención
                        </h3>
                        <p class="calendar">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-calendar-stats" width="32" height="32" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffbf00" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <path d="M11.795 21h-6.795a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v4" />
                                <path d="M18 14v4h4" />
                                <circle cx="18" cy="18" r="4" />
                                <path d="M15 3v4" />
                                <path d="M7 3v4" />
                                <path d="M3 11h16" />
                                </svg>
                        </p>

                        <p>
                            Lunes-Viernes
                            <p>
                                7:00 am - 17:00 pm
                            </p>
                            <p>Fines de semana
                                <p>8:00 am - 16:00 pm</p>
                            </p>
                        </p>

                    </div>
                </div>
            </div>
    </section>
    <!-- END SECION ABOUT -->
    <!-- FOOD MENU SECTION -->
    <section class="align-items-center bg-img bg-img-fixed " id="menu" style="background-image: url('https://img.freepik.com/foto-gratis/cucharas-condimentos-polvo-espacio-copia_23-2148601204.jpg?size=626&ext=jpg'); ">
        <div class="container ">
            <div class="food-menu ">
                <h1>
                    <span class="primary-color">M</span> E<span class="primary-color">N</span> U</span>
                </h1>
                <p>
                    Ofrecemos servicio a domicilio con cualquiera de nuestros platos.
                </p>
                <div class="food-category ">
                    <div class="zoom play-on-scroll ">
                        <button class="active " data-food-type="all ">
                            Destacados
                        </button>
                    </div>
                    <div class="zoom play-on-scroll delay-2 ">
                        <button data-food-type="ipsum ">
                            Desayunos
                        </button>
                    </div>
                    <div class="zoom play-on-scroll delay-4 ">
                        <button data-food-type="salad ">
                            Almuerzos
                        </button>
                    </div>
                    <div class="zoom play-on-scroll delay-6 ">
                        <button data-food-type="dolor">
                            Platos a la Carta
                        </button>
                    </div>
                    <div class="zoom play-on-scroll delay-6 ">
                        <button data-food-type="lorem ">
                            Bebidas
                        </button>
                    </div>
                    <div class="zoom play-on-scroll delay-6 ">
                        <button data-food-type=" ">
                            Complementos
                        </button>
                    </div>

                </div>

                <div class="contenedor">

                <?php while($propiedad = mysqli_fetch_assoc($resultadoConsulta)):?>   
                
                
                    <div class="food-item salad-type " >
                        
                        <div class="item-wrap bottom-up play-on-scroll ">
                            <picture>
                            <div class="item-img ">
                                <div class="img-holder bg-img ">
                                <t><img src="imagenes/<?php echo $propiedad['imagen']; ?>" class="img-holder bg-img"></th>
                                </div>
                            </div>
                            </picture>
                            <div class="item-info ">
                                <div>

                                    <div>
                                        <span>
                                        <h3><?php echo $propiedad['nombre']; ?></h3>
                                        </span>
                                    </div>
                                    <div>
                                        <span>
                                        <td>$<?php echo $propiedad['precio']; ?></td>
                                        </span>
                                    </div>
                                    <div>
                                        <span>
                                        <td><?php echo $propiedad['categoriaId'];?></td>
                                        </span>
                                    </div>
                                    <div>
                                        <span>
                                        <td><?php echo $propiedad['descripcion']; ?></td>
                                        </span>
                                    </div>
                                </div>
                                <div class="cart-btn ">
                                    <i class="bx bx-cart-alt "></i>
                                </div>
                            </div>
                            
                        </div>
                    
                    </div>
<?php endwhile; ?>
                    
                    
    </section>
    <!-- END FOOD MENU SECTION -->
    <!-- TESTIMONIAL SECTION -->
    <section id="testimonial ">

    </section>
    <!-- END TESTIMONIAL SECTION -->
    <!-- FOOTER SECTION -->
    <footer>
        <div class="footer__container">
            <section class="footer__info  wm-95">
                <div class="footer__info--about">
                    <h3 class=" info__about--title "> Las Delicias de Alisson</h3>
                    <p class=" info__about--txt ">
                        Ofrece servicio a domicilio en toda la ciudad.
                    </p>
                </div>
                <div class=" footer__info--enlc ">
                    <h3 class="  info__about--title  center">Enlaces Rápidos</h3>
                    <ul class=" info__enlc--menu ">
                        <li class=" enlc__menu--item ">
                            <a href="#">Contacto</a>
                        </li>
                        <li class=" enlc__menu--item "><a href="Menu">Menu</a>
                        </li>
                        <li class=" enlc__menu--item "><a href="">Factura</a>
                        </li>
                    </ul>
                </div>
                <div class=" footer__info--contact ">
                    <h3 class=" info__about--title  ">Contactanos</h3>
                    <div class=" info__contact--content ">
                        <div class=" contact__content-icon ">
                            <i class=" fas fa-map-marker-alt "></i>
                        </div>
                        <p class=" info__about--txt ">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-map-pin" width="25" height="25" viewBox="0 0 24 24" stroke-width="2" stroke="#ffbf00" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <circle cx="12" cy="11" r="3" />
                            <path d="M17.657 16.657l-4.243 4.243a2 2 0 0 1 -2.827 0l-4.244 -4.243a8 8 0 1 1 11.314 0z" />
                            </svg> Dirección: Leonidas Dubles Caupicho 00593 Quito, Ecuador
                        </p>
                    </div>
                    <div class=" info__contact--content ">
                        <div class=" contact__content-icon ">
                            <i class=" fas fa-envelope "></i>
                        </div>
                        <p class=" info__about--txt ">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-mail" width="25" height="25" viewBox="0 0 24 24" stroke-width="2" stroke="#ffbf00" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <rect x="3" y="5" width="18" height="14" rx="2" />
                                <polyline points="3 7 12 13 21 7" />
                            </svg> Email: deliciasdeAlisoon@gmail.com
                        </p>
                    </div>
                    <div class=" info__contact--content ">
                        <div class=" contact__content-icon ">
                            <i class=" fas fa-phone-alt "></i>
                        </div>
                        <p class=" info__about--txt">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-phone" width="28" height="28" viewBox="0 0 24 24" stroke-width="2" stroke="#ffbf00" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <path d="M5 4h4l2 5l-2.5 1.5a11 11 0 0 0 5 5l1.5 -2.5l5 2v4a2 2 0 0 1 -2 2a16 16 0 0 1 -15 -15a2 2 0 0 1 2 -2" />
                            </svg> Llamar : 097 993 8251
                        </p>
                    </div>
                    <div class=" info__contact--content ">
                        <div class=" contact__content-icon ">
                            <i class=" fas fa-clock "></i>
                        </div>

                    </div>
                </div>
                <div class=" footer__info--media ">
                    <h3 class=" info__about--title  center">Redes Sociales</h3>
                    <ul class=" media__menu ">
                        <a href="https://www.facebook.com/Las-Delicias-De-Alison-Restaurant-157542087982435" target="_blank"><i class=" fab fa-facebook-f fb ">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-brand-facebook" width="32" height="32" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffbf00" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <path d="M7 10v4h3v7h4v-7h3l1 -4h-4v-2a1 1 0 0 1 1 -1h3v-4h-3a5 5 0 0 0 -5 5v2h-3" />
                            </svg></i>
                        </a>
                    </ul>

                </div>
            </section>
            <section class="footer__copy">
                <div class="footer__copy--content wm-95">
                    <p>2021 © Grupo_3 - ESPE| Todos los Derechos Reservados</p>
                </div>
            </section>
        </div>
    </footer>

    <!-- END FOOTER SECTION -->

    <script src="index.js "></script>
</body>

</html>