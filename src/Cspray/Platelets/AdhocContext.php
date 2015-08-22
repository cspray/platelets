<?php

declare(strict_types = 1);

/**
 * @license See LICENSE file in project root
 */

namespace Cspray\Platelets;

use Cspray\Adhoc;

class AdhocContext implements Context {

    use Adhoc\Property;
    use Adhoc\Method;

    public function __construct(array $properties = [], array $methods = []) {
        // We are intentionally not separating these loops out into their own methods
        // The more methods and properties we add to Context implementations the more
        // We pollute the template's available properties and methods
        foreach($properties as $name => $prop) {
            $this->adhocGetter($name, $prop);
        }

        foreach($methods as $name => $method) {
            $this->adhocMethod($name, $method);
        }
    }

}