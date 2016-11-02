<?php
####################################################################
# File Name : admin_home.php
# Location  : /WEBROOT/
####################################################################

require "templates/admin_home_header.php";
$menu_name      = $inlude_menu_page   = $menu_title = "";
$profile_menu_active= $news_menu_active = $photo_menu_active = $todo_menu_active =  $dashboard_menu_active =  $meal_menu_active = 
$revenue_menu_active = "";

if(isset($_REQUEST['menu']) && $_REQUEST['menu'] != "")   $menu_name    = $_REQUEST['menu'];
//echo "menu_name : ".$menu_name;
switch($menu_name)
{
  case 'profile':     
            $inlude_menu_page   = "menu_profile.php";   
            $menu_title       = "Profile Management";     
            $profile_menu_active  = "menu-top-active";  
            break;
  case 'news':   
            $inlude_menu_page   = "menu_news.php";  
            $menu_title       = "News Management"; 
            $news_menu_active = "menu-top-active";  
            break;
  case 'todo':     
            $inlude_menu_page   = "menu_todo.php";   
            $menu_title       = "Task Todo";  
            $todo_menu_active = "menu-top-active";  
            break;
  case 'meals':     
            $inlude_menu_page   = "menu_meals.php";    
            $menu_title       = "Meal Planer"; 
            $meals_menu_active   = "menu-top-active";  
            break;  
  case 'photos':      
            $inlude_menu_page   = "menu_photos.php";    
            $menu_title       = "Photo Wall";  
            $photos_menu_active   = "menu-top-active";
            break;  
  case 'revenue':       
            $inlude_menu_page   = "menu_revenue.php";     
            $menu_title       = "Revenue Management"; 
            $revenue_menu_active  = "menu-top-active";
            break;      
            
  case 'dashboard':
  case '':    
  default:        
            $inlude_menu_page   = "menu_dashboard.php"; 
            $menu_title       = "Dashboard";    
            $dashboard_menu_active  = "menu-top-active";  
            break;
}
# List Of Schemas
$restaurantOwners = "restaurant_owners";
$restGeoLocInfo   = "restaurant_location_geo_info";
$restAdBanners    = "ad_banners_by_restaurants";
$restFoodList     = "food_items_list";
$localFoodCats    = "local_food_categories";
$globalFoodCats   = "admin_food_categories";
$restFoodOrdersList = "food_item_orders_list";
$adminConfigTable = "admin_config_settings";


?>
<!-- logoBar -->
<div class="navbar navbar-inverse set-radius-zero">
  <div class="container">
    <div class="navbar-header">
      <a class="navbar-brand" href="admin_home.php"> <img src="assets/img/Brian.jpg" id="userlogo" title="logo" alt="logo"/></a> 
    </div>
    <div class="right-div"><span style="color:#fff; font-size:20px">&raquo;</span>&nbsp;&nbsp;
      <span style="color:#fff; border-bottom:1px solid"><a href="admin_home.php" style="color:#fff; border-bottom:1px solid">Mingcan</a></span><br/><a href="logout.php" class="logout">Logout</a>
    </div>
  </div>
</div>
<!-- logoBarEnd -->

<!-- menu section -->
<section class="menu-section">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="navbar-collapse collapse">
        <span style="color:#fff; font-size:20px; text-transform:uppercase; line-height:38px; font-weight:bold">FMS control panel</span>
          <ul id="menu-top" class="nav navbar-nav navbar-right">
            <li class="<?php echo $dashboard_menu_active;?>"><a href="admin_home.php?menu=dashboard">Dashboard</a></li>
            <li class="<?php echo $news_menu_active;?>"><a href="admin_home.php?menu=news" title="click to manage news">Family news</a></li>
            <li class="<?php echo $photos_menu_active;?>"><a href="admin_home.php?menu=photos" title="click to manage photos">Photo wall</a></li>
            <li class="<?php echo $todo_menu_active;?>"><a href="admin_home.php?menu=todo" title="click to manage todo">task todo</a></li>
            <li class="<?php echo $meals_menu_active;?>"><a href="admin_home.php?menu=meals" title="click to manage meals">meal planer</a></li>
            <li class="<?php echo $revenue_menu_active;?>"><a href="admin_home.php?menu=revenue" title="click to manage revenue">Revenue</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- menu section end -->

<div class="content-wrapper">     
  <?php require "menus/".$inlude_menu_page; ?>
</div>
<?php require "templates/admin_home_footer.php"; ?>


