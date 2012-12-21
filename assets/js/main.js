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

	onecol: function() {
		$('.navbar').unbind('hover').hover(
			function(){
				$('.navbar').animate({"left":"0%"}, 70);
			}, function(){
				$('.navbar').animate({"left":"-10%"}, 70);
			});
	},

	twocol: function() {
		$('.navbar').unbind('hover').hover(
			function(){
				$('.nav1').animate({"left":"-75%"}, 70);
				$('.navbar').animate({"left":"0%"}, 70);
			}, function(){
				$('.nav1').animate({"left":"-35%"}, 70);
				$('.navbar').animate({"left":"-10%"}, 70);
			});
	}
}

$(function() {
	$('.container').css('margin-left', (parseInt($('.navbar').css('width'), 10) + parseInt($('.navbar').css('left'), 10)) + 'px');

	navbar.onecol();

	$('.nav1 ul.nav a').click(function(){
		parentli = $(this).parent();

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
		}
		else
		{
			navbar.hide2();
		}
		if (!parentli.hasClass('user')) {
			parentli.parent().find('li').removeClass('active');
			parentli.addClass('active');
		}
	})
});





