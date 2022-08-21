<?php

namespace YG\Netgsm\Soap\Request;

abstract class RequestAbstract
{
    /**
     * Sınıf özelliklerini ['name' => property, 'value': propertyValue, ...] şeklinde döndürür.
     *
     * @return array
     */
    public function toArray(): array
    {
        $parameters = [];

        foreach (get_object_vars($this) as $key => $value)
        {
            if ($value == '')
                continue;

            $parameters[] = [
                'name' => $key,
                'value' => $value
            ];
        }

        return $parameters;
    }

    /**
     * Verilen dizideki değerleri sınıf özelliklerine atar.
     *
     * @param string[] $params [name => value, ...] formatında bir dizidir.
     *
     * @return void
     */
    public function setParams(array $params): self
    {
        foreach ($params as $key => $value)
        {
            if (property_exists($this, $key))
            {
                $this->{$key} = $value;
            }
        }

        return $this;
    }
}