<?php

namespace App\Containers\Documentation\Actions;

use App\Ship\Parents\Actions\Action;
use Apiato\Core\Foundation\Facades\Apiato;

/**
 * Class GenerateDocumentationAction.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class GenerateDocumentationAction extends Action
{

    /**
     * @param $console
     */
    public function run($console)
    {
        // parse the markdown file.
        Apiato::call('Documentation@RenderTemplatesTask');

        // get docs types that needs to be generated by the user base on his configs.
        $types = Apiato::call('Documentation@GetAllDocsTypesTask');

        $console->info("Generating API Documentations for (" . implode(' & ', $types) . ")\n");

        $documentationUrls = [];

        // for each type, generate docs.
        foreach ($types as $type) {
            $documentationUrls[] = Apiato::call('Documentation@GenerateAPIDocsTask', [$type, $console]);
        }

        $console->info("Done! You can access your API Docs at: \n" . implode("\n", $documentationUrls));
    }

}
