<?php


class User
{
   private array $data;

    /**
     * User constructor.
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }


    public function __get($name)
    {
        if (method_exists($this, $method = 'get' . ucfirst($name) . 'Property')) {
            return $this->$method();
        }
        return $this->data[$name ] ?? null;
    }

    private function getFullNameProperty() : string
    {
        return "$this->fstName $this->lstName";
    }

}