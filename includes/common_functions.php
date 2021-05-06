<?php

function paginacion($pags, $pagina, $busqueda, $enlace)
{
?>
    <div class="row mt-5">
        <div class="col text-center">
            <div class="block-27">
                <ul>
                    <?php
                    if ($pagina > 1) {
                    ?>
                        <li><a href="<?php echo $enlace?>numPag=<?php echo ($pagina - 1) ?>&buscar=<?php echo $busqueda ?>">&lt;</a></li>
                    <?php
                    }
                    if ($pags <= 4) {
                        for ($i = 1; $i <= $pags; $i++) {
                    ?>
                            <li <?php if ($pagina == $i) echo "class='active'"  ?>><a href="<?php echo $enlace?>numPag=<?php echo $i ?>&buscar=<?php echo $busqueda ?>"> <?php echo $i  ?></a></li>
                        <?php
                        }
                    } elseif (($pagina == $pags or (($pags - 1) ==  $pagina)) and $pags >= 5) {
                        for ($i = $pags - 4; $i <= $pags; $i++) {
                        ?>
                            <li <?php if ($pagina == $i) echo "class='active'"  ?>><a href="<?php echo $enlace?>numPag=<?php echo $i ?>&buscar=<?php echo $busqueda ?>"> <?php echo $i  ?></a></li>
                        <?php
                        }
                    } elseif ($pagina == 1 or $pagina == 2) {
                        for ($i = 1; $i <= 5; $i++) {
                        ?>
                            <li <?php if ($pagina == $i) echo "class='active'"  ?>><a href="<?php echo $enlace?>numPag=<?php echo $i ?>&buscar=<?php echo $busqueda ?>"> <?php echo $i  ?></a></li>
                        <?php
                        }
                    } else {
                        for ($i = $pagina - 2; $i <= $pagina + 2; $i++) {
                        ?>
                            <li <?php if ($pagina == $i) echo "class='active'"  ?>><a href="<?php echo $enlace?>numPag=<?php echo $i ?>&buscar=<?php echo $busqueda ?>"> <?php echo $i  ?></a></li>
                        <?php
                        }
                    }
                    if ($pagina < $pags) {
                        ?>

                        <li><a href="<?php echo $enlace?>numPag=<?php echo ($pagina + 1) ?>&buscar=<?php echo $busqueda ?>">&gt;</a></li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </div>
<?php

}
?>