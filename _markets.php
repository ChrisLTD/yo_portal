<div class="markets">	
		<h2>Markets</h2>
		<ul>
		
			<?  $item = $markets->get_item(0); //Get S&P 500 
				$description = $item->get_description();
				$splitdescription = explode(" ", $description);
				$pricechange = $splitdescription[7];
			?>
			<li><a href="<?=$item->get_link();?>"><strong>S&amp;P 500</strong> 
			<? if(strpos($pricechange, "-") === 0) //If the negative sign is the 1st char
					{ echo '<span class="down">' . $pricechange . '</span>';} 
			   else{
			   		{ echo '<span class="up">' . $pricechange . '</span>';} 
			   }
			?></a></li>
			
			<?  $item = $markets->get_item(1); //Get Dow Jones 
				$description = $item->get_description();
				$splitdescription = explode(" ", $description);
				$pricechange = $splitdescription[7];
			?>
			<li><a href="<?=$item->get_link();?>"><strong>Dow Jones</strong> 
			<? if(strpos($pricechange, "-") === 0) //If the negative sign is the 1st char
					{ echo '<span class="down">' . $pricechange . '</span>';} 
			   else{
			   		{ echo '<span class="up">' . $pricechange . '</span>';} 
			   }
			?></a></li>
			
			<?  $item = $markets->get_item(2); //Get NASDAQ 
				$description = $item->get_description();
				$splitdescription = explode(" ", $description);
				$pricechange = $splitdescription[7];
			?>
			<li><a href="<?=$item->get_link();?>"><strong>NASDAQ</strong> 
			<? if(strpos($pricechange, "-") === 0) //If the negative sign is the 1st char
					{ echo '<span class="down">' . $pricechange . '</span>';} 
			   else{
			   		{ echo '<span class="up">' . $pricechange . '</span>';} 
			   }
			?></a></li>
	
		</ul> 
	</div><!--/markets-->

	
	<br>