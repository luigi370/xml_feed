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

<body>

<header>
    <div class="navbar navbar-dark bg-dark shadow-sm">
        <div class="container d-flex justify-content-between">
            <a href="#" class="navbar-brand d-flex align-items-center">
                <strong>Dealers League LTD</strong>
            </a>
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
    $url = "feed.xml";
    $xml = simplexml_load_file($url);
    ?>

    <div class="container-fluid">

        <div class="row">
            <div class="col-lg-12 bg-dark text-white text-center">
                <?=
                $xml->broker->broker_details->company_name;
                ?>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12 office-card mb-5 p-3">
                <?php
                foreach ($xml->broker->offices as $office) {
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
                            /*case 'advert_features':
                                echo '<div class="mt-3">';
                                foreach ($value as $k => $v) {
                                    echo ucfirst(str_replace('_', ' ', $k)) . ': ' . $v . '<br>';
                                    if (is_object($v)) {
                                        foreach ($v as $xkey => $xvalue) {
                                            if ($xvalue) {
                                                echo ucfirst(str_replace('_', ' ', $xkey)) . ': ' . $xvalue . '<br>';
                                            }

                                        }
                                    }
                                }
                                echo '</div>';
                                break;*/
                            case 'boat_features':
                                echo '<div class="mt-3">';
                                foreach ($value as $k => $v) {
                                    if ($v != '') {
                                        echo '<b>' . ucfirst(str_replace('_', ' ', $v['name'])) . ': </b>' . $v . '<br>';
                                    }
                                    if (is_object($v)) {
                                        foreach ($v as $xkey => $xvalue) {
                                            if ($xvalue != '') {
                                                echo '<b>' . ucfirst(str_replace('_', ' ', $xvalue['name'])) . ': </b>' . $xvalue . '<br>';
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
<script src="static/bootstrap/js/bootstrap.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
<script>window.jQuery || document.write('<script src="/docs/4.5/assets/js/vendor/jquery.slim.min.js"><\/script>')</script>
<script src="/docs/4.5/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-1CmrxMRARb6aLqgBO7yyAxTOQE2AKb9GfXnEo760AUcUmFx3ibVJJAzGytlQcNXd"
        crossorigin="anonymous"></script>
</body>
</html>

