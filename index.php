<?php include "./config.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>SandBox for Testing</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
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
</head>
<body>

<div class="jumbotron text-center">
  <h1>SandBox for Testing</h1>
  <p>Powered by SwitchMe Technologies</p> 
</div>
  
<div class="container">
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
		<textarea class="form-control" rows="25" id="htmlcontent"><?php 
				echo implode("\n", array_slice(explode("\n", file_get_contents("output.php")), 1));
			?></textarea>
	  </div>
    </div>
    <div class="col-sm-6">
      <div id="output">
		<?php echo file_get_contents($config['baseurl'] . "output.php"); ?>
      </div>
    </div>
  </div>
</div>
<script>
	  
	function __render(){
		  
		var codes = $('#htmlcontent').val();
		
		$.ajax({
            url: "server.php",
            data: {
				codes : codes
				},
            dataType: "json",
            type: "post",
            success: function (res) {
				$("#output").html(res);
            }
        });
	}
	
	  
	$(document).on("click","#preview", function(e){
		__render();
	});
	
	$("#htmlcontent").keyup(function(){
		
		if($("#realtime_toggle").is(":checked")){	
			__render();
		} 
	});
	

</script>

</body>
</html>
