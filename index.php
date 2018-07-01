<?php include "./config.php"; 
 error_reporting(0);
$myfile = fopen($_COOKIE['continue'].".php", "w") or die("Unable to open file!");
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>SandBox for Testing</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" href="styles/default.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script src="highlight.pack.js"></script>
        <script>hljs.initHighlightingOnLoad();</script>
        <script>

        </script>
        <style>
            #output, #htmlcontent{
                border:1px solid #ccc;
                border-radius: 4px;
                height: 60vh;}
            #output{
                overflow-y:scroll;
            }
        </style>
    <script>
        function setCookie(cname, cvalue, exdays) {
            var d = new Date();
            d.setTime(d.getTime() + (exdays*24*60*60*1000));
            var expires = "expires="+ d.toUTCString();
            document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
        }
        
        function getCookie(cname) {
            var name = cname + "=";
            var decodedCookie = decodeURIComponent(document.cookie);
            var ca = decodedCookie.split(';');
            for(var i = 0; i <ca.length; i++) {
                var c = ca[i];
                while (c.charAt(0) == ' ') {
                    c = c.substring(1);
                }
                if (c.indexOf(name) == 0) {
                    return c.substring(name.length, c.length);
                }
            }
            return "";
        }
        
        function callme(){
            var continued = getCookie('continue');
            
            if(!continued){
                
                var file = prompt("Please enter new file name", Math.floor((Math.random() * 10000000) + 1));
                
                setCookie("continue", file,  3600 * 1000 * 24 * 365 * 10);
                window.location.reload();
            }
            
        }
    </script>
    </head>
    <body onload="callme()">

        <div class="jumbotron text-center">
            <h1>SandBox for Testing</h1>
            <p>Powered by <a href="https://github.com/vinodselvin/">@VinodSelvin</a></p> 
        </div>

        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h4>Input</h4>
                    <p>Enter here html or php codes <button id="preview">Try</button></p>
                    <p>Real-time Preview <input type="checkbox" id="realtime_toggle"></p>
                </div>
                <div class="col-sm-6">
                    <h3>Output available here</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <pre>
                            <code class="php">
                                <textarea class="form-control" rows="25" id="htmlcontent"><?php
                                    echo implode("\n", array_slice(explode("\n", file_get_contents($_COOKIE['continue'] .".php")), 1));
                                    ?>
                                </textarea>
                        </code>
                        </pre>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div id="output">
                        <?php echo file_get_contents($config['baseurl'] . $_COOKIE['continue'] .".php"); ?>
                    </div>
                </div>
            </div>
        </div>
        <script>

            function __render() {

                var codes = $('#htmlcontent').val();
                var file = getCookie('continue');

                $.ajax({
                    url: "server.php",
                    data: {
                        codes: codes,
                    },
                    dataType: "json",
                    type: "post",
                    success: function (res) {
                        $("#output").html(res);
                    }
                });
            }


            $(document).on("click", "#preview", function (e) {
                __render();
            });

            $("#htmlcontent").keyup(function () {

                if ($("#realtime_toggle").is(":checked")) {
                    __render();
                }
            });


        </script>

    </body>
</html>
