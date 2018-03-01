<div style="font-size:14px;clear:both;"><div class="menu-footer" style="clear:both;">
  <a href="#" onclick="alert('Мы - команда OpenVK, и это клон ВКонтакте, но с открытым исходным кодом (который ещё не опубликован) под лицензией GPL (GNU General Public License). Ознакомиться с ней можно по ссылке: http://openvk.gfx3336007.com/LICENSE.txt');">о нас</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="blogs.php">блог</a>
</div>
<p class="about-footer" style="font-size:11px;clear:both;">OpenVK - Клон ВКонтакте с открытым исходным кодом. Лицензия: <a href="LICENSE.txt">GNU General Public License v3.0</a>.<br>Copyright (C) 2017-<?php echo date("Y",time()); ?> <a href="http://vk.com/openvk.onion">OpenVK Team</a><? if($user1['groupu'] == "1" || $user1['groupu'] == "2"){ ?> <a href="#" onclick="messagesWindow();">...</a><?php } ?></p></div>
<br><script type="text/javascript" src="js/jquery/jquery.js"></script>
	<script type="text/javascript" src="js/jquery/jquery-ui.js"></script>
	<script type="text/javascript" src="js/jquery/window/jquery.window.js"></script>
	<? if($user1['groupu'] == "1" || $user1['groupu'] == "2"){ ?>
	<script type="text/javascript">
		function messagesWindow() {
			$.window({
				icon: "img/favicon.png",
				title: "Сообщения",
				content: "<text>Привет! Меня ещё не зафункционировали, но скоро появлюсь на свет!</text>"//,
				//footerContent: "<div style='color:gray;'>я нижняя строка</div>"
			});
		}
	</script>
	<?php } ?>