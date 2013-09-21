/*$('a[href=#about]').click(function(){
	$('.nav1').animate({"left":'-75%'}, 200);
	$('.nav2').animate({"left":'0%'}, 200);
	$('.nav1').hover(function(){ $('.nav1').animate({"left":'-50%'}, 70); }, function() { $('.nav1').animate({"left":'-75%'}, 70); });
})*/

navbar = {
	hidden: true,

	hide2: function() {
		if (!this.hidden)
		{
			this.hidden = true;
			this.onecol();
			$('.nav1').animate({"left":'0%'}, 200);
			$('.nav2').animate({"left":'0%'}, 200);
			$('.nav1').unbind('hover');	
		}
	},

	//Show the second column - popitout
	show2: function() {
		if (this.hidden)
		{
			this.hidden = false;
			this.twocol();
			$('.nav1').animate({"left":'-75%'}, 200);
			$('.nav2').animate({"left":'0%'}, 200);
			$('.nav1').hover(
				function(){
					$('.nav1').animate({"left":'-50%'}, 70);
				}, function() {
					$('.nav1').animate({"left":'-75%'}, 70);
				});
		}
	},

	//Hover events for the main column links
	onecol: function() {
		$('.nav-wrapper').unbind('hover').hover(
			function(){
				$('.nav-wrapper').animate({"left":"0%"}, 120);
			}, function(){
				$('.nav-wrapper').animate({"left":"-185px"}, 120);
			});
	},

	//Hover events for both columns - main links and sublinks
	twocol: function() {
		$('.nav-wrapper').unbind('hover').hover(
			function(){
				$('.nav1').animate({"left":"-75%"}, 70);
				$('.nav-wrapper').animate({"left":"0%"}, 70);
			}, function(){
				$('.nav1').animate({"left":"-35%"}, 70);
				$('.nav-wrapper').animate({"left":"-185px"}, 70);
			});
	}
}

$(function() {

	navbar.onecol();

	$('.nav1 ul.nav a').click(function(){
		parentli = $(this).parent();


		if (parentli.hasClass('dropdown')) {
			parentli.parent().find('li').removeClass('active');
			parentli.addClass('active');
		}

		if (parentli.hasClass('dropdown'))
		{
			$('.nav2 ul.nav').html(parentli.find('ul.dropdown-menu').html());
			$('.nav2 ul.nav a').click(function() {
				$(this).parent().parent().find('li').removeClass('active');
				$(this).parent().addClass('active');
			})
			navbar.show2();
			if (parentli.hasClass('user'))
			{
				$('.navbar').mouseleave(function(){
					navbar.hide2();
				});
			}

			return false; //if we have sub pages, let's not do a page load..?
		}
		else
		{
			navbar.hide2();
		}
	})
});






