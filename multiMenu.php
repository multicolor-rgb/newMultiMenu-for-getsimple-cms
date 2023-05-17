<?php


$thisfile = basename(__FILE__, ".php");

# register plugin
register_plugin(
	$thisfile, //Plugin id
	'MultiMenu', 	//Plugin name
	'2.0', 		//Plugin version
	'Multicolor',  //Plugin author
	'https://www.paypal.com/paypalme/multicol0r', //author website
	'Plugin to create multiple menus', //Plugin description
	'pages', //page type - on which admin tab to display
	'showMultiMenu'  //main function (administration)
);



# add a link in the admin tab 'theme'
add_action('pages-sidebar', 'createSideMenu', array($thisfile, 'MultiMenu Settings'));



function showMultiMenu()
{


	global $SITEURL;
	global $GSADMIN;

	if (isset($_GET['addMultiMenu'])) {
		include(GSPLUGINPATH . 'multiMenu/addNew.php');
	} else {
		include(GSPLUGINPATH . 'multiMenu/settings.php');
	}


	echo '<form action="https://www.paypal.com/cgi-bin/webscr" class="moneyshot" method="post" target="_top" style="display:block;text-align:center;">
        <p style="margin:0;padding:0;margin-bottom:10px;">Support my work:)</p>
        <input type="hidden" name="cmd" value="_s-xclick" />
        <input type="hidden" name="hosted_button_id" value="KFZ9MCBUKB7GL" />
        <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donate_SM.gif" border="0" name="submit" title="PayPal - The safer, easier way to pay online!" alt="Donate with PayPal button" />
        <img alt="" border="0" src="https://www.paypal.com/en_PL/i/scr/pixel.gif" width="1" height="1" />
        </form>
        ';
}






function multiMenu($name, $classUl = '', $classLi = '', $classUlLi = '')
{

	global $SITEURL;

	$files = file_get_contents(GSDATAOTHERPATH . 'multiMenu/' . $name . '.json');
	$reJsonFiles = json_decode($files);





	echo '<ul class="' . $classUl . '">';


	global $SITEURL;
	foreach ($reJsonFiles as $item) {



		$check = GSDATAPAGESPATH . $item->href . '.xml';
		$xml = @simplexml_load_file($check);


		if (file_exists($check)) {

			if ($xml->parent == '') {
				$parent = '';
			} else {
				$parent = $xml->parent;
				$parent .= '/';
			};


			echo '<li class="' . $classLi . (isset($item->children) ? 'parent' : '') . '">
			<a href="'

				. find_url($item->href, (string)$xml->parent) .


				'" target="' . $item->target . '" class="' . (return_page_slug() == $item->href ? 'active' : '') . '">' . $item->text . '</a>';


			if (isset($item->children)) {
				echo '<ul class="' . $classUlLi . '">';
				foreach ($item->children as $subitem) {

					$checkSub = GSDATAPAGESPATH . $subitem->href . '.xml';

					$xmlSub = @simplexml_load_file($checkSub);


					if (file_exists($checkSub)) {

						echo '<li class="' . $classLi . '"><a  class="' . (return_page_slug() == $subitem->href ? 'active' : '') . '" href="' . find_url($subitem->href, (string)$xmlSub->parent) . '" target="' . $subitem->target . '">' . $subitem->text . '</a>';
					};

					//sub-sub


					if (isset($subitem->children)) {
						echo '<ul class="' . $classUlLi . '">';
						foreach ($subitem->children as $subsubitem) {
							$checkSubSub = GSDATAPAGESPATH . $subsubitem->href . '.xml';
							$xmlSubSub = @simplexml_load_file($checkSubSub);



							if (file_exists($checkSubSub)) {
								echo '<li class="' . $classLi . '">
								<a href="' .  find_url($subsubitem->href, (string)$xmlSubSub->parent) . '" class="' . (return_page_slug() == $subsubitem->href ? 'active' : '') . '"  target="' . $subsubitem->target . '">' . $subsubitem->text . '</a></li>';
							};
						};
						echo '</ul>';
					};

					//end


					echo '</li>';
				};
				echo '</ul>';
			};

			echo '</li>';
		};
	};

	echo '</ul>';
};
