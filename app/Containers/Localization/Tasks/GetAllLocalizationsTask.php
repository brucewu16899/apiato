<?php

namespace App\Containers\Localization\Tasks;

use App\Containers\Localization\Models\Localization;
use App\Ship\Parents\Tasks\Task;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Config;

/**
 * Class GetAllLocalizationsTask
 *
 * @author  Johannes Schobel <johannes.schobel@googlemail.com>
 */
class GetAllLocalizationsTask extends Task
{

    /**
     * @return  \Illuminate\Support\Collection
     */
    public function run()
    {
        $supported_localizations = Config::get('localization-container.supported_languages');

        $localizations = new Collection();

        foreach ($supported_localizations as $key => $value) {
            $localizations->push(new Localization($key));
        }

        return $localizations;
    }
}
