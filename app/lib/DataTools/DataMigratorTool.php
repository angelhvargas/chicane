<?php
/**
 * Created by Silooette.
 * Developer: Angel
 * Date: 10/03/2015
 * Time: 16:30
 */

namespace Sil\DataTools;


interface DataMigratorTool {
    /**
     * @return mixed
     */
    public function notificationsMigrate();

    /**
     * @return mixed
     */
    public function likesMigrate();

    /**
     * @return mixed
     */
    public function nudgesMigrate();

    /**
     * @return mixed
     */
    public function commentsMigrate();

}