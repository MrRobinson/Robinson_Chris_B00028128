<?php
/**
 * Created by PhpStorm.
 * User: Chris Robinson
 * this class is used to allow index.php to switch
 * between pages if user selects a page
 * it also allows for the use of a shopping cart in shop.php
 */
namespace Itb;

/**
 * Class MainController
 * @package Itb
 */
class MainController
{

    /**
     * Used to direct to forum.php
     */
    public function forumAction()
    {
        $pageTitle = 'Post A Message';
        $forumLinkStyle = 'current_page';

        require_once __DIR__ . '/../templates/forum.php';
    }

    /**
     * used to direct to login.php
     */
    public function loginAction()
    {
        $pageTitle = 'Login';
        $loginLinkStyle = 'current_page';

        require_once __DIR__ . '/../templates/login.php';
    }

    /**
     * used to direct to logout.php
     */
    public function logoutsuccessAction()
    {
        $pageTitle = 'Logged Out';
        $loginLinkStyle = 'current_page';

        require_once __DIR__ . '/../templates/logout.php';
    }

    /**
     * used to direct to index.php
     */
    public function indexAction()
    {
        $pageTitle = 'Home';
        $indexLinkStyle = 'current_page';

        require_once __DIR__ . '/../templates/index.php';
    }

    /**
     * used to direct to product.php
     */
    public function productAction()
    {
        $pageTitle = 'Products';
        $productLinkStyle = 'current_page';

        $yarnRepository = new YarnDatabase();

        $yarnProducts = $yarnRepository->getAll();

        require_once __DIR__ . '/../templates/product.php';
    }

    /**
     * used to direct to signup.php
     */
    public function signupAction()
    {
        $pageTitle = 'Sign Up';

        require_once __DIR__ . '/../templates/signUp.php';
    }

    /**
     * used to direct to sitemap.php
     */
    public function sitemapAction()
    {
        $pageTitle = 'Site Map';
        $sitemapLinkStyle = 'current_page';

        require_once __DIR__ . '/../templates/sitemap.php';
    }

    /**
     * used to direct to shop.php
     * direct to shoppingCart method
     * get yarn products from Yarn DB
     */
    public function shopAction()
    {
        $pageTitle = 'Shop';
        $shopLinkStyle = 'current_page';
        $shoppingCart = $this->getShoppingCart();

        $yarnRepository = new YarnDatabase();

        $yarnProducts = $yarnRepository->getAll();

        require_once __DIR__ . '/../templates/shop.php';
    }

    /**
     * used to direct to userDashboard.php
     */
    public function userdashboardAction()
    {
        $pageTitle = 'User Dashboard';
        $userDashboardLinkStyle = 'current_page';

        require_once __DIR__ . '/../templates/userDashboard.php';
    }

    /**
     * used to add one item to the cart by finding
     * the id matching the associated item in shop.php
     */
    public function addToCart()
    {
        $YarnId = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
        $shoppingCart = $this->getShoppingCart();
        $oldTotal = 0;
        if (isset($shoppingCart[$YarnId])) {
            $oldTotal = $shoppingCart[$YarnId];
        }
        $shoppingCart[$YarnId] = $oldTotal + 1;
        $_SESSION['shoppingCart'] = $shoppingCart;
        $this->shopAction();
    }

    /**
     * remove product from shopping cart by getting id
     * of associated item in Yarn DB
     */
    public function removeFromCart()
    {
        $YarnId = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
        $shoppingCart = $this->getShoppingCart();
        unset($shoppingCart[$YarnId]);
        $_SESSION['shoppingCart'] = $shoppingCart;
        $this->shopAction();
    }

    /**
     * used to display the shopping cart and its details
     * @return array
     */
    public function getShoppingCart()
    {
        if (isset($_SESSION['shoppingCart'])) {
            return $_SESSION['shoppingCart'];
        } else {
            return [];
        }
    }
}
