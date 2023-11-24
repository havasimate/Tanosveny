<?php

class Menu
{
    public static $menu = array();

    public static function setMenu()
    {
        self::$menu = array();
        $connection = Database::getConnection();
        $stmt = $connection->query("select url, nev, szulo, jogosultsag from menu where jogosultsag like '" . $_SESSION['userlevel'] . "' order by sorrend");
        while ($menuitem = $stmt->fetch(PDO::FETCH_ASSOC)) {
            self::$menu[$menuitem['url']] = array($menuitem['nev'], $menuitem['szulo'], $menuitem['jogosultsag']);
        }
    }

    public static function renderNavbar($sItems)
    {
        $navbar = '<nav class="navbar navbar-expand-lg navbar-light bg-light">';
        $navbar .= '<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">';
        $navbar .= '<span class="navbar-toggler-icon"></span>';
        $navbar .= '</button>';
        $navbar .= '<div class="collapse navbar-collapse" id="navbarNav">';
        $navbar .= self::renderNavItems($sItems);
        $navbar .= '</div>';
        $navbar .= '</nav>';
        return $navbar;
    }

    private static function renderNavItems($sItems)
    {
        $navItems = '<ul class="navbar-nav">';
        foreach (self::$menu as $menuindex => $menuitem) {
            if ($menuitem[1] == "") {
                $navItems .= '<li class="nav-item ' . ($menuindex == $sItems[0] ? 'active' : '') . '">';
                $navItems .= '<a class="nav-link" href="' . SITE_ROOT . $menuindex . '">' . $menuitem[0] . '</a>';
                $navItems .= '</li>';
            } else if ($menuitem[1] == $sItems[0]) {
                $navItems .= '<li class="nav-item ' . ($menuindex == $sItems[1] ? 'active' : '') . '">';
                $navItems .= '<a class="nav-link" href="' . SITE_ROOT . $sItems[0] . '/' . $menuindex . '">' . $menuitem[0] . '</a>';
                $navItems .= '</li>';
            }
        }
        $navItems .= '</ul>';
        return $navItems;
    }
}

Menu::setMenu();
