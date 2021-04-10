<?php


/******************** NameSpace *********************/
namespace Nathel\Osu\View\Mappool;

/******************** Class Alias *********************/
use Nathel\Osu\Controller\Mappool as Control;
use Nathel\Osu\Model\Mappool\Api;
use Nathel\Osu\Model\Mappool\Database as Data;
use Nathel\Osu\View\Mappool as View;


class UserView extends View
{

    public static function banner(Data\User $user)
    {
        $submitted = $user->getUserMappools();
        $completed = $user->getUserCompletedMappool();
        $follow = $user->getUserFollows();
        require '../Nathel/Osu/View/Mappool/elements/user/banner.php';
    }

    public static function activity(Data\User $user)
    {


        require '../Nathel/Osu/View/Mappool/elements/user/activity.php';
    }

}