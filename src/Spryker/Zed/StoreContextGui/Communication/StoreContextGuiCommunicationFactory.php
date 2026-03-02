<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\StoreContextGui\Communication;

use Spryker\Zed\Kernel\Communication\AbstractCommunicationFactory;
use Spryker\Zed\StoreContextGui\Communication\Expander\StoreContextFormExpander;
use Spryker\Zed\StoreContextGui\Communication\Expander\StoreContextFormExpanderInterface;
use Spryker\Zed\StoreContextGui\Communication\Expander\StoreContextTabExpander;
use Spryker\Zed\StoreContextGui\Communication\Expander\StoreContextTabExpanderInterface;
use Spryker\Zed\StoreContextGui\Communication\Form\DataProvider\StoreContextFormDataProvider;
use Spryker\Zed\StoreContextGui\Communication\Form\DataTransformer\StoreContextCollectionDataTransformer;
use Spryker\Zed\StoreContextGui\Communication\Form\StoreContextForm;
use Spryker\Zed\StoreContextGui\Dependency\Facade\StoreContextGuiToStoreContextFacadeInterface;
use Spryker\Zed\StoreContextGui\StoreContextGuiDependencyProvider;
use Symfony\Component\Form\DataTransformerInterface;

/**
 * @method \Spryker\Zed\StoreContextGui\StoreContextGuiConfig getConfig()
 */
class StoreContextGuiCommunicationFactory extends AbstractCommunicationFactory
{
    public function createStoreContextTabExpander(): StoreContextTabExpanderInterface
    {
        return new StoreContextTabExpander();
    }

    public function createStoreContextFormDataProvider(): StoreContextFormDataProvider
    {
        return new StoreContextFormDataProvider(
            $this->getStoreContextFacade(),
        );
    }

    public function createStoreContextFormExpander(): StoreContextFormExpanderInterface
    {
        return new StoreContextFormExpander(
            $this->createStoreContextFormDataProvider(),
        );
    }

    public function getStoreContextFacade(): StoreContextGuiToStoreContextFacadeInterface
    {
        return $this->getProvidedDependency(StoreContextGuiDependencyProvider::FACADE_STORE_CONTEXT);
    }

    public function createStoreContextCollectionDataTransformer(): DataTransformerInterface
    {
        return new StoreContextCollectionDataTransformer();
    }

    public function getStoreContextFormClass(): string
    {
        return StoreContextForm::class;
    }
}
