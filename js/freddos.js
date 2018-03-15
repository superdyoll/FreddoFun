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

	// Add bodies
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

	// Create all the freddos
	// TODO: Randomise Freddo creation
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

	// Add the freddos to the world
	World.add(world, stack);

	// Make freddos draggable
	var mouseConstraint = MouseConstraint.create(engine);
	World.add(engine.world, mouseConstraint);

	// Make canvas
	canvas.width = window.innerWidth;
	canvas.height = window.innerHeight;
	
	// Resize canvase
	// TODO: Resize boundary
	window.addEventListener("resize", function(){
		canvas.width = window.innerWidth;
		canvas.height = window.innerHeight;
	});

	// run the engine
	Engine.run(engine);
	Render.run(render);
};