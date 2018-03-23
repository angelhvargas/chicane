<?php
/**
 * Created by PhpStorm.
 * User: Angel
 * Date: 15/05/2015
 * Time: 16:57
 */

namespace Sil\Processing;
use Illuminate\Foundation\Application;

class DefaultOutputDataProcessor implements DataProcessor{

    protected $translator;

    protected $app;

    public function __construct(OutputProcessorTranslator $translator, Application $app)
    {
        $this->translator = $translator;
        $this->app = $app;
    }

    public function run($object)
    {
        $dataTransformer  = $this->translator->toDataTransformer($object);

        return $this->app->make($dataTransformer)->process($object);
    }

}