<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Liste bornée avec formulaire et pagination</title>
    </head>
    <body>
        <?php
        $PAGE_SIZE = 20;

        if (isset($_GET["inf"]) && isset($_GET["sup"])) {
            $inf = $_GET["inf"];
            $sup = $_GET["sup"];

            $page = 0;
            if (isset($_GET["page"]) && is_numeric($_GET["page"]))
                $page = (int) $_GET["page"];
            if (is_numeric($inf) && is_numeric($sup)) {
                $inf = (int) $inf;
                $sup = (int) $sup;
                $num_pages = (int) (($sup - $inf + $PAGE_SIZE) / $PAGE_SIZE);
                if ($page < 0 || $page >= $num_pages)
                    $page = 0;
                $start = $inf + $page * $PAGE_SIZE;
                $end = min($sup + 1, $start + $PAGE_SIZE);
                echo "<ul>";
                for ($i = $start; $i < $end; ++$i) {
                    echo "<li>" . $i . "</li>";
                }
                echo "</ul>";

                $next_page = $page + 1;
                if ($page > 0)
                    echo "<a href='?inf=$inf&sup=$sup&page=" . ($page - 1) . "'>&lt;&lt;</a> ";
                for ($i = 0; $i < $num_pages; ++$i) {
                    echo "<a href='?inf=$inf&sup=$sup&page=$i'>" . ($inf + $i * $PAGE_SIZE) . "</a> ";
                }
                if ($page + 1 < $num_pages)
                    echo "<a href='?inf=$inf&sup=$sup&page=" . ($page + 1) . "'>>></a>";

                echo "<p><a href='?'>Modifier paramètres</a></p>";
            }
            else {
                echo "<p>les paramètres ne sont pas numériques</p>";
            }
        } else {
            ?>
            <form method="get" action="">
                <p><input type="number" name="inf" value="1" required/></p>
                <p><input type="number" name="sup" value="150" required/></p>
                <p><input type="submit"/></p>
            </form>
            <?php
        }
        ?>
    </body>
</html>