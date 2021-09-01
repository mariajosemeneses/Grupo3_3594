<?php include_once "encabezado.php" ?>
<?php
include_once "funciones.php";
$propiedades = obtenerProductos();
?>
<div class="columns">
    <div class="column">
        <h2 class="is-size-2">Tienda</h2>
    </div>
</div>
<?php foreach ($propiedades as $producto) { ?>

    <div class="columns">
        <div class="column is-full">
            <div class="card">
                <header class="card-header">
                    <p class="card-header-title is-size-4">
                        <?php echo $producto->nombre ?>
                    </p>
                </header>
                <div class="card-content">
                    <div class="content">
                        <?php echo $producto->descripcion ?>
                    </div>
                    <h1 class="is-size-3">$<?php echo number_format($producto->precio, 2) ?></h1>
                   
                    <?php if (productoYaEstaEnCarrito($producto->idpropiedades)) { ?>
                        <form action="eliminar_del_carrito.php" method="post">
                            <input type="hidden" name="idPropiedades" value="<?php echo $producto->idpropiedades ?>">
                            <span class="button is-success">
                                <i class="fa fa-check"></i>&nbsp;En el carrito
                            </span>
                            <button class="button is-danger">
                                <i class="fa fa-trash-o"></i>&nbsp;Quitar
                            </button>
                        </form>
                    <?php } else { ?>
                        <form action="agregar_al_carrito.php" method="post">
                            <input type="hidden" name="idPropiedades" value="<?php echo $producto->idpropiedades ?>">
                            <button class="button is-primary">
                                <i class="fa fa-cart-plus"></i>&nbsp;Agregar al carrito
                            </button>
                        </form>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
<?php } ?>
<?php include_once "pie.php" ?>