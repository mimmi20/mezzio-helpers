<?php
/**
 * This file is part of the mimmi20/mezzio-navigation-helpers package.
 *
 * Copyright (c) 2021, Thomas Mueller <mimmi20@live.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types = 1);
namespace Mezzio\Navigation\Helper;

use Interop\Container\ContainerInterface;
use Laminas\I18n\View\Helper\Translate;
use Laminas\View\Helper\EscapeHtml;
use Laminas\View\Helper\EscapeHtmlAttr;
use Laminas\View\HelperPluginManager as ViewHelperPluginManager;

final class HtmlifyFactory
{
    /**
     * Create and return a navigation view helper instance.
     *
     * @param ContainerInterface $container
     *
     * @throws \Psr\Container\ContainerExceptionInterface
     *
     * @return Htmlify
     */
    public function __invoke(ContainerInterface $container): Htmlify
    {
        $plugin     = $container->get(ViewHelperPluginManager::class);
        $translator = null;

        if ($plugin->has(Translate::class)) {
            $translator = $plugin->get(Translate::class);
        }

        return new Htmlify(
            $plugin->get(EscapeHtml::class),
            $plugin->get(EscapeHtmlAttr::class),
            $translator
        );
    }
}
