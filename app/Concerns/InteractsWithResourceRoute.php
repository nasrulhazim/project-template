<?php

namespace App\Concerns;

trait InteractsWithResourceRoute
{
    public function getResourceUrl(string $type = 'index')
    {
        return $type === 'index '
            ? route($this->getUrlRouteBaseName() . '.index')
            : route($this->getUrlRouteBaseName() . '.' . $type, $this);
    }

    public function getUrlRouteBaseName()
    {
        return str(get_called_class())->classBasename()->kebab()->plural()->toString();
    }
}
