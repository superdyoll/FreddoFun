<html>
    <?php
    $page = file_get_contents('https://southamptonsummer.ssago.org/');
    $doc = new DOMDocument();
    $doc->loadHTML($page);
    foreach ($doc->getElementsByTagName('h3') as $heading){
        $club_tag = $heading->nodeValue;
        preg_match('/\((\d+)\)/', $club_tag, $matches);
        $number_freddos += $matches[1];
    }
    $pounds = number_format($number_freddos * 0.3, 2);
?>
    <head>
        <title>Jake's Freddo Counter</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <script src="js/matter.js" type="text/javascript"></script>
		<script src="js/freddos.js" freddos="<?=$number_freddos?>" type="text/javascript"></script>
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
			a {
			    z-index: 200;
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
					
					<h4>Want more freddos?</h4>
					<p>Fill in the form now at southamptonsummer.ssago.org</p>
                </div>
            </div>
        </div>
    </body>
</html>
