var data_links = "../assets/links.json";

$(document).ready(function() {
    $.getJSON(data_links, function(data) {
        var mysource = $("#links-template").html();
        var mytemplate = Handlebars.compile(mysource);
        var myresult = mytemplate(data);
        $("#links").html(myresult);
    });
});

var data_apps = "../assets/apps.json";

$(document).ready(function() {
    $.getJSON(data_apps, function(data) {
        var mysource = $("#apps-template").html();
        var mytemplate = Handlebars.compile(mysource);
        var myresult = mytemplate(data);
        $("#apps").html(myresult);
    });
});

function loadConfig() {
    var configFile = "../config.json";
    var themesFile = "../themes.json";

    $.getJSON(configFile, function(config) {
        // set name
        const name = config.name;
        window.document.title = name;
        // set theme
        const themeName = config.theme;
        $.getJSON(themesFile, function(themes) {
            const theme = themes.filter(val => val.name === themeName)[0];

            for (const property in theme) {
                if (property !== "name") {
                    document.documentElement.style.setProperty(
                        `--${property}`,
                        theme[property]
                    );
                    const input = document.querySelector(`#${property}`);
                    if (input) {
                        value = value.replace("px", "");
                        input.value = value;
                    }
                }
            }
        });
    });
}

$(document).ready(function() {
    loadConfig();
});
