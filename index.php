<html>
<?php
    $page = file_get_contents('https://southamptonsummer.ssago.org/');
    $doc = new DOMDocument();
    $doc->loadHTML($page);
    $club_tag = $doc->getElementsByTagName('h3')->item(0)->nodeValue;
    preg_match('/\((\d+)\)/', $club_tag, $matches);
    $number_freddos = $matches[1];
    $pounds = number_format($number_freddos * 0.3, 2);
?>
<head>
	<title>Jakes Freddo Counter</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<script src="matter.js" type="text/javascript"></script>
	<script>
// Matter.js module aliases
var Engine = Matter.Engine,
  Render = Matter.Render,
  World = Matter.World,
  Body = Matter.Body,
  Bodies = Matter.Bodies,
  Composites = Matter.Composites,
  Composite = Matter.Composite,
  Constraint = Matter.Constraint,
  MouseConstraint = Matter.MouseConstraint;

window.onload = function() {
  var canvas = document.getElementById('canvas');


  var engine = Engine.create(),
      world = engine.world;

  var render = Render.create({
      canvas: canvas,
      engine: engine,
      options: {
          background: 'transparent',
          wireframes: false
      }
  });

    // add bodies
    var offset = 10,
        options = { 
            isStatic: true
        };

    world.bodies = [];

    // these static walls will not be rendered in this sprites example, see options
    World.add(world, [
        Bodies.rectangle(window.innerWidth/2, -offset, window.innerWidth + 0.5 + 2 * offset, 50.5, options),
        Bodies.rectangle(window.innerWidth/2, window.innerHeight + offset, window.innerWidth + 0.5 + 2 * offset, 50.5, options),
        Bodies.rectangle(window.innerWidth + offset, window.innerHeight/2, 50.5, window.innerHeight + 0.5 + 2 * offset, options),
        Bodies.rectangle(-offset, window.innerHeight/2, 50.5, window.innerHeight + 0.5 + 2 * offset, options)
    ]);  

var stack = Composites.stack(20, 20, <?=$number_freddos?>, 1,  0, 0, function(x, y) {
            return Bodies.rectangle(x, y, 66, 160, {
                force: {x: 0.4, y: -0.1},
                render: {
                    strokeStyle: '#ffffff',
                    sprite: {
                        texture: './small-freddo.png'
                    }
                }
            });
    });

    World.add(world, stack);

var mouseConstraint = MouseConstraint.create(engine);

World.add(engine.world, mouseConstraint);

  canvas.width = window.innerWidth;
  canvas.height = window.innerHeight;
  window.addEventListener("resize", function(){
     canvas.width = window.innerWidth;
     canvas.height = window.innerHeight;
  });

  // run the engine
  Engine.run(engine);

  Render.run(render);

};
	</script>
	<style>
html,body{
	height: 100%;
}
#money{
	font-size:5rem;
}
canvas{
	z-index: 100;
	position: absolute;
}
	</style>
</head>
<body>
	<canvas id="canvas"></canvas>
	<div class="container">
		<div class="row h-100 align-items-center">
			<div class="col text-center align-center">
				<h2>Amount Jake has to spend on freddos</h2>
				<p>Assuming the price of a freddo is 30p</p>
				<h1 id="money">&pound;<?=$pounds?></h1>
			</div>
		</div>
	</div>
</body>
</html>
