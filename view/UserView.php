<?php


namespace Nathel;


class UserView extends View
{

    public static function banner(User $user)
    {
        require 'view/elements/user/banner.php';
    }

    public static function activity(User $user)
    {
        require 'view/elements/user/activity.php';
    }

}