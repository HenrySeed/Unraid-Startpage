<!DOCTYPE html>
<html>

<head>
    <!-- Meta -->
    <title>-</title>
    <meta charset="utf-8" />
    <meta http-equiv="Default-Style" content="" />
    <meta content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no"
        name="viewport" />

    <!-- Scripts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,500,700,900" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/handlebars.js/4.1.1/handlebars.min.js"></script>
    <script src="https://code.iconify.design/1/1.0.0-rc7/iconify.min.js"></script>

    <!-- Assets for Favicons and Theme -->
    <link rel="apple-touch-icon" sizes="180x180" href="assets/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="assets/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/favicon-16x16.png">
    <link rel="manifest" href="assets/site.webmanifest">
    <link rel="mask-icon" href="assets/safari-pinned-tab.svg" color="#f44229">
    <link rel="shortcut icon" href="assets/favicon.ico">
    <meta name="msapplication-TileColor" content="#f44229">
    <meta name="msapplication-config" content="assets/browserconfig.xml">
    <meta name="theme-color" content="#f44229">

    <!-- Stylesheets -->
    <link type="text/css" rel="stylesheet" href="./css/styles.css" media="screen,projection" />
    <link type="text/css" rel="stylesheet" href="./css/modal.css" media="screen,projection" />
    <link type="text/css" rel="stylesheet" href="./css/header.css" media="screen,projection" />

</head>

<body onload="loadFunctions()">
    <div id="container" class="fade">
        <div id="header_greet" class="tile"></div>
        <div id="header_date" class="tile"></div>
        <div id="header_temp" class="tile">
            <?php
				$output = exec('cat /sys/class/thermal/thermal_zone0/temp') / 1000;
				echo "<span class='tempOutput'>$output</span> °C";			
            ?>
            <span class='cpuLabel'>CPU</span>
        </div>

        <div id="apps" class="section">
            <script type="text/handlebars-template" id="apps-template">
                <h3>Applications</h3>
				<div id="apps_loop">
					{{#apps}}
                        <a class="appLink" href="http://{{url}}">
                            <div class="apps_item">
                                <div class="apps_icon">
                                    <span class="iconify icon" data-icon="{{icon}}"></span>
                                </div>
                                <div class="apps_text">
                                    {{name}}
                                    <span>{{url}}</span>
                                </div>
                            </div>
                        </a>
					{{/apps}}
				</div>
			</script>
        </div>

        <!-- Experimental automatic project loading with PHP -->
        <?php
            $configFile = file_get_contents('./config.json');
            $config = json_decode($configFile, true);
            $projectDir = $config["projectsDir"];

            if($projectDir !== ""){
                echo "<div class='section'><h3>Projects</h3> <span id='projects_table'>";
                $black_list = array('.git', ".", "..", ".DS_Store");

                if ($handle = opendir($projectDir . "/")) {
                    while (false !== ($file = readdir($handle))) {
                        if (in_array($file, $black_list)) continue;
                        echo "<a href='http://hank.local/{$projectDir}/..{$file}'>{$file}</a>";
                    }
                    closedir($handle);
                }
                echo "</span></div>";
            }
        ?>


        <div id="links" class="section">
            <script type="text/handlebars-template" id="links-template">
                <h3>Bookmarks</h3>
                <div id="links_loop">
                    {{#bookmarks}}
                        <div id="links_item">
                            <h4>{{category}}</h4>
                            {{#links}}
                                <a href="{{url}}" class="theme_color-border theme_text-select">{{name}}</a>
                            {{/links}}
                        </div>
                    {{/bookmarks}}
                </div>
            </script>
        </div>

        <script src="./js/loadConfig.js" type="text/javascript"></script>
        <script src="./js/timeGreeting.js" type="text/javascript"></script>
</body>

</html>