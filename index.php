<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Xml Feed sample">
    <meta name="author" content="Luis Ernesto Assandri">
    <title>XML Feed</title>
    <link rel="stylesheet" href="static/css/custom.css">
    <link rel="stylesheet" href="static/bootstrap/css/bootstrap.css">
</head>

<body class="bg-dark">

<header>
    <div class="navbar navbar-dark bg-dark shadow-sm">
        <div class="container-fluid text-white">
                Dealers League LTD
        </div>
    </div>
</header>

<main role="main">

    <section class="jumbotron text-center">
        <div class="container">
            <h1>XML Feed</h1>
            <p class="lead text-muted">
                XML Feed build in plain PHP with bootstrap.
        </div>
    </section>

    <?php
    //$url = "http://idealboat.com/feed.xml";
    $url = "feed.xml";
    $xml = simplexml_load_file($url);
    ?>

    <div class="container-fluid">

        <div class="row">
            <div class="col-lg-12 bg-dark text-white text-center mb-3 h5">
                <?=
                $xml->broker->broker_details->company_name;
                ?>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12 p-3">
                <?php
                foreach ($xml->broker->offices as $office) {
                    echo "<div class='offices-container__card'>";
                    foreach ($office as $attributes) {
                        foreach ($attributes as $key => $value) {
                            echo ucfirst(str_replace('_', ' ', $key)) . ': ' . $value . '<br>';

                            if (is_object($value)) {
                                foreach ($value as $k => $v) {
                                    echo ucfirst(str_replace('_', ' ', $k)) . ': ' . $v . '<br>';
                                }
                            }
                        }
                    }
                    echo "</div>";
                }
                ?>
            </div>
        </div>

        <div class="grid-container mb-3">
            <?php
            foreach ($xml->broker->adverts as $advert) {
                foreach ($advert as $attributes) {
                    echo '<div class="card mb-4 shadow-sm p-3">';
                    foreach ($attributes as $key => $value) {
                        switch ($key) {
                            case 'advert_media':
                                foreach ($value as $k => $v) {
                                    if ($v['primary'] == 1) {
                                        echo "<img src='$v' class='advert-picture'>";
                                    }
                                }
                                break;
                            case 'advert_features':
                                echo '<div class="mt-3">';
                                echo "<div class='sub-title'>Advert features</div>";
                                foreach ($value as $k => $v) {
                                    if ($v != '') {
                                        if ($k == 'asking_price') {
                                            echo '<b>' . ucfirst(str_replace('_', ' ', $k)) . ': </b><span class="price">' . strip_tags($v, '<br>'). ' ' . $v['currency'] . '</span><br>';
                                        } else {
                                            echo '<b>' . ucfirst(str_replace('_', ' ', $k)) . ': </b>' . strip_tags($v, '<br>') . '<br>';
                                        }
                                    }
                                    if (is_object($v)) {
                                        foreach ($v as $xkey => $xvalue) {
                                            if ($xvalue) {
                                                echo '<b>' . ucfirst(str_replace('_', ' ', $xkey)) . ': </b>' . strip_tags($xvalue, '<br>') . '<br>';
                                            }

                                        }
                                    }
                                }
                                echo '</div>';
                                break;
                            case 'boat_features':
                                echo '<div class="mt-3">';
                                echo "<div class='sub-title'>Boat features</div>";
                                foreach ($value as $k => $v) {
                                    if ($v != '') {
                                        echo '<b>' . ucfirst(str_replace('_', ' ', $v['name'])) . ': </b>' . strip_tags($v, '<br>') . '<br>';
                                    }
                                    if (is_object($v)) {
                                        if ($k == 'dimensions') {
                                            echo '<b>' . ucfirst(str_replace('_', ' ', $k)) . ': </b><br>';
                                        }
                                        foreach ($v as $xkey => $xvalue) {

                                            if ($xvalue != '') {
                                                echo '<b>' . ucfirst(str_replace('_', ' ', $xvalue['name'])) . ': </b>' . strip_tags($xvalue, '<br>') . '<br>';
                                            }
                                        }
                                    }
                                }
                                echo '</div>';
                                break;
                        }
                    }
                    echo '</div>';
                }

            }
            ?>
        </div>

    </div>

</main>

<footer class="text-muted">
    <div class="container">

    </div>
</footer>
</body>
</html>

