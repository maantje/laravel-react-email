<?php

namespace Maantje\ReactEmail;

use Illuminate\Support\HtmlString;
use ReflectionException;

trait ReactMailView
{
    /**
     * Override buildView from Mailable to render react-email emails instead of blade views
     *
     * @return array
     * @throws ReflectionException|Exceptions\NodeNotFoundException
     */
    protected function buildView(): array
    {
        return array_map(
            fn ($content) => new HtmlString($content),
            Renderer::render($this->view, $this->buildViewData())
        );
    }
}
